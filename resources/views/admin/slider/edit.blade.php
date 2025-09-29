@extends('layouts.app')

@section('title', 'Edit Slider')
@section('subtitle', 'Edit slider yang sudah ada')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Hero Section with Gradient -->
    <div class="relative overflow-hidden bg-gradient-to-br from-[#185B3C] via-[#0F3D26] to-[#185B3C] rounded-xl p-6 text-white">
        <div class="absolute inset-0 bg-black/10"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold mb-1">Edit Slider</h1>
                    <p class="text-sm text-white/90 mb-4">Edit slider "{{ $slider->judul }}" untuk website</p>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                            <span class="text-xs">Form Aktif</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-edit text-xs"></i>
                            <span class="text-xs">Edit Mode</span>
                        </div>
                    </div>
                </div>
                <div class="hidden lg:block">
                    <div class="w-20 h-20 bg-white/10 rounded-full flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-edit text-3xl text-white/80"></i>
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

    <!-- Form Section -->
    <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
        <form action="{{ route('admin.slider.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="space-y-6">
                <!-- Judul Slider -->
                <div>
                    <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">
                        Judul Slider <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="judul" 
                           name="judul" 
                           value="{{ old('judul', $slider->judul) }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#185B3C] focus:border-transparent transition-colors @error('judul') border-red-500 @enderror"
                           placeholder="Masukkan judul slider"
                           required>
                    @error('judul')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Link -->
                <div>
                    <label for="link" class="block text-sm font-medium text-gray-700 mb-2">
                        Link (Opsional)
                    </label>
                    <input type="url" 
                           id="link" 
                           name="link" 
                           value="{{ old('link', $slider->link) }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#185B3C] focus:border-transparent transition-colors @error('link') border-red-500 @enderror"
                           placeholder="https://example.com">
                    @error('link')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Current Image -->
                @if($slider->photo)
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Gambar Saat Ini
                    </label>
                    <div class="flex items-center space-x-4">
                        <div class="w-32 h-20 bg-gray-100 rounded-lg overflow-hidden">
                            <img src="{{ Storage::url('images/slider/medium/' . $slider->photo) }}" 
                                 alt="{{ $slider->judul }}" 
                                 class="w-full h-full object-cover">
                        </div>
                        <div class="text-sm text-gray-600">
                            <p class="font-medium">{{ $slider->judul }}</p>
                            <p class="text-xs">Ukuran: Medium (400px)</p>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Upload New Image -->
                <div>
                    <label for="photo" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ $slider->photo ? 'Ganti Gambar' : 'Upload Gambar' }} <span class="text-red-500">*</span>
                    </label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-[#185B3C] transition-colors">
                        <div class="space-y-1 text-center">
                            <div class="mx-auto h-12 w-12 text-gray-400">
                                <i class="fas fa-cloud-upload-alt text-3xl"></i>
                            </div>
                            <div class="flex text-sm text-gray-600">
                                <label for="photo" class="relative cursor-pointer bg-white rounded-md font-medium text-[#185B3C] hover:text-[#0F3D26] focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-[#185B3C]">
                                    <span>{{ $slider->photo ? 'Ganti file' : 'Upload file' }}</span>
                                    <input id="photo" name="photo" type="file" class="sr-only" accept="image/*" onchange="previewImage(this)">
                                </label>
                                <p class="pl-1">atau drag and drop</p>
                            </div>
                            <p class="text-xs text-gray-500">PNG, JPG, GIF hingga 2MB</p>
                            @if($slider->photo)
                            <p class="text-xs text-blue-600">Kosongkan jika tidak ingin mengganti gambar</p>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Image Preview -->
                    <div id="imagePreview" class="mt-4 hidden">
                        <img id="previewImg" src="" alt="Preview" class="max-w-xs mx-auto rounded-lg shadow-md">
                    </div>
                    
                    @error('photo')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div class="flex items-center">
                    <input type="checkbox" 
                           id="status" 
                           name="status" 
                           value="1"
                           {{ old('status', $slider->status) ? 'checked' : '' }}
                           class="h-4 w-4 text-[#185B3C] focus:ring-[#185B3C] border-gray-300 rounded">
                    <label for="status" class="ml-2 block text-sm text-gray-700">
                        Aktifkan slider ini
                    </label>
                </div>

                <!-- Submit Buttons -->
                <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.slider.index') }}" 
                       class="px-6 py-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#185B3C] transition-colors">
                        Batal
                    </a>
                    <button type="submit" 
                            class="px-6 py-3 text-sm font-medium text-white bg-[#185B3C] rounded-lg hover:bg-[#0F3D26] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#185B3C] transition-colors shadow-md">
                        <i class="fas fa-save mr-2"></i>
                        Update Slider
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function previewImage(input) {
        const file = input.files[0];
        const preview = document.getElementById('imagePreview');
        const previewImg = document.getElementById('previewImg');
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                preview.classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        } else {
            preview.classList.add('hidden');
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
    });
</script>
@endsection
