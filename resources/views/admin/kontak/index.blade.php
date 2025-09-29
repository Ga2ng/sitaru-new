@extends('layouts.app')

@section('title', 'Kontak Management')
@section('subtitle', 'Kelola semua pesan kontak dan pengaduan')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">
    <!-- Hero Section with Gradient -->
    <div class="relative overflow-hidden bg-gradient-to-br from-[#185B3C] via-[#0F3D26] to-[#185B3C] rounded-xl p-6 text-white">
        <div class="absolute inset-0 bg-black/10"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold mb-1">Kontak Management</h1>
                    <p class="text-sm text-white/90 mb-4">Kelola semua pesan kontak dan pengaduan dengan mudah dan efisien</p>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                            <span class="text-xs">Sistem Aktif</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-envelope text-xs"></i>
                            <span class="text-xs">{{ $totalKontaks }} Total Pesan</span>
                        </div>
                    </div>
                </div>
                <div class="hidden lg:block">
                    <div class="w-20 h-20 bg-white/10 rounded-full flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-phone text-3xl text-white/80"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -translate-y-16 translate-x-16"></div>
        <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full translate-y-12 -translate-x-12"></div>
    </div>

    <!-- Stats Cards with Glassmorphism -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="group relative overflow-hidden bg-white/80 backdrop-blur-sm rounded-xl p-4 shadow-lg border border-white/20 hover:shadow-xl transition-all duration-300">
            <div class="absolute inset-0 bg-gradient-to-br from-[#185B3C]/5 to-transparent"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-[#185B3C] to-[#0F3D26] rounded-lg flex items-center justify-center shadow-md">
                        <i class="fas fa-envelope text-white text-sm"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-2xl font-bold text-[#185B3C]">{{ $totalKontaks }}</p>
                        <p class="text-xs text-gray-500">Total</p>
                    </div>
                </div>
                <h3 class="text-sm font-semibold text-gray-900 mb-1">Total Pesan</h3>
                <div class="flex items-center text-xs text-green-600">
                    <i class="fas fa-arrow-up mr-1"></i>
                    <span>+12% dari bulan lalu</span>
                </div>
            </div>
        </div>
        
        <div class="group relative overflow-hidden bg-white/80 backdrop-blur-sm rounded-xl p-4 shadow-lg border border-white/20 hover:shadow-xl transition-all duration-300">
            <div class="absolute inset-0 bg-gradient-to-br from-green-500/5 to-transparent"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-lg flex items-center justify-center shadow-md">
                        <i class="fas fa-calendar-day text-white text-sm"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-2xl font-bold text-green-600">{{ $todayKontaks }}</p>
                        <p class="text-xs text-gray-500">Hari Ini</p>
                    </div>
                </div>
                <h3 class="text-sm font-semibold text-gray-900 mb-1">Pesan Hari Ini</h3>
                <div class="flex items-center text-xs text-green-600">
                    <i class="fas fa-arrow-up mr-1"></i>
                    <span>+8% dari kemarin</span>
                </div>
            </div>
        </div>
        
        <div class="group relative overflow-hidden bg-white/80 backdrop-blur-sm rounded-xl p-4 shadow-lg border border-white/20 hover:shadow-xl transition-all duration-300">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-transparent"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center shadow-md">
                        <i class="fas fa-calendar-week text-white text-sm"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-2xl font-bold text-blue-600">{{ $thisWeekKontaks }}</p>
                        <p class="text-xs text-gray-500">Minggu Ini</p>
                    </div>
                </div>
                <h3 class="text-sm font-semibold text-gray-900 mb-1">Pesan Minggu Ini</h3>
                <div class="flex items-center text-xs text-blue-600">
                    <i class="fas fa-arrow-up mr-1"></i>
                    <span>+15% dari minggu lalu</span>
                </div>
            </div>
        </div>
        
        <div class="group relative overflow-hidden bg-white/80 backdrop-blur-sm rounded-xl p-4 shadow-lg border border-white/20 hover:shadow-xl transition-all duration-300">
            <div class="absolute inset-0 bg-gradient-to-br from-orange-500/5 to-transparent"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg flex items-center justify-center shadow-md">
                        <i class="fas fa-calendar-alt text-white text-sm"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-2xl font-bold text-orange-600">{{ $thisMonthKontaks }}</p>
                        <p class="text-xs text-gray-500">Bulan Ini</p>
                    </div>
                </div>
                <h3 class="text-sm font-semibold text-gray-900 mb-1">Pesan Bulan Ini</h3>
                <div class="flex items-center text-xs text-orange-600">
                    <i class="fas fa-arrow-up mr-1"></i>
                    <span>+22% dari bulan lalu</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Modern Data Table -->
    <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg border border-white/20 overflow-hidden">
        <!-- Table Header -->
        <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-gradient-to-br from-[#185B3C] to-[#0F3D26] rounded-lg flex items-center justify-center">
                        <i class="fas fa-phone text-white text-sm"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Daftar Pesan Kontak</h3>
                        <p class="text-sm text-gray-600">Kelola semua pesan kontak dan pengaduan</p>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="relative">
                        <input type="text" placeholder="Cari pesan..." class="pl-8 pr-3 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent bg-white/80">
                        <i class="fas fa-search absolute left-2.5 top-2.5 text-gray-400 text-xs"></i>
                    </div>
                    <button class="flex items-center px-3 py-2 text-sm text-gray-600 hover:text-gray-900 hover:bg-white/80 rounded-lg transition-colors">
                        <i class="fas fa-filter mr-1 text-xs"></i>
                        Filter
                    </button>
                    <button class="flex items-center px-3 py-2 text-sm text-gray-600 hover:text-gray-900 hover:bg-white/80 rounded-lg transition-colors">
                        <i class="fas fa-sort mr-1 text-xs"></i>
                        Sort
                    </button>
                </div>
            </div>
        </div>

        <!-- Table Content -->
        <div class="overflow-hidden">
            <!-- Table Headers -->
            <div class="px-6 py-3 bg-gray-50/80 border-b border-gray-100">
                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-1">
                        <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">NO</span>
                    </div>
                    <div class="col-span-2">
                        <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">TGL POSTING</span>
                    </div>
                    <div class="col-span-2">
                        <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">NAMA DEPAN</span>
                    </div>
                    <div class="col-span-2">
                        <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">NAMA BELAKANG</span>
                    </div>
                    <div class="col-span-2">
                        <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">EMAIL</span>
                    </div>
                    <div class="col-span-2">
                        <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">NO HP</span>
                    </div>
                    <div class="col-span-1">
                        <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">AKSI</span>
                    </div>
                </div>
            </div>

            <!-- Table Rows -->
            <div class="divide-y divide-gray-100">
                @forelse ($kontaks as $index => $kontak)
                <div class="px-6 py-4 hover:bg-gradient-to-r hover:from-[#185B3C]/5 hover:to-transparent transition-all duration-300 group">
                    <div class="grid grid-cols-12 gap-4 items-center">
                        <div class="col-span-1">
                            <div class="w-8 h-8 bg-gradient-to-br from-[#185B3C] to-[#0F3D26] rounded-lg flex items-center justify-center text-white font-bold text-sm">
                                {{ $kontaks->firstItem() + $index }}
                            </div>
                        </div>
                        <div class="col-span-2">
                            <p class="text-gray-900 font-medium text-sm">{{ $kontak->created_at->format('d M Y') }}</p>
                            <p class="text-xs text-gray-500">{{ $kontak->created_at->format('H:i') }} WIB</p>
                        </div>
                        <div class="col-span-2">
                            <p class="font-semibold text-gray-900 text-sm">{{ $kontak->nama_depan ?? 'N/A' }}</p>
                        </div>
                        <div class="col-span-2">
                            <p class="font-semibold text-gray-900 text-sm">{{ $kontak->nama_belakang ?? 'N/A' }}</p>
                        </div>
                        <div class="col-span-2">
                            <p class="text-gray-900 text-sm">{{ $kontak->email ?? 'N/A' }}</p>
                        </div>
                        <div class="col-span-2">
                            <p class="text-gray-900 text-sm">{{ $kontak->no_hp ?? 'N/A' }}</p>
                        </div>
                        <div class="col-span-1">
                            <div class="flex items-center justify-center space-x-1">
                                <a href="{{ route('admin.kontak.show', $kontak->id) }}" class="p-2 text-gray-400 hover:text-[#185B3C] hover:bg-[#185B3C]/10 rounded-lg transition-all duration-200 hover:scale-105" title="Lihat Detail">
                                    <i class="fas fa-eye text-xs"></i>
                                </a>
                                <form action="{{ route('admin.kontak.destroy', $kontak->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this contact?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all duration-200 hover:scale-105" title="Hapus Kontak">
                                        <i class="fas fa-trash text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="px-6 py-8 text-center">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-envelope text-gray-400 text-xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Tidak ada pesan kontak</h3>
                    <p class="text-gray-500">Belum ada pesan kontak yang masuk.</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Table Footer -->
        <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-gray-100 border-t border-gray-200">
            <div class="flex items-center justify-between">
                <p class="text-sm text-gray-600">Menampilkan <span class="font-semibold text-[#185B3C]">{{ $kontaks->count() }}</span> dari <span class="font-semibold text-[#185B3C]">{{ $kontaks->total() }}</span> pesan</p>
                <div class="flex items-center space-x-1">
                    {{ $kontaks->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<script>
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
