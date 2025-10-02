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

@section('title', 'Daftar Permohonan UMK')
@section('document_type', 'Daftar Permohonan Persetujuan UMK')
@section('document_number', 'LAPORAN-' . date('Ymd'))
@section('document_status', 'Laporan')

@section('content')
<!-- Summary Data -->
<div class="section">
    <div class="section-title">RINGKASAN DATA</div>
    <div class="info-grid">
        <div class="info-row">
            <div class="info-label">Total Permohonan:</div>
            <div class="info-value">{{ $permohonan->count() }} permohonan</div>
        </div>
        <div class="info-row">
            <div class="info-label">Permohonan Selesai:</div>
            <div class="info-value">{{ $permohonan->where('proses', 10)->count() }} permohonan</div>
        </div>
        <div class="info-row">
            <div class="info-label">Sedang Diproses:</div>
            <div class="info-value">{{ $permohonan->where('proses', '!=', 10)->count() }} permohonan</div>
        </div>
        <div class="info-row">
            <div class="info-label">Perlu Revisi:</div>
            <div class="info-value">{{ $permohonan->where('revisi', 1)->count() }} permohonan</div>
        </div>
        <div class="info-row">
            <div class="info-label">Periode:</div>
            <div class="info-value">{{ $permohonan->min('created_at') ? $permohonan->min('created_at')->format('d F Y') : '-' }} s/d {{ $permohonan->max('created_at') ? $permohonan->max('created_at')->format('d F Y') : '-' }}</div>
        </div>
    </div>
</div>

<!-- Daftar Permohonan -->
<div class="section">
    <div class="section-title">DAFTAR PERMOHONAN</div>
    
    @if($permohonan->count() > 0)
    <div class="data-table">
        <table>
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 15%;">Tanggal</th>
                    <th style="width: 20%;">Nama Pemohon</th>
                    <th style="width: 15%;">Fungsi</th>
                    <th style="width: 20%;">Alamat</th>
                    <th style="width: 15%;">Status</th>
                    <th style="width: 10%;">Luas (m²)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($permohonan as $index => $item)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $item->created_at->format('d/m/Y') }}</td>
                    <td>{{ $item->user->name }}</td>
                    <td>{{ $item->fungsi ?? '-' }}</td>
                    <td>{{ Str::limit($item->alamat_kegiatan ?? $item->alamat_tanah, 30) }}</td>
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
                            $currentStatus = $item->proses ?? 1;
                            $statusInfo = $statusMap[$currentStatus] ?? $statusMap[1];
                        @endphp
                        <span class="status-badge {{ $statusInfo['class'] }}">
                            {{ $statusInfo['text'] }}
                        </span>
                        @if($item->revisi == 1)
                            <br><span class="status-badge status-revisi">Revisi</span>
                        @endif
                    </td>
                    <td class="text-right">{{ $item->luas_dimohon ? safeNumberFormat($item->luas_dimohon) : '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="text-center p-4">
        <p class="text-gray-600">Tidak ada data permohonan</p>
    </div>
    @endif
</div>

<!-- Statistik per Status -->
@if($permohonan->count() > 0)
<div class="section">
    <div class="section-title">STATISTIK PER STATUS</div>
    <div class="data-table">
        <table>
            <thead>
                <tr>
                    <th style="width: 30%;">Status</th>
                    <th style="width: 20%;">Jumlah</th>
                    <th style="width: 20%;">Persentase</th>
                    <th style="width: 30%;">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $total = $permohonan->count();
                    $statusCounts = [
                        'Pengajuan' => $permohonan->where('proses', 1)->count(),
                        'Upload Dokumen' => $permohonan->where('proses', 2)->count(),
                        'Verifikasi Dokumen' => $permohonan->whereIn('proses', [3, 7])->count(),
                        'Upload Bukti Bayar' => $permohonan->where('proses', 4)->count(),
                        'Verifikasi Pembayaran' => $permohonan->where('proses', 5)->count(),
                        'Survey' => $permohonan->where('proses', 6)->count(),
                        'Analisa' => $permohonan->where('proses', 8)->count(),
                        'Persetujuan Dokumen' => $permohonan->where('proses', 9)->count(),
                        'Dokumen Terbit' => $permohonan->where('proses', 10)->count(),
                    ];
                @endphp
                @foreach($statusCounts as $status => $count)
                @if($count > 0)
                <tr>
                    <td>{{ $status }}</td>
                    <td class="text-center">{{ $count }}</td>
                    <td class="text-center">{{ $total > 0 ? round(($count / $total) * 100, 1) : 0 }}%</td>
                    <td>
                        @if($status == 'Dokumen Terbit')
                            Permohonan yang telah selesai diproses
                        @elseif($status == 'Pengajuan')
                            Permohonan baru yang belum diproses
                        @else
                            Permohonan sedang dalam tahap {{ strtolower($status) }}
                        @endif
                    </td>
                </tr>
                @endif
                @endforeach
                <tr style="background: #f8f9fa; font-weight: bold;">
                    <td>Total</td>
                    <td class="text-center">{{ $total }}</td>
                    <td class="text-center">100%</td>
                    <td>Semua permohonan</td>
                </tr>
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
        <p class="text-sm">{{ Auth::user()->name }}</p>
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
