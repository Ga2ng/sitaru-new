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

    public function getLargeImageAttribute()
    {
        if ($this->photo == '') {
            return 'http://placehold.it/800x400';
        } else {
            return url('uploads/images/berita/large/' . $this->photo);
        }
    }
    public function getMediumImageAttribute()
    {
        if ($this->photo == '') {
            return 'http://placehold.it/600x400';
        } else {
            return url('uploads/images/berita/medium/' . $this->photo);
        }
    }
    public function getSmallImageAttribute()
    {
        if ($this->photo == '') {
            return 'http://placehold.it/100x100';
        } else {
            return url('uploads/images/berita/small/' . $this->photo);
        }
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}
