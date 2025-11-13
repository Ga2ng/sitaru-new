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
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AdminKkprNonController extends Controller
{
    private $base_view = 'admin.kkprnon.';
    private $path = 'admin.kkprnon';

    public function index(Request $request)
    {
        $query = Kkpr::with(['user', 'kabupaten', 'kecamatan', 'kelurahan'])
            // ->where('deleted', 0)
            ->where('jenis', 'umk');

        // Filter berdasarkan role - DISABLED untuk menampilkan semua data
        // Semua role bisa melihat semua data di index
        // if (Gate::allows('Kabid')) {
        //     $query->where('proses', 8);
        // } elseif (Gate::allows('Kadin PTSP')) {
        //     $query->where('proses', 9);
        // } elseif (Gate::allows('Analis')) {
        //     $query->where(function ($q) {
        //         $q->where('proses', 7)
        //           ->orWhere('proses', 8)
        //           ->orWhere('status_analisa', 'survey')
        //           ->orWhere('status_analisa', 'analisa');
        //     });
        // }

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
        $totalKkpr = Kkpr::where('deleted', 0)->where('jenis', 'umk')->count();
        $pengajuan = Kkpr::where('deleted', 0)->where('jenis', 'umk')->where('proses', 1)->count();
        $proses = Kkpr::where('deleted', 0)->where('jenis', 'umk')->whereIn('proses', [2, 3, 4, 5, 6, 7, 8, 9])->count();
        $selesai = Kkpr::where('deleted', 0)->where('jenis', 'umk')->where('proses', 10)->count();

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
        $kkpr = Kkpr::with(['user', 'kabupaten', 'kecamatan', 'kelurahan', 'kkpr_kbli', 'kkpr_koordinat'])
            ->where('jenis', 'umk')
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
        $last   = Kkpr::orderBy('id', 'desc')->first();
        $lastid = 1;
        if (isset($last)) {
            $lastid = $last->id + 1;
        }

        $no_ktp       = $request->get('nik_pemohon');
        $alamat_email = $no_ktp . '@email.com';

        if ($request->has('email')) {
            $alamat_email = $request->get('email');
        }

        $user = User::where('username', $no_ktp)
                    ->orWhere('nik', $no_ktp)
                    ->first();
                    
        if (isset($user)) {
            $user->update([
                'name'     => $request->get('nama_pemohon'),
                'nik'      => $no_ktp,
                'email'    => $alamat_email,
                'phone'    => $request->get('no_telp'),
                'work'     => $request->get('pekerjaan_pemohon'),
                'address'  => $request->get('alamat_pemohon'),
            ]);
        } else {
            $user = User::create([
                'name'     => $request->get('nama_pemohon'),
                'username' => $no_ktp,
                'nik'      => $no_ktp,
                'email'    => $alamat_email,
                'phone'    => $request->get('no_telp'),
                'work'     => $request->get('pekerjaan_pemohon'),
                'address'  => $request->get('alamat_pemohon'),
                'password' => bcrypt('123456'),
                'active'   => 1,
            ]);
            $user->assignRole('member')->givePermissionTo('KKPR NON BERUSAHA');
        }

        $req                      = $request->only('kabupaten_id', 'kecamatan_id', 'kelurahan_id', 'luas', 'jns_sertifikat', 'thn_sertifikat', 'no_sertifikat', 'an_sertifikat', 'luas_sertifikat', 'penggunaan_awal', 'penggunaan_baru', 'longitude', 'lattitude', 'kepimilikan','rt', 'rw');
        $req['user_id']           = $user->id;
        $req['jenis']             = 'umk';
        $req['fungsi']            = $request->get('fungsi');
        $req['alamat_kegiatan']   = $request->get('alamat_kegiatan');
        $req['NO_KEC']            = $request->get('NO_KEC');
        $req['NO_KEL']            = $request->get('NO_KEL');
        $req['luas_dimohon']      = $request->get('luas_dimohon');
        $req['luas_tanah']        = $request->get('luas_tanah');
        
        // Handle status lahan - priority: status_lahan_lainnya_input > status_lahan dari request
        $statusLahanFromRequest = $request->get('status_lahan', '');
        $statusLahanLainnyaInput = $request->get('status_lahan_lainnya_input', '');
        
        // Priority 1: Jika ada status_lahan_lainnya_input yang terisi, gunakan itu
        $statusLahan = '';
        if (!empty(trim($statusLahanLainnyaInput))) {
            $statusLahan = trim($statusLahanLainnyaInput);
        } 
        // Priority 2: Jika tidak ada custom input atau kosong, gunakan status_lahan dari request
        elseif (!empty($statusLahanFromRequest)) {
            $statusLahan = $statusLahanFromRequest;
        }
        
        // Set status_lahan ke req
        if (!empty($statusLahan)) {
            $req['status_lahan'] = $statusLahan;
        }
        
        $req['status_tanah']      = $request->get('status_tanah');
        $req['penggunaan_sekarang'] = $request->get('penggunaan_sekarang');
        $req['jumlah_lantai']     = $request->get('jumlah_lantai');
        $req['tinggi_bangunan']   = $request->get('tinggi_bangunan');
        // Handle luas_lantai array - filter null/NaN/undefined
        $luasLantai = $request->get('luas_lantai');
        if (is_array($luasLantai)) {
            $req['luas_lantai'] = array_values(array_filter($luasLantai, function($value) {
                return $value !== null && $value !== '' && $value !== 'NaN' && $value !== 'undefined';
            }));
        } else {
            $req['luas_lantai'] = $luasLantai;
        }
        $req['tgl_surat']         = $request->get('tgl_surat');
        $req['tgl_terbit']        = $request->get('tgl_terbit');
        $req['no_nib']            = $request->get('no_nib');
        $req['badan_hukum']       = $request->get('badan_hukum');
        $req['risiko_kegiatan']   = $request->get('risiko_kegiatan');
        $req['kategori_umk']      = $request->get('kategori_umk');

        $model = Kkpr::create($req);

        $kkpr_terbit = $request->only('no_terbit', 'tgl_terbit_kkpr');
        if (isset($kkpr_terbit)) {
            $kkpr_terbit_cek = $model->kkpr_terbit;
            if ($kkpr_terbit_cek->count()) {
                foreach ($kkpr_terbit_cek as $ada) {
                    $ada->delete();
                }
            }

            $jml_kpr = $request->get('jml_kpr');
            for($i = 1; $i <= $jml_kpr; $i++) {
                $no_terbit = $request->get('no_terbit_'.$i);
                $tgl_terbit = $request->get('tgl_terbit_kkpr_'.$i);
                
                if($no_terbit && $tgl_terbit) {
                    Kkpr_terbit::create([
                        'id_kkpr'    => $model->id,
                        'no_terbit'  => $no_terbit,
                        'tgl_terbit' => $tgl_terbit,
                    ]);
                }
            }
        }

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
                    'jenis'         => 'KKPR',
                    'id_kkpr'       => $model->id,
                    'kode_kbli'     => $kode[$key],
                    'judul_kbli'    => $judul[$key],
                ]);
            }
        }

        // Handle koordinat dari KML atau input manual
        $inputMethod = $request->get('input_method', 'kml');
        
        if ($inputMethod === 'manual') {
            // Handle koordinat dari input manual (JSON array)
            $koordinatDimohon = $request->get('koordinat_dimohon');
            if ($koordinatDimohon) {
                $koordinat = $model->kkpr_koordinat;
                if ($koordinat->count()) {
                    foreach ($koordinat as $kor) {
                        $kor->delete();
                    }
                }
                
                try {
                    $coordinates = json_decode($koordinatDimohon, true);
                    if (is_array($coordinates) && count($coordinates) > 0) {
                        foreach ($coordinates as $coord) {
                            if (isset($coord['latitude']) && isset($coord['longitude'])) {
                                Koordinat_kkpr::create([
                                    'jenis' => 'UMK',
                                    'id_kkpr' => $model->id,
                                    'lati' => $coord['latitude'],
                                    'longi' => $coord['longitude'],
                                ]);
                            }
                        }
                    }
                } catch (\Exception $e) {
                    // Handle error jika JSON tidak valid
                }
            }
        } else {
            // Handle koordinat dari KML (logic yang sudah ada)
            $reqkor = $request->only('longi', 'lati');
            if (isset($reqkor) && !empty($reqkor['longi']) && !empty($reqkor['lati'])) {
                $koordinat = $model->kkpr_koordinat;
                if ($koordinat->count()) {
                    foreach ($koordinat as $kor) {
                        $kor->delete();
                    }
                }

                $longitude = $reqkor['longi'];
                $lattitude = $reqkor['lati'];

                if (is_array($longitude) && is_array($lattitude)) {
                    foreach ($longitude as $key => $n) {
                        if (isset($lattitude[$key]) && !empty($longitude[$key]) && !empty($lattitude[$key])) {
                            Koordinat_kkpr::create([
                                'jenis' => 'UMK',
                                'id_kkpr' => $model->id,
                                'longi' => $longitude[$key],
                                'lati' => $lattitude[$key],
                            ]);
                        }
                    }
                }
            }
        }


        $folderKtp = 'uploads/images/ktp';
        if ($request->hasFile('fotocopy_ktp')) {
            if (!file_exists($folderKtp)) {
                mkdir($folderKtp, 0755, true);
            }
            $fKtp      = $request->file('fotocopy_ktp');
            $filename = $no_ktp.'.'.$fKtp->guessClientExtension();
            $fKtp->move($folderKtp, $filename);

            $user->update(['ktp'=>$filename]);
        }

        $folderKtpPemilik = 'uploads/images/ktp/pemilik/' . $model->id;
        if ($request->hasFile('ktp_pemilik')) {
            if (!file_exists($folderKtpPemilik)) {
                mkdir($folderKtpPemilik, 0755, true);
            }
            $fKtp      = $request->file('ktp_pemilik');
            $filename = 'ktp_pemilik.'.$fKtp->guessClientExtension();
            $fKtp->move($folderKtpPemilik, $filename);

            $model->update(['ktp_pemilik'=>$filename]);
        }

        $folder = 'uploads/berkas/umk/' . $model->id;
        if (!file_exists($folder)) {
            mkdir($folder, 0755, true);
        }

        if ($request->hasFile('dok_kepemilikan')) {
            if (!file_exists($folder.'/dokumen_kepemilikan')) {
                mkdir($folder.'/dokumen_kepemilikan', 0755, true);
            }
            $fDok      = $request->file('dok_kepemilikan');
            $filename = 'dok_kepemilikan.'.$fDok->guessClientExtension();
            $fDok->move($folder.'/dokumen_kepemilikan', $filename);

            $model->update(['dok_kepemilikan'=>$filename]);
        }

        if ($request->hasFile('dok_taru')) {
            if (!file_exists($folder.'/dok_taru')) {
                mkdir($folder.'/dok_taru', 0755, true);
            }
            $fTaru      = $request->file('dok_taru');
            $filename = 'dok_taru.'.$fTaru->guessClientExtension();
            $fTaru->move($folder.'/dok_taru', $filename);

            $model->update(['dok_taru'=>$filename]);
        }

        if ($request->hasFile('f_nib')) {
            if (!file_exists($folder.'/f_nib')) {
                mkdir($folder.'/f_nib', 0755, true);
            }
            $fNib      = $request->file('f_nib');
            $filename = 'f_nib.'.$fNib->guessClientExtension();
            $fNib->move($folder.'/f_nib', $filename);

            $model->update(['f_nib'=>$filename]);
        }

        if ($request->hasFile('f_kml')) {
            if (!file_exists($folder.'/kml')) {
                mkdir($folder.'/kml', 0755, true);
            }
            $fKml      = $request->file('f_kml');
            $filename = 'kml.'.$fKml->getClientOriginalExtension();
            $fKml->move($folder.'/kml', $filename);

            $model->update(['f_kml'=>$filename]);
        }
        
        $kml_geo    = $request->get('kml_geojson');
        if($kml_geo != null){
            $dir_to_save = $folder.'/kml/';
            if (!is_dir($dir_to_save)) {
                mkdir($folder.'/kml/', 0755, true);
            }
            file_put_contents($dir_to_save.'geojson.geojson', json_encode($kml_geo));
            $model->update(['f_geojson'=>'geojson.geojson']);
        }

        if ($request->hasFile('f_ktp')) {
            if (!file_exists($folder.'/f_ktp')) {
                mkdir($folder.'/f_ktp', 0755, true);
            }
            $fKtp = $request->file('f_ktp');
            $filename = 'f_ktp.'.$fKtp->guessClientExtension();
            $fKtp->move($folder.'/f_ktp', $filename);

            $model->update(['f_ktp'=>$filename]);
        }

        if ($request->hasFile('f_sertifikat')) {
            if (!file_exists($folder.'/f_sertifikat')) {
                mkdir($folder.'/f_sertifikat', 0755, true);
            }
            $fSertifikat = $request->file('f_sertifikat');
            $filename = 'f_sertifikat.'.$fSertifikat->guessClientExtension();
            $fSertifikat->move($folder.'/f_sertifikat', $filename);

            $model->update(['f_sertifikat'=>$filename]);
        }

        if ($request->hasFile('f_siteplan')) {
            if (!file_exists($folder.'/f_siteplan')) {
                mkdir($folder.'/f_siteplan', 0755, true);
            }
            $fSiteplan = $request->file('f_siteplan');
            $filename = 'f_siteplan.'.$fSiteplan->guessClientExtension();
            $fSiteplan->move($folder.'/f_siteplan', $filename);

            $model->update(['f_siteplan'=>$filename]);
        }

        if ($request->hasFile('f_akta')) {
            if (!file_exists($folder.'/f_akta')) {
                mkdir($folder.'/f_akta', 0755, true);
            }
            $fAkta = $request->file('f_akta');
            $filename = 'f_akta.'.$fAkta->guessClientExtension();
            $fAkta->move($folder.'/f_akta', $filename);

            $model->update(['f_akta'=>$filename]);
        }

        if ($request->hasFile('f_kkpr')) {
            if (!file_exists($folder.'/f_kkpr')) {
                mkdir($folder.'/f_kkpr', 0755, true);
            }
            $fKkpr = $request->file('f_kkpr');
            $filename = 'f_kkpr.'.$fKkpr->guessClientExtension();
            $fKkpr->move($folder.'/f_kkpr', $filename);

            $model->update(['f_kkpr'=>$filename]);
        }

        $administrasi = Persyaratan::where('jenis', 5)->where('status', true)->where('bysistem', 0)->get();

        if (isset($administrasi)) {
            foreach ($administrasi as $adm) {
                $status = 0;
                if ($request->hasFile('persyaratan' . $adm->id)) {
                    $upl    = $request->file('persyaratan' . $adm->id);
                    $berkas = $this->saveBerkasPdf($model, $upl, $status, $folder, $adm, $adm->keterangan);
                } else {
                    $berkas = $this->saveBerkas($model, $status, $adm, $adm->keterangan);
                }
            }
        }

        
        if ($request->hasFile('foto_utara')) {
            $utara      = $request->file('foto_utara');
            $utara->move($folder, 'foto_utara.'.$utara->guessClientExtension());
            $model->update([
                'foto_utara'=>'foto_utara.'. $request->file('foto_utara')->guessClientExtension(),
            ]);
        }
        
        if ($request->hasFile('foto_selatan')) {
            $selatan      = $request->file('foto_selatan');
            $selatan->move($folder, 'foto_selatan.'.$selatan->guessClientExtension());

            $model->update([
                'foto_selatan'=>'foto_selatan.'. $request->file('foto_selatan')->guessClientExtension(),
            ]);
        }

        if ($request->hasFile('foto_barat')) {
            $barat      = $request->file('foto_barat');
            $barat->move($folder, 'foto_barat.'.$barat->guessClientExtension());

            $model->update([

                'foto_barat'=>'foto_barat.'. $request->file('foto_barat')->guessClientExtension(),
            ]);
        }

        if ($request->hasFile('foto_timur')) {
            $timur      = $request->file('foto_timur');
            $timur->move($folder, 'foto_timur.'.$timur->guessClientExtension());

            $model->update([
                'foto_timur'=>'foto_timur.'. $request->file('foto_timur')->guessClientExtension(),
            ]);
        }

        $riwayat = Kkpr_riwayat::where('kkpr_id', $model->id)->where('status_id', 1)->first();
        if(!$riwayat){
            Kkpr_riwayat::create([
                'kkpr_id' => $model->id, 
                'status_id' => '1', 
                'status' => 'Pengajuan', 
                'keterangan' => 'Pengajuan dilakukan oleh Pemohon'
            ]);
        }
        else{
            Kkpr_riwayat::where('id', $riwayat->id)->update([
                'keterangan' => 'Pengajuan dilakukan oleh Pemohon'
            ]);
        }

        return redirect()->route($this->path . '.index')->withSuccess('Data berhasil disimpan kedalam sistem');
    }

    public function edit($id)
    {
        try {
            // Load model first to check if kolom kbli has data
            $kkpr = Kkpr::where('jenis', 'umk')->findOrFail($id);
            
            // Only load kkpr_kbli relationship if kolom kbli is empty
            // If kolom kbli already has data, don't load relationship (optimize query)
            $relationships = ['user', 'kkpr_koordinat', 'kkpr_terbit'];
            if (empty($kkpr->kbli)) {
                $relationships[] = 'kkpr_kbli';
            }
            $kkpr->load($relationships);
            
            // Optimize database queries - use select specific columns and execute immediately
            $kabupaten = DB::table('setup_kab')
                ->where('NO_PROP', 35)
                ->where('NO_KAB', 10)
                ->select('NO_KAB', 'NAMA_KAB')
                ->pluck('NAMA_KAB', 'NO_KAB');
            
            $kecamatan = DB::table('setup_kec')
                ->where('NO_PROP', 35)
                ->where('NO_KAB', 10)
                ->select('NO_KEC', 'NAMA_KEC')
                ->pluck('NAMA_KEC', 'NO_KEC');
            
            // Only query kelurahan if NO_KEC exists and is not null
            $kelurahan = collect();
            // Use NO_KEC from model (not kecamatan_id)
            $noKec = $kkpr->NO_KEC ?? null;
            if (!empty($noKec) && $noKec != null) {
                $kelurahan = DB::table('setup_kel_fix')
                    ->where('NO_PROP', 35)
                    ->where('NO_KAB', 10)
                    ->where('NO_KEC', $noKec)
                    ->select('NO_KEL', 'NAMA_KEL')
                    ->pluck('NAMA_KEL', 'NO_KEL');
            }
            
            // Get KBLI: If kolom kbli already has data, don't use relationship
            // Otherwise, use relationship data if available
            $kbliData = collect();
            
            // If kolom kbli has data, don't use relationship (as per requirement)
            if (!empty($kkpr->kbli)) {
                // Kolom kbli already has data, don't load from relationship table
                $kbliData = collect();
            } 
            // If kolom kbli is empty, use relationship data if it exists
            elseif ($kkpr->relationLoaded('kkpr_kbli') && $kkpr->kkpr_kbli && $kkpr->kkpr_kbli->count() > 0) {
                $kbliData = $kkpr->kkpr_kbli;
            }
            
            $data = [
                'model' => $kkpr,
                'kkpr' => $kkpr->kkpr_terbit,
                'kbli' => $kbliData,
                'koordinat' => $kkpr->kkpr_koordinat,
                'kabupaten' => $kabupaten,
                'kecamatan' => $kecamatan,
                'kelurahan' => $kelurahan,
                'title' => 'Kegiatan Kesesuaian Tata Ruang',
            ];

            return view($this->base_view . 'edit', $data);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Admin KKPR Non Edit Error: ' . $e->getMessage(), [
                'id' => $id,
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->route($this->path . '.index')
                ->with('error', 'Terjadi kesalahan saat mengakses halaman edit: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            // Validasi minimal untuk update - semua field optional
            $request->validate([
                'nama_pemohon' => 'nullable|string|max:255',
                'nik_pemohon' => 'nullable|string|max:16',
                'no_telp' => 'nullable|string|max:20',
                'pekerjaan_pemohon' => 'nullable|string|max:255',
                'alamat_pemohon' => 'nullable|string|max:500',
                'kabupaten_id' => 'nullable|integer',
                'kecamatan_id' => 'nullable|integer',
                'kelurahan_id' => 'nullable|integer',
                'luas' => 'nullable|numeric',
                'fungsi' => 'nullable|string|max:255',
            ]);

            DB::beginTransaction();

            $kkpr = Kkpr::where('jenis', 'umk')->findOrFail($id);

            // Get user from existing KKPR or create/update user if user_id is null
            $user = $kkpr->user;
            
            // If user is null or user_id is empty, create or find user
            if (!$user || !$kkpr->user_id) {
                // Check if user exists by NIK
                $nikPemohon = $request->get('nik_pemohon');
                if ($nikPemohon) {
                    $user = User::where('nik', $nikPemohon)->first();
                    
                    // If user doesn't exist, create new user
                    if (!$user) {
                        $user = User::create([
                            'nik' => $request->get('nik_pemohon'),
                            'name' => $request->get('nama_pemohon'),
                            'work' => $request->get('pekerjaan_pemohon'),
                            'phone' => $request->get('no_telp'),
                            'email' => $request->get('email'),
                            'address' => $request->get('alamat_pemohon'),
                            'password' => bcrypt('123456'), // Default password
                        ]);
                    } else {
                        // Update existing user
                        $user->update([
                            'name' => $request->get('nama_pemohon'),
                            'work' => $request->get('pekerjaan_pemohon'),
                            'phone' => $request->get('no_telp'),
                            'email' => $request->get('email'),
                            'address' => $request->get('alamat_pemohon'),
                        ]);
                    }
                } else {
                    // If no NIK provided, set user_id to null
                    $user = null;
                }
            }

            // Update KKPR
            $kkprData = $request->only([
                'kabupaten_id', 'kecamatan_id', 'kelurahan_id', 
                'luas', 'jns_sertifikat', 'thn_sertifikat', 'no_sertifikat', 
                'an_sertifikat', 'luas_sertifikat', 'penggunaan_awal', 
                'penggunaan_baru', 'longitude', 'lattitude', 'kepimilikan', 
                'rt', 'rw', 'fungsi', 'alamat_kegiatan', 'NO_KEC', 
                'NO_KEL', 'luas_dimohon', 'luas_tanah', 'status_tanah', 
                'penggunaan_sekarang', 'jumlah_lantai', 
                'tinggi_bangunan', 'tgl_terbit', 'tgl_surat', 'no_nib', 
                'badan_hukum', 'risiko_kegiatan', 'kategori_umk'
            ]);

            // Handle status lahan - priority: status_lahan_lainnya_input > status_lahan dari request
            $statusLahanFromRequest = $request->get('status_lahan', '');
            $statusLahanLainnyaInput = $request->get('status_lahan_lainnya_input', '');
            
            // Priority 1: Jika ada status_lahan_lainnya_input yang terisi, gunakan itu
            $statusLahan = '';
            if (!empty(trim($statusLahanLainnyaInput))) {
                $statusLahan = trim($statusLahanLainnyaInput);
            } 
            // Priority 2: Jika tidak ada custom input atau kosong, gunakan status_lahan dari request
            elseif (!empty($statusLahanFromRequest)) {
                $statusLahan = $statusLahanFromRequest;
            }
            
            // Set status_lahan ke kkprData
            if (!empty($statusLahan)) {
                $kkprData['status_lahan'] = $statusLahan;
            }

            // Only set user_id if user exists
            if ($user) {
                $kkprData['user_id'] = $user->id;
            }
            $kkprData['jenis'] = 'umk';
            // Handle luas_lantai array - filter null/NaN/undefined
            $luasLantai = $request->get('luas_lantai');
            if (is_array($luasLantai)) {
                $kkprData['luas_lantai'] = array_values(array_filter($luasLantai, function($value) {
                    return $value !== null && $value !== '' && $value !== 'NaN' && $value !== 'undefined';
                }));
            } else {
                $kkprData['luas_lantai'] = $luasLantai;
            }

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
                        $folder = 'uploads/berkas/umk/' . $kkpr->id . '/f_kkpr';
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
                $kode_kbli = $request->get('kode_kbli');
                $judul_kbli = $request->get('judul_kbli');
                
                // Filter out empty values
                $validKbli = [];
                foreach ($kode_kbli as $key => $kode) {
                    if (!empty(trim($kode)) && !empty(trim($judul_kbli[$key] ?? ''))) {
                        $validKbli[] = [
                            'kode' => trim($kode),
                            'judul' => trim($judul_kbli[$key])
                        ];
                    }
                }
                
                if (count($validKbli) > 0) {
                    // Hapus KBLI lama
                    Kbli::where('id_kkpr', $kkpr->id)->where('jenis', 'UMK')->delete();

                    // Tambah KBLI baru
                    foreach ($validKbli as $kbliItem) {
                        Kbli::create([
                            'jenis' => 'UMK',
                            'id_kkpr' => $kkpr->id,
                            'kode_kbli' => $kbliItem['kode'],
                            'judul_kbli' => $kbliItem['judul'],
                        ]);
                    }
                    
                    // Update kolom kbli dan judul_kbli di model dengan KBLI pertama (jika kolom ada)
                    if (count($validKbli) > 0) {
                        $updateData = ['kbli' => $validKbli[0]['kode']];
                        if (!empty($validKbli[0]['judul'])) {
                            $updateData['judul_kbli'] = $validKbli[0]['judul'];
                        }
                        $kkpr->update($updateData);
                    }
                }
            }

            // Update Koordinat
            // Handle koordinat dari KML atau input manual
            $inputMethod = $request->get('input_method', 'kml');
            
            // Hapus koordinat lama
            Koordinat_kkpr::where('id_kkpr', $kkpr->id)->where('jenis', 'UMK')->delete();
            
            if ($inputMethod === 'manual') {
                // Handle koordinat dari input manual (JSON array)
                $koordinatDimohon = $request->get('koordinat_dimohon');
                if ($koordinatDimohon) {
                    try {
                        $coordinates = json_decode($koordinatDimohon, true);
                        if (is_array($coordinates) && count($coordinates) > 0) {
                            foreach ($coordinates as $coord) {
                                if (isset($coord['latitude']) && isset($coord['longitude']) && 
                                    !empty($coord['latitude']) && !empty($coord['longitude'])) {
                                    Koordinat_kkpr::create([
                                        'jenis' => 'UMK',
                                        'id_kkpr' => $kkpr->id,
                                        'lati' => $coord['latitude'],
                                        'longi' => $coord['longitude'],
                                    ]);
                                }
                            }
                        }
                    } catch (\Exception $e) {
                        // Handle error jika JSON tidak valid
                    }
                }
            } else {
                // Handle koordinat dari KML/GeoJSON - extract dari drawnItems
                // Jika ada kml_geojson, extract koordinat dari GeoJSON
                $kmlGeojson = $request->get('kml_geojson');
                if ($kmlGeojson) {
                    try {
                        $geoJsonData = json_decode($kmlGeojson, true);
                        if (is_array($geoJsonData) && isset($geoJsonData['features'])) {
                            foreach ($geoJsonData['features'] as $feature) {
                                if (isset($feature['geometry']['coordinates'])) {
                                    $coordinates = $feature['geometry']['coordinates'];
                                    
                                    // Handle different geometry types
                                    if ($feature['geometry']['type'] === 'Polygon') {
                                        // Polygon coordinates are nested arrays
                                        foreach ($coordinates[0] as $coord) {
                                            if (count($coord) >= 2) {
                                                Koordinat_kkpr::create([
                                                    'jenis' => 'UMK',
                                                    'id_kkpr' => $kkpr->id,
                                                    'lati' => $coord[1],
                                                    'longi' => $coord[0],
                                                ]);
                                            }
                                        }
                                    } elseif ($feature['geometry']['type'] === 'LineString') {
                                        foreach ($coordinates as $coord) {
                                            if (count($coord) >= 2) {
                                                Koordinat_kkpr::create([
                                                    'jenis' => 'UMK',
                                                    'id_kkpr' => $kkpr->id,
                                                    'lati' => $coord[1],
                                                    'longi' => $coord[0],
                                                ]);
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    } catch (\Exception $e) {
                        // Handle error jika JSON tidak valid
                    }
                }
                
                // Fallback: Handle koordinat dari input lama (longi, lati arrays)
                if ($request->has('longi') && $request->has('lati')) {
                    $longitude = $request->get('longi');
                    $lattitude = $request->get('lati');

                    if (is_array($longitude) && is_array($lattitude)) {
                        foreach ($longitude as $key => $longi) {
                            if (isset($lattitude[$key]) && !empty($longi) && !empty($lattitude[$key])) {
                                Koordinat_kkpr::create([
                                    'jenis' => 'UMK',
                                    'id_kkpr' => $kkpr->id,
                                    'longi' => $longi,
                                    'lati' => $lattitude[$key],
                                ]);
                            }
                        }
                    }
                }
            }

            // Handle kml_geojson - save to file only (database column doesn't exist)
            $folder = 'uploads/berkas/umk/' . $kkpr->id;
            if (!file_exists($folder)) {
                mkdir($folder, 0755, true);
            }
            
            $kml_geo = $request->get('kml_geojson');
            if (!empty($kml_geo)) {
                $dir_to_save = $folder.'/kml/';
                if (!is_dir($dir_to_save)) {
                    mkdir($dir_to_save, 0755, true);
                }
                
                // Save GeoJSON to file
                file_put_contents($dir_to_save.'geojson.geojson', $kml_geo);
                
                // Update database with filename only (kml_geojson column doesn't exist in database)
                $kkpr->update([
                    'f_geojson' => 'geojson.geojson'
                ]);
            } else {
                // If no GeoJSON provided, clear the file reference
                if ($kkpr->f_geojson && file_exists($folder.'/kml/'.$kkpr->f_geojson)) {
                    unlink($folder.'/kml/'.$kkpr->f_geojson);
                }
                $kkpr->update(['f_geojson' => null]);
            }

            // Handle file uploads
            $this->handleFileUploads($request, $kkpr, $user->nik);
            
            // Update riwayat status kembali ke Pengajuan setelah edit
            // Hapus semua riwayat dengan status > 1 (reset ke pengajuan awal)
            Kkpr_riwayat::where('kkpr_id', $kkpr->id)->where('status_id', '>', 1)->delete();
            
            // Update atau create riwayat pengajuan
            $riwayat = Kkpr_riwayat::where('kkpr_id', $kkpr->id)->where('status_id', 1)->first();
            if(!$riwayat){
                Kkpr_riwayat::create([
                    'kkpr_id' => $kkpr->id, 
                    'status_id' => '1', 
                    'status' => 'Pengajuan', 
                    'keterangan' => 'Data permohonan telah diperbarui dan diajukan kembali oleh Admin'
                ]);
            } else {
                $riwayat->update([
                    'status' => 'Pengajuan',
                    'keterangan' => 'Data permohonan telah diperbarui dan diajukan kembali oleh Admin',
                    'updated_at' => Carbon::now('Asia/Jakarta')
                ]);
            }

            DB::commit();

            return redirect()->route($this->path . '.edit', $id)
                ->with('success', 'Data berhasil diupdate kedalam sistem');

        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollback();
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput()
                ->with('error', 'Terjadi kesalahan validasi. Silakan periksa kembali data yang Anda masukkan.');
        } catch (\Exception $e) {
            DB::rollback();
            
            // Log error untuk debugging
            \Illuminate\Support\Facades\Log::error('Admin KKPR Non Update Error: ' . $e->getMessage(), [
                'id' => $id,
                'request_data' => $request->except(['f_ktp', 'f_nib', 'sp_mandiri', 'dok_kepemilikan', 'f_sertifikat', 'f_siteplan', 'f_akta', 'f_kml']),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat mengupdate data: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $kkpr = Kkpr::where('jenis', 'umk')->findOrFail($id);
            $kkpr->update(['deleted' => 1]);

            return redirect()->route($this->path . '.index')
                ->with('success', 'Data berhasil dihapus');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // public function riwayat($id)
    // {
    //     $riwayat = Kkpr_riwayat::where('kkpr_id', $id)->orderBy('status_id', 'asc')->get();
    //     $model = Kkpr::where('jenis', 'umk')->findOrFail($id);

    //     return view($this->base_view . 'riwayat', compact('riwayat', 'model'));
    // }

    public function getRiwayatData($id)
    {
        $riwayat = Kkpr_riwayat::where('kkpr_id', $id)->orderBy('status_id', 'asc')->get();
        $model = Kkpr::where('jenis', 'umk')->findOrFail($id);
        
        return response()->json([
            'success' => true,
            'riwayat' => $riwayat,
            'model' => $model
        ]);
    }

    public function koordinat($id)
    {
        $koordinat = Koordinat_kkpr::where('id_kkpr', $id)->where('jenis', 'UMK')->get();
        $model = Kkpr::where('jenis', 'umk')->findOrFail($id);

        return view($this->base_view . 'koordinat', compact('koordinat', 'model'));
    }

    public function peta($id)
    {
        try {
            $model = Kkpr::with(['user', 'kkpr_kbli', 'kkpr_koordinat'])
                ->where('jenis', 'umk')
                ->findOrFail($id);

            return view($this->base_view . 'peta', compact('model'));
        } catch (\Exception $e) {
            return redirect()->back()
                ->withError('Terjadi kesalahan saat mengakses halaman peta: ' . $e->getMessage());
        }
    }

    public function validasi($id)
    {
        $model = Kkpr::where('jenis', 'umk')->findOrFail($id);
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
            $model = Kkpr::where('jenis', 'umk')->findOrFail($request->id);
            $myuser = Auth::user();

            $model->update([
                'proses' => 3,
                'penerima' => $myuser->name,
                'tgl_terima' => Carbon::now('Asia/Jakarta')->format('Y-m-d'),
                'jam_terima' => Carbon::now('Asia/Jakarta')->format('H:i:s'),
                'revisi' => 0,
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
                $riwayat->update([
                    'keterangan' => 'Data dan persyaratan untuk permohonan KKPR telah divalidasi'
                ]);
            }

            return response()->json(['success' => true, 'message' => 'Validasi berhasil']);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function validasiRevisi(Request $request)
    {
        try {
            $model = Kkpr::where('jenis', 'umk')->findOrFail($request->id);

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

    private function saveBerkasPdf($model, $file, $status, $folder, $persyaratan, $keterangan)
    {
        try {
            $filename = Str::slug($persyaratan->nama) . '.' . $file->guessClientExtension();
            $subfolder = $folder . '/' . Str::slug($persyaratan->nama);
            if (!file_exists($subfolder)) {
                mkdir($subfolder, 0755, true);
            }
            $file->move($subfolder, $filename);

            return BerkasKkpr::create([
                'kkpr_id' => $model->id,
                'persyaratan_id' => $persyaratan->id,
                'nama_file' => $filename,
                'status' => $status,
                'keterangan' => $keterangan,
            ]);
        } catch (\Exception $e) {
            Log::error('Error saving berkas PDF: ' . $e->getMessage());
            return null;
        }
    }

    private function saveBerkas($model, $status, $persyaratan, $keterangan)
    {
        try {
            return BerkasKkpr::create([
                'kkpr_id' => $model->id,
                'persyaratan_id' => $persyaratan->id,
                'nama_file' => null,
                'status' => $status,
                'keterangan' => $keterangan,
            ]);
        } catch (\Exception $e) {
            Log::error('Error saving berkas: ' . $e->getMessage());
            return null;
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
            file_put_contents($dir_to_save . 'geojson.geojson', $kml_geo);
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
        $folder = 'uploads/berkas/umk/' . $kkpr->id . '/f_kkpr';
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
        $folder = 'uploads/berkas/umk/' . $kkpr->id . '/f_kkpr';
        if (!file_exists($folder)) {
            mkdir($folder, 0755, true);
        }

        $fKkpr = $request->file('f_kkpr_' . $n);
        $filename = 'f_kkpr_' . $fKkpr->getFilename() . '.' . $fKkpr->guessClientExtension();
        $fKkpr->move($folder, $filename);

        return $filename;
    }

    public function uploadDraft(Request $request)
    {
        try {
            $request->validate([
                'kkpr_id' => 'required',
                'draft_file' => 'required|mimes:pdf|max:10240'
            ]);

            $model = Kkpr::where('jenis', 'umk')->findOrFail($request->kkpr_id);

            $folder = 'uploads/berkas/umk/' . $model->id;
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
                $riwayat->update([
                    'keterangan' => 'Dokumen hasil penilaian telah diperbarui'
                ]);
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

    public function viewDraft($id)
    {
        try {
            $model = Kkpr::where('jenis', 'umk')->findOrFail($id);

            // Validasi apakah draft file ada
            if (!$model->draft_file) {
                abort(404, 'Draft file tidak ditemukan');
            }

            $filePath = public_path('uploads/berkas/umk/' . $model->id . '/' . $model->draft_file);

            // Cek apakah file ada
            if (!file_exists($filePath)) {
                abort(404, 'File tidak ditemukan');
            }

            // Return file sebagai response
            return response()->file($filePath, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . $model->draft_file . '"'
            ]);
        } catch (\Exception $e) {
            abort(404, 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function viewSurvey($id)
    {
        try {
            $model = Kkpr::where('jenis', 'umk')->findOrFail($id);

            if (!$model->f_survey) {
                abort(404, 'Berkas survey tidak ditemukan');
            }

            $possiblePaths = [
                public_path('uploads/berkas/umk/' . $model->id . '/survey/' . $model->f_survey),
                public_path('uploads/berkas/umk/' . $model->id . '/' . $model->f_survey),
            ];

            foreach ($possiblePaths as $path) {
                if ($path && file_exists($path)) {
                    return response()->file($path);
                }
            }

            abort(404, 'File survey tidak ditemukan');
        } catch (\Exception $e) {
            abort(404, 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function survey(Request $request, $id)
    {
        try {
            $request->validate([
                'jadwal_survey' => 'required|date',
                'f_survey' => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240'
            ]);

            $model = Kkpr::where('jenis', 'umk')->findOrFail($id);

            $folder = 'uploads/berkas/umk/' . $model->id . '/survey';
            if (!file_exists($folder)) {
                mkdir($folder, 0755, true);
            }

            if ($model->f_survey) {
                $oldPaths = [
                    $folder . '/' . $model->f_survey,
                    'uploads/berkas/umk/' . $model->id . '/' . $model->f_survey,
                ];
                foreach ($oldPaths as $oldPath) {
                    if (file_exists($oldPath)) {
                        unlink($oldPath);
                    }
                }
            }

            $file = $request->file('f_survey');
            $filename = 'survey.' . $file->getClientOriginalExtension();
            $file->move($folder, $filename);

            $jadwalSurvey = $request->jadwal_survey
                ? Carbon::parse($request->jadwal_survey, 'Asia/Jakarta')->format('Y-m-d H:i:s')
                : null;

            // Update status analisa dan proses
            $model->update([
                'status_analisa' => 'survey',
                'proses' => 6,
                'jadwal_survey' => $jadwalSurvey,
                'f_survey' => $filename
            ]);

            // Tambah riwayat
            $riwayat = Kkpr_riwayat::where('kkpr_id', $model->id)->where('status_id', 6)->first();
            if (!$riwayat) {
                Kkpr_riwayat::create([
                    'kkpr_id' => $model->id,
                    'status_id' => '6',
                    'status' => 'Survey',
                    'keterangan' => 'Survey lapangan telah dijadwalkan'
                ]);
            } else {
                Kkpr_riwayat::where('id', $riwayat->id)->update([
                    'keterangan' => 'Survey lapangan telah dijadwalkan'
                ]);
            }

            return response()->json(['success' => true, 'message' => 'Survey berhasil dijadwalkan']);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function analisa($id)
    {
        $model = Kkpr::with(['user', 'kkpr_kbli'])->where('jenis', 'umk')->findOrFail($id);
        $kbli = Kbli::where('id_kkpr', $id)->where('jenis', 'NON')->get();
        
        // Auto-generate nomor SK jika belum ada
        if (empty($model->no_sk)) {
            $lastKkpr = Kkpr::where('jenis', 'umk')
                ->whereNotNull('no_sk')
                ->where('no_sk', '!=', '')
                ->orderBy('id', 'desc')
                ->first();
            
            // Parse nomor SK dengan pengecekan keamanan
            $autoIncrement = 1;
            if ($lastKkpr && !empty($lastKkpr->no_sk)) {
                $parts = explode(' / ', $lastKkpr->no_sk);
                if (isset($parts[1])) {
                    $autoIncrement = intval($parts[1]) + 1;
                }
            }
            
            $currentYear = Carbon::now('Asia/Jakarta')->format('Y');
            $generatedNoSk = "645 / {$autoIncrement} / 429.115 / {$currentYear}";
            
            $model->no_sk = $generatedNoSk;
            $model->save();
        }
        
        // Parse pertimbangan, ketentuan_lain, dan keterangan_lain dari JSON jika ada
        $pertimbangan = [];
        $ketentuan_lain = [];
        $keterangan_lain = [];
        
        if (!empty($model->pertimbangan)) {
            if (is_string($model->pertimbangan)) {
                $pertimbangan = json_decode($model->pertimbangan, true) ?: [];
            } else {
                $pertimbangan = $model->pertimbangan;
            }
        }
        
        if (!empty($model->ketentuan_lain)) {
            if (is_string($model->ketentuan_lain)) {
                $ketentuan_lain = json_decode($model->ketentuan_lain, true) ?: [];
            } else {
                $ketentuan_lain = $model->ketentuan_lain;
            }
        }
        
        if (!empty($model->keterangan_lain)) {
            if (is_string($model->keterangan_lain)) {
                $keterangan_lain = json_decode($model->keterangan_lain, true) ?: [];
            } else {
                $keterangan_lain = $model->keterangan_lain;
            }
        }
        
        $data = [
            'model' => $model,
            'kbli' => $kbli,
            'title' => 'Form Analisa KKPR Non',
            'isEdit' => $model->status_rencana != null ? true : false,
            'analis' => User::permission('Analis')->get(),
            'pertimbangan' => $pertimbangan,
            'ketentuan_lain' => $ketentuan_lain,
            'keterangan_lain' => $keterangan_lain,
        ];

        return view($this->base_view . 'form_analisa', $data);
    }

    public function analisaStore(Request $request)
    {
        try {
            DB::beginTransaction();

            $model = Kkpr::where('jenis', 'umk')->findOrFail($request->id);

            // Process pertimbangan, ketentuan_lain, dan keterangan_lain as JSON
            $pertimbangan = $request->get('pertimbangan', []);
            $ketentuan_lain = $request->get('ketentuan_lain', []);
            $keterangan_lain = $request->get('keterangan_lain', []);
            
            // Filter out empty values
            $pertimbangan = array_filter($pertimbangan, function($item) {
                return !empty(trim($item));
            });
            $ketentuan_lain = array_filter($ketentuan_lain, function($item) {
                return !empty(trim($item));
            });
            $keterangan_lain = array_filter($keterangan_lain, function($item) {
                return !empty(trim($item));
            });

            // Process pemeriksa_teknis as array
            $pemeriksa_teknis = $request->get('pemeriksa_teknis', []);
            $pemeriksa_teknis = array_filter($pemeriksa_teknis, function($item) {
                return !empty($item);
            });

            // Convert first pemeriksa ID to name if it's numeric
            if (!empty($pemeriksa_teknis) && is_numeric($pemeriksa_teknis[0])) {
                $firstPemeriksaId = $pemeriksa_teknis[0];
                $firstPemeriksa = \App\Models\User::find($firstPemeriksaId);
                if ($firstPemeriksa) {
                    $pemeriksa_teknis[0] = $firstPemeriksa->name;
                }
            }

            $statusPenggunaanFromRequest = $request->get('status_penggunaan_tanah', '');
            $statusPenggunaanLainnyaInput = $request->get('status_penggunaan_tanah_lainnya_input', '');
            $statusPenggunaanTanah = '';
            if (!empty(trim($statusPenggunaanLainnyaInput))) {
                $statusPenggunaanTanah = trim($statusPenggunaanLainnyaInput);
            } elseif (!empty($statusPenggunaanFromRequest)) {
                $statusPenggunaanTanah = $statusPenggunaanFromRequest;
            }

            $statusPenggunaanFromRequest = $request->get('status_penggunaan_tanah', '');
            $statusPenggunaanLainnyaInput = $request->get('status_penggunaan_tanah_lainnya_input', '');
            $statusPenggunaanTanah = '';
            if (!empty(trim($statusPenggunaanLainnyaInput))) {
                $statusPenggunaanTanah = trim($statusPenggunaanLainnyaInput);
            } elseif (!empty($statusPenggunaanFromRequest)) {
                $statusPenggunaanTanah = $statusPenggunaanFromRequest;
            }

            $statusPenggunaanFromRequest = $request->get('status_penggunaan_tanah', '');
            $statusPenggunaanLainnyaInput = $request->get('status_penggunaan_tanah_lainnya_input', '');
            $statusPenggunaanTanah = '';
            if (!empty(trim($statusPenggunaanLainnyaInput))) {
                $statusPenggunaanTanah = trim($statusPenggunaanLainnyaInput);
            } elseif (!empty($statusPenggunaanFromRequest)) {
                $statusPenggunaanTanah = $statusPenggunaanFromRequest;
            }

            $statusPenggunaanFromRequest = $request->get('status_penggunaan_tanah', '');
            $statusPenggunaanLainnyaInput = $request->get('status_penggunaan_tanah_lainnya_input', '');
            $statusPenggunaanTanah = '';
            if (!empty(trim($statusPenggunaanLainnyaInput))) {
                $statusPenggunaanTanah = trim($statusPenggunaanLainnyaInput);
            } elseif (!empty($statusPenggunaanFromRequest)) {
                $statusPenggunaanTanah = $statusPenggunaanFromRequest;
            }

            $statusLsdValue = $request->status_lsd;
            if ($statusLsdValue === 'Berada') {
                $statusLsdLuasanRaw = $request->input('status_lsd_luasan');
                $statusLsdLuasanRaw = is_null($statusLsdLuasanRaw) ? '' : trim((string) $statusLsdLuasanRaw);
                if ($statusLsdLuasanRaw !== '') {
                    $statusLsdLuasanSanitized = preg_replace('/\s*m2$/i', '', $statusLsdLuasanRaw);
                    $statusLsdValue = 'Berada = ' . $statusLsdLuasanSanitized . 'm2';
                }
            }

            // Update data analisa
            $model->update([
                'status_rencana' => $request->status_rencana,
                'rencana_manfaat' => $request->rencana_manfaat,
                'status_lsd' => $statusLsdValue,
                'kdb' => $request->kdb,
                'klb' => $request->klb,
                'kdh' => $request->kdh,
                'ktb' => $request->filled('ktb') ? $request->ktb : null,
                'lokasi_rencana' => $request->filled('lokasi_rencana') ? $request->lokasi_rencana : null,
                'luas_disetujui' => $request->luas_disetujui,
                'gsb' => $request->gsb,
                'tinggi_bangunan' => $request->filled('tinggi_bangunan') ? $request->tinggi_bangunan : null,
                'pertimbangan' => json_encode($pertimbangan),
                'ketentuan_lain' => json_encode($ketentuan_lain),
                'keterangan_lain' => json_encode($keterangan_lain),
                'pemeriksa_teknis' => json_encode($pemeriksa_teknis),
                'status_analisa' => 'analisa',
                'no_nib' => $request->no_nib,
                'tgl_terbit' => $request->tgl_terbit,
                'alamat_kegiatan' => $request->alamat_kegiatan,
                'status_penggunaan_tanah' => $statusPenggunaanTanah,
                'luas_dimohon' => $request->luas_dimohon,
                'atas_nama' => $request->atas_nama,
                'no_sk' => $request->no_sk,
                'tanggal_sk' => $request->tanggal_sk,
                'badan_hukum' => $request->badan_hukum,
                'risiko_kegiatan' => $request->risiko_kegiatan,
                'kategori_umk' => $request->kategori_umk,
            ]);

            // Update KBLI jika ada
            if ($request->has('kode_kbli') && $request->has('judul_kbli')) {
                Kbli::where('id_kkpr', $model->id)->where('jenis', 'NON')->delete();

                $kode_kbli = $request->get('kode_kbli');
                $judul_kbli = $request->get('judul_kbli');

                foreach ($kode_kbli as $key => $kode) {
                    Kbli::create([
                        'jenis' => 'NON',
                        'id_kkpr' => $model->id,
                        'kode_kbli' => $kode,
                        'judul_kbli' => $judul_kbli[$key],
                    ]);
                }
            }

            // Handle file uploads
            $folder = 'uploads/berkas/umk/' . $model->id;
            if (!file_exists($folder)) {
                mkdir($folder, 0755, true);
            }

            // Upload KML
            if ($request->hasFile('f_kml')) {
                if (!file_exists($folder . '/kml')) {
                    mkdir($folder . '/kml', 0755, true);
                }
                
                // Hapus file lama jika ada
                if ($model->f_kml && file_exists($folder . '/kml/' . $model->f_kml)) {
                    unlink($folder . '/kml/' . $model->f_kml);
                }
                
                $fKml = $request->file('f_kml');
                $filename = 'kml.' . $fKml->getClientOriginalExtension();
                $fKml->move($folder . '/kml', $filename);

                $model->update(['f_kml' => $filename]);
            }

            // Save GeoJSON
            $kml_geo = $request->get('kml_geojson');
            if ($kml_geo != null && $kml_geo != '') {
                $dir_to_save = $folder . '/kml/';
                if (!is_dir($dir_to_save)) {
                    mkdir($folder . '/kml/', 0755, true);
                }
                
                // Hapus file geojson lama jika ada
                if ($model->f_geojson && file_exists($dir_to_save . $model->f_geojson)) {
                    unlink($dir_to_save . $model->f_geojson);
                }
                
                // Simpan dengan proper encoding
                $geojsonData = is_string($kml_geo) ? $kml_geo : json_encode($kml_geo);
                file_put_contents($dir_to_save . 'geojson.geojson', $geojsonData);
                $model->update(['f_geojson' => 'geojson.geojson']);
            }

            // Upload Foto Peta
            if ($request->hasFile('foto_peta')) {
                if (!file_exists($folder . '/peta')) {
                    mkdir($folder . '/peta', 0755, true);
                }
                
                // Hapus foto lama jika ada
                if ($model->foto_peta && file_exists($folder . '/peta/' . $model->foto_peta)) {
                    unlink($folder . '/peta/' . $model->foto_peta);
                }
                
                $fPeta = $request->file('foto_peta');
                $filename = 'peta.' . $fPeta->guessClientExtension();
                $fPeta->move($folder . '/peta', $filename);

                $model->update(['foto_peta' => $filename]);
            }

            // Update proses status dan refresh model
            $model->update([
                'proses' => 7,
                'revisi' => 0
            ]);
            
            // Refresh model untuk memastikan perubahan tersimpan
            $model->refresh();

            // Update riwayat
            $riwayat = Kkpr_riwayat::where('kkpr_id', $model->id)->where('status_id', 7)->first();
            if (!$riwayat) {
                Kkpr_riwayat::create([
                    'kkpr_id' => $model->id,
                    'status_id' => '7',
                    'status' => 'Analisa',
                    'keterangan' => 'Data KKPR Non telah dianalisa oleh analis'
                ]);
            } else {
                $riwayat->update([
                    'keterangan' => 'Data KKPR Non telah diupdate oleh analis'
                ]);
            }

            DB::commit();

            return redirect()->route($this->path . '.index')
                ->with('success', 'Data analisa berhasil disimpan');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function editAnalisa($id)
    {
        $model = Kkpr::with(['user', 'kkpr_kbli'])->where('jenis', 'umk')->findOrFail($id);
        
        // Validasi: hanya bisa edit jika proses == 7 dan revisi != 1
        // if ($model->proses != 7 || $model->revisi == 1) {
        //     return redirect()->route($this->path . '.index')
        //         ->with('error', 'Tidak dapat mengedit analisa dalam kondisi ini');
        // }
        
        $kbli = Kbli::where('id_kkpr', $id)->where('jenis', 'NON')->get();
        
        // Parse pertimbangan dan ketentuan_lain dari JSON jika ada
        $pertimbangan = [];
        $ketentuan_lain = [];
        
        if (!empty($model->pertimbangan)) {
            if (is_string($model->pertimbangan)) {
                $pertimbangan = json_decode($model->pertimbangan, true) ?: [];
            } else {
                $pertimbangan = $model->pertimbangan;
            }
        }
        
        if (!empty($model->ketentuan_lain)) {
            if (is_string($model->ketentuan_lain)) {
                $ketentuan_lain = json_decode($model->ketentuan_lain, true) ?: [];
            } else {
                $ketentuan_lain = $model->ketentuan_lain;
            }
        }
        
        $data = [
            'model' => $model,
            'kbli' => $kbli,
            'title' => 'Edit Analisa KKPR Non',
            'isEdit' => true,
            'analis' => User::permission('Analis')->get(),
            'pertimbangan' => $pertimbangan,
            'ketentuan_lain' => $ketentuan_lain,
        ];

        return view($this->base_view . 'form_analisa', $data);
    }

    public function updateAnalisa(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $model = Kkpr::where('jenis', 'umk')->findOrFail($id);
            
            // Validasi: hanya bisa edit jika proses == 7 dan revisi != 1
            // if ($model->proses != 7 || $model->revisi == 1) {
            //     return redirect()->route($this->path . '.index')
            //         ->with('error', 'Tidak dapat mengedit analisa dalam kondisi ini');
            // }

            // Process pertimbangan and ketentuan_lain as JSON
            $pertimbangan = $request->get('pertimbangan', []);
            $ketentuan_lain = $request->get('ketentuan_lain', []);
            
            // Filter out empty values
            $pertimbangan = array_filter($pertimbangan, function($item) {
                return !empty(trim($item));
            });
            $ketentuan_lain = array_filter($ketentuan_lain, function($item) {
                return !empty(trim($item));
            });

            // Process pemeriksa_teknis as array
            $pemeriksa_teknis = $request->get('pemeriksa_teknis', []);
            $pemeriksa_teknis = array_filter($pemeriksa_teknis, function($item) {
                return !empty($item);
            });

            // Convert first pemeriksa ID to name if it's numeric
            if (!empty($pemeriksa_teknis) && is_numeric($pemeriksa_teknis[0])) {
                $firstPemeriksaId = $pemeriksa_teknis[0];
                $firstPemeriksa = \App\Models\User::find($firstPemeriksaId);
                if ($firstPemeriksa) {
                    $pemeriksa_teknis[0] = $firstPemeriksa->name;
                }
            }

            $statusPenggunaanFromRequest = $request->get('status_penggunaan_tanah', '');
            $statusPenggunaanLainnyaInput = $request->get('status_penggunaan_tanah_lainnya_input', '');
            $statusPenggunaanTanah = '';
            if (!empty(trim($statusPenggunaanLainnyaInput))) {
                $statusPenggunaanTanah = trim($statusPenggunaanLainnyaInput);
            } elseif (!empty($statusPenggunaanFromRequest)) {
                $statusPenggunaanTanah = $statusPenggunaanFromRequest;
            }

            $statusLsdValue = $request->status_lsd;
            if ($statusLsdValue === 'Berada') {
                $statusLsdLuasanRaw = $request->input('status_lsd_luasan');
                $statusLsdLuasanRaw = is_null($statusLsdLuasanRaw) ? '' : trim((string) $statusLsdLuasanRaw);
                if ($statusLsdLuasanRaw !== '') {
                    $statusLsdLuasanSanitized = preg_replace('/\s*m2$/i', '', $statusLsdLuasanRaw);
                    $statusLsdValue = 'Berada = ' . $statusLsdLuasanSanitized . 'm2';
                }
            }

            // Update data analisa
            $model->update([
                'status_rencana' => $request->status_rencana,
                'rencana_manfaat' => $request->rencana_manfaat,
                'status_lsd' => $statusLsdValue,
                'kdb' => $request->kdb,
                'klb' => $request->klb,
                'kdh' => $request->kdh,
                'ktb' => $request->filled('ktb') ? $request->ktb : null,
                'lokasi_rencana' => $request->filled('lokasi_rencana') ? $request->lokasi_rencana : null,
                'luas_disetujui' => $request->luas_disetujui,
                'gsb' => $request->gsb,
                'tinggi_bangunan' => $request->filled('tinggi_bangunan') ? $request->tinggi_bangunan : null,
                'pertimbangan' => json_encode($pertimbangan),
                'ketentuan_lain' => json_encode($ketentuan_lain),
                'pemeriksa_teknis' => json_encode($pemeriksa_teknis),
                'no_nib' => $request->no_nib,
                'tgl_terbit' => $request->tgl_terbit,
                'alamat_kegiatan' => $request->alamat_kegiatan,
                'status_penggunaan_tanah' => $statusPenggunaanTanah,
                'luas_dimohon' => $request->luas_dimohon,
                'atas_nama' => $request->atas_nama,
                'no_sk' => $request->no_sk,
                'tanggal_sk' => $request->tanggal_sk,
                'badan_hukum' => $request->badan_hukum,
                'risiko_kegiatan' => $request->risiko_kegiatan,
                'kategori_umk' => $request->kategori_umk,
            ]);

            // Update KBLI jika ada
            if ($request->has('kode_kbli') && $request->has('judul_kbli')) {
                Kbli::where('id_kkpr', $model->id)->where('jenis', 'NON')->delete();

                $kode_kbli = $request->get('kode_kbli');
                $judul_kbli = $request->get('judul_kbli');

                foreach ($kode_kbli as $key => $kode) {
                    Kbli::create([
                        'jenis' => 'NON',
                        'id_kkpr' => $model->id,
                        'kode_kbli' => $kode,
                        'judul_kbli' => $judul_kbli[$key],
                    ]);
                }
            }

            // Handle file uploads
            $folder = 'uploads/berkas/umk/' . $model->id;
            if (!file_exists($folder)) {
                mkdir($folder, 0755, true);
            }

            // Upload KML
            if ($request->hasFile('f_kml')) {
                if (!file_exists($folder . '/kml')) {
                    mkdir($folder . '/kml', 0755, true);
                }
                
                // Hapus file lama jika ada
                if ($model->f_kml && file_exists($folder . '/kml/' . $model->f_kml)) {
                    unlink($folder . '/kml/' . $model->f_kml);
                }
                
                $fKml = $request->file('f_kml');
                $filename = 'kml.' . $fKml->getClientOriginalExtension();
                $fKml->move($folder . '/kml', $filename);

                $model->update(['f_kml' => $filename]);
            }

            // Save GeoJSON
            $kml_geo = $request->get('kml_geojson');
            if ($kml_geo != null && $kml_geo != '') {
                $dir_to_save = $folder . '/kml/';
                if (!is_dir($dir_to_save)) {
                    mkdir($folder . '/kml/', 0755, true);
                }
                
                // Hapus file geojson lama jika ada
                if ($model->f_geojson && file_exists($dir_to_save . $model->f_geojson)) {
                    unlink($dir_to_save . $model->f_geojson);
                }
                
                // Simpan dengan proper encoding
                $geojsonData = is_string($kml_geo) ? $kml_geo : json_encode($kml_geo);
                file_put_contents($dir_to_save . 'geojson.geojson', $geojsonData);
                $model->update(['f_geojson' => 'geojson.geojson']);
            }

            // Upload Foto Peta
            if ($request->hasFile('foto_peta')) {
                if (!file_exists($folder . '/peta')) {
                    mkdir($folder . '/peta', 0755, true);
                }
                
                // Hapus foto lama jika ada
                if ($model->foto_peta && file_exists($folder . '/peta/' . $model->foto_peta)) {
                    unlink($folder . '/peta/' . $model->foto_peta);
                }
                
                $fPeta = $request->file('foto_peta');
                $filename = 'peta.' . $fPeta->guessClientExtension();
                $fPeta->move($folder . '/peta', $filename);

                $model->update(['foto_peta' => $filename]);
            }

            // Update riwayat
            $riwayat = Kkpr_riwayat::where('kkpr_id', $model->id)->where('status_id', 7)->first();
            if ($riwayat) {
                $riwayat->update([
                    'keterangan' => 'Data analisa KKPR Non telah diperbarui oleh analis'
                ]);
            }

            DB::commit();

            return redirect()->route($this->path . '.index')
                ->with('success', 'Data analisa berhasil diperbarui');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function hapusDokumenAnalisa(Request $request)
    {
        try {
            $model = Kkpr::where('jenis', 'umk')->findOrFail($request->id);
            $field = $request->field;
            
            $folder = 'uploads/berkas/umk/' . $model->id;
            
            // Hapus file sesuai field
            if ($field == 'f_kml' && $model->f_kml) {
                $filePath = $folder . '/kml/' . $model->f_kml;
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
                $model->update(['f_kml' => null]);
            } elseif ($field == 'foto_peta' && $model->foto_peta) {
                $filePath = $folder . '/peta/' . $model->foto_peta;
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
                $model->update(['foto_peta' => null]);
            }

            return response()->json(['success' => true, 'message' => 'Dokumen berhasil dihapus']);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function tolakDokumen(Request $request)
    {
        try {
            $model = Kkpr::where('jenis', 'umk')->findOrFail($request->id);

            // Update proses ke 0 (Ditolak)
            $model->update([
                'proses' => 0,
                'revisi' => 0
            ]);

            // Tambah riwayat untuk proses 0 (Ditolak)
            Kkpr_riwayat::create([
                'kkpr_id' => $model->id,
                'status_id' => 0,
                'status' => 'Ditolak',
                'keterangan' => 'Permohonan KKPR Non ditolak dan tidak dapat diproses lebih lanjut',
                'revisi_detail' => $request->alasan_tolak
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Dokumen berhasil ditolak'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function kirimKabid($id)
    {
        try {
            $model = Kkpr::where('jenis', 'umk')->findOrFail($id);
            
            $model->update([
                'proses' => 8,
                'revisi' => 0
            ]);

            $riwayat = Kkpr_riwayat::where('kkpr_id', $model->id)->where('status_id', 8)->first();
            if (!$riwayat) {
                Kkpr_riwayat::create([
                    'kkpr_id' => $model->id, 
                    'status_id' => '8', 
                    'status' => 'Persetujuan Kabid', 
                    'keterangan' => 'Dokumen Persetujuan KKPR Non Telah dibuat dan memerlukan persetujuan'
                ]);
            } else {
                Kkpr_riwayat::where('id', $riwayat->id)->update([
                    'keterangan' => 'Dokumen Persetujuan KKPR Non Telah dibuat dan memerlukan persetujuan'
                ]);
            }

            return response()->json(['success' => true, 'message' => 'Berhasil dikirim ke Kabid']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function deleteFile($id, $fieldName)
    {
        try {
            $model = Kkpr::where('jenis', 'umk')->findOrFail($id);

            // Map field names to their folder paths
            $folderMap = [
                'f_nib' => 'f_nib',
                'sp_mandiri' => 'sp_mandiri',
                'dok_kepemilikan' => 'dokumen_kepemilikan',
                'f_ktp' => 'f_ktp',
                'f_sertifikat' => 'f_sertifikat',
                'f_siteplan' => 'f_siteplan',
                'f_akta' => 'f_akta',
                'dok_taru' => 'dok_taru',
                'f_kml' => 'kml'
            ];

            if(!isset($folderMap[$fieldName])){
                return response()->json(['success' => false, 'message' => 'Invalid field name'], 400);
            }

            $fileName = $model->{$fieldName};
            if(!$fileName){
                return response()->json(['success' => false, 'message' => 'File not found'], 404);
            }

            $filePath = public_path('uploads/berkas/umk/' . $model->id . '/' . $folderMap[$fieldName] . '/' . $fileName);
            
            // Delete physical file
            if(File::exists($filePath)){
                File::delete($filePath);
            }

            // Update database
            $model->{$fieldName} = null;
            $model->save();

            return response()->json(['success' => true, 'message' => 'File deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function cetakBerkasUmk($id)
    {
        try {
            $model = Kkpr::with(['user', 'kkpr_kbli', 'kkpr_koordinat'])
                ->findOrFail($id);

            // Prepare logo as base64
            $logoPath = public_path('images/logo_bwi.png');
            $logoBase64 = null;
            if (file_exists($logoPath)) {
                $logoData = file_get_contents($logoPath);
                $logoBase64 = 'data:image/png;base64,' . base64_encode($logoData);
            }

            // Prepare foto peta as base64
            $fotoPetaBase64 = null;
            if ($model->foto_peta) {
                $fotoPetaPath = public_path('uploads/berkas/umk/' . $model->id . '/peta/' . $model->foto_peta);
                if (file_exists($fotoPetaPath)) {
                    $fotoPetaData = file_get_contents($fotoPetaPath);
                    $fotoPetaBase64 = 'data:image/' . pathinfo($fotoPetaPath, PATHINFO_EXTENSION) . ';base64,' . base64_encode($fotoPetaData);
                }
            }

            $data = [
                'model' => $model,
                'logoBase64' => $logoBase64,
                'fotoPetaBase64' => $fotoPetaBase64
            ];

            $pdf = Pdf::loadView('admin.kkprnon.pdf.berkas-umk', $data)
                ->setPaper('A4', 'portrait')
                ->setOptions([
                    'isHtml5ParserEnabled' => true,
                    'isRemoteEnabled' => true,
                    'defaultFont' => 'DejaVu Sans'
                ]);

            return $pdf->stream('berkas-umk-' . $model->id . '.pdf');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withError('Terjadi kesalahan saat generate PDF: ' . $e->getMessage());
        }
    }

    // Persetujuan Dokumen - Menampilkan Page
    public function persetujuanDokumen($id)
    {
        $model = Kkpr::findOrFail($id);
        $kbli = Kbli::where('id_kkpr', $id)->where('jenis', 'UMK')->get();

        $data = [
            'model' => $model,
            'kbli' => $kbli,
        ];

        return view($this->base_view . 'persetujuan_dokumen', $data);
    }

    // Persetujuan Dokumen - Revisi (Balik ke Proses 6)
    public function persetujuanRevisi(Request $request)
    {
        try {
            $model = Kkpr::findOrFail($request->id);

            // Update status ke proses 6 (Survey) dan set revisi
            $model->update([
                'proses' => 6,
                'revisi' => 1
            ]);

            // Update riwayat proses 8 (Analisa) dengan catatan revisi
            $riwayat = Kkpr_riwayat::where('kkpr_id', $model->id)
                ->where('status_id', 8)
                ->first();
            
            if ($riwayat) {
                $riwayat->update([
                    'revisi_detail' => $request->catatan_revisi,
                    'status' => 'Revisi',
                    'keterangan' => 'Hasil analisa perlu diperbaiki. Silakan lakukan revisi sesuai catatan.'
                ]);
            }

            // Tambah riwayat baru untuk proses kembali ke 6
            Kkpr_riwayat::create([
                'kkpr_id' => $model->id,
                'status_id' => 6,
                'status' => 'Survey',
                'keterangan' => 'Dokumen dikembalikan untuk perbaikan hasil analisa',
                'revisi_detail' => $request->catatan_revisi
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Dokumen berhasil direvisi dan dikembalikan ke tahap Survey'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    // Persetujuan Dokumen - Setuju (Lanjut ke Proses 9)
    public function persetujuanSetuju(Request $request)
    {
        try {
            $model = Kkpr::findOrFail($request->id);
            $myuser = Auth::user();

            // Update status ke proses 9 (Upload Draft)
            $model->update([
                'proses' => 9,
                'revisi' => 0
            ]);

            // Tambah riwayat untuk proses 9
            $riwayat = Kkpr_riwayat::where('kkpr_id', $model->id)->where('status_id', 9)->first();
            if (!$riwayat) {
                Kkpr_riwayat::create([
                    'kkpr_id' => $model->id,
                    'status_id' => 9,
                    'status' => 'Persetujuan Dokumen',
                    'keterangan' => 'Dokumen telah disetujui oleh Kepala Dinas. Menunggu upload draft dokumen oleh admin.'
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Dokumen berhasil disetujui dan dilanjutkan ke tahap Upload Draft'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function confirmPencabutan($id)
    {
        try {
            $model = Kkpr::where('jenis', 'umk')->findOrFail($id);
            
            // Validasi hanya untuk deleted = 1
            if($model->deleted != 1){
                return response()->json(['success' => false, 'message' => 'Data tidak dalam status request pencabutan'], 400);
            }
            
            // Update deleted = 2 (dikonfirmasi)
            $model->update(['deleted' => 2]);
            
            // Catat di riwayat
            \App\Models\Kkpr_riwayat::create([
                'kkpr_id' => $model->id,
                'status_id' => 0, // status_id 0 untuk pencabutan
                'status' => 'Pencabutan Dikonfirmasi',
                'keterangan' => 'Admin mengkonfirmasi pencabutan permohonan',
                'revisi_detail' => 'Permohonan telah dicabut dan tidak dapat diproses lebih lanjut'
            ]);
            
            return response()->json(['success' => true, 'message' => 'Pencabutan berhasil dikonfirmasi']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    // Get kelurahan berdasarkan NO_KEC
    public function getKelurahanByKecamatan(Request $request)
    {
        $no_kec = $request->get('NO_KEC');
        
        if (!$no_kec) {
            return response()->json(['kelurahan' => []]);
        }

        // Ambil kelurahan berdasarkan NO_KEC yang dipilih
        $kelurahan = DB::table('setup_kel_fix')
            ->where('NO_PROP', 35)
            ->where('NO_KAB', 10)
            ->where('NO_KEC', $no_kec)
            ->pluck('NAMA_KEL', 'NO_KEL')
            ->toArray();

        return response()->json(['kelurahan' => $kelurahan]);
    }

}
