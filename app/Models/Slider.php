<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Slider extends Model
{
    use HasFactory;

    protected $table = 'slider';
    protected $fillable = ['judul', 'photo', 'link', 'status', 'deskripsi'];

    public function getLargeImageAttribute()
    {
        if ($this->photo == '') {
            return 'http://placehold.it/1600x600';
        } else {
            return url('uploads/images/slider/large/' . $this->photo);
        }
    }

    public function getSmallImageAttribute()
    {
        if ($this->photo == '') {
            return 'http://placehold.it/100x100';
        } else {
            return url('uploads/images/slider/small/' . $this->photo);
        }
    }
}
