<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Koordinat;
use App\Models\Tinjauan;
use App\Models\Arahan;
use App\Models\Tambahan;
use App\Models\Tembusan;
use App\Models\Gambar;
use App\Models\Berkas;
use App\Models\StatusTanah;
use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\Kabupaten;
use App\Models\Tracker;
use App\Models\KategoriKrk;


class AdvancedPlaning extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tgl_surat',
        'no_surat',
        'jenis',
        'nik',
        'nama_usaha',
        'jabatan_pemohon',
        'kepimilikan',
        'nama_pemilik',
        'umur_pemilik',
        'alamat_pemilik',
        'pekerjaan_pemilik',
        'alamat_tanah',
        'kabupaten_id',
        'kecamatan_id',
        'kelurahan_id',
        'luas_awal',
        'luas_bangunan',
        'luas_dimohon',
        'ket_hakmilik',
        'batas_barat',
        'batas_timur',
        'batas_utara',
        'batas_selatan',
        'penggunaan_awal',
        'jns_penggunaan',
        'penggunaan_baru',
        'peruntukan',
        'tgl_terima',
        'penerima',
        'tgl_kembali',
        'penerima_kembali',
        'tgl_terbit',
        'ket_terima',
        'tgl_tl',
        'petugas_tl',
        'kesesuaian',
        'kawasan_sekitar',
        'tte',
        'status_permohonan',
        'keterangan',
        'berkas_draft',
        'berkas_jadi',
        'petugas_id',
        'output',
        'status',
        'longitude',
        'lattitude',
        'nama_pengurus',
        'tel_kantor',
        'hp_hrd',
        'alamat_kantor',
        'ktp_pemilik',
        'jam_terima',
        'jam_kembali',
        'tte_date',
        'no_reg',
        'tte_posx',
        'tte_posy',
        'tte_posp',
        'paraf_from',
        'paraf',
        'proses',
        'revisi',
        'template',
        'deleted',
        'status_doc',
        'file',
    ];

    protected function casts(): array
    {
        return [
            'tgl_surat' => 'date',
            'tgl_terima' => 'date',
            'tgl_kembali' => 'date',
            'tgl_terbit' => 'date',
            'tgl_tl' => 'date',
            'tte_date' => 'datetime',
            'jam_terima' => 'datetime',
            'jam_kembali' => 'datetime',
            'deleted' => 'boolean',
        ];
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function koordinat()
    {
        return $this->hasMany(Koordinat::class, 'ap_id');
    }

    public function tinjauan()
    {
        return $this->hasMany(Tinjauan::class, 'ap_id');
    }

    public function arahan()
    {
        return $this->hasMany(Arahan::class, 'ap_id');
    }

    public function tambahan()
    {
        return $this->hasMany(Tambahan::class, 'ap_id');
    }

    public function tembusan()
    {
        return $this->hasMany(Tembusan::class, 'ap_id');
    }

    public function gambars()
    {
        return $this->hasMany(Gambar::class, 'ap_id');
    }

    public function berkas()
    {
        return $this->hasMany(Berkas::class, 'ap_id');
    }

    public function tanah()
    {
        return $this->hasMany(StatusTanah::class, 'ap_id');
    }

    public function kelurahan()
    {
        return $this->belongsTo(Desa::class, 'kelurahan_id');
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id');
    }

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class, 'kabupaten_id');
    }

    public function tracks()
    {
        return $this->hasMany(Tracker::class, 'ap_id');
    }
}


