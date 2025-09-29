<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Kkpr;

class Kkpr_ketentuan_lain  extends Model
{
    protected $table = 'kkpr_ketentuan_lain';
    protected $fillable = ['kkpr_id', 'keterangan'];

    public function kkpr()
    {
        return $this->belongsTo(Kkpr::class, 'kkpr_id');
    }
}
