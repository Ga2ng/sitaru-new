@extends('layouts.app')

@section('title', 'Dashboard')
@section('subtitle', 'Sistem Informasi Tata Ruang - Dashboard')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Dashboard SITARU</h1>
            <p class="text-gray-600 mt-1">
                @if(auth()->user()->hasRole('admin'))
                    Sistem Informasi Tata Ruang - Kelola data KKPR dan UMK
                @else
                    Selamat datang, {{ auth()->user()->name }} - Kelola pengajuan KKPR dan UMK Anda
                @endif
            </p>
        </div>
        <div class="flex space-x-3">
            @if(auth()->user()->hasRole('admin'))
                <a href="{{ route('admin.kkpr.create') }}" class="bg-[#185B3C] text-white px-6 py-2.5 rounded-lg font-medium hover:bg-[#0F3D26] transition-colors shadow-sm">
                    <i class="fas fa-plus mr-2"></i>
                    Buat KKPR
                </a>
                <a href="{{ route('admin.kkprnon.create') }}" class="bg-white text-gray-700 px-6 py-2.5 rounded-lg font-medium border border-gray-200 hover:bg-gray-50 transition-colors shadow-sm">
                    <i class="fas fa-building mr-2"></i>
                    Buat UMK
                </a>
            @else
                <a href="{{ route('member.kkpr.create') }}" class="bg-[#185B3C] text-white px-6 py-2.5 rounded-lg font-medium hover:bg-[#0F3D26] transition-colors shadow-sm">
                    <i class="fas fa-plus mr-2"></i>
                    Buat KKPR
                </a>
                <a href="{{ route('member.kkprnon.create') }}" class="bg-white text-gray-700 px-6 py-2.5 rounded-lg font-medium border border-gray-200 hover:bg-gray-50 transition-colors shadow-sm">
                    <i class="fas fa-building mr-2"></i>
                    Buat UMK
                </a>
            @endif
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total KKPR -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <div class="flex items-center space-x-2 mb-2">
                        <div class="w-8 h-8 bg-[#185B3C]/10 rounded-lg flex items-center justify-center">
                            <i class="fas fa-file-alt text-[#185B3C] text-sm"></i>
                        </div>
                        <span class="text-xs font-medium text-gray-500">Total KKPR (Non-UMK)</span>
                    </div>
                    <p class="text-3xl font-bold text-gray-900">{{ $kkprTotal ?? 0 }}</p>
                    <p class="text-xs text-[#185B3C] mt-1 flex items-center">
                        <i class="fas fa-chart-line mr-1"></i>
                        Kesesuaian Kegiatan Pemanfaatan Ruang
                    </p>
                </div>
                <div class="w-12 h-12 bg-[#185B3C] rounded-full flex items-center justify-center">
                    <span class="text-white font-bold text-sm">{{ $kkprTotal ?? 0 }}</span>
                </div>
            </div>
        </div>

        <!-- Total UMK -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <div class="flex items-center space-x-2 mb-2">
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-building text-blue-600 text-sm"></i>
                        </div>
                        <span class="text-xs font-medium text-gray-500">Total UMK (Usaha Mikro Kecil)</span>
                    </div>
                    <p class="text-3xl font-bold text-gray-900">{{ $umkTotal ?? 0 }}</p>
                    <p class="text-xs text-blue-600 mt-1 flex items-center">
                        <i class="fas fa-users mr-1"></i>
                        Usaha Mikro Kecil
                    </p>
                </div>
                <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center">
                    <span class="text-white font-bold text-sm">{{ $umkTotal ?? 0 }}</span>
                </div>
            </div>
        </div>

        <!-- KKPR Selesai -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <div class="flex items-center space-x-2 mb-2">
                        <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-check-circle text-green-600 text-sm"></i>
                        </div>
                        <span class="text-xs font-medium text-gray-500">KKPR Selesai (Non-UMK)</span>
                    </div>
                    <p class="text-3xl font-bold text-gray-900">{{ $kkprSelesai ?? 0 }}</p>
                    <p class="text-xs text-green-600 mt-1 flex items-center">
                        <i class="fas fa-percentage mr-1"></i>
                        {{ $kkprTotal > 0 ? round(($kkprSelesai / $kkprTotal) * 100, 1) : 0 }}% dari total
                    </p>
                </div>
                <div class="w-12 h-12 bg-green-600 rounded-full flex items-center justify-center">
                    <span class="text-white font-bold text-sm">{{ $kkprSelesai ?? 0 }}</span>
                </div>
            </div>
        </div>

        <!-- UMK Selesai -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <div class="flex items-center space-x-2 mb-2">
                        <div class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-check-double text-orange-600 text-sm"></i>
                        </div>
                        <span class="text-xs font-medium text-gray-500">UMK Selesai (Usaha Mikro Kecil)</span>
                    </div>
                    <p class="text-3xl font-bold text-gray-900">{{ $umkSelesai ?? 0 }}</p>
                    <p class="text-xs text-orange-600 mt-1 flex items-center">
                        <i class="fas fa-percentage mr-1"></i>
                        {{ $umkTotal > 0 ? round(($umkSelesai / $umkTotal) * 100, 1) : 0 }}% dari total
                    </p>
                </div>
                <div class="w-12 h-12 bg-orange-600 rounded-full flex items-center justify-center">
                    <span class="text-white font-bold text-sm">{{ $umkSelesai ?? 0 }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts and Analytics Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Status Distribution Chart -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold text-gray-900">Distribusi Status KKPR & UMK</h3>
                    <a href="{{ route('admin.kkpr.index') }}" class="text-sm text-[#185B3C] hover:text-[#0F3D26] font-medium">Lihat Detail</a>
                </div>
                <div class="h-64 flex items-end space-x-2">
                    <!-- KKPR Status bars -->
                    <div class="flex-1 bg-gray-200 h-16 rounded-t-lg" title="Pending: {{ $kkprStatus['pending'] ?? 0 }}"></div>
                    <div class="flex-1 bg-[#185B3C] h-{{ min(48, max(8, ($kkprStatus['diterima'] ?? 0) * 2)) }} rounded-t-lg" title="Diterima: {{ $kkprStatus['diterima'] ?? 0 }}"></div>
                    <div class="flex-1 bg-[#22C55E] h-{{ min(44, max(8, ($kkprStatus['survey'] ?? 0) * 2)) }} rounded-t-lg" title="Survey: {{ $kkprStatus['survey'] ?? 0 }}"></div>
                    <div class="flex-1 bg-[#185B3C] h-{{ min(52, max(8, ($kkprStatus['analisa'] ?? 0) * 2)) }} rounded-t-lg" title="Analisa: {{ $kkprStatus['analisa'] ?? 0 }}"></div>
                    <div class="flex-1 bg-[#F59E0B] h-{{ min(20, max(8, ($kkprStatus['rekomendasi'] ?? 0) * 2)) }} rounded-t-lg" title="Rekomendasi: {{ $kkprStatus['rekomendasi'] ?? 0 }}"></div>
                    <div class="flex-1 bg-[#8B5CF6] h-{{ min(24, max(8, ($kkprStatus['persetujuan'] ?? 0) * 2)) }} rounded-t-lg" title="Persetujuan: {{ $kkprStatus['persetujuan'] ?? 0 }}"></div>
                    <div class="flex-1 bg-[#EF4444] h-{{ min(28, max(8, ($kkprStatus['terbit'] ?? 0) * 2)) }} rounded-t-lg" title="Terbit: {{ $kkprStatus['terbit'] ?? 0 }}"></div>
                </div>
                <div class="mt-4 flex items-center justify-between text-sm text-gray-600">
                    <span>Pending</span>
                    <span>Diterima</span>
                    <span>Survey</span>
                    <span>Analisa</span>
                    <span>Rekomendasi</span>
                    <span>Persetujuan</span>
                    <span>Terbit</span>
                </div>
            </div>
        </div>

        <!-- Progress & Summary -->
        <div class="space-y-6">
            <!-- Completion Progress -->
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Progress Penyelesaian</h3>
                <div class="flex items-center justify-center">
                    <div class="relative w-32 h-32">
                        <svg class="w-32 h-32" viewBox="0 0 36 36">
                            <path class="text-gray-200" stroke="currentColor" stroke-width="3" fill="none" d="M18 2.0845a 15.9155 15.9155 0 0 1 0 31.831a 15.9155 15.9155 0 0 1 0 -31.831"></path>
                            <path class="text-[#185B3C] progress-ring" stroke="currentColor" stroke-width="3" fill="none" stroke-dasharray="{{ $kkprTotal > 0 ? round(($kkprSelesai / $kkprTotal) * 100, 1) : 0 }}, 100" d="M18 2.0845a 15.9155 15.9155 0 0 1 0 31.831a 15.9155 15.9155 0 0 1 0 -31.831"></path>
                        </svg>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <span class="text-2xl font-bold text-gray-900">{{ $kkprTotal > 0 ? round(($kkprSelesai / $kkprTotal) * 100, 1) : 0 }}%</span>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <p class="text-sm text-gray-600">KKPR Selesai</p>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="bg-gradient-to-br from-[#185B3C] to-[#0F3D26] rounded-xl p-6 text-white">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold">Statistik Cepat</h3>
                    <i class="fas fa-chart-bar"></i>
                </div>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-sm">KKPR Berjalan</span>
                        <span class="font-bold">{{ $kkprBerjalan ?? 0 }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm">UMK Berjalan</span>
                        <span class="font-bold">{{ $umkBerjalan ?? 0 }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm">Total Pending</span>
                        <span class="font-bold">{{ ($kkprPending ?? 0) + ($umkPending ?? 0) }}</span>
                    </div>
                    @if(isset($userTotal))
                    <div class="flex justify-between items-center">
                        <span class="text-sm">Total User</span>
                        <span class="font-bold">{{ $userTotal }}</span>
                    </div>
                    @endif
                    @if(isset($beritaTotal))
                    <div class="flex justify-between items-center">
                        <span class="text-sm">Berita Aktif</span>
                        <span class="font-bold">{{ $beritaAktif ?? 0 }}</span>
                    </div>
                    @endif
                    @if(isset($informasiTotal))
                    <div class="flex justify-between items-center">
                        <span class="text-sm">Informasi Aktif</span>
                        <span class="font-bold">{{ $informasiAktif ?? 0 }}</span>
                    </div>
                    @endif
                    @if(isset($userProfile))
                    <div class="flex justify-between items-center">
                        <span class="text-sm">Total Pengajuan</span>
                        <span class="font-bold">{{ $userProfile['total_submissions'] ?? 0 }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm">Selesai</span>
                        <span class="font-bold">{{ $userProfile['completed_submissions'] ?? 0 }}</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Submissions & Status Overview -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent KKPR Submissions -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
            <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold text-gray-900">Pengajuan KKPR Terbaru (Non-UMK)</h3>
                <a href="{{ auth()->user()->hasRole('admin') ? route('admin.kkpr.index') : route('member.kkpr.index') }}" class="text-sm text-[#185B3C] hover:text-[#0F3D26] font-medium">Lihat Semua</a>
            </div>
            <div class="space-y-4">
                @forelse($recentKkpr ?? [] as $kkpr)
                <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                    <div class="w-10 h-10 bg-[#185B3C] rounded-full flex items-center justify-center">
                        <i class="fas fa-file-alt text-white text-sm"></i>
                    </div>
                    <div class="flex-1">
                        <p class="font-medium text-gray-900">{{ $kkpr->usaha ?? 'Nama Usaha' }}</p>
                        <p class="text-sm text-gray-500">{{ $kkpr->user->name ?? 'User' }} • {{ $kkpr->created_at->format('d M Y') }}</p>
                        <span class="inline-block px-2 py-1 text-xs bg-[#185B3C]/10 text-[#185B3C] rounded-full mt-1">
                            {{ $kkpr->jenis == 'non_umk' ? 'KKPR' : 'UMK' }}
                        </span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="px-2 py-1 text-xs rounded-full 
                            @if($kkpr->proses == 0) bg-gray-100 text-gray-600
                            @elseif($kkpr->proses == 1) bg-blue-100 text-blue-600
                            @elseif($kkpr->proses == 2) bg-yellow-100 text-yellow-600
                            @elseif($kkpr->proses == 3) bg-orange-100 text-orange-600
                            @elseif($kkpr->proses == 4) bg-purple-100 text-purple-600
                            @elseif($kkpr->proses == 5) bg-indigo-100 text-indigo-600
                            @elseif($kkpr->proses == 6) bg-red-100 text-red-600
                            @else bg-green-100 text-green-600
                            @endif">
                            @if($kkpr->proses == 0) Pending
                            @elseif($kkpr->proses == 1) Diterima
                            @elseif($kkpr->proses == 2) Survey
                            @elseif($kkpr->proses == 3) Analisa
                            @elseif($kkpr->proses == 4) Rekomendasi
                            @elseif($kkpr->proses == 5) Persetujuan
                            @elseif($kkpr->proses == 6) Terbit
                            @else Selesai
                            @endif
                        </span>
                    </div>
                </div>
                @empty
                <div class="text-center py-8 text-gray-500">
                    <i class="fas fa-file-alt text-4xl mb-2"></i>
                    <p>Belum ada pengajuan KKPR</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Recent UMK Submissions -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
            <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold text-gray-900">Pengajuan UMK Terbaru (Usaha Mikro Kecil)</h3>
                <a href="{{ auth()->user()->hasRole('admin') ? route('admin.kkprnon.index') : route('member.kkprnon.index') }}" class="text-sm text-[#185B3C] hover:text-[#0F3D26] font-medium">Lihat Semua</a>
            </div>
            <div class="space-y-4">
                @forelse($recentUmk ?? [] as $umk)
                <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                    <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-building text-white text-sm"></i>
                    </div>
                    <div class="flex-1">
                        <p class="font-medium text-gray-900">{{ $umk->usaha ?? 'Nama Usaha' }}</p>
                        <p class="text-sm text-gray-500">{{ $umk->user->name ?? 'User' }} • {{ $umk->created_at->format('d M Y') }}</p>
                        <span class="inline-block px-2 py-1 text-xs bg-blue-100 text-blue-600 rounded-full mt-1">
                            {{ $umk->jenis == 'non_umk' ? 'KKPR' : 'UMK' }}
                        </span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="px-2 py-1 text-xs rounded-full 
                            @if($umk->proses == 0) bg-gray-100 text-gray-600
                            @elseif($umk->proses == 1) bg-blue-100 text-blue-600
                            @elseif($umk->proses == 2) bg-yellow-100 text-yellow-600
                            @elseif($umk->proses == 3) bg-orange-100 text-orange-600
                            @elseif($umk->proses == 4) bg-purple-100 text-purple-600
                            @elseif($umk->proses == 5) bg-indigo-100 text-indigo-600
                            @elseif($umk->proses == 6) bg-red-100 text-red-600
                            @else bg-green-100 text-green-600
                            @endif">
                            @if($umk->proses == 0) Pending
                            @elseif($umk->proses == 1) Diterima
                            @elseif($umk->proses == 2) Survey
                            @elseif($umk->proses == 3) Analisa
                            @elseif($umk->proses == 4) Rekomendasi
                            @elseif($umk->proses == 5) Persetujuan
                            @elseif($umk->proses == 6) Terbit
                            @else Selesai
                            @endif
                        </span>
                    </div>
                </div>
                @empty
                <div class="text-center py-8 text-gray-500">
                    <i class="fas fa-building text-4xl mb-2"></i>
                    <p>Belum ada pengajuan UMK</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Status Overview -->
    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg font-semibold text-gray-900">Ringkasan Status</h3>
            <span class="text-sm text-gray-500">Data real-time</span>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- KKPR Status -->
            <div class="bg-gradient-to-br from-[#185B3C] to-[#0F3D26] rounded-lg p-4 text-white">
                <div class="flex items-center justify-between mb-2">
                    <h4 class="font-semibold">KKPR (Non-UMK)</h4>
                    <i class="fas fa-file-alt"></i>
                </div>
                <div class="space-y-1 text-sm">
                    <div class="flex justify-between">
                        <span>Pending:</span>
                        <span class="font-bold">{{ $kkprStatus['pending'] ?? 0 }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Berjalan:</span>
                        <span class="font-bold">{{ ($kkprStatus['diterima'] ?? 0) + ($kkprStatus['survey'] ?? 0) + ($kkprStatus['analisa'] ?? 0) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Selesai:</span>
                        <span class="font-bold">{{ $kkprStatus['selesai'] ?? 0 }}</span>
                    </div>
                </div>
            </div>

            <!-- UMK Status -->
            <div class="bg-gradient-to-br from-blue-600 to-blue-800 rounded-lg p-4 text-white">
                <div class="flex items-center justify-between mb-2">
                    <h4 class="font-semibold">UMK</h4>
                    <i class="fas fa-building"></i>
                </div>
                <div class="space-y-1 text-sm">
                    <div class="flex justify-between">
                        <span>Pending:</span>
                        <span class="font-bold">{{ $umkStatus['pending'] ?? 0 }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Berjalan:</span>
                        <span class="font-bold">{{ ($umkStatus['diterima'] ?? 0) + ($umkStatus['survey'] ?? 0) + ($umkStatus['analisa'] ?? 0) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Selesai:</span>
                        <span class="font-bold">{{ $umkStatus['selesai'] ?? 0 }}</span>
                    </div>
                </div>
            </div>

            <!-- Progress Overview -->
            <div class="bg-gradient-to-br from-green-600 to-green-800 rounded-lg p-4 text-white">
                <div class="flex items-center justify-between mb-2">
                    <h4 class="font-semibold">Progress</h4>
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="space-y-1 text-sm">
                    <div class="flex justify-between">
                        <span>Total:</span>
                        <span class="font-bold">{{ ($kkprTotal ?? 0) + ($umkTotal ?? 0) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Selesai:</span>
                        <span class="font-bold">{{ ($kkprSelesai ?? 0) + ($umkSelesai ?? 0) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Rate:</span>
                        <span class="font-bold">
                            @php
                                $total = ($kkprTotal ?? 0) + ($umkTotal ?? 0);
                                $selesai = ($kkprSelesai ?? 0) + ($umkSelesai ?? 0);
                                $rate = $total > 0 ? round(($selesai / $total) * 100, 1) : 0;
                            @endphp
                            {{ $rate }}%
                        </span>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-gradient-to-br from-purple-600 to-purple-800 rounded-lg p-4 text-white">
                <div class="flex items-center justify-between mb-2">
                    <h4 class="font-semibold">Aksi Cepat</h4>
                    <i class="fas fa-bolt"></i>
                </div>
                <div class="space-y-2">
                    @if(auth()->user()->hasRole('admin'))
                        <a href="{{ route('admin.kkpr.create') }}" class="block w-full bg-white/20 hover:bg-white/30 rounded px-3 py-1 text-sm text-center transition-colors">
                            Buat KKPR
                        </a>
                        <a href="{{ route('admin.kkprnon.create') }}" class="block w-full bg-white/20 hover:bg-white/30 rounded px-3 py-1 text-sm text-center transition-colors">
                            Buat UMK
                        </a>
                    @else
                        <a href="{{ route('member.kkpr.create') }}" class="block w-full bg-white/20 hover:bg-white/30 rounded px-3 py-1 text-sm text-center transition-colors">
                            Buat KKPR
                        </a>
                        <a href="{{ route('member.kkprnon.create') }}" class="block w-full bg-white/20 hover:bg-white/30 rounded px-3 py-1 text-sm text-center transition-colors">
                            Buat UMK
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .progress-ring {
        transition: stroke-dashoffset 0.35s;
        transform: rotate(-90deg);
        transform-origin: 50% 50%;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add some animation to cards on load
        const cards = document.querySelectorAll('.bg-white, .bg-gradient-to-br');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            setTimeout(() => {
                card.style.transition = 'all 0.5s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });

        // Add hover effects to status cards
        const statusCards = document.querySelectorAll('.bg-gradient-to-br');
        statusCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
                this.style.transition = 'transform 0.2s ease';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });

        // Add click effects to quick action buttons
        const quickActions = document.querySelectorAll('.bg-white\\/20');
        quickActions.forEach(button => {
            button.addEventListener('click', function() {
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = 'scale(1)';
                }, 150);
            });
        });
    });
</script>
@endsection