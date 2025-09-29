<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ap_riwayat  extends Model
{
    protected $table = 'ap_riwayat';
    protected $fillable = ['ap_id', 'status_id', 'status','keterangan','revisi_detail'];
}
