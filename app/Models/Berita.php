<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'berita';
    protected $fillable = [
        'kategori_id',
        'nama',
        'slug',
        'deskripsi',
        'konten',
        'photo',
        'status',
        'dilihat',
    ];

    public function getImageUrlAttribute()
    {
        if ($this->photo == '') {
            return asset('images/no-image.png');
        } else {
            return asset('uploads/images/berita/' . $this->photo);
        }
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}
