@extends('layouts.app')

@section('title', 'Detail Berita')
@section('subtitle', 'Detail informasi berita')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">
    <!-- Hero Section with Gradient -->
    <div class="relative overflow-hidden bg-gradient-to-br from-[#185B3C] via-[#0F3D26] to-[#185B3C] rounded-xl p-6 text-white">
        <div class="absolute inset-0 bg-black/10"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold mb-1">Detail Berita</h1>
                    <p class="text-sm text-white/90 mb-4">Informasi lengkap berita "{{ $berita->nama }}"</p>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                            <span class="text-xs">Detail View</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-calendar text-xs"></i>
                            <span class="text-xs">{{ $berita->created_at->format('d M Y H:i') }} WIB</span>
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

    <!-- Back Button -->
    <div class="flex items-center space-x-4">
        <a href="{{ route('admin.berita.index') }}" class="flex items-center px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-white/80 rounded-lg transition-colors border border-gray-200">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali ke Daftar Berita
        </a>
    </div>

    <!-- Main Content Card -->
    <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
        <div class="flex items-center space-x-3 mb-6">
            <div class="w-10 h-10 bg-gradient-to-br from-[#185B3C] to-[#0F3D26] rounded-lg flex items-center justify-center shadow-md">
                <i class="fas fa-newspaper text-white text-sm"></i>
            </div>
            <div>
                <h3 class="text-lg font-bold text-gray-900">Detail Berita</h3>
                <p class="text-sm text-gray-600">Informasi lengkap berita</p>
            </div>
        </div>
        
        <div class="space-y-6">
            <!-- Judul Berita -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Judul Berita</label>
                <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                    <h2 class="text-xl font-bold text-gray-900">{{ $berita->nama }}</h2>
                </div>
            </div>

            <!-- Kategori dan Status -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                        <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-blue-100 text-blue-800">
                            {{ $berita->kategori->nama ?? 'N/A' }}
                        </span>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                        @if($berita->status === 'aktif')
                            <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-gradient-to-r from-green-100 to-green-200 text-green-800 border border-green-300">
                                <i class="fas fa-check-circle mr-2 text-sm"></i>
                                Aktif
                            </span>
                        @else
                            <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-gradient-to-r from-yellow-100 to-yellow-200 text-yellow-800 border border-yellow-300">
                                <i class="fas fa-clock mr-2 text-sm"></i>
                                Pending
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Gambar Berita -->
            @if($berita->photo)
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Berita</label>
                <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                    <div class="flex justify-center">
                        <img src="{{ asset('uploads/images/berita/' . $berita->photo) }}" 
                             alt="{{ $berita->nama }}" 
                             class="max-w-full max-h-96 rounded-lg shadow-lg border border-gray-200">
                    </div>
                    <div class="mt-3 text-center text-sm text-gray-600">
                        <p><strong>Nama file:</strong> {{ $berita->photo }}</p>
                        <p><strong>Format:</strong> {{ pathinfo($berita->photo, PATHINFO_EXTENSION) }}</p>
                    </div>
                </div>
            </div>
            @else
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Berita</label>
                <div class="bg-gray-50 rounded-lg p-8 border border-gray-200 text-center">
                    <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-image text-gray-400 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Tidak ada gambar</h3>
                    <p class="text-gray-500">Berita ini belum memiliki gambar.</p>
                </div>
            </div>
            @endif

            <!-- Deskripsi Singkat -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Singkat</label>
                <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                    <div class="text-gray-700 leading-relaxed">
                        {{ $berita->deskripsi }}
                    </div>
                </div>
            </div>

            <!-- Konten Lengkap -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Konten Lengkap</label>
                <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                    <div class="text-gray-700 leading-relaxed whitespace-pre-line">
                        {{ $berita->konten }}
                    </div>
                </div>
            </div>

            <!-- Informasi Tambahan -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Dilihat</label>
                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                        <span class="text-lg font-semibold text-gray-900">{{ $berita->dilihat ?? 0 }} kali</span>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Dibuat</label>
                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                        <span class="text-sm font-semibold text-gray-900">{{ $berita->created_at->format('d M Y, H:i') }} WIB</span>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Terakhir Diupdate</label>
                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                        <span class="text-sm font-semibold text-gray-900">{{ $berita->updated_at->format('d M Y, H:i') }} WIB</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Actions -->
    <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-bold text-gray-900">Aksi</h3>
                <p class="text-sm text-gray-600">Kelola berita ini</p>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('admin.berita.edit', $berita->id) }}" class="flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors shadow-md">
                    <i class="fas fa-edit mr-2"></i>
                    Edit Berita
                </a>
                
                <form action="{{ route('admin.berita.destroy', $berita->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this berita?');" class="inline">
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
