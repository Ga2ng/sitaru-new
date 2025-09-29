<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Krk;

class Krk_riwayat  extends Model
{
    protected $table = 'krk_riwayat';
    protected $fillable = ['krk_id', 'status_id', 'status','keterangan','revisi_detail'];

    public function krk()
    {
        return $this->belongsTo(Krk::class, 'krk_id');
    }
}
