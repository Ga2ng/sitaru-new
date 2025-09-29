<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ap_riwayat_sipo extends Model
{
    use HasFactory;

    protected $table = 'ap_riwayat_sipo';
    protected $fillable = ['ap_id', 'status_id', 'status','keterangan','revisi_detail'];
}
