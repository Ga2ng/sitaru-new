<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

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
            'link' => 'nullable|url',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'boolean',
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
            'link' => 'nullable|url',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'boolean',
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
        
        // Create directories if they don't exist
        $directories = ['slider/large', 'slider/medium', 'slider/small'];
        foreach ($directories as $dir) {
            if (!Storage::exists('public/images/' . $dir)) {
                Storage::makeDirectory('public/images/' . $dir);
            }
        }

        // Save large image
        $largeImage = Image::make($photo)->resize(800, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        Storage::put('public/images/slider/large/' . $fileName, $largeImage->encode());

        // Save medium image
        $mediumImage = Image::make($photo)->resize(400, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        Storage::put('public/images/slider/medium/' . $fileName, $mediumImage->encode());

        // Save small image
        $smallImage = Image::make($photo)->resize(100, 100, function ($constraint) {
            $constraint->aspectRatio();
        });
        Storage::put('public/images/slider/small/' . $fileName, $smallImage->encode());

        return $fileName;
    }

    protected function deletePhoto($filename)
    {
        $directories = ['slider/large', 'slider/medium', 'slider/small'];
        
        foreach ($directories as $dir) {
            $path = 'public/images/' . $dir . '/' . $filename;
            if (Storage::exists($path)) {
                Storage::delete($path);
            }
        }
    }
}
