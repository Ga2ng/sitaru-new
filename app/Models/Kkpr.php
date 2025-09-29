<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kkpr extends Model
{
    use HasFactory;

    protected $table = 'kkpr';
    protected $fillable = ['id', 'user_id','jenis', 'no_nib','usaha', 'status_lahan','kbli','judul_kbli','skala_usaha','fungsi','alamat_kegiatan','NO_KEC','NO_KEL','dok_kepemilikan','dok_taru','tgl_surat',
    'sp_mandiri','no_nib','f_nib','f_kml', 'f_geojson','user_id', 'luas_dimohon','luas_tanah','luas_bangunan', 
    'lattitude','longitude','status_tanah','penggunaan_sekarang','jumlah_lantai','luas_lantai','tinggi_bangunan',
    'foto_utara','foto_selatan','foto_timur','foto_barat','tgl_terima','jam_terima','penerima', 'ket_terima','tgl_kembali','jam_kembali','penerima_kembali','bukti_bayar','ba_rapat','draft_dokumen', 'dok_manual',
    'jabatan','atas_nama','status_modal','luas_tanah_rekap','koordinat_dimohon','koordinat_disetujui','luas_disetujui','jenis_peruntukan','kdb','klb','indikasi_program','gsb','jarak_bangunan','kdh','ktb', 'status_lsd', 'jml_sebagian','utilitas_kota',
    'induk_kawasan','disetujui','peta_persetujuan','proses', 'tgl_terbit', 'setuju_kadin', 'no_terbit', 'file_terbit','deleted','revisi',
    'status_penggunaan_tanah',
    'jenis_kegiatan',
    'jenis_kegiatan_lainnya',
    'f_ktp',
    'f_sertifikat', 
    'f_siteplan',
    'f_akta',
    'tgl_terbit_kkpr',
    'no_terbit_kkpr',
    'tgl_kkpr',
    'no_kkpr',
    'f_kkpr',
    'survey_status',
    'analisa_status',
    'rencana_manfaat',
    'pertimbangan',
    'status_analisa',
    'peta_analis',
    'pemeriksa_teknis',
    'kml_geojson',
    'draft_file',
    'status_rencana',
    'foto_peta'
];

    protected $casts = [
        'luas_lantai' => 'array'
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
        return $this->hasMany(BerkasKkpr::class, 'kkpr_id');
    
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    }

    public function sertifikat()
    {
        return $this->hasMany(Sertifikat::class, 'kkpr_id');
    
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    }
    public function sertifikat_non()
    {
        return $this->hasMany(Sertifikat::class, 'kkpr_non_id');
    
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    }

    public function syarat()
    {
        return $this->hasMany(Kkpr_syarat_pelaksanaan::class, 'kkpr_id');
    
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    }

    public function pertimbangan()
    {
        return $this->hasMany(Kkpr_pertimbangan::class, 'kkpr_id');
    
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    }

    public function ketentuan()
    {
        return $this->hasMany(Kkpr_ketentuan_lain::class, 'kkpr_id');
    
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    }

    public function kkpr_terbit()
    {
        return $this->hasMany(Kkpr_terbit::class, 'id_kkpr');
    
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    }
    
    public function kkpr_gsb()
    {
        return $this->hasMany(Kkpr_gsb::class, 'kkpr_id');
    
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    }

    public function kkpr_kbli()
    {
        return $this->hasMany(Kbli::class, 'id_kkpr');
    
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    }

    public function kkpr_koordinat()
    {
        return $this->hasMany(Koordinat_kkpr::class, 'id_kkpr');
    
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    }

    public function pteknis()
    {
        return $this->belongsTo(User::class, 'pemeriksa_teknis');
    
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

