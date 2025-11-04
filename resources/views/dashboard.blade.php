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
                @canany(['Verifikator', 'Admin Sipo'])
                <a href="{{ route('admin.kkpr.create') }}" class="bg-[#185B3C] text-white px-6 py-2.5 rounded-lg font-medium hover:bg-[#0F3D26] transition-colors shadow-sm">
                    <i class="fas fa-plus mr-2"></i>
                    Buat KKPR
                </a>
                <a href="{{ route('admin.kkprnon.create') }}" class="bg-white text-gray-700 px-6 py-2.5 rounded-lg font-medium border border-gray-200 hover:bg-gray-50 transition-colors shadow-sm">
                    <i class="fas fa-building mr-2"></i>
                    Buat UMK
                </a>
                @endcanany
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
    <div style="background-color: white; border-radius: 12px; padding: 24px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1); border: 1px solid #f3f4f6;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
            <h3 style="font-size: 18px; font-weight: 600; color: #111827;">Ringkasan Status</h3>
            <span style="font-size: 14px; color: #6b7280;">Data real-time</span>
        </div>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 16px;">
            <!-- KKPR Status -->
            <div style="background: linear-gradient(135deg, #185B3C, #0F3D26); border-radius: 8px; padding: 16px; color: white;">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 8px;">
                    <h4 style="font-weight: 600;">KKPR (Non-UMK)</h4>
                    <i class="fas fa-file-alt"></i>
                </div>
                <div style="display: flex; flex-direction: column; gap: 4px; font-size: 14px;">
                    <div style="display: flex; justify-content: space-between;">
                        <span>Pending:</span>
                        <span style="font-weight: bold;">{{ $kkprStatus['pending'] ?? 0 }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <span>Berjalan:</span>
                        <span style="font-weight: bold;">{{ ($kkprStatus['diterima'] ?? 0) + ($kkprStatus['survey'] ?? 0) + ($kkprStatus['analisa'] ?? 0) }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <span>Selesai:</span>
                        <span style="font-weight: bold;">{{ $kkprStatus['selesai'] ?? 0 }}</span>
                    </div>
                </div>
            </div>

            <!-- UMK Status -->
            <div style="background: linear-gradient(135deg, #2563eb, #1e40af); border-radius: 8px; padding: 16px; color: white;">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 8px;">
                    <h4 style="font-weight: 600;">UMK</h4>
                    <i class="fas fa-building"></i>
                </div>
                <div style="display: flex; flex-direction: column; gap: 4px; font-size: 14px;">
                    <div style="display: flex; justify-content: space-between;">
                        <span>Pending:</span>
                        <span style="font-weight: bold;">{{ $umkStatus['pending'] ?? 0 }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <span>Berjalan:</span>
                        <span style="font-weight: bold;">{{ ($umkStatus['diterima'] ?? 0) + ($umkStatus['survey'] ?? 0) + ($umkStatus['analisa'] ?? 0) }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <span>Selesai:</span>
                        <span style="font-weight: bold;">{{ $umkStatus['selesai'] ?? 0 }}</span>
                    </div>
                </div>
            </div>

            <!-- Progress Overview -->
            <div style="background: linear-gradient(135deg, #16a34a, #15803d); border-radius: 8px; padding: 16px; color: white;">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 8px;">
                    <h4 style="font-weight: 600;">Progress</h4>
                    <i class="fas fa-chart-line"></i>
                </div>
                <div style="display: flex; flex-direction: column; gap: 4px; font-size: 14px;">
                    <div style="display: flex; justify-content: space-between;">
                        <span>Total:</span>
                        <span style="font-weight: bold;">{{ ($kkprTotal ?? 0) + ($umkTotal ?? 0) }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <span>Selesai:</span>
                        <span style="font-weight: bold;">{{ ($kkprSelesai ?? 0) + ($umkSelesai ?? 0) }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <span>Rate:</span>
                        <span style="font-weight: bold;">
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
            <div style="background: linear-gradient(135deg, #9333ea, #7c3aed); border-radius: 8px; padding: 16px; color: white;">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 8px;">
                    <h4 style="font-weight: 600;">Aksi Cepat</h4>
                    <i class="fas fa-bolt"></i>
                </div>
                <div style="display: flex; flex-direction: column; gap: 8px;">
                    @if(auth()->user()->hasRole('admin'))
                        @canany(['Verifikator', 'Admin Sipo'])
                        <a href="{{ route('admin.kkpr.create') }}" style="display: block; width: 100%; background-color: rgba(255, 255, 255, 0.2); border-radius: 4px; padding: 8px 12px; font-size: 14px; text-align: center; color: white; text-decoration: none; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='rgba(255, 255, 255, 0.3)'" onmouseout="this.style.backgroundColor='rgba(255, 255, 255, 0.2)'">
                            Buat KKPR
                        </a>
                        <a href="{{ route('admin.kkprnon.create') }}" style="display: block; width: 100%; background-color: rgba(255, 255, 255, 0.2); border-radius: 4px; padding: 8px 12px; font-size: 14px; text-align: center; color: white; text-decoration: none; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='rgba(255, 255, 255, 0.3)'" onmouseout="this.style.backgroundColor='rgba(255, 255, 255, 0.2)'">
                            Buat UMK
                        </a>
                        @endcanany
                    @else
                        <a href="{{ route('member.kkpr.create') }}" style="display: block; width: 100%; background-color: rgba(255, 255, 255, 0.2); border-radius: 4px; padding: 8px 12px; font-size: 14px; text-align: center; color: white; text-decoration: none; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='rgba(255, 255, 255, 0.3)'" onmouseout="this.style.backgroundColor='rgba(255, 255, 255, 0.2)'">
                            Buat KKPR
                        </a>
                        <a href="{{ route('member.kkprnon.create') }}" style="display: block; width: 100%; background-color: rgba(255, 255, 255, 0.2); border-radius: 4px; padding: 8px 12px; font-size: 14px; text-align: center; color: white; text-decoration: none; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='rgba(255, 255, 255, 0.3)'" onmouseout="this.style.backgroundColor='rgba(255, 255, 255, 0.2)'">
                            Buat UMK
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Peta Persebaran KKPR & UMK (Mini) -->
    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Peta Persebaran KKPR & UMK</h3>
            <div class="flex items-center space-x-3">
                <div class="text-sm text-gray-500">Sumber: File GeoJSON ter-summary</div>
                <button id="refreshDataMapBtn" class="bg-[#185B3C] text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-[#0F3D26] transition-colors shadow-sm flex items-center space-x-2">
                    <i class="fas fa-sync-alt" id="refreshIcon"></i>
                    <span>Refresh Data Map</span>
                </button>
            </div>
        </div>
        <div class="relative">
            <div id="dashboard-map" style="width: 100%; height: 55vh; border-radius: 12px; overflow: hidden; background: #f9fafb; position: relative; z-index: 1;"></div>
            <div id="dashboard-layers-control" class="absolute top-3 right-3 bg-white/95 backdrop-blur-sm p-3 rounded-lg shadow border border-gray-200 min-w-[220px] z-[1000]">
                <div class="flex items-center justify-between mb-2">
                    <div class="font-semibold text-gray-900 text-sm">Layer Control</div>
                    <div class="flex gap-1">
                        <button id="dashFitToData" class="text-xs px-2 py-1 border rounded text-gray-600 hover:bg-gray-50" title="Fit to Data">🎯</button>
                        <button id="dashResetView" class="text-xs px-2 py-1 border rounded text-gray-600 hover:bg-gray-50" title="Reset to Indonesia">🇮🇩</button>
                        <button id="dashResetOpacity" class="text-xs px-2 py-1 border rounded text-gray-600 hover:bg-gray-50">Reset</button>
                    </div>
                </div>
                <div class="space-y-3">
                    <div>
                        <label class="inline-flex items-center gap-2 text-sm font-medium text-gray-800">
                            <input id="dashKkprCheck" type="checkbox" class="form-check-input"> KKPR
                        </label>
                        <div class="mt-2">
                            <label class="text-xs text-gray-600">Opacity: <span id="dashKkprOpacityLbl">100%</span></label>
                            <input id="dashKkprOpacity" type="range" min="0" max="100" value="100" class="w-full">
                        </div>
                    </div>
                    <div>
                        <label class="inline-flex items-center gap-2 text-sm font-medium text-gray-800">
                            <input id="dashUmkCheck" type="checkbox" class="form-check-input"> UMK
                        </label>
                        <div class="mt-2">
                            <label class="text-xs text-gray-600">Opacity: <span id="dashUmkOpacityLbl">100%</span></label>
                            <input id="dashUmkOpacity" type="range" min="0" max="100" value="100" class="w-full">
                        </div>
                    </div>
                </div>
                <hr class="my-3">
                <div class="text-sm font-semibold text-gray-900 mb-2">Legenda</div>
                <div class="space-y-2">
                    <div class="flex items-center justify-between text-sm text-gray-700">
                        <div class="flex items-center gap-2">
                            <span class="w-4 h-4 rounded-sm" style="background:#185B3C"></span> KKPR
                        </div>
                        <span id="kkprCount" class="text-xs text-gray-500">0 features</span>
                    </div>
                    <div class="flex items-center justify-between text-sm text-gray-700">
                        <div class="flex items-center gap-2">
                            <span class="w-4 h-4 rounded-sm" style="background:#2563eb"></span> UMK
                        </div>
                        <span id="umkCount" class="text-xs text-gray-500">0 features</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Leaflet CSS -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
        <!-- Leaflet JS -->
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <script>
            console.log('🚀 Starting dashboard map initialization with Leaflet...');
            console.log('✅ Leaflet loaded:', typeof L !== 'undefined');
            console.log('✅ Map container exists:', document.getElementById('dashboard-map') !== null);
            
            // Initialize Leaflet map centered on Indonesia
            var dashMap = L.map('dashboard-map').setView([-6.2088, 106.8456], 5); // Jakarta, Indonesia
            
            // Add OpenStreetMap tiles
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(dashMap);
            
            console.log('✅ Leaflet map initialized successfully');
            
            // Initialize layer groups for KKPR and UMK
            var kkprLayerGroup = L.layerGroup().addTo(dashMap);
            var umkLayerGroup = L.layerGroup().addTo(dashMap);
            
            // Set initial visibility to false
            kkprLayerGroup.removeFrom(dashMap);
            umkLayerGroup.removeFrom(dashMap);
            
            console.log('✅ Layer groups created');
            
            // Load GeoJSON data function
            function loadGeoJSONData() {
                console.log('📥 Loading GeoJSON data...');
                
                // Load KKPR
                var kkprUrl = '{{ asset('mapdata/newgeo/kkpr.geojson') }}?t=' + Date.now();
                console.log('🔗 KKPR URL:', kkprUrl);
                
                fetch(kkprUrl)
                    .then(response => {
                        console.log('📡 KKPR response status:', response.status);
                        if (!response.ok) throw new Error('KKPR file not found');
                        return response.json();
                    })
                    .then(geojson => {
                        console.log('📄 KKPR GeoJSON received:', geojson);
                        
                        // Clear existing features
                        kkprLayerGroup.clearLayers();
                        
                        // Add GeoJSON to map
                        L.geoJSON(geojson, {
                            style: function(feature) {
                                return {
                                    color: '#185B3C',
                                    weight: 2,
                                    opacity: 1,
                                    fillColor: '#185B3C',
                                    fillOpacity: 0.35
                                };
                            },
                            onEachFeature: function(feature, layer) {
                                // Add popup with feature info
                                if (feature.properties) {
                                    var popupContent = '<div class="p-2">';
                                    popupContent += '<h6 class="font-semibold text-green-600">KKPR</h6>';
                                    popupContent += '<p class="text-sm">ID Folder: ' + (feature.properties.idFolder || 'N/A') + '</p>';
                                    popupContent += '<p class="text-sm">Jenis: ' + (feature.properties.jenis || 'N/A') + '</p>';
                                    popupContent += '</div>';
                                    layer.bindPopup(popupContent);
                                }
                            }
                        }).addTo(kkprLayerGroup);
                        
                        console.log('✅ KKPR loaded:', geojson.features.length, 'features');
                        document.getElementById('kkprCount').textContent = geojson.features.length + ' features';
                        
                        // Auto fit to data if available
                        if (geojson.features.length > 0) {
                            setTimeout(fitToAllData, 500);
                        }
                    })
                    .catch(err => {
                        console.warn('⚠️ KKPR file not available:', err.message);
                        document.getElementById('kkprCount').textContent = '0 features';
                    });
                
                // Load UMK
                var umkUrl = '{{ asset('mapdata/newgeo/umk.geojson') }}?t=' + Date.now();
                console.log('🔗 UMK URL:', umkUrl);
                
                fetch(umkUrl)
                    .then(response => {
                        console.log('📡 UMK response status:', response.status);
                        if (!response.ok) throw new Error('UMK file not found');
                        return response.json();
                    })
                    .then(geojson => {
                        console.log('📄 UMK GeoJSON received:', geojson);
                        
                        // Clear existing features
                        umkLayerGroup.clearLayers();
                        
                        // Add GeoJSON to map
                        L.geoJSON(geojson, {
                            style: function(feature) {
                                return {
                                    color: '#2563eb',
                                    weight: 2,
                                    opacity: 1,
                                    fillColor: '#2563eb',
                                    fillOpacity: 0.30
                                };
                            },
                            onEachFeature: function(feature, layer) {
                                // Add popup with feature info
                                if (feature.properties) {
                                    var popupContent = '<div class="p-2">';
                                    popupContent += '<h6 class="font-semibold text-blue-600">UMK</h6>';
                                    popupContent += '<p class="text-sm">ID Folder: ' + (feature.properties.idFolder || 'N/A') + '</p>';
                                    popupContent += '<p class="text-sm">Jenis: ' + (feature.properties.jenis || 'N/A') + '</p>';
                                    popupContent += '</div>';
                                    layer.bindPopup(popupContent);
                                }
                            }
                        }).addTo(umkLayerGroup);
                        
                        console.log('✅ UMK loaded:', geojson.features.length, 'features');
                        document.getElementById('umkCount').textContent = geojson.features.length + ' features';
                    })
                    .catch(err => {
                        console.warn('⚠️ UMK file not available:', err.message);
                        document.getElementById('umkCount').textContent = '0 features';
                    });
            }
            
            // Fit to all data function
            function fitToAllData() {
                console.log('🎯 Fitting map to all data...');
                var bounds = L.latLngBounds();
                var hasData = false;
                
                // Check KKPR bounds
                kkprLayerGroup.eachLayer(function(layer) {
                    if (layer.getBounds) {
                        bounds.extend(layer.getBounds());
                        hasData = true;
                    }
                });
                
                // Check UMK bounds
                umkLayerGroup.eachLayer(function(layer) {
                    if (layer.getBounds) {
                        bounds.extend(layer.getBounds());
                        hasData = true;
                    }
                });
                
                if (hasData) {
                    dashMap.fitBounds(bounds, {
                        padding: [20, 20],
                        maxZoom: 15
                    });
                    console.log('🎯 Map fitted to data');
                } else {
                    console.log('⚠️ No data to fit to');
                }
            }
            
            // Event Listeners using native JavaScript
            document.addEventListener('DOMContentLoaded', function() {
                console.log('📋 DOM ready - setting up event listeners');
                
                // KKPR checkbox
                var kkprCheck = document.getElementById('dashKkprCheck');
                if (kkprCheck) {
                    kkprCheck.addEventListener('change', function() {
                        if (this.checked) {
                            dashMap.addLayer(kkprLayerGroup);
                            console.log('🔘 KKPR layer: ON');
                            
                            // Auto zoom to KKPR data
                            if (kkprLayerGroup.getLayers().length > 0) {
                                setTimeout(function() {
                                    var bounds = L.latLngBounds();
                                    kkprLayerGroup.eachLayer(function(layer) {
                                        if (layer.getBounds) {
                                            bounds.extend(layer.getBounds());
                                        }
                                    });
                                    dashMap.fitBounds(bounds, {
                                        padding: [20, 20],
                                        maxZoom: 15
                                    });
                                    console.log('🎯 Auto-zoomed to KKPR data');
                                }, 100);
                            }
                        } else {
                            dashMap.removeLayer(kkprLayerGroup);
                            console.log('🔘 KKPR layer: OFF');
                        }
                    });
                }
                
                // UMK checkbox
                var umkCheck = document.getElementById('dashUmkCheck');
                if (umkCheck) {
                    umkCheck.addEventListener('change', function() {
                        if (this.checked) {
                            dashMap.addLayer(umkLayerGroup);
                            console.log('🔘 UMK layer: ON');
                            
                            // Auto zoom to UMK data
                            if (umkLayerGroup.getLayers().length > 0) {
                                setTimeout(function() {
                                    var bounds = L.latLngBounds();
                                    umkLayerGroup.eachLayer(function(layer) {
                                        if (layer.getBounds) {
                                            bounds.extend(layer.getBounds());
                                        }
                                    });
                                    dashMap.fitBounds(bounds, {
                                        padding: [20, 20],
                                        maxZoom: 15
                                    });
                                    console.log('🎯 Auto-zoomed to UMK data');
                                }, 100);
                            }
                        } else {
                            dashMap.removeLayer(umkLayerGroup);
                            console.log('🔘 UMK layer: OFF');
                        }
                    });
                }
                
                // Opacity controls
                var kkprOpacity = document.getElementById('dashKkprOpacity');
                if (kkprOpacity) {
                    kkprOpacity.addEventListener('input', function() {
                        var value = parseFloat(this.value) / 100;
                        kkprLayerGroup.eachLayer(function(layer) {
                            if (layer.setStyle) {
                                layer.setStyle({
                                    fillOpacity: value * 0.35,
                                    opacity: value
                                });
                            }
                        });
                        var label = document.getElementById('dashKkprOpacityLbl');
                        if (label) label.textContent = Math.round(value * 100) + '%';
                    });
                }
                
                var umkOpacity = document.getElementById('dashUmkOpacity');
                if (umkOpacity) {
                    umkOpacity.addEventListener('input', function() {
                        var value = parseFloat(this.value) / 100;
                        umkLayerGroup.eachLayer(function(layer) {
                            if (layer.setStyle) {
                                layer.setStyle({
                                    fillOpacity: value * 0.30,
                                    opacity: value
                                });
                            }
                        });
                        var label = document.getElementById('dashUmkOpacityLbl');
                        if (label) label.textContent = Math.round(value * 100) + '%';
                    });
                }
                
                // Fit to data button
                var fitToDataBtn = document.getElementById('dashFitToData');
                if (fitToDataBtn) {
                    fitToDataBtn.addEventListener('click', function() {
                        console.log('🎯 Fit to data button clicked');
                        fitToAllData();
                    });
                }
                
                // Reset view to Indonesia button
                var resetViewBtn = document.getElementById('dashResetView');
                if (resetViewBtn) {
                    resetViewBtn.addEventListener('click', function() {
                        console.log('🇮🇩 Reset view to Indonesia clicked');
                        dashMap.setView([-6.2088, 106.8456], 5); // Jakarta, Indonesia
                    });
                }
                
                // Reset opacity button
                var resetOpacityBtn = document.getElementById('dashResetOpacity');
                if (resetOpacityBtn) {
                    resetOpacityBtn.addEventListener('click', function() {
                        console.log('🔄 Reset opacity button clicked');
                        var kkprOpacitySlider = document.getElementById('dashKkprOpacity');
                        var umkOpacitySlider = document.getElementById('dashUmkOpacity');
                        var kkprOpacityLabel = document.getElementById('dashKkprOpacityLbl');
                        var umkOpacityLabel = document.getElementById('dashUmkOpacityLbl');
                        
                        if (kkprOpacitySlider) kkprOpacitySlider.value = 100;
                        if (umkOpacitySlider) umkOpacitySlider.value = 100;
                        
                        // Reset KKPR opacity
                        kkprLayerGroup.eachLayer(function(layer) {
                            if (layer.setStyle) {
                                layer.setStyle({
                                    fillOpacity: 0.35,
                                    opacity: 1
                                });
                            }
                        });
                        
                        // Reset UMK opacity
                        umkLayerGroup.eachLayer(function(layer) {
                            if (layer.setStyle) {
                                layer.setStyle({
                                    fillOpacity: 0.30,
                                    opacity: 1
                                });
                            }
                        });
                        
                        if (kkprOpacityLabel) kkprOpacityLabel.textContent = '100%';
                        if (umkOpacityLabel) umkOpacityLabel.textContent = '100%';
                    });
                }
                
                // Refresh data button
                var refreshBtn = document.getElementById('refreshDataMapBtn');
                if (refreshBtn) {
                    refreshBtn.addEventListener('click', function() {
                        console.log('🔄 Refresh data button clicked');
                        var btn = this;
                        var originalHTML = btn.innerHTML;
                        
                        btn.disabled = true;
                        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i><span>Processing...</span>';
                        
                        fetch('{{ route('api.map.refresh') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                loadGeoJSONData();
                                btn.innerHTML = '<i class="fas fa-check"></i><span>Success!</span>';
                                btn.classList.add('bg-green-600');
                                
                                setTimeout(function() {
                                    btn.innerHTML = originalHTML;
                                    btn.classList.remove('bg-green-600');
                                    btn.disabled = false;
                                }, 2000);
                            }
                        })
                        .catch(error => {
                            console.error('❌ Refresh error:', error);
                            btn.innerHTML = '<i class="fas fa-times"></i><span>Error!</span>';
                            btn.classList.add('bg-red-600');
                            
                            setTimeout(function() {
                                btn.innerHTML = originalHTML;
                                btn.classList.remove('bg-red-600');
                                btn.disabled = false;
                            }, 2000);
                        });
                    });
                }
                
                // Load initial data
                console.log('📥 Loading initial GeoJSON data...');
                loadGeoJSONData();
            });
        </script>
        </div>
    </div>
</div>

<style>
    .progress-ring {
        transition: stroke-dashoffset 0.35s;
        transform: rotate(-90deg);
        transform-origin: 50% 50%;
    }
    
    /* Ensure layer control is always on top */
    #dashboard-layers-control {
        z-index: 1000 !important;
        position: absolute !important;
    }
    
    /* Ensure map container has lower z-index */
    #dashboard-map {
        z-index: 1 !important;
        position: relative !important;
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