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

class MemberKkprController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $permohonan = Kkpr::where('user_id', $user->id)
            ->where('jenis', 'usaha')
            ->where('deleted', 0)
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
        $req = $request->only([
            'alamat_tanah', 'kabupaten_id', 'kecamatan_id', 'kelurahan_id', 
            'luas', 'jns_sertifikat', 'thn_sertifikat', 'no_sertifikat', 
            'an_sertifikat', 'luas_sertifikat', 'penggunaan_awal', 'penggunaan_baru', 
            'longitude', 'lattitude', 'kepimilikan', 'rt', 'rw'
        ]);
        
        // Add new fields
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
        $req['luas_lantai'] = $request->get('luas_lantai');
        $req['fungsi'] = $request->get('fungsi');
        $req['no_nib'] = $request->get('no_nib');
        $req['tgl_terbit'] = $request->get('tgl_terbit');
        $req['tgl_surat'] = $request->get('tgl_surat');
        
        $model = Kkpr::create($req);

        // Handle KBLI
        $kbli = $request->only('kode_kbli', 'judul_kbli');
        if (isset($kbli)) {
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

        // Handle Koordinat
        $reqkor = $request->only('longi', 'lati');
        if (isset($reqkor)) {
            $longitude = $reqkor['longi'];
            $lattitude = $reqkor['lati'];

            foreach ($longitude as $key => $n) {
                KoordinatKkpr::create([
                    'jenis' => 'UMK',
                    'id_kkpr' => $model->id,
                    'longi' => $longitude[$key],
                    'lati' => $lattitude[$key],
                ]);
            }
        }

        // Handle file uploads
        $this->handleFileUploads($request, $model);

        // Create riwayat
        KkprRiwayat::create([
            'kkpr_id' => $model->id, 
            'status_id' => '1', 
            'status' => 'Pengajuan', 
            'keterangan' => 'Pengajuan dilakukan oleh Pemohon'
        ]);

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
        $model = Kkpr::findOrFail($id);
        $user = Auth::user();

        if($model->user_id != $user->id){
            return redirect()->route('member.kkpr.index')->withErrors('Anda Tidak Berhak Mengakses Halaman Ini');
        }

        $kbli = Kbli::where('id_kkpr', $id)->where('jenis', 'UMK')->get();
        $koordinat = KoordinatKkpr::where('id_kkpr', $id)->where('jenis', 'UMK')->get();
        
        $data = [
            'model' => $model,
            'kbli' => $kbli,
            'koordinat' => $koordinat,
            'kabupaten' => DB::table('setup_kab')->where('NO_PROP', 35)->where('NO_KAB', 10)->pluck('NAMA_KAB', 'NO_KAB'),
            'kecamatan' => DB::table('setup_kec')->where('NO_PROP', 35)->where('NO_KAB', 10)->pluck('NAMA_KEC', 'NO_KEC'),
            'kelurahan' => DB::table('setup_kel_fix')->where('NO_PROP', 35)->where('NO_KAB', 10)->where('NO_KEC', $model->NO_KEC)->pluck('NAMA_KEL', 'NO_KEL'),
        ];
        return view('member.kkpr.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $model = Kkpr::findOrFail($id);
        $user = Auth::user();

        if($model->user_id != $user->id){
            return redirect()->route('member.kkpr.index')->withErrors('Anda Tidak Berhak Mengakses Halaman Ini');
        }

        $req = $request->only([
            'alamat_tanah', 'kabupaten_id', 'kecamatan_id', 'kelurahan_id', 
            'luas', 'jns_sertifikat', 'thn_sertifikat', 'no_sertifikat', 
            'an_sertifikat', 'luas_sertifikat', 'penggunaan_awal', 'penggunaan_baru', 
            'longitude', 'lattitude', 'kepimilikan', 'rt', 'rw'
        ]);
        
        $req['user_id'] = $user->id;
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
        $req['revisi'] = 0;
        
        $model->update($req);

        // Handle KBLI
        $kbli = $request->only('kode_kbli', 'judul_kbli');
        if (isset($kbli)) {
            $model->kkpr_kbli()->delete();
            
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

        // Handle Koordinat
        $reqkor = $request->only('longi', 'lati');
        if (isset($reqkor)) {
            $model->kkpr_koordinat()->delete();
            
            $longitude = $reqkor['longi'];
            $lattitude = $reqkor['lati'];

            foreach ($longitude as $key => $n) {
                KoordinatKkpr::create([
                    'jenis' => 'UMK',
                    'id_kkpr' => $model->id,
                    'longi' => $longitude[$key],
                    'lati' => $lattitude[$key],
                ]);
            }
        }

        // Handle file uploads
        $this->handleFileUploads($request, $model);

        return redirect()->route('member.kkpr.index')->withSuccess('Data berhasil diupdate kedalam sistem');
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

    public function cetakDaftar()
    {
        $user = Auth::user();
        $permohonan = Kkpr::where('user_id', $user->id)
            ->where('jenis', 'usaha')
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

        return $pdf->stream('daftar-permohonan-umk-' . date('Y-m-d') . '.pdf');
    }


    private function handleFileUploads(Request $request, $model)
    {
        $folder = 'uploads/berkas/umk/' . $model->id;
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
}
