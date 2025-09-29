@extends('layouts.app')

@section('title', 'Berita Management')
@section('subtitle', 'Kelola semua berita dan artikel website')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">
    <!-- Hero Section with Gradient -->
    <div class="relative overflow-hidden bg-gradient-to-br from-[#185B3C] via-[#0F3D26] to-[#185B3C] rounded-xl p-6 text-white">
        <div class="absolute inset-0 bg-black/10"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold mb-1">Berita Management</h1>
                    <p class="text-sm text-white/90 mb-4">Kelola semua berita dan artikel website dengan mudah dan efisien</p>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                            <span class="text-xs">Sistem Aktif</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-newspaper text-xs"></i>
                            <span class="text-xs">{{ $totalBeritas }} Total Berita</span>
                        </div>
                    </div>
                </div>
                <div class="hidden lg:block">
                    <div class="w-20 h-20 bg-white/10 rounded-full flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-newspaper text-3xl text-white/80"></i>
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
                        <i class="fas fa-newspaper text-white text-sm"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-2xl font-bold text-[#185B3C]">{{ $totalBeritas }}</p>
                        <p class="text-xs text-gray-500">Total</p>
                    </div>
                </div>
                <h3 class="text-sm font-semibold text-gray-900 mb-1">Total Berita</h3>
                <div class="flex items-center text-xs text-green-600">
                    <i class="fas fa-arrow-up mr-1"></i>
                    <span>+8% dari bulan lalu</span>
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
                        <p class="text-2xl font-bold text-green-600">{{ $activeBeritas }}</p>
                        <p class="text-xs text-gray-500">Aktif</p>
                    </div>
                </div>
                <h3 class="text-sm font-semibold text-gray-900 mb-1">Berita Aktif</h3>
                <div class="flex items-center text-xs text-green-600">
                    <i class="fas fa-arrow-up mr-1"></i>
                    <span>+12% dari kemarin</span>
                </div>
            </div>
        </div>
        
        <div class="group relative overflow-hidden bg-white/80 backdrop-blur-sm rounded-xl p-4 shadow-lg border border-white/20 hover:shadow-xl transition-all duration-300">
            <div class="absolute inset-0 bg-gradient-to-br from-yellow-500/5 to-transparent"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-lg flex items-center justify-center shadow-md">
                        <i class="fas fa-clock text-white text-sm"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-2xl font-bold text-yellow-600">{{ $pendingBeritas }}</p>
                        <p class="text-xs text-gray-500">Pending</p>
                    </div>
                </div>
                <h3 class="text-sm font-semibold text-gray-900 mb-1">Berita Pending</h3>
                <div class="flex items-center text-xs text-yellow-600">
                    <i class="fas fa-arrow-down mr-1"></i>
                    <span>-3% dari kemarin</span>
                </div>
            </div>
        </div>
        
        <div class="group relative overflow-hidden bg-white/80 backdrop-blur-sm rounded-xl p-4 shadow-lg border border-white/20 hover:shadow-xl transition-all duration-300">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-transparent"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center shadow-md">
                        <i class="fas fa-calendar-day text-white text-sm"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-2xl font-bold text-blue-600">{{ $todayBeritas }}</p>
                        <p class="text-xs text-gray-500">Hari Ini</p>
                    </div>
                </div>
                <h3 class="text-sm font-semibold text-gray-900 mb-1">Ditambah Hari Ini</h3>
                <div class="flex items-center text-xs text-blue-600">
                    <i class="fas fa-arrow-up mr-1"></i>
                    <span>+2 dari kemarin</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h3 class="text-lg font-bold text-gray-900">Aksi Cepat</h3>
                <p class="text-sm text-gray-600">Kelola berita dengan mudah</p>
            </div>
            <div class="w-8 h-8 bg-gradient-to-br from-[#185B3C] to-[#0F3D26] rounded-lg flex items-center justify-center">
                <i class="fas fa-bolt text-white text-sm"></i>
            </div>
        </div>
        
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.berita.create') }}" class="flex items-center px-4 py-2 text-sm font-medium text-white bg-[#185B3C] rounded-lg hover:bg-[#0F3D26] transition-colors shadow-md">
                <i class="fas fa-plus mr-2"></i>
                Tambah Berita
            </a>
            
            <button class="flex items-center px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-white/80 rounded-lg transition-colors border border-gray-200">
                <i class="fas fa-sort mr-2"></i>
                Urutkan Berita
            </button>
        </div>
    </div>

    <!-- Modern Data Table -->
    <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg border border-white/20 overflow-hidden">
        <!-- Table Header -->
        <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-gradient-to-br from-[#185B3C] to-[#0F3D26] rounded-lg flex items-center justify-center">
                        <i class="fas fa-newspaper text-white text-sm"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Daftar Berita</h3>
                        <p class="text-sm text-gray-600">Kelola semua berita dan artikel</p>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="relative">
                        <input type="text" placeholder="Cari berita..." class="pl-8 pr-3 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent bg-white/80">
                        <i class="fas fa-search absolute left-2.5 top-2.5 text-gray-400 text-xs"></i>
                    </div>
                    <button class="flex items-center px-3 py-2 text-sm text-gray-600 hover:text-gray-900 hover:bg-white/80 rounded-lg transition-colors">
                        <i class="fas fa-filter mr-1 text-xs"></i>
                        Filter
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
                        <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">GAMBAR</span>
                    </div>
                    <div class="col-span-4">
                        <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">JUDUL BERITA</span>
                    </div>
                    <div class="col-span-2">
                        <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">KATEGORI</span>
                    </div>
                    <div class="col-span-1">
                        <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">TGL UPDATE</span>
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
                @forelse ($beritas as $index => $berita)
                <div class="px-6 py-4 hover:bg-gradient-to-r hover:from-[#185B3C]/5 hover:to-transparent transition-all duration-300 group">
                    <div class="grid grid-cols-12 gap-4 items-center">
                        <div class="col-span-1">
                            <div class="w-8 h-8 bg-gradient-to-br from-[#185B3C] to-[#0F3D26] rounded-lg flex items-center justify-center text-white font-bold text-sm">
                                {{ $beritas->firstItem() + $index }}
                            </div>
                        </div>
                        <div class="col-span-2">
                            <div class="w-16 h-16 bg-gray-100 rounded-lg overflow-hidden flex items-center justify-center">
                                @if($berita->photo)
                                    <img src="{{ Storage::url('images/berita/small/' . $berita->photo) }}" 
                                         alt="{{ $berita->nama }}" 
                                         class="w-full h-full object-cover">
                                @else
                                    <i class="fas fa-image text-gray-400 text-xl"></i>
                                @endif
                            </div>
                        </div>
                        <div class="col-span-4">
                            <div>
                                <h5 class="font-semibold text-gray-900 text-sm mb-1">{{ $berita->nama }}</h5>
                                <p class="text-xs text-gray-500 line-clamp-2">{{ Str::limit($berita->deskripsi, 80) }}</p>
                                <p class="text-xs text-gray-400 mt-1">Dilihat: {{ $berita->dilihat ?? 0 }} kali</p>
                            </div>
                        </div>
                        <div class="col-span-2">
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                {{ $berita->kategori->nama ?? 'N/A' }}
                            </span>
                        </div>
                        <div class="col-span-1">
                            <p class="text-gray-900 font-medium text-sm">{{ $berita->updated_at->format('d M Y') }}</p>
                            <p class="text-xs text-gray-500">{{ $berita->updated_at->format('H:i') }}</p>
                        </div>
                        <div class="col-span-1">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer" {{ $berita->status === 'aktif' ? 'checked' : '' }}
                                       onchange="toggleBeritaStatus({{ $berita->id }}, this.checked)">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                            </label>
                        </div>
                        <div class="col-span-1">
                            <div class="flex items-center justify-center space-x-1">
                                <a href="{{ route('admin.berita.show', $berita->id) }}" class="p-2 text-gray-400 hover:text-[#185B3C] hover:bg-[#185B3C]/10 rounded-lg transition-all duration-200 hover:scale-105" title="Lihat Detail">
                                    <i class="fas fa-eye text-xs"></i>
                                </a>
                                <a href="{{ route('admin.berita.edit', $berita->id) }}" class="p-2 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-200 hover:scale-105" title="Edit Berita">
                                    <i class="fas fa-edit text-xs"></i>
                                </a>
                                <form action="{{ route('admin.berita.destroy', $berita->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this berita?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all duration-200 hover:scale-105" title="Hapus Berita">
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
                        <i class="fas fa-newspaper text-gray-400 text-xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Tidak ada berita</h3>
                    <p class="text-gray-500 mb-4">Belum ada berita yang dibuat.</p>
                    <a href="{{ route('admin.berita.create') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-[#185B3C] rounded-lg hover:bg-[#0F3D26] transition-colors">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah Berita Pertama
                    </a>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Table Footer -->
        <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-gray-100 border-t border-gray-200">
            <div class="flex items-center justify-between">
                <p class="text-sm text-gray-600">Menampilkan <span class="font-semibold text-[#185B3C]">{{ $beritas->count() }}</span> dari <span class="font-semibold text-[#185B3C]">{{ $beritas->total() }}</span> berita</p>
                <div class="flex items-center space-x-1">
                    {{ $beritas->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleBeritaStatus(beritaId, status) {
        const newStatus = status ? 'aktif' : 'pending';
        
        fetch(`/admin/berita/${beritaId}/toggle-status`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ status: newStatus })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Show success message
                const message = document.createElement('div');
                message.className = 'fixed top-4 right-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded z-50';
                message.textContent = data.message;
                document.body.appendChild(message);
                
                setTimeout(() => {
                    message.remove();
                }, 3000);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
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
