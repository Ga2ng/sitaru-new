<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Berkas_sipo extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'berkas_sipo';
    protected $fillable = ['ap_id', 'persyaratan_id', 'filename', 'status', 'keterangan'];
}
