<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Kkpr;
use App\Models\User;
use App\Models\Kkpr_riwayat as KkprRiwayat;
use App\Models\Persyaratan;
use App\Models\BerkasKkpr;
use App\Models\Kbli;
use App\Models\Koordinat_kkpr as KoordinatKkpr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class MemberKkprController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $permohonan = Kkpr::where('user_id', $user->id)
            ->where('jenis', 'non_umk')
            // ->where('deleted', 0)
            ->orderBy('updated_at', 'desc')
            ->get();
            
        return view('member.kkpr.index', compact('permohonan'));
    }

    public function create()
    {
        $data = [
            'kabupaten' => DB::table('setup_kab')->where('NO_PROP', 35)->where('NO_KAB', 10)->pluck('NAMA_KAB', 'NO_KAB'),
            'kecamatan' => DB::table('setup_kec')->where('NO_PROP', 35)->where('NO_KAB', 10)->pluck('NAMA_KEC', 'NO_KEC'),
            'kelurahan' => DB::table('setup_kel_fix')->where('NO_PROP', 35)->where('NO_KAB', 10)->pluck('NAMA_KEL', 'NO_KEL'),
            'persyaratan' => Persyaratan::where('jenis', 5)->where('status', true)->get(),
            'user' => Auth::user(),
        ];
        return view('member.kkpr.create', $data);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $req = $request->only('kabupaten_id', 'kecamatan_id', 'kelurahan_id', 'luas', 'jns_sertifikat', 'thn_sertifikat', 'no_sertifikat', 'an_sertifikat', 'luas_sertifikat', 'penggunaan_awal', 'penggunaan_baru', 'longitude', 'lattitude', 'kepimilikan', 'rt', 'rw');
        
        $req['user_id'] = $user->id;
        $req['jenis'] = 'non_umk';
        $req['jenis_kegiatan'] = $request->get('jenis_kegiatan');
        $req['jenis_kegiatan_lainnya'] = $request->get('jenis_kegiatan_lainnya');
        $req['nib'] = $request->get('nib');
        $req['alamat_kegiatan'] = $request->get('alamat_kegiatan');
        $req['NO_KEC'] = $request->get('NO_KEC');
        $req['NO_KEL'] = $request->get('NO_KEL');
        $req['luas_dimohon'] = $request->get('luas_dimohon');
        $req['luas_tanah'] = $request->get('luas_tanah');
        
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

        // Handle status penggunaan tanah - priority: input custom > nilai select
        $statusPenggunaanFromRequest = $request->get('status_penggunaan_tanah', '');
        $statusPenggunaanLainnyaInput = $request->get('status_penggunaan_tanah_lainnya_input', '');

        $statusPenggunaanTanah = '';
        if (!empty(trim($statusPenggunaanLainnyaInput))) {
            $statusPenggunaanTanah = trim($statusPenggunaanLainnyaInput);
        } elseif (!empty($statusPenggunaanFromRequest)) {
            $statusPenggunaanTanah = $statusPenggunaanFromRequest;
        }

        if (!empty($statusPenggunaanTanah)) {
            $req['status_penggunaan_tanah'] = $statusPenggunaanTanah;
        }
        
        $req['status_tanah'] = $request->get('status_tanah');
        $req['penggunaan_sekarang'] = $request->get('penggunaan_sekarang');
        $req['jumlah_lantai'] = $request->get('jumlah_lantai');
        $req['tinggi_bangunan'] = $request->get('tinggi_bangunan');
        // Handle luas_lantai array - filter null/NaN/undefined
        $luasLantai = $request->get('luas_lantai');
        if (is_array($luasLantai)) {
            $req['luas_lantai'] = array_values(array_filter($luasLantai, function($value) {
                return $value !== null && $value !== '' && $value !== 'NaN' && $value !== 'undefined';
            }));
        } else {
            $req['luas_lantai'] = $luasLantai;
        }
        $req['fungsi'] = $request->get('fungsi');
        $req['no_nib'] = $request->get('no_nib');
        $req['tgl_terbit'] = $request->get('tgl_terbit');
        $req['tgl_surat'] = $request->get('tgl_surat');
        $req['no_kkpr'] = $request->get('no_kkpr');
        $req['tgl_kkpr'] = $request->get('tgl_kkpr');
        
        $model = Kkpr::create($req);

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
                    'jenis' => 'KKPR',
                    'id_kkpr' => $model->id,
                    'kode_kbli' => $kode[$key],
                    'judul_kbli' => $judul[$key],
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
                                KoordinatKkpr::create([
                                    'jenis' => 'KKPR',
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
                            KoordinatKkpr::create([
                                'jenis' => 'KKPR',
                                'id_kkpr' => $model->id,
                                'longi' => $longitude[$key],
                                'lati' => $lattitude[$key],
                            ]);
                        }
                    }
                }
            }
        }

        $folder = 'uploads/berkas/kkpr/' . $model->id;
        if (!file_exists($folder)) {
            mkdir($folder, 0755, true);
        }

        if ($request->hasFile('dok_kepemilikan')) {
            if (!file_exists($folder.'/dokumen_kepemilikan')) {
                mkdir($folder.'/dokumen_kepemilikan', 0755, true);
            }
            $fDok = $request->file('dok_kepemilikan');
            $filename = 'dok_kepemilikan.'.$fDok->guessClientExtension();
            $fDok->move($folder.'/dokumen_kepemilikan', $filename);

            $model->update(['dok_kepemilikan'=>$filename]);
        }

        if ($request->hasFile('dok_taru')) {
            if (!file_exists($folder.'/dok_taru')) {
                mkdir($folder.'/dok_taru', 0755, true);
            }
            $fTaru = $request->file('dok_taru');
            $filename = 'dok_taru.'.$fTaru->guessClientExtension();
            $fTaru->move($folder.'/dok_taru', $filename);

            $model->update(['dok_taru'=>$filename]);
        }

        if ($request->hasFile('sp_mandiri')) {
            if (!file_exists($folder.'/sp_mandiri')) {
                mkdir($folder.'/sp_mandiri', 0755, true);
            }
            $fMandiri = $request->file('sp_mandiri');
            $filename = 'sp_mandiri.'.$fMandiri->guessClientExtension();
            $fMandiri->move($folder.'/sp_mandiri', $filename);

            $model->update(['sp_mandiri'=>$filename]);
        }

        if ($request->hasFile('f_nib')) {
            if (!file_exists($folder.'/f_nib')) {
                mkdir($folder.'/f_nib', 0755, true);
            }
            $fNib = $request->file('f_nib');
            $filename = 'f_nib.'.$fNib->guessClientExtension();
            $fNib->move($folder.'/f_nib', $filename);

            $model->update(['f_nib'=>$filename]);
        }

        if ($request->hasFile('f_kml')) {
            if (!file_exists($folder.'/kml')) {
                mkdir($folder.'/kml', 0755, true);
            }
            $fKml = $request->file('f_kml');
            $filename = 'kml.'.$fKml->getClientOriginalExtension();
            $fKml->move($folder.'/kml', $filename);

            $model->update(['f_kml'=>$filename]);
        }
        
        $kml_geo = $request->get('kml_geojson');
        if($kml_geo != null){
            $dir_to_save = $folder.'/kml/';
            if (!is_dir($dir_to_save)) {
                mkdir($folder.'/kml/', 0755, true);
            }
            file_put_contents($dir_to_save.'geojson.geojson', $kml_geo);
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

        $riwayat = KkprRiwayat::where('kkpr_id', $model->id)->where('status_id', 1)->first();
        if(!$riwayat){
            KkprRiwayat::create(['kkpr_id' =>$model->id, 'status_id' => '1', 'status' => 'Pengajuan', 'keterangan' => 'Pengajuan dilakukan oleh Pemohon']);
        } else {
            KkprRiwayat::where('id', $riwayat->id)->update(array('keterangan' => 'Pengajuan dilakukan oleh Pemohon'));
        }

        return redirect()->route('member.kkpr.index')->withSuccess('Data berhasil disimpan kedalam sistem');
    }

    public function show($id)
    {
        $model = Kkpr::findOrFail($id);
        $user = Auth::user();

        if($model->user_id != $user->id){
            return redirect()->route('member.kkpr.index')->withErrors('Anda Tidak Berhak Mengakses Halaman Ini');
        }

        $data = [
            'model' => $model,
            'administrasi' => Persyaratan::where('jenis', 5)->get(),
        ];
        return view('member.kkpr.show', $data);
    }

    public function edit($id)
    {
        try {
            $model = Kkpr::findOrFail($id);
            $user = Auth::user();

            if($model->user_id != $user->id){
                return redirect()->route('member.kkpr.index')->withErrors('Anda Tidak Berhak Mengakses Halaman Ini');
            }

            // Only load kkpr_kbli relationship if kolom kbli is empty
            // If kolom kbli already has data, don't load relationship (optimize query)
            $relationships = ['kkpr_koordinat'];
            if (empty($model->kbli)) {
                $relationships[] = 'kkpr_kbli';
            }
            $model->load($relationships);
            
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
            $noKec = $model->NO_KEC ?? null;
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
            if (!empty($model->kbli)) {
                // Kolom kbli already has data, don't load from relationship table
                $kbliData = collect();
            } 
            // If kolom kbli is empty, use relationship data if it exists
            elseif ($model->relationLoaded('kkpr_kbli') && $model->kkpr_kbli && $model->kkpr_kbli->count() > 0) {
                $kbliData = $model->kkpr_kbli;
            }
            
            $data = [
                'model' => $model,
                'kbli' => $kbliData,
                'koordinat' => $model->kkpr_koordinat,
                'kabupaten' => $kabupaten,
                'kecamatan' => $kecamatan,
                'kelurahan' => $kelurahan,
            ];
            return view('member.kkpr.edit', $data);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Member KKPR Edit Error: ' . $e->getMessage(), [
                'id' => $id,
                'user_id' => Auth::id(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->route('member.kkpr.index')
                ->with('error', 'Terjadi kesalahan saat mengakses halaman edit: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $model = Kkpr::findOrFail($id);
            $user = Auth::user();

            if($model->user_id != $user->id){
                return redirect()->route('member.kkpr.index')->withErrors('Anda Tidak Berhak Mengakses Halaman Ini');
            }

            DB::beginTransaction();

            // Update KKPR
            $req = $request->only([
                'kabupaten_id', 'kecamatan_id', 'kelurahan_id', 
                'luas', 'jns_sertifikat', 'thn_sertifikat', 'no_sertifikat', 
                'an_sertifikat', 'luas_sertifikat', 'penggunaan_awal', 
                'penggunaan_baru', 'longitude', 'lattitude', 'kepimilikan', 
                'rt', 'rw', 'status_penggunaan_tanah', 'jenis_kegiatan', 
                'jenis_kegiatan_lainnya', 'fungsi', 'alamat_kegiatan', 'NO_KEC', 
                'NO_KEL', 'luas_dimohon', 'luas_tanah', 'status_tanah', 
                'penggunaan_sekarang', 'jumlah_lantai', 
                'tinggi_bangunan', 'tgl_terbit', 'tgl_surat', 'no_nib', 
                'no_kkpr', 'tgl_kkpr', 'nib'
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
            
            // Set status_lahan ke req
            if (!empty($statusLahan)) {
                $req['status_lahan'] = $statusLahan;
            }

            // Handle status penggunaan tanah - priority: input custom > nilai select
            $statusPenggunaanFromRequest = $request->get('status_penggunaan_tanah', '');
            $statusPenggunaanLainnyaInput = $request->get('status_penggunaan_tanah_lainnya_input', '');

            $statusPenggunaanTanah = '';
            if (!empty(trim($statusPenggunaanLainnyaInput))) {
                $statusPenggunaanTanah = trim($statusPenggunaanLainnyaInput);
            } elseif (!empty($statusPenggunaanFromRequest)) {
                $statusPenggunaanTanah = $statusPenggunaanFromRequest;
            }

            if (!empty($statusPenggunaanTanah)) {
                $req['status_penggunaan_tanah'] = $statusPenggunaanTanah;
            }

            $req['user_id'] = $user->id;
            $req['jenis'] = 'non_umk';
            $req['revisi'] = 0; // Reset status revisi
            $req['proses'] = 1; // Kembali ke status Pengajuan
            
            // Handle luas_lantai array - filter null/NaN/undefined
            $luasLantai = $request->get('luas_lantai');
            if (is_array($luasLantai)) {
                $req['luas_lantai'] = array_values(array_filter($luasLantai, function($value) {
                    return $value !== null && $value !== '' && $value !== 'NaN' && $value !== 'undefined';
                }));
            } else {
                $req['luas_lantai'] = $luasLantai;
            }

            $model->update($req);
            
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
                    Kbli::where('id_kkpr', $model->id)->where('jenis', 'KKPR')->delete();

                    // Tambah KBLI baru
                    foreach ($validKbli as $kbliItem) {
                        Kbli::create([
                            'jenis' => 'KKPR',
                            'id_kkpr' => $model->id,
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
                        $model->update($updateData);
                    }
                }
            }

            // Update Koordinat
            // Handle koordinat dari KML atau input manual
            $inputMethod = $request->get('input_method', 'kml');
            
            // Hapus koordinat lama
            KoordinatKkpr::where('id_kkpr', $model->id)->where('jenis', 'KKPR')->delete();
            
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
                                    KoordinatKkpr::create([
                                        'jenis' => 'KKPR',
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
                                                KoordinatKkpr::create([
                                                    'jenis' => 'KKPR',
                                                    'id_kkpr' => $model->id,
                                                    'lati' => $coord[1],
                                                    'longi' => $coord[0],
                                                ]);
                                            }
                                        }
                                    } elseif ($feature['geometry']['type'] === 'LineString') {
                                        foreach ($coordinates as $coord) {
                                            if (count($coord) >= 2) {
                                                KoordinatKkpr::create([
                                                    'jenis' => 'KKPR',
                                                    'id_kkpr' => $model->id,
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
                $reqkor = $request->only('longi', 'lati');
                if (isset($reqkor) && !empty($reqkor['longi']) && !empty($reqkor['lati'])) {
                    $longitude = $reqkor['longi'];
                    $lattitude = $reqkor['lati'];

                    if (is_array($longitude) && is_array($lattitude)) {
                        foreach ($longitude as $key => $n) {
                            if (isset($lattitude[$key]) && !empty($longitude[$key]) && !empty($lattitude[$key])) {
                                KoordinatKkpr::create([
                                    'jenis' => 'KKPR',
                                    'id_kkpr' => $model->id,
                                    'longi' => $longitude[$key],
                                    'lati' => $lattitude[$key],
                                ]);
                            }
                        }
                    }
                }
            }

            $folder = 'uploads/berkas/kkpr/' . $model->id;
            if (!file_exists($folder)) {
                mkdir($folder, 0755, true);
            }

            if ($request->hasFile('dok_kepemilikan')) {
                if (!file_exists($folder.'/dokumen_kepemilikan')) {
                    mkdir($folder.'/dokumen_kepemilikan', 0755, true);
                }
                $fDok = $request->file('dok_kepemilikan');
                $filename = 'dok_kepemilikan.'.$fDok->guessClientExtension();
                $fDok->move($folder.'/dokumen_kepemilikan', $filename);

                $model->update(['dok_kepemilikan'=>$filename]);
            }

            if ($request->hasFile('dok_taru')) {
                if (!file_exists($folder.'/dok_taru')) {
                    mkdir($folder.'/dok_taru', 0755, true);
                }
                $fTaru = $request->file('dok_taru');
                $filename = 'dok_taru.'.$fTaru->guessClientExtension();
                $fTaru->move($folder.'/dok_taru', $filename);

                $model->update(['dok_taru'=>$filename]);
            }

            if ($request->hasFile('sp_mandiri')) {
                if (!file_exists($folder.'/sp_mandiri')) {
                    mkdir($folder.'/sp_mandiri', 0755, true);
                }
                $fMandiri = $request->file('sp_mandiri');
                $filename = 'sp_mandiri.'.$fMandiri->guessClientExtension();
                $fMandiri->move($folder.'/sp_mandiri', $filename);

                $model->update(['sp_mandiri'=>$filename]);
            }

            if ($request->hasFile('f_nib')) {
                if (!file_exists($folder.'/f_nib')) {
                    mkdir($folder.'/f_nib', 0755, true);
                }
                $fNib = $request->file('f_nib');
                $filename = 'f_nib.'.$fNib->guessClientExtension();
                $fNib->move($folder.'/f_nib', $filename);

                $model->update(['f_nib'=>$filename]);
            }

            if ($request->hasFile('f_kml')) {
                if (!file_exists($folder.'/kml')) {
                    mkdir($folder.'/kml', 0755, true);
                }
                $fKml = $request->file('f_kml');
                $filename = 'kml.'.$fKml->getClientOriginalExtension();
                $fKml->move($folder.'/kml', $filename);

                $model->update(['f_kml'=>$filename]);
            }
            
            // Handle kml_geojson - save to file only (database column doesn't exist)
            $kml_geo = $request->get('kml_geojson');
            if (!empty($kml_geo)) {
                $dir_to_save = $folder.'/kml/';
                if (!is_dir($dir_to_save)) {
                    mkdir($dir_to_save, 0755, true);
                }
                
                // Save GeoJSON to file
                file_put_contents($dir_to_save.'geojson.geojson', $kml_geo);
                
                // Update database with filename only (kml_geojson column doesn't exist in database)
                $model->update([
                    'f_geojson' => 'geojson.geojson'
                ]);
            } else {
                // If no GeoJSON provided, clear the file reference
                if ($model->f_geojson && file_exists($folder.'/kml/'.$model->f_geojson)) {
                    unlink($folder.'/kml/'.$model->f_geojson);
                }
                $model->update(['f_geojson' => null]);
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

            // Update riwayat status kembali ke Pengajuan setelah edit
            // Hapus semua riwayat dengan status > 1 (reset ke pengajuan awal)
            KkprRiwayat::where('kkpr_id', $model->id)->where('status_id', '>', 1)->delete();
            
            // Update atau create riwayat pengajuan
            $riwayat = KkprRiwayat::where('kkpr_id', $model->id)->where('status_id', 1)->first();
            if(!$riwayat){
                KkprRiwayat::create([
                    'kkpr_id' => $model->id, 
                    'status_id' => '1', 
                    'status' => 'Pengajuan', 
                    'keterangan' => 'Data permohonan telah diperbarui dan diajukan kembali oleh Pemohon'
                ]);
            } else {
                $riwayat->update([
                    'status' => 'Pengajuan',
                    'keterangan' => 'Data permohonan telah diperbarui dan diajukan kembali oleh Pemohon',
                    'updated_at' => Carbon::now('Asia/Jakarta')
                ]);
            }

            DB::commit();

            return redirect()->route('member.kkpr.edit', $id)
                ->with('success', 'Data berhasil diupdate kedalam sistem');
        } catch (\Exception $e) {
            DB::rollBack();
            
            \Illuminate\Support\Facades\Log::error('Member KKPR Update Error: ' . $e->getMessage(), [
                'id' => $id,
                'user_id' => Auth::id(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat mengupdate data: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $model = Kkpr::findOrFail($id);
        $user = Auth::user();

        if($model->user_id != $user->id){
            return response()->json(['status' => 'error', 'message' => 'Anda Tidak Berhak Mengakses Halaman Ini']);
        }

        $model->update(['deleted' => 1]);
        return response()->json(['status' => 'success', 'message' => 'Data berhasil dihapus']);
    }

    public function cetakDetail($id)
    {
        $model = Kkpr::findOrFail($id);
        $user = Auth::user();

        if($model->user_id != $user->id){
            return redirect()->route('member.kkpr.index')->withErrors('Anda Tidak Berhak Mengakses Halaman Ini');
        }

        // Load relationships
        $model->load(['user', 'kkpr_kbli', 'kkpr_koordinat']);

        $pdf = Pdf::loadView('member.kkpr.pdf.detail', compact('model'))
            ->setPaper('A4', 'portrait')
            ->setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
                'defaultFont' => 'DejaVu Sans'
            ]);

        return $pdf->stream('detail-permohonan-umk-' . $model->id . '.pdf');
    }

    public function cetakBerkasKkpr($id)
    {
        try {
            $model = Kkpr::with(['user', 'kkpr_kbli', 'kkpr_koordinat'])
                ->findOrFail($id);
            $user = Auth::user();

            if($model->user_id != $user->id){
                return redirect()->route('member.kkpr.index')->withErrors('Anda Tidak Berhak Mengakses Halaman Ini');
            }

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
                $fotoPetaPath = public_path('uploads/berkas/kkpr/' . $model->id . '/peta/' . $model->foto_peta);
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

            $pdf = Pdf::loadView('member.kkpr.pdf.berkas-kkpr', $data)
                ->setPaper('A4', 'portrait')
                ->setOptions([
                    'isHtml5ParserEnabled' => true,
                    'isRemoteEnabled' => true,
                    'defaultFont' => 'DejaVu Sans'
                ]);

            return $pdf->stream('berkas-kkpr-' . $model->id . '.pdf');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withError('Terjadi kesalahan saat generate PDF: ' . $e->getMessage());
        }
    }

    public function cetakDaftar()
    {
        $user = Auth::user();
        $permohonan = Kkpr::where('user_id', $user->id)
            ->where('jenis', 'non_umk')
            ->where('deleted', 0)
            ->with(['user', 'kkpr_kbli', 'kkpr_koordinat'])
            ->orderBy('updated_at', 'desc')
            ->get();

        $pdf = Pdf::loadView('member.kkpr.pdf.list', compact('permohonan'))
            ->setPaper('A4', 'portrait')
            ->setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
                'defaultFont' => 'DejaVu Sans'
            ]);

        return $pdf->stream('daftar-permohonan-umk-' . Carbon::now('Asia/Jakarta')->format('Y-m-d') . '.pdf');
    }


    public function getRiwayatData($id)
    {
        $model = Kkpr::where('jenis', 'non_umk')->findOrFail($id);
        $user = Auth::user();

        if($model->user_id != $user->id){
            return response()->json(['success' => false, 'message' => 'Unauthorized']);
        }

        $riwayat = KkprRiwayat::where('kkpr_id', $id)->orderBy('status_id', 'asc')->get();
        
        return response()->json([
            'success' => true,
            'riwayat' => $riwayat,
            'model' => $model
        ]);
    }

    public function deleteFile($id, $fieldName)
    {
        $model = Kkpr::findOrFail($id);
        $user = Auth::user();

        if($model->user_id != $user->id){
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

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

        $filePath = public_path('uploads/berkas/kkpr/' . $model->id . '/' . $folderMap[$fieldName] . '/' . $fileName);
        
        // Delete physical file
        if(File::exists($filePath)){
            File::delete($filePath);
        }

        // Update database
        $model->{$fieldName} = null;
        $model->save();

        return response()->json(['success' => true, 'message' => 'File deleted successfully']);
    }

    private function handleFileUploads(Request $request, $model)
    {
        $folder = 'uploads/berkas/kkpr/' . $model->id;
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
            'f_akta' => 'f_akta'
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
                $model->update([$field => $filename]);
            }
        }

        // Handle GeoJSON
        $kml_geo = $request->get('kml_geojson');
        if($kml_geo != null){
            $dir_to_save = $folder.'/kml/';
            if (!is_dir($dir_to_save)) {
                mkdir($dir_to_save, 0755, true);
            }
            file_put_contents($dir_to_save.'geojson.geojson', $kml_geo);
            $model->update(['f_geojson' => 'geojson.geojson']);
        }
    }

    public function peta($id)
    {
        try {
            $model = Kkpr::with(['user', 'kkpr_kbli', 'kkpr_koordinat'])
                ->findOrFail($id);
            $user = Auth::user();

            if($model->user_id != $user->id){
                return redirect()->route('member.kkpr.index')->withErrors('Anda Tidak Berhak Mengakses Halaman Ini');
            }

            return view('member.kkpr.peta', compact('model'));
        } catch (\Exception $e) {
            return redirect()->back()
                ->withError('Terjadi kesalahan saat mengakses halaman peta: ' . $e->getMessage());
        }
    }

    public function uploadDraft(Request $request)
    {
        try {
            $request->validate([
                'kkpr_id' => 'required',
                'draft_file' => 'required|mimes:pdf|max:10240'
            ]);

            $model = Kkpr::where('jenis', 'non_umk')->findOrFail($request->kkpr_id);
            $user = Auth::user();

            // Authorization check
            if($model->user_id != $user->id){
                return redirect()->route('member.kkpr.index')->withErrors('Anda Tidak Berhak Mengakses Data Ini');
            }

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

            $riwayat = KkprRiwayat::where('kkpr_id', $model->id)->where('status_id', 10)->first();
            if (!$riwayat) {
                KkprRiwayat::create([
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

            return redirect()->route('member.kkpr.index')
                ->with('success', $message);

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat upload dokumen: ' . $e->getMessage());
        }
    }

    public function viewDraft($id)
    {
        try {
            $model = Kkpr::where('jenis', 'non_umk')->findOrFail($id);
            $user = Auth::user();

            // Authorization check
            if($model->user_id != $user->id){
                abort(403, 'Anda Tidak Berhak Mengakses Data Ini');
            }

            // Validasi apakah draft file ada
            if (!$model->draft_file) {
                abort(404, 'Draft file tidak ditemukan');
            }

            $filePath = public_path('uploads/berkas/kkpr/' . $model->id . '/' . $model->draft_file);

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

    public function requestPencabutan(Request $request, $id)
    {
        try {
            $request->validate([
                'alasan_pencabutan' => 'required|string'
            ]);

            $model = Kkpr::where('jenis', 'non_umk')->findOrFail($id);
            $user = Auth::user();

            // Authorization check
            if($model->user_id != $user->id){
                return response()->json(['success' => false, 'message' => 'Anda Tidak Berhak Mengakses Data Ini'], 403);
            }

            // Validasi: hanya bisa request pencabutan jika belum diverifikasi (proses < 3)
            if($model->proses >= 3){
                return response()->json(['success' => false, 'message' => 'Pencabutan hanya bisa dilakukan sebelum diverifikasi'], 400);
            }

            // Update deleted = 1
            $model->update(['deleted' => 1]);

            // Catat di riwayat
            KkprRiwayat::create([
                'kkpr_id' => $model->id,
                'status_id' => 0, // status_id 0 untuk pencabutan
                'status' => 'Request Pencabutan',
                'keterangan' => 'Member mengajukan pencabutan permohonan',
                'revisi_detail' => $request->alasan_pencabutan
            ]);

            return response()->json(['success' => true, 'message' => 'Request pencabutan telah dikirim dan sedang menunggu konfirmasi']);
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
