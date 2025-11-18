@extends('layouts.app')

@section('title', 'SITARU - Persetujuan Bagi UMK')
@section('subtitle', 'Penilaian untuk Persetujuan Bagi UMK')

@section('content')
<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<div class="max-w-7xl mx-auto space-y-6">
    <!-- Hero Section with Gradient -->
    <div class="relative overflow-hidden bg-gradient-to-br from-[#185B3C] via-[#0F3D26] to-[#185B3C] rounded-xl p-6 text-white">
        <div class="absolute inset-0 bg-black/10"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between">
                <div>
                <h1 class="text-2xl font-bold mb-1">Persetujuan Bagi UMK</h1>
                <p class="text-sm text-white/90 mb-4">Penilaian Persetujuan Bagi UMK atas kesesuaian kegiatan pemanfaatan ruang</p>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                            <span class="text-xs">Sistem Aktif</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-clock text-xs"></i>
                            <span class="text-xs">24/7 Tersedia</span>
                        </div>
                    </div>
                </div>
                <div class="hidden lg:block">
                    <div class="w-20 h-20 bg-white/10 rounded-full flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-file-contract text-3xl text-white/80"></i>
                    </div>
                </div>
            </div>
        </div>
        <!-- Decorative Elements -->
        <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -translate-y-16 translate-x-16"></div>
        <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full translate-y-12 -translate-x-12"></div>
    </div>

    <!-- Stats Cards with Glassmorphism -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="group relative overflow-hidden bg-white/80 backdrop-blur-sm rounded-xl p-4 shadow-lg border border-white/20 hover:shadow-xl transition-all duration-300">
            <div class="absolute inset-0 bg-gradient-to-br from-[#185B3C]/5 to-transparent"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-[#185B3C] to-[#0F3D26] rounded-lg flex items-center justify-center shadow-md">
                        <i class="fas fa-file-alt text-white text-sm"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-2xl font-bold text-[#185B3C]">{{ $totalKkpr }}</p>
                        <p class="text-xs text-gray-500">Total</p>
                    </div>
                </div>
                <h3 class="text-sm font-semibold text-gray-900 mb-1">Total Permohonan</h3>
                <div class="flex items-center text-xs text-green-600">
                    <i class="fas fa-arrow-up mr-1"></i>
                    <span>Semua data</span>
                </div>
            </div>
        </div>
        
        <div class="group relative overflow-hidden bg-white/80 backdrop-blur-sm rounded-xl p-4 shadow-lg border border-white/20 hover:shadow-xl transition-all duration-300">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-transparent"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center shadow-md">
                        <i class="fas fa-plus text-white text-sm"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-2xl font-bold text-blue-600">{{ $pengajuan }}</p>
                        <p class="text-xs text-gray-500">Pengajuan</p>
                    </div>
                </div>
                <h3 class="text-sm font-semibold text-gray-900 mb-1">Pengajuan Baru</h3>
                <div class="flex items-center text-xs text-blue-600">
                    <i class="fas fa-clock mr-1"></i>
                    <span>Menunggu review</span>
                </div>
            </div>
        </div>
        
        <div class="group relative overflow-hidden bg-white/80 backdrop-blur-sm rounded-xl p-4 shadow-lg border border-white/20 hover:shadow-xl transition-all duration-300">
            <div class="absolute inset-0 bg-gradient-to-br from-orange-500/5 to-transparent"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg flex items-center justify-center shadow-md">
                        <i class="fas fa-cog text-white text-sm"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-2xl font-bold text-orange-600">{{ $proses }}</p>
                        <p class="text-xs text-gray-500">Proses</p>
                    </div>
                </div>
                <h3 class="text-sm font-semibold text-gray-900 mb-1">Sedang Diproses</h3>
                <div class="flex items-center text-xs text-orange-600">
                    <i class="fas fa-clock mr-1"></i>
                    <span>Dalam review</span>
                </div>
            </div>
        </div>
        
        <div class="group relative overflow-hidden bg-white/80 backdrop-blur-sm rounded-xl p-4 shadow-lg border border-white/20 hover:shadow-xl transition-all duration-300">
            <div class="absolute inset-0 bg-gradient-to-br from-green-500/5 to-transparent"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-lg flex items-center justify-center shadow-md">
                        <i class="fas fa-check-circle text-white text-sm"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-2xl font-bold text-green-600">{{ $selesai }}</p>
                        <p class="text-xs text-gray-500">Selesai</p>
                    </div>
                </div>
                <h3 class="text-sm font-semibold text-gray-900 mb-1">Permohonan Selesai</h3>
                <div class="flex items-center text-xs text-green-600">
                    <i class="fas fa-check mr-1"></i>
                    <span>Sudah selesai</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions with Modern Design -->
    <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h3 class="text-lg font-bold text-gray-900">Aksi Cepat</h3>
                <p class="text-sm text-gray-600">Pilih aksi yang ingin Anda lakukan</p>
            </div>
            <div class="w-8 h-8 bg-gradient-to-br from-[#185B3C] to-[#0F3D26] rounded-lg flex items-center justify-center">
                <i class="fas fa-bolt text-white text-sm"></i>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            @cannot('OPD Eksternal')
            @canany(['Verifikator', 'Admin Sipo'])
            <a href="{{ route('admin.kkprnon.create') }}" class="group relative overflow-hidden bg-gradient-to-br from-[#185B3C] to-[#0F3D26] rounded-xl p-4 text-white hover:shadow-lg transition-all duration-300">
                <div class="absolute inset-0 bg-white/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <div class="relative z-10 text-center">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:scale-105 transition-transform">
                        <i class="fas fa-plus text-lg"></i>
                    </div>
                    <h4 class="font-semibold text-sm mb-1">Buat Permohonan</h4>
                    <p class="text-xs text-white/80">Buat permohonan baru</p>
                </div>
            </a>
            @endcanany
            @endcannot
            
            <button onclick="refreshTable()" class="group relative overflow-hidden bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-4 text-white hover:shadow-lg transition-all duration-300">
                <div class="absolute inset-0 bg-white/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <div class="relative z-10 text-center">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:scale-105 transition-transform">
                        <i class="fas fa-sync text-lg"></i>
                    </div>
                    <h4 class="font-semibold text-sm mb-1">Refresh Data</h4>
                    <p class="text-xs text-white/80">Perbarui data</p>
                </div>
            </button>
            
            <button onclick="exportData()" class="group relative overflow-hidden bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl p-4 text-white hover:shadow-lg transition-all duration-300">
                <div class="absolute inset-0 bg-white/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <div class="relative z-10 text-center">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:scale-105 transition-transform">
                        <i class="fas fa-download text-lg"></i>
                    </div>
                    <h4 class="font-semibold text-sm mb-1">Export Data</h4>
                    <p class="text-xs text-white/80">Download data</p>
                </div>
            </button>
            
            <button onclick="showFilters()" class="group relative overflow-hidden bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl p-4 text-white hover:shadow-lg transition-all duration-300">
                <div class="absolute inset-0 bg-white/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <div class="relative z-10 text-center">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:scale-105 transition-transform">
                        <i class="fas fa-filter text-lg"></i>
                    </div>
                    <h4 class="font-semibold text-sm mb-1">Filter Data</h4>
                    <p class="text-xs text-white/80">Saring data</p>
                </div>
            </button>
        </div>
    </div>

    <!-- Filter Section -->
    <div id="filterSection" class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20" style="display: none;">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-bold text-gray-900">Filter Data</h3>
            <button onclick="hideFilters()" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>
        
        <form method="GET" action="{{ route('admin.kkprnon.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Bulan</label>
                <select name="bulan" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent">
                    <option value="0">Semua Bulan</option>
                    @for($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}" {{ $request->bulan == $i ? 'selected' : '' }}>
                            {{ date('F', mktime(0, 0, 0, $i, 1)) }}
                        </option>
                    @endfor
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Tahun</label>
                <select name="tahun" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent">
                    <option value="">Semua Tahun</option>
                    @for($i = date('Y'); $i >= 2019; $i--)
                        <option value="{{ $i }}" {{ $request->tahun == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                <select name="status" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent">
                    <option value="">Semua Status</option>
                    <option value="1" {{ $request->status == '1' ? 'selected' : '' }}>Pengajuan</option>
                    <option value="0" {{ $request->status == '0' ? 'selected' : '' }}>Revisi</option>
                    <option value="7" {{ $request->status == '7' ? 'selected' : '' }}>Verifikasi Dokumen</option>
                    <option value="6" {{ $request->status == '6' ? 'selected' : '' }}>Survey</option>
                    <option value="8" {{ $request->status == '8' ? 'selected' : '' }}>Analisa</option>
                    <option value="9" {{ $request->status == '9' ? 'selected' : '' }}>Persetujuan Dokumen</option>
                    <option value="10" {{ $request->status == '10' ? 'selected' : '' }}>Dokumen Terbit</option>
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Pencarian</label>
                <div class="flex space-x-2">
                    <input type="text" name="search" value="{{ $request->search }}" placeholder="Nama pemohon..." class="flex-1 px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent">
                    <button type="submit" class="px-4 py-2 bg-[#185B3C] text-white rounded-xl hover:bg-[#0F3D26] transition-colors">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Modern Data Table -->
    <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg border border-white/20 overflow-hidden">
        <!-- Table Header -->
        <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-gradient-to-br from-[#185B3C] to-[#0F3D26] rounded-lg flex items-center justify-center">
                        <i class="fas fa-chart-line text-white text-sm"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Daftar Permohonan Persetujuan Bagi UMK</h3>
                        <p class="text-sm text-gray-600">Menampilkan {{ $kkprs->count() }} dari {{ $kkprs->total() }} permohonan</p>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    <button onclick="showFilters()" class="flex items-center px-3 py-2 text-sm text-gray-600 hover:text-gray-900 hover:bg-white/80 rounded-lg transition-colors">
                        <i class="fas fa-filter mr-1 text-xs"></i>
                        Filter
                    </button>
                    <button onclick="refreshTable()" class="flex items-center px-3 py-2 text-sm text-gray-600 hover:text-gray-900 hover:bg-white/80 rounded-lg transition-colors">
                        <i class="fas fa-sync mr-1 text-xs"></i>
                        Refresh
                    </button>
                </div>
            </div>
        </div>

        <!-- Table Content -->
        <div class="overflow-x-auto">
            <!-- Table Headers -->
            <div class="px-6 py-3 bg-gray-50/80 border-b border-gray-100">
                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-1">
                        <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">ID</span>
                    </div>
                    <div class="col-span-2">
                        <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">TANGGAL</span>
                    </div>
                    <div class="col-span-3">
                        <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">NAMA PEMOHON</span>
                    </div>
                    <div class="col-span-2">
                        <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">KBLI</span>
                    </div>
                    <div class="col-span-2">
                        <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">NO NIB</span>
                    </div>
                    <div class="col-span-1">
                        <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">STATUS</span>
                    </div>
                    <div class="col-span-1">
                        <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">AKSI</span>
                    </div>
                </div>
            </div>

            <!-- Table Rows -->
            <div class="divide-y divide-gray-100">
                @forelse($kkprs as $kkpr)
                <div class="px-6 py-4 hover:bg-gradient-to-r hover:from-[#185B3C]/5 hover:to-transparent transition-all duration-300 group">
                    <div class="grid grid-cols-12 gap-4 items-center">
                        <div class="col-span-1">
                            <p class="font-bold text-gray-900 text-sm">#{{ $kkpr->id }}</p>
                        </div>
                        <div class="col-span-2">
                            <p class="text-gray-900 font-medium text-sm">{{ $kkpr->created_at ? $kkpr->created_at->format('d M Y') : 'N/A' }}</p>
                            <p class="text-xs text-gray-500">{{ $kkpr->created_at ? $kkpr->created_at->format('H:i') : 'N/A' }}</p>
                        </div>
                        <div class="col-span-3">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-gradient-to-br from-[#185B3C] to-[#0F3D26] rounded-xl flex items-center justify-center shadow-md group-hover:scale-105 transition-transform">
                                    <i class="fas fa-user text-white text-sm"></i>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900 text-sm">{{ $kkpr->user->name ?? ($kkpr->atas_nama ?? 'N/A') }}</p>
                                    <p class="text-xs text-gray-500">{{ $kkpr->user->phone ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-2">
                            <p class="font-semibold text-gray-900 text-sm">{{ $kkpr->kbli ?? ($kkpr->kkpr_kbli->first()->kode_kbli ?? 'N/A') }}</p>
                            <p class="text-xs text-gray-500">{{ $kkpr->jenis_kegiatan ?? ($kkpr->kkpr_kbli->first()->judul_kbli ?? 'N/A') }}</p>
                        </div>
                        <div class="col-span-2">
                            <p class="text-gray-900 text-sm">{{ $kkpr->no_nib ?? 'N/A' }}</p>
                            <p class="text-xs text-gray-500">{{ $kkpr->kecamatan->NAMA_KEC ?? 'N/A' }}</p>
                        </div>
                        <div class="col-span-1">
                            @php
                                $statusConfig = [
                                    0 => ['label' => 'Ditolak', 'color' => 'red', 'icon' => 'fa-times-circle'],
                                    1 => ['label' => 'Pengajuan', 'color' => 'blue', 'icon' => 'fa-file-alt'],
                                    2 => ['label' => 'Upload', 'color' => 'yellow', 'icon' => 'fa-upload'],
                                    3 => ['label' => 'Validasi', 'color' => 'orange', 'icon' => 'fa-check-circle'],
                                    4 => ['label' => 'Bayar', 'color' => 'purple', 'icon' => 'fa-money-bill'],
                                    5 => ['label' => 'V.Bayar', 'color' => 'indigo', 'icon' => 'fa-receipt'],
                                    6 => ['label' => 'Survey', 'color' => 'pink', 'icon' => 'fa-map-marked-alt'],
                                    7 => ['label' => 'Analisa', 'color' => 'cyan', 'icon' => 'fa-file-signature'],
                                    8 => ['label' => 'Setuju', 'color' => 'teal', 'icon' => 'fa-check-double'],
                                    9 => ['label' => 'TTE', 'color' => 'emerald', 'icon' => 'fa-signature'],
                                    10 => ['label' => 'Selesai', 'color' => 'green', 'icon' => 'fa-check-circle'],
                                ];
                                $status = $statusConfig[$kkpr->proses] ?? ['label' => 'Unknown', 'color' => 'gray', 'icon' => 'fa-question'];
                            @endphp
                            @if($kkpr->deleted == 1)
                                <button onclick="openRiwayat({{ $kkpr->id }})" class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded-full bg-orange-100 text-orange-800 border-2 border-orange-300 shadow-sm hover:bg-orange-200 transition-colors cursor-pointer" title="Request Pencabutan">
                                    <i class="fas fa-times-circle mr-1"></i>
                                    Pencabutan
                                </button>
                            @elseif($kkpr->deleted == 2)
                                <button onclick="openRiwayat({{ $kkpr->id }})" class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800 border-2 border-gray-300 shadow-sm hover:bg-gray-200 transition-colors cursor-pointer" title="Pencabutan Dikonfirmasi">
                                    <i class="fas fa-ban mr-1"></i>
                                    Dicabut
                                </button>
                            @elseif($kkpr->proses == 0)
                                <button onclick="openRiwayat({{ $kkpr->id }})" class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800 border-2 border-red-400 shadow-sm hover:bg-red-200 transition-colors cursor-pointer" title="Lihat Riwayat Proses">
                                    <i class="fas fa-times-circle mr-1"></i>
                                    Ditolak
                                </button>
                            @elseif($kkpr->revisi == 1)
                                <button onclick="openRiwayat({{ $kkpr->id }})" class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800 border-2 border-yellow-300 shadow-sm hover:bg-yellow-200 transition-colors cursor-pointer" title="Lihat Riwayat Proses">
                                    <i class="fas fa-exclamation-triangle mr-1"></i>
                                    Revisi
                                </button>
                            @else
                                <button onclick="openRiwayat({{ $kkpr->id }})" class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded-full bg-{{ $status['color'] }}-100 text-{{ $status['color'] }}-800 border border-{{ $status['color'] }}-300 hover:bg-{{ $status['color'] }}-200 transition-colors cursor-pointer" title="Lihat Riwayat Proses">
                                    <i class="fas {{ $status['icon'] }} mr-1"></i>
                                    {{ $status['label'] }}
                                </button>
                            @endif
                        </div>
                        <div class="col-span-1">
                                @php
                                    $can = [
                                        'verifikator' => auth()->user()->can('Verifikator'),
                                        'analis' => auth()->user()->can('Analis'),
                                        'pimpinan' => auth()->user()->can('Pimpinan'),
                                        'kabid' => auth()->user()->can('Kabid'),
                                        'kepala_dinas' => auth()->user()->can('Kepala Dinas'),
                                        'upload_draft' => auth()->user()->can('Upload Draft'),
                                        'opd_eksternal' => auth()->user()->can('OPD Eksternal'),
                                        'tim_fpr' => auth()->user()->can('Tim FPR'),
                                    ];
                                    // dd(auth()->user()->can('Kepala Dinas' ) ? 'true' : 'false');
                                @endphp
                            <button id="btn-aksi-{{ $kkpr->id }}" onclick="toggleDropdown(event, {{ $kkpr->id }}, {{ $kkpr->proses }}, {{ $kkpr->revisi }}, {{ $can['verifikator'] ? 'true' : 'false' }}, {{ $can['analis'] ? 'true' : 'false' }}, {{ $can['pimpinan'] ? 'true' : 'false' }}, {{ $can['kabid'] ? 'true' : 'false' }}, {{ $can['kepala_dinas'] ? 'true' : 'false' }}, {{ $can['upload_draft'] ? 'true' : 'false' }}, {{ $can['opd_eksternal'] ? 'true' : 'false' }}, {{ $can['tim_fpr'] ? 'true' : 'false' }}, {{ $kkpr->deleted ?? 0 }}, {{ $kkpr->f_survey ? '\'' . route('admin.kkprnon.view.survey', $kkpr->id) . '\'' : 'null' }})" class="inline-flex items-center space-x-1.5 px-3 py-1.5 text-xs font-medium text-gray-700 bg-white hover:bg-[#185B3C]/10 hover:text-[#185B3C] border border-gray-300 rounded-lg transition-all duration-200 hover:scale-105" title="Aksi">
                                <i class="fas fa-cog"></i>
                                <span>Aksi</span>
                                <i class="fas fa-chevron-down text-xs"></i>
                            </button>
                        </div>
                    </div>
                </div>
                @empty
                <div class="px-6 py-12 text-center">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-inbox text-gray-400 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Tidak ada data</h3>
                    <p class="text-gray-500 mb-4">Belum ada permohonan Persetujuan Bagi UMK yang tersedia</p>
                    @canany(['Verifikator', 'Admin Sipo'])
                    <a href="{{ route('admin.kkprnon.create') }}" class="inline-flex items-center px-4 py-2 bg-[#185B3C] text-white rounded-lg hover:bg-[#0F3D26] transition-colors">
                        <i class="fas fa-plus mr-2"></i>
                        Buat Permohonan Pertama
                    </a>
                    @endcanany
                </div>
                @endforelse
            </div>
        </div>

        <!-- Table Footer -->
        @if($kkprs->hasPages())
        <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-gray-100 border-t border-gray-200">
            <div class="flex items-center justify-between">
                <p class="text-sm text-gray-600">
                    Menampilkan <span class="font-semibold text-[#185B3C]">{{ $kkprs->firstItem() ?? 0 }}</span> 
                    sampai <span class="font-semibold text-[#185B3C]">{{ $kkprs->lastItem() ?? 0 }}</span> 
                    dari <span class="font-semibold text-[#185B3C]">{{ $kkprs->total() }}</span> permohonan
                </p>
                <div class="flex items-center space-x-1">
                    {{ $kkprs->links() }}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function showFilters() {
        document.getElementById('filterSection').style.display = 'block';
    }

    function hideFilters() {
        document.getElementById('filterSection').style.display = 'none';
    }

    function refreshTable() {
        window.location.reload();
    }

    function exportData() {
        alert('Fitur export akan segera tersedia');
    }

    let currentSurveyId = null;
    let surveySubmitting = false;

    function toggleDropdown(evt, id, status, revisi, canValidate, canSurvey, canPimpinan, canKabid, canKepalaDinas, canUploadDraft, isExternal, canTimFpr, deleted, surveyFileUrl) {
        const button = evt.currentTarget;
        const chevron = button.querySelector('.fa-chevron-down');
        const modal = document.getElementById('dropdown-menu-modal');
        const content = document.getElementById('dropdown-menu-content');
        const allChevrons = document.querySelectorAll('[onclick^="toggleDropdown"] .fa-chevron-down');
        
        // Check if already open
        if (!modal.classList.contains('hidden') && modal.dataset.currentId == id) {
            // Close
            modal.classList.add('hidden');
            chevron.style.transform = 'rotate(0deg)';
            delete modal.dataset.currentId;
            return;
        }
        
        // Reset all chevrons
        allChevrons.forEach(c => {
            c.style.transform = 'rotate(0deg)';
            c.style.transition = 'transform 0.2s';
        });
        
        // Set content first to calculate height
        let menuItems = `<div class="py-1">`;
        
        // SELALU TAMPILKAN: Lihat Detail (urutan pertama)
        menuItems += `
            <a href="/admin/kkprnon/${id}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-[#185B3C]/10 hover:text-[#185B3C] transition-colors">
                <i class="fas fa-eye w-4 mr-3"></i>
                Lihat Detail
            </a>`;
        
        // Check if deleted status (pencabutan)
        const isDeleted = parseInt(deleted) > 0;
        const isRequestPencabutan = parseInt(deleted) == 1;
        
        // Button konfirmasi pencabutan jika deleted = 1
        if (isRequestPencabutan) {
            menuItems += `
                <div class="border-t border-orange-200 my-1"></div>
                <button onclick="confirmPencabutan(${id}); closeDropdownModal();" class="w-full flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600 transition-colors text-left">
                    <i class="fas fa-check-circle w-4 mr-3"></i>
                    Konfirmasi Pencabutan
                </button>
                <div class="px-4 py-2 bg-orange-50 border-l-4 border-orange-300">
                    <p class="text-xs text-orange-700 font-semibold">Request Pencabutan</p>
                    <p class="text-xs text-orange-600 mt-1">Menunggu konfirmasi admin</p>
                </div>`;
        }
        // Jika sudah dicabut (deleted = 2)
        else if (parseInt(deleted) == 2) {
            menuItems += `
                <div class="px-4 py-3 bg-gray-100 border border-gray-300 rounded-lg">
                    <p class="text-xs font-semibold text-gray-700">
                        <i class="fas fa-ban mr-1"></i> PERMOHONAN DICABUT
                    </p>
                    <p class="text-xs text-gray-600 mt-1">Tidak dapat diproses lebih lanjut</p>
                </div>`;
        }
        // Jika status ditolak (0), hanya tampilkan menu view-only
        else if (parseInt(status) == 0) {
            menuItems += `
                <div class="px-4 py-3 bg-red-50 border border-red-200 rounded-lg">
                    <p class="text-xs font-semibold text-red-700">
                        <i class="fas fa-ban mr-1"></i> DOKUMEN DITOLAK
                    </p>
                    <p class="text-xs text-gray-600 mt-1">Tidak dapat diproses lebih lanjut</p>
                </div>`;
        }
        // Jika status sudah selesai (10), hanya tampilkan menu view-only
        else if (parseInt(status) == 10) {
            menuItems += `
                <a href="/admin/kkprnon/${id}/view-draft" target="_blank" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-600 transition-colors">
                    <i class="fas fa-file-contract w-4 mr-3"></i>
                    Lihat Dokumen Final
                </a>`;
            if (surveyFileUrl) {
                menuItems += `
                    <a href="${surveyFileUrl}" target="_blank" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600 transition-colors">
                        <i class="fas fa-folder-open w-4 mr-3"></i>
                        Lihat Surat Survey
                    </a>`;
            }
            
            // Hanya tampilkan menu tambahan jika bukan OPD Eksternal
            if (isExternal != true) {
                menuItems += `
                    <a href="/admin/kkprnon/${id}/peta" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600 transition-colors">
                        <i class="fas fa-map w-4 mr-3"></i>
                        Lihat Peta
                    </a>
                    <a href="/admin/kkprnon/${id}/cetak-berkas" target="_blank" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors">
                        <i class="fas fa-file-pdf w-4 mr-3"></i>
                        Cetak Berkas
                    </a>`;
            }
        }
        // Jika user eksternal, hanya tampilkan menu view-only
        else if (isExternal == true) {
            if (surveyFileUrl) {
                menuItems += `
                    <a href="${surveyFileUrl}" target="_blank" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600 transition-colors">
                        <i class="fas fa-folder-open w-4 mr-3"></i>
                        Lihat Berkas Survey
                    </a>`;
            }
            // Untuk OPD Eksternal, hanya tampilkan Lihat Detail saja (Lihat Dokumen Final sudah ditangani di kondisi status == 10)
        } else {
            // Menu normal untuk user non-eksternal - URUT BERDASARKAN PROSES
            
            // Edit - jika status masih Pengajuan (status = 1)
            if (parseInt(status) == 1) {
                menuItems += `
                    <div class="border-t border-gray-100"></div>
                    <a href="/admin/kkprnon/${id}/edit" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors">
                        <i class="fas fa-edit w-4 mr-3"></i>
                        <span class="flex-1">Edit</span>
                        <span class="text-xs bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full">Edit</span>
                    </a>`;
            }
            
            // PROSES 1: Validasi - hanya untuk Verifikator dan status = 1 (Pengajuan)
            if (canValidate && parseInt(status) == 1) {
                menuItems += `
                    <a href="/admin/kkprnon/${id}/validasi" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600 transition-colors">
                        <i class="fas fa-check-circle w-4 mr-3"></i>
                        <span class="flex-1">Validasi</span>
                        <span class="text-xs bg-green-100 text-green-700 px-2 py-0.5 rounded-full">Step 1</span>
                    </a>`;
            }

            // Edit Analisa - jika proses == 7 dan revisi != 1
            if (parseInt(status) == 7 && parseInt(revisi) != 1) {
                menuItems += `
                    <a href="/admin/kkprnon/${id}/edit-analisa" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">
                        <i class="fas fa-edit w-4 mr-3"></i>
                        <span class="flex-1">Edit Analisa</span>
                        <span class="text-xs bg-indigo-100 text-indigo-700 px-2 py-0.5 rounded-full">Edit</span>
                    </a>`;
            }
            
            // PROSES 2-5: Survey & Analisa - hanya untuk Analis
            if (canSurvey && parseInt(status) >= 3 && parseInt(status) < 7) {
                menuItems += `<div class="border-t border-gray-100"></div>`;
                
                // Survey - jika belum survey (proses < 6)
                if (!canTimFpr && parseInt(status) < 6) {
                    menuItems += `
                        <button onclick="setSurvey(${id}); closeDropdownModal();" class="w-full flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600 transition-colors text-left">
                            <i class="fas fa-map-marked-alt w-4 mr-3"></i>
                            <span class="flex-1">Survey</span>
                            <span class="text-xs bg-orange-100 text-orange-700 px-2 py-0.5 rounded-full">Step 2</span>
                        </button>`;
                }
                
                // Analisa - jika belum analisa (proses < 7)
                menuItems += `
                    <a href="/admin/kkprnon/${id}/analisa" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-600 transition-colors">
                        <i class="fas fa-file-signature w-4 mr-3"></i>
                        <span class="flex-1">Analisa</span>
                        <span class="text-xs bg-purple-100 text-purple-700 px-2 py-0.5 rounded-full">Step 3</span>
                    </a>`;
            }
            
            // PROSES 7: Kirim Kabid - hanya untuk Pimpinan dan Kabid setelah analisa
            if ((canPimpinan == true || canKabid == true) && parseInt(status) == 7) {
                menuItems += `
                    <div class="border-t border-gray-100"></div>
                    <button onclick="kirimKabid(${id}); closeDropdownModal();" class="w-full flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors text-left">
                        <i class="fas fa-paper-plane w-4 mr-3"></i>
                        <span class="flex-1">Kirim Kabid</span>
                        <span class="text-xs bg-indigo-100 text-indigo-700 px-2 py-0.5 rounded-full">Step 4</span>
                    </button>`;
            }
            
            // PROSES 8: Persetujuan Dokumen - hanya untuk Kepala Dinas dan Kabid
            if ((canKepalaDinas == true || canKabid == true) && parseInt(status) == 8) {
                menuItems += `
                    <div class="border-t border-gray-100"></div>
                    <a href="/admin/kkprnon/${id}/persetujuan-dokumen" class="w-full flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-cyan-50 hover:text-cyan-600 transition-colors">
                        <i class="fas fa-check-double w-4 mr-3"></i>
                        <span class="flex-1">Persetujuan Dokumen</span>
                        <span class="text-xs bg-cyan-100 text-cyan-700 px-2 py-0.5 rounded-full">Step 5</span>
                    </a>`;
            }
            
            // PROSES 9: Upload Draft - hanya dengan permission Upload Draft
            if (canUploadDraft == true && parseInt(status) == 9) {
                menuItems += `
                    <div class="border-t border-gray-100"></div>
                    <button onclick="openUploadDraftModal(${id}); closeDropdownModal();" class="w-full flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 transition-colors text-left">
                        <i class="fas fa-file-upload w-4 mr-3"></i>
                        <span class="flex-1">Upload Draft</span>
                        <span class="text-xs bg-emerald-100 text-emerald-700 px-2 py-0.5 rounded-full">Step 6</span>
                    </button>`;
            }
            
            // SEPARATOR untuk menu sekunder
            if (parseInt(status) < 10) {
                menuItems += `<div class="border-t border-gray-200 my-1"></div>`;
            }
            
            // MENU SEKUNDER: Lihat Peta & Cetak Berkas
            if (surveyFileUrl) {
                menuItems += `
                <a href="${surveyFileUrl}" target="_blank" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600 transition-colors">
                    <i class="fas fa-folder-open w-4 mr-3"></i>
                    Lihat Surat Survey
                </a>`;
            }
            menuItems += `
                <a href="/admin/kkprnon/${id}/peta" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600 transition-colors">
                    <i class="fas fa-map w-4 mr-3"></i>
                    Lihat Peta
                </a>`;
            
            // Cetak Berkas - hanya setelah analisa (proses >= 7)
            if (parseInt(status) >= 7) {
                menuItems += `
                    <a href="/admin/kkprnon/${id}/cetak-berkas" target="_blank" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors">
                        <i class="fas fa-file-pdf w-4 mr-3"></i>
                        Cetak Berkas
                    </a>`;
            }
            
            // Tidak ada aksi tambahan untuk status normal
        }
        
        menuItems += `
            </div>
        `;
        
        content.innerHTML = menuItems;
        
        // Show modal temporarily to get height
        modal.classList.remove('hidden');
        modal.style.visibility = 'hidden';
        
        // Get button and modal dimensions
        const rect = button.getBoundingClientRect();
        const modalHeight = content.offsetHeight;
        const modalWidth = 192; // w-48 = 12rem = 192px
        const viewportHeight = window.innerHeight;
        const viewportWidth = window.innerWidth;
        
        // Calculate space available
        const spaceBelow = viewportHeight - rect.bottom;
        const spaceAbove = rect.top;
        const spaceRight = viewportWidth - rect.right;
        const spaceLeft = rect.left;
        
        // Determine vertical position
        let top;
        if (spaceBelow >= modalHeight + 8 || spaceBelow >= spaceAbove) {
            // Show below
            top = rect.bottom + window.scrollY + 8;
        } else {
            // Show above
            top = rect.top + window.scrollY - modalHeight - 8;
        }
        
        // Determine horizontal position (align to right of button)
        let left = rect.right + window.scrollX - modalWidth;
        
        // Constrain horizontal position
        if (left < 8) {
            left = 8; // 8px from left edge
        } else if (left + modalWidth > viewportWidth - 8) {
            left = viewportWidth - modalWidth - 8; // 8px from right edge
        }
        
        // Constrain vertical position
        if (top < window.scrollY + 8) {
            top = window.scrollY + 8; // 8px from top
        } else if (top + modalHeight > window.scrollY + viewportHeight - 8) {
            top = window.scrollY + viewportHeight - modalHeight - 8; // 8px from bottom
        }
        
        // Set final position
        modal.style.top = top + 'px';
        modal.style.left = left + 'px';
        modal.style.visibility = 'visible';
        
        modal.dataset.currentId = id;
        
        // Rotate chevron
        chevron.style.transform = 'rotate(180deg)';
        chevron.style.transition = 'transform 0.2s';
    }

    // Konfirmasi Pencabutan for KKPRNon
    function confirmPencabutan(id) {
        Swal.fire({
            title: 'Konfirmasi Pencabutan?',
            text: "Permohonan akan dicabut dan tidak dapat diproses lagi!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#f59e0b',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Konfirmasi!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/admin/kkprnon/${id}/confirm-pencabutan`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Pencabutan berhasil dikonfirmasi',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => location.reload());
                    } else {
                        Swal.fire('Error!', data.message || 'Gagal mengkonfirmasi pencabutan', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire('Error!', 'Terjadi kesalahan', 'error');
                });
            }
        });
    }

    function closeDropdownModal() {
        const modal = document.getElementById('dropdown-menu-modal');
        const allChevrons = document.querySelectorAll('[onclick^="toggleDropdown"] .fa-chevron-down');
        
        modal.classList.add('hidden');
        modal.style.visibility = 'visible'; // Reset visibility
        delete modal.dataset.currentId;
        
        // Reset all chevrons
        allChevrons.forEach(c => {
            c.style.transform = 'rotate(0deg)';
        });
    }

    function setSurvey(id) {
        currentSurveyId = id;
        const backdrop = document.getElementById('survey-backdrop');
        const modal = document.getElementById('survey-modal');
        const form = document.getElementById('survey-form');
        const errorBox = document.getElementById('survey-error');

        if (form) {
            form.reset();
        }

        if (errorBox) {
            errorBox.textContent = '';
        }

        if (backdrop) {
            backdrop.style.display = 'block';
        }

        if (modal) {
            modal.style.display = 'flex';
        }
    }

    function closeSurveyModal(force = false) {
        if (typeof force !== 'boolean') {
            force = false;
        }
        if (surveySubmitting && !force) {
            return;
        }
        surveySubmitting = false;
        currentSurveyId = null;
        const backdrop = document.getElementById('survey-backdrop');
        const modal = document.getElementById('survey-modal');
        if (modal) {
            modal.style.display = 'none';
        }
        if (backdrop) {
            backdrop.style.display = 'none';
        }
        const form = document.getElementById('survey-form');
        if (form) {
            form.reset();
        }
        const errorBox = document.getElementById('survey-error');
        if (errorBox) {
            errorBox.textContent = '';
        }
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        if (!event.target.closest('[onclick^="toggleDropdown"]') && !event.target.closest('#dropdown-menu-modal')) {
            closeDropdownModal();
        }
        const surveyForm = document.getElementById('survey-form');
        const surveyBackdrop = document.getElementById('survey-backdrop');
        if (surveyBackdrop) {
            surveyBackdrop.addEventListener('click', () => closeSurveyModal());
        }
        if (surveyForm) {
            surveyForm.addEventListener('submit', function(event) {
                event.preventDefault();
                if (!currentSurveyId || surveySubmitting) {
                    return;
                }

                const errorBox = document.getElementById('survey-error');
                if (errorBox) {
                    errorBox.textContent = '';
                }

                const submitButton = surveyForm.querySelector('button[type="submit"]');
                if (submitButton) {
                    submitButton.disabled = true;
                }
                surveySubmitting = true;

                const formData = new FormData(surveyForm);

                fetch(`/admin/kkprnon/survey/${currentSurveyId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                })
                .then(async (response) => {
                    const data = await response.json().catch(() => ({}));
                    if (response.ok && data.success) {
                        closeSurveyModal(true);
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: data.message || 'Survey berhasil dijadwalkan',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            window.location.reload();
                        });
                    } else {
                        const errors = data.errors ? Object.values(data.errors).flat().join(', ') : null;
                        const message = data.message || errors || 'Terjadi kesalahan saat menyimpan jadwal survey';
                        if (errorBox) {
                            errorBox.textContent = message;
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: message
                            });
                        }
                    }
                })
                .catch((error) => {
                    if (errorBox) {
                        errorBox.textContent = error.message || 'Terjadi kesalahan saat menyimpan jadwal survey';
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Terjadi kesalahan saat menyimpan jadwal survey'
                        });
                    }
                })
                .finally(() => {
                    surveySubmitting = false;
                    if (submitButton) {
                        submitButton.disabled = false;
                    }
                });
            });
        }
    });

    function openRiwayat(id) {
        console.log('openRiwayat called with id:', id);
        
        const modal = document.getElementById('modal-riwayat');
        console.log('Modal element:', modal);
        
        if (!modal) {
            console.error('Modal element not found!');
            alert('Error: Modal tidak ditemukan');
            return;
        }
        
        // Reset content terlebih dahulu
        const content = document.getElementById('riwayat-content');
        const subtitle = document.getElementById('modal-subtitle');
        content.innerHTML = '<div class="text-center py-8"><i class="fas fa-spinner fa-spin text-4xl text-[#185B3C]"></i><p class="mt-4 text-gray-600">Memuat riwayat...</p></div>';
        subtitle.textContent = 'Loading...';
        console.log('Content reset');
        
        modal.style.display = 'block';
        modal.classList.add('show');
        document.body.classList.add('modal-open');
        
        console.log('Modal displayed');
        console.log('Modal styles:', {
            display: modal.style.display,
            position: getComputedStyle(modal).position,
            zIndex: getComputedStyle(modal).zIndex,
            visibility: getComputedStyle(modal).visibility
        });
        
        // Create backdrop if not exists
        let backdrop = document.getElementById('modal-backdrop-riwayat');
        if (!backdrop) {
            backdrop = document.createElement('div');
            backdrop.className = 'modal-backdrop fade show';
            backdrop.id = 'modal-backdrop-riwayat';
            backdrop.style.cssText = 'position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); z-index: 1040;';
            document.body.appendChild(backdrop);
            console.log('Backdrop created');
        } else {
            console.log('Backdrop already exists');
        }
        
        // Load content via fetch
        const url = '/admin/kkprnon/riwayat-data/' + id;
        console.log('Fetching from URL:', url);
        
        fetch(url)
            .then(response => {
                console.log('Response status:', response.status);
                return response.json();
            })
            .then(data => {
                console.log('Data received:', data);
                if (data.success) {
                    renderRiwayat(data.riwayat, data.model);
                } else {
                    console.error('Success flag is false');
                    alert('Gagal memuat riwayat proses');
                    closeRiwayatModal();
                }
            })
            .catch(error => {
                console.error('Fetch error:', error);
                alert('Gagal memuat riwayat proses: ' + error.message);
                closeRiwayatModal();
            });
    }
    
    function renderRiwayat(riwayat, model) {
        console.log('renderRiwayat called', { riwayat, model });
        
        const subtitle = document.getElementById('modal-subtitle');
        console.log('Subtitle element:', subtitle);
        subtitle.textContent = 'Persetujuan Bagi UMK #' + model.id;
        
        const content = document.getElementById('riwayat-content');
        console.log('Content element:', content);
        
        const badgeConfig = {
            0: { icon: 'fa-times-circle', color: '#dc2626', label: 'Ditolak' },
            'pencabutan-request': { icon: 'fa-exclamation-triangle', color: '#f59e0b', label: 'Request Pencabutan' },
            'pencabutan-confirmed': { icon: 'fa-ban', color: '#6b7280', label: 'Pencabutan Dikonfirmasi' },
            1: { icon: 'fa-address-card', color: '#db3102', label: 'Pengajuan' },
            2: { icon: 'fa-upload', color: '#dbac02', label: 'Upload Dokumen' },
            3: { icon: 'fa-check-circle', color: '#9edb02', label: 'Validasi' },
            4: { icon: 'fa-upload', color: '#38db02', label: 'Upload' },
            5: { icon: 'fa-upload', color: '#02db84', label: 'Validasi' },
            6: { icon: 'fa-edit', color: '#02d7db', label: 'Survey' },
            7: { icon: 'fa-check-circle', color: '#8102db', label: 'Analisa' },
            8: { icon: 'fa-check-circle', color: '#cd02db', label: 'Persetujuan' },
            9: { icon: 'fa-check-circle', color: '#db02db', label: 'TTE' },
            10: { icon: 'fa-handshake', color: '#db0293', label: 'Selesai' },
            11: { icon: 'fa-file', color: '#0252db', label: 'Dokumen' }
        };
        
        let html = '<div class="relative"><div class="absolute left-6 top-0 bottom-0 w-0.5 bg-gradient-to-b from-[#185B3C] via-gray-300 to-gray-200"></div><div class="space-y-6">';
        
        // Cek apakah ada pencabutan
        const pencabutanRiwayat = riwayat.filter(r => r.status_id == 0 && (r.status.includes('Pencabutan') || r.status.includes('pencabutan')));
        const hasPencabutan = pencabutanRiwayat.length > 0;
        
        // Hanya tampilkan proses inti: Pengajuan(1), Survey(6), Analisa(7), Persetujuan(8), TTE(9), Selesai(10)
        // Skip validasi dan upload dokumen: 2, 3, 4, 5
        const processSteps = [1, 6, 7, 8, 9, 10];
        
        for (let i = 0; i < processSteps.length; i++) {
            const statusId = processSteps[i];
            // Find existing riwayat for this status_id
            const existingRiwayat = riwayat.find(r => r.status_id == statusId);
            
            if (existingRiwayat) {
                // Display existing riwayat
                const r = existingRiwayat;
                const isDitolak = r.status_id == 0;
                const isRevisi = r.status_id == model.proses && model.revisi == 1 && !isDitolak;
                const badge = badgeConfig[r.status_id] || { icon: 'fa-file', color: '#6c757d', label: 'Unknown' };
                const badgeIcon = isDitolak ? 'fa-times-circle' : (isRevisi ? 'fa-exclamation-circle' : badge.icon);
                const badgeColor = isDitolak ? '#dc2626' : (isRevisi ? '#eab308' : badge.color);
                
                const date = new Date(r.updated_at);
                const formattedDate = date.toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' });
                const formattedTime = date.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
                
                html += `
                <div class="relative pl-16 group">
                    <div class="absolute left-0 w-12 h-12 rounded-full flex items-center justify-center shadow-lg transition-transform duration-300 group-hover:scale-110 z-10" style="background-color: ${badgeColor}">
                        <i class="fa ${badgeIcon} text-white text-lg"></i>
                    </div>
                    <div class="${isDitolak ? 'bg-red-50 border-red-300 border-2' : (isRevisi ? 'bg-yellow-50 border-yellow-200' : 'bg-white border-gray-200')} rounded-xl p-4 shadow-md border transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex-1">
                                <h4 class="font-bold ${isDitolak ? 'text-red-900' : 'text-gray-900'} text-base mb-1">${r.status}</h4>
                                <div class="flex items-center space-x-3 text-xs text-gray-500">
                                    <div class="flex items-center">
                                        <i class="fa fa-calendar mr-1.5"></i>
                                        <span>${formattedDate}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fa fa-clock mr-1.5"></i>
                                        <span>${formattedTime}</span>
                                    </div>
                                </div>
                            </div>
                            ${isDitolak ? 
                                '<span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800 border-2 border-red-400"><i class="fa fa-ban mr-1"></i>Ditolak</span>' :
                                (isRevisi ? 
                                    '<span class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800 border border-yellow-300"><i class="fa fa-exclamation-circle mr-1"></i>Revisi</span>' :
                                    (r.status_id == model.proses ? 
                                        '<span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800 border border-blue-300"><i class="fa fa-spinner mr-1"></i>Aktif</span>' :
                                        '<span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800 border border-green-300"><i class="fa fa-check mr-1"></i>Selesai</span>'))
                            }
                        </div>
                        <div class="${isDitolak ? 'bg-white/70' : (isRevisi ? 'bg-white/50' : 'bg-gray-50')} rounded-lg p-3">
                            <p class="text-sm text-gray-700 leading-relaxed">${r.keterangan}</p>
                            ${isDitolak && r.revisi_detail ? 
                                `<div class="mt-3 p-3 bg-red-100 border-2 border-red-300 rounded-lg">
                                    <p class="text-xs font-semibold text-red-900 mb-1"><i class="fa fa-ban mr-1"></i>Alasan Penolakan:</p>
                                    <p class="text-sm text-red-800 font-medium">${r.revisi_detail}</p>
                                </div>` : 
                                (isRevisi && r.revisi_detail ? 
                                    `<div class="mt-3 p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                                        <p class="text-xs font-semibold text-yellow-800 mb-1"><i class="fa fa-info-circle mr-1"></i>Detail Revisi:</p>
                                        <p class="text-sm text-yellow-700">${r.revisi_detail}</p>
                                    </div>` : '')
                            }
                        </div>
                    </div>
                </div>`;
            } else {
                // Display placeholder for missing riwayat
                const badge = badgeConfig[statusId] || { icon: 'fa-file', color: '#6c757d', label: 'Unknown' };
                // Jika model.proses berada di 2-5 (validasi/upload yang tidak ditampilkan), 
                // kita perlu menentukan status berdasarkan proses inti terdekat
                const adjustedProses = processSteps.includes(model.proses) ? model.proses : 
                    (model.proses < 6 ? 1 : processSteps.find(step => step > model.proses) || 10);
                const isCompleted = statusId < adjustedProses;
                const isCurrent = statusId == adjustedProses && statusId == model.proses;
                const isPending = statusId > adjustedProses;
                
                // Skip pending steps if there's pencabutan
                if (hasPencabutan && isPending) {
                    continue;
                }
                
                let statusText, statusClass, statusIcon, statusColor;
                
                if (isCompleted) {
                    statusText = 'Selesai';
                    statusClass = 'bg-green-100 text-green-800 border-green-300';
                    statusIcon = 'fa-check';
                    statusColor = '#10b981';
                } else if (isCurrent) {
                    statusText = 'Aktif';
                    statusClass = 'bg-blue-100 text-blue-800 border-blue-300';
                    statusIcon = 'fa-spinner';
                    statusColor = '#3b82f6';
                } else {
                    statusText = 'Belum Dilakukan';
                    statusClass = 'bg-gray-100 text-gray-600 border-gray-300';
                    statusIcon = 'fa-clock';
                    statusColor = '#6b7280';
                }
                
                html += `
                <div class="relative pl-16 group">
                    <div class="absolute left-0 w-12 h-12 rounded-full flex items-center justify-center shadow-lg transition-transform duration-300 group-hover:scale-110 z-10" style="background-color: ${statusColor}">
                        <i class="fa ${badge.icon} text-white text-lg"></i>
                    </div>
                    <div class="bg-white border-gray-200 rounded-xl p-4 shadow-md border transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex-1">
                                <h4 class="font-bold text-gray-900 text-base mb-1">${badge.label}</h4>
                                <div class="flex items-center space-x-3 text-xs text-gray-500">
                                    <div class="flex items-center">
                                        <i class="fa fa-info-circle mr-1.5"></i>
                                        <span>${isPending ? 'Menunggu proses sebelumnya' : 'Proses sistem'}</span>
                                    </div>
                                </div>
                            </div>
                            <span class="px-3 py-1 text-xs font-semibold rounded-full ${statusClass} border">
                                <i class="fa ${statusIcon} mr-1"></i>${statusText}
                            </span>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-3">
                            <p class="text-sm text-gray-700 leading-relaxed">
                                ${isPending ? 
                                    'Proses ini akan dilakukan setelah proses sebelumnya selesai' : 
                                    (isCompleted ? 
                                        'Proses ini telah diselesaikan oleh sistem' : 
                                        'Proses ini sedang berjalan')
                                }
                            </p>
                        </div>
                    </div>
                </div>`;
            }
        }
        
        // Tampilkan pencabutan SETELAH proses normal (urutan yang benar)
        if (pencabutanRiwayat.length > 0) {
            // Jika ada pencabutan, tampilkan semua riwayat pencabutan (bisa request + konfirmasi)
            const sortedPencabutan = pencabutanRiwayat.sort((a, b) => new Date(a.updated_at) - new Date(b.updated_at));
            
            sortedPencabutan.forEach(r => {
                const isRequest = r.status.includes('Request');
                const badge = isRequest ? badgeConfig['pencabutan-request'] : badgeConfig['pencabutan-confirmed'];
                const bgColor = isRequest ? 'bg-orange-50 border-orange-300' : 'bg-gray-100 border-gray-300';
                const textColor = isRequest ? 'text-orange-900' : 'text-gray-900';
                    
                const date = new Date(r.updated_at);
                const formattedDate = date.toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' });
                const formattedTime = date.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
                
                html += `
                    <div class="relative pl-16 group">
                        <div class="absolute left-0 w-12 h-12 rounded-full flex items-center justify-center shadow-lg transition-transform duration-300 group-hover:scale-110 z-10" style="background-color: ${badge.color}">
                            <i class="fa ${badge.icon} text-white text-lg"></i>
                        </div>
                        <div class="${bgColor} border-2 rounded-xl p-4 shadow-md transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex-1">
                                    <h4 class="font-bold ${textColor} text-base mb-1">${r.status}</h4>
                                    <div class="flex items-center space-x-3 text-xs text-gray-600">
                                        <div class="flex items-center">
                                            <i class="fa fa-calendar mr-1.5"></i>
                                            <span>${formattedDate}</span>
                                        </div>
                                        <div class="flex items-center">
                                            <i class="fa fa-clock mr-1.5"></i>
                                            <span>${formattedTime}</span>
                                        </div>
                                    </div>
                                </div>
                                <span class="px-3 py-1 text-xs font-semibold rounded-full ${isRequest ? 'bg-orange-100 text-orange-800 border-2 border-orange-400' : 'bg-gray-100 text-gray-700 border-2 border-gray-400'}">
                                    <i class="fa ${badge.icon} mr-1"></i>${badge.label}
                                </span>
                            </div>
                            <div class="bg-white/70 rounded-lg p-3">
                                <p class="text-sm text-gray-700 leading-relaxed mb-2">${r.keterangan}</p>
                                ${r.revisi_detail ? 
                                    `<div class="mt-3 p-3 ${isRequest ? 'bg-orange-100 border-2 border-orange-300' : 'bg-gray-50 border-2 border-gray-200'} rounded-lg">
                                        <p class="text-xs font-semibold ${isRequest ? 'text-orange-900' : 'text-gray-800'} mb-1">
                                            <i class="fa fa-info-circle mr-1"></i>${isRequest ? 'Alasan Pencabutan:' : 'Konfirmasi:'}
                                        </p>
                                        <p class="text-sm ${isRequest ? 'text-orange-800' : 'text-gray-700'} font-medium">${r.revisi_detail}</p>
                                    </div>` : ''
                                }
                            </div>
                        </div>
                    </div>`;
            });
        }
        
        // Handle rejected status (status_id = 0) if exists and not pencabutan
        const rejectedRiwayat = riwayat.find(r => r.status_id == 0 && !r.status.includes('Pencabutan') && !r.status.includes('pencabutan'));
        if (rejectedRiwayat) {
            const r = rejectedRiwayat;
            const date = new Date(r.updated_at);
            const formattedDate = date.toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' });
            const formattedTime = date.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
            
            html += `
            <div class="relative pl-16 group">
                <div class="absolute left-0 w-12 h-12 rounded-full flex items-center justify-center shadow-lg transition-transform duration-300 group-hover:scale-110 z-10" style="background-color: #dc2626">
                    <i class="fa fa-times-circle text-white text-lg"></i>
                </div>
                <div class="bg-red-50 border-red-300 border-2 rounded-xl p-4 shadow-md transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex-1">
                            <h4 class="font-bold text-red-900 text-base mb-1">${r.status}</h4>
                            <div class="flex items-center space-x-3 text-xs text-gray-500">
                                <div class="flex items-center">
                                    <i class="fa fa-calendar mr-1.5"></i>
                                    <span>${formattedDate}</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fa fa-clock mr-1.5"></i>
                                    <span>${formattedTime}</span>
                                </div>
                            </div>
                        </div>
                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800 border-2 border-red-400">
                            <i class="fa fa-ban mr-1"></i>Ditolak
                        </span>
                    </div>
                    <div class="bg-white/70 rounded-lg p-3">
                        <p class="text-sm text-gray-700 leading-relaxed">${r.keterangan}</p>
                        ${r.revisi_detail ? 
                            `<div class="mt-3 p-3 bg-red-100 border-2 border-red-300 rounded-lg">
                                <p class="text-xs font-semibold text-red-900 mb-1"><i class="fa fa-ban mr-1"></i>Alasan Penolakan:</p>
                                <p class="text-sm text-red-800 font-medium">${r.revisi_detail}</p>
                            </div>` : ''
                        }
                    </div>
                </div>
            </div>`;
        }
        
        html += '</div></div>';
        console.log('Generated HTML length:', html.length);
        content.innerHTML = html;
        console.log('Timeline rendered successfully');
    }
    
    function closeRiwayatModal() {
        console.log('closeRiwayatModal called');
        
        const modal = document.getElementById('modal-riwayat');
        const backdrop = document.getElementById('modal-backdrop-riwayat');
        
        // Reset content
        const content = document.getElementById('riwayat-content');
        const subtitle = document.getElementById('modal-subtitle');
        if (content) {
            content.innerHTML = '<div class="text-center py-8"><i class="fas fa-spinner fa-spin text-4xl text-[#185B3C]"></i><p class="mt-4 text-gray-600">Memuat riwayat...</p></div>';
        }
        if (subtitle) {
            subtitle.textContent = 'Persetujuan Bagi UMK';
        }
        console.log('Content cleared');
        
        modal.style.display = 'none';
        modal.classList.remove('show');
        document.body.classList.remove('modal-open');
        
        if (backdrop) {
            backdrop.remove();
        }
        console.log('Modal closed');
    }


    document.addEventListener('DOMContentLoaded', function() {
        console.log('DOM Content Loaded');
        
        const cards = document.querySelectorAll('.bg-white\\/80, .bg-gradient-to-br');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            setTimeout(() => {
                card.style.transition = 'all 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });

        const tableRows = document.querySelectorAll('.group');
        tableRows.forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.transform = 'translateX(4px)';
            });
            
            row.addEventListener('mouseleave', function() {
                this.style.transform = 'translateX(0)';
            });
        });

        // Close modal when clicking outside
        const modal = document.getElementById('modal-riwayat');
        if (modal) {
            console.log('Modal found, adding click listener');
            modal.addEventListener('click', function(e) {
                console.log('Modal clicked', e.target);
                if (e.target === this) {
                    closeRiwayatModal();
                }
            });
        } else {
            console.error('Modal not found in DOM!');
        }
        
        // Debug: Check for status buttons
        const statusButtons = document.querySelectorAll('button[onclick^="openRiwayat"]');
        console.log('Status buttons found:', statusButtons.length);
    });

    // Kirim ke Kabid
    function kirimKabid(id) {
        Swal.fire({
            title: 'Kirim ke Kabid?',
            text: "Dokumen akan dikirim untuk persetujuan Kabid",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#6366F1',
            cancelButtonColor: '#6B7280',
            confirmButtonText: 'Ya, Kirim!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/admin/kkprnon/kirim-kabid/${id}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Dokumen berhasil dikirim ke Kabid',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: data.message || 'Terjadi kesalahan'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Terjadi kesalahan saat mengirim dokumen'
                    });
                });
            }
        });
    }

    // Open Upload Draft Modal
    function openUploadDraftModal(id) {
        document.getElementById('upload_draft_kkpr_id').value = id;
        document.getElementById('upload-draft-modal').style.display = 'block';
        document.getElementById('upload-draft-backdrop').style.display = 'block';
        document.body.style.overflow = 'hidden';
    }

    // Close Upload Draft Modal
    function closeUploadDraftModal() {
        document.getElementById('upload-draft-modal').style.display = 'none';
        document.getElementById('upload-draft-backdrop').style.display = 'none';
        document.getElementById('upload-draft-form').reset();
        document.getElementById('file-name-display').textContent = 'Belum ada file dipilih';
        document.getElementById('file-size-display').textContent = '';
        document.getElementById('file-preview-section').style.display = 'none';
        document.body.style.overflow = 'auto';
    }

    // Handle file selection
    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.getElementById('draft_file');
        if (fileInput) {
            fileInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    // Display file info
                    document.getElementById('file-name-display').textContent = file.name;
                    const fileSize = (file.size / 1024 / 1024).toFixed(2);
                    document.getElementById('file-size-display').textContent = `${fileSize} MB`;
                    document.getElementById('file-preview-section').classList.remove('hidden');
                    
                    // Validate file size
                    if (file.size > 10 * 1024 * 1024) {
                        Swal.fire({
                            icon: 'error',
                            title: 'File Terlalu Besar!',
                            text: 'Ukuran file maksimal 10 MB'
                        });
                        fileInput.value = '';
                        document.getElementById('file-preview-section').classList.add('hidden');
                    }
                }
            });
        }
    });
</script>

<!-- Dropdown Menu Modal -->
<div id="dropdown-menu-modal" class="hidden fixed" style="z-index: 9999;">
    <div class="bg-white rounded-lg shadow-2xl border border-gray-200 w-48 max-h-[80vh] overflow-y-auto" id="dropdown-menu-content">
        <!-- Content will be filled by JavaScript -->
    </div>
</div>

<!-- Modal Riwayat -->
<div class="modal fade" id="modal-riwayat" tabindex="-1" role="dialog" aria-labelledby="modalRiwayatLabel" aria-hidden="true" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 1050; overflow: auto;">
    <div class="modal-dialog modal-lg" role="document" style="position: relative; max-width: 800px; margin: 1.75rem auto;">
        <div class="modal-content border-0 shadow-2xl rounded-xl">
            <!-- Modal Header -->
            <div class="bg-gradient-to-r from-[#185B3C] to-[#0F3D26] text-white rounded-t-xl px-6 py-4 relative">
                <div class="flex items-center space-x-3 pr-12">
                    <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-history"></i>
                    </div>
                    <div>
                        <h5 class="text-lg font-bold">Riwayat Proses</h5>
                        <p class="text-sm text-white/80" id="modal-subtitle">Persetujuan Bagi UMK</p>
                    </div>
                </div>
                <button type="button" class="absolute top-4 right-4 w-8 h-8 flex items-center justify-center text-white/80 hover:text-white hover:bg-white/10 rounded-lg transition-all" onclick="closeRiwayatModal()">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>
            
            <!-- Modal Body -->
            <div class="p-6 bg-gray-50" style="max-height: 70vh; overflow-y: auto;" id="riwayat-content">
                <div class="text-center py-8">
                    <i class="fas fa-spinner fa-spin text-4xl text-[#185B3C]"></i>
                    <p class="mt-4 text-gray-600">Memuat riwayat...</p>
                </div>
            </div>
            
            <!-- Modal Footer -->
            <div class="bg-gray-50 rounded-b-xl p-4">
                <button type="button" class="w-full px-4 py-3 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors font-semibold" onclick="closeRiwayatModal()">
                    <i class="fas fa-times mr-2"></i>
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Upload Draft Modal - Inline CSS Version -->
<div id="survey-backdrop" style="display: none; position: fixed; inset: 0; background-color: rgba(0,0,0,0.4); z-index: 9998;"></div>
<div id="survey-modal" style="display: none; position: fixed; inset: 0; z-index: 9999; align-items: center; justify-content: center; padding: 1.5rem;">
    <div style="background-color: #ffffff; border-radius: 0.75rem; padding: 1.5rem; width: 100%; max-width: 420px; box-shadow: 0 20px 40px rgba(0,0,0,0.2); border: 1px solid #e5e7eb;">
        <div style="margin-bottom: 1.25rem;">
            <h3 style="margin: 0; font-size: 1.25rem; font-weight: 700; color: #111827;">Penjadwalan Survey</h3>
            <p style="margin: 0.25rem 0 0 0; font-size: 0.875rem; color: #4b5563;">Isi jadwal dan unggah surat survey lapangan.</p>
        </div>
        <form id="survey-form" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 1rem;">
            @csrf
            <div>
                <label for="jadwal_survey" style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Jadwal Survey</label>
                <input type="datetime-local" id="jadwal_survey" name="jadwal_survey" required style="width: 100%; border: 1px solid #d1d5db; border-radius: 0.5rem; padding: 0.625rem 0.75rem; font-size: 0.9375rem; color: #111827; outline: none;">
            </div>
            <div>
                <label for="f_survey" style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Surat Survey</label>
                <input type="file" id="f_survey" name="f_survey" accept=".pdf,.jpg,.jpeg,.png" required style="width: 100%; border: 1px solid #d1d5db; border-radius: 0.5rem; padding: 0.5rem; font-size: 0.9375rem; color: #111827; outline: none; background-color: #f9fafb;">
                <p style="margin-top: 0.375rem; font-size: 0.75rem; color: #6b7280;">Format: PDF/JPG/PNG, maks 10 MB.</p>
            </div>
            <p id="survey-error" style="min-height: 1.25rem; font-size: 0.8125rem; color: #dc2626; margin: 0;"></p>
            <div style="display: flex; justify-content: flex-end; gap: 0.5rem; margin-top: 0.5rem;">
                <button type="button" onclick="closeSurveyModal()" style="padding: 0.625rem 1.25rem; border-radius: 0.5rem; border: 1px solid #d1d5db; background-color: #f9fafb; color: #374151; font-weight: 600; cursor: pointer;">Batal</button>
                <button type="submit" style="padding: 0.625rem 1.25rem; border-radius: 0.5rem; border: none; background-color: #f97316; color: #ffffff; font-weight: 600; cursor: pointer;">Simpan</button>
            </div>
        </form>
    </div>
</div>

<div id="upload-draft-backdrop" style="display: none; position: fixed; top: 0; right: 0; bottom: 0; left: 0; background-color: rgba(0, 0, 0, 0.5); backdrop-filter: blur(4px); z-index: 9998; transition: opacity 0.15s;" onclick="closeUploadDraftModal()"></div>
<div id="upload-draft-modal" style="display: none; position: fixed; top: 0; right: 0; bottom: 0; left: 0; z-index: 9999; overflow-y: auto;">
    <div style="display: flex; min-height: 100%; align-items: center; justify-content: center; padding: 1rem;">
        <div style="position: relative; background-color: #ffffff; border-radius: 1rem; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25); max-width: 32rem; width: 100%; transform: translateY(0); transition: all 0.15s;">
            <!-- Modal Header -->
            <div style="position: relative; overflow: hidden; background: linear-gradient(to bottom right, #10b981, #059669, #0d9488); padding: 2rem 1.5rem; border-radius: 1rem 1rem 0 0;">
                <div style="position: absolute; top: 0; right: 0; bottom: 0; left: 0; background-color: rgba(0, 0, 0, 0.1);"></div>
                <div style="position: relative; z-index: 10; display: flex; align-items: center; justify-content: space-between;">
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <div style="width: 3.5rem; height: 3.5rem; background-color: rgba(255, 255, 255, 0.2); backdrop-filter: blur(4px); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);">
                            <i class="fas fa-file-upload" style="font-size: 1.875rem; color: #ffffff;"></i>
                        </div>
                        <div>
                            <h3 style="font-size: 1.5rem; font-weight: 700; color: #ffffff; margin: 0;">Upload Draft Dokumen</h3>
                            <p style="font-size: 0.875rem; color: rgba(255, 255, 255, 0.8); margin: 0.25rem 0 0 0;">Upload dokumen hasil penilaian (PDF)</p>
                        </div>
                    </div>
                    <button type="button" onclick="closeUploadDraftModal()" style="color: rgba(255, 255, 255, 0.8); border: none; background: transparent; border-radius: 0.5rem; padding: 0.5rem; transition: all 0.15s; cursor: pointer;" onmouseover="this.style.color='#ffffff'; this.style.backgroundColor='rgba(255, 255, 255, 0.2)';" onmouseout="this.style.color='rgba(255, 255, 255, 0.8)'; this.style.backgroundColor='transparent';">
                        <i class="fas fa-times" style="font-size: 1.25rem;"></i>
                    </button>
                </div>
                <!-- Decorative circles -->
                <div style="position: absolute; top: 0; right: 0; width: 8rem; height: 8rem; background-color: rgba(255, 255, 255, 0.1); border-radius: 50%; transform: translate(4rem, -4rem);"></div>
                <div style="position: absolute; bottom: 0; left: 0; width: 6rem; height: 6rem; background-color: rgba(255, 255, 255, 0.1); border-radius: 50%; transform: translate(-3rem, 3rem);"></div>
            </div>

            <!-- Modal Body -->
            <form id="upload-draft-form" action="{{ route('admin.kkprnon.upload.draft') }}" method="POST" enctype="multipart/form-data" style="padding: 1.5rem;">
                @csrf
                <input type="hidden" name="kkpr_id" id="upload_draft_kkpr_id">

                <!-- Upload Area -->
                <div style="display: flex; flex-direction: column; gap: 1rem;">
                    <!-- Info Box -->
                    <div style="background: linear-gradient(to right, #d1fae5, #ccfbf1); border-left: 4px solid #10b981; border-radius: 0.5rem; padding: 1rem;">
                        <div style="display: flex; align-items: flex-start; gap: 0.75rem;">
                            <i class="fas fa-info-circle" style="color: #059669; margin-top: 0.125rem;"></i>
                            <div style="flex: 1;">
                                <p style="font-size: 0.875rem; font-weight: 500; color: #064e3b; margin: 0 0 0.5rem 0;">Informasi Upload</p>
                                <ul style="font-size: 0.75rem; color: #047857; margin: 0; padding-left: 1.25rem; list-style: disc;">
                                    <li style="margin-bottom: 0.25rem;">Format file: <strong>PDF</strong></li>
                                    <li style="margin-bottom: 0.25rem;">Ukuran maksimal: <strong>10 MB</strong></li>
                                    <li>Dokumen akan otomatis menyelesaikan proses</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- File Upload Area -->
                    <div style="position: relative;">
                        <label style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 0.75rem;">
                            <i class="fas fa-file-pdf" style="margin-right: 0.5rem; color: #059669;"></i>
                            Pilih File PDF <span style="color: #ef4444;">*</span>
                        </label>
                        
                        <div style="position: relative; border: 2px dashed #d1d5db; border-radius: 0.75rem; padding: 2rem; text-align: center; background: linear-gradient(to bottom right, #f9fafb, #e5e7eb); transition: border-color 0.3s;" onmouseover="this.style.borderColor='#10b981';" onmouseout="this.style.borderColor='#d1d5db';">
                            <input type="file" id="draft_file" name="draft_file" accept="application/pdf" required
                                   style="position: absolute; top: 0; right: 0; bottom: 0; left: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer; z-index: 10;"
                                   onchange="
                                       const file = this.files[0];
                                       if (file) {
                                           document.getElementById('file-name-display').textContent = file.name;
                                           document.getElementById('file-size-display').textContent = (file.size / 1024 / 1024).toFixed(2) + ' MB';
                                           document.getElementById('file-preview-section').style.display = 'block';
                                       }
                                   ">
                            
                            <div style="pointer-events: none;">
                                <div style="width: 4rem; height: 4rem; background: linear-gradient(to bottom right, #10b981, #0d9488); border-radius: 1rem; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem auto; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);">
                                    <i class="fas fa-cloud-upload-alt" style="font-size: 1.875rem; color: #ffffff;"></i>
                                </div>
                                <p style="font-size: 1rem; font-weight: 600; color: #374151; margin: 0 0 0.25rem 0;">Klik atau drag file ke sini</p>
                                <p style="font-size: 0.75rem; color: #6b7280; margin: 0;">PDF, maksimal 10 MB</p>
                            </div>
                        </div>

                        <!-- File Preview -->
                        <div id="file-preview-section" style="display: none; margin-top: 1rem; padding: 1rem; background-color: #ffffff; border: 2px solid #a7f3d0; border-radius: 0.75rem;">
                            <div style="display: flex; align-items: center; gap: 1rem;">
                                <div style="width: 3rem; height: 3rem; background: linear-gradient(to bottom right, #ef4444, #dc2626); border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
                                    <i class="fas fa-file-pdf" style="font-size: 1.5rem; color: #ffffff;"></i>
                                </div>
                                <div style="flex: 1; min-width: 0;">
                                    <p style="font-size: 0.875rem; font-weight: 600; color: #111827; margin: 0; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" id="file-name-display">Belum ada file dipilih</p>
                                    <div style="display: flex; align-items: center; gap: 0.5rem; margin-top: 0.25rem;">
                                        <span style="font-size: 0.75rem; color: #6b7280;" id="file-size-display"></span>
                                        <span style="display: inline-flex; align-items: center; padding: 0.125rem 0.5rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 500; background-color: #d1fae5; color: #065f46;">
                                            <i class="fas fa-check-circle" style="margin-right: 0.25rem;"></i>
                                            Siap Upload
                                        </span>
                                    </div>
                                </div>
                                <button type="button" onclick="document.getElementById('draft_file').value=''; document.getElementById('file-preview-section').style.display='none';" 
                                        style="color: #9ca3af; border: none; background: transparent; cursor: pointer; transition: color 0.15s; padding: 0.25rem;" onmouseover="this.style.color='#dc2626';" onmouseout="this.style.color='#9ca3af';">
                                    <i class="fas fa-times-circle" style="font-size: 1.25rem;"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div style="display: flex; align-items: center; justify-content: flex-end; gap: 0.75rem; margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid #e5e7eb;">
                    <button type="button" onclick="closeUploadDraftModal()" 
                            style="padding: 0.625rem 1.5rem; color: #374151; background-color: #f3f4f6; font-weight: 600; border-radius: 0.75rem; transition: all 0.2s; border: none; cursor: pointer;" onmouseover="this.style.backgroundColor='#e5e7eb';" onmouseout="this.style.backgroundColor='#f3f4f6';">
                        <i class="fas fa-times" style="margin-right: 0.5rem;"></i>
                        Batal
                    </button>
                    <button type="submit" 
                            style="padding: 0.625rem 1.5rem; background: linear-gradient(to right, #10b981, #0d9488); color: #ffffff; font-weight: 600; border-radius: 0.75rem; transition: all 0.2s; border: none; cursor: pointer;" onmouseover="this.style.boxShadow='0 10px 15px -3px rgba(0, 0, 0, 0.1)'; this.style.transform='scale(1.05)';" onmouseout="this.style.boxShadow='none'; this.style.transform='scale(1)';">
                        <i class="fas fa-upload" style="margin-right: 0.5rem;"></i>
                        Upload Dokumen
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection



