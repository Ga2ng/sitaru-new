<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Informasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
            'deskripsi' => 'required|string|max:191',
            'konten' => 'required|string',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:10240',
            'status' => 'in:aktif,pending',
        ], [
            'nama.required' => 'Nama informasi harus diisi!',
            'deskripsi.required' => 'Deskripsi singkat harus diisi!',
            'deskripsi.max' => 'Deskripsi singkat maksimal 191 karakter!',
            'konten.required' => 'Konten lengkap harus diisi!',
            'photo.required' => 'Gambar harus diupload!',
            'photo.image' => 'File harus berupa gambar!',
            'photo.mimes' => 'Format gambar harus JPG, PNG, atau JPEG!',
            'photo.max' => 'Ukuran gambar maksimal 10MB!',
        ]);

        $data = $request->except('photo');
        $data['slug'] = Str::slug($request->nama);
        $data['dilihat'] = 0;
        $data['status'] = $request->status ?? 'pending';

        // Handle photo upload
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
            'deskripsi' => 'required|string|max:191',
            'konten' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
            'status' => 'in:aktif,pending',
        ], [
            'nama.required' => 'Nama informasi harus diisi!',
            'deskripsi.required' => 'Deskripsi singkat harus diisi!',
            'deskripsi.max' => 'Deskripsi singkat maksimal 191 karakter!',
            'konten.required' => 'Konten lengkap harus diisi!',
            'photo.image' => 'File harus berupa gambar!',
            'photo.mimes' => 'Format gambar harus JPG, PNG, atau JPEG!',
            'photo.max' => 'Ukuran gambar maksimal 10MB!',
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
        
        // Create directory if it doesn't exist
        $uploadPath = public_path('uploads/images/informasi');
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        // Save original image to public/uploads/images/informasi
        $photo->move($uploadPath, $fileName);

        return $fileName;
    }


    protected function deletePhoto($filename)
    {
        $path = public_path('uploads/images/informasi/' . $filename);
        if (file_exists($path)) {
            unlink($path);
        }
    }
}
