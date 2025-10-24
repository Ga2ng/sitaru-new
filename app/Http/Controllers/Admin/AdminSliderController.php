<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminSliderController extends Controller
{
    private $base_view = 'admin.slider.';
    private $path = 'admin.slider';

    public function index()
    {
        $sliders = Slider::orderBy('updated_at', 'desc')->paginate(10);

        // Count statistics
        $totalSliders = Slider::count();
        $activeSliders = Slider::where('status', 1)->count();
        $inactiveSliders = Slider::where('status', 0)->count();
        $todaySliders = Slider::whereDate('created_at', today())->count();

        $data = [
            'title' => 'Slider Management',
            'sliders' => $sliders,
            'totalSliders' => $totalSliders,
            'activeSliders' => $activeSliders,
            'inactiveSliders' => $inactiveSliders,
            'todaySliders' => $todaySliders,
        ];
        return view($this->base_view . 'index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Slider',
        ];
        return view($this->base_view . 'create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:191',
            'link' => 'nullable|url',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:10240',
            'status' => 'boolean',
        ], [
            'judul.required' => 'Judul slider harus diisi!',
            'deskripsi.max' => 'Deskripsi maksimal 191 karakter!',
            'link.url' => 'Link harus berupa URL yang valid!',
            'photo.required' => 'Gambar slider harus diupload!',
            'photo.image' => 'File harus berupa gambar!',
            'photo.mimes' => 'Format gambar harus JPG, PNG, atau JPEG!',
            'photo.max' => 'Ukuran gambar maksimal 10MB!',
        ]);

        $data = $request->except('photo');
        $data['status'] = $request->has('status') ? 1 : 0;
        $data['slug'] = Str::slug($request->judul);

        if ($request->hasFile('photo')) {
            $data['photo'] = $this->savePhoto($request->file('photo'), $data['slug']);
        }

        Slider::create($data);

        return redirect()->route($this->path . '.index')
            ->with('success', 'Slider berhasil ditambahkan!');
    }

    public function show($id)
    {
        $slider = Slider::findOrFail($id);
        $data = [
            'title' => 'Detail Slider',
            'slider' => $slider,
        ];
        return view($this->base_view . 'show', $data);
    }

    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        $data = [
            'title' => 'Edit Slider',
            'slider' => $slider,
        ];
        return view($this->base_view . 'edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:191',
            'link' => 'nullable|url',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
            'status' => 'boolean',
        ], [
            'judul.required' => 'Judul slider harus diisi!',
            'deskripsi.max' => 'Deskripsi maksimal 191 karakter!',
            'link.url' => 'Link harus berupa URL yang valid!',
            'photo.image' => 'File harus berupa gambar!',
            'photo.mimes' => 'Format gambar harus JPG, PNG, atau JPEG!',
            'photo.max' => 'Ukuran gambar maksimal 10MB!',
        ]);

        $slider = Slider::findOrFail($id);
        $data = $request->except('photo');
        $data['status'] = $request->has('status') ? 1 : 0;
        $data['slug'] = Str::slug($request->judul);

        if ($request->hasFile('photo')) {
            // Delete old photo
            if ($slider->photo) {
                $this->deletePhoto($slider->photo);
            }
            $data['photo'] = $this->savePhoto($request->file('photo'), $data['slug']);
        }

        $slider->update($data);

        return redirect()->route($this->path . '.index')
            ->with('success', 'Slider berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);
        
        if ($slider->photo) {
            $this->deletePhoto($slider->photo);
        }
        
        $slider->delete();

        return redirect()->route($this->path . '.index')
            ->with('success', 'Slider berhasil dihapus!');
    }

    public function toggleStatus($id)
    {
        $slider = Slider::findOrFail($id);
        $slider->update(['status' => !$slider->status]);

        return response()->json([
            'success' => true,
            'status' => $slider->status,
            'message' => 'Status slider berhasil diubah!'
        ]);
    }

    protected function savePhoto($photo, $slug)
    {
        $fileName = $slug . '_' . time() . '.' . $photo->getClientOriginalExtension();
        
        // Create directory if it doesn't exist
        $uploadPath = public_path('uploads/images/slider');
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        // Save original image to public/uploads/images/slider
        $photo->move($uploadPath, $fileName);

        return $fileName;
    }

    protected function deletePhoto($filename)
    {
        $path = public_path('uploads/images/slider/' . $filename);
        if (file_exists($path)) {
            unlink($path);
        }
    }
}
