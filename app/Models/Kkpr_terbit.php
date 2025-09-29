<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kkpr_terbit extends Model
{
    use HasFactory;

    protected $table = 'kkpr_terbit';
    protected $fillable = ['id_kkpr', 'no_terbit', 'tgl_terbit', 'file_kkpr'];

    public function kkpr()
    {
        return $this->belongsTo(Kkpr::class, 'id_kkpr');
    
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    }

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

}
