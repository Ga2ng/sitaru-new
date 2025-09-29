<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Desa extends Model
{
    use HasFactory;

	public $timestamps = false;
    protected $fillable = ['nama', 'kecamatan_id'];

    public function kecamatan()
    {
    	return $this->belongsTo(Kecamatan::class, 'kecamatan_id');
    }
}
