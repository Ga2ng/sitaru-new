@extends('layouts.app')

@section('title', 'Admin KKPR - Persetujuan UMK')
@section('subtitle', 'Kelola semua permohonan kependudukan dengan mudah dan efisien')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">
    <!-- Hero Section with Gradient -->
    <div class="relative overflow-hidden bg-gradient-to-br from-[#185B3C] via-[#0F3D26] to-[#185B3C] rounded-xl p-6 text-white">
        <div class="absolute inset-0 bg-black/10"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold mb-1">Admin KKPR - Persetujuan UMK</h1>
                    <p class="text-sm text-white/90 mb-4">Kelola semua permohonan kependudukan dengan mudah dan efisien</p>
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
                        <i class="fas fa-building text-3xl text-white/80"></i>
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
            <a href="{{ route('admin.kkpr.create') }}" class="group relative overflow-hidden bg-gradient-to-br from-[#185B3C] to-[#0F3D26] rounded-xl p-4 text-white hover:shadow-lg transition-all duration-300">
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
        
        <form method="GET" action="{{ route('admin.kkpr.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
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
                        <h3 class="text-lg font-bold text-gray-900">Daftar Permohonan KKPR</h3>
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
                                    1 => ['label' => 'Pengajuan', 'color' => 'blue'],
                                    2 => ['label' => 'Upload Dokumen', 'color' => 'yellow'],
                                    3 => ['label' => 'Validasi', 'color' => 'orange'],
                                    4 => ['label' => 'Bayar', 'color' => 'purple'],
                                    5 => ['label' => 'Validasi Bayar', 'color' => 'indigo'],
                                    6 => ['label' => 'Survey', 'color' => 'pink'],
                                    7 => ['label' => 'Analisa', 'color' => 'cyan'],
                                    8 => ['label' => 'Persetujuan', 'color' => 'teal'],
                                    9 => ['label' => 'TTE', 'color' => 'emerald'],
                                    10 => ['label' => 'Selesai', 'color' => 'green'],
                                ];
                                $status = $statusConfig[$kkpr->proses] ?? ['label' => 'Unknown', 'color' => 'gray'];
                            @endphp
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-{{ $status['color'] }}-100 text-{{ $status['color'] }}-800 border border-{{ $status['color'] }}-300">
                                {{ $status['label'] }}
                            </span>
                        </div>
                        <div class="col-span-1">
                            <div class="flex items-center space-x-1">
                                <a href="{{ route('admin.kkpr.show', $kkpr->id) }}" class="p-2 text-gray-400 hover:text-[#185B3C] hover:bg-[#185B3C]/10 rounded-lg transition-all duration-200 hover:scale-105" title="Lihat Detail">
                                    <i class="fas fa-eye text-xs"></i>
                                </a>
                                <a href="{{ route('admin.kkpr.edit', $kkpr->id) }}" class="p-2 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-200 hover:scale-105" title="Edit">
                                    <i class="fas fa-edit text-xs"></i>
                                </a>
                                <button onclick="deleteKkpr({{ $kkpr->id }})" class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all duration-200 hover:scale-105" title="Hapus">
                                    <i class="fas fa-trash text-xs"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="px-6 py-12 text-center">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-inbox text-gray-400 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Tidak ada data</h3>
                    <p class="text-gray-500 mb-4">Belum ada permohonan KKPR yang tersedia</p>
                    <a href="{{ route('admin.kkpr.create') }}" class="inline-flex items-center px-4 py-2 bg-[#185B3C] text-white rounded-lg hover:bg-[#0F3D26] transition-colors">
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
        // Implement export functionality
        alert('Fitur export akan segera tersedia');
    }

    function deleteKkpr(id) {
        if (confirm('Apakah Anda yakin ingin menghapus permohonan ini?')) {
            fetch(`/admin/kkpr/${id}`, {
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
        // Staggered animation for cards
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

        // Interactive hover effects for table rows
        const tableRows = document.querySelectorAll('.group');
        tableRows.forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.transform = 'translateX(4px)';
            });
            
            row.addEventListener('mouseleave', function() {
                this.style.transform = 'translateX(0)';
            });
        });
    });
</script>
@endsection
