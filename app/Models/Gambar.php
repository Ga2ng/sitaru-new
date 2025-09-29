<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gambar extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['ap_id', 'filename', 'keterangan'];
}
