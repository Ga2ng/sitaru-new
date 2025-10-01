<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class AdminPengaduanController extends Controller
{
    private $base_view = 'admin.pengaduan.';
    private $path = 'admin.pengaduan';

    public function index(Request $request)
    {
        $query = Pengaduan::with(['user', 'kecamatan', 'desa']);

        // Filter berdasarkan pencarian
        if ($request->has('search') && $request->search != '') {
            $query->where(function ($q) use ($request) {
                $q->where('nama_pengadu', 'like', "%{$request->search}%")
                  ->orWhere('uraian', 'like', "%{$request->search}%");
            });
        }

        // Filter berdasarkan bulan
        if ($request->has('bulan') && $request->bulan != 0) {
            $query->whereMonth('tgl_masuk', $request->bulan);
        }

        // Filter berdasarkan tahun
        if ($request->has('tahun') && $request->tahun != '') {
            $query->whereYear('tgl_masuk', $request->tahun);
        }

        // Filter berdasarkan status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Sorting
        $query->orderBy('tgl_masuk', 'desc');

        // Pagination
        $pengaduans = $query->paginate(15)->withQueryString();

        // Statistics
        $totalPengaduan = Pengaduan::count();
        $dataMasuk = Pengaduan::where('status', 'Data Masuk')->count();
        $proses = Pengaduan::where('status', 'Proses')->count();
        $selesai = Pengaduan::where('status', 'Selesai')->count();
        $ditolak = Pengaduan::where('status', 'Ditolak')->count();

        $data = [
            'title' => 'Pengaduan Pemohon',
            'pengaduans' => $pengaduans,
            'totalPengaduan' => $totalPengaduan,
            'dataMasuk' => $dataMasuk,
            'proses' => $proses,
            'selesai' => $selesai,
            'ditolak' => $ditolak,
            'request' => $request,
        ];

        return view($this->base_view . 'index', $data);
    }

    public function show($id)
    {
        $pengaduan = Pengaduan::with(['user', 'kecamatan', 'desa'])->findOrFail($id);

        // Get riwayat
        $riwayat = DB::table('pengaduan_riwayat')
            ->where('pengaduan_id', $id)
            ->orderBy('id', 'asc')
            ->get();

        $data = [
            'model' => $pengaduan,
            'riwayat' => $riwayat,
            'title' => 'Detail Pengaduan',
        ];

        return view($this->base_view . 'show', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Pengaduan Pemohon',
            'kecamatan' => DB::table('setup_kec')->where('NO_PROP', 35)->where('NO_KAB', 10)->pluck('NAMA_KEC', 'NO_KEC'),
            'kelurahan' => DB::table('setup_kel_fix')->where('NO_PROP', 35)->where('NO_KAB', 10)->pluck('NAMA_KEL', 'NO_KEL'),
            'user' => Auth::user(),
        ];

        return view($this->base_view . 'create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pengadu' => 'required|string|max:255',
            'telp_pengadu' => 'required|string|max:20',
            'alamat' => 'required|string|max:500',
            'NO_KEC' => 'required|integer',
            'NO_KEL' => 'required|integer',
            'uraian' => 'required|string',
            'foto_1' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_2' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_3' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_4' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_5' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            DB::beginTransaction();

            $user = Auth::user();

            // Create Pengaduan
            $pengaduan = Pengaduan::create([
                'user_id' => $user->id,
                'nama_pengadu' => $request->get('nama_pengadu'),
                'telp_pengadu' => $request->get('telp_pengadu'),
                'alamat' => $request->get('alamat'),
                'kecamatan_id' => $request->get('NO_KEC'),
                'desa_id' => $request->get('NO_KEL'),
                'lat_pengaduan' => $request->get('latitude'),
                'lng_pengaduan' => $request->get('longitude'),
                'kepemilikan' => $request->get('kepemilikan'),
                'kondisi_lahan' => $request->get('kondisi'),
                'luas' => $request->get('luas_lahan'),
                'bts_kanan' => $request->get('batas_kanan'),
                'bts_kiri' => $request->get('batas_kiri'),
                'dampak' => $request->get('dampak'),
                'uraian' => $request->get('uraian'),
                'tgl_masuk' => date('Y-m-d'),
                'status' => 'Data Masuk',
            ]);

            // Handle file uploads
            $this->handlePhotoUploads($request, $pengaduan);

            // Create riwayat
            $riwayat = DB::table('pengaduan_riwayat')
                ->where('pengaduan_id', $pengaduan->id)
                ->where('status', 'Data Masuk')
                ->first();

            if (!$riwayat) {
                DB::table('pengaduan_riwayat')->insert([
                    'pengaduan_id' => $pengaduan->id,
                    'status' => 'Data Masuk',
                    'keterangan' => 'Pengaduan Baru Telah Masuk'
                ]);
            }

            DB::commit();

            return redirect()->route($this->path . '.index')
                ->with('success', 'Data berhasil disimpan kedalam sistem');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        // Method ini akan digunakan untuk proses/tindak lanjut pengaduan
        $pengaduan = Pengaduan::with(['user'])->findOrFail($id);

        // Get kecamatan dan kelurahan info
        $kec = DB::table('setup_kec')->where('NO_PROP', 35)->where('NO_KAB', 10)->where('NO_KEC', $pengaduan->kecamatan_id)->first();
        $kel = DB::table('setup_kel_fix')->where('NO_PROP', 35)->where('NO_KAB', 10)->where('NO_KEC', $kec->NO_KEC ?? '')->where('NO_KEL', $pengaduan->desa_id)->first();

        $data = [
            'title' => 'Proses Pengaduan',
            'model' => $pengaduan,
            'kec' => $kec,
            'kel' => $kel,
        ];

        return view($this->base_view . 'proses', $data);
    }

    public function update(Request $request, $id)
    {
        // Method ini tidak digunakan karena menggunakan pengaduanProses
        return redirect()->route($this->path . '.edit', $id);
    }

    public function destroy($id)
    {
        try {
            $pengaduan = Pengaduan::findOrFail($id);
            
            // Delete photos
            $folder = 'uploads/berkas/pengaduan/' . $pengaduan->id;
            if (file_exists($folder)) {
                File::deleteDirectory($folder);
            }

            // Delete riwayat
            DB::table('pengaduan_riwayat')->where('pengaduan_id', $pengaduan->id)->delete();

            $pengaduan->delete();

            return redirect()->route($this->path . '.index')
                ->with('success', 'Data berhasil dihapus');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function tolakPengaduan(Request $request)
    {
        try {
            $pengaduan = Pengaduan::findOrFail($request->pengaduan_id);
            $pengaduan->update(['status' => 'Ditolak']);

            $riwayat = DB::table('pengaduan_riwayat')
                ->where('pengaduan_id', $pengaduan->id)
                ->where('status', 'Ditolak')
                ->first();

            if (!$riwayat) {
                DB::table('pengaduan_riwayat')->insert([
                    'pengaduan_id' => $pengaduan->id,
                    'status' => 'Ditolak',
                    'keterangan' => 'Pengaduan Ditolak'
                ]);
            }

            return response()->json(['success' => true, 'message' => 'Berhasil']);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal']);
        }
    }

    public function penangananPengaduan(Request $request)
    {
        try {
            $pengaduan = Pengaduan::findOrFail($request->pengaduan_id);
            $pengaduan->update(['status' => 'Proses']);

            $riwayat = DB::table('pengaduan_riwayat')
                ->where('pengaduan_id', $pengaduan->id)
                ->where('status', 'Proses')
                ->first();

            if (!$riwayat) {
                DB::table('pengaduan_riwayat')->insert([
                    'pengaduan_id' => $pengaduan->id,
                    'status' => 'Proses',
                    'keterangan' => 'Pengaduan Dalam Proses Penanganan'
                ]);
            }

            return response()->json(['success' => true, 'message' => 'Berhasil']);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal']);
        }
    }

    public function pengaduanProses(Request $request)
    {
        $request->validate([
            'pengaduan_id' => 'required|integer',
            'status' => 'required|in:Data Masuk,Proses,Ditolak,Selesai',
            'kendala' => 'nullable|string',
            'solusi' => 'nullable|string',
        ]);

        try {
            $pengaduan = Pengaduan::findOrFail($request->pengaduan_id);

            $pengaduan->update([
                'kendala' => $request->kendala,
                'solusi' => $request->solusi,
                'status' => $request->status,
            ]);

            $riwayat = DB::table('pengaduan_riwayat')
                ->where('pengaduan_id', $pengaduan->id)
                ->where('status', $request->status)
                ->first();

            if (!$riwayat) {
                DB::table('pengaduan_riwayat')->insert([
                    'pengaduan_id' => $pengaduan->id,
                    'status' => $request->status,
                    'keterangan' => 'Pengaduan dalam status ' . $request->status
                ]);
            }

            return redirect()->route($this->path . '.index')
                ->with('success', 'Status pengaduan berhasil diupdate');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    private function handlePhotoUploads(Request $request, Pengaduan $pengaduan, $isUpdate = false)
    {
        $folder = 'uploads/berkas/pengaduan/' . $pengaduan->id;
        if (!file_exists($folder)) {
            mkdir($folder, 0755, true);
        }

        $photos = ['foto_1', 'foto_2', 'foto_3', 'foto_4', 'foto_5'];

        foreach ($photos as $photo) {
            if ($request->hasFile($photo)) {
                // Delete old photo if updating
                if ($isUpdate && $pengaduan->$photo != '') {
                    $originalPath = $folder . DIRECTORY_SEPARATOR . $pengaduan->$photo;
                    File::delete($originalPath);
                }

                $file = $request->file($photo);
                $filename = $photo . '.' . $file->guessClientExtension();
                $file->move($folder, $filename);

                $pengaduan->update([$photo => $filename]);
            }
        }
    }

    public function riwayat($id)
    {
        $riwayat = DB::table('pengaduan_riwayat')
            ->where('pengaduan_id', $id)
            ->orderBy('id', 'asc')
            ->get();

        $model = Pengaduan::findOrFail($id);

        return view($this->base_view . 'riwayat', compact('riwayat', 'model'));
    }
}

