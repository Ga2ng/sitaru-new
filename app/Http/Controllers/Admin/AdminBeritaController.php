<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
            'deskripsi' => 'required|string|max:191',
            'konten' => 'required|string',
            'kategori_id' => 'required|exists:kategori,id',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:10240',
            'status' => 'in:aktif,pending',
        ], [
            'nama.required' => 'Nama berita harus diisi!',
            'deskripsi.required' => 'Deskripsi singkat harus diisi!',
            'deskripsi.max' => 'Deskripsi singkat maksimal 191 karakter!',
            'konten.required' => 'Konten lengkap harus diisi!',
            'kategori_id.required' => 'Kategori harus dipilih!',
            'kategori_id.exists' => 'Kategori yang dipilih tidak valid!',
            'photo.required' => 'Gambar harus diupload!',
            'photo.image' => 'File harus berupa gambar!',
            'photo.mimes' => 'Format gambar harus JPG, PNG, atau JPEG!',
            'photo.max' => 'Ukuran gambar maksimal 10MB!',
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
            'deskripsi' => 'required|string|max:191',
            'konten' => 'required|string',
            'kategori_id' => 'required|exists:kategori,id',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
            'status' => 'in:aktif,pending',
        ], [
            'nama.required' => 'Nama berita harus diisi!',
            'deskripsi.required' => 'Deskripsi singkat harus diisi!',
            'deskripsi.max' => 'Deskripsi singkat maksimal 191 karakter!',
            'konten.required' => 'Konten lengkap harus diisi!',
            'kategori_id.required' => 'Kategori harus dipilih!',
            'kategori_id.exists' => 'Kategori yang dipilih tidak valid!',
            'photo.image' => 'File harus berupa gambar!',
            'photo.mimes' => 'Format gambar harus JPG, PNG, atau JPEG!',
            'photo.max' => 'Ukuran gambar maksimal 10MB!',
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
        
        // Create directory if it doesn't exist
        $uploadPath = public_path('uploads/images/berita');
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        // Save original image to public/uploads/images/berita
        $photo->move($uploadPath, $fileName);

        return $fileName;
    }

    protected function deletePhoto($filename)
    {
        $path = public_path('uploads/images/berita/' . $filename);
        if (file_exists($path)) {
            unlink($path);
        }
    }
}
