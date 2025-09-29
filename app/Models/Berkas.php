<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Berkas extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['ap_id', 'persyaratan_id', 'filename', 'status', 'keterangan'];
}
