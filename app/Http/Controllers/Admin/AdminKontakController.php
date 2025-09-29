<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kontak;
use Illuminate\Http\Request;

class AdminKontakController extends Controller
{
    private $base_view = 'admin.kontak.';
    private $path = 'admin.kontak';

    public function index()
    {
        $kontaks = Kontak::orderBy('created_at', 'desc')->paginate(10);

        // Count statistics
        $totalKontaks = Kontak::count();
        $todayKontaks = Kontak::whereDate('created_at', today())->count();
        $thisWeekKontaks = Kontak::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();
        $thisMonthKontaks = Kontak::whereMonth('created_at', now()->month)->count();

        $data = [
            'title' => 'Kontak Management',
            'kontaks' => $kontaks,
            'totalKontaks' => $totalKontaks,
            'todayKontaks' => $todayKontaks,
            'thisWeekKontaks' => $thisWeekKontaks,
            'thisMonthKontaks' => $thisMonthKontaks,
        ];
        return view($this->base_view . 'index', $data);
    }

    public function show($id)
    {
        $kontak = Kontak::findOrFail($id);
        $data = [
            'title' => 'Detail Kontak',
            'kontak' => $kontak,
        ];
        return view($this->base_view . 'show', $data);
    }

    public function destroy($id)
    {
        $kontak = Kontak::findOrFail($id);
        $kontak->delete();
        
        return redirect()->route($this->path . '.index')
            ->with('success', 'Kontak berhasil dihapus!');
    }
}
