<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tembusan extends Model
{
    use HasFactory;

    protected $table = 'tembusan';
    public $timestamps = false;
    protected $fillable = ['ap_id', 'text','urutan'];
}
