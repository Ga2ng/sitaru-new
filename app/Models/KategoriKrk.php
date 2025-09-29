<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Krk;

class KategoriKrk extends Model
{
    use HasFactory;

    protected $table = 'kategori_krk';
    public $timestamps = false;
    protected $fillable = ['id', 'nama', 'text'];

    public function krks()
    {
        return $this->hasMany(Krk::class, 'kategori_id');
    }
}
