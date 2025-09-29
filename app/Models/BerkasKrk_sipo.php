<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BerkasKrk_sipo extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'berkas_krks_sipo';
    protected $fillable = ['krk_id', 'persyaratan_id', 'filename', 'status', 'keterangan'];
}
