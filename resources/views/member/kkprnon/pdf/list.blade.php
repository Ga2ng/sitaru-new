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

@section('title', 'Daftar Permohonan KKPR Non Usaha')
@section('document_type', 'Daftar Permohonan KKPR Non Usaha')
@section('document_number', 'LAPORAN-' . date('Ymd'))
@section('document_status', 'Laporan')

<!-- Summary Statistics -->
<div class="section">
    <div class="section-title">RINGKASAN STATISTIK</div>
    <div class="data-table">
        <table>
            <tr>
                <th style="width: 30%;">Total Permohonan</th>
                <td>{{ $permohonan->count() }}</td>
            </tr>
            <tr>
                <th>Permohonan Selesai</th>
                <td>{{ $permohonan->where('proses', 10)->count() }}</td>
            </tr>
            <tr>
                <th>Sedang Diproses</th>
                <td>{{ $permohonan->where('proses', '!=', 10)->count() }}</td>
            </tr>
            <tr>
                <th>Perlu Revisi</th>
                <td>{{ $permohonan->where('revisi', 1)->count() }}</td>
            </tr>
            <tr>
                <th>Tanggal Laporan</th>
                <td>{{ date('d F Y H:i') }} WIB</td>
            </tr>
        </table>
    </div>
</div>

<!-- Data Permohonan -->
<div class="section">
    <div class="section-title">DAFTAR PERMOHONAN KKPR NON USAHA</div>
    <div class="data-table">
        <table>
            <thead>
                <tr>
                    <th style="width: 8%;">No</th>
                    <th style="width: 12%;">Tanggal</th>
                    <th style="width: 20%;">Nama Pemohon</th>
                    <th style="width: 15%;">Jenis Kegiatan</th>
                    <th style="width: 20%;">Alamat</th>
                    <th style="width: 10%;">Luas (m²)</th>
                    <th style="width: 15%;">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($permohonan as $index => $item)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-center">{{ $item->created_at->format('d/m/Y') }}</td>
                    <td>{{ $item->user->name ?? '-' }}</td>
                    <td>{{ $item->jenis_kegiatan ?? '-' }}</td>
                    <td>{{ Str::limit($item->alamat_kegiatan ?? $item->alamat_tanah, 30) }}</td>
                    <td class="text-right">{{ $item->luas_dimohon ? safeNumberFormat($item->luas_dimohon) : '-' }}</td>
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
                            $currentStatus = $statusConfig[$item->proses] ?? 'Pengajuan';
                        @endphp
                        <span class="badge 
                            @if($item->proses == 10) badge-success
                            @elseif($item->revisi == 1) badge-danger
                            @elseif($item->proses >= 7) badge-info
                            @else badge-warning
                            @endif">
                            {{ $currentStatus }}
                        </span>
                        @if($item->revisi == 1)
                            <br><span class="badge badge-danger">Revisi</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Status Breakdown -->
<div class="section">
    <div class="section-title">RINCIAN STATUS PERMOHONAN</div>
    <div class="data-table">
        <table>
            <thead>
                <tr>
                    <th style="width: 30%;">Status</th>
                    <th style="width: 15%;">Jumlah</th>
                    <th style="width: 15%;">Persentase</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $total = $permohonan->count();
                    $statusCounts = [
                        'Pengajuan' => $permohonan->where('proses', 1)->count(),
                        'Upload Dokumen' => $permohonan->where('proses', 2)->count(),
                        'Verifikasi Dokumen' => $permohonan->where('proses', 3)->count(),
                        'Upload Bukti Bayar' => $permohonan->where('proses', 4)->count(),
                        'Survey' => $permohonan->where('proses', 5)->count(),
                        'Analisa' => $permohonan->where('proses', 6)->count(),
                        'Persetujuan Dokumen' => $permohonan->where('proses', 7)->count(),
                        'Dokumen Terbit' => $permohonan->where('proses', 8)->count(),
                        'Selesai' => $permohonan->where('proses', 10)->count(),
                        'Perlu Revisi' => $permohonan->where('revisi', 1)->count(),
                    ];
                @endphp
                @foreach($statusCounts as $status => $count)
                <tr>
                    <td>{{ $status }}</td>
                    <td class="text-center">{{ $count }}</td>
                    <td class="text-center">{{ $total > 0 ? number_format(($count / $total) * 100, 1) : 0 }}%</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Footer Information -->
<div class="section">
    <div class="data-table">
        <table>
            <tr>
                <th style="width: 30%;">Dibuat Oleh</th>
                <td>Sistem Informasi Tata Ruang Kabupaten Jombang</td>
            </tr>
            <tr>
                <th>Tanggal Cetak</th>
                <td>{{ date('d F Y H:i') }} WIB</td>
            </tr>
            <tr>
                <th>Total Halaman</th>
                <td>1</td>
            </tr>
        </table>
    </div>
</div>
