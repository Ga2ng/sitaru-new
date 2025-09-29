<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Koordinat extends Model
{
    use HasFactory;

    //
    protected $fillable = ['ap_id', 'longitude', 'lattitude'];
}
