@extends('layouts.app')

@section('title', 'Detail Slider')
@section('subtitle', 'Detail informasi slider')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Hero Section with Gradient -->
    <div class="relative overflow-hidden bg-gradient-to-br from-[#185B3C] via-[#0F3D26] to-[#185B3C] rounded-xl p-6 text-white">
        <div class="absolute inset-0 bg-black/10"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold mb-1">Detail Slider</h1>
                    <p class="text-sm text-white/90 mb-4">Informasi lengkap slider "{{ $slider->judul }}"</p>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                            <span class="text-xs">Detail View</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-calendar text-xs"></i>
                            <span class="text-xs">{{ $slider->created_at->format('d M Y H:i') }} WIB</span>
                        </div>
                    </div>
                </div>
                <div class="hidden lg:block">
                    <div class="w-20 h-20 bg-white/10 rounded-full flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-image text-3xl text-white/80"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -translate-y-16 translate-x-16"></div>
        <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full translate-y-12 -translate-x-12"></div>
    </div>

    <!-- Back Button -->
    <div class="flex items-center space-x-4">
        <a href="{{ route('admin.slider.index') }}" class="flex items-center px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-white/80 rounded-lg transition-colors border border-gray-200">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali ke Daftar Slider
        </a>
    </div>

    <!-- Slider Information Cards -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Slider Details -->
        <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
            <div class="flex items-center space-x-3 mb-6">
                <div class="w-10 h-10 bg-gradient-to-br from-[#185B3C] to-[#0F3D26] rounded-lg flex items-center justify-center shadow-md">
                    <i class="fas fa-info-circle text-white text-sm"></i>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Informasi Slider</h3>
                    <p class="text-sm text-gray-600">Detail informasi slider</p>
                </div>
            </div>
            
            <div class="space-y-4">
                <div class="flex items-center justify-between py-3 border-b border-gray-100">
                    <span class="text-sm font-medium text-gray-500">Judul</span>
                    <span class="text-sm font-semibold text-gray-900">{{ $slider->judul }}</span>
                </div>
                
                <div class="flex items-center justify-between py-3 border-b border-gray-100">
                    <span class="text-sm font-medium text-gray-500">Slug</span>
                    <span class="text-sm font-semibold text-gray-900">{{ $slider->slug }}</span>
                </div>
                
                <div class="flex items-center justify-between py-3 border-b border-gray-100">
                    <span class="text-sm font-medium text-gray-500">Link</span>
                    @if($slider->link)
                        <a href="{{ $slider->link }}" target="_blank" class="text-blue-600 hover:text-blue-800 text-sm">
                            {{ Str::limit($slider->link, 30) }}
                        </a>
                    @else
                        <span class="text-gray-400 text-sm">Tidak ada link</span>
                    @endif
                </div>
                
                <div class="flex items-center justify-between py-3 border-b border-gray-100">
                    <span class="text-sm font-medium text-gray-500">Status</span>
                    @if($slider->status)
                        <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-gradient-to-r from-green-100 to-green-200 text-green-800 border border-green-300">
                            <i class="fas fa-check-circle mr-1 text-xs"></i>
                            Aktif
                        </span>
                    @else
                        <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-gradient-to-r from-red-100 to-red-200 text-red-800 border border-red-300">
                            <i class="fas fa-times-circle mr-1 text-xs"></i>
                            Nonaktif
                        </span>
                    @endif
                </div>
                
                <div class="flex items-center justify-between py-3">
                    <span class="text-sm font-medium text-gray-500">Tanggal Dibuat</span>
                    <span class="text-sm font-semibold text-gray-900">{{ $slider->created_at->format('d M Y, H:i') }} WIB</span>
                </div>
            </div>
        </div>

        <!-- Image Preview -->
        <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
            <div class="flex items-center space-x-3 mb-6">
                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center shadow-md">
                    <i class="fas fa-image text-white text-sm"></i>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Preview Gambar</h3>
                    <p class="text-sm text-gray-600">Tampilan gambar slider</p>
                </div>
            </div>
            
            @if($slider->photo)
                <div class="space-y-4">
                    <!-- Large Image -->
                    <div>
                        <h4 class="text-sm font-medium text-gray-700 mb-2">Gambar Besar (800px)</h4>
                        <div class="w-full h-48 bg-gray-100 rounded-lg overflow-hidden">
                            <img src="{{ Storage::url('images/slider/large/' . $slider->photo) }}" 
                                 alt="{{ $slider->judul }}" 
                                 class="w-full h-full object-cover">
                        </div>
                    </div>
                    
                    <!-- Medium Image -->
                    <div>
                        <h4 class="text-sm font-medium text-gray-700 mb-2">Gambar Medium (400px)</h4>
                        <div class="w-full h-32 bg-gray-100 rounded-lg overflow-hidden">
                            <img src="{{ Storage::url('images/slider/medium/' . $slider->photo) }}" 
                                 alt="{{ $slider->judul }}" 
                                 class="w-full h-full object-cover">
                        </div>
                    </div>
                    
                    <!-- Small Image -->
                    <div>
                        <h4 class="text-sm font-medium text-gray-700 mb-2">Gambar Kecil (100px)</h4>
                        <div class="w-24 h-24 bg-gray-100 rounded-lg overflow-hidden">
                            <img src="{{ Storage::url('images/slider/small/' . $slider->photo) }}" 
                                 alt="{{ $slider->judul }}" 
                                 class="w-full h-full object-cover">
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center py-8">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-image text-gray-400 text-xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Tidak ada gambar</h3>
                    <p class="text-gray-500">Slider ini belum memiliki gambar.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Actions -->
    <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-bold text-gray-900">Aksi</h3>
                <p class="text-sm text-gray-600">Kelola slider ini</p>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('admin.slider.edit', $slider->id) }}" class="flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors shadow-md">
                    <i class="fas fa-edit mr-2"></i>
                    Edit Slider
                </a>
                
                @if($slider->link)
                <a href="{{ $slider->link }}" target="_blank" class="flex items-center px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 transition-colors shadow-md">
                    <i class="fas fa-external-link-alt mr-2"></i>
                    Buka Link
                </a>
                @endif
                
                <form action="{{ route('admin.slider.destroy', $slider->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this slider?');" class="inline">
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
