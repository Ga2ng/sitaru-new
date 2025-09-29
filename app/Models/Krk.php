<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\KategoriKrk;
use App\Models\User;
use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\Kabupaten;
use App\Models\BerkasKrk;
use App\Models\GambarKrk;
use App\Models\RekomKrk;
use App\Models\TembusanKrk;

class Krk extends Model
{
    use HasFactory;

    protected $table = 'krk';
    protected $fillable = ['kategori_id', 'status_doc', 'file', 'user_id', 'no_krk', 'tgl_surat', 'alamat_tanah', 'kabupaten_id', 'kecamatan_id', 'kelurahan_id', 'luas', 'jns_sertifikat', 'thn_sertifikat', 'no_sertifikat', 'an_sertifikat', 'luas_sertifikat', 'penggunaan_awal', 'penggunaan_baru', 'foto_barat', 'foto_timur', 'foto_utara', 'foto_selatan', 'longitude', 'lattitude', 'tgl_terima', 'penerima', 'tgl_kembali', 'penerima_kembali', 'ket_terima', 'tgl_terbit', 'status_permohonan', 'keterangan', 'berkas_jadi', 'tgl_tl', 'petugas_tl', 'petugas_id', 'ktp_pemilik', 'kepimilikan', 'nama_pemilik', 'umur_pemilik', 'alamat_pemilik', 'pekerjaan_pemilik', 'jam_terima', 'jam_kembali','tte','berkas_draft','output','status','zona', 'sub_zona', 'sesuai', 'bts_kdb', 'bts_gsb','bts_gsb_samping', 'bts_rth', 'bts_klb','bts_ketinggian' ,'gbr_lokasi', 'rt', 'rw', 'no_reg','paraf_from','paraf','proses','revisi','deleted','status_upload_doc','date_upload_doc'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriKrk::class, 'kategori_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
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

    public function berkas()
    {
        return $this->hasMany(BerkasKrk::class, 'krk_id');
    }

    public function gambars()
    {
        return $this->hasMany(GambarKrk::class, 'krk_id');
    }

    public function rekom()
    {
        return $this->hasMany(RekomKrk::class, 'krk_id');
    }

    public function tembusan()
    {
        return $this->hasMany(TembusanKrk::class, 'krk_id');
    }

    public function getUtaraPathAttribute()
    {
        if ($this->foto_utara == '') {
            return 'http://placehold.it/160x160';
        } else {
            return url('uploads/berkas/krk/' . $this->id .'/'. $this->foto_utara);
        }
    }

    public function getSelatanPathAttribute()
    {
        if ($this->foto_selatan == '') {
            return 'http://placehold.it/160x160';
        } else {
            return url('uploads/berkas/krk/' . $this->id .'/'. $this->foto_selatan);
        }
    }

    public function getBaratPathAttribute()
    {
        if ($this->foto_barat == '') {
            return 'http://placehold.it/160x160';
        } else {
            return url('uploads/berkas/krk/' . $this->id .'/'. $this->foto_barat);
        }
    }

    public function getTimurPathAttribute()
    {
        if ($this->foto_timur == '') {
            return 'http://placehold.it/160x160';
        } else {
            return url('uploads/berkas/krk/' . $this->id .'/'. $this->foto_timur);
        }
    }


}

