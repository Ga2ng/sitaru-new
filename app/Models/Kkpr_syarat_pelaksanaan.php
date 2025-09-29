<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kkpr_syarat_pelaksanaan  extends Model
{
    protected $table = 'kkpr_syarat_pelaksanaan';
    protected $fillable = ['kkpr_id', 'keterangan'];

    public function kkpr()
    {
        return $this->belongsTo(Kkpr::class, 'kkpr_id');
    }
}
