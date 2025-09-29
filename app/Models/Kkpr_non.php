<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kkpr_non extends Model
{
    use HasFactory;

    protected $table = 'kkpr_non';
    protected $fillable = ['id', 'user_id', 'fungsi','alamat_kegiatan','NO_KEC','NO_KEL','user_id', 'luas_dimohon','luas_tanah','luas_bangunan', 
    'lattitude','longitude','status_tanah','penggunaan_sekarang','jumlah_lantai','luas_lantai','tinggi_bangunan'
    ,'foto_utara','foto_selatan','foto_timur','foto_barat','tgl_terima','jam_terima','penerima', 'ket_terima','tgl_kembali','jam_kembali','penerima_kembali','proses','deleted'];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    }

    public function kelurahan()
    {
        return $this->belongsTo(Desa::class, 'kelurahan_id');
    
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id');
    
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    }

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class, 'kabupaten_id');
    
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    }

    public function berkas()
    {
        return $this->hasMany(BerkasKkpr_non::class, 'kkpr_non_id');
    
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

