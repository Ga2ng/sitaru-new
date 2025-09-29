<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Status_tanah_detail extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'status_tanah_detail';
    protected $fillable = ['ap_id', 'keterangan'];
}
