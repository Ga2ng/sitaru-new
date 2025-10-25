<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Berita;
use App\Models\Informasi;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $settings = Setting::first();
        
        // Initialize empty collections
        $berita = collect();
        $informasi = collect();

        // dd($settings->berita);
        
        // Get berita if enabled
        if ($settings && $settings->berita) {
            $berita = Berita::where('status', '=', 'aktif')
                ->orderBy('created_at', 'desc')
                // ->limit(6)
                ->get();
        }

        
        // Get informasi if enabled
        if ($settings && $settings->home_info) {
            $informasi = Informasi::where('status', '=', 'aktif')
                ->orderBy('created_at', 'desc')
                // ->limit(6)
                ->get();
        }
        
        return view('welcome', compact('settings', 'berita', 'informasi'));
    }
}
