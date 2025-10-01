<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kkpr;
use App\Models\User;
use App\Models\Kkpr_riwayat;
use App\Models\Persyaratan;
use App\Models\BerkasKkpr;
use App\Models\Kkpr_syarat_pelaksanaan;
use App\Models\Kkpr_ketentuan_lain;
use App\Models\Kkpr_terbit;
use App\Models\Kkpr_gsb;
use App\Models\Kbli;
use App\Models\Koordinat_kkpr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class AdminKkprNonController extends Controller
{
    private $base_view = 'admin.kkprnon.';
    private $path = 'admin.kkprnon';

    public function index(Request $request)
    {
        $query = Kkpr::with(['user', 'kabupaten', 'kecamatan', 'kelurahan'])
            ->where('deleted', 0)
            ->where('jenis', 'non_usaha');

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
        $totalKkpr = Kkpr::where('deleted', 0)->where('jenis', 'non_usaha')->count();
        $pengajuan = Kkpr::where('deleted', 0)->where('jenis', 'non_usaha')->where('proses', 1)->count();
        $proses = Kkpr::where('deleted', 0)->where('jenis', 'non_usaha')->whereIn('proses', [2, 3, 4, 5, 6, 7, 8, 9])->count();
        $selesai = Kkpr::where('deleted', 0)->where('jenis', 'non_usaha')->where('proses', 10)->count();

        $data = [
            'title' => 'Penilaian KKPR Terbit Otomatis',
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
        $kkpr = Kkpr::with(['user', 'kabupaten', 'kecamatan', 'kelurahan', 'kkpr_kbli', 'kkpr_koordinat', 'kkpr_terbit'])
            ->findOrFail($id);

        $data = [
            'model' => $kkpr,
            'administrasi' => Persyaratan::where('jenis', 5)->get(),
            'title' => 'Detail Penilaian KKPR',
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
                $user->givePermissionTo('KKPR NON BERUSAHA');
            }

            // Buat KKPR
            $kkprData = $request->only([
                'alamat_tanah', 'kabupaten_id', 'kecamatan_id', 'kelurahan_id', 
                'luas', 'jns_sertifikat', 'thn_sertifikat', 'no_sertifikat', 
                'an_sertifikat', 'luas_sertifikat', 'penggunaan_awal', 
                'penggunaan_baru', 'longitude', 'lattitude', 'kepimilikan', 
                'rt', 'rw', 'fungsi', 'nib', 'alamat_kegiatan', 'NO_KEC', 
                'NO_KEL', 'luas_dimohon', 'luas_tanah', 'status_lahan', 
                'status_tanah', 'penggunaan_sekarang', 'jumlah_lantai', 
                'tinggi_bangunan', 'no_nib', 'tgl_terbit', 'tgl_surat'
            ]);

            $kkprData['user_id'] = $user->id;
            $kkprData['jenis'] = 'non_usaha';
            $kkprData['luas_lantai'] = $request->get('luas_lantai');

            $kkpr = Kkpr::create($kkprData);

            // Simpan KKPR Terbit
            if ($request->has('jml_kpr')) {
                $jml_kpr = $request->get('jml_kpr');
                for ($i = 1; $i <= $jml_kpr; $i++) {
                    $no_terbit = $request->get('no_terbit_' . $i);
                    $tgl_terbit = $request->get('tgl_terbit_kkpr_' . $i);

                    if ($no_terbit && $tgl_terbit) {
                        Kkpr_terbit::create([
                            'id_kkpr' => $kkpr->id,
                            'no_terbit' => $no_terbit,
                            'tgl_terbit' => $tgl_terbit,
                        ]);
                    }
                }
            }

            // Simpan KBLI
            if ($request->has('kode_kbli') && $request->has('judul_kbli')) {
                $kode_kbli = $request->get('kode_kbli');
                $judul_kbli = $request->get('judul_kbli');

                foreach ($kode_kbli as $key => $kode) {
                    Kbli::create([
                        'jenis' => 'KKPR',
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
                        'jenis' => 'KKPR',
                        'id_kkpr' => $kkpr->id,
                        'longi' => $longi,
                        'lati' => $lattitude[$key],
                    ]);
                }
            }

            // Handle file uploads
            $this->handleFileUploads($request, $kkpr, $no_ktp);

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
        $kkpr = Kkpr::with(['kkpr_terbit', 'kkpr_kbli', 'kkpr_koordinat'])->findOrFail($id);
        
        $data = [
            'model' => $kkpr,
            'kkpr' => $kkpr->kkpr_terbit,
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
                $user->givePermissionTo('KKPR NON BERUSAHA');
            }

            // Update KKPR
            $kkprData = $request->only([
                'alamat_tanah', 'kabupaten_id', 'kecamatan_id', 'kelurahan_id', 
                'luas', 'jns_sertifikat', 'thn_sertifikat', 'no_sertifikat', 
                'an_sertifikat', 'luas_sertifikat', 'penggunaan_awal', 
                'penggunaan_baru', 'longitude', 'lattitude', 'kepimilikan', 
                'rt', 'rw', 'fungsi', 'alamat_kegiatan', 'NO_KEC', 
                'NO_KEL', 'luas_dimohon', 'luas_tanah', 'status_lahan', 
                'status_tanah', 'penggunaan_sekarang', 'jumlah_lantai', 
                'tinggi_bangunan', 'tgl_terbit', 'tgl_surat', 'no_nib', 
                'tgl_kkpr', 'no_kkpr'
            ]);

            $kkprData['user_id'] = $user->id;
            $kkprData['jenis'] = 'non_usaha';
            $kkprData['luas_lantai'] = $request->get('luas_lantai');

            $kkpr->update($kkprData);

            // Update KKPR Terbit
            if ($request->has('jml_kpr')) {
                $jml_kpr = $request->get('jml_kpr');
                $id_ikut = [];

                for ($n = 1; $n <= $jml_kpr + 10; $n++) {
                    if ($request->get('idne_kpr_' . $n) != null) {
                        array_push($id_ikut, $request->get('idne_kpr_' . $n));
                    }
                }

                // Hapus yang tidak ikut
                $hapus_tidak_ikut = Kkpr_terbit::whereNotIn('id', $id_ikut)->where('id_kkpr', $kkpr->id);
                foreach ($hapus_tidak_ikut->get() as $hps) {
                    if ($hps->file_kkpr != null && $hps->file_kkpr != '') {
                        $folder = 'uploads/berkas/kkpr/' . $kkpr->id . '/f_kkpr';
                        $originalPath = $folder . DIRECTORY_SEPARATOR . $hps->file_kkpr;
                        File::delete($originalPath);
                    }
                }
                $hapus_tidak_ikut->delete();

                // Update atau insert
                for ($n = 1; $n <= $jml_kpr + 10; $n++) {
                    if ($request->get('idne_kpr_' . $n) != null && $request->get('idne_kpr_' . $n) != '' && $request->get('idne_kpr_' . $n) != 'null') {
                        // Update existing
                        $kprModel = Kkpr_terbit::findOrFail($request->get('idne_kpr_' . $n));
                        $kprModel->no_terbit = $request->get('no_terbit_' . $n);
                        $kprModel->tgl_terbit = $request->get('tgl_terbit_kkpr_' . $n);

                        if ($request->hasFile('f_kkpr_' . $n)) {
                            $this->handleKkprFileUpload($request, $n, $kkpr, $kprModel);
                        }

                        $kprModel->save();
                    } else {
                        // Insert new
                        if ($request->get('no_terbit_' . $n) != null || $request->get('tgl_terbit_kkpr_' . $n) != null) {
                            $filename = null;
                            if ($request->hasFile('f_kkpr_' . $n)) {
                                $filename = $this->uploadKkprFile($request, $n, $kkpr);
                            }

                            Kkpr_terbit::create([
                                'id_kkpr' => $kkpr->id,
                                'no_terbit' => $request->get('no_terbit_' . $n),
                                'tgl_terbit' => $request->get('tgl_terbit_kkpr_' . $n),
                                'file_kkpr' => $filename,
                            ]);
                        }
                    }
                }
            }

            // Update KBLI
            if ($request->has('kode_kbli') && $request->has('judul_kbli')) {
                Kbli::where('id_kkpr', $kkpr->id)->where('jenis', 'KKPR')->delete();

                $kode_kbli = $request->get('kode_kbli');
                $judul_kbli = $request->get('judul_kbli');

                foreach ($kode_kbli as $key => $kode) {
                    Kbli::create([
                        'jenis' => 'KKPR',
                        'id_kkpr' => $kkpr->id,
                        'kode_kbli' => $kode,
                        'judul_kbli' => $judul_kbli[$key],
                    ]);
                }
            }

            // Update Koordinat
            if ($request->has('longi') && $request->has('lati')) {
                Koordinat_kkpr::where('id_kkpr', $kkpr->id)->where('jenis', 'KKPR')->delete();

                $longitude = $request->get('longi');
                $lattitude = $request->get('lati');

                foreach ($longitude as $key => $longi) {
                    Koordinat_kkpr::create([
                        'jenis' => 'KKPR',
                        'id_kkpr' => $kkpr->id,
                        'longi' => $longi,
                        'lati' => $lattitude[$key],
                    ]);
                }
            }

            // Handle file uploads
            $this->handleFileUploads($request, $kkpr, $no_ktp);

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

    public function riwayat($id)
    {
        $riwayat = Kkpr_riwayat::where('kkpr_id', $id)->orderBy('status_id', 'asc')->get();
        $model = Kkpr::findOrFail($id);

        return view($this->base_view . 'riwayat', compact('riwayat', 'model'));
    }

    public function koordinat($id)
    {
        $koordinat = Koordinat_kkpr::where('id_kkpr', $id)->where('jenis', 'KKPR')->get();
        $model = Kkpr::findOrFail($id);

        return view($this->base_view . 'koordinat', compact('koordinat', 'model'));
    }

    public function peta($id)
    {
        $kkpr = Kkpr::findOrFail($id);
        $koordinat = Koordinat_kkpr::where('id_kkpr', $id)->where('jenis', 'KKPR')->get();

        $data = [
            'model' => $kkpr,
            'koordinat' => $koordinat,
            'title' => 'Map Penilaian KKPR',
        ];

        return view($this->base_view . 'peta', $data);
    }

    public function validasi($id)
    {
        $model = Kkpr::findOrFail($id);
        $kkpr = Kkpr_terbit::where('id_kkpr', $id)->get();
        $kbli = Kbli::where('id_kkpr', $id)->where('jenis', 'KKPR')->get();

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
                    'keterangan' => 'Data dan persyaratan untuk permohonan KKPR telah divalidasi'
                ]);
            } else {
                $riwayat->update(['keterangan' => 'Data dan persyaratan untuk permohonan KKPR telah divalidasi']);
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
                    'keterangan' => 'Pengajuan KKPR belum diterima, silakan lakukan revisi dan kirim kembali dokumen ke validator'
                ]);
            }

            return response()->json(['success' => true, 'message' => 'Revisi berhasil']);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    private function handleFileUploads(Request $request, Kkpr $kkpr, $no_ktp)
    {
        // Upload KTP
        if ($request->hasFile('fotocopy_ktp')) {
            $folderKtp = 'uploads/images/ktp';
            if (!file_exists($folderKtp)) {
                mkdir($folderKtp, 0755, true);
            }
            $fKtp = $request->file('fotocopy_ktp');
            $filename = $no_ktp . '.' . $fKtp->guessClientExtension();
            $fKtp->move($folderKtp, $filename);

            $kkpr->user->update(['ktp' => $filename]);
        }

        // Upload KTP Pemilik
        if ($request->hasFile('ktp_pemilik')) {
            $folderKtpPemilik = 'uploads/images/ktp/pemilik/' . $kkpr->id;
            if (!file_exists($folderKtpPemilik)) {
                mkdir($folderKtpPemilik, 0755, true);
            }
            $fKtp = $request->file('ktp_pemilik');
            $filename = 'ktp_pemilik.' . $fKtp->guessClientExtension();
            $fKtp->move($folderKtpPemilik, $filename);

            $kkpr->update(['ktp_pemilik' => $filename]);
        }

        $folder = 'uploads/berkas/kkpr/' . $kkpr->id;
        if (!file_exists($folder)) {
            mkdir($folder, 0755, true);
        }

        $fileFields = [
            'dok_kepemilikan' => 'dokumen_kepemilikan',
            'dok_taru' => 'dok_taru',
            'f_nib' => 'f_nib',
            'f_kml' => 'kml',
            'f_ktp' => 'f_ktp',
            'f_sertifikat' => 'f_sertifikat',
            'f_siteplan' => 'f_siteplan',
            'f_akta' => 'f_akta',
            'f_kkpr' => 'f_kkpr',
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
            file_put_contents($dir_to_save . 'geojson.geojson', json_encode($kml_geo));
            $kkpr->update(['f_geojson' => 'geojson.geojson']);
        }

        // Upload Photos
        $photos = ['foto_utara', 'foto_selatan', 'foto_barat', 'foto_timur'];
        foreach ($photos as $photo) {
            if ($request->hasFile($photo)) {
                $file = $request->file($photo);
                $filename = $photo . '.' . $file->guessClientExtension();
                $file->move($folder, $filename);
                $kkpr->update([$photo => $filename]);
            }
        }

        // Handle Persyaratan
        $administrasi = Persyaratan::where('jenis', 5)->where('status', true)->where('bysistem', 0)->get();
        if (isset($administrasi)) {
            foreach ($administrasi as $adm) {
                $status = 0;
                if ($request->hasFile('persyaratan' . $adm->id)) {
                    $upl = $request->file('persyaratan' . $adm->id);
                    $this->saveBerkasPdf($kkpr, $upl, $status, $folder, $adm, $adm->keterangan);
                } else {
                    $this->saveBerkas($kkpr, $status, $adm, $adm->keterangan);
                }
            }
        }
    }

    private function handleKkprFileUpload($request, $n, $kkpr, $kprModel)
    {
        $folder = 'uploads/berkas/kkpr/' . $kkpr->id . '/f_kkpr';
        if (!file_exists($folder)) {
            mkdir($folder, 0755, true);
        }

        // Delete old file
        if ($kprModel->file_kkpr) {
            $originalPath = $folder . DIRECTORY_SEPARATOR . $kprModel->file_kkpr;
            File::delete($originalPath);
        }

        $fKkpr = $request->file('f_kkpr_' . $n);
        $filename = 'f_kkpr_' . $fKkpr->getFilename() . '.' . $fKkpr->guessClientExtension();
        $fKkpr->move($folder, $filename);

        $kprModel->file_kkpr = $filename;
    }

    private function uploadKkprFile($request, $n, $kkpr)
    {
        $folder = 'uploads/berkas/kkpr/' . $kkpr->id . '/f_kkpr';
        if (!file_exists($folder)) {
            mkdir($folder, 0755, true);
        }

        $fKkpr = $request->file('f_kkpr_' . $n);
        $filename = 'f_kkpr_' . $fKkpr->getFilename() . '.' . $fKkpr->guessClientExtension();
        $fKkpr->move($folder, $filename);

        return $filename;
    }

    private function saveBerkasPdf($model, $upl, $status, $folder, $adm, $keterangan)
    {
        $filename = Str::slug($adm->nama) . '.' . $upl->guessClientExtension();
        $upl->move($folder, $filename);

        $berkas = BerkasKkpr::create([
            'kkpr_id' => $model->id,
            'persyaratan_id' => $adm->id,
            'filename' => $filename,
            'status' => $status,
            'keterangan' => $keterangan
        ]);

        return $berkas;
    }

    private function saveBerkas($model, $status, $adm, $keterangan)
    {
        $berkas = BerkasKkpr::create([
            'kkpr_id' => $model->id,
            'persyaratan_id' => $adm->id,
            'status' => $status,
            'keterangan' => $keterangan
        ]);

        return $berkas;
    }

    public function uploadDraft(Request $request)
    {
        try {
            $request->validate([
                'kkpr_id' => 'required',
                'draft_file' => 'required|mimes:pdf|max:10240'
            ]);

            $model = Kkpr::findOrFail($request->kkpr_id);

            $folder = 'uploads/berkas/kkpr/' . $model->id;
            if (!file_exists($folder)) {
                mkdir($folder, 0755, true);
            }

            if ($model->draft_file && file_exists($folder . '/' . $model->draft_file)) {
                unlink($folder . '/' . $model->draft_file);
            }

            $file = $request->file('draft_file');
            $filename = 'draft_' . time() . '.pdf';
            $file->move($folder, $filename);

            $updateData = ['draft_file' => $filename];

            if ($model->proses != 10) {
                $updateData['proses'] = 10;
            }

            $model->update($updateData);

            $riwayat = Kkpr_riwayat::where('kkpr_id', $model->id)->where('status_id', 10)->first();
            if (!$riwayat) {
                Kkpr_riwayat::create([
                    'kkpr_id' => $model->id,
                    'status_id' => '10',
                    'status' => 'Selesai',
                    'keterangan' => 'Dokumen hasil penilaian telah diupload'
                ]);
            } else {
                $riwayat->update(['keterangan' => 'Dokumen hasil penilaian telah diperbarui']);
            }

            $message = $model->proses == 10 ?
                'Hasil penilaian berhasil diperbarui' :
                'Draft berhasil diupload dan proses telah selesai';

            return redirect()->route($this->path . '.index')
                ->with('success', $message);

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat upload dokumen: ' . $e->getMessage());
        }
    }
}

