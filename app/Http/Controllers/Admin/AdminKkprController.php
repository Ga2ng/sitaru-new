<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kkpr;
use App\Models\User;
use App\Models\Kkpr_riwayat;
use App\Models\Persyaratan;
use App\Models\Kecamatan;
use App\Models\BerkasKkpr;
use App\Models\Sertifikat;
use App\Models\Kkpr_syarat_pelaksanaan;
use App\Models\Kkpr_ketentuan_lain;
use App\Models\Kkpr_pertimbangan;
use App\Models\Kkpr_terbit;
use App\Models\Kkpr_gsb;
use App\Models\Kbli;
use App\Models\Koordinat_kkpr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class AdminKkprController extends Controller
{
    private $base_view = 'admin.kkpr.';
    private $path = 'admin.kkpr';

    public function __construct()
    {
        // Middleware akan didefinisikan di routes
    }

    public function index(Request $request)
    {
        $query = Kkpr::with(['user', 'kabupaten', 'kecamatan', 'kelurahan'])
            ->where('deleted', 0)
            ->where('jenis', 'usaha');

        // Filter berdasarkan role
        if (Gate::allows('Kabid')) {
            $query->where('proses', 8);
        } elseif (Gate::allows('Kadin PTSP')) {
            $query->where('proses', 9);
        } elseif (Gate::allows('Analis')) {
            $query->where(function ($q) {
                $q->where('proses', 7)
                  ->orWhere('proses', 8)
                  ->orWhere('status_analisa', 'survey')
                  ->orWhere('status_analisa', 'analisa');
            });
        }

        // Filter berdasarkan pencarian
        if ($request->has('search') && $request->search != '') {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%");
            });
        }

        // Filter berdasarkan bulan
        if ($request->has('bulan') && $request->bulan != 0) {
            $query->whereMonth('created_at', $request->bulan);
        }

        // Filter berdasarkan tahun
        if ($request->has('tahun') && $request->tahun != '') {
            $query->whereYear('created_at', $request->tahun);
        }

        // Filter berdasarkan status
        if ($request->has('status') && $request->status != '') {
            if ($request->status == '0') {
                $query->where('revisi', 1);
            } else {
                $query->where('proses', $request->status);
            }
        }

        // Sorting
        $query->orderBy('updated_at', 'desc');

        // Pagination
        $kkprs = $query->paginate(15)->withQueryString();

        // Statistics
        $totalKkpr = Kkpr::where('deleted', 0)->where('jenis', 'usaha')->count();
        $pengajuan = Kkpr::where('deleted', 0)->where('jenis', 'usaha')->where('proses', 1)->count();
        $proses = Kkpr::where('deleted', 0)->where('jenis', 'usaha')->whereIn('proses', [2, 3, 4, 5, 6, 7, 8, 9])->count();
        $selesai = Kkpr::where('deleted', 0)->where('jenis', 'usaha')->where('proses', 10)->count();

        $data = [
            'title' => 'Persetujuan UMK',
            'kkprs' => $kkprs,
            'totalKkpr' => $totalKkpr,
            'pengajuan' => $pengajuan,
            'proses' => $proses,
            'selesai' => $selesai,
            'request' => $request,
        ];

        return view($this->base_view . 'index', $data);
    }

    public function show($id)
    {
        $kkpr = Kkpr::with(['user', 'kabupaten', 'kecamatan', 'kelurahan', 'kkpr_kbli', 'kkpr_koordinat'])
            ->findOrFail($id);

        $data = [
            'model' => $kkpr,
            'administrasi' => Persyaratan::where('jenis', 5)->get(),
            'title' => 'Detail Persetujuan UMK',
        ];

        return view($this->base_view . 'show', $data);
    }

    public function create()
    {
        $data = [
            'kabupaten' => DB::table('setup_kab')->where('NO_PROP', 35)->where('NO_KAB', 10)->pluck('NAMA_KAB', 'NO_KAB'),
            'kecamatan' => DB::table('setup_kec')->where('NO_PROP', 35)->where('NO_KAB', 10)->pluck('NAMA_KEC', 'NO_KEC'),
            'kelurahan' => DB::table('setup_kel_fix')->where('NO_PROP', 35)->where('NO_KAB', 10)->pluck('NAMA_KEL', 'NO_KEL'),
            'title' => 'Pengajuan Kesesuaian Pemanfaatan Ruang',
            'persyaratan' => Persyaratan::where('jenis', 5)->where('status', true)->get(),
        ];

        return view($this->base_view . 'create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pemohon' => 'required|string|max:255',
            'nik_pemohon' => 'required|string|max:16',
            'no_telp' => 'required|string|max:20',
            'pekerjaan_pemohon' => 'required|string|max:255',
            'alamat_pemohon' => 'required|string|max:500',
            'alamat_tanah' => 'required|string|max:500',
            'kabupaten_id' => 'required|integer',
            'kecamatan_id' => 'required|integer',
            'kelurahan_id' => 'required|integer',
            'luas' => 'required|numeric',
            'fungsi' => 'required|string|max:255',
        ]);

        try {
            DB::beginTransaction();

            // Cari atau buat user
            $no_ktp = $request->get('nik_pemohon');
            $alamat_email = $request->has('email') ? $request->get('email') : $no_ktp . '@email.com';

            $user = User::where('username', $no_ktp)
                ->orWhere('nik', $no_ktp)
                ->first();

            if ($user) {
                $user->update([
                    'name' => $request->get('nama_pemohon'),
                    'nik' => $no_ktp,
                    'email' => $alamat_email,
                    'phone' => $request->get('no_telp'),
                    'work' => $request->get('pekerjaan_pemohon'),
                    'address' => $request->get('alamat_pemohon'),
                ]);
            } else {
                $user = User::create([
                    'name' => $request->get('nama_pemohon'),
                    'username' => $no_ktp,
                    'nik' => $no_ktp,
                    'email' => $alamat_email,
                    'phone' => $request->get('no_telp'),
                    'work' => $request->get('pekerjaan_pemohon'),
                    'address' => $request->get('alamat_pemohon'),
                    'password' => bcrypt('123456'),
                    'active' => 1,
                ]);
                $user->assignRole('member');
            }

            // Buat KKPR
            $kkprData = $request->only([
                'alamat_tanah', 'kabupaten_id', 'kecamatan_id', 'kelurahan_id', 
                'luas', 'jns_sertifikat', 'thn_sertifikat', 'no_sertifikat', 
                'an_sertifikat', 'luas_sertifikat', 'penggunaan_awal', 
                'penggunaan_baru', 'longitude', 'lattitude', 'kepimilikan', 
                'rt', 'rw', 'status_penggunaan_tanah', 'jenis_kegiatan', 
                'jenis_kegiatan_lainnya', 'nib', 'alamat_kegiatan', 'NO_KEC', 
                'NO_KEL', 'luas_dimohon', 'luas_tanah', 'status_lahan', 
                'status_tanah', 'penggunaan_sekarang', 'jumlah_lantai', 
                'tinggi_bangunan', 'fungsi', 'no_nib', 'tgl_terbit', 'tgl_surat'
            ]);

            $kkprData['user_id'] = $user->id;
            $kkprData['jenis'] = 'usaha';
            $kkprData['luas_lantai'] = $request->get('luas_lantai');

            $kkpr = Kkpr::create($kkprData);

            // Simpan KBLI
            if ($request->has('kode_kbli') && $request->has('judul_kbli')) {
                $kode_kbli = $request->get('kode_kbli');
                $judul_kbli = $request->get('judul_kbli');

                foreach ($kode_kbli as $key => $kode) {
                    Kbli::create([
                        'jenis' => 'UMK',
                        'id_kkpr' => $kkpr->id,
                        'kode_kbli' => $kode,
                        'judul_kbli' => $judul_kbli[$key],
                    ]);
                }
            }

            // Simpan Koordinat
            if ($request->has('longi') && $request->has('lati')) {
                $longitude = $request->get('longi');
                $lattitude = $request->get('lati');

                foreach ($longitude as $key => $longi) {
                    Koordinat_kkpr::create([
                        'jenis' => 'UMK',
                        'id_kkpr' => $kkpr->id,
                        'longi' => $longi,
                        'lati' => $lattitude[$key],
                    ]);
                }
            }

            // Handle file uploads
            $this->handleFileUploads($request, $kkpr);

            // Buat riwayat
            Kkpr_riwayat::create([
                'kkpr_id' => $kkpr->id,
                'status_id' => '1',
                'status' => 'Pengajuan',
                'keterangan' => 'Pengajuan dilakukan oleh Pemohon'
            ]);

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
        $kkpr = Kkpr::with(['kkpr_kbli', 'kkpr_koordinat'])->findOrFail($id);
        
        $data = [
            'model' => $kkpr,
            'kbli' => $kkpr->kkpr_kbli,
            'koordinat' => $kkpr->kkpr_koordinat,
            'kabupaten' => DB::table('setup_kab')->where('NO_PROP', 35)->where('NO_KAB', 10)->pluck('NAMA_KAB', 'NO_KAB'),
            'kecamatan' => DB::table('setup_kec')->where('NO_PROP', 35)->where('NO_KAB', 10)->pluck('NAMA_KEC', 'NO_KEC'),
            'kelurahan' => DB::table('setup_kel_fix')->where('NO_PROP', 35)->where('NO_KAB', 10)->where('NO_KEC', $kkpr->NO_KEC)->pluck('NAMA_KEL', 'NO_KEL'),
            'title' => 'Kegiatan Kesesuaian Tata Ruang',
        ];

        return view($this->base_view . 'edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pemohon' => 'required|string|max:255',
            'nik_pemohon' => 'required|string|max:16',
            'no_telp' => 'required|string|max:20',
            'pekerjaan_pemohon' => 'required|string|max:255',
            'alamat_pemohon' => 'required|string|max:500',
            'alamat_tanah' => 'required|string|max:500',
            'kabupaten_id' => 'required|integer',
            'kecamatan_id' => 'required|integer',
            'kelurahan_id' => 'required|integer',
            'luas' => 'required|numeric',
            'fungsi' => 'required|string|max:255',
        ]);

        try {
            DB::beginTransaction();

            $kkpr = Kkpr::findOrFail($id);

            // Update user
            $no_ktp = $request->get('nik_pemohon');
            $alamat_email = $request->has('email') ? $request->get('email') : $no_ktp . '@email.com';

            $user = User::where('username', $no_ktp)
                ->orWhere('nik', $no_ktp)
                ->first();

            if ($user) {
                $user->update([
                    'name' => $request->get('nama_pemohon'),
                    'nik' => $no_ktp,
                    'email' => $alamat_email,
                    'phone' => $request->get('no_telp'),
                    'work' => $request->get('pekerjaan_pemohon'),
                    'address' => $request->get('alamat_pemohon'),
                ]);
            } else {
                $user = User::create([
                    'name' => $request->get('nama_pemohon'),
                    'username' => $no_ktp,
                    'nik' => $no_ktp,
                    'email' => $alamat_email,
                    'phone' => $request->get('no_telp'),
                    'work' => $request->get('pekerjaan_pemohon'),
                    'address' => $request->get('alamat_pemohon'),
                    'password' => bcrypt('123456'),
                    'active' => 1,
                ]);
                $user->assignRole('member');
            }

            // Update KKPR
            $kkprData = $request->only([
                'alamat_tanah', 'kabupaten_id', 'kecamatan_id', 'kelurahan_id', 
                'luas', 'jns_sertifikat', 'thn_sertifikat', 'no_sertifikat', 
                'an_sertifikat', 'luas_sertifikat', 'penggunaan_awal', 
                'penggunaan_baru', 'longitude', 'lattitude', 'kepimilikan', 
                'rt', 'rw', 'status_penggunaan_tanah', 'jenis_kegiatan', 
                'jenis_kegiatan_lainnya', 'fungsi', 'alamat_kegiatan', 'NO_KEC', 
                'NO_KEL', 'luas_dimohon', 'luas_tanah', 'status_lahan', 
                'status_tanah', 'penggunaan_sekarang', 'jumlah_lantai', 
                'tinggi_bangunan', 'tgl_terbit', 'tgl_surat', 'no_nib'
            ]);

            $kkprData['user_id'] = $user->id;
            $kkprData['luas_lantai'] = $request->get('luas_lantai');

            $kkpr->update($kkprData);

            // Update KBLI
            if ($request->has('kode_kbli') && $request->has('judul_kbli')) {
                // Hapus KBLI lama
                Kbli::where('id_kkpr', $kkpr->id)->where('jenis', 'UMK')->delete();

                // Tambah KBLI baru
                $kode_kbli = $request->get('kode_kbli');
                $judul_kbli = $request->get('judul_kbli');

                foreach ($kode_kbli as $key => $kode) {
                    Kbli::create([
                        'jenis' => 'UMK',
                        'id_kkpr' => $kkpr->id,
                        'kode_kbli' => $kode,
                        'judul_kbli' => $judul_kbli[$key],
                    ]);
                }
            }

            // Update Koordinat
            if ($request->has('longi') && $request->has('lati')) {
                // Hapus koordinat lama
                Koordinat_kkpr::where('id_kkpr', $kkpr->id)->where('jenis', 'UMK')->delete();

                // Tambah koordinat baru
                $longitude = $request->get('longi');
                $lattitude = $request->get('lati');

                foreach ($longitude as $key => $longi) {
                    Koordinat_kkpr::create([
                        'jenis' => 'UMK',
                        'id_kkpr' => $kkpr->id,
                        'longi' => $longi,
                        'lati' => $lattitude[$key],
                    ]);
                }
            }

            // Handle file uploads
            $this->handleFileUploads($request, $kkpr);

            DB::commit();

            return redirect()->route($this->path . '.index')
                ->with('success', 'Data berhasil diupdate kedalam sistem');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $kkpr = Kkpr::findOrFail($id);
            $kkpr->update(['deleted' => 1]);

            return redirect()->route($this->path . '.index')
                ->with('success', 'Data berhasil dihapus');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function toggleStatus(Request $request, $id)
    {
        try {
            $kkpr = Kkpr::findOrFail($id);
            $kkpr->update(['revisi' => $request->status]);

            return response()->json(['success' => true]);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function riwayat($id)
    {
        $riwayat = Kkpr_riwayat::where('kkpr_id', $id)->orderBy('status_id', 'asc')->get();
        $model = Kkpr::findOrFail($id);

        return view($this->base_view . 'riwayat', compact('riwayat', 'model'));
    }

    public function koordinat($id)
    {
        $koordinat = Koordinat_kkpr::where('id_kkpr', $id)->where('jenis', 'UMK')->get();
        $model = Kkpr::findOrFail($id);

        return view($this->base_view . 'koordinat', compact('koordinat', 'model'));
    }

    public function peta($id)
    {
        $kkpr = Kkpr::findOrFail($id);
        $koordinat = Koordinat_kkpr::where('id_kkpr', $id)->where('jenis', 'UMK')->get();

        $data = [
            'model' => $kkpr,
            'koordinat' => $koordinat,
            'title' => 'Map Persetujuan UMK',
        ];

        return view($this->base_view . 'peta', $data);
    }

    public function validasi($id)
    {
        $model = Kkpr::findOrFail($id);
        $kkpr = Kkpr_terbit::where('id_kkpr', $id)->get();
        $kbli = Kbli::where('id_kkpr', $id)->where('jenis', 'UMK')->get();

        $data = [
            'model' => $model,
            'user' => User::find($model->user_id),
            'kkpr' => $kkpr,
            'kbli' => $kbli,
            'title' => 'Validasi Dokumen',
            'petugas' => User::whereHas("permissions", function ($q) {
                $q->where("name", "Petugas TL");
            })->pluck('name', 'id'),
        ];

        return view($this->base_view . 'validasi', $data);
    }

    public function validasiStore(Request $request)
    {
        try {
            $model = Kkpr::findOrFail($request->id);
            $myuser = Auth::user();

            $model->update([
                'proses' => 7,
                'penerima' => $myuser->name,
                'tgl_terima' => date("Y-m-d"),
                'jam_terima' => date("h:i:s"),
            ]);

            $riwayat = Kkpr_riwayat::where('kkpr_id', $model->id)->where('status_id', 3)->first();
            if (!$riwayat) {
                Kkpr_riwayat::create([
                    'kkpr_id' => $model->id,
                    'status_id' => '3',
                    'status' => 'Validasi',
                    'keterangan' => 'Data dan persyaratan untuk permohonan UMK telah divalidasi'
                ]);
            } else {
                $riwayat->update(['keterangan' => 'Data dan persyaratan untuk permohonan UMK telah divalidasi']);
            }

            return response()->json(['success' => true, 'message' => 'Validasi berhasil']);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function validasiRevisi(Request $request)
    {
        try {
            $model = Kkpr::findOrFail($request->id);

            $model->update(['revisi' => 1]);

            $riwayat = Kkpr_riwayat::where('kkpr_id', $model->id)->where('status_id', 1)->first();
            if ($riwayat) {
                $riwayat->update([
                    'revisi_detail' => $request->revisi_detail,
                    'status' => 'Revisi',
                    'keterangan' => 'Pengajuan UMK belum diterima, silakan lakukan revisi dan kirim kembali dokumen ke validator'
                ]);
            }

            return response()->json(['success' => true, 'message' => 'Revisi berhasil']);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    private function handleFileUploads(Request $request, Kkpr $kkpr)
    {
        $folder = 'uploads/berkas/umk/' . $kkpr->id;
        if (!file_exists($folder)) {
            mkdir($folder, 0755, true);
        }

        $fileFields = [
            'dok_kepemilikan' => 'dokumen_kepemilikan',
            'dok_taru' => 'dok_taru',
            'sp_mandiri' => 'sp_mandiri',
            'f_nib' => 'f_nib',
            'f_kml' => 'kml',
            'f_ktp' => 'f_ktp',
            'f_sertifikat' => 'f_sertifikat',
            'f_siteplan' => 'f_siteplan',
            'f_akta' => 'f_akta',
        ];

        foreach ($fileFields as $field => $subfolder) {
            if ($request->hasFile($field)) {
                $subfolderPath = $folder . '/' . $subfolder;
                if (!file_exists($subfolderPath)) {
                    mkdir($subfolderPath, 0755, true);
                }

                $file = $request->file($field);
                $filename = $field . '.' . $file->guessClientExtension();
                $file->move($subfolderPath, $filename);

                $kkpr->update([$field => $filename]);
            }
        }

        // Handle GeoJSON
        $kml_geo = $request->get('kml_geojson');
        if ($kml_geo != null) {
            $dir_to_save = $folder . '/kml/';
            if (!is_dir($dir_to_save)) {
                mkdir($dir_to_save, 0755, true);
            }
            file_put_contents($dir_to_save . 'geojson.geojson', $kml_geo);
            $kkpr->update(['f_geojson' => 'geojson.geojson']);
        }
    }
}
