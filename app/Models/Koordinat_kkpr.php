<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Koordinat_kkpr extends Model
{
    use HasFactory;

    protected $table = 'koordinat_kkpr';
    protected $fillable = ['id_kkpr', 'jenis','lati', 'longi', 'f_ktp', 'f_sertifikat', 'f_siteplan', 'f_akta'];

    public function kkpr()
    {
        return $this->belongsTo(Kkpr::class, 'id_kkpr');
    }
}
