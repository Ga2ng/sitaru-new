<?php

namespace App\Http\Controllers\Layanan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KkprController extends Controller
{
    public function index()
    {
        return view('layanan.kkpr.index');
    }
}