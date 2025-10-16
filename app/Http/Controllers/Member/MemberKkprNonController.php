<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Kkpr;
use App\Models\User;
use App\Models\Kkpr_riwayat;
use App\Models\Persyaratan;
use App\Models\BerkasKkpr;
use App\Models\Kkpr_terbit;
use App\Models\Kbli;
use App\Models\Koordinat_kkpr;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class MemberKkprNonController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $permohonan = Kkpr::where('user_id', $user->id)
            ->where('jenis', 'umk')
            ->where('deleted', 0)
            ->with(['user', 'kkpr_kbli', 'kkpr_koordinat'])
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('member.kkprnon.index', compact('permohonan'));
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
        
        return view('member.kkprnon.create', $data);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        
        $req = $request->only('alamat_tanah', 'kabupaten_id', 'kecamatan_id', 'kelurahan_id', 'luas', 'jns_sertifikat', 'thn_sertifikat', 'no_sertifikat', 'an_sertifikat', 'luas_sertifikat', 'penggunaan_awal', 'penggunaan_baru', 'longitude', 'lattitude', 'kepimilikan', 'rt', 'rw');
        
        $req['user_id'] = $user->id;
        $req['jenis'] = 'umk';
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
        $req['luas_lantai'] = $request->get('luas_lantai');
        $req['fungsi'] = $request->get('fungsi');
        $req['no_nib'] = $request->get('no_nib');
        $req['tgl_terbit'] = $request->get('tgl_terbit');
        $req['tgl_surat'] = $request->get('tgl_surat');
        
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
                    'jenis' => 'UMK',
                    'id_kkpr' => $model->id,
                    'kode_kbli' => $kode[$key],
                    'judul_kbli' => $judul[$key],
                ]);
            }
        }

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

        $folder = 'uploads/berkas/umk/' . $model->id;
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

        $riwayat = Kkpr_riwayat::where('kkpr_id', $model->id)->where('status_id', 1)->first();
        if(!$riwayat){
            Kkpr_riwayat::create(['kkpr_id' =>$model->id, 'status_id' => '1', 'status' => 'Pengajuan', 'keterangan' => 'Pengajuan dilakukan oleh Pemohon']);
        } else {
            Kkpr_riwayat::where('id', $riwayat->id)->update(array('keterangan' => 'Pengajuan dilakukan oleh Pemohon'));
        }

        return redirect()->route('member.kkprnon.index')->withSuccess('Data berhasil disimpan kedalam sistem');
    }

    public function show($id)
    {
        $model = Kkpr::findOrFail($id);
        $user = Auth::user();

        if($model->user_id != $user->id){
            return redirect()->route('member.kkprnon.index')->withErrors('Anda Tidak Berhak Mengakses Halaman Ini');
        }

        $model->load(['user', 'kkpr_kbli', 'kkpr_koordinat', 'kkpr_terbit']);
        
        $data = [
            'model' => $model,
            'administrasi' => Persyaratan::where('jenis', 5)->get(),
        ];
        
        return view('member.kkprnon.show', $data);
    }

    public function edit($id)
    {
        $model = Kkpr::findOrFail($id);
        $user = Auth::user();

        if($model->user_id != $user->id){
            return redirect()->route('member.kkprnon.index')->withErrors('Anda Tidak Berhak Mengakses Halaman Ini');
        }

        $data = [
            'model' => $model,
            'kkpr' => $model->kkpr_terbit,
            'kbli' => $model->kkpr_kbli,
            'koordinat' => $model->kkpr_koordinat,
            'kabupaten' => DB::table('setup_kab')->where('NO_PROP', 35)->where('NO_KAB', 10)->pluck('NAMA_KAB', 'NO_KAB'),
            'kecamatan' => DB::table('setup_kec')->where('NO_PROP', 35)->where('NO_KAB', 10)->pluck('NAMA_KEC', 'NO_KEC'),
            'kelurahan' => DB::table('setup_kel_fix')->where('NO_PROP', 35)->where('NO_KAB', 10)->where('NO_KEC', $model->NO_KEC)->pluck('NAMA_KEL', 'NO_KEL'),
        ];
        
        return view('member.kkprnon.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $model = Kkpr::findOrFail($id);
        $user = Auth::user();

        if($model->user_id != $user->id){
            return redirect()->route('member.kkprnon.index')->withErrors('Anda Tidak Berhak Mengakses Halaman Ini');
        }

        $req = $request->only('alamat_tanah', 'kabupaten_id', 'kecamatan_id', 'kelurahan_id', 'luas', 'jns_sertifikat', 'thn_sertifikat', 'no_sertifikat', 'an_sertifikat', 'luas_sertifikat', 'penggunaan_awal', 'penggunaan_baru', 'longitude', 'lattitude', 'kepimilikan', 'rt', 'rw');
        
        $req['user_id'] = $user->id;
        $req['jenis'] = 'umk';
        $req['status_penggunaan_tanah'] = $request->get('status_penggunaan_tanah');
        $req['jenis_kegiatan'] = $request->get('jenis_kegiatan');
        $req['jenis_kegiatan_lainnya'] = $request->get('jenis_kegiatan_lainnya');
        $req['fungsi'] = $request->get('fungsi');
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
        $req['luas_lantai'] = $request->get('luas_lantai');
        $req['tgl_terbit'] = $request->get('tgl_terbit');
        $req['no_nib'] = $request->get('no_nib');
        $req['tgl_surat'] = $request->get('tgl_surat');
        $req['revisi'] = 0; // Reset status revisi
        $req['proses'] = 1; // Kembali ke status Pengajuan
        
        $model->update($req);  
        
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

        $folder = 'uploads/berkas/umk/' . $model->id;
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

        // Update riwayat status kembali ke Pengajuan setelah edit
        // Hapus semua riwayat dengan status > 1 (reset ke pengajuan awal)
        Kkpr_riwayat::where('kkpr_id', $model->id)->where('status_id', '>', 1)->delete();
        
        // Update atau create riwayat pengajuan
        $riwayat = Kkpr_riwayat::where('kkpr_id', $model->id)->where('status_id', 1)->first();
        if(!$riwayat){
            Kkpr_riwayat::create([
                'kkpr_id' => $model->id, 
                'status_id' => '1', 
                'status' => 'Pengajuan', 
                'keterangan' => 'Data permohonan telah diperbarui dan diajukan kembali oleh Pemohon'
            ]);
        } else {
            $riwayat->update([
                'status' => 'Pengajuan',
                'keterangan' => 'Data permohonan telah diperbarui dan diajukan kembali oleh Pemohon',
                'updated_at' => now()
            ]);
        }

        return redirect()->route('member.kkprnon.index')->withSuccess('Data berhasil diupdate kedalam sistem');
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
            return redirect()->route('member.kkprnon.index')->withErrors('Anda Tidak Berhak Mengakses Halaman Ini');
        }

        $model->load(['user', 'kkpr_kbli', 'kkpr_koordinat']);

        $pdf = Pdf::loadView('member.kkprnon.pdf.detail', compact('model'))
            ->setPaper('A4', 'portrait')
            ->setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
                'defaultFont' => 'DejaVu Sans'
            ]);

        return $pdf->stream('detail-permohonan-kkpr-non-' . $model->id . '.pdf');
    }

    public function cetakDaftar()
    {
        $user = Auth::user();
        $permohonan = Kkpr::where('user_id', $user->id)
            ->where('jenis', 'umk')
            ->where('deleted', 0)
            ->with(['user', 'kkpr_kbli', 'kkpr_koordinat'])
            ->orderBy('updated_at', 'desc')
            ->get();

        $pdf = Pdf::loadView('member.kkprnon.pdf.list', compact('permohonan'))
            ->setPaper('A4', 'portrait')
            ->setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
                'defaultFont' => 'DejaVu Sans'
            ]);

        return $pdf->stream('daftar-permohonan-kkpr-non-' . date('Y-m-d') . '.pdf');
    }

    public function getRiwayatData($id)
    {
        $model = Kkpr::where('jenis', 'umk')->findOrFail($id);
        $user = Auth::user();

        if($model->user_id != $user->id){
            return response()->json(['success' => false, 'message' => 'Unauthorized']);
        }

        $riwayat = Kkpr_riwayat::where('kkpr_id', $id)->orderBy('status_id', 'asc')->get();
        
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

        $filePath = public_path('uploads/berkas/umk/' . $model->id . '/' . $folderMap[$fieldName] . '/' . $fileName);
        
        // Delete physical file
        if(File::exists($filePath)){
            File::delete($filePath);
        }

        // Update database
        $model->{$fieldName} = null;
        $model->save();

        return response()->json(['success' => true, 'message' => 'File deleted successfully']);
    }

    public function cetakBerkasUmk($id)
    {
        try {
            $model = Kkpr::with(['user', 'kkpr_kbli', 'kkpr_koordinat'])
                ->findOrFail($id);
            $user = Auth::user();

            if($model->user_id != $user->id){
                return redirect()->route('member.kkprnon.index')->withErrors('Anda Tidak Berhak Mengakses Halaman Ini');
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

            $pdf = Pdf::loadView('member.kkprnon.pdf.berkas-umk', $data)
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

    public function peta($id)
    {
        try {
            $model = Kkpr::with(['user', 'kkpr_kbli', 'kkpr_koordinat'])
                ->findOrFail($id);
            $user = Auth::user();

            if($model->user_id != $user->id){
                return redirect()->route('member.kkprnon.index')->withErrors('Anda Tidak Berhak Mengakses Halaman Ini');
            }

            return view('member.kkprnon.peta', compact('model'));
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

            $model = Kkpr::where('jenis', 'umk')->findOrFail($request->kkpr_id);
            $user = Auth::user();

            // Authorization check
            if($model->user_id != $user->id){
                return redirect()->route('member.kkprnon.index')->withErrors('Anda Tidak Berhak Mengakses Data Ini');
            }

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
                $riwayat->update(['keterangan' => 'Dokumen hasil penilaian telah diperbarui']);
            }

            $message = $model->proses == 10 ?
                'Hasil penilaian berhasil diperbarui' :
                'Draft berhasil diupload dan proses telah selesai';

            return redirect()->route('member.kkprnon.index')
                ->with('success', $message);

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat upload dokumen: ' . $e->getMessage());
        }
    }

}
