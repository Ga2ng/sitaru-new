<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AdminSettingsController extends Controller
{
    private $base_view = 'admin.settings.';
    private $path = 'admin.settings';

    public function __construct()
    {
        // Middleware akan didefinisikan di routes
    }

    public function index()
    {
        $setting = Setting::first();
        
        // If no setting exists, create a default one
        if (!$setting) {
            $setting = Setting::create([
                'site_name' => 'SITARU',
                'email' => 'admin@sitaru.com',
                'm_keyword' => 'sitaru, sistem, informasi',
                'm_desc' => 'Sistem Informasi Terpadu',
                'phone' => '(0333) 123-456',
                'address' => 'Jl. Nama Jalan',
                'kelurahan' => 'Kelurahan',
                'kecamatan' => 'Kecamatan',
                'kabupaten' => 'Kabupaten',
                'poscode' => '68123',
                'lat' => '-8.2131639',
                'lang' => '114.3477306',
                'place_id' => 'ChIJAUlhhU9F0S0RNLSrCpmrgP8',
                'berita' => true,
                'home_info' => true,
                'newsletter' => true,
                'footer' => '<p>© 2024 SITARU. All rights reserved.</p>',
            ]);
        }

        $data = [
            'title' => 'Pengaturan Website',
            'setting' => $setting,
        ];
        
        return view($this->base_view . 'index', $data);
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'm_keyword' => 'required|string|max:500',
            'm_desc' => 'required|string|max:500',
            'phone' => 'required|string|max:50',
            'address' => 'required|string|max:500',
            'kelurahan' => 'required|string|max:100',
            'kecamatan' => 'required|string|max:100',
            'kabupaten' => 'required|string|max:100',
            'poscode' => 'required|string|max:10',
            'lat' => 'required|string|max:50',
            'lang' => 'required|string|max:50',
            'place_id' => 'required|string|max:100',
            'berita' => 'required|boolean',
            'home_info' => 'required|boolean',
            'newsletter' => 'required|boolean',
            'footer' => 'nullable|string',
        ]);

        $setting = Setting::first();
        
        if (!$setting) {
            $setting = new Setting();
        }

        $setting->update($request->all());

        return redirect()->route($this->path . '.index')
            ->with('success', 'Pengaturan website berhasil diperbarui!');
    }
}
