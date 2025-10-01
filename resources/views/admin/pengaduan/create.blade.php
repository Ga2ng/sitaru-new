@extends('layouts.app')

@section('title', 'Tambah Pengaduan')
@section('subtitle', 'Form pengaduan pemohon')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">
    <!-- Hero Section -->
    <div class="relative overflow-hidden bg-gradient-to-br from-[#185B3C] via-[#0F3D26] to-[#185B3C] rounded-xl p-6 text-white">
        <div class="absolute inset-0 bg-black/10"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold mb-1">Tambah Pengaduan</h1>
                    <p class="text-sm text-white/90 mb-4">Form pengaduan pemohon</p>
                </div>
                <div class="hidden lg:block">
                    <div class="w-20 h-20 bg-white/10 rounded-full flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-bullhorn text-3xl text-white/80"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -translate-y-16 translate-x-16"></div>
        <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full translate-y-12 -translate-x-12"></div>
    </div>

    <!-- Back Button -->
    <a href="{{ route('admin.pengaduan.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
        <i class="fas fa-arrow-left mr-2"></i>
        Kembali
    </a>

    <!-- Form -->
    <form method="POST" action="{{ route('admin.pengaduan.store') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        
        <!-- Data Pengaduan -->
        <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
            <div class="flex items-center space-x-3 mb-6">
                <div class="w-8 h-8 bg-gradient-to-br from-[#185B3C] to-[#0F3D26] rounded-lg flex items-center justify-center">
                    <i class="fas fa-user text-white text-sm"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900">Data Pengaduan</h3>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="nama_pengadu" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-user mr-2 text-[#185B3C]"></i>
                        Nama Pengadu <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="nama_pengadu" name="nama_pengadu" value="{{ old('nama_pengadu', $user->name) }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                           placeholder="Nama Pengadu" required>
                    @error('nama_pengadu')
                        <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                            <i class="fas fa-exclamation-circle text-xs"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="telp_pengadu" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-phone mr-2 text-[#185B3C]"></i>
                        No Telp <span class="text-red-500">*</span>
                    </label>
                    <input type="tel" id="telp_pengadu" name="telp_pengadu" value="{{ old('telp_pengadu', $user->phone) }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                           placeholder="081234567890" required>
                    @error('telp_pengadu')
                        <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                            <i class="fas fa-exclamation-circle text-xs"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="NO_KEC" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-map-signs mr-2 text-[#185B3C]"></i>
                        Kecamatan <span class="text-red-500">*</span>
                    </label>
                    <select id="NO_KEC" name="NO_KEC" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" required>
                        <option value="">-- Pilih Kecamatan --</option>
                        @foreach($kecamatan as $kec_id => $kec_nama)
                            <option value="{{ $kec_id }}">{{ $kec_nama }}</option>
                        @endforeach
                    </select>
                    @error('NO_KEC')
                        <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                            <i class="fas fa-exclamation-circle text-xs"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="NO_KEL" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-home mr-2 text-[#185B3C]"></i>
                        Desa/Kelurahan <span class="text-red-500">*</span>
                    </label>
                    <select id="NO_KEL" name="NO_KEL" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" required>
                        <option value="">-- Pilih Desa/Kelurahan --</option>
                        @foreach($kelurahan as $kel_id => $kel_nama)
                            <option value="{{ $kel_id }}">{{ $kel_nama }}</option>
                        @endforeach
                    </select>
                    @error('NO_KEL')
                        <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                            <i class="fas fa-exclamation-circle text-xs"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div class="space-y-2 md:col-span-2">
                    <label for="alamat" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-map-marker-alt mr-2 text-[#185B3C]"></i>
                        Alamat <span class="text-red-500">*</span>
                        <small class="text-gray-500">(Tambahkan patokan untuk memudahkan pencarian lokasi)</small>
                    </label>
                    <textarea id="alamat" name="alamat" rows="3" 
                              class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm resize-none" 
                              placeholder="Contoh: Jl. Nama Jalan No.123, Desa/Kelurahan, Kecamatan, Kabupaten (Dekat Masjid/Sekolah/Pasar)" required>{{ old('alamat', $user->address) }}</textarea>
                    @error('alamat')
                        <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                            <i class="fas fa-exclamation-circle text-xs"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Detail Pengaduan -->
        <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
            <div class="flex items-center space-x-3 mb-6">
                <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-clipboard-list text-white text-sm"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900">Detail Pengaduan</h3>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="kondisi" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-info-circle mr-2 text-blue-600"></i>
                        Kondisi Lahan <span class="text-red-500">*</span>
                    </label>
                    <select id="kondisi" name="kondisi" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" required>
                        <option value="">-- Pilih Kondisi --</option>
                        <option value="Lahan Kosong">Lahan Kosong</option>
                        <option value="Ada Bangunan">Ada Bangunan</option>
                        <option value="Proses Pembangunan">Proses Pembangunan</option>
                    </select>
                </div>

                <div class="space-y-2">
                    <label for="dampak" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-exclamation-triangle mr-2 text-blue-600"></i>
                        Kategori Dampak <span class="text-red-500">*</span>
                    </label>
                    <select id="dampak" name="dampak" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" required>
                        <option value="">-- Pilih Dampak --</option>
                        <option value="Mengganggu Jalan">Mengganggu Jalan</option>
                        <option value="Banjir">Banjir</option>
                        <option value="Menimbulkan Kebisingan">Menimbulkan Kebisingan</option>
                        <option value="Menggangu Saluran">Menggangu Saluran</option>
                        <option value="Bangunan Tidak Berizin">Bangunan Tidak Berizin</option>
                        <option value="Melanggar Sempadan Bangunan">Melanggar Sempadan Bangunan</option>
                    </select>
                </div>

                <div class="space-y-2 md:col-span-2">
                    <label for="uraian" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-align-left mr-2 text-blue-600"></i>
                        Uraian Pelaporan <span class="text-red-500">*</span>
                    </label>
                    <textarea id="uraian" name="uraian" rows="4" 
                              class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm resize-none" 
                              placeholder="Uraian lengkap pelaporan" required>{{ old('uraian') }}</textarea>
                    @error('uraian')
                        <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                            <i class="fas fa-exclamation-circle text-xs"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Foto Dokumentasi -->
        <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
            <div class="flex items-center space-x-3 mb-6">
                <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-camera text-white text-sm"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900">Foto Dokumentasi</h3>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @for($i = 1; $i <= 5; $i++)
                <div class="space-y-2">
                    <label for="foto_{{ $i }}" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-image mr-2 text-purple-600"></i>
                        Foto Lokasi {{ $i }}
                    </label>
                    <div class="relative">
                        <input type="file" id="foto_{{ $i }}" name="foto_{{ $i }}" accept="image/*" 
                               class="hidden" onchange="previewImage(this, {{ $i }})">
                        <label for="foto_{{ $i }}" class="flex items-center justify-center w-full px-4 py-3 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:border-purple-500 hover:bg-purple-50 transition-all duration-200">
                            <div class="text-center">
                                <i class="fas fa-cloud-upload-alt text-gray-400 text-2xl mb-2"></i>
                                <p class="text-sm text-gray-600">Klik untuk upload</p>
                                <p class="text-xs text-gray-400">Max 2MB (JPG, PNG)</p>
                            </div>
                        </label>
                        <div id="preview_{{ $i }}" class="mt-2 hidden">
                            <img src="" alt="Preview" class="w-full h-40 object-cover rounded-lg">
                        </div>
                    </div>
                    @error('foto_' . $i)
                        <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                            <i class="fas fa-exclamation-circle text-xs"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>
                @endfor
            </div>
        </div>

        <!-- Lokasi -->
        <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
            <div class="flex items-center space-x-3 mb-6">
                <div class="w-8 h-8 bg-gradient-to-br from-green-500 to-green-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-map-marked-alt text-white text-sm"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900">Lokasi</h3>
            </div>
            
            <div class="space-y-4">
                <button type="button" onclick="getLocation()" class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                    <i class="fas fa-location-arrow mr-2"></i>
                    Gunakan Lokasi Saya
                </button>
                <small class="block text-gray-500">Klik tombol di atas untuk menggunakan lokasi perangkat Anda saat ini</small>

                <input type="hidden" name="latitude" id="latitude" value="-8.218079">
                <input type="hidden" name="longitude" id="longitude" value="114.3290605">
                
                <div id="mapKu" class="w-full h-96 rounded-xl border border-gray-200"></div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-end space-x-4">
            <a href="{{ route('admin.pengaduan.index') }}" class="px-6 py-3 text-gray-700 bg-gray-100 hover:bg-gray-200 font-semibold rounded-xl transition-colors duration-200">
                <i class="fas fa-times mr-2"></i>
                Batal
            </a>
            <button type="submit" class="px-6 py-3 bg-gradient-to-r from-[#185B3C] to-[#0F3D26] text-white font-semibold rounded-xl hover:shadow-lg transform hover:scale-105 transition-all duration-200">
                <i class="fas fa-save mr-2"></i>
                Simpan Pengaduan
            </button>
        </div>
    </form>
</div>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

<script>
    // Initialize map
    var latlngku = [-8.218079, 114.3290605];
    var mapku = L.map('mapKu').setView(latlngku, 13);
    
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors',
        maxZoom: 19
    }).addTo(mapku);

    var marker = L.marker(latlngku, { draggable: true }).addTo(mapku);

    marker.on('dragend', function(e) {
        var position = marker.getLatLng();
        document.getElementById('latitude').value = position.lat;
        document.getElementById('longitude').value = position.lng;
    });

    mapku.on('click', function(e) {
        marker.setLatLng(e.latlng);
        document.getElementById('latitude').value = e.latlng.lat;
        document.getElementById('longitude').value = e.latlng.lng;
    });

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var lat = position.coords.latitude;
                var lng = position.coords.longitude;
                
                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lng;
                
                var newLatLng = new L.LatLng(lat, lng);
                marker.setLatLng(newLatLng);
                mapku.setView(newLatLng, 16);
                
                alert('Lokasi berhasil diambil!');
            }, function(error) {
                alert('Gagal mengambil lokasi: ' + error.message);
            });
        } else {
            alert('Geolocation tidak didukung oleh browser ini');
        }
    }

    function previewImage(input, index) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview_' + index).classList.remove('hidden');
                document.getElementById('preview_' + index).querySelector('img').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

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

