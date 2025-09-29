<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\AdvancedPlaning;

class Tracker extends Model
{
    use HasFactory;

    protected $fillable = ['ap_id', 'status', 'keterangan'];

    public function ap()
    {
        return $this->belongsTo(AdvancedPlaning::class, 'ap_id');
    }
}
