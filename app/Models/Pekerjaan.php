<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pekerjaan extends Model
{
    use HasFactory;

    //
	public $timestamps = false;
    protected $table = 'PKRJN_MASTER';
    protected $primaryKey = 'NO';
}
