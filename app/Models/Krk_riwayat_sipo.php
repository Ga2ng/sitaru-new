<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Krk_sipo;

class Krk_riwayat_sipo  extends Model
{
    protected $table = 'krk_riwayat_sipo';
    protected $fillable = ['krk_id', 'status_id', 'status','keterangan','revisi_detail'];

    public function krk()
    {
        return $this->belongsTo(Krk_sipo::class, 'krk_id');
    }
}
