<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Kkpr;

class Kkpr_terbit extends Model
{
    use HasFactory;

    protected $table = 'kkpr_terbit';
    protected $fillable = ['id_kkpr', 'no_terbit', 'tgl_terbit', 'file_kkpr'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function kkpr()
    {
        return $this->belongsTo(Kkpr::class, 'id_kkpr');
    }

}
