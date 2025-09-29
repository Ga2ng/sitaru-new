<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Kkpr;

class Kkpr_riwayat  extends Model
{
    protected $table = 'kkpr_riwayat';
    protected $fillable = ['kkpr_id', 'status_id', 'status','keterangan','revisi_detail'];

    public function kkpr()
    {
        return $this->belongsTo(Kkpr::class, 'kkpr_id');
    }
}
