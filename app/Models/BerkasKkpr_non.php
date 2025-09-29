<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BerkasKkpr_non extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'kkpr_non_berkas';
    protected $fillable = ['kkpr_non_id', 'persyaratan_id', 'filename', 'status', 'keterangan'];
}
