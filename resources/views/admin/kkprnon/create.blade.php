@extends('layouts.app')

@section('title', 'Buat KKPR Non Berusaha')
@section('subtitle', 'Form penilaian KKPR terbit otomatis')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">
    <!-- Hero Section -->
    <div class="relative overflow-hidden bg-gradient-to-br from-[#185B3C] via-[#0F3D26] to-[#185B3C] rounded-xl p-6 text-white">
        <div class="absolute inset-0 bg-black/10"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold mb-1">Buat KKPR Non Berusaha</h1>
                    <p class="text-sm text-white/90 mb-4">Form penilaian KKPR terbit otomatis</p>
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

    <!-- Back Button -->
    <a href="{{ route('admin.kkprnon.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
        <i class="fas fa-arrow-left mr-2"></i>
        Kembali
    </a>

    <!-- Form -->
    <form method="POST" action="{{ route('admin.kkprnon.store') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        
        <!-- Informasi Pemohon -->
        <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
            <div class="flex items-center space-x-3 mb-6">
                <div class="w-8 h-8 bg-gradient-to-br from-[#185B3C] to-[#0F3D26] rounded-lg flex items-center justify-center">
                    <i class="fas fa-user text-white text-sm"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900">Informasi Pemohon</h3>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="nama_pemohon" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-user mr-2 text-[#185B3C]"></i>
                        Nama Lengkap <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="nama_pemohon" name="nama_pemohon" value="{{ old('nama_pemohon') }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                           placeholder="Masukkan nama lengkap" required>
                    @error('nama_pemohon')
                        <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                            <i class="fas fa-exclamation-circle text-xs"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="nik_pemohon" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-id-card mr-2 text-[#185B3C]"></i>
                        NIK <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="nik_pemohon" name="nik_pemohon" value="{{ old('nik_pemohon') }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                           placeholder="Masukkan NIK" maxlength="16" required>
                </div>

                <div class="space-y-2">
                    <label for="no_telp" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-phone mr-2 text-[#185B3C]"></i>
                        No. Telepon <span class="text-red-500">*</span>
                    </label>
                    <input type="tel" id="no_telp" name="no_telp" value="{{ old('no_telp') }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                           placeholder="Masukkan nomor telepon" required>
                </div>

                <div class="space-y-2">
                    <label for="pekerjaan_pemohon" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-briefcase mr-2 text-[#185B3C]"></i>
                        Pekerjaan <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="pekerjaan_pemohon" name="pekerjaan_pemohon" value="{{ old('pekerjaan_pemohon') }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                           placeholder="Masukkan pekerjaan" required>
                </div>

                <div class="space-y-2 md:col-span-2">
                    <label for="alamat_pemohon" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-map-marker-alt mr-2 text-[#185B3C]"></i>
                        Alamat <span class="text-red-500">*</span>
                    </label>
                    <textarea id="alamat_pemohon" name="alamat_pemohon" rows="3" 
                              class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm resize-none" 
                              placeholder="Masukkan alamat lengkap" required>{{ old('alamat_pemohon') }}</textarea>
                </div>
            </div>
        </div>

        <!-- Informasi Tanah -->
        <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
            <div class="flex items-center space-x-3 mb-6">
                <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-map-marker-alt text-white text-sm"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900">Informasi Tanah</h3>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2 md:col-span-2">
                    <label for="alamat_tanah" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-map mr-2 text-blue-600"></i>
                        Alamat Tanah <span class="text-red-500">*</span>
                    </label>
                    <textarea id="alamat_tanah" name="alamat_tanah" rows="3" 
                              class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm resize-none" 
                              placeholder="Masukkan alamat tanah" required>{{ old('alamat_tanah') }}</textarea>
                </div>

                <div class="space-y-2">
                    <label for="kabupaten_id" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-building mr-2 text-blue-600"></i>
                        Kabupaten <span class="text-red-500">*</span>
                    </label>
                    <select id="kabupaten_id" name="kabupaten_id" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" required>
                        <option value="">Pilih Kabupaten</option>
                        @foreach($kabupaten as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="space-y-2">
                    <label for="kecamatan_id" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-map-signs mr-2 text-blue-600"></i>
                        Kecamatan <span class="text-red-500">*</span>
                    </label>
                    <select id="kecamatan_id" name="kecamatan_id" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" required>
                        <option value="">Pilih Kecamatan</option>
                        @foreach($kecamatan as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="space-y-2">
                    <label for="kelurahan_id" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-home mr-2 text-blue-600"></i>
                        Kelurahan <span class="text-red-500">*</span>
                    </label>
                    <select id="kelurahan_id" name="kelurahan_id" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" required>
                        <option value="">Pilih Kelurahan</option>
                        @foreach($kelurahan as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="space-y-2">
                    <label for="luas" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-ruler-combined mr-2 text-blue-600"></i>
                        Luas Tanah (m²) <span class="text-red-500">*</span>
                    </label>
                    <input type="number" id="luas" name="luas" value="{{ old('luas') }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                           placeholder="Masukkan luas tanah" required>
                </div>

                <div class="space-y-2">
                    <label for="rt" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-map-pin mr-2 text-blue-600"></i>
                        RT
                    </label>
                    <input type="text" id="rt" name="rt" value="{{ old('rt') }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                           placeholder="Masukkan RT">
                </div>

                <div class="space-y-2">
                    <label for="rw" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-map-pin mr-2 text-blue-600"></i>
                        RW
                    </label>
                    <input type="text" id="rw" name="rw" value="{{ old('rw') }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                           placeholder="Masukkan RW">
                </div>
            </div>
        </div>

        <!-- Informasi Kegiatan -->
        <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
            <div class="flex items-center space-x-3 mb-6">
                <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-building text-white text-sm"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900">Informasi Kegiatan</h3>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="fungsi" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-tag mr-2 text-purple-600"></i>
                        Fungsi <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="fungsi" name="fungsi" value="{{ old('fungsi') }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                           placeholder="Masukkan fungsi" required>
                </div>

                <div class="space-y-2">
                    <label for="nib" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-file-alt mr-2 text-purple-600"></i>
                        NIB
                    </label>
                    <input type="text" id="nib" name="nib" value="{{ old('nib') }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                           placeholder="Masukkan NIB">
                </div>

                <div class="space-y-2 md:col-span-2">
                    <label for="alamat_kegiatan" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-map mr-2 text-purple-600"></i>
                        Alamat Kegiatan
                    </label>
                    <textarea id="alamat_kegiatan" name="alamat_kegiatan" rows="3" 
                              class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm resize-none" 
                              placeholder="Masukkan alamat kegiatan">{{ old('alamat_kegiatan') }}</textarea>
                </div>

                <div class="space-y-2">
                    <label for="luas_dimohon" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-ruler mr-2 text-purple-600"></i>
                        Luas Dimohon (m²)
                    </label>
                    <input type="number" id="luas_dimohon" name="luas_dimohon" value="{{ old('luas_dimohon') }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                           placeholder="Masukkan luas dimohon">
                </div>

                <div class="space-y-2">
                    <label for="jumlah_lantai" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-layer-group mr-2 text-purple-600"></i>
                        Jumlah Lantai
                    </label>
                    <input type="number" id="jumlah_lantai" name="jumlah_lantai" value="{{ old('jumlah_lantai') }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                           placeholder="Masukkan jumlah lantai">
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-end space-x-4">
            <a href="{{ route('admin.kkprnon.index') }}" class="px-6 py-3 text-gray-700 bg-gray-100 hover:bg-gray-200 font-semibold rounded-xl transition-colors duration-200">
                <i class="fas fa-times mr-2"></i>
                Batal
            </a>
            <button type="submit" class="px-6 py-3 bg-gradient-to-r from-[#185B3C] to-[#0F3D26] text-white font-semibold rounded-xl hover:shadow-lg transform hover:scale-105 transition-all duration-200">
                <i class="fas fa-save mr-2"></i>
                Simpan Permohonan
            </button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
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

