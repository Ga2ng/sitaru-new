@extends('layouts.app')

@section('title', 'Buat Permohonan KKPR Non Usaha')
@section('subtitle', 'Formulir Permohonan KKPR Non Usaha')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">
    <!-- Header -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Buat Permohonan KKPR Non Usaha</h1>
                <p class="text-gray-600">Lengkapi formulir di bawah ini untuk membuat permohonan baru</p>
            </div>
            <a href="{{ route('member.kkprnon.index') }}" class="flex items-center px-4 py-2 text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali
            </a>
        </div>
    </div>

    <!-- Form -->
    <form action="{{ route('member.kkprnon.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        
        <!-- Data Pemohon -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                <i class="fas fa-user mr-2 text-[#185B3C]"></i>
                Data Pemohon
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap *</label>
                    <input type="text" name="nama_pemohon" value="{{ old('nama_pemohon', auth()->user()->name) }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">NIK *</label>
                    <input type="text" name="nik_pemohon" value="{{ old('nik_pemohon', auth()->user()->nik) }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                    <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">No. Telepon *</label>
                    <input type="text" name="no_telp" value="{{ old('no_telp', auth()->user()->phone) }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Pekerjaan</label>
                    <input type="text" name="pekerjaan_pemohon" value="{{ old('pekerjaan_pemohon', auth()->user()->work) }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Alamat *</label>
                    <textarea name="alamat_pemohon" rows="3" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent" required>{{ old('alamat_pemohon', auth()->user()->address) }}</textarea>
                </div>
            </div>
        </div>

        <!-- Data Tanah -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                <i class="fas fa-map-marker-alt mr-2 text-[#185B3C]"></i>
                Data Tanah
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Tanah *</label>
                    <textarea name="alamat_tanah" rows="3" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent" required>{{ old('alamat_tanah') }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Luas Tanah (m²) *</label>
                    <input type="number" name="luas" value="{{ old('luas') }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">RT/RW</label>
                    <div class="flex space-x-2">
                        <input type="text" name="rt" placeholder="RT" value="{{ old('rt') }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent">
                        <input type="text" name="rw" placeholder="RW" value="{{ old('rw') }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status Penggunaan Tanah</label>
                    <select name="status_penggunaan_tanah" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent">
                        <option value="">Pilih Status</option>
                        <option value="Hak Milik" {{ old('status_penggunaan_tanah') == 'Hak Milik' ? 'selected' : '' }}>Hak Milik</option>
                        <option value="Hak Guna Bangunan" {{ old('status_penggunaan_tanah') == 'Hak Guna Bangunan' ? 'selected' : '' }}>Hak Guna Bangunan</option>
                        <option value="Hak Pakai" {{ old('status_penggunaan_tanah') == 'Hak Pakai' ? 'selected' : '' }}>Hak Pakai</option>
                        <option value="Sewa" {{ old('status_penggunaan_tanah') == 'Sewa' ? 'selected' : '' }}>Sewa</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Koordinat</label>
                    <div class="flex space-x-2">
                        <input type="text" name="longitude" placeholder="Longitude" value="{{ old('longitude') }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent">
                        <input type="text" name="lattitude" placeholder="Latitude" value="{{ old('lattitude') }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent">
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Kegiatan -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                <i class="fas fa-building mr-2 text-[#185B3C]"></i>
                Data Kegiatan
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kegiatan *</label>
                    <select name="jenis_kegiatan" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent" required>
                        <option value="">Pilih Jenis Kegiatan</option>
                        <option value="Rumah Tinggal" {{ old('jenis_kegiatan') == 'Rumah Tinggal' ? 'selected' : '' }}>Rumah Tinggal</option>
                        <option value="Rumah Ibadah" {{ old('jenis_kegiatan') == 'Rumah Ibadah' ? 'selected' : '' }}>Rumah Ibadah</option>
                        <option value="Fasilitas Umum" {{ old('jenis_kegiatan') == 'Fasilitas Umum' ? 'selected' : '' }}>Fasilitas Umum</option>
                        <option value="Lainnya" {{ old('jenis_kegiatan') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Fungsi *</label>
                    <input type="text" name="fungsi" value="{{ old('fungsi') }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent" required>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Kegiatan *</label>
                    <textarea name="alamat_kegiatan" rows="3" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent" required>{{ old('alamat_kegiatan') }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Luas Dimohon (m²) *</label>
                    <input type="number" name="luas_dimohon" value="{{ old('luas_dimohon') }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status Lahan</label>
                    <select name="status_lahan" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent">
                        <option value="">Pilih Status Lahan</option>
                        <option value="Kosong" {{ old('status_lahan') == 'Kosong' ? 'selected' : '' }}>Kosong</option>
                        <option value="Berbangunan" {{ old('status_lahan') == 'Berbangunan' ? 'selected' : '' }}>Berbangunan</option>
                        <option value="Lahan Pertanian" {{ old('status_lahan') == 'Lahan Pertanian' ? 'selected' : '' }}>Lahan Pertanian</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Data Bangunan -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                <i class="fas fa-home mr-2 text-[#185B3C]"></i>
                Data Bangunan
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah Lantai</label>
                    <input type="number" name="jumlah_lantai" value="{{ old('jumlah_lantai') }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tinggi Bangunan (m)</label>
                    <input type="number" step="0.1" name="tinggi_bangunan" value="{{ old('tinggi_bangunan') }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent">
                </div>
            </div>
        </div>

        <!-- Data Sertifikat -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                <i class="fas fa-certificate mr-2 text-[#185B3C]"></i>
                Data Sertifikat
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Sertifikat</label>
                    <select name="jns_sertifikat" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent">
                        <option value="">Pilih Jenis Sertifikat</option>
                        <option value="SHM" {{ old('jns_sertifikat') == 'SHM' ? 'selected' : '' }}>SHM</option>
                        <option value="HGB" {{ old('jns_sertifikat') == 'HGB' ? 'selected' : '' }}>HGB</option>
                        <option value="HP" {{ old('jns_sertifikat') == 'HP' ? 'selected' : '' }}>HP</option>
                        <option value="Girik" {{ old('jns_sertifikat') == 'Girik' ? 'selected' : '' }}>Girik</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">No. Sertifikat</label>
                    <input type="text" name="no_sertifikat" value="{{ old('no_sertifikat') }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Atas Nama</label>
                    <input type="text" name="an_sertifikat" value="{{ old('an_sertifikat') }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tahun Sertifikat</label>
                    <input type="number" name="thn_sertifikat" value="{{ old('thn_sertifikat') }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Luas Sertifikat (m²)</label>
                    <input type="number" name="luas_sertifikat" value="{{ old('luas_sertifikat') }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent">
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6">
            <div class="flex justify-end space-x-4">
                <a href="{{ route('member.kkprnon.index') }}" 
                   class="px-6 py-2 text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                    Batal
                </a>
                <button type="submit" 
                        class="px-6 py-2 bg-gradient-to-r from-[#185B3C] to-[#0F3D26] text-white rounded-lg hover:shadow-lg transition-all duration-300">
                    <i class="fas fa-save mr-2"></i>
                    Simpan Permohonan
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
