<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['site_name', 'email', 'phone', 'address', 'poscode', 'kabupaten', 'kecamatan', 'kelurahan', 'lang', 'lat', 'place_id', 'footer', 'm_keyword', 'm_desc', 'm_auth', 'home_info', 'berita', 'newsletter'];
}
