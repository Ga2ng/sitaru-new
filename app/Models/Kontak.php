<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kontak extends Model
{
    use HasFactory;

    protected $table = 'kontak';
    protected $fillable = ['nama_depan', 'nama_belakang', 'email', 'no_hp', 'pesan'];
}
