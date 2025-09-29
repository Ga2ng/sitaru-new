<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Kecamatan;

class Kabupaten extends Model
{
    use HasFactory;

	public $timestamps = false;
    protected $fillable = ['nama'];

    public function kecamatan()
    {
    	return $this->hasMany(Kecamatan::class, 'kabupaten_id');
    }
}
