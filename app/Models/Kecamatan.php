<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Kabupaten;
use App\Models\Desa;

class Kecamatan extends Model
{
    use HasFactory;

	public $timestamps = false;
    protected $fillable = ['nama', 'kabupaten_id'];

    public function kabupaten()
    {
    	return $this->belongsTo(Kabupaten::class, 'kabupaten_id');
    }

    public function desa()
    {
    	return $this->hasMany(Desa::class, 'kecamatan_id');
    }
}
