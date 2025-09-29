<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kkpr_gsb  extends Model
{
    protected $table = 'gsb_kkpr';
    public $timestamps = false;
    protected $fillable = ['kkpr_id', 'fungsi_jln', 'gsb'];

    public function kkpr()
    {
        return $this->belongsTo(Kkpr::class, 'kkpr_id');
    }
}
