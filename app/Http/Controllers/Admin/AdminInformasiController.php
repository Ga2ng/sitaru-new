<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Informasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class AdminInformasiController extends Controller
{
    private $base_view = 'admin.informasi.';
    private $path = 'admin.informasi';

    public function index()
    {
        $informasis = Informasi::orderBy('updated_at', 'desc')->paginate(10);

        // Count statistics
        $totalInformasis = Informasi::count();
        $activeInformasis = Informasi::where('status', 'aktif')->count();
        $pendingInformasis = Informasi::where('status', 'pending')->count();
        $todayInformasis = Informasi::whereDate('created_at', today())->count();

        $data = [
            'title' => 'Informasi Management',
            'informasis' => $informasis,
            'totalInformasis' => $totalInformasis,
            'activeInformasis' => $activeInformasis,
            'pendingInformasis' => $pendingInformasis,
            'todayInformasis' => $todayInformasis,
        ];
        return view($this->base_view . 'index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Informasi',
        ];
        return view($this->base_view . 'create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'in:aktif,pending',
        ]);

        $data = $request->except('photo');
        $data['slug'] = Str::slug($request->nama);
        $data['dilihat'] = 0;
        $data['status'] = $request->status ?? 'pending';

        if ($request->hasFile('photo')) {
            $data['photo'] = $this->savePhoto($request->file('photo'), $data['slug']);
        }

        Informasi::create($data);

        return redirect()->route($this->path . '.index')
            ->with('success', 'Informasi berhasil ditambahkan!');
    }

    public function show($id)
    {
        $informasi = Informasi::findOrFail($id);
        $data = [
            'title' => 'Detail Informasi',
            'informasi' => $informasi,
        ];
        return view($this->base_view . 'show', $data);
    }

    public function edit($id)
    {
        $informasi = Informasi::findOrFail($id);
        $data = [
            'title' => 'Edit Informasi',
            'informasi' => $informasi,
        ];
        return view($this->base_view . 'edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'in:aktif,pending',
        ]);

        $informasi = Informasi::findOrFail($id);
        $data = $request->except('photo');
        $data['slug'] = Str::slug($request->nama);
        $data['status'] = $request->status ?? 'pending';

        if ($request->hasFile('photo')) {
            // Delete old photo
            if ($informasi->photo) {
                $this->deletePhoto($informasi->photo);
            }
            $data['photo'] = $this->savePhoto($request->file('photo'), $data['slug']);
        }

        $informasi->update($data);

        return redirect()->route($this->path . '.index')
            ->with('success', 'Informasi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $informasi = Informasi::findOrFail($id);
        
        if ($informasi->photo) {
            $this->deletePhoto($informasi->photo);
        }
        
        $informasi->delete();

        return redirect()->route($this->path . '.index')
            ->with('success', 'Informasi berhasil dihapus!');
    }

    public function toggleStatus($id)
    {
        $informasi = Informasi::findOrFail($id);
        $newStatus = $informasi->status === 'aktif' ? 'pending' : 'aktif';
        $informasi->update(['status' => $newStatus]);

        return response()->json([
            'success' => true,
            'status' => $newStatus,
            'message' => 'Status informasi berhasil diubah!'
        ]);
    }

    protected function savePhoto($photo, $slug)
    {
        $fileName = $slug . '_' . time() . '.' . $photo->getClientOriginalExtension();
        
        // Create directories if they don't exist
        $directories = ['informasi/large', 'informasi/medium', 'informasi/small'];
        foreach ($directories as $dir) {
            if (!Storage::exists('public/images/' . $dir)) {
                Storage::makeDirectory('public/images/' . $dir);
            }
        }

        // Save large image
        $largeImage = Image::make($photo)->resize(800, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        Storage::put('public/images/informasi/large/' . $fileName, $largeImage->encode());

        // Save medium image
        $mediumImage = Image::make($photo)->fit(600, 400);
        Storage::put('public/images/informasi/medium/' . $fileName, $mediumImage->encode());

        // Save small image
        $smallImage = Image::make($photo)->resize(100, 100, function ($constraint) {
            $constraint->aspectRatio();
        });
        Storage::put('public/images/informasi/small/' . $fileName, $smallImage->encode());

        return $fileName;
    }

    protected function deletePhoto($filename)
    {
        $directories = ['informasi/large', 'informasi/medium', 'informasi/small'];
        
        foreach ($directories as $dir) {
            $path = 'public/images/' . $dir . '/' . $filename;
            if (Storage::exists($path)) {
                Storage::delete($path);
            }
        }
    }
}
