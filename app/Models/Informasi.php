<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Informasi extends Model
{
    use HasFactory;

    protected $table = 'informasi';
    protected $fillable = ['nama', 'slug', 'deskripsi', 'konten', 'photo', 'status', 'dilihat'];
    
    public function getLargeImageAttribute()
    {
        if ($this->photo == '') {
            return 'http://placehold.it/800x400';
        } else {
            return url('uploads/images/informasi/large/' . $this->photo);
        }
    }
    public function getMediumImageAttribute()
    {
        if ($this->photo == '') {
            return 'http://placehold.it/325x350';
        } else {
            return url('uploads/images/informasi/medium/' . $this->photo);
        }
    }
    public function getSmallImageAttribute()
    {
        if ($this->photo == '') {
            return 'http://placehold.it/100x100';
        } else {
            return url('uploads/images/informasi/small/' . $this->photo);
        }
    }
}
