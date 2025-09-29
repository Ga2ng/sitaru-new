<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sertifikat extends Model
{
    use HasFactory;

    //
    protected $fillable = ['kkpr_id', 'kkpr_non_id','krk_id','jenis','keterangan'];
}
