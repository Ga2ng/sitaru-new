<?php

namespace App\Http\Controllers;

use App\Models\Kkpr;
use App\Models\User;
use App\Models\Berita;
use App\Models\Informasi;
use App\Models\Kbli;
use App\Models\Koordinat_kkpr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if ($user->hasRole('admin')) {
            return $this->adminDashboard();
        } else {
            return $this->memberDashboard();
        }
    }
    
    private function adminDashboard()
    {
        // Data KKPR (jenis = 'non_umk')
        $kkprTotal = Kkpr::kkpr()->count();
        $kkprSelesai = Kkpr::kkpr()->where('proses', '>=', 7)->count();
        $kkprBerjalan = Kkpr::kkpr()->whereBetween('proses', [1, 6])->count();
        $kkprPending = Kkpr::kkpr()->where('proses', 0)->count();
        
        // Data UMK (jenis = 'umk')
        $umkTotal = Kkpr::umk()->count();
        $umkSelesai = Kkpr::umk()->where('proses', '>=', 7)->count();
        $umkBerjalan = Kkpr::umk()->whereBetween('proses', [1, 6])->count();
        $umkPending = Kkpr::umk()->where('proses', 0)->count();
        
        // Data User
        $userTotal = User::count();
        $userAktif = User::where('active', 1)->count();
        
        // Data Berita & Informasi
        $beritaTotal = Berita::count();
        $beritaAktif = Berita::where('status', 'aktif')->count();
        $informasiTotal = Informasi::count();
        $informasiAktif = Informasi::where('status', 'aktif')->count();
        
        // Recent KKPR
        $recentKkpr = Kkpr::kkpr()->with('user')->orderBy('created_at', 'desc')->limit(5)->get();
        $recentUmk = Kkpr::umk()->with('user')->orderBy('created_at', 'desc')->limit(5)->get();
        
        // Status Distribution
        $kkprStatus = [
            'pending' => Kkpr::kkpr()->where('proses', 0)->count(),
            'diterima' => Kkpr::kkpr()->where('proses', 1)->count(),
            'survey' => Kkpr::kkpr()->where('proses', 2)->count(),
            'analisa' => Kkpr::kkpr()->where('proses', 3)->count(),
            'rekomendasi' => Kkpr::kkpr()->where('proses', 4)->count(),
            'persetujuan' => Kkpr::kkpr()->where('proses', 5)->count(),
            'terbit' => Kkpr::kkpr()->where('proses', 6)->count(),
            'selesai' => Kkpr::kkpr()->where('proses', 7)->count(),
        ];
        
        $umkStatus = [
            'pending' => Kkpr::umk()->where('proses', 0)->count(),
            'diterima' => Kkpr::umk()->where('proses', 1)->count(),
            'survey' => Kkpr::umk()->where('proses', 2)->count(),
            'analisa' => Kkpr::umk()->where('proses', 3)->count(),
            'rekomendasi' => Kkpr::umk()->where('proses', 4)->count(),
            'persetujuan' => Kkpr::umk()->where('proses', 5)->count(),
            'terbit' => Kkpr::umk()->where('proses', 6)->count(),
            'selesai' => Kkpr::umk()->where('proses', 7)->count(),
        ];
        
        return view('dashboard', compact(
            'kkprTotal', 'kkprSelesai', 'kkprBerjalan', 'kkprPending',
            'umkTotal', 'umkSelesai', 'umkBerjalan', 'umkPending',
            'userTotal', 'userAktif',
            'beritaTotal', 'beritaAktif', 'informasiTotal', 'informasiAktif',
            'recentKkpr', 'recentUmk', 'kkprStatus', 'umkStatus'
        ));
    }
    
    private function memberDashboard()
    {
        $user = Auth::user();
        
        // Data KKPR user (jenis = 'non_umk')
        $kkprTotal = Kkpr::where('user_id', $user->id)->kkpr()->count();
        $kkprSelesai = Kkpr::where('user_id', $user->id)->kkpr()->where('proses', '>=', 7)->count();
        $kkprBerjalan = Kkpr::where('user_id', $user->id)->kkpr()->whereBetween('proses', [1, 6])->count();
        $kkprPending = Kkpr::where('user_id', $user->id)->kkpr()->where('proses', 0)->count();
        
        // Data UMK user (jenis = 'umk')
        $umkTotal = Kkpr::where('user_id', $user->id)->umk()->count();
        $umkSelesai = Kkpr::where('user_id', $user->id)->umk()->where('proses', '>=', 7)->count();
        $umkBerjalan = Kkpr::where('user_id', $user->id)->umk()->whereBetween('proses', [1, 6])->count();
        $umkPending = Kkpr::where('user_id', $user->id)->umk()->where('proses', 0)->count();
        
        // Recent submissions
        $recentKkpr = Kkpr::where('user_id', $user->id)->kkpr()->with('user')->orderBy('created_at', 'desc')->limit(5)->get();
        $recentUmk = Kkpr::where('user_id', $user->id)->umk()->with('user')->orderBy('created_at', 'desc')->limit(5)->get();
        
        // User profile info
        $userProfile = [
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'address' => $user->address,
            'total_submissions' => $kkprTotal + $umkTotal,
            'completed_submissions' => $kkprSelesai + $umkSelesai,
        ];
        
        // Status Distribution for user
        $kkprStatus = [
            'pending' => Kkpr::where('user_id', $user->id)->kkpr()->where('proses', 0)->count(),
            'diterima' => Kkpr::where('user_id', $user->id)->kkpr()->where('proses', 1)->count(),
            'survey' => Kkpr::where('user_id', $user->id)->kkpr()->where('proses', 2)->count(),
            'analisa' => Kkpr::where('user_id', $user->id)->kkpr()->where('proses', 3)->count(),
            'rekomendasi' => Kkpr::where('user_id', $user->id)->kkpr()->where('proses', 4)->count(),
            'persetujuan' => Kkpr::where('user_id', $user->id)->kkpr()->where('proses', 5)->count(),
            'terbit' => Kkpr::where('user_id', $user->id)->kkpr()->where('proses', 6)->count(),
            'selesai' => Kkpr::where('user_id', $user->id)->kkpr()->where('proses', 7)->count(),
        ];
        
        $umkStatus = [
            'pending' => Kkpr::where('user_id', $user->id)->umk()->where('proses', 0)->count(),
            'diterima' => Kkpr::where('user_id', $user->id)->umk()->where('proses', 1)->count(),
            'survey' => Kkpr::where('user_id', $user->id)->umk()->where('proses', 2)->count(),
            'analisa' => Kkpr::where('user_id', $user->id)->umk()->where('proses', 3)->count(),
            'rekomendasi' => Kkpr::where('user_id', $user->id)->umk()->where('proses', 4)->count(),
            'persetujuan' => Kkpr::where('user_id', $user->id)->umk()->where('proses', 5)->count(),
            'terbit' => Kkpr::where('user_id', $user->id)->umk()->where('proses', 6)->count(),
            'selesai' => Kkpr::where('user_id', $user->id)->umk()->where('proses', 7)->count(),
        ];
        
        return view('dashboard', compact(
            'kkprTotal', 'kkprSelesai', 'kkprBerjalan', 'kkprPending',
            'umkTotal', 'umkSelesai', 'umkBerjalan', 'umkPending',
            'recentKkpr', 'recentUmk', 'kkprStatus', 'umkStatus', 'userProfile'
        ));
    }
}
