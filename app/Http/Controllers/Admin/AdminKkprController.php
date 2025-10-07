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
        // Custom validation untuk NIK
        $request->merge([
            'nik_pemohon' => preg_replace('/[^0-9]/', '', $request->nik_pemohon)
        ]);

        // Debug: Log request data
        \Illuminate\Support\Facades\Log::info('KKPR Store Request', [
            'nik_pemohon' => $request->nik_pemohon,
            'nama_pemohon' => $request->nama_pemohon,
            'has_kml_geojson' => $request->has('kml_geojson'),
            'kml_geojson_length' => strlen($request->kml_geojson ?? ''),
            'has_kode_kbli' => $request->has('kode_kbli'),
            'kode_kbli_count' => count($request->kode_kbli ?? []),
        ]);

        try {
            DB::beginTransaction();

            // Cari atau buat user (sesuai logic lama)
            $no_ktp = $request->get('nik_pemohon');
            $alamat_email = $no_ktp . '@email.com';

            if ($request->has('email')) {
                $alamat_email = $request->get('email');
            }

            $user = User::where('username', $no_ktp)
                ->orWhere('nik', $no_ktp)
                ->first();

            if (isset($user)) {
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

            // Buat KKPR (sesuai logic lama)
            $req = $request->only('alamat_tanah', 'kabupaten_id', 'kecamatan_id', 'kelurahan_id', 'luas', 'jns_sertifikat', 'thn_sertifikat', 'no_sertifikat', 'an_sertifikat', 'luas_sertifikat', 'penggunaan_awal', 'penggunaan_baru', 'longitude', 'lattitude', 'kepimilikan', 'rt', 'rw');

            $req['user_id'] = $user->id;
            $req['jenis'] = 'usaha';
            $req['status_penggunaan_tanah'] = $request->get('status_penggunaan_tanah');
            $req['jenis_kegiatan'] = $request->get('jenis_kegiatan');
            $req['jenis_kegiatan_lainnya'] = $request->get('jenis_kegiatan_lainnya');

            $req['nib'] = $request->get('nib');
            $req['alamat_kegiatan'] = $request->get('alamat_kegiatan');
            $req['NO_KEC'] = $request->get('NO_KEC');
            $req['NO_KEL'] = $request->get('NO_KEL');
            $req['luas_dimohon'] = $request->get('luas_dimohon');
            $req['luas_tanah'] = $request->get('luas_tanah');
            $req['status_lahan'] = $request->get('status_lahan');
            $req['status_tanah'] = $request->get('status_tanah');
            $req['penggunaan_sekarang'] = $request->get('penggunaan_sekarang');
            $req['jumlah_lantai'] = $request->get('jumlah_lantai');
            $req['tinggi_bangunan'] = $request->get('tinggi_bangunan');

            // Simpan luas_lantai langsung tanpa json_encode tambahan
            $req['luas_lantai'] = $request->get('luas_lantai');

            $req['fungsi'] = $request->get('fungsi');
            $req['no_nib'] = $request->get('no_nib');
            $req['tgl_terbit'] = $request->get('tgl_terbit');
            $req['tgl_surat'] = $request->get('tgl_surat');

            $model = Kkpr::create($req);

            // Simpan KBLI (sesuai logic lama)
            $kbli = $request->only('kode_kbli', 'judul_kbli');
            if (isset($kbli)) {
                $kbli_cek = $model->kkpr_kbli;
                if ($kbli_cek->count()) {
                    foreach ($kbli_cek as $ada) {
                        $ada->delete();
                    }
                }

                $kode = $kbli['kode_kbli'];
                $judul = $kbli['judul_kbli'];

                foreach ($kode as $key => $n) {
                    Kbli::create([
                        'jenis' => 'UMK',
                        'id_kkpr' => $model->id,
                        'kode_kbli' => $kode[$key],
                        'judul_kbli' => $judul[$key],
                    ]);
                }
            }

            // Simpan Koordinat (sesuai logic lama)
            $reqkor = $request->only('longi', 'lati');
            if (isset($reqkor)) {
                $koordinat = $model->kkpr_koordinat;
                if ($koordinat->count()) {
                    foreach ($koordinat as $kor) {
                        $kor->delete();
                    }
                }

                $longitude = $reqkor['longi'];
                $lattitude = $reqkor['lati'];

                foreach ($longitude as $key => $n) {
                    Koordinat_kkpr::create([
                        'jenis' => 'UMK',
                        'id_kkpr' => $model->id,
                        'longi' => $longitude[$key],
                        'lati' => $lattitude[$key],
                    ]);
                }
            }

            // Handle file uploads (sesuai logic lama)
            $folder = 'uploads/berkas/umk/' . $model->id;
            if (!file_exists($folder)) {
                mkdir($folder, 0755, true);
            }

            if ($request->hasFile('dok_kepemilikan')) {
                if (!file_exists($folder . '/dokumen_kepemilikan')) {
                    mkdir($folder . '/dokumen_kepemilikan', 0755, true);
                }
                $fDok = $request->file('dok_kepemilikan');
                $filename = 'dok_kepemilikan.' . $fDok->guessClientExtension();
                $fDok->move($folder . '/dokumen_kepemilikan', $filename);

                $model->update(['dok_kepemilikan' => $filename]);
            }

            if ($request->hasFile('dok_taru')) {
                if (!file_exists($folder . '/dok_taru')) {
                    mkdir($folder . '/dok_taru', 0755, true);
                }
                $fTaru = $request->file('dok_taru');
                $filename = 'dok_taru.' . $fTaru->guessClientExtension();
                $fTaru->move($folder . '/dok_taru', $filename);

                $model->update(['dok_taru' => $filename]);
            }

            if ($request->hasFile('sp_mandiri')) {
                if (!file_exists($folder . '/sp_mandiri')) {
                    mkdir($folder . '/sp_mandiri', 0755, true);
                }
                $fMandiri = $request->file('sp_mandiri');
                $filename = 'sp_mandiri.' . $fMandiri->guessClientExtension();
                $fMandiri->move($folder . '/sp_mandiri', $filename);

                $model->update(['sp_mandiri' => $filename]);
            }

            if ($request->hasFile('f_nib')) {
                if (!file_exists($folder . '/f_nib')) {
                    mkdir($folder . '/f_nib', 0755, true);
                }
                $fNib = $request->file('f_nib');
                $filename = 'f_nib.' . $fNib->guessClientExtension();
                $fNib->move($folder . '/f_nib', $filename);

                $model->update(['f_nib' => $filename]);
            }

            if ($request->hasFile('f_kml')) {
                if (!file_exists($folder . '/kml')) {
                    mkdir($folder . '/kml', 0755, true);
                }
                $fKml = $request->file('f_kml');
                $filename = 'kml.' . $fKml->getClientOriginalExtension();
                $fKml->move($folder . '/kml', $filename);

                $model->update(['f_kml' => $filename]);
            }

            $kml_geo = $request->get('kml_geojson');
            if ($kml_geo != null) {
                $dir_to_save = $folder . '/kml/';
                if (!is_dir($dir_to_save)) {
                    mkdir($folder . '/kml/', 0755, true);
                }
                file_put_contents($dir_to_save . 'geojson.geojson', $kml_geo);
                $model->update(['f_geojson' => 'geojson.geojson']);
            }

            if ($request->hasFile('f_ktp')) {
                if (!file_exists($folder . '/f_ktp')) {
                    mkdir($folder . '/f_ktp', 0755, true);
                }
                $fKtp = $request->file('f_ktp');
                $filename = 'f_ktp.' . $fKtp->guessClientExtension();
                $fKtp->move($folder . '/f_ktp', $filename);

                $model->update(['f_ktp' => $filename]);
            }

            if ($request->hasFile('f_sertifikat')) {
                if (!file_exists($folder . '/f_sertifikat')) {
                    mkdir($folder . '/f_sertifikat', 0755, true);
                }
                $fSertifikat = $request->file('f_sertifikat');
                $filename = 'f_sertifikat.' . $fSertifikat->guessClientExtension();
                $fSertifikat->move($folder . '/f_sertifikat', $filename);

                $model->update(['f_sertifikat' => $filename]);
            }

            if ($request->hasFile('f_siteplan')) {
                if (!file_exists($folder . '/f_siteplan')) {
                    mkdir($folder . '/f_siteplan', 0755, true);
                }
                $fSiteplan = $request->file('f_siteplan');
                $filename = 'f_siteplan.' . $fSiteplan->guessClientExtension();
                $fSiteplan->move($folder . '/f_siteplan', $filename);

                $model->update(['f_siteplan' => $filename]);
            }

            if ($request->hasFile('f_akta')) {
                if (!file_exists($folder . '/f_akta')) {
                    mkdir($folder . '/f_akta', 0755, true);
                }
                $fAkta = $request->file('f_akta');
                $filename = 'f_akta.' . $fAkta->guessClientExtension();
                $fAkta->move($folder . '/f_akta', $filename);

                $model->update(['f_akta' => $filename]);
            }

            // Buat riwayat (sesuai logic lama)
            $riwayat = Kkpr_riwayat::where('kkpr_id', $model->id)->where('status_id', 1)->first();
            if (!$riwayat) {
                Kkpr_riwayat::create(['kkpr_id' => $model->id, 'status_id' => '1', 'status' => 'Pengajuan', 'keterangan' => 'Pengajuan dilakukan oleh Pemohon']);
            } else {
                Kkpr_riwayat::where('id', $riwayat->id)->update(array('keterangan' => 'Pengajuan dilakukan oleh Pemohon'));
            }

            DB::commit();

            return redirect()->route($this->path . '.index')->withSuccess('Data berhasil disimpan kedalam sistem');

        } catch (\Exception $e) {
            DB::rollback();
            
            // Log error untuk debugging
            \Illuminate\Support\Facades\Log::error('KKPR Store Error: ' . $e->getMessage(), [
                'request_data' => $request->except(['f_ktp', 'f_nib', 'sp_mandiri', 'dok_kepemilikan', 'f_sertifikat', 'f_siteplan', 'f_akta', 'f_kml']),
                'user_id' => null,
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
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

    // public function riwayat($id)
    // {
    //     $riwayat = Kkpr_riwayat::where('kkpr_id', $id)->orderBy('status_id', 'asc')->get();
    //     $model = Kkpr::findOrFail($id);

    //     return view($this->base_view . 'riwayat', compact('riwayat', 'model'));
    // }

    public function getRiwayatData($id)
    {
        $riwayat = Kkpr_riwayat::where('kkpr_id', $id)->orderBy('status_id', 'asc')->get();
        $model = Kkpr::findOrFail($id);
        
        return response()->json([
            'success' => true,
            'riwayat' => $riwayat,
            'model' => $model
        ]);
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

}
