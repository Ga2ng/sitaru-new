@extends('layouts.app')

@section('title', 'Detail Kontak')
@section('subtitle', 'Detail informasi pesan kontak')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Hero Section with Gradient -->
    <div class="relative overflow-hidden bg-gradient-to-br from-[#185B3C] via-[#0F3D26] to-[#185B3C] rounded-xl p-6 text-white">
        <div class="absolute inset-0 bg-black/10"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold mb-1">Detail Kontak</h1>
                    <p class="text-sm text-white/90 mb-4">Informasi lengkap pesan kontak dari {{ $kontak->nama_depan }} {{ $kontak->nama_belakang }}</p>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                            <span class="text-xs">Pesan Terbaru</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-clock text-xs"></i>
                            <span class="text-xs">{{ $kontak->created_at->format('d M Y H:i') }} WIB</span>
                        </div>
                    </div>
                </div>
                <div class="hidden lg:block">
                    <div class="w-20 h-20 bg-white/10 rounded-full flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-user text-3xl text-white/80"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -translate-y-16 translate-x-16"></div>
        <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full translate-y-12 -translate-x-12"></div>
    </div>

    <!-- Back Button -->
    <div class="flex items-center space-x-4">
        <a href="{{ route('admin.kontak.index') }}" class="flex items-center px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-white/80 rounded-lg transition-colors border border-gray-200">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali ke Daftar Kontak
        </a>
    </div>

    <!-- Contact Information Cards -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Personal Information -->
        <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
            <div class="flex items-center space-x-3 mb-6">
                <div class="w-10 h-10 bg-gradient-to-br from-[#185B3C] to-[#0F3D26] rounded-lg flex items-center justify-center shadow-md">
                    <i class="fas fa-user text-white text-sm"></i>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Informasi Personal</h3>
                    <p class="text-sm text-gray-600">Data pribadi pengirim pesan</p>
                </div>
            </div>
            
            <div class="space-y-4">
                <div class="flex items-center justify-between py-3 border-b border-gray-100">
                    <span class="text-sm font-medium text-gray-500">Nama Lengkap</span>
                    <span class="text-sm font-semibold text-gray-900">{{ $kontak->nama_depan }} {{ $kontak->nama_belakang }}</span>
                </div>
                
                <div class="flex items-center justify-between py-3 border-b border-gray-100">
                    <span class="text-sm font-medium text-gray-500">Email</span>
                    <span class="text-sm font-semibold text-gray-900">{{ $kontak->email ?? 'N/A' }}</span>
                </div>
                
                <div class="flex items-center justify-between py-3 border-b border-gray-100">
                    <span class="text-sm font-medium text-gray-500">No. HP</span>
                    <span class="text-sm font-semibold text-gray-900">{{ $kontak->no_hp ?? 'N/A' }}</span>
                </div>
                
                <div class="flex items-center justify-between py-3">
                    <span class="text-sm font-medium text-gray-500">Tanggal Kirim</span>
                    <span class="text-sm font-semibold text-gray-900">{{ $kontak->created_at->format('d M Y, H:i') }} WIB</span>
                </div>
            </div>
        </div>

        <!-- Message Information -->
        <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
            <div class="flex items-center space-x-3 mb-6">
                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center shadow-md">
                    <i class="fas fa-envelope text-white text-sm"></i>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Informasi Pesan</h3>
                    <p class="text-sm text-gray-600">Detail pesan yang dikirim</p>
                </div>
            </div>
            
            <div class="space-y-4">
                <div class="flex items-center justify-between py-3 border-b border-gray-100">
                    <span class="text-sm font-medium text-gray-500">Status</span>
                    <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-gradient-to-r from-green-100 to-green-200 text-green-800 border border-green-300">
                        <i class="fas fa-check-circle mr-1 text-xs"></i>
                        Terkirim
                    </span>
                </div>
                
                <div class="flex items-center justify-between py-3 border-b border-gray-100">
                    <span class="text-sm font-medium text-gray-500">Waktu Kirim</span>
                    <span class="text-sm font-semibold text-gray-900">{{ $kontak->created_at->diffForHumans() }}</span>
                </div>
                
                <div class="flex items-center justify-between py-3 border-b border-gray-100">
                    <span class="text-sm font-medium text-gray-500">ID Pesan</span>
                    <span class="text-sm font-semibold text-gray-900">#KONTAK-{{ str_pad($kontak->id, 4, '0', STR_PAD_LEFT) }}</span>
                </div>
                
                <div class="flex items-center justify-between py-3">
                    <span class="text-sm font-medium text-gray-500">Tipe Pesan</span>
                    <span class="text-sm font-semibold text-gray-900">Kontak & Pengaduan</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Message Content -->
    <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
        <div class="flex items-center space-x-3 mb-6">
            <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg flex items-center justify-center shadow-md">
                <i class="fas fa-comment-alt text-white text-sm"></i>
            </div>
            <div>
                <h3 class="text-lg font-bold text-gray-900">Isi Pesan</h3>
                <p class="text-sm text-gray-600">Pesan yang dikirim oleh pengguna</p>
            </div>
        </div>
        
        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
            <p class="text-gray-900 leading-relaxed">
                {{ $kontak->pesan ?? 'Tidak ada pesan yang dikirim.' }}
            </p>
        </div>
    </div>

    <!-- Actions -->
    <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-bold text-gray-900">Aksi</h3>
                <p class="text-sm text-gray-600">Kelola pesan kontak ini</p>
            </div>
            <div class="flex items-center space-x-3">
                <a href="mailto:{{ $kontak->email }}" class="flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors shadow-md">
                    <i class="fas fa-reply mr-2"></i>
                    Balas Email
                </a>
                
                <a href="tel:{{ $kontak->no_hp }}" class="flex items-center px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 transition-colors shadow-md">
                    <i class="fas fa-phone mr-2"></i>
                    Hubungi
                </a>
                
                <form action="{{ route('admin.kontak.destroy', $kontak->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this contact?');" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="flex items-center px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition-colors shadow-md">
                        <i class="fas fa-trash mr-2"></i>
                        Hapus
                    </button>
                </form>
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
    });
</script>
@endsection
