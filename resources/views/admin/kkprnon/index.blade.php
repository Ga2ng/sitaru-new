@extends('layouts.app')

@section('title', 'Admin Persetujuan Bagi UMK')
@section('subtitle', 'Penilaian Persetujuan Bagi UMK')

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
                    <h1 class="text-2xl font-bold mb-1">Admin Persetujuan Bagi UMK</h1>
                    <p class="text-sm text-white/90 mb-4">Penilaian Persetujuan Bagi UMK - Kelola semua permohonan dengan mudah</p>
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
                        <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">FUNGSI</span>
                    </div>
                    <div class="col-span-2">
                        <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">ALAMAT</span>
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
                            <p class="text-gray-900 font-medium text-sm">{{ $kkpr->created_at->format('d M Y') }}</p>
                            <p class="text-xs text-gray-500">{{ $kkpr->created_at->format('H:i') }}</p>
                        </div>
                        <div class="col-span-3">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-gradient-to-br from-[#185B3C] to-[#0F3D26] rounded-xl flex items-center justify-center shadow-md group-hover:scale-105 transition-transform">
                                    <i class="fas fa-user text-white text-sm"></i>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900 text-sm">{{ $kkpr->user->name ?? 'N/A' }}</p>
                                    <p class="text-xs text-gray-500">{{ $kkpr->user->phone ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-2">
                            <p class="font-semibold text-gray-900 text-sm">{{ $kkpr->fungsi ?? 'N/A' }}</p>
                            <p class="text-xs text-gray-500">{{ $kkpr->jenis_kegiatan ?? 'N/A' }}</p>
                        </div>
                        <div class="col-span-2">
                            <p class="text-gray-900 text-sm">{{ Str::limit($kkpr->alamat_kegiatan ?? $kkpr->alamat_tanah, 30) }}</p>
                            <p class="text-xs text-gray-500">{{ $kkpr->kecamatan->NAMA_KEC ?? 'N/A' }}</p>
                        </div>
                        <div class="col-span-1">
                            @php
                                $statusConfig = [
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
                            @if($kkpr->revisi == 1)
                                <button onclick="openRiwayat({{ $kkpr->id }})" class="inline-flex items-center px-2 py-1 text-xs font-bold rounded-full bg-red-100 text-red-800 border-2 border-red-300 shadow-sm hover:bg-red-200 transition-colors cursor-pointer" title="Lihat Riwayat Proses">
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
                            <button id="btn-aksi-{{ $kkpr->id }}" onclick="toggleDropdown({{ $kkpr->id }}, {{ $kkpr->proses }}, {{ $kkpr->revisi }}, {{ auth()->user()->can('Verifikator') ? 'true' : 'false' }}, {{ auth()->user()->can('Analis') ? 'true' : 'false' }})" class="inline-flex items-center space-x-1.5 px-3 py-1.5 text-xs font-medium text-gray-700 bg-white hover:bg-[#185B3C]/10 hover:text-[#185B3C] border border-gray-300 rounded-lg transition-all duration-200 hover:scale-105" title="Aksi">
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
                    <a href="{{ route('admin.kkprnon.create') }}" class="inline-flex items-center px-4 py-2 bg-[#185B3C] text-white rounded-lg hover:bg-[#0F3D26] transition-colors">
                        <i class="fas fa-plus mr-2"></i>
                        Buat Permohonan Pertama
                    </a>
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

    function toggleDropdown(id, status, revisi, canValidate, canSurvey) {
        const button = event.currentTarget;
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
        let menuItems = `
            <div class="py-1">
                <a href="/admin/kkprnon/${id}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-[#185B3C]/10 hover:text-[#185B3C] transition-colors">
                    <i class="fas fa-eye w-4 mr-3"></i>
                    Lihat Detail
                </a>`;
        
        // Validasi - hanya untuk Verifikator dan status = 1 (Pengajuan)
        if (canValidate && status == 1) {
            menuItems += `
                <a href="/admin/kkprnon/${id}/validasi" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600 transition-colors">
                    <i class="fas fa-check-circle w-4 mr-3"></i>
                    Validasi
                </a>`;
        }
        
        
        // Survey - hanya untuk Analis dan belum survey (proses < 6)
        if (canSurvey && status < 6) {
            menuItems += `
                <button onclick="setSurvey(${id}); closeDropdownModal();" class="w-full flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600 transition-colors text-left">
                    <i class="fas fa-map-marked-alt w-4 mr-3"></i>
                    Survey
                </button>`;
        }
        
        // Analisa - hanya untuk Analis dan belum analisa (proses < 7), bisa skip survey
        if (canSurvey && status < 7) {
            menuItems += `
                <a href="/admin/kkprnon/${id}/analisa" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-600 transition-colors">
                    <i class="fas fa-file-signature w-4 mr-3"></i>
                    Analisa
                </a>`;
        }
        
        // Cetak Berkas - hanya setelah analisa (proses >= 7)
        if (status >= 7) {
            menuItems += `
                <a href="/admin/kkprnon/${id}/cetak-berkas" target="_blank" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors">
                    <i class="fas fa-file-pdf w-4 mr-3"></i>
                    Cetak Berkas
                </a>`;
        }
        
        menuItems += `
                <button onclick="kirimKabid(${id}); closeDropdownModal();" class="w-full flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors text-left">
                    <i class="fas fa-paper-plane w-4 mr-3"></i>
                    Kirim Kabid
                </button>
                <button onclick="persetujuanDokumen(${id}); closeDropdownModal();" class="w-full flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-cyan-50 hover:text-cyan-600 transition-colors text-left">
                    <i class="fas fa-check-double w-4 mr-3"></i>
                    Persetujuan Dokumen
                </button>
                <button onclick="openUploadDraftModal(${id}); closeDropdownModal();" class="w-full flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 transition-colors text-left">
                    <i class="fas fa-file-upload w-4 mr-3"></i>
                    Upload Draft
                </button>`;
        
        // Edit - HIDDEN (commented out as per requirement)
        /*
                <a href="/admin/kkprnon/${id}/edit" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors">
                    <i class="fas fa-edit w-4 mr-3"></i>
                    Edit
                </a>
        */
        
        menuItems += `
                <button onclick="deleteKkpr(${id}); closeDropdownModal();" class="w-full flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 transition-colors text-left">
                    <i class="fas fa-trash w-4 mr-3"></i>
                    Hapus
                </button>
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

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        if (!event.target.closest('[onclick^="toggleDropdown"]') && !event.target.closest('#dropdown-menu-modal')) {
            closeDropdownModal();
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
        
        riwayat.forEach((r, index) => {
            if (r.status_id <= model.proses) {
                const isRevisi = r.status_id == model.proses && model.revisi == 1;
                const badge = badgeConfig[r.status_id] || { icon: 'fa-file', color: '#6c757d', label: 'Unknown' };
                const badgeIcon = isRevisi ? 'fa-exclamation-circle' : badge.icon;
                const badgeColor = isRevisi ? 'red' : badge.color;
                
                const date = new Date(r.updated_at);
                const formattedDate = date.toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' });
                const formattedTime = date.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
                
                html += `
                <div class="relative pl-16 group">
                    <div class="absolute left-0 w-12 h-12 rounded-full flex items-center justify-center shadow-lg transition-transform duration-300 group-hover:scale-110 z-10" style="background-color: ${badgeColor}">
                        <i class="fa ${badgeIcon} text-white text-lg"></i>
                    </div>
                    <div class="${isRevisi ? 'bg-red-50 border-red-200' : 'bg-white border-gray-200'} rounded-xl p-4 shadow-md border transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex-1">
                                <h4 class="font-bold text-gray-900 text-base mb-1">${r.status}</h4>
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
                            ${isRevisi ? 
                                '<span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800 border border-red-300"><i class="fa fa-exclamation-circle mr-1"></i>Revisi</span>' :
                                (r.status_id == model.proses ? 
                                    '<span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800 border border-blue-300"><i class="fa fa-spinner mr-1"></i>Aktif</span>' :
                                    '<span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800 border border-green-300"><i class="fa fa-check mr-1"></i>Selesai</span>')
                            }
                        </div>
                        <div class="${isRevisi ? 'bg-white/50' : 'bg-gray-50'} rounded-lg p-3">
                            <p class="text-sm text-gray-700 leading-relaxed">${r.keterangan}</p>
                            ${isRevisi && r.revisi_detail ? 
                                `<div class="mt-3 p-3 bg-red-50 border border-red-200 rounded-lg">
                                    <p class="text-xs font-semibold text-red-800 mb-1"><i class="fa fa-info-circle mr-1"></i>Detail Revisi:</p>
                                    <p class="text-sm text-red-700">${r.revisi_detail}</p>
                                </div>` : ''
                            }
                        </div>
                    </div>
                </div>`;
            }
        });
        
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

    function deleteKkpr(id) {
        if (confirm('Apakah Anda yakin ingin menghapus permohonan ini?')) {
            fetch(`/admin/kkprnon/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Gagal menghapus data');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan');
            });
        }
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

    // Set Survey Status
    function setSurvey(id) {
        Swal.fire({
            title: 'Survey Lapangan?',
            text: "Apakah survey lapangan sudah dilakukan?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#F97316',
            cancelButtonColor: '#6B7280',
            confirmButtonText: 'Ya, Sudah Survey',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/admin/kkprnon/survey/${id}`, {
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
                            text: 'Status survey berhasil diupdate',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: data.message || 'Terjadi kesalahan saat update status survey'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Terjadi kesalahan saat update status survey'
                    });
                });
            }
        });
    }

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

    // Persetujuan Dokumen
    function persetujuanDokumen(id) {
        Swal.fire({
            title: 'Setujui Dokumen?',
            text: "Dokumen akan disetujui dan siap untuk proses TTD",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#06B6D4',
            cancelButtonColor: '#6B7280',
            confirmButtonText: 'Ya, Setujui!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/admin/kkprnon/persetujuan-dokumen/${id}`, {
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
                            text: 'Dokumen berhasil disetujui',
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
                        text: 'Terjadi kesalahan saat menyetujui dokumen'
                    });
                });
            }
        });
    }

    // Open Upload Draft Modal
    function openUploadDraftModal(id) {
        document.getElementById('upload_draft_kkpr_id').value = id;
        document.getElementById('upload-draft-modal').classList.remove('hidden');
        document.getElementById('upload-draft-backdrop').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    // Close Upload Draft Modal
    function closeUploadDraftModal() {
        document.getElementById('upload-draft-modal').classList.add('hidden');
        document.getElementById('upload-draft-backdrop').classList.add('hidden');
        document.getElementById('upload-draft-form').reset();
        document.getElementById('file-name-display').textContent = 'Belum ada file dipilih';
        document.getElementById('file-size-display').textContent = '';
        document.getElementById('file-preview-section').classList.add('hidden');
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

<!-- Upload Draft Modal -->
<div id="upload-draft-backdrop" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-[9998] transition-opacity" onclick="closeUploadDraftModal()"></div>
<div id="upload-draft-modal" class="hidden fixed inset-0 z-[9999] overflow-y-auto">
    <div class="flex min-h-full items-center justify-center p-4">
        <div class="relative bg-white rounded-2xl shadow-2xl max-w-lg w-full transform transition-all">
            <!-- Modal Header -->
            <div class="relative overflow-hidden bg-gradient-to-br from-emerald-500 via-emerald-600 to-teal-600 px-6 py-8 rounded-t-2xl">
                <div class="absolute inset-0 bg-black/10"></div>
                <div class="relative z-10 flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center shadow-lg">
                            <i class="fas fa-file-upload text-3xl text-white"></i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-white">Upload Draft Dokumen</h3>
                            <p class="text-sm text-white/80 mt-1">Upload dokumen hasil penilaian (PDF)</p>
                        </div>
                    </div>
                    <button type="button" onclick="closeUploadDraftModal()" class="text-white/80 hover:text-white hover:bg-white/20 rounded-lg p-2 transition-all">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <!-- Decorative circles -->
                <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -translate-y-16 translate-x-16"></div>
                <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/10 rounded-full translate-y-12 -translate-x-12"></div>
            </div>

            <!-- Modal Body -->
            <form id="upload-draft-form" action="{{ route('admin.kkprnon.upload.draft') }}" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf
                <input type="hidden" name="kkpr_id" id="upload_draft_kkpr_id">

                <!-- Upload Area -->
                <div class="space-y-4">
                    <!-- Info Box -->
                    <div class="bg-gradient-to-r from-emerald-50 to-teal-50 border-l-4 border-emerald-500 rounded-lg p-4">
                        <div class="flex items-start space-x-3">
                            <i class="fas fa-info-circle text-emerald-600 mt-0.5"></i>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-emerald-900">Informasi Upload</p>
                                <ul class="text-xs text-emerald-700 mt-2 space-y-1 list-disc list-inside">
                                    <li>Format file: <strong>PDF</strong></li>
                                    <li>Ukuran maksimal: <strong>10 MB</strong></li>
                                    <li>Dokumen akan otomatis menyelesaikan proses</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- File Upload Area -->
                    <div class="relative">
                        <label class="block text-sm font-semibold text-gray-700 mb-3">
                            <i class="fas fa-file-pdf mr-2 text-emerald-600"></i>
                            Pilih File PDF <span class="text-red-500">*</span>
                        </label>
                        
                        <div class="relative border-2 border-dashed border-gray-300 rounded-xl p-8 text-center hover:border-emerald-500 transition-all duration-300 bg-gradient-to-br from-gray-50 to-gray-100">
                            <input type="file" id="draft_file" name="draft_file" accept="application/pdf" required
                                   class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                            
                            <div class="pointer-events-none">
                                <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                                    <i class="fas fa-cloud-upload-alt text-3xl text-white"></i>
                                </div>
                                <p class="text-base font-semibold text-gray-700 mb-1">Klik atau drag file ke sini</p>
                                <p class="text-xs text-gray-500">PDF, maksimal 10 MB</p>
                            </div>
                        </div>

                        <!-- File Preview -->
                        <div id="file-preview-section" class="hidden mt-4 p-4 bg-white border-2 border-emerald-200 rounded-xl">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-red-500 to-red-600 rounded-lg flex items-center justify-center flex-shrink-0 shadow-md">
                                    <i class="fas fa-file-pdf text-2xl text-white"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-gray-900 truncate" id="file-name-display">Belum ada file dipilih</p>
                                    <div class="flex items-center space-x-2 mt-1">
                                        <span class="text-xs text-gray-500" id="file-size-display"></span>
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                            <i class="fas fa-check-circle mr-1"></i>
                                            Siap Upload
                                        </span>
                                    </div>
                                </div>
                                <button type="button" onclick="document.getElementById('draft_file').value=''; document.getElementById('file-preview-section').classList.add('hidden');" 
                                        class="text-gray-400 hover:text-red-600 transition-colors">
                                    <i class="fas fa-times-circle text-xl"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="flex items-center justify-end space-x-3 mt-6 pt-6 border-t border-gray-200">
                    <button type="button" onclick="closeUploadDraftModal()" 
                            class="px-6 py-2.5 text-gray-700 bg-gray-100 hover:bg-gray-200 font-semibold rounded-xl transition-all duration-200">
                        <i class="fas fa-times mr-2"></i>
                        Batal
                    </button>
                    <button type="submit" 
                            class="px-6 py-2.5 bg-gradient-to-r from-emerald-500 to-teal-600 text-white font-semibold rounded-xl hover:shadow-lg hover:scale-105 transition-all duration-200">
                        <i class="fas fa-upload mr-2"></i>
                        Upload Dokumen
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection



