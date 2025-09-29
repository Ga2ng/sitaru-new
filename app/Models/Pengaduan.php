<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengaduan extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['user_id', 'nama_pengadu', 'telp_pengadu', 'alamat', 'kecamatan_id', 'desa_id', 'lat_pengaduan', 'lng_pengaduan', 'kepemilikan', 'kondisi_lahan', 'luas', 'bts_kanan', 'bts_kiri', 'dampak', 'foto_1', 'foto_2', 'foto_3', 'foto_4', 'foto_5', 'uraian', 'kendala', 'solusi', 'tgl_masuk', 'status'];

    public static $statusList = [
        'Data Masuk' => 'Data Masuk',
        // 'Verifikasi' => 'Verifikasi',
        // 'Survey' => 'Survey',
        'Proses' => 'Proses',
        'Ditolak' => 'Ditolak',
        // 'Disetujui' => 'Disetujui',
        // 'Analisis' => 'Analisis',
        // 'Draft' => 'Draft',
        // 'Hasil Penilaian' => 'Hasil Penilaian',
        'Selesai' => 'Selesai'
    ];

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

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

}
