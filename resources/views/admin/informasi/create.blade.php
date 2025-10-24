@extends('layouts.app')

@section('title', 'Tambah Informasi')
@section('subtitle', 'Buat informasi baru untuk website')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">
    <!-- Hero Section with Gradient -->
    <div class="relative overflow-hidden bg-gradient-to-br from-[#185B3C] via-[#0F3D26] to-[#185B3C] rounded-xl p-6 text-white">
        <div class="absolute inset-0 bg-black/10"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold mb-1">Tambah Informasi</h1>
                    <p class="text-sm text-white/90 mb-4">Buat informasi baru untuk menampilkan pengumuman penting di website</p>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                            <span class="text-xs">Form Aktif</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-info-circle text-xs"></i>
                            <span class="text-xs">Editor Mode</span>
                        </div>
                    </div>
                </div>
                <div class="hidden lg:block">
                    <div class="w-20 h-20 bg-white/10 rounded-full flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-plus text-3xl text-white/80"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -translate-y-16 translate-x-16"></div>
        <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full translate-y-12 -translate-x-12"></div>
    </div>

    <!-- Notifications -->
    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4 flex items-center">
        <i class="fas fa-check-circle mr-2"></i>
        {{ session('success') }}
    </div>
    @endif

    @if(session('error') || $errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4">
        <div class="flex items-center mb-2">
            <i class="fas fa-exclamation-circle mr-2"></i>
            <strong>Terjadi kesalahan:</strong>
        </div>
        @if(session('error'))
            <p class="text-sm">{{ session('error') }}</p>
        @endif
        @if($errors->any())
            <ul class="list-disc list-inside text-sm mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    </div>
    @endif

    <!-- Back Button -->
    <div class="flex items-center space-x-4">
        <a href="{{ route('admin.informasi.index') }}" class="flex items-center px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-white/80 rounded-lg transition-colors border border-gray-200">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali ke Daftar Informasi
        </a>
    </div>

    <!-- Form Section -->
    <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
        <form action="{{ route('admin.informasi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="space-y-6">
                <!-- Judul Informasi -->
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">
                        Judul Informasi <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="nama" 
                           name="nama" 
                           value="{{ old('nama') }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#185B3C] focus:border-transparent transition-colors @error('nama') border-red-500 @enderror"
                           placeholder="Masukkan judul informasi"
                           required>
                    @error('nama')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div>
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">
                        Deskripsi Singkat <span class="text-red-500">*</span>
                    </label>
                    <textarea id="deskripsi" 
                              name="deskripsi" 
                              rows="3"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#185B3C] focus:border-transparent transition-colors @error('deskripsi') border-red-500 @enderror"
                              placeholder="Masukkan deskripsi singkat informasi"
                              required>{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Konten -->
                <div>
                    <label for="konten" class="block text-sm font-medium text-gray-700 mb-2">
                        Konten Lengkap <span class="text-red-500">*</span>
                    </label>
                    <textarea id="konten" 
                              name="konten" 
                              rows="8"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#185B3C] focus:border-transparent transition-colors @error('konten') border-red-500 @enderror"
                              placeholder="Masukkan konten lengkap informasi"
                              required>{{ old('konten') }}</textarea>
                    @error('konten')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Upload Gambar -->
                <div>
                    <label for="photo" class="block text-sm font-medium text-gray-700 mb-2">
                        Gambar Informasi <span class="text-red-500">*</span>
                    </label>
                    
                    <!-- Upload Area -->
                    <div class="border-2 border-gray-300 border-dashed rounded-lg hover:border-[#185B3C] transition-colors p-8">
                        <div class="space-y-4 text-center">
                            <div class="mx-auto h-16 w-16 text-gray-400">
                                <i class="fas fa-cloud-upload-alt text-4xl"></i>
                            </div>
                            <div class="space-y-2">
                                <div class="text-lg font-medium text-gray-700">
                                    <label for="photo" class="relative cursor-pointer bg-[#185B3C] text-white px-6 py-3 rounded-lg font-medium hover:bg-[#0F3D26] focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-[#185B3C] transition-colors inline-block">
                                        <i class="fas fa-upload mr-2"></i>
                                        Pilih File Gambar
                                        <input id="photo" name="photo" type="file" class="sr-only" accept="image/jpeg,image/jpg,image/png" onchange="previewImage(this)" required>
                                    </label>
                                </div>
                                <p class="text-sm text-gray-600">atau drag and drop file di sini</p>
                            </div>
                            <div class="text-xs text-gray-500 space-y-1">
                                <p><strong>Format yang didukung:</strong> JPG, PNG, JPEG</p>
                                <p><strong>Ukuran maksimal:</strong> 10 MB</p>
                                <p><strong>Resolusi disarankan:</strong> 800x600 px atau lebih</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Image Preview -->
                    <div id="imagePreview" class="mt-6 hidden">
                        <div class="text-center mb-4">
                            <span class="text-sm font-medium text-gray-700">Preview Gambar:</span>
                        </div>
                        <div class="flex justify-center">
                            <div class="relative">
                                <img id="previewImg" src="" alt="Preview" class="max-w-md max-h-64 rounded-lg shadow-lg border border-gray-200">
                                <div class="absolute top-2 right-2">
                                    <button type="button" onclick="removeImage()" class="bg-red-500 text-white rounded-full w-8 h-8 flex items-center justify-center hover:bg-red-600 transition-colors">
                                        <i class="fas fa-times text-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div id="fileInfo" class="mt-2 text-center text-sm text-gray-600"></div>
                    </div>
                    
                    @error('photo')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                        Status Informasi
                    </label>
                    <select id="status" 
                            name="status" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#185B3C] focus:border-transparent transition-colors @error('status') border-red-500 @enderror">
                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Buttons -->
                <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.informasi.index') }}" 
                       class="px-6 py-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#185B3C] transition-colors">
                        Batal
                    </a>
                    <button type="submit" 
                            class="px-6 py-3 text-sm font-medium text-white bg-[#185B3C] rounded-lg hover:bg-[#0F3D26] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#185B3C] transition-colors shadow-md">
                        <i class="fas fa-save mr-2"></i>
                        Simpan Informasi
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
        const fileInfo = document.getElementById('fileInfo');
        
        if (file) {
            // Validate file type
            const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
            if (!allowedTypes.includes(file.type)) {
                alert('Format file tidak didukung! Hanya JPG, PNG, dan JPEG yang diperbolehkan.');
                input.value = '';
                return;
            }
            
            // Validate file size (10MB = 10 * 1024 * 1024 bytes)
            const maxSize = 10 * 1024 * 1024;
            if (file.size > maxSize) {
                alert('Ukuran file terlalu besar! Maksimal 10MB.');
                input.value = '';
                return;
            }
            
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                preview.classList.remove('hidden');
                
                // Show file info
                const fileSize = (file.size / 1024 / 1024).toFixed(2);
                fileInfo.innerHTML = `
                    <div class="bg-gray-50 rounded-lg p-3 inline-block">
                        <p><strong>Nama file:</strong> ${file.name}</p>
                        <p><strong>Ukuran:</strong> ${fileSize} MB</p>
                        <p><strong>Format:</strong> ${file.type}</p>
                    </div>
                `;
            }
            reader.readAsDataURL(file);
        } else {
            preview.classList.add('hidden');
        }
    }

    function removeImage() {
        const input = document.getElementById('photo');
        const preview = document.getElementById('imagePreview');
        
        input.value = '';
        preview.classList.add('hidden');
    }

    // Auto-hide notifications
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-hide success notifications after 5 seconds
        const successNotifications = document.querySelectorAll('.bg-green-100');
        successNotifications.forEach(notification => {
            setTimeout(() => {
                notification.style.transition = 'opacity 0.5s ease-out';
                notification.style.opacity = '0';
                setTimeout(() => {
                    notification.remove();
                }, 500);
            }, 5000);
        });

        // Auto-hide error notifications after 8 seconds
        const errorNotifications = document.querySelectorAll('.bg-red-100');
        errorNotifications.forEach(notification => {
            setTimeout(() => {
                notification.style.transition = 'opacity 0.5s ease-out';
                notification.style.opacity = '0';
                setTimeout(() => {
                    notification.remove();
                }, 500);
            }, 8000);
        });
    });

    // Drag and drop functionality
    document.addEventListener('DOMContentLoaded', function() {
        const uploadArea = document.querySelector('.border-dashed');
        const fileInput = document.getElementById('photo');
        
        // Prevent default drag behaviors
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            uploadArea.addEventListener(eventName, preventDefaults, false);
            document.body.addEventListener(eventName, preventDefaults, false);
        });
        
        // Highlight drop area when item is dragged over it
        ['dragenter', 'dragover'].forEach(eventName => {
            uploadArea.addEventListener(eventName, highlight, false);
        });
        
        ['dragleave', 'drop'].forEach(eventName => {
            uploadArea.addEventListener(eventName, unhighlight, false);
        });
        
        // Handle dropped files
        uploadArea.addEventListener('drop', handleDrop, false);
        
        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }
        
        function highlight(e) {
            uploadArea.classList.add('border-[#185B3C]', 'bg-green-50');
        }
        
        function unhighlight(e) {
            uploadArea.classList.remove('border-[#185B3C]', 'bg-green-50');
        }
        
        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            
            if (files.length > 0) {
                fileInput.files = files;
                previewImage(fileInput);
            }
        }
        
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
