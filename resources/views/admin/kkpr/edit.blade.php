@extends('layouts.app')

@section('title', 'Edit Permohonan KKPR - ' . $model->id)
@section('subtitle', 'Edit form pengajuan kesesuaian pemanfaatan ruang')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">
    <!-- Hero Section with Gradient -->
    <div class="relative overflow-hidden bg-gradient-to-br from-[#185B3C] via-[#0F3D26] to-[#185B3C] rounded-xl p-6 text-white">
        <div class="absolute inset-0 bg-black/10"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold mb-1">Edit Permohonan KKPR #{{ $model->id }}</h1>
                    <p class="text-sm text-white/90 mb-4">Edit form pengajuan kesesuaian pemanfaatan ruang</p>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                            <span class="text-xs">Form Aktif</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-edit text-xs"></i>
                            <span class="text-xs">Edit data</span>
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
        <!-- Decorative Elements -->
        <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -translate-y-16 translate-x-16"></div>
        <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full translate-y-12 -translate-x-12"></div>
    </div>

    <!-- Action Buttons -->
    <div class="flex flex-wrap gap-4">
        <a href="{{ route('admin.kkpr.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali
        </a>
        <a href="{{ route('admin.kkpr.show', $model->id) }}" class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
            <i class="fas fa-eye mr-2"></i>
            Lihat Detail
        </a>
    </div>

    <!-- Notifications -->
    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4 flex items-center justify-between" role="alert">
        <div class="flex items-center">
            <i class="fas fa-check-circle mr-2"></i>
            <span>{{ session('success') }}</span>
        </div>
        <button type="button" onclick="this.parentElement.style.display='none'" class="text-green-700 hover:text-green-900">
            <i class="fas fa-times"></i>
        </button>
    </div>
    @endif

    @if(session('error') || $errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4" role="alert">
        <div class="flex items-center justify-between mb-2">
            <div class="flex items-center">
                <i class="fas fa-exclamation-circle mr-2"></i>
                <strong>Terjadi kesalahan:</strong>
            </div>
            <button type="button" onclick="this.parentElement.parentElement.style.display='none'" class="text-red-700 hover:text-red-900">
                <i class="fas fa-times"></i>
            </button>
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

    <!-- Form -->
    <form method="POST" action="{{ route('admin.kkpr.update', $model->id) }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        
        <!-- Informasi Pemohon -->
        <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
            <div class="flex items-center space-x-3 mb-6">
                <div class="w-8 h-8 bg-gradient-to-br from-[#185B3C] to-[#0F3D26] rounded-lg flex items-center justify-center">
                    <i class="fas fa-user text-white text-sm"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900">PEMOHON</h3>
            </div>
            
            @php
                $hasUser = isset($model->user_id) && $model->user_id && isset($model->user) && $model->user;
                $isReadonly = $hasUser;
            @endphp
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="nik_pemohon" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-id-card mr-2 text-[#185B3C]"></i>
                        NIK Pemohon <span class="text-red-500">*</span>
                    </label>
                    <div class="flex space-x-2">
                        <input type="text" id="nik_pemohon" name="nik_pemohon" value="{{ old('nik_pemohon', optional($model->user)->nik ?? '') }}" 
                               class="flex-1 px-4 py-3 border {{ $isReadonly ? 'border-gray-300 bg-gray-100 cursor-not-allowed' : 'border-gray-200 bg-white/80' }} rounded-xl focus:outline-none focus:ring-2 {{ $isReadonly ? 'focus:ring-gray-400' : 'focus:ring-[#185B3C]' }} focus:border-transparent transition-all duration-200 backdrop-blur-sm" 
                               placeholder="3512345678910123" maxlength="16" required {{ $isReadonly ? 'readonly' : '' }}
                               oninput="{{ !$isReadonly ? "this.value = this.value.replace(/[^0-9]/g, '')" : '' }}"
                               onkeypress="{{ !$isReadonly ? "return event.charCode >= 48 && event.charCode <= 57" : '' }}">
                        <button type="button" id="kadasa" class="px-4 py-3 {{ $isReadonly ? 'bg-gray-400 cursor-not-allowed' : 'bg-[#185B3C] hover:bg-[#0F3D26]' }} text-white rounded-xl transition-colors" {{ $isReadonly ? 'disabled' : '' }}>
                            Cek NIK
                        </button>
                    </div>
                    @error('nik_pemohon')
                        <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                            <i class="fas fa-exclamation-circle text-xs"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="nama_pemohon" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-user mr-2 text-[#185B3C]"></i>
                        Nama Pelaku Usaha <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="nama_pemohon" name="nama_pemohon" value="{{ old('nama_pemohon', optional($model->user)->name ?? '') }}" 
                           class="w-full px-4 py-3 border {{ $isReadonly ? 'border-gray-300 bg-gray-100 cursor-not-allowed' : 'border-gray-200 bg-white/80' }} rounded-xl focus:outline-none focus:ring-2 {{ $isReadonly ? 'focus:ring-gray-400' : 'focus:ring-[#185B3C]' }} focus:border-transparent transition-all duration-200 backdrop-blur-sm" 
                           placeholder="Nama Pelaku Usaha" required {{ $isReadonly ? 'readonly' : '' }}>
                    @error('nama_pemohon')
                        <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                            <i class="fas fa-exclamation-circle text-xs"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="pekerjaan_pemohon" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-briefcase mr-2 text-[#185B3C]"></i>
                        Pekerjaan Pemohon <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="pekerjaan_pemohon" name="pekerjaan_pemohon" value="{{ old('pekerjaan_pemohon', optional($model->user)->work ?? '') }}" 
                           class="w-full px-4 py-3 border {{ $isReadonly ? 'border-gray-300 bg-gray-100 cursor-not-allowed' : 'border-gray-200 bg-white/80' }} rounded-xl focus:outline-none focus:ring-2 {{ $isReadonly ? 'focus:ring-gray-400' : 'focus:ring-[#185B3C]' }} focus:border-transparent transition-all duration-200 backdrop-blur-sm" 
                           placeholder="Pekerjaan Pemohon" required {{ $isReadonly ? 'readonly' : '' }}>
                    @error('pekerjaan_pemohon')
                        <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                            <i class="fas fa-exclamation-circle text-xs"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="tgl_surat" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-calendar mr-2 text-[#185B3C]"></i>
                        Tanggal Permohonan <span class="text-red-500">*</span>
                    </label>
                    <input type="date" id="tgl_surat" name="tgl_surat" value="{{ old('tgl_surat', $model->tgl_surat ?? date('Y-m-d')) }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                           required>
                    @error('tgl_surat')
                        <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                            <i class="fas fa-exclamation-circle text-xs"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="no_telp" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-phone mr-2 text-[#185B3C]"></i>
                        No HP <span class="text-red-500">*</span>
                    </label>
                    <input type="tel" id="no_telp" name="no_telp" value="{{ old('no_telp', optional($model->user)->phone ?? '') }}" 
                           class="w-full px-4 py-3 border {{ $isReadonly ? 'border-gray-300 bg-gray-100 cursor-not-allowed' : 'border-gray-200 bg-white/80' }} rounded-xl focus:outline-none focus:ring-2 {{ $isReadonly ? 'focus:ring-gray-400' : 'focus:ring-[#185B3C]' }} focus:border-transparent transition-all duration-200 backdrop-blur-sm" 
                           placeholder="081234567890" required {{ $isReadonly ? 'readonly' : '' }}
                           oninput="{{ !$isReadonly ? "this.value = this.value.replace(/[^0-9]/g, '')" : '' }}"
                           onkeypress="{{ !$isReadonly ? "return event.charCode >= 48 && event.charCode <= 57" : '' }}">
                    @error('no_telp')
                        <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                            <i class="fas fa-exclamation-circle text-xs"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="email" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-envelope mr-2 text-[#185B3C]"></i>
                        Alamat Email
                    </label>
                    <input type="email" id="email" name="email" value="{{ old('email', optional($model->user)->email ?? '') }}" 
                           class="w-full px-4 py-3 border {{ $isReadonly ? 'border-gray-300 bg-gray-100 cursor-not-allowed' : 'border-gray-200 bg-white/80' }} rounded-xl focus:outline-none focus:ring-2 {{ $isReadonly ? 'focus:ring-gray-400' : 'focus:ring-[#185B3C]' }} focus:border-transparent transition-all duration-200 backdrop-blur-sm" 
                           placeholder="alamat@email.com" {{ $isReadonly ? 'readonly' : '' }}>
                    @error('email')
                        <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                            <i class="fas fa-exclamation-circle text-xs"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div class="space-y-2 md:col-span-2">
                    <label for="alamat_pemohon" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-map-marker-alt mr-2 text-[#185B3C]"></i>
                        Alamat Pemohon
                    </label>
                    <textarea id="alamat_pemohon" name="alamat_pemohon" rows="3" 
                              class="w-full px-4 py-3 border {{ $isReadonly ? 'border-gray-300 bg-gray-100 cursor-not-allowed' : 'border-gray-200 bg-white/80' }} rounded-xl focus:outline-none focus:ring-2 {{ $isReadonly ? 'focus:ring-gray-400' : 'focus:ring-[#185B3C]' }} focus:border-transparent transition-all duration-200 backdrop-blur-sm resize-none" 
                              placeholder="Jl. Nama Jalan, Desa/Kelurahan, Kecamatan, Kabupaten" required {{ $isReadonly ? 'readonly' : '' }}>{{ old('alamat_pemohon', optional($model->user)->address ?? '') }}</textarea>
                    @error('alamat_pemohon')
                        <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                            <i class="fas fa-exclamation-circle text-xs"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Data Kegiatan -->
        <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
            <div class="flex items-center space-x-3 mb-6">
                <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-building text-white text-sm"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900">DATA KEGIATAN</h3>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="space-y-2">
                    <label for="fungsi" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-tag mr-2 text-purple-600"></i>
                        Fungsi Kegiatan Pemanfaatan Ruang <span class="text-red-500">*</span>
                    </label>
                    <textarea id="fungsi" name="fungsi" rows="3" 
                              class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm resize-none" 
                              placeholder="Fungsi Kegiatan Pemanfaatan Ruang Nantinya Untuk.." required>{{ old('fungsi', $model->fungsi) }}</textarea>
                    @error('fungsi')
                        <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                            <i class="fas fa-exclamation-circle text-xs"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="alamat_kegiatan" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-map mr-2 text-purple-600"></i>
                        Lokasi Kegiatan Usaha <span class="text-red-500">*</span>
                    </label>
                    <textarea id="alamat_kegiatan" name="alamat_kegiatan" rows="3" 
                              class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm resize-none" 
                              placeholder="Jl. Nama Jalan" required>{{ old('alamat_kegiatan', $model->alamat_kegiatan) }}</textarea>
                    @error('alamat_kegiatan')
                        <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                            <i class="fas fa-exclamation-circle text-xs"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="NO_KEC" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-map-signs mr-2 text-purple-600"></i>
                        Kecamatan <span class="text-red-500">*</span>
                    </label>
                    <select id="NO_KEC" name="NO_KEC" 
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" required>
                        <option value="">-- Pilih Kecamatan --</option>
                        @foreach($kecamatan as $id => $name)
                            <option value="{{ $id }}" {{ old('NO_KEC', $model->NO_KEC) == $id ? 'selected' : '' }}>{{ $name }}</option>
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
                        <i class="fas fa-home mr-2 text-purple-600"></i>
                        Desa/Kelurahan <span class="text-red-500">*</span>
                    </label>
                    <select id="NO_KEL" name="NO_KEL" 
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" required>
                        <option value="">-- Pilih Desa/Kelurahan --</option>
                        @foreach($kelurahan as $id => $name)
                            <option value="{{ $id }}" {{ old('NO_KEL', $model->NO_KEL) == $id ? 'selected' : '' }}>{{ $name }}</option>
                        @endforeach
                    </select>
                    @error('NO_KEL')
                        <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                            <i class="fas fa-exclamation-circle text-xs"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="status_lahan" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-landmark mr-2 text-purple-600"></i>
                        Status Lahan <span class="text-red-500">*</span>
                    </label>
                    @php
                        $statusLahanOptions = ['Milik sendiri', 'Jual Beli', 'Sewa', 'Pinjam Pakai', 'Dokumen penguasaan lainnya'];
                        $currentStatusLahan = old('status_lahan', $model->status_lahan);
                        $isCustomStatusLahan = !in_array($currentStatusLahan, $statusLahanOptions) && $currentStatusLahan != null && $currentStatusLahan != '';
                    @endphp
                    <select id="status_lahan" name="status_lahan" 
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                            onchange="toggleStatusLahanLainnya(this.value)" required>
                        <option value="">-- Pilih Status Lahan --</option>
                        <option value="Milik sendiri" {{ $currentStatusLahan == 'Milik sendiri' ? 'selected' : '' }}>Milik sendiri</option>
                        <option value="Jual Beli" {{ $currentStatusLahan == 'Jual Beli' ? 'selected' : '' }}>Jual Beli</option>
                        <option value="Sewa" {{ $currentStatusLahan == 'Sewa' ? 'selected' : '' }}>Sewa</option>
                        <option value="Pinjam Pakai" {{ $currentStatusLahan == 'Pinjam Pakai' ? 'selected' : '' }}>Pinjam Pakai</option>
                        <option value="Dokumen penguasaan lainnya" {{ $isCustomStatusLahan || $currentStatusLahan == 'Dokumen penguasaan lainnya' ? 'selected' : '' }}>Dokumen penguasaan lainnya</option>
                    </select>
                    @error('status_lahan')
                        <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                            <i class="fas fa-exclamation-circle text-xs"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <!-- Dynamic Field untuk Dokumen penguasaan lainnya -->
                <div id="status_lahan_lainnya" class="space-y-2" style="display:{{ $isCustomStatusLahan || $currentStatusLahan == 'Dokumen penguasaan lainnya' ? 'block' : 'none' }};">
                    <label for="status_lahan_lainnya_input" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-file-alt mr-2 text-purple-600"></i>
                        Dokumen Penguasaan Lainnya <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="status_lahan_lainnya_input" name="status_lahan_lainnya_input" 
                           value="{{ old('status_lahan_lainnya_input', $isCustomStatusLahan ? $model->status_lahan : '') }}"
                           placeholder="Masukkan jenis dokumen penguasaan lainnya"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm">
                    @error('status_lahan_lainnya_input')
                        <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                            <i class="fas fa-exclamation-circle text-xs"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="status_penggunaan_tanah" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-home mr-2 text-purple-600"></i>
                        Kondisi Lahan Eksisting <span class="text-red-500">*</span>
                    </label>
                    <select id="status_penggunaan_tanah" name="status_penggunaan_tanah" 
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                            onchange="togglePenggunaanSekarang(this.value)" required>
                        <option value="">-- Pilih Kondisi Lahan Eksisting --</option>
                        <option value="Sudah Terbangun" {{ old('status_penggunaan_tanah', $model->status_penggunaan_tanah) == 'Sudah Terbangun' ? 'selected' : '' }}>Sudah Terbangun</option>
                        <option value="Proses Pembangunan" {{ old('status_penggunaan_tanah', $model->status_penggunaan_tanah) == 'Proses Pembangunan' ? 'selected' : '' }}>Proses Pembangunan</option>
                        <option value="Kosong" {{ old('status_penggunaan_tanah', $model->status_penggunaan_tanah) == 'Kosong' ? 'selected' : '' }}>Kosong</option>
                        <option value="Terdapat Bangunan Lain" {{ old('status_penggunaan_tanah', $model->status_penggunaan_tanah) == 'Terdapat Bangunan Lain' ? 'selected' : '' }}>Terdapat Bangunan Lain</option>
                        <option value="Terdapat Bangunan Lain (Akan dilakukan pembongkaran)" {{ old('status_penggunaan_tanah', $model->status_penggunaan_tanah) == 'Terdapat Bangunan Lain (Akan dilakukan pembongkaran)' ? 'selected' : '' }}>Terdapat Bangunan Lain (Akan dilakukan pembongkaran)</option>
                    </select>
                    @error('status_penggunaan_tanah')
                        <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                            <i class="fas fa-exclamation-circle text-xs"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="jenis_kegiatan" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-industry mr-2 text-purple-600"></i>
                        Jenis Kegiatan <span class="text-red-500">*</span>
                    </label>
                    @php
                        $jenisKegiatanOptions = [
                            'Pertanian, Kehutanan, dan Perikanan',
                            'Pertambangan dan Penggalian',
                            'Industri pengolahan',
                            'Pengadaan Listrik, Gas, Uap/Air Panas dan Udara Dingin',
                            'Treatment Air, Treatment Air Limbah, Treatment dan Pemulihan Material Sampah, dan Aktivitas Remediasi',
                            'Konstruksi',
                            'Perdagangan Besar dan Eceran, Reparasi dan Perawatan Mobil dan Sepeda Motor',
                            'Pengangkutan dan Pergudangan',
                            'Penyediaan Akomodasi dan Penyediaan Makan Minum',
                            'Informasi dan Komunikasi',
                            'Aktivitas Keuangan dan Asuransi',
                            'Real Estat',
                            'Aktivitas Profesional, Ilmiah dan Teknis',
                            'Aktivitas Penyewaan dan Sewa Guna Usaha Tanpa Hak Opsi, Keterangakerjaan, Agen Perjalanan dan Penunjang Usaha Lainnya',
                            'Administrasi Pemerintahan, Pertanahan dan Jaminan Sosial Wajib',
                            'Pendidikan',
                            'Aktivitas Kesehatan Manusia dan Aktivitas Sosial',
                            'Kesenian, Hiburan dan Rekreasi',
                            'Aktivitas Jasa Lainnya',
                            'Aktivitas Rumah Tangga Sebagai Pemberi Kerja',
                            'Aktivitas Badan Internasioanl dan Badan Ekstra Internasional Lainnya',
                            'Lainnya'
                        ];
                        $currentJenisKegiatan = old('jenis_kegiatan', $model->jenis_kegiatan);
                        $isCustomJenisKegiatan = !in_array($currentJenisKegiatan, $jenisKegiatanOptions) && $currentJenisKegiatan != null && $currentJenisKegiatan != '';
                    @endphp
                    <select id="jenis_kegiatan" name="jenis_kegiatan" 
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" required
                            onchange="toggleJenisLainnya(this.value)">
                        <option value="">-- Pilih Jenis Kegiatan --</option>
                        <option value="Pertanian, Kehutanan, dan Perikanan" {{ $currentJenisKegiatan == 'Pertanian, Kehutanan, dan Perikanan' ? 'selected' : '' }}>Pertanian, Kehutanan, dan Perikanan</option>
                        <option value="Pertambangan dan Penggalian" {{ $currentJenisKegiatan == 'Pertambangan dan Penggalian' ? 'selected' : '' }}>Pertambangan dan Penggalian</option>
                        <option value="Industri pengolahan" {{ $currentJenisKegiatan == 'Industri pengolahan' ? 'selected' : '' }}>Industri pengolahan</option>
                        <option value="Pengadaan Listrik, Gas, Uap/Air Panas dan Udara Dingin" {{ $currentJenisKegiatan == 'Pengadaan Listrik, Gas, Uap/Air Panas dan Udara Dingin' ? 'selected' : '' }}>Pengadaan Listrik, Gas, Uap/Air Panas dan Udara Dingin</option>
                        <option value="Treatment Air, Treatment Air Limbah, Treatment dan Pemulihan Material Sampah, dan Aktivitas Remediasi" {{ $currentJenisKegiatan == 'Treatment Air, Treatment Air Limbah, Treatment dan Pemulihan Material Sampah, dan Aktivitas Remediasi' ? 'selected' : '' }}>Treatment Air, Treatment Air Limbah, Treatment dan Pemulihan Material Sampah, dan Aktivitas Remediasi</option>
                        <option value="Konstruksi" {{ $currentJenisKegiatan == 'Konstruksi' ? 'selected' : '' }}>Konstruksi</option>
                        <option value="Perdagangan Besar dan Eceran, Reparasi dan Perawatan Mobil dan Sepeda Motor" {{ $currentJenisKegiatan == 'Perdagangan Besar dan Eceran, Reparasi dan Perawatan Mobil dan Sepeda Motor' ? 'selected' : '' }}>Perdagangan Besar dan Eceran, Reparasi dan Perawatan Mobil dan Sepeda Motor</option>
                        <option value="Pengangkutan dan Pergudangan" {{ $currentJenisKegiatan == 'Pengangkutan dan Pergudangan' ? 'selected' : '' }}>Pengangkutan dan Pergudangan</option>
                        <option value="Penyediaan Akomodasi dan Penyediaan Makan Minum" {{ $currentJenisKegiatan == 'Penyediaan Akomodasi dan Penyediaan Makan Minum' ? 'selected' : '' }}>Penyediaan Akomodasi dan Penyediaan Makan Minum</option>
                        <option value="Informasi dan Komunikasi" {{ $currentJenisKegiatan == 'Informasi dan Komunikasi' ? 'selected' : '' }}>Informasi dan Komunikasi</option>
                        <option value="Aktivitas Keuangan dan Asuransi" {{ $currentJenisKegiatan == 'Aktivitas Keuangan dan Asuransi' ? 'selected' : '' }}>Aktivitas Keuangan dan Asuransi</option>
                        <option value="Real Estat" {{ $currentJenisKegiatan == 'Real Estat' ? 'selected' : '' }}>Real Estat</option>
                        <option value="Aktivitas Profesional, Ilmiah dan Teknis" {{ $currentJenisKegiatan == 'Aktivitas Profesional, Ilmiah dan Teknis' ? 'selected' : '' }}>Aktivitas Profesional, Ilmiah dan Teknis</option>
                        <option value="Aktivitas Penyewaan dan Sewa Guna Usaha Tanpa Hak Opsi, Keterangakerjaan, Agen Perjalanan dan Penunjang Usaha Lainnya" {{ $currentJenisKegiatan == 'Aktivitas Penyewaan dan Sewa Guna Usaha Tanpa Hak Opsi, Keterangakerjaan, Agen Perjalanan dan Penunjang Usaha Lainnya' ? 'selected' : '' }}>Aktivitas Penyewaan dan Sewa Guna Usaha Tanpa Hak Opsi, Keterangakerjaan, Agen Perjalanan dan Penunjang Usaha Lainnya</option>
                        <option value="Administrasi Pemerintahan, Pertanahan dan Jaminan Sosial Wajib" {{ $currentJenisKegiatan == 'Administrasi Pemerintahan, Pertanahan dan Jaminan Sosial Wajib' ? 'selected' : '' }}>Administrasi Pemerintahan, Pertanahan dan Jaminan Sosial Wajib</option>
                        <option value="Pendidikan" {{ $currentJenisKegiatan == 'Pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                        <option value="Aktivitas Kesehatan Manusia dan Aktivitas Sosial" {{ $currentJenisKegiatan == 'Aktivitas Kesehatan Manusia dan Aktivitas Sosial' ? 'selected' : '' }}>Aktivitas Kesehatan Manusia dan Aktivitas Sosial</option>
                        <option value="Kesenian, Hiburan dan Rekreasi" {{ $currentJenisKegiatan == 'Kesenian, Hiburan dan Rekreasi' ? 'selected' : '' }}>Kesenian, Hiburan dan Rekreasi</option>
                        <option value="Aktivitas Jasa Lainnya" {{ $currentJenisKegiatan == 'Aktivitas Jasa Lainnya' ? 'selected' : '' }}>Aktivitas Jasa Lainnya</option>
                        <option value="Aktivitas Rumah Tangga Sebagai Pemberi Kerja" {{ $currentJenisKegiatan == 'Aktivitas Rumah Tangga Sebagai Pemberi Kerja' ? 'selected' : '' }}>Aktivitas Rumah Tangga Sebagai Pemberi Kerja</option>
                        <option value="Aktivitas Badan Internasioanl dan Badan Ekstra Internasional Lainnya" {{ $currentJenisKegiatan == 'Aktivitas Badan Internasioanl dan Badan Ekstra Internasional Lainnya' ? 'selected' : '' }}>Aktivitas Badan Internasioanl dan Badan Ekstra Internasional Lainnya</option>
                        <option value="Lainnya" {{ $isCustomJenisKegiatan || $currentJenisKegiatan == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                    @error('jenis_kegiatan')
                        <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                            <i class="fas fa-exclamation-circle text-xs"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div class="space-y-2" id="jenis_kegiatan_lainnya" style="display:{{ $isCustomJenisKegiatan || $currentJenisKegiatan == 'Lainnya' ? 'block' : 'none' }};">
                    <label for="jenis_kegiatan_lainnya" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-edit mr-2 text-purple-600"></i>
                        Jenis Kegiatan Lainnya <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="input_jenis_kegiatan_lainnya" name="jenis_kegiatan_lainnya" value="{{ old('jenis_kegiatan_lainnya', $isCustomJenisKegiatan ? $model->jenis_kegiatan : $model->jenis_kegiatan_lainnya) }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                           placeholder="Masukkan Jenis Kegiatan">
                    @error('jenis_kegiatan_lainnya')
                        <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                            <i class="fas fa-exclamation-circle text-xs"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="status_tanah" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-map mr-2 text-purple-600"></i>
                        Status Atas Tanah
                    </label>
                    <select id="status_tanah" name="status_tanah" 
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm">
                        <option value="">-- Pilih Status Atas Tanah --</option>
                        <option value="Sebidang Tanah Perumahan" {{ old('status_tanah', $model->status_tanah) == 'Sebidang Tanah Perumahan' ? 'selected' : '' }}>Sebidang Tanah Perumahan</option>
                        <option value="Sebidang Tanah Pertanian" {{ old('status_tanah', $model->status_tanah) == 'Sebidang Tanah Pertanian' ? 'selected' : '' }}>Sebidang Tanah Pertanian</option>
                        <option value="Tanah non Pertanian" {{ old('status_tanah', $model->status_tanah) == 'Tanah non Pertanian' ? 'selected' : '' }}>Tanah non Pertanian</option>
                    </select>
                    @error('status_tanah')
                        <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                            <i class="fas fa-exclamation-circle text-xs"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="penggunaan_sekarang" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-home mr-2 text-purple-600"></i>
                        Penggunaan Sekarang
                    </label>
                    <input type="text" id="penggunaan_sekarang" name="penggunaan_sekarang" value="{{ old('penggunaan_sekarang', $model->penggunaan_sekarang) }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm disabled:bg-gray-100 disabled:cursor-not-allowed" 
                           placeholder="Penggunaan tanah saat ini">
                    @error('penggunaan_sekarang')
                        <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                            <i class="fas fa-exclamation-circle text-xs"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- NIB Section -->
        <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
            <div class="flex items-center space-x-3 mb-6">
                <div class="w-8 h-8 bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-file-alt text-white text-sm"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900">NIB & KKPR</h3>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="space-y-2">
                    <label for="no_kkpr" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-hashtag mr-2 text-orange-600"></i>
                        Nomor KKPR
                    </label>
                    <input type="text" id="no_kkpr" name="no_kkpr" value="{{ old('no_kkpr', $model->no_kkpr) }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                           placeholder="Nomor KKPR">
                    @error('no_kkpr')
                        <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                            <i class="fas fa-exclamation-circle text-xs"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="tgl_kkpr" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-calendar mr-2 text-orange-600"></i>
                        Tanggal KKPR
                    </label>
                    <input type="date" id="tgl_kkpr" name="tgl_kkpr" value="{{ old('tgl_kkpr', $model->tgl_kkpr) }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                           placeholder="Tanggal KKPR">
                    @error('tgl_kkpr')
                        <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                            <i class="fas fa-exclamation-circle text-xs"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="tgl_terbit" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-calendar mr-2 text-orange-600"></i>
                        Tanggal Terbit NIB <span class="text-red-500">*</span>
                    </label>
                    <input type="date" id="tgl_terbit" name="tgl_terbit" value="{{ old('tgl_terbit', $model->tgl_terbit) }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                           required>
                    @error('tgl_terbit')
                        <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                            <i class="fas fa-exclamation-circle text-xs"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="no_nib" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-hashtag mr-2 text-orange-600"></i>
                        Nomor NIB <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="no_nib" name="no_nib" value="{{ old('no_nib', $model->no_nib) }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                           placeholder="Nomor NIB" required
                           oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                           onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                    @error('no_nib')
                        <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                            <i class="fas fa-exclamation-circle text-xs"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="f_nib" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-upload mr-2 text-orange-600"></i>
                        Upload File NIB <span class="text-red-500">*</span>
                    </label>
                    @if(isset($model->f_nib) && $model->f_nib)
                        <div class="flex items-center space-x-2 p-3 bg-green-50 border border-green-200 rounded-lg mb-2">
                            <i class="fas fa-file-pdf text-green-600"></i>
                            <span class="text-sm text-green-700 flex-1">{{ $model->f_nib }}</span>
                            <a href="{{ asset('uploads/berkas/kkpr/'.$model->id.'/nib/'.$model->f_nib) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                <i class="fas fa-eye"></i>
                            </a>
                            <button type="button" onclick="deleteFile('f_nib', {{ $model->id }})" class="text-red-600 hover:text-red-800">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    @endif
                    <div class="relative">
                        <input type="file" id="f_nib" name="f_nib" accept="application/pdf" 
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100" 
                               {{ (!isset($model->f_nib) || !$model->f_nib) ? 'required' : '' }}>
                </div>
                    @error('f_nib')
                        <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                            <i class="fas fa-exclamation-circle text-xs"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>
            </div>
        </div>


        <!-- Dokumen Persyaratan -->
        <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
            <div class="flex items-center space-x-3 mb-6">
                <div class="w-8 h-8 bg-gradient-to-br from-red-500 to-red-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-file-pdf text-white text-sm"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900">Dokumen Persyaratan</h3>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Surat Pernyataan Mandiri -->
                <div class="space-y-2">
                    <label for="sp_mandiri" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-file-signature mr-2 text-red-600"></i>
                        Upload KKPR @if(!isset($model->sp_mandiri) || !$model->sp_mandiri)<span class="text-red-500">*.pdf</span>@endif
                    </label>
                    @if(isset($model->sp_mandiri) && $model->sp_mandiri)
                        <div class="flex items-center space-x-2 p-3 bg-green-50 border border-green-200 rounded-lg mb-2">
                            <i class="fas fa-file-pdf text-green-600"></i>
                            <span class="text-sm text-green-700 flex-1">{{ $model->sp_mandiri }}</span>
                            <a href="{{ asset('uploads/berkas/kkpr/'.$model->id.'/sp_mandiri/'.$model->sp_mandiri) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                <i class="fas fa-eye"></i>
                            </a>
                            <button type="button" onclick="deleteFile('sp_mandiri', {{ $model->id }})" class="text-red-600 hover:text-red-800">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    @endif
                    <div class="relative">
                        <input type="file" id="sp_mandiri" name="sp_mandiri" accept="application/pdf" 
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100" 
                               {{ (!isset($model->sp_mandiri) || !$model->sp_mandiri) ? 'required' : '' }}>
                    </div>
                    @error('sp_mandiri')
                        <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                            <i class="fas fa-exclamation-circle text-xs"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <!-- Surat Kepemilikan Tanah -->
                <div class="space-y-2">
                    <label for="dok_kepemilikan" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-file-contract mr-2 text-red-600"></i>
                        Upload Surat Kepemilikan Tanah @if(!isset($model->dok_kepemilikan) || !$model->dok_kepemilikan)<span class="text-red-500">.pdf</span>@endif
                    </label>
                    @if(isset($model->dok_kepemilikan) && $model->dok_kepemilikan)
                        <div class="flex items-center space-x-2 p-3 bg-green-50 border border-green-200 rounded-lg mb-2">
                            <i class="fas fa-file-pdf text-green-600"></i>
                            <span class="text-sm text-green-700 flex-1">{{ $model->dok_kepemilikan }}</span>
                            <a href="{{ asset('uploads/berkas/kkpr/'.$model->id.'/dokumen_kepemilikan/'.$model->dok_kepemilikan) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                <i class="fas fa-eye"></i>
                            </a>
                            <button type="button" onclick="deleteFile('dok_kepemilikan', {{ $model->id }})" class="text-red-600 hover:text-red-800">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    @endif
                    <div class="relative">
                        <input type="file" id="dok_kepemilikan" name="dok_kepemilikan" accept="application/pdf" 
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100" 
                               {{ (!isset($model->dok_kepemilikan) || !$model->dok_kepemilikan) ? 'required' : '' }}>
                    </div>
                    @error('dok_kepemilikan')
                        <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                            <i class="fas fa-exclamation-circle text-xs"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <!-- KTP -->
                <div class="space-y-2">
                    <label for="f_ktp" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-id-card mr-2 text-red-600"></i>
                        KTP Pemohon @if(!isset($model->f_ktp) || !$model->f_ktp)<span class="text-red-500">*.pdf</span>@endif
                    </label>
                    @if(isset($model->f_ktp) && $model->f_ktp)
                        <div class="flex items-center space-x-2 p-3 bg-green-50 border border-green-200 rounded-lg mb-2">
                            <i class="fas fa-file-pdf text-green-600"></i>
                            <span class="text-sm text-green-700 flex-1">{{ $model->f_ktp }}</span>
                            <a href="{{ asset('uploads/berkas/kkpr/'.$model->id.'/ktp/'.$model->f_ktp) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                <i class="fas fa-eye"></i>
                            </a>
                            <button type="button" onclick="deleteFile('f_ktp', {{ $model->id }})" class="text-red-600 hover:text-red-800">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    @endif
                    <div class="relative">
                        <input type="file" id="f_ktp" name="f_ktp" accept="application/pdf" 
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100" 
                               {{ (!isset($model->f_ktp) || !$model->f_ktp) ? 'required' : '' }}>
                    </div>
                    @error('f_ktp')
                        <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                            <i class="fas fa-exclamation-circle text-xs"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <!-- Sertifikat Tanah -->
                <div class="space-y-2">
                    <label for="f_sertifikat" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-certificate mr-2 text-red-600"></i>
                        Sertifikat Tanah @if(!isset($model->f_sertifikat) || !$model->f_sertifikat)<span class="text-red-500">*.pdf</span>@endif
                    </label>
                    @if(isset($model->f_sertifikat) && $model->f_sertifikat)
                        <div class="flex items-center space-x-2 p-3 bg-green-50 border border-green-200 rounded-lg mb-2">
                            <i class="fas fa-file-pdf text-green-600"></i>
                            <span class="text-sm text-green-700 flex-1">{{ $model->f_sertifikat }}</span>
                            <a href="{{ asset('uploads/berkas/kkpr/'.$model->id.'/sertifikat/'.$model->f_sertifikat) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                <i class="fas fa-eye"></i>
                            </a>
                            <button type="button" onclick="deleteFile('f_sertifikat', {{ $model->id }})" class="text-red-600 hover:text-red-800">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    @endif
                    <div class="relative">
                        <input type="file" id="f_sertifikat" name="f_sertifikat" accept="application/pdf" 
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100" 
                               {{ (!isset($model->f_sertifikat) || !$model->f_sertifikat) ? 'required' : '' }}>
                    </div>
                    @error('f_sertifikat')
                        <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                            <i class="fas fa-exclamation-circle text-xs"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <!-- Siteplan -->
                <div class="space-y-2">
                    <label for="f_siteplan" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-map mr-2 text-red-600"></i>
                        Siteplan/Denah Lokasi @if(!isset($model->f_siteplan) || !$model->f_siteplan)<span class="text-red-500">*.pdf</span>@endif
                    </label>
                    @if(isset($model->f_siteplan) && $model->f_siteplan)
                        <div class="flex items-center space-x-2 p-3 bg-green-50 border border-green-200 rounded-lg mb-2">
                            <i class="fas fa-file-pdf text-green-600"></i>
                            <span class="text-sm text-green-700 flex-1">{{ $model->f_siteplan }}</span>
                            <a href="{{ asset('uploads/berkas/kkpr/'.$model->id.'/siteplan/'.$model->f_siteplan) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                <i class="fas fa-eye"></i>
                            </a>
                            <button type="button" onclick="deleteFile('f_siteplan', {{ $model->id }})" class="text-red-600 hover:text-red-800">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    @endif
                    <div class="relative">
                        <input type="file" id="f_siteplan" name="f_siteplan" accept="application/pdf" 
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100" 
                               {{ (!isset($model->f_siteplan) || !$model->f_siteplan) ? 'required' : '' }}>
                    </div>
                    @error('f_siteplan')
                        <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                            <i class="fas fa-exclamation-circle text-xs"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <!-- Akta Perusahaan -->
                <div class="space-y-2">
                    <label for="f_akta" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-file-alt mr-2 text-red-600"></i>
                        Akta Perusahaan (Badan Usaha)
                    </label>
                    @if(isset($model->f_akta) && $model->f_akta)
                        <div class="flex items-center space-x-2 p-3 bg-green-50 border border-green-200 rounded-lg mb-2">
                            <i class="fas fa-file-pdf text-green-600"></i>
                            <span class="text-sm text-green-700 flex-1">{{ $model->f_akta }}</span>
                            <a href="{{ asset('uploads/berkas/kkpr/'.$model->id.'/akta/'.$model->f_akta) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                <i class="fas fa-eye"></i>
                            </a>
                            <button type="button" onclick="deleteFile('f_akta', {{ $model->id }})" class="text-red-600 hover:text-red-800">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    @endif
                    <div class="relative">
                        <input type="file" id="f_akta" name="f_akta" accept="application/pdf" 
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100">
                    </div>
                    @error('f_akta')
                        <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                            <i class="fas fa-exclamation-circle text-xs"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <!-- Dokumen TARU -->
                <div class="space-y-2">
                    <label for="dok_taru" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-file-alt mr-2 text-red-600"></i>
                        Dokumen Perizinan Tata Ruang Sebelumnya
                    </label>
                    @if(isset($model->dok_taru) && $model->dok_taru)
                        <div class="flex items-center space-x-2 p-3 bg-green-50 border border-green-200 rounded-lg mb-2">
                            <i class="fas fa-file-pdf text-green-600"></i>
                            <span class="text-sm text-green-700 flex-1">{{ $model->dok_taru }}</span>
                            <a href="{{ asset('uploads/berkas/kkpr/'.$model->id.'/dok_taru/'.$model->dok_taru) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                <i class="fas fa-eye"></i>
                            </a>
                            <button type="button" onclick="deleteFile('dok_taru', {{ $model->id }})" class="text-red-600 hover:text-red-800">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    @endif
                    <div class="relative">
                        <input type="file" id="dok_taru" name="dok_taru" accept="application/pdf" 
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100">
                    </div>
                    @error('dok_taru')
                        <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                            <i class="fas fa-exclamation-circle text-xs"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- KBLI Section -->
        <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
            <div class="flex items-center space-x-3 mb-6">
                <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-list text-white text-sm"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900">KBLI</h3>
            </div>
            
            <div class="space-y-4">
                <table class="w-full" id="kbli_tbl">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Kode KBLI</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Judul KBLI</th>
                            <th class="px-4 py-2 text-center text-sm font-semibold text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            // Get KBLI data: If kolom kbli already has data but no relationship, use kolom kbli
                            // Otherwise, use relationship data if available
                            $kbliData = collect();
                            if (isset($kbli) && is_object($kbli) && method_exists($kbli, 'count') && $kbli->count() > 0) {
                                $kbliData = $kbli;
                            } elseif (isset($model->kkpr_kbli) && is_object($model->kkpr_kbli) && method_exists($model->kkpr_kbli, 'count') && $model->kkpr_kbli->count() > 0) {
                                $kbliData = $model->kkpr_kbli;
                            } elseif (!empty($model->kbli)) {
                                // If kolom kbli has data but no relationship, create a single-item collection
                                $kbliData = collect([
                                    (object)[
                                        'kode_kbli' => $model->kbli,
                                        'judul_kbli' => $model->judul_kbli ?? ''
                                    ]
                                ]);
                            }
                        @endphp
                        @if($kbliData && is_object($kbliData) && method_exists($kbliData, 'count') && $kbliData->count() > 0)
                            @foreach($kbliData as $index => $kbliItem)
                                <tr>
                                    <td class="px-4 py-2">
                                        <input type="text" class="form-control w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" 
                                               name="kode_kbli[]" id="kode_kbli_{{ $index + 1 }}" value="{{ old('kode_kbli.' . $index, isset($kbliItem->kode_kbli) ? $kbliItem->kode_kbli : '') }}" placeholder="Kode KBLI" required>
                                    </td>
                                    <td class="px-4 py-2">
                                        <input type="text" class="form-control w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" 
                                               name="judul_kbli[]" id="judul_kbli_{{ $index + 1 }}" value="{{ old('judul_kbli.' . $index, isset($kbliItem->judul_kbli) ? $kbliItem->judul_kbli : '') }}" placeholder="Judul KBLI" required>
                                    </td>
                                    <td class="px-4 py-2 text-center">
                                        @if($index > 0)
                                            <button class="btn btn-danger px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors btn_remove_kbli" type="button">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        @else
                                            <button class="btn btn-success px-3 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors" type="button" id="add_kbli">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="px-4 py-2">
                                    <input type="text" class="form-control w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" 
                                           name="kode_kbli[]" id="kode_kbli_1" value="{{ old('kode_kbli.0', !empty($model->kbli) ? $model->kbli : '') }}" placeholder="Kode KBLI" required>
                                </td>
                                <td class="px-4 py-2">
                                    <input type="text" class="form-control w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" 
                                           name="judul_kbli[]" id="judul_kbli_1" value="{{ old('judul_kbli.0', !empty($model->judul_kbli) ? $model->judul_kbli : '') }}" placeholder="Judul KBLI" required>
                                </td>
                                <td class="px-4 py-2 text-center">
                                    <button class="btn btn-success px-3 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors" type="button" id="add_kbli">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Lokasi Kegiatan -->
        <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
            <div class="flex items-center space-x-3 mb-6">
                <div class="w-8 h-8 bg-gradient-to-br from-teal-500 to-teal-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-map-marker-alt text-white text-sm"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900">RENCANA PEMBANGUNAN</h3>
            </div>
            
            <div class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div class="space-y-2">
                        <label for="luas_tanah" class="block text-sm font-semibold text-gray-700">
                            <i class="fas fa-ruler mr-2 text-teal-600"></i>
                            Luas Tanah Sesuai Bukti Kepemilikan Tanah <span class="text-red-500">m² *</span>
                        </label>
                        <input type="number" id="luas_tanah" name="luas_tanah" value="{{ old('luas_tanah', $model->luas_tanah) }}" 
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                               placeholder="Luas Tanah Sesuai Bukti Kepemilikan Tanah" required>
                        @error('luas_tanah')
                            <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                                <i class="fas fa-exclamation-circle text-xs"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="tinggi_bangunan" class="block text-sm font-semibold text-gray-700">
                            <i class="fas fa-building mr-2 text-teal-600"></i>
                            Rencana Tinggi Bangunan <span class="text-red-500">m *</span>
                        </label>
                        <input type="number" id="tinggi_bangunan" name="tinggi_bangunan" value="{{ old('tinggi_bangunan', $model->tinggi_bangunan) }}" 
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                               placeholder="Rencana Tinggi Bangunan" required>
                        @error('tinggi_bangunan')
                            <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                                <i class="fas fa-exclamation-circle text-xs"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="luas_dimohon" class="block text-sm font-semibold text-gray-700">
                            <i class="fas fa-ruler mr-2 text-teal-600"></i>
                            Luas Tanah Yang Dimohon <span class="text-red-500">m²</span>
                        </label>
                        <input type="number" id="luas_dimohon" name="luas_dimohon" value="{{ old('luas_dimohon', $model->luas_dimohon) }}" 
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                               placeholder="Luas Tanah Yang Dimohon" required>
                        @error('luas_dimohon')
                            <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                                <i class="fas fa-exclamation-circle text-xs"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="jumlah_lantai" class="block text-sm font-semibold text-gray-700">
                            <i class="fas fa-layer-group mr-2 text-teal-600"></i>
                            Rencana Jumlah Lantai <span class="text-red-500">*</span>
                        </label>
                        <input type="number" id="jumlah_lantai" name="jumlah_lantai" value="{{ old('jumlah_lantai', $model->jumlah_lantai) }}" 
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                               placeholder="Rencana Jumlah Lantai" required>
                        @error('jumlah_lantai')
                            <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                                <i class="fas fa-exclamation-circle text-xs"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="row" id="luas_lantai_container">
                    <!-- Dynamic inputs will be added here -->
                </div>

                <!-- Hidden fields for coordinates -->
                <input type="hidden" name="lati[]" id="lati_1">
                <input type="hidden" name="longi[]" id="longi_1">
                
                <!-- Koordinat Detail dari KML -->
                <div id="koordinat_detail" class="hidden">
                    <div class="bg-gradient-to-r from-teal-50 to-cyan-50 rounded-xl p-4 border border-teal-200">
                        <div class="flex items-center justify-between mb-3">
                            <h4 class="text-lg font-semibold text-gray-800">
                                <i class="fas fa-info-circle mr-2 text-teal-600"></i>
                                Detail Koordinat dari KML
                            </h4>
                            <div class="flex items-center space-x-2">
                                <span id="coordinate_count" class="text-sm font-medium text-teal-600 bg-teal-100 px-2 py-1 rounded-full"></span>
                                <button type="button" id="toggle_coordinates" class="text-sm text-teal-600 hover:text-teal-800 font-medium">
                                    <i class="fas fa-chevron-down mr-1"></i>
                                    <span>Lihat Detail</span>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Summary Info -->
                        <div id="coordinate_summary" class="mb-3 p-3 bg-white rounded-lg border border-teal-200">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-map-pin text-teal-600"></i>
                                    <span class="text-gray-600">Total Koordinat:</span>
                                    <span id="total_coords" class="font-semibold text-teal-700">0</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-expand-arrows-alt text-teal-600"></i>
                                    <span class="text-gray-600">Jenis Geometri:</span>
                                    <span id="geometry_type" class="font-semibold text-teal-700">-</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-download text-teal-600"></i>
                                    <span class="text-gray-600">Status:</span>
                                    <span id="coordinate_status" class="font-semibold text-green-600">Berhasil Dimuat</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Coordinate List Container -->
                        <div id="coordinate_list_container" class="hidden">
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center space-x-2">
                                    <input type="text" id="coordinate_search" placeholder="Cari koordinat..." 
                                           class="px-3 py-1 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500">
                                    <button type="button" id="export_coordinates" class="px-3 py-1 text-xs bg-teal-600 text-white rounded-lg hover:bg-teal-700">
                                        <i class="fas fa-download mr-1"></i>Export
                                    </button>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <span class="text-xs text-gray-500">Tampilkan:</span>
                                    <select id="coordinate_limit" class="px-2 py-1 text-xs border border-gray-300 rounded">
                                        <option value="10">10</option>
                                        <option value="25" selected>25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                        <option value="0">Semua</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div id="coordinate_list" class="max-h-64 overflow-y-auto border border-gray-200 rounded-lg bg-white">
                                <!-- Koordinat akan ditampilkan di sini -->
                            </div>
                            
                            <div id="coordinate_pagination" class="mt-2 flex items-center justify-between text-xs text-gray-500">
                                <span id="coordinate_info">Menampilkan 0 dari 0 koordinat</span>
                                <div class="flex items-center space-x-2">
                                    <button type="button" id="prev_coordinates" class="px-2 py-1 bg-gray-100 rounded hover:bg-gray-200 disabled:opacity-50" disabled>
                                        <i class="fas fa-chevron-left"></i>
                                    </button>
                                    <span id="coordinate_page">1</span>
                                    <button type="button" id="next_coordinates" class="px-2 py-1 bg-gray-100 rounded hover:bg-gray-200 disabled:opacity-50" disabled>
                                        <i class="fas fa-chevron-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Map Section -->
        <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
            <div class="space-y-4">
                <!-- Pilihan Input Koordinat -->
                @php
                    $hasKoordinatDimohon = !empty(isset($model->koordinat_dimohon) ? $model->koordinat_dimohon : null);
                    $hasKml = !empty(isset($model->f_kml) ? $model->f_kml : null);
                    $hasKmlGeojson = !empty(isset($model->kml_geojson) ? $model->kml_geojson : null);
                    $hasAnyCoordinateData = $hasKoordinatDimohon || $hasKml || $hasKmlGeojson;
                    
                    // Tentukan metode input default berdasarkan data yang ada
                    if (!$hasAnyCoordinateData) {
                        $defaultMethod = old('input_method', 'kml');
                    } else if ($hasKoordinatDimohon) {
                        $defaultMethod = 'manual';
                    } else {
                        $defaultMethod = 'kml';
                    }
                @endphp
                
                @if($hasAnyCoordinateData)
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg p-4 border border-blue-200">
                        <label class="block text-sm font-semibold text-gray-700 mb-3">
                            <i class="fas fa-map-marker-alt mr-2 text-blue-600"></i>
                            Pilih Metode Input Koordinat
                        </label>
                        <div class="flex space-x-4">
                            <label class="flex items-center space-x-2 cursor-pointer">
                                <input type="radio" name="input_method" value="kml" id="input_method_kml" class="w-4 h-4 text-blue-600 focus:ring-blue-500" {{ old('input_method', $defaultMethod) == 'kml' ? 'checked' : '' }} onchange="toggleInputMethod('kml')">
                                <span class="text-sm font-medium text-gray-700">Upload KML / Draw di Peta</span>
                            </label>
                            <label class="flex items-center space-x-2 cursor-pointer">
                                <input type="radio" name="input_method" value="manual" id="input_method_manual" class="w-4 h-4 text-blue-600 focus:ring-blue-500" {{ old('input_method', $defaultMethod) == 'manual' ? 'checked' : '' }} onchange="toggleInputMethod('manual')">
                                <span class="text-sm font-medium text-gray-700">Input Koordinat Manual</span>
                            </label>
                        </div>
                    </div>
                @endif

                <!-- Section Upload KML / Draw Peta -->
                <div id="kml_section" class="space-y-4" style="display: {{ !$hasAnyCoordinateData || $defaultMethod == 'kml' ? 'block' : 'none' }};">
                    <div class="flex items-center justify-between">
                        <h4 class="text-lg font-semibold text-gray-700">Peta Lokasi</h4>
                        <div class="flex items-center space-x-4">
                            <div class="space-y-2">
                                <label for="f_kml" class="block text-sm font-semibold text-gray-700">
                                    <i class="fas fa-upload mr-2 text-blue-600"></i>
                                    Upload KML
                                </label>
                                @if(isset($model->f_kml) && $model->f_kml)
                                    <div class="flex items-center space-x-2 p-2 bg-green-50 border border-green-200 rounded-lg mb-2">
                                        <i class="fas fa-file text-green-600"></i>
                                        <span class="text-xs text-green-700 flex-1">{{ $model->f_kml }}</span>
                                        <a href="{{ asset('uploads/berkas/kkpr/'.$model->id.'/kml/'.$model->f_kml) }}" target="_blank" class="text-blue-600 hover:text-blue-800 text-xs">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </div>
                                @endif
                                <div class="relative">
                                    <input type="file" id="f_kml" name="f_kml" accept=".kml" 
                                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                                           onchange="console.log('KML input onchange triggered:', this.files)">
                                </div>
                                @error('f_kml')
                                    <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                                        <i class="fas fa-exclamation-circle text-xs"></i>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">
                                    <i class="fas fa-draw-polygon mr-2 text-green-600"></i>
                                    Tools
                                </label>
                                <div class="flex space-x-2">
                                    <button type="button" id="clearMap" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors text-sm">
                                        <i class="fas fa-trash mr-1"></i>Clear
                                    </button>
                                    <button type="button" id="toggleDraw" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors text-sm">
                                        <i class="fas fa-pencil-alt mr-1"></i>Draw
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <textarea name="kml_geojson" id="kml_geojson" style="display: none;" cols="30" rows="10">{{ old('kml_geojson', $model->kml_geojson) }}</textarea>
                    
                    <!-- GeoJSON Status Indicator -->
                    <div id="geojson_status" class="hidden mb-4">
                        <div class="flex items-center space-x-2 p-3 bg-blue-50 border border-blue-200 rounded-lg">
                            <div id="geojson_icon" class="w-5 h-5">
                                <i class="fas fa-spinner fa-spin text-blue-600"></i>
                            </div>
                            <span id="geojson_message" class="text-sm font-medium text-blue-800">Mengkonversi data ke GeoJSON...</span>
                        </div>
                    </div>
                    
                    <div id='mapKu' style='width: 100%; height: 80vh; border-radius: 0.5rem; border: 1px solid #e5e7eb;'></div>
                </div>

                <!-- Section Input Koordinat Manual -->
                <div id="manual_section" class="space-y-4" style="display: {{ !$hasAnyCoordinateData || $defaultMethod == 'kml' ? 'none' : 'block' }};">
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <label class="block text-sm font-semibold text-gray-700">
                                <i class="fas fa-map-marked-alt mr-2 text-purple-600"></i>
                                Input Koordinat Lokasi <span class="text-red-500">*</span>
                            </label>
                            <button type="button" id="add_coordinate_btn" onclick="addCoordinateRow()" class="px-3 py-1.5 text-sm bg-purple-500 text-white rounded-lg hover:bg-purple-600 transition-colors">
                                <i class="fas fa-plus mr-1"></i>Tambah Koordinat
                            </button>
                        </div>
                        
                        <!-- Daftar Koordinat -->
                        <div id="coordinates_list" class="space-y-3">
                            <!-- Koordinat akan ditambahkan di sini secara dinamis -->
                        </div>
                        
                        <!-- Hidden input untuk menyimpan data array -->
                        @php
                            $koordinatData = isset($koordinat) && is_object($koordinat) && method_exists($koordinat, 'count') ? $koordinat : (isset($model->kkpr_koordinat) && is_object($model->kkpr_koordinat) && method_exists($model->kkpr_koordinat, 'count') ? $model->kkpr_koordinat : collect());
                            $koordinatJson = '[]';
                            if ($koordinatData && is_object($koordinatData) && method_exists($koordinatData, 'count') && $koordinatData->count() > 0) {
                                try {
                                    $koordinatArray = $koordinatData->map(function($k) { 
                                        return ['latitude' => isset($k->lati) ? $k->lati : '', 'longitude' => isset($k->longi) ? $k->longi : '']; 
                                    })->toArray();
                                    $koordinatJson = json_encode($koordinatArray);
                                } catch (\Exception $e) {
                                    $koordinatJson = '[]';
                                }
                            }
                        @endphp
                        <input type="hidden" id="koordinat_data" name="koordinat_dimohon" value="{{ old('koordinat_dimohon', $koordinatJson) }}">
                        
                        <p class="text-xs text-gray-500 mt-2">
                            <i class="fas fa-info-circle mr-1"></i>
                            Klik "Tambah Koordinat" untuk menambahkan pasangan koordinat (Latitude, Longitude)
                        </p>
                        @error('koordinat_dimohon')
                            <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                                <i class="fas fa-exclamation-circle text-xs"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Konfirmasi -->
        <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
            <div class="flex items-center space-x-3 mb-6">
                <div class="w-8 h-8 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-check-circle text-white text-sm"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900">KONFIRMASI</h3>
            </div>
            
            <div class="space-y-4">
                <div class="flex items-start space-x-3">
                    <input type="checkbox" class="mt-1 h-4 w-4 text-[#185B3C] focus:ring-[#185B3C] border-gray-300 rounded" id="konfirmasi1" required>
                    <label for="konfirmasi1" class="text-sm text-gray-700">
                        Bersedia untuk mengikuti ketentuan dan melakukan penyesuaian kepatuhan terhadap ketentuan yang termuat dalam hasil validasi Pernyataan mandiri pelaku KKPR Terbit Otomatis
                    </label>
                </div>

                <div class="flex items-start space-x-3">
                    <input type="checkbox" class="mt-1 h-4 w-4 text-[#185B3C] focus:ring-[#185B3C] border-gray-300 rounded" id="konfirmasi2" required>
                    <label for="konfirmasi2" class="text-sm text-gray-700">
                        Bersedia untuk menghentikan kegiatan berusaha apabila dalam pelaksanaan kegiatan pemanfaatan ruang tidak sesuai dengan kesesuaian kegiatan pemanfaatan ruang
                    </label>
                </div>

                <div class="flex items-start space-x-3">
                    <input type="checkbox" class="mt-1 h-4 w-4 text-[#185B3C] focus:ring-[#185B3C] border-gray-300 rounded" id="konfirmasi3" required>
                    <label for="konfirmasi3" class="text-sm text-gray-700">
                        Segala dokumen yang kami berikan adalah benar sesuai dokumen aslinya dan apabila di kemudian hari ditemui bahwa dokumen-dokumen tersebut tidak benar, maka kami akan bertanggung jawab secara penuh dan bersedia dituntut di pengadilan
                    </label>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-end space-x-4">
            <a href="{{ route('admin.kkpr.index') }}" class="px-6 py-3 text-gray-700 bg-gray-100 hover:bg-gray-200 font-semibold rounded-xl transition-colors duration-200">
                <i class="fas fa-times mr-2"></i>
                Batal
            </a>
            <button type="submit" class="px-6 py-3 bg-gradient-to-r from-[#185B3C] to-[#0F3D26] text-white font-semibold rounded-xl hover:shadow-lg transform hover:scale-105 transition-all duration-200">
                <i class="fas fa-save mr-2"></i>
                Update Permohonan
            </button>
        </div>
    </form>
</div>

<script>
    // Toggle jenis kegiatan lainnya - global function untuk inline onchange
    function toggleJenisLainnya(value) {
        const lainnyaDiv = document.getElementById('jenis_kegiatan_lainnya');
        const inputLainnya = document.getElementById('input_jenis_kegiatan_lainnya');
        
        if (!lainnyaDiv || !inputLainnya) return;
        
        if (value === 'Lainnya') {
            lainnyaDiv.style.display = 'block';
            inputLainnya.required = true;
        } else {
            lainnyaDiv.style.display = 'none';
            inputLainnya.required = false;
            inputLainnya.value = '';
        }
    }

    // Toggle status lahan lainnya
    function toggleStatusLahanLainnya(value) {
        const lainnyaDiv = document.getElementById('status_lahan_lainnya');
        const inputLainnya = document.getElementById('status_lahan_lainnya_input');
        
        if (!lainnyaDiv || !inputLainnya) return;
        
        if (value === 'Dokumen penguasaan lainnya') {
            lainnyaDiv.style.display = 'block';
            inputLainnya.required = true;
        } else {
            lainnyaDiv.style.display = 'none';
            inputLainnya.required = false;
            inputLainnya.value = '';
        }
    }

    // Toggle penggunaan sekarang - disable jika status "Kosong"
    function togglePenggunaanSekarang(value) {
        const penggunaanSekarangInput = document.getElementById('penggunaan_sekarang');
        
        if (!penggunaanSekarangInput) return;
        
        if (value === 'Kosong') {
            penggunaanSekarangInput.disabled = true;
            penggunaanSekarangInput.value = '';
        } else {
            penggunaanSekarangInput.disabled = false;
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

        // Initialize jenis kegiatan lainnya field visibility
        const jenisKegiatanSelect = document.getElementById('jenis_kegiatan');
        if (jenisKegiatanSelect) {
            toggleJenisLainnya(jenisKegiatanSelect.value);
        }
    });
</script>

<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
<!-- Leaflet Draw CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet-draw@1.0.4/dist/leaflet.draw.css" />
<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
<!-- Leaflet Draw JS -->
<script src="https://unpkg.com/leaflet-draw@1.0.4/dist/leaflet.draw.js"></script>

<script>
    // Coordinate counter for unique IDs
    let coordinateCounter = 0;

    // Add coordinate row
    function addCoordinateRow(latitude = '', longitude = '') {
        const coordinatesList = document.getElementById('coordinates_list');
        if (!coordinatesList) return;
        
        const rowId = 'coordinate_' + coordinateCounter++;
        
        const row = document.createElement('div');
        row.id = rowId;
        row.className = 'bg-gray-50 rounded-lg p-4 border border-gray-200';
        row.innerHTML = `
            <div class="grid grid-cols-12 gap-3 items-end">
                <div class="col-span-5">
                    <label class="block text-xs font-semibold text-gray-600 mb-1">
                        Latitude <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           class="coordinate-lat w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent text-sm" 
                           placeholder="-8.2191" 
                           value="${latitude}"
                           onchange="updateKoordinatData()"
                           pattern="-?\\d+\\.?\\d*">
                </div>
                <div class="col-span-5">
                    <label class="block text-xs font-semibold text-gray-600 mb-1">
                        Longitude <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           class="coordinate-lng w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent text-sm" 
                           placeholder="114.3691" 
                           value="${longitude}"
                           onchange="updateKoordinatData()"
                           pattern="-?\\d+\\.?\\d*">
                </div>
                <div class="col-span-2">
                    <button type="button" onclick="removeCoordinateRow('${rowId}')" class="w-full px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors text-sm">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        `;
        
        coordinatesList.appendChild(row);
        updateKoordinatData();
    }

    // Remove coordinate row
    function removeCoordinateRow(rowId) {
        const row = document.getElementById(rowId);
        if (row) {
            row.remove();
            updateKoordinatData();
        }
    }

    // Update hidden input dengan data array koordinat
    function updateKoordinatData() {
        const coordinates = [];
        const latInputs = document.querySelectorAll('.coordinate-lat');
        const lngInputs = document.querySelectorAll('.coordinate-lng');
        
        latInputs.forEach((latInput, index) => {
            const lat = latInput.value.trim();
            const lng = lngInputs[index] ? lngInputs[index].value.trim() : '';
            
            if (lat && lng) {
                coordinates.push({
                    latitude: lat,
                    longitude: lng
                });
            }
        });
        
        const hiddenInput = document.getElementById('koordinat_data');
        if (hiddenInput) {
            hiddenInput.value = JSON.stringify(coordinates);
        }
    }

    // Toggle input method - must be in global scope for onchange attribute
    function toggleInputMethod(method) {
        const kmlSection = document.getElementById('kml_section');
        const manualSection = document.getElementById('manual_section');
        const kmlInput = document.getElementById('f_kml');
        const kmlGeojson = document.getElementById('kml_geojson');
        
        if (method === 'kml') {
            if (kmlSection) kmlSection.style.display = 'block';
            if (manualSection) manualSection.style.display = 'none';
        } else {
            if (kmlSection) kmlSection.style.display = 'none';
            if (manualSection) manualSection.style.display = 'block';
            if (kmlInput) {
                kmlInput.required = false;
                kmlInput.value = '';
            }
            if (kmlGeojson) kmlGeojson.value = '';
            
            // Initialize dengan satu row koordinat jika belum ada
            const coordinatesList = document.getElementById('coordinates_list');
            if (coordinatesList && coordinatesList.children.length === 0) {
                addCoordinateRow();
            }
        }
        
        // Ensure map renders properly after toggle
        setTimeout(function() {
            if (window.kkprMap) {
                window.kkprMap.invalidateSize();
            }
        }, 200);
    }

    // Delete file function
    function deleteFile(fieldName, kkprId) {
        if(!confirm('Apakah Anda yakin ingin menghapus file ini?')) {
            return;
        }
        
        // Send AJAX request to delete file
        fetch(`/admin/kkpr/${kkprId}/delete-file/${fieldName}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                alert('File berhasil dihapus');
                location.reload();
            } else {
                alert('Gagal menghapus file: ' + (data.message || 'Terjadi kesalahan'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menghapus file');
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
        
        // Initialize Leaflet Map
        initMap();
        
        // Dynamic form functionality
        initDynamicForms();

        // Initialize input method on load
        @php
            $koordinatDataForJs = isset($koordinat) && is_object($koordinat) && method_exists($koordinat, 'count') ? $koordinat : (isset($model->kkpr_koordinat) && is_object($model->kkpr_koordinat) && method_exists($model->kkpr_koordinat, 'count') ? $model->kkpr_koordinat : collect());
            $hasKoordinatForJs = $koordinatDataForJs && is_object($koordinatDataForJs) && method_exists($koordinatDataForJs, 'count') && $koordinatDataForJs->count() > 0;
            $kmlGeojson = isset($model->kml_geojson) ? $model->kml_geojson : null;
        @endphp
        @if(old('input_method') == 'manual' || ($hasKoordinatForJs && !$kmlGeojson))
            toggleInputMethod('manual');
            // Load existing coordinates if any
            @if($hasKoordinatForJs)
                try {
                    @php
                        $coordsArray = $koordinatDataForJs->map(function($k) { 
                            return ['latitude' => isset($k->lati) ? $k->lati : '', 'longitude' => isset($k->longi) ? $k->longi : '']; 
                        })->toArray();
                    @endphp
                    const existingCoords = {!! json_encode($coordsArray) !!};
                    if (Array.isArray(existingCoords) && existingCoords.length > 0) {
                        existingCoords.forEach(coord => {
                            addCoordinateRow(coord.latitude || '', coord.longitude || '');
                        });
                    } else {
                        addCoordinateRow();
                    }
                } catch (e) {
                    console.error('Error loading coordinates:', e);
                    addCoordinateRow();
                }
            @else
                addCoordinateRow();
            @endif
        @else
            toggleInputMethod('kml');
            // Load existing KML/GeoJSON if any
            @if(isset($model->kml_geojson) && $model->kml_geojson)
                try {
                    const geoJsonData = {!! $model->kml_geojson !!};
                    if (geoJsonData && window.kkprMap) {
                        const geoJsonLayer = L.geoJSON(geoJsonData, {
                            style: function(feature) {
                                if (feature.geometry.type === 'LineString') {
                                    return {
                                        color: '#DC2626',
                                        weight: 4,
                                        opacity: 0.8
                                    };
                                } else if (feature.geometry.type === 'Polygon') {
                                    return {
                                        color: '#DC2626',
                                        weight: 4,
                                        fillColor: '#DC2626',
                                        fillOpacity: 0.3
                                    };
                                } else {
                                    return {
                                        color: '#DC2626',
                                        weight: 4,
                                        fillColor: '#DC2626',
                                        fillOpacity: 0.3
                                    };
                                }
                            }
                        }).addTo(window.kkprMap);
                        
                        window.drawnItems.addLayer(geoJsonLayer);
                        
                        if (geoJsonLayer.getBounds && geoJsonLayer.getBounds().isValid()) {
                            window.kkprMap.fitBounds(geoJsonLayer.getBounds());
                        }
                        
                        // Extract and display coordinates
                        extractCoordinatesFromGeoJSON(geoJsonData);
                        
                        // Ensure map renders properly after loading GeoJSON
                        setTimeout(function() {
                            if (window.kkprMap) {
                                window.kkprMap.invalidateSize();
                            }
                        }, 200);
                    }
                } catch (e) {
                    console.error('Error loading GeoJSON:', e);
                    // Ensure map still renders even if GeoJSON fails
                    setTimeout(function() {
                        if (window.kkprMap) {
                            window.kkprMap.invalidateSize();
                        }
                    }, 200);
                }
            @else
                // Ensure map renders properly even when no GeoJSON data
                setTimeout(function() {
                    if (window.kkprMap) {
                        window.kkprMap.invalidateSize();
                    }
                }, 200);
            @endif
        @endif

        // Initialize status lahan lainnya jika old value ada
        @if(old('status_lahan') == 'Dokumen penguasaan lainnya' || old('status_lahan_lainnya_input'))
            if (typeof toggleStatusLahanLainnya === 'function') {
                toggleStatusLahanLainnya('Dokumen penguasaan lainnya');
            }
        @endif

        // Initialize penggunaan sekarang - disable jika status "Kosong"
        @if(old('status_penggunaan_tanah') == 'Kosong' || ($model->status_penggunaan_tanah == 'Kosong'))
            if (typeof togglePenggunaanSekarang === 'function') {
                togglePenggunaanSekarang('Kosong');
            }
        @endif

        // Add form validation before submit
        const form = document.querySelector('form');
        if (form) {
            form.addEventListener('submit', function(e) {
                const inputMethod = document.querySelector('input[name="input_method"]:checked');
                if (!inputMethod) {
                    e.preventDefault();
                    alert('Silakan pilih metode input koordinat.');
                    return false;
                }
                
                const method = inputMethod.value;
                const kmlGeojson = document.getElementById('kml_geojson');
                const koordinatDimohon = document.getElementById('koordinat_data');
                
                if (method === 'kml') {
                    const kmlGeojsonValue = kmlGeojson ? kmlGeojson.value : '';
                    if (!kmlGeojsonValue || kmlGeojsonValue.trim() === '') {
                        e.preventDefault();
                        alert('Silakan upload file KML atau gambar area di peta terlebih dahulu.');
                        return false;
                    }
                    
                    try {
                        const geoJsonData = JSON.parse(kmlGeojsonValue);
                        if (!geoJsonData.geometry || !geoJsonData.geometry.coordinates) {
                            e.preventDefault();
                            alert('Data koordinat tidak valid. Silakan upload ulang file KML atau gambar area di peta.');
                            return false;
                        }
                    } catch (error) {
                        e.preventDefault();
                        alert('Data koordinat tidak valid. Silakan upload ulang file KML atau gambar area di peta.');
                        return false;
                    }
                } else {
                    const koordinatData = koordinatDimohon ? koordinatDimohon.value : '';
                    
                    if (!koordinatData || koordinatData.trim() === '' || koordinatData === '[]') {
                        e.preventDefault();
                        alert('Silakan tambahkan minimal satu pasangan koordinat (Latitude dan Longitude).');
                        const addBtn = document.getElementById('add_coordinate_btn');
                        if (addBtn) addBtn.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        return false;
                    }
                    
                    try {
                        const coordinates = JSON.parse(koordinatData);
                        if (!Array.isArray(coordinates) || coordinates.length === 0) {
                            e.preventDefault();
                            alert('Silakan tambahkan minimal satu pasangan koordinat (Latitude dan Longitude).');
                            return false;
                        }
                        
                        // Validate each coordinate
                        for (let i = 0; i < coordinates.length; i++) {
                            const coord = coordinates[i];
                            if (!coord.latitude || !coord.longitude) {
                                e.preventDefault();
                                alert(`Koordinat ke-${i + 1} belum lengkap. Pastikan Latitude dan Longitude terisi.`);
                                return false;
                            }
                            
                            const lat = parseFloat(coord.latitude);
                            const lng = parseFloat(coord.longitude);
                            if (isNaN(lat) || isNaN(lng)) {
                                e.preventDefault();
                                alert(`Koordinat ke-${i + 1} tidak valid. Pastikan Latitude dan Longitude berupa angka.`);
                                return false;
                            }
                        }
                    } catch (error) {
                        e.preventDefault();
                        alert('Data koordinat tidak valid. Silakan periksa kembali input koordinat.');
                        return false;
                    }
                    
                    // Clear KML fields when using manual input
                    if (document.getElementById('f_kml')) document.getElementById('f_kml').value = '';
                    if (document.getElementById('kml_geojson')) document.getElementById('kml_geojson').value = '';
                }

                // Handle status lahan lainnya - gabungkan value ke status_lahan
                const statusLahanSelect = document.getElementById('status_lahan');
                const statusLahanLainnyaInput = document.getElementById('status_lahan_lainnya_input');
                
                if (statusLahanSelect && statusLahanLainnyaInput && statusLahanSelect.value === 'Dokumen penguasaan lainnya') {
                    const customValue = statusLahanLainnyaInput.value.trim();
                    if (!customValue) {
                        e.preventDefault();
                        alert('Silakan isi dokumen penguasaan lainnya.');
                        statusLahanLainnyaInput.focus();
                        return false;
                    }
                    // Set value status_lahan dari input dynamic field - gunakan hidden input untuk pastikan value terkirim
                    const hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = 'status_lahan';
                    hiddenInput.value = customValue;
                    statusLahanSelect.parentNode.appendChild(hiddenInput);
                    statusLahanSelect.disabled = true; // Disable select agar value tidak ikut terkirim
                }
            });
        }
    });

    // Initialize Leaflet Map
    function initMap() {
        // Initialize map centered on Banyuwangi
        const map = L.map('mapKu', {
            zoomControl: true,
            scrollWheelZoom: true
        }).setView([-8.2191, 114.3691], 10);
        
        // Add multiple tile layers
        const osmLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        });
        
        const satelliteLayer = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            attribution: '© Esri'
        });
        
        // Add base layers
        const baseLayers = {
            "OpenStreetMap": osmLayer,
            "Satellite": satelliteLayer
        };
        
        osmLayer.addTo(map);
        
        // Add layer control
        L.control.layers(baseLayers).addTo(map);

        // Store map reference globally
        window.kkprMap = map;
        window.kkprMarkers = [];
        window.kkprPolygon = null;
        window.drawnItems = new L.FeatureGroup();
        map.addLayer(window.drawnItems);
        
        // Ensure map renders properly after initialization
        setTimeout(function() {
            if (window.kkprMap) {
                window.kkprMap.invalidateSize();
            }
        }, 100);
        
        // Handle window resize to ensure map renders properly
        let resizeTimer;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function() {
                if (window.kkprMap) {
                    window.kkprMap.invalidateSize();
                }
            }, 250);
        });

        // Initialize draw control
        const drawControl = new L.Control.Draw({
            position: 'topright',
            draw: {
                polygon: {
                    allowIntersection: false,
                    showArea: true,
                    drawError: {
                        color: '#e1e100',
                        message: '<strong>Error:</strong> shape edges cannot cross!'
                    },
                    shapeOptions: {
                        color: '#3B82F6',
                        fillColor: '#3B82F6',
                        fillOpacity: 0.2,
                        weight: 3
                    }
                },
                polyline: {
                    shapeOptions: {
                        color: '#EF4444',
                        weight: 4
                    }
                },
                rectangle: {
                    shapeOptions: {
                        color: '#10B981',
                        fillColor: '#10B981',
                        fillOpacity: 0.2,
                        weight: 3
                    }
                },
                circle: {
                    shapeOptions: {
                        color: '#F59E0B',
                        fillColor: '#F59E0B',
                        fillOpacity: 0.2,
                        weight: 3
                    }
                },
                marker: {
                    icon: L.icon({
                        iconUrl: 'https://unpkg.com/leaflet@1.7.1/dist/images/marker-icon.png',
                        shadowUrl: 'https://unpkg.com/leaflet@1.7.1/dist/images/marker-shadow.png',
                        iconSize: [25, 41],
                        iconAnchor: [12, 41],
                        popupAnchor: [1, -34],
                        shadowSize: [41, 41]
                    })
                }
            },
            edit: {
                featureGroup: window.drawnItems,
                remove: true
            }
        });
        
        map.addControl(drawControl);

        // Event listeners for draw
        map.on(L.Draw.Event.CREATED, function(event) {
            const layer = event.layer;
            window.drawnItems.addLayer(layer);
            
            // Update coordinates when something is drawn
            updateCoordinatesFromDraw();
        });

        map.on(L.Draw.Event.EDITED, function(event) {
            updateCoordinatesFromDraw();
        });

        map.on(L.Draw.Event.DELETED, function(event) {
            updateCoordinatesFromDraw();
        });

        // Handle KML file upload
        const kmlInput = document.getElementById('f_kml');
        
        if (kmlInput) {
            kmlInput.addEventListener('change', function(e) {
                if (e.target.files.length > 0) {
                    const file = e.target.files[0];
                    
                    // Check file type
                    const isValidKML = file.type === 'application/vnd.google-earth.kml+xml' || 
                                     file.name.toLowerCase().endsWith('.kml') ||
                                     file.type === 'text/xml' ||
                                     file.type === 'application/xml';
                    
                    if (isValidKML) {
                        loadKMLFile(file);
                    } else {
                        alert('Silakan pilih file KML yang valid (.kml)');
                    }
                }
            });
        }

        // Clear map button
        const clearMapBtn = document.getElementById('clearMap');
        if (clearMapBtn) {
            clearMapBtn.addEventListener('click', function() {
                window.drawnItems.clearLayers();
                if (window.kkprPolygon) {
                    map.removeLayer(window.kkprPolygon);
                    window.kkprPolygon = null;
                }
                window.kkprMarkers.forEach(marker => map.removeLayer(marker));
                window.kkprMarkers = [];
                
                // Reset coordinate data
                document.getElementById('koordinat_detail').classList.add('hidden');
                const kmlGeojsonInput = document.getElementById('kml_geojson');
                if (kmlGeojsonInput) kmlGeojsonInput.value = '';
                
                // Hide GeoJSON status
                const statusDiv = document.getElementById('geojson_status');
                if (statusDiv) {
                    statusDiv.classList.add('hidden');
                }
            });
        }

        // Toggle draw button
        let isDrawing = false;
        const toggleDrawBtn = document.getElementById('toggleDraw');
        if (toggleDrawBtn) {
            toggleDrawBtn.addEventListener('click', function() {
                if (isDrawing) {
                    map.removeControl(drawControl);
                    isDrawing = false;
                    this.innerHTML = '<i class="fas fa-pencil-alt mr-1"></i>Draw';
                    this.classList.remove('bg-red-500', 'hover:bg-red-600');
                    this.classList.add('bg-green-500', 'hover:bg-green-600');
                } else {
                    map.addControl(drawControl);
                    isDrawing = true;
                    this.innerHTML = '<i class="fas fa-stop mr-1"></i>Stop';
                    this.classList.remove('bg-green-500', 'hover:bg-green-600');
                    this.classList.add('bg-red-500', 'hover:bg-red-600');
                }
            });
        }
    }

    // Load KML file with manual conversion
    function loadKMLFile(file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const kmlText = e.target.result;
            
            // Clear existing layers
            window.drawnItems.clearLayers();
            if (window.kkprPolygon) {
                window.kkprMap.removeLayer(window.kkprPolygon);
            }
            window.kkprMarkers.forEach(marker => window.kkprMap.removeLayer(marker));
            window.kkprMarkers = [];

            try {
                // Convert KML to GeoJSON manually
                const geoJsonData = convertKMLToGeoJSONManual(kmlText);
                
                // Store GeoJSON in hidden field
                const kmlGeojsonInput = document.getElementById('kml_geojson');
                if (kmlGeojsonInput) {
                    kmlGeojsonInput.value = JSON.stringify(geoJsonData);
                }
                
                // Create Leaflet layers from GeoJSON
                const geoJsonLayer = L.geoJSON(geoJsonData, {
                    style: function(feature) {
                        if (feature.geometry.type === 'LineString') {
                            return {
                                color: '#DC2626',
                                weight: 4,
                                opacity: 0.8
                            };
                        } else if (feature.geometry.type === 'Polygon') {
                            return {
                                color: '#DC2626',
                                weight: 4,
                                fillColor: '#DC2626',
                                fillOpacity: 0.3
                            };
                        } else {
                            return {
                                color: '#DC2626',
                                weight: 4,
                                fillColor: '#DC2626',
                                fillOpacity: 0.3
                            };
                        }
                    }
                }).addTo(window.kkprMap);
                
                window.drawnItems.addLayer(geoJsonLayer);
                
                if (geoJsonLayer.getBounds && geoJsonLayer.getBounds().isValid()) {
                    window.kkprMap.fitBounds(geoJsonLayer.getBounds());
                }
                
                // Extract and display coordinates
                extractCoordinatesFromGeoJSON(geoJsonData);
                
                // Ensure map renders properly after loading
                setTimeout(function() {
                    if (window.kkprMap) {
                        window.kkprMap.invalidateSize();
                    }
                }, 200);
                
                // Show success message
                const statusDiv = document.getElementById('geojson_status');
                if (statusDiv) {
                    statusDiv.classList.remove('hidden');
                    const icon = document.getElementById('geojson_icon');
                    const message = document.getElementById('geojson_message');
                    if (icon) icon.innerHTML = '<i class="fas fa-check-circle text-green-600"></i>';
                    if (message) message.textContent = 'KML berhasil dimuat!';
                }
            } catch (error) {
                console.error('Error loading KML:', error);
                alert('Error memuat file KML: ' + error.message);
            }
        };
        
        reader.onerror = function(error) {
            console.error('FileReader error:', error);
            alert('Error membaca file KML');
        };
        
        reader.readAsText(file);
    }

    // Convert KML to GeoJSON manually
    function convertKMLToGeoJSONManual(kmlText) {
        const parser = new DOMParser();
        const kmlDoc = parser.parseFromString(kmlText, 'text/xml');
        
        // Check for parsing errors
        const parseError = kmlDoc.querySelector('parsererror');
        if (parseError) {
            console.error('KML parsing error:', parseError.textContent);
            throw new Error('Invalid KML format');
        }
        
        const features = [];
        
        // Find all Placemark elements
        const placemarks = kmlDoc.querySelectorAll('Placemark');
        console.log('Found', placemarks.length, 'Placemark elements');
        
        placemarks.forEach((placemark, index) => {
            // Extract name
            const nameElement = placemark.querySelector('name');
            const name = nameElement ? nameElement.textContent.trim() : `Placemark ${index + 1}`;
            
            // Extract description
            const descriptionElement = placemark.querySelector('description');
            const description = descriptionElement ? descriptionElement.textContent.trim() : '';
            
            // Check for different geometry types
            const lineString = placemark.querySelector('LineString');
            const polygon = placemark.querySelector('Polygon');
            const point = placemark.querySelector('Point');
            
            if (lineString) {
                const coords = extractCoordinatesFromElement(lineString);
                if (coords.length > 0) {
                    features.push({
                        type: 'Feature',
                        properties: {
                            name: name,
                            description: description
                        },
                        geometry: {
                            type: 'LineString',
                            coordinates: coords
                        }
                    });
                }
            } else if (polygon) {
                const coords = extractCoordinatesFromElement(polygon);
                if (coords.length > 0) {
                    features.push({
                        type: 'Feature',
                        properties: {
                            name: name,
                            description: description
                        },
                        geometry: {
                            type: 'Polygon',
                            coordinates: [coords]
                        }
                    });
                }
            } else if (point) {
                const coords = extractCoordinatesFromElement(point);
                if (coords.length > 0) {
                    features.push({
                        type: 'Feature',
                        properties: {
                            name: name,
                            description: description
                        },
                        geometry: {
                            type: 'Point',
                            coordinates: coords[0]
                        }
                    });
                }
            }
        });
        
        if (features.length === 0) {
            throw new Error('No valid geometry found in KML');
        }
        
        const geoJson = {
            type: 'FeatureCollection',
            features: features
        };
        
        return geoJson;
    }

    // Extract coordinates from a KML geometry element
    function extractCoordinatesFromElement(element) {
        const coordinates = element.querySelector('coordinates');
        
        if (!coordinates) {
            return [];
        }
        
        const coordText = coordinates.textContent.trim();
        const coordPairs = coordText.split(/\s+/).filter(coord => coord.trim());
        
        const coords = coordPairs.map((coord) => {
            const parts = coord.split(',');
            const lng = parseFloat(parts[0]);
            const lat = parseFloat(parts[1]);
            const alt = parts[2] ? parseFloat(parts[2]) : 0;
            
            return [lng, lat, alt];
        });
        
        return coords;
    }

    // Global variables for coordinate management
    let allCoordinates = [];
    let filteredCoordinates = [];
    let currentPage = 1;
    let itemsPerPage = 25;
    let currentGeometryType = '';

    // Update coordinates from drawn items
    function updateCoordinatesFromDraw() {
        const layers = window.drawnItems.getLayers();
        if (layers.length > 0) {
            const coordinates = [];
            
            layers.forEach(layer => {
                if (layer instanceof L.Polygon) {
                    const latLngs = layer.getLatLngs()[0];
                    latLngs.forEach(latLng => {
                        coordinates.push([latLng.lng, latLng.lat]);
                    });
                } else if (layer instanceof L.Polyline) {
                    const latLngs = layer.getLatLngs();
                    latLngs.forEach(latLng => {
                        coordinates.push([latLng.lng, latLng.lat]);
                    });
                } else if (layer instanceof L.Marker) {
                    const latLng = layer.getLatLng();
                    coordinates.push([latLng.lng, latLng.lat]);
                }
            });
            
            if (coordinates.length > 0) {
                // Convert to coordinate objects for consistency
                allCoordinates = coordinates.map(coord => ({
                    lat: coord[1],
                    lng: coord[0]
                }));
                
                // Show coordinate detail section
                const koordinatDetail = document.getElementById('koordinat_detail');
                if (koordinatDetail) {
                    koordinatDetail.classList.remove('hidden');
                }
                
                // Update summary information
                currentGeometryType = 'Drawn Shape';
                updateCoordinateSummary();
                
                // Initialize coordinate display
                filteredCoordinates = [...allCoordinates];
                currentPage = 1;
                displayCoordinates();
                
                // Update hidden coordinate fields with first coordinate
                const lati1 = document.getElementById('lati_1');
                const longi1 = document.getElementById('longi_1');
                if (lati1) lati1.value = allCoordinates[0].lat;
                if (longi1) longi1.value = allCoordinates[0].lng;
                
                // Initialize coordinate management features
                initializeCoordinateFeatures();
                
                // Create GeoJSON from coordinates
                const geoJson = {
                    type: "Feature",
                    geometry: {
                        type: "Polygon",
                        coordinates: [coordinates]
                    },
                    properties: {}
                };
                const kmlGeojsonInput = document.getElementById('kml_geojson');
                if (kmlGeojsonInput) {
                    kmlGeojsonInput.value = JSON.stringify(geoJson);
                }
            } else {
                // Hide coordinate detail if no coordinates
                const koordinatDetail = document.getElementById('koordinat_detail');
                if (koordinatDetail) koordinatDetail.classList.add('hidden');
                const kmlGeojsonInput = document.getElementById('kml_geojson');
                if (kmlGeojsonInput) kmlGeojsonInput.value = '';
            }
        } else {
            // Hide coordinate detail if no layers
            const koordinatDetail = document.getElementById('koordinat_detail');
            if (koordinatDetail) koordinatDetail.classList.add('hidden');
            const kmlGeojsonInput = document.getElementById('kml_geojson');
            if (kmlGeojsonInput) kmlGeojsonInput.value = '';
        }
    }

    // Extract coordinates from GeoJSON and display them
    function extractCoordinatesFromGeoJSON(geoJsonData) {
        try {
            console.log('Extracting coordinates from GeoJSON:', geoJsonData);
            allCoordinates = [];
            
            if (geoJsonData.type === 'FeatureCollection') {
                geoJsonData.features.forEach((feature) => {
                    const coords = extractCoordinatesFromFeature(feature);
                    allCoordinates = allCoordinates.concat(coords);
                });
                currentGeometryType = geoJsonData.features[0]?.geometry?.type || 'Unknown';
            } else if (geoJsonData.type === 'Feature') {
                allCoordinates = extractCoordinatesFromFeature(geoJsonData);
                currentGeometryType = geoJsonData.geometry?.type || 'Unknown';
            }
            
            if (allCoordinates.length > 0) {
                const koordinatDetail = document.getElementById('koordinat_detail');
                if (koordinatDetail) koordinatDetail.classList.remove('hidden');
                
                updateCoordinateSummary();
                
                filteredCoordinates = [...allCoordinates];
                currentPage = 1;
                displayCoordinates();
                
                const lati1 = document.getElementById('lati_1');
                const longi1 = document.getElementById('longi_1');
                if (lati1) lati1.value = allCoordinates[0].lat;
                if (longi1) longi1.value = allCoordinates[0].lng;
                
                initializeCoordinateFeatures();
            }
        } catch (error) {
            console.error('Error extracting coordinates from GeoJSON:', error);
        }
    }

    // Extract coordinates from a single GeoJSON feature
    function extractCoordinatesFromFeature(feature) {
        let coords = [];
        
        if (feature.geometry) {
            const geometry = feature.geometry;
            
            if (geometry.type === 'Polygon') {
                geometry.coordinates[0].forEach(coord => {
                    coords.push({
                        lat: coord[1],
                        lng: coord[0]
                    });
                });
            } else if (geometry.type === 'MultiPolygon') {
                geometry.coordinates.forEach(polygon => {
                    polygon[0].forEach(coord => {
                        coords.push({
                            lat: coord[1],
                            lng: coord[0]
                        });
                    });
                });
            } else if (geometry.type === 'LineString') {
                geometry.coordinates.forEach(coord => {
                    coords.push({
                        lat: coord[1],
                        lng: coord[0]
                    });
                });
            } else if (geometry.type === 'MultiLineString') {
                geometry.coordinates.forEach(lineString => {
                    lineString.forEach(coord => {
                        coords.push({
                            lat: coord[1],
                            lng: coord[0]
                        });
                    });
                });
            } else if (geometry.type === 'Point') {
                coords.push({
                    lat: geometry.coordinates[1],
                    lng: geometry.coordinates[0]
                });
            }
        }
        
        return coords;
    }

    // Update coordinate summary information
    function updateCoordinateSummary() {
        const totalCoords = document.getElementById('total_coords');
        const coordinateCount = document.getElementById('coordinate_count');
        const geometryType = document.getElementById('geometry_type');
        
        if (totalCoords) totalCoords.textContent = allCoordinates.length;
        if (coordinateCount) coordinateCount.textContent = `${allCoordinates.length} koordinat`;
        if (geometryType) geometryType.textContent = currentGeometryType;
    }

    // Display coordinates with pagination
    function displayCoordinates() {
        const koordinatList = document.getElementById('coordinate_list');
        if (!koordinatList) return;
        
        koordinatList.innerHTML = '';
        
        const startIndex = (currentPage - 1) * itemsPerPage;
        const endIndex = itemsPerPage === 0 ? filteredCoordinates.length : startIndex + itemsPerPage;
        const pageCoords = filteredCoordinates.slice(startIndex, endIndex);
        
        if (pageCoords.length === 0) {
            koordinatList.innerHTML = `
                <div class="p-4 text-center text-gray-500">
                    <i class="fas fa-search text-2xl mb-2"></i>
                    <p>Tidak ada koordinat yang sesuai dengan pencarian</p>
                </div>
            `;
        } else {
            pageCoords.forEach((coord, index) => {
                const globalIndex = startIndex + index + 1;
                const coordDiv = document.createElement('div');
                coordDiv.className = 'flex items-center justify-between p-2 border-b border-gray-100 hover:bg-gray-50';
                coordDiv.innerHTML = `
                    <div class="flex items-center space-x-3 flex-1">
                        <div class="w-6 h-6 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-red-600 font-semibold text-xs">${globalIndex}</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="text-xs font-medium text-gray-800 truncate">
                                <i class="fas fa-map-pin mr-1 text-red-600"></i>
                                Lat: <span class="font-mono">${parseFloat(coord.lat).toFixed(6)}</span>
                            </div>
                            <div class="text-xs font-medium text-gray-800 truncate">
                                <i class="fas fa-map-pin mr-1 text-red-600"></i>
                                Lng: <span class="font-mono">${parseFloat(coord.lng).toFixed(6)}</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-1">
                        <button type="button" onclick="copyCoordinate(${coord.lat}, ${coord.lng})" 
                                class="p-1 text-gray-400 hover:text-teal-600" title="Copy koordinat">
                            <i class="fas fa-copy text-xs"></i>
                        </button>
                        <button type="button" onclick="centerMapOnCoordinate(${coord.lat}, ${coord.lng})" 
                                class="p-1 text-gray-400 hover:text-teal-600" title="Tampilkan di peta">
                            <i class="fas fa-map-marker-alt text-xs"></i>
                        </button>
                    </div>
                `;
                koordinatList.appendChild(coordDiv);
            });
        }
        
        updatePaginationInfo();
    }

    // Update pagination information
    function updatePaginationInfo() {
        const totalPages = Math.ceil(filteredCoordinates.length / (itemsPerPage || filteredCoordinates.length));
        const startIndex = (currentPage - 1) * itemsPerPage + 1;
        const endIndex = Math.min(currentPage * itemsPerPage, filteredCoordinates.length);
        
        const coordinateInfo = document.getElementById('coordinate_info');
        const coordinatePage = document.getElementById('coordinate_page');
        const prevBtn = document.getElementById('prev_coordinates');
        const nextBtn = document.getElementById('next_coordinates');
        
        if (coordinateInfo) {
            coordinateInfo.textContent = `Menampilkan ${startIndex}-${endIndex} dari ${filteredCoordinates.length} koordinat`;
        }
        if (coordinatePage) {
            coordinatePage.textContent = `${currentPage} / ${totalPages}`;
        }
        if (prevBtn) prevBtn.disabled = currentPage <= 1;
        if (nextBtn) nextBtn.disabled = currentPage >= totalPages;
    }

    // Initialize coordinate management features
    function initializeCoordinateFeatures() {
        const toggleCoordinates = document.getElementById('toggle_coordinates');
        if (toggleCoordinates) {
            toggleCoordinates.addEventListener('click', function() {
                const container = document.getElementById('coordinate_list_container');
                const icon = this.querySelector('i');
                const text = this.querySelector('span');
                
                if (container && container.classList.contains('hidden')) {
                    container.classList.remove('hidden');
                    if (icon) icon.className = 'fas fa-chevron-up mr-1';
                    if (text) text.textContent = 'Sembunyikan Detail';
                } else if (container) {
                    container.classList.add('hidden');
                    if (icon) icon.className = 'fas fa-chevron-down mr-1';
                    if (text) text.textContent = 'Lihat Detail';
                }
            });
        }

        const coordinateSearch = document.getElementById('coordinate_search');
        if (coordinateSearch) {
            coordinateSearch.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                filteredCoordinates = allCoordinates.filter(coord => 
                    coord.lat.toString().includes(searchTerm) || 
                    coord.lng.toString().includes(searchTerm)
                );
                currentPage = 1;
                displayCoordinates();
            });
        }

        const coordinateLimit = document.getElementById('coordinate_limit');
        if (coordinateLimit) {
            coordinateLimit.addEventListener('change', function() {
                itemsPerPage = parseInt(this.value);
                currentPage = 1;
                displayCoordinates();
            });
        }

        const prevCoordinates = document.getElementById('prev_coordinates');
        if (prevCoordinates) {
            prevCoordinates.addEventListener('click', function() {
                if (currentPage > 1) {
                    currentPage--;
                    displayCoordinates();
                }
            });
        }

        const nextCoordinates = document.getElementById('next_coordinates');
        if (nextCoordinates) {
            nextCoordinates.addEventListener('click', function() {
                const totalPages = Math.ceil(filteredCoordinates.length / (itemsPerPage || filteredCoordinates.length));
                if (currentPage < totalPages) {
                    currentPage++;
                    displayCoordinates();
                }
            });
        }

        const exportCoordinates = document.getElementById('export_coordinates');
        if (exportCoordinates) {
            exportCoordinates.addEventListener('click', function() {
                const csvContent = [
                    'No,Latitude,Longitude',
                    ...filteredCoordinates.map((coord, index) => 
                        `${index + 1},${parseFloat(coord.lat).toFixed(6)},${parseFloat(coord.lng).toFixed(6)}`
                    )
                ].join('\n');
                
                const blob = new Blob([csvContent], { type: 'text/csv' });
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = `koordinat_${new Date().toISOString().split('T')[0]}.csv`;
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                window.URL.revokeObjectURL(url);
            });
        }
    }

    // Copy coordinate to clipboard
    function copyCoordinate(lat, lng) {
        const coordText = `${parseFloat(lat).toFixed(6)}, ${parseFloat(lng).toFixed(6)}`;
        navigator.clipboard.writeText(coordText).then(() => {
            const button = event.target.closest('button');
            if (button) {
                const originalIcon = button.innerHTML;
                button.innerHTML = '<i class="fas fa-check text-green-600 text-xs"></i>';
                setTimeout(() => {
                    button.innerHTML = originalIcon;
                }, 1000);
            }
        });
    }

    // Center map on specific coordinate
    function centerMapOnCoordinate(lat, lng) {
        if (window.kkprMap) {
            window.kkprMap.setView([lat, lng], 15);
            const marker = L.marker([lat, lng]).addTo(window.kkprMap);
            marker.bindPopup(`Koordinat: ${parseFloat(lat).toFixed(6)}, ${parseFloat(lng).toFixed(6)}`).openPopup();
            setTimeout(() => {
                window.kkprMap.removeLayer(marker);
            }, 3000);
        }
    }

    // Initialize dynamic forms
    function initDynamicForms() {
        // KBLI dynamic rows
        @php
            $kbliDataForJs = isset($kbli) && is_object($kbli) && method_exists($kbli, 'count') ? $kbli : (isset($model->kkpr_kbli) && is_object($model->kkpr_kbli) && method_exists($model->kkpr_kbli, 'count') ? $model->kkpr_kbli : collect());
            $kbliCountForJs = ($kbliDataForJs && is_object($kbliDataForJs) && method_exists($kbliDataForJs, 'count') && $kbliDataForJs->count() > 0) ? $kbliDataForJs->count() : 1;
        @endphp
        let kbliCount = {{ $kbliCountForJs }};
        const addKbliBtn = document.getElementById('add_kbli');
        if (addKbliBtn) {
            addKbliBtn.addEventListener('click', function() {
                kbliCount++;
                const tbody = document.querySelector('#kbli_tbl tbody');
                const newRow = document.createElement('tr');
                newRow.innerHTML = `
                    <td class="px-4 py-2">
                        <input type="text" class="form-control w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" 
                               name="kode_kbli[]" id="kode_kbli_${kbliCount}" placeholder="Kode KBLI" required>
                    </td>
                    <td class="px-4 py-2">
                        <input type="text" class="form-control w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" 
                               name="judul_kbli[]" id="judul_kbli_${kbliCount}" placeholder="Judul KBLI" required>
                    </td>
                    <td class="px-4 py-2 text-center">
                        <button class="btn btn-danger px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors btn_remove_kbli" type="button">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                `;
                tbody.appendChild(newRow);
            });
        }

        // Remove KBLI row
        document.addEventListener('click', function(e) {
            if (e.target.closest('.btn_remove_kbli')) {
                e.target.closest('tr').remove();
            }
        });

        // Luas lantai dynamic inputs
        @php
            $luasLantaiData = [];
            if (isset($model->luas_lantai) && is_array($model->luas_lantai)) {
                $luasLantaiData = $model->luas_lantai;
            } elseif (old('luas_lantai') && is_array(old('luas_lantai'))) {
                $luasLantaiData = old('luas_lantai');
            }
        @endphp
        const existingLuasLantai = {!! json_encode($luasLantaiData) !!};
        
        const jumlahLantaiInput = document.getElementById('jumlah_lantai');
        if (jumlahLantaiInput) {
            jumlahLantaiInput.addEventListener('input', function() {
                const jumlahLantai = parseInt(this.value) || 0;
                const container = document.getElementById('luas_lantai_container');
                if (!container) return;
                container.innerHTML = '';
                
                for (let i = 1; i <= jumlahLantai; i++) {
                    const div = document.createElement('div');
                    div.className = 'col-lg-3 space-y-2';
                    const existingValue = existingLuasLantai && existingLuasLantai[i - 1] !== undefined ? existingLuasLantai[i - 1] : '';
                    div.innerHTML = `
                        <label for="luas_lantai_${i}" class="block text-sm font-semibold text-gray-700">
                            <i class="fas fa-layer-group mr-2 text-teal-600"></i>
                            Luas Lantai ${i} <span class="text-red-500">m²</span>
                        </label>
                        <input type="number" id="luas_lantai_${i}" name="luas_lantai[]" 
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                               placeholder="Luas Lantai ${i}" 
                               value="${existingValue || ''}">
                    `;
                    container.appendChild(div);
                }
            });
            
            // Initialize on load if jumlah_lantai has value
            @php
                $initialJumlahLantai = old('jumlah_lantai', $model->jumlah_lantai);
            @endphp
            @if($initialJumlahLantai)
                setTimeout(function() {
                    const initialJumlahLantai = {{ $initialJumlahLantai }};
                    if (initialJumlahLantai > 0 && jumlahLantaiInput) {
                        jumlahLantaiInput.value = initialJumlahLantai;
                        jumlahLantaiInput.dispatchEvent(new Event('input'));
                    }
                }, 100);
                @endif
        }
    }

    // Handle NO_KEC change to update kelurahan dropdown
    document.addEventListener('DOMContentLoaded', function() {
        const noKecSelect = document.getElementById('NO_KEC');
        if (noKecSelect) {
            noKecSelect.addEventListener('change', function() {
                const noKec = this.value;
                const noKelSelect = document.getElementById('NO_KEL');
                
                // Reset kelurahan dropdown
                noKelSelect.innerHTML = '<option value="">-- Pilih Desa/Kelurahan --</option>';
                
                if (!noKec) {
                    return;
                }
                
                // Fetch kelurahan based on kecamatan
                fetch(`{{ route('admin.kkpr.get.kelurahan') }}?NO_KEC=${noKec}`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.kelurahan && Object.keys(data.kelurahan).length > 0) {
                        @php
                            $currentKelId = old('NO_KEL', $model->NO_KEL);
                        @endphp
                        const currentKelId = @json($currentKelId);
                        Object.entries(data.kelurahan).forEach(([id, name]) => {
                            const option = document.createElement('option');
                            option.value = id;
                            option.textContent = name;
                            if (currentKelId && String(id) === String(currentKelId)) {
                                option.selected = true;
                            }
                            noKelSelect.appendChild(option);
                        });
                    }
                })
                .catch(error => {
                    console.error('Error fetching kelurahan:', error);
                });
            });
            
            // Load kelurahan on page load if kecamatan is already selected
            @php
                $currentKecId = old('NO_KEC', $model->NO_KEC);
            @endphp
            @if($currentKecId)
                const currentKec = @json($currentKecId);
                if (currentKec) {
                    noKecSelect.value = currentKec;
                    noKecSelect.dispatchEvent(new Event('change'));
                }
            @endif
        }
    });
</script>
@endsection



