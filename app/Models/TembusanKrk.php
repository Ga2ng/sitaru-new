<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TembusanKrk extends Model
{
    use HasFactory;

    protected $table = 'tembusan_krk';
    public $timestamps = false;
    protected $fillable = ['krk_id', 'text'];
}
