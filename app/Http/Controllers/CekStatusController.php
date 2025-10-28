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
            'no_nib' => 'required|string|max:255'
        ], [
            'no_nib.required' => 'Nomor NIB harus diisi',
            'no_nib.string' => 'Nomor NIB harus berupa teks',
            'no_nib.max' => 'Nomor NIB maksimal 255 karakter'
        ]);

        $no_nib = $request->input('no_nib');
        
        // Cari data KKPR berdasarkan nomor NIB (bisa lebih dari 1 data)
        $models = Kkpr::with(['user'])
            ->where('no_nib', $no_nib)
            ->orderBy('created_at', 'desc')
            ->get();

        if ($models->isEmpty()) {
            return redirect()->route('cek-status.index')
                ->with('error', 'Nomor NIB tidak ditemukan. Silakan periksa kembali nomor yang Anda masukkan.');
        }

        // Jika hanya ada 1 data, langsung redirect ke detail
        if ($models->count() == 1) {
            $model = $models->first();
            
            // Ambil riwayat proses menggunakan model Kkpr_riwayat langsung
            $riwayat = Kkpr_riwayat::where('kkpr_id', $model->id)
                ->orderBy('created_at', 'asc')
                ->get();

            return view('cek_status.detail', compact('model', 'riwayat'));
        }

        // Jika ada multiple data, tampilkan di index dengan data models
        return view('cek_status.index', compact('models', 'no_nib'));
    }

    public function show($id)
    {
        $model = Kkpr::with(['user'])->findOrFail($id);
        
        // Ambil riwayat proses menggunakan model Kkpr_riwayat langsung
        $riwayat = Kkpr_riwayat::where('kkpr_id', $model->id)
            ->orderBy('created_at', 'asc')
            ->get();

        return view('cek_status.detail', compact('model', 'riwayat'));
    }
}
