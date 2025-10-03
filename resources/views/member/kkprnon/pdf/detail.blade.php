@extends('member.kkprnon.pdf.layout')

@php
    // Helper function untuk format number yang aman
    function safeNumberFormat($value, $decimals = 0) {
        if (is_null($value) || $value === '') {
            return '-';
        }
        if (is_array($value)) {
            return implode(', ', array_map(function($v) use ($decimals) {
                return number_format((float)$v, $decimals);
            }, $value));
        }
        return number_format((float)$value, $decimals);
    }
@endphp

@section('title', 'Detail Permohonan KKPR Non Usaha')
@section('document_type', 'Detail Permohonan KKPR Non Usaha')
@section('document_number', '#KKPR-NON-' . str_pad($model->id, 6, '0', STR_PAD_LEFT))
@section('document_status', $model->revisi == 1 ? 'Perlu Revisi' : 'Sedang Diproses')

<!-- Data Pemohon -->
<div class="section">
    <div class="section-title">DATA PEMOHON</div>
    <div class="data-table">
        <table>
            <tr>
                <th style="width: 30%;">Nama Lengkap</th>
                <td>{{ $model->user->name ?? '-' }}</td>
            </tr>
            <tr>
                <th>NIK</th>
                <td>{{ $model->user->nik ?? '-' }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $model->user->email ?? '-' }}</td>
            </tr>
            <tr>
                <th>No. Telepon</th>
                <td>{{ $model->user->phone ?? '-' }}</td>
            </tr>
            <tr>
                <th>Pekerjaan</th>
                <td>{{ $model->user->work ?? '-' }}</td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td>{{ $model->user->address ?? '-' }}</td>
            </tr>
        </table>
    </div>
</div>

<!-- Data Tanah -->
<div class="section">
    <div class="section-title">DATA TANAH</div>
    <div class="data-table">
        <table>
            <tr>
                <th style="width: 30%;">Alamat Tanah</th>
                <td>{{ $model->alamat_tanah ?? '-' }}</td>
            </tr>
            <tr>
                <th>Luas Tanah</th>
                <td>{{ $model->luas ? safeNumberFormat($model->luas) . ' m²' : '-' }}</td>
            </tr>
            <tr>
                <th>RT/RW</th>
                <td>{{ $model->rt ? $model->rt . '/' . $model->rw : '-' }}</td>
            </tr>
            <tr>
                <th>Status Penggunaan Tanah</th>
                <td>{{ $model->status_penggunaan_tanah ?? '-' }}</td>
            </tr>
            <tr>
                <th>Koordinat</th>
                <td>
                    @if($model->longitude && $model->lattitude)
                        Longitude: {{ $model->longitude }}, 
                        Latitude: {{ $model->lattitude }}
                    @else
                        -
                    @endif
                </td>
            </tr>
        </table>
    </div>
</div>

<!-- Data Kegiatan -->
<div class="section">
    <div class="section-title">DATA KEGIATAN</div>
    <div class="data-table">
        <table>
            <tr>
                <th style="width: 30%;">Jenis Kegiatan</th>
                <td>{{ $model->jenis_kegiatan ?? '-' }}</td>
            </tr>
            <tr>
                <th>Fungsi</th>
                <td>{{ $model->fungsi ?? '-' }}</td>
            </tr>
            <tr>
                <th>Alamat Kegiatan</th>
                <td>{{ $model->alamat_kegiatan ?? '-' }}</td>
            </tr>
            <tr>
                <th>Luas Dimohon</th>
                <td>{{ $model->luas_dimohon ? safeNumberFormat($model->luas_dimohon) . ' m²' : '-' }}</td>
            </tr>
            <tr>
                <th>Status Lahan</th>
                <td>{{ $model->status_lahan ?? '-' }}</td>
            </tr>
            <tr>
                <th>Penggunaan Sekarang</th>
                <td>{{ $model->penggunaan_sekarang ?? '-' }}</td>
            </tr>
        </table>
    </div>
</div>

<!-- Data Bangunan -->
<div class="section">
    <div class="section-title">DATA BANGUNAN</div>
    <div class="data-table">
        <table>
            <tr>
                <th style="width: 30%;">Jumlah Lantai</th>
                <td>{{ $model->jumlah_lantai ?? '-' }}</td>
            </tr>
            <tr>
                <th>Tinggi Bangunan</th>
                <td>{{ $model->tinggi_bangunan ? $model->tinggi_bangunan . ' m' : '-' }}</td>
            </tr>
            <tr>
                <th>Luas Lantai</th>
                <td>
                    @if($model->luas_lantai)
                        @if(is_array($model->luas_lantai))
                            @foreach($model->luas_lantai as $index => $luas)
                                Lantai {{ $index + 1 }}: {{ safeNumberFormat($luas) }} m²<br>
                            @endforeach
                        @else
                            {{ safeNumberFormat($model->luas_lantai) }} m²
                        @endif
                    @else
                        -
                    @endif
                </td>
            </tr>
        </table>
    </div>
</div>

<!-- Data Sertifikat -->
<div class="section">
    <div class="section-title">DATA SERTIFIKAT</div>
    <div class="data-table">
        <table>
            <tr>
                <th style="width: 30%;">Jenis Sertifikat</th>
                <td>{{ $model->jns_sertifikat ?? '-' }}</td>
            </tr>
            <tr>
                <th>No. Sertifikat</th>
                <td>{{ $model->no_sertifikat ?? '-' }}</td>
            </tr>
            <tr>
                <th>Atas Nama</th>
                <td>{{ $model->an_sertifikat ?? '-' }}</td>
            </tr>
            <tr>
                <th>Tahun Sertifikat</th>
                <td>{{ $model->thn_sertifikat ?? '-' }}</td>
            </tr>
            <tr>
                <th>Luas Sertifikat</th>
                <td>{{ $model->luas_sertifikat ? safeNumberFormat($model->luas_sertifikat) . ' m²' : '-' }}</td>
            </tr>
        </table>
    </div>
</div>

<!-- Data NIB -->
<div class="section">
    <div class="section-title">DATA NIB</div>
    <div class="data-table">
        <table>
            <tr>
                <th style="width: 30%;">No. NIB</th>
                <td>{{ $model->no_nib ?? '-' }}</td>
            </tr>
            <tr>
                <th>Tanggal Terbit</th>
                <td>{{ $model->tgl_terbit ?? '-' }}</td>
            </tr>
        </table>
    </div>
</div>

<!-- Data KKPR -->
<div class="section">
    <div class="section-title">DATA KKPR</div>
    <div class="data-table">
        <table>
            <tr>
                <th style="width: 30%;">No. KKPR</th>
                <td>{{ $model->no_kkpr ?? '-' }}</td>
            </tr>
            <tr>
                <th>Tanggal KKPR</th>
                <td>{{ $model->tgl_kkpr ?? '-' }}</td>
            </tr>
            <tr>
                <th>Tanggal Surat</th>
                <td>{{ $model->tgl_surat ?? '-' }}</td>
            </tr>
        </table>
    </div>
</div>

<!-- Data KBLI -->
@if($model->kkpr_kbli && $model->kkpr_kbli->count() > 0)
<div class="section">
    <div class="section-title">DATA KBLI</div>
    <div class="data-table">
        <table>
            <thead>
                <tr>
                    <th style="width: 30%;">Kode KBLI</th>
                    <th>Judul KBLI</th>
                </tr>
            </thead>
            <tbody>
                @foreach($model->kkpr_kbli as $kbli)
                <tr>
                    <td>{{ $kbli->kode_kbli }}</td>
                    <td>{{ $kbli->judul_kbli }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

<!-- Data Koordinat -->
@if($model->kkpr_koordinat && $model->kkpr_koordinat->count() > 0)
<div class="section">
    <div class="section-title">DATA KOORDINAT</div>
    <div class="data-table">
        <table>
            <thead>
                <tr>
                    <th style="width: 50%;">Longitude</th>
                    <th>Latitude</th>
                </tr>
            </thead>
            <tbody>
                @foreach($model->kkpr_koordinat as $koordinat)
                <tr>
                    <td>{{ $koordinat->longi }}</td>
                    <td>{{ $koordinat->lati }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

<!-- Status dan Tanggal -->
<div class="section">
    <div class="section-title">INFORMASI STATUS</div>
    <div class="data-table">
        <table>
            <tr>
                <th style="width: 30%;">Status Proses</th>
                <td>
                    @php
                        $statusConfig = [
                            1 => 'Pengajuan',
                            2 => 'Upload Dokumen',
                            3 => 'Verifikasi Dokumen',
                            4 => 'Upload Bukti Bayar',
                            5 => 'Survey',
                            6 => 'Analisa',
                            7 => 'Persetujuan Dokumen',
                            8 => 'Dokumen Terbit',
                            9 => 'Selesai',
                            10 => 'Selesai',
                        ];
                        $currentStatus = $statusConfig[$model->proses] ?? 'Pengajuan';
                    @endphp
                    {{ $currentStatus }}
                    @if($model->revisi == 1)
                        <span class="badge badge-warning">Revisi</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Tanggal Dibuat</th>
                <td>{{ $model->created_at->format('d F Y H:i') }} WIB</td>
            </tr>
            <tr>
                <th>Terakhir Diupdate</th>
                <td>{{ $model->updated_at->format('d F Y H:i') }} WIB</td>
            </tr>
        </table>
    </div>
</div>
