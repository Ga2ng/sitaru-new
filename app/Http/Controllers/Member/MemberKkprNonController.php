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
            ->where('jenis', 'non_usaha')
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
        
        // Update user data
        if (isset($user)) {
            $user->name = $request->get('nama_pemohon');
            $user->nik = $request->get('nik_pemohon');
            $user->email = $request->get('email');
            $user->phone = $request->get('no_telp');
            $user->work = $request->get('pekerjaan_pemohon');
            $user->address = $request->get('alamat_pemohon');
            $user->save();
        }

        // Prepare KKPR data
        $req = $request->only([
            'tgl_surat', 'alamat_tanah', 'kabupaten_id', 'kecamatan_id', 'kelurahan_id', 
            'luas', 'jns_sertifikat', 'thn_sertifikat', 'no_sertifikat', 'an_sertifikat', 
            'luas_sertifikat', 'penggunaan_awal', 'penggunaan_baru', 'longitude', 
            'lattitude', 'kepimilikan', 'rt', 'rw'
        ]);
        
        $req['user_id'] = $user->id;
        $req['jenis'] = 'non_usaha';
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
        $req['no_nib'] = $request->get('no_nib');
        $req['tgl_terbit'] = $request->get('tgl_terbit');
        $req['tgl_kkpr'] = $request->get('tgl_kkpr');
        $req['no_kkpr'] = $request->get('no_kkpr');

        $model = Kkpr::create($req);

        // Handle KKPR Terbit
        if ($request->has(['no_terbit', 'tgl_terbit_kkpr'])) {
            $this->handleKkprTerbit($model, $request);
        }

        // Handle KBLI
        if ($request->has(['kode_kbli', 'judul_kbli'])) {
            $this->handleKbli($model, $request);
        }

        // Handle Koordinat
        if ($request->has(['longi', 'lati'])) {
            $this->handleKoordinat($model, $request);
        }

        // Handle file uploads
        $this->handleFileUploads($model, $request);

        // Create riwayat
        $this->createRiwayat($model);

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

        // Prepare update data
        $req = $request->only([
            'tgl_surat', 'alamat_tanah', 'kabupaten_id', 'kecamatan_id', 'kelurahan_id', 
            'luas', 'jns_sertifikat', 'thn_sertifikat', 'no_sertifikat', 'an_sertifikat', 
            'luas_sertifikat', 'penggunaan_awal', 'penggunaan_baru', 'longitude', 
            'lattitude', 'kepimilikan', 'rt', 'rw'
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
        $req['no_nib'] = $request->get('no_nib');
        $req['tgl_terbit'] = $request->get('tgl_terbit');
        $req['tgl_kkpr'] = $request->get('tgl_kkpr');
        $req['no_kkpr'] = $request->get('no_kkpr');
        $req['revisi'] = 0;

        $model->update($req);

        // Handle related data
        if ($request->has(['no_terbit', 'tgl_terbit_kkpr'])) {
            $this->handleKkprTerbit($model, $request);
        }

        if ($request->has(['kode_kbli', 'judul_kbli'])) {
            $this->handleKbli($model, $request);
        }

        if ($request->has(['longi', 'lati'])) {
            $this->handleKoordinat($model, $request);
        }

        $this->handleFileUploads($model, $request);

        return redirect()->route('member.kkprnon.index')->withSuccess('Data berhasil diupdate kedalam sistem');
    }

    public function destroy($id)
    {
        $model = Kkpr::findOrFail($id);
        $user = Auth::user();

        if($model->user_id != $user->id){
            return response()->json(['error' => 'Anda Tidak Berhak Mengakses Halaman Ini'], 403);
        }

        $model->update(['deleted' => 1]);
        
        return response()->json(['success' => 'Data berhasil dihapus']);
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
            ->where('jenis', 'non_usaha')
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

    private function handleKkprTerbit($model, $request)
    {
        $kkpr_terbit = $request->only('no_terbit', 'tgl_terbit_kkpr');
        
        // Delete existing
        $model->kkpr_terbit()->delete();

        $nobit = $kkpr_terbit['no_terbit'];
        $tglbit = $kkpr_terbit['tgl_terbit_kkpr'];

        foreach ($nobit as $key => $n) {
            Kkpr_terbit::create([
                'id_kkpr' => $model->id,
                'no_terbit' => $nobit[$key],
                'tgl_terbit' => $tglbit[$key],
            ]);
        }
    }

    private function handleKbli($model, $request)
    {
        $kbli = $request->only('kode_kbli', 'judul_kbli');
        
        // Delete existing
        $model->kkpr_kbli()->delete();

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

    private function handleKoordinat($model, $request)
    {
        $reqkor = $request->only('longi', 'lati');
        
        // Delete existing
        $model->kkpr_koordinat()->delete();

        $longitude = $reqkor['longi'];
        $lattitude = $reqkor['lati'];

        foreach ($longitude as $key => $n) {
            Koordinat_kkpr::create([
                'jenis' => 'KKPR',
                'id_kkpr' => $model->id,
                'longi' => $longitude[$key],
                'lati' => $lattitude[$key],
            ]);
        }
    }

    private function handleFileUploads($model, $request)
    {
        $folder = 'uploads/berkas/kkpr_non/' . $model->id;
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
            file_put_contents($dir_to_save.'geojson.geojson', json_encode($kml_geo));
            $model->update(['f_geojson'=>'geojson.geojson']);
        }
    }

    private function createRiwayat($model)
    {
        $riwayat = Kkpr_riwayat::where('kkpr_id', $model->id)->where('status_id', 1)->first();
        if(!$riwayat){
            Kkpr_riwayat::create([
                'kkpr_id' => $model->id, 
                'status_id' => '1', 
                'status' => 'Pengajuan', 
                'keterangan' => 'Pengajuan dilakukan oleh Pemohon'
            ]);
        } else {
            $riwayat->update(['keterangan' => 'Pengajuan dilakukan oleh Pemohon']);
        }
    }
}
