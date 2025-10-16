<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kkpr;
use App\Models\Kkpr_riwayat;

class CekStatusController extends Controller
{
    public function index()
    {
        return view('cek_status.index');
    }

    public function search(Request $request)
    {
        $request->validate([
            'no_kkpr' => 'required|string|max:255'
        ], [
            'no_kkpr.required' => 'Nomor KKPR harus diisi',
            'no_kkpr.string' => 'Nomor KKPR harus berupa teks',
            'no_kkpr.max' => 'Nomor KKPR maksimal 255 karakter'
        ]);

        $no_kkpr = $request->input('no_kkpr');
        
        // Cari data KKPR berdasarkan nomor KKPR
        $model = Kkpr::with(['user'])
            ->where('no_kkpr', $no_kkpr)
            ->first();

        if (!$model) {
            return redirect()->route('cek-status.index')
                ->with('error', 'Nomor KKPR tidak ditemukan. Silakan periksa kembali nomor yang Anda masukkan.');
        }

        // Ambil riwayat proses menggunakan model Kkpr_riwayat langsung
        $riwayat = Kkpr_riwayat::where('kkpr_id', $model->id)
            ->orderBy('created_at', 'asc')
            ->get();

        return view('cek_status.detail', compact('model', 'riwayat'));
    }
}
