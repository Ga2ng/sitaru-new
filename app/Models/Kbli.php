<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kbli extends Model
{
    use HasFactory;

    protected $table = 'kbli';
    protected $fillable = ['id_kkpr', 'jenis', 'kode_kbli', 'judul_kbli'];

    public function kkpr()
    {
        return $this->belongsTo(Kkpr::class, 'id_kkpr');
    }
}
