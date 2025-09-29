<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dokumen extends Model
{
    use HasFactory;

    public $timestamps = false;
	protected $fillable = [
        'filename', 'status', 'keterangan', 'user_id', 'nama'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
