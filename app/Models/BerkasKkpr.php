<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BerkasKkpr extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'kkpr_berkas';
    protected $fillable = ['kkpr_id', 'persyaratan_id', 'filename', 'status', 'keterangan'];
}
