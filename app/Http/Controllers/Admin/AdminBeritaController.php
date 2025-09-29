<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class AdminBeritaController extends Controller
{
    private $base_view = 'admin.berita.';
    private $path = 'admin.berita';

    public function index()
    {
        $beritas = Berita::with('kategori')->orderBy('updated_at', 'desc')->paginate(10);

        // Count statistics
        $totalBeritas = Berita::count();
        $activeBeritas = Berita::where('status', 'aktif')->count();
        $pendingBeritas = Berita::where('status', 'pending')->count();
        $todayBeritas = Berita::whereDate('created_at', today())->count();

        $data = [
            'title' => 'Berita Management',
            'beritas' => $beritas,
            'totalBeritas' => $totalBeritas,
            'activeBeritas' => $activeBeritas,
            'pendingBeritas' => $pendingBeritas,
            'todayBeritas' => $todayBeritas,
        ];
        return view($this->base_view . 'index', $data);
    }

    public function create()
    {
        $kategoris = Kategori::pluck('nama', 'id');
        $data = [
            'title' => 'Tambah Berita',
            'kategoris' => $kategoris,
        ];
        return view($this->base_view . 'create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kategori_id' => 'required|exists:kategoris,id',
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

        Berita::create($data);

        return redirect()->route($this->path . '.index')
            ->with('success', 'Berita berhasil ditambahkan!');
    }

    public function show($id)
    {
        $berita = Berita::with('kategori')->findOrFail($id);
        $data = [
            'title' => 'Detail Berita',
            'berita' => $berita,
        ];
        return view($this->base_view . 'show', $data);
    }

    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        $kategoris = Kategori::pluck('nama', 'id');
        $data = [
            'title' => 'Edit Berita',
            'berita' => $berita,
            'kategoris' => $kategoris,
        ];
        return view($this->base_view . 'edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kategori_id' => 'required|exists:kategoris,id',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'in:aktif,pending',
        ]);

        $berita = Berita::findOrFail($id);
        $data = $request->except('photo');
        $data['slug'] = Str::slug($request->nama);
        $data['status'] = $request->status ?? 'pending';

        if ($request->hasFile('photo')) {
            // Delete old photo
            if ($berita->photo) {
                $this->deletePhoto($berita->photo);
            }
            $data['photo'] = $this->savePhoto($request->file('photo'), $data['slug']);
        }

        $berita->update($data);

        return redirect()->route($this->path . '.index')
            ->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);
        
        if ($berita->photo) {
            $this->deletePhoto($berita->photo);
        }
        
        $berita->delete();

        return redirect()->route($this->path . '.index')
            ->with('success', 'Berita berhasil dihapus!');
    }

    public function toggleStatus($id)
    {
        $berita = Berita::findOrFail($id);
        $newStatus = $berita->status === 'aktif' ? 'pending' : 'aktif';
        $berita->update(['status' => $newStatus]);

        return response()->json([
            'success' => true,
            'status' => $newStatus,
            'message' => 'Status berita berhasil diubah!'
        ]);
    }

    protected function savePhoto($photo, $slug)
    {
        $fileName = $slug . '_' . time() . '.' . $photo->getClientOriginalExtension();
        
        // Create directories if they don't exist
        $directories = ['berita/large', 'berita/medium', 'berita/small'];
        foreach ($directories as $dir) {
            if (!Storage::exists('public/images/' . $dir)) {
                Storage::makeDirectory('public/images/' . $dir);
            }
        }

        // Save large image
        $largeImage = Image::make($photo)->resize(800, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        Storage::put('public/images/berita/large/' . $fileName, $largeImage->encode());

        // Save medium image
        $mediumImage = Image::make($photo)->fit(600, 400);
        Storage::put('public/images/berita/medium/' . $fileName, $mediumImage->encode());

        // Save small image
        $smallImage = Image::make($photo)->resize(100, 100, function ($constraint) {
            $constraint->aspectRatio();
        });
        Storage::put('public/images/berita/small/' . $fileName, $smallImage->encode());

        return $fileName;
    }

    protected function deletePhoto($filename)
    {
        $directories = ['berita/large', 'berita/medium', 'berita/small'];
        
        foreach ($directories as $dir) {
            $path = 'public/images/' . $dir . '/' . $filename;
            if (Storage::exists($path)) {
                Storage::delete($path);
            }
        }
    }
}
