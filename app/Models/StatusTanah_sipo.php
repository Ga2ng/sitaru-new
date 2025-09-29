<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StatusTanah_sipo extends Model
{
    use HasFactory;

    //
    protected $table = 'status_tanahs_sipo';
    protected $fillable = ['ap_id', 'nama'];
}
