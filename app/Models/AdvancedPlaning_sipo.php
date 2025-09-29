<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdvancedPlaning_sipo extends Model
{
    use HasFactory;

    protected $table = 'advanced_planings_sipo';
    protected $fillable = ['user_id', 'tgl_surat', 'no_surat', 'jenis', 'nik', 'nama_usaha', 'jabatan_pemohon', 'kepimilikan', 'nama_pemilik', 'umur_pemilik',
     'alamat_pemilik', 'pekerjaan_pemilik', 'alamat_tanah', 'kabupaten_id', 'kecamatan_id', 'kelurahan_id', 'luas_awal', 'luas_bangunan','luas_dimohon' ,
     'ket_hakmilik', 'batas_barat', 'batas_timur', 'batas_utara', 'batas_selatan', 'penggunaan_awal', 'jns_penggunaan', 'penggunaan_baru', 'peruntukan',
      'tgl_terima', 'penerima', 'tgl_kembali', 'penerima_kembali', 'tgl_terbit', 'ket_terima', 'tgl_tl', 'petugas_tl', 'kesesuaian', 'kawasan_sekitar',
      'tte','status_permohonan', 'keterangan','berkas_draft', 'berkas_jadi', 'petugas_id','output','status', 'longitude', 'lattitude', 'nama_pengurus',
       'tel_kantor', 'hp_hrd', 'alamat_kantor', 'ktp_pemilik', 'jam_terima', 'jam_kembali', 'tte_date', 'no_reg','tte_posx','tte_posy','tte_posp','paraf','proses','revisi','template','deleted'];
    
    public function user()
    {
        return $this->belongsTo(User_sipo::class, 'user_id');
    
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    }

    public function koordinat()
    {
        return $this->hasMany(Koordinat::class, 'ap_id');
    
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    }

    public function tinjauan()
    {
        return $this->hasMany(Tinjauan::class, 'ap_id');
    
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    }

    public function arahan()
    {
        return $this->hasMany(Arahan::class, 'ap_id');
    
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    }

    public function tambahan()
    {
        return $this->hasMany(Tambahan::class, 'ap_id');
    
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    }

    public function tembusan()
    {
        return $this->hasMany(Tembusan::class, 'ap_id');
    
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    }

    public function gambars()
    {
        return $this->hasMany(Gambar::class, 'ap_id');
    
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
        return $this->hasMany(Berkas::class, 'ap_id');
    
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    }

    public function tanah()
    {
        return $this->hasMany(StatusTanah_sipo::class, 'ap_id');
    
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

    public function tracks()
    {
        return $this->hasMany(Tracker::class, 'ap_id');
    
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


