<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kkpr;
use Illuminate\Http\Request;

class AdminPetaController extends Controller
{
    private $base_view = 'admin.peta.';
    private $path = 'admin.peta';
    private $umk_path = 'admin.kkpr';
    private $kkpr_path = 'admin.kkprnon';

    public function index()
    {
        $umk = Kkpr::select('kkpr.*')
            ->join('users', 'user_id', '=', 'users.id')
            ->where('kkpr.deleted', 0)
            ->where('kkpr.jenis', '=', 'usaha')
            ->whereNotNull('kkpr.f_geojson')
            ->get();

        $kkpr = Kkpr::select('kkpr.*')
            ->join('users', 'user_id', '=', 'users.id')
            ->where('kkpr.deleted', 0)
            ->where('kkpr.jenis', '=', 'non_usaha')
            ->whereNotNull('kkpr.f_geojson')
            ->get();

        $data = [
            'title' => 'Peta Persebaran',
            'umk' => $umk,
            'kkpr' => $kkpr,
            'umk_path' => $this->umk_path,
            'kkpr_path' => $this->kkpr_path,
        ];

        return view($this->base_view . 'index', $data);
    }
}

