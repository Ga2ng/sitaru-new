<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GambarKrk extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['krk_id', 'filename', 'keterangan'];
}
