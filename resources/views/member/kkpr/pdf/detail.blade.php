@extends('member.kkpr.pdf.layout')

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

@section('title', 'Detail Permohonan UMK')
@section('document_type', 'Detail Permohonan Persetujuan UMK')
@section('document_number', '#UMK-' . str_pad($model->id, 6, '0', STR_PAD_LEFT))
@section('document_status', $model->revisi == 1 ? 'Perlu Revisi' : 'Sedang Diproses')

@section('content')
<!-- Data Pemohon -->
<div class="section">
    <div class="section-title">DATA PEMOHON</div>
    <div class="data-table">
        <table>
            <tr>
                <th style="width: 30%;">Nama Lengkap</th>
                <td>{{ $model->user->name }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $model->user->email }}</td>
            </tr>
            <tr>
                <th>No. HP</th>
                <td>{{ $model->user->phone ?? '-' }}</td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td>{{ $model->user->address ?? '-' }}</td>
            </tr>
            <tr>
                <th>Tanggal Pengajuan</th>
                <td>{{ $model->created_at->format('d F Y, H:i') }} WIB</td>
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
                <th>Koordinat</th>
                <td>
                    @if($model->longitude && $model->lattitude)
                        Longitude: {{ $model->longitude }}<br>
                        Latitude: {{ $model->lattitude }}
                    @else
                        -
                    @endif
                </td>
            </tr>
            <tr>
                <th>Status Penggunaan Tanah</th>
                <td>{{ $model->status_penggunaan_tanah ?? '-' }}</td>
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
                <th>Fungsi Bangunan</th>
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
                <th>Luas Tanah</th>
                <td>{{ $model->luas_tanah ? safeNumberFormat($model->luas_tanah) . ' m²' : '-' }}</td>
            </tr>
            <tr>
                <th>Status Lahan</th>
                <td>{{ $model->status_lahan ?? '-' }}</td>
            </tr>
            <tr>
                <th>Status Tanah</th>
                <td>{{ $model->status_tanah ?? '-' }}</td>
            </tr>
            <tr>
                <th>Penggunaan Sekarang</th>
                <td>{{ $model->penggunaan_sekarang ?? '-' }}</td>
            </tr>
            <tr>
                <th>Jumlah Lantai</th>
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
@if($model->nib || $model->no_nib || $model->tgl_terbit)
<div class="section">
    <div class="section-title">DATA NIB</div>
    <div class="data-table">
        <table>
            <tr>
                <th style="width: 30%;">NIB</th>
                <td>{{ $model->nib ?? '-' }}</td>
            </tr>
            <tr>
                <th>No. NIB</th>
                <td>{{ $model->no_nib ?? '-' }}</td>
            </tr>
            <tr>
                <th>Tanggal Terbit</th>
                <td>{{ $model->tgl_terbit ?? '-' }}</td>
            </tr>
            <tr>
                <th>Tanggal Surat</th>
                <td>{{ $model->tgl_surat ?? '-' }}</td>
            </tr>
        </table>
    </div>
</div>
@endif

<!-- Status dan Riwayat -->
<div class="section">
    <div class="section-title">STATUS PERMOHONAN</div>
    <div class="data-table">
        <table>
            <tr>
                <th style="width: 30%;">Status Proses</th>
                <td>
                    @php
                        $statusMap = [
                            1 => ['text' => 'Pengajuan', 'class' => 'status-pengajuan'],
                            2 => ['text' => 'Upload Dokumen', 'class' => 'status-proses'],
                            3 => ['text' => 'Verifikasi Dokumen', 'class' => 'status-proses'],
                            4 => ['text' => 'Upload Bukti Bayar', 'class' => 'status-proses'],
                            5 => ['text' => 'Verifikasi Pembayaran', 'class' => 'status-proses'],
                            6 => ['text' => 'Survey', 'class' => 'status-proses'],
                            7 => ['text' => 'Verifikasi Dokumen', 'class' => 'status-proses'],
                            8 => ['text' => 'Analisa', 'class' => 'status-proses'],
                            9 => ['text' => 'Persetujuan Dokumen', 'class' => 'status-proses'],
                            10 => ['text' => 'Dokumen Terbit', 'class' => 'status-selesai'],
                        ];
                        $currentStatus = $model->proses ?? 1;
                        $statusInfo = $statusMap[$currentStatus] ?? $statusMap[1];
                    @endphp
                    <span class="status-badge {{ $statusInfo['class'] }}">
                        {{ $statusInfo['text'] }}
                    </span>
                    @if($model->revisi == 1)
                        <span class="status-badge status-revisi">Perlu Revisi</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Tanggal Update Terakhir</th>
                <td>{{ $model->updated_at->format('d F Y, H:i') }} WIB</td>
            </tr>
        </table>
    </div>
</div>

<!-- KBLI Data -->
@if($model->kkpr_kbli && $model->kkpr_kbli->count() > 0)
<div class="section">
    <div class="section-title">DATA KBLI</div>
    <div class="data-table">
        <table>
            <thead>
                <tr>
                    <th style="width: 20%;">Kode KBLI</th>
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

<!-- Koordinat Data -->
@if($model->kkpr_koordinat && $model->kkpr_koordinat->count() > 0)
<div class="section">
    <div class="section-title">DATA KOORDINAT</div>
    <div class="data-table">
        <table>
            <thead>
                <tr>
                    <th style="width: 20%;">No</th>
                    <th style="width: 40%;">Longitude</th>
                    <th style="width: 40%;">Latitude</th>
                </tr>
            </thead>
            <tbody>
                @foreach($model->kkpr_koordinat as $index => $koordinat)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $koordinat->longi }}</td>
                    <td>{{ $koordinat->lati }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

<!-- Tanda Tangan -->
<div class="signature-section">
    <div class="signature-box">
        <p class="text-sm mb-4">Pemohon</p>
        <div class="signature-line"></div>
        <p class="text-sm">{{ $model->user->name }}</p>
        <p class="text-sm">{{ date('d F Y') }}</p>
    </div>
    <div class="signature-box">
        <p class="text-sm mb-4">Petugas</p>
        <div class="signature-line"></div>
        <p class="text-sm">Petugas SITARU</p>
        <p class="text-sm">{{ date('d F Y') }}</p>
    </div>
</div>
@endsection
