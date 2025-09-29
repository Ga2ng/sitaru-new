<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Kkpr_non;

class Kkpr_non_riwayat  extends Model
{
    protected $table = 'kkpr_non_riwayat';
    protected $fillable = ['kkpr_non_id', 'status_id', 'status','keterangan','revisi_detail'];

    public function kkpr_non()
    {
        return $this->belongsTo(Kkpr_non::class, 'kkpr_non_id');
    }
}
