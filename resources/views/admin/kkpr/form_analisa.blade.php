@extends('layouts.app')

@section('title', 'Form Analisa KKPR Terbit Otomatis')
@section('subtitle', 'Form analisa kesesuaian pemanfaatan ruang')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">
    <!-- Hero Section with Gradient -->
    <div class="relative overflow-hidden bg-gradient-to-br from-[#185B3C] via-[#0F3D26] to-[#185B3C] rounded-xl p-6 text-white">
        <div class="absolute inset-0 bg-black/10"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold mb-1">Form {{ $isEdit ? 'Edit' : 'Tambah' }} Analisa KKPR Terbit Otomatis</h1>
                    <p class="text-sm text-white/90 mb-4">Permohonan #{{ $model->id }} - {{ $model->user && $model->user->name ? $model->user->name : 'N/A' }}</p>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                            <span class="text-xs">Form Aktif</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-info-circle text-xs"></i>
                            <span class="text-xs">Lengkapi semua field analisa</span>
                        </div>
                    </div>
                </div>
                <div class="hidden lg:block">
                    <div class="w-20 h-20 bg-white/10 rounded-full flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-file-signature text-3xl text-white/80"></i>
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
    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('admin.kkpr.analisa.store') }}" enctype="multipart/form-data" class="space-y-6" id="analisaForm">
        @csrf
        <input type="hidden" name="id" value="{{ $model->id }}">
        
        <!-- Card 1: Data Permohonan -->
        <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
            <div class="flex items-center space-x-3 mb-6">
                <div class="w-8 h-8 bg-gradient-to-br from-[#185B3C] to-[#0F3D26] rounded-lg flex items-center justify-center">
                    <i class="fas fa-file-alt text-white text-sm"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900">1. Kesesuaian Kegiatan Pemanfaatan Ruang Terbit Otomatis</h3>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="nama_pemohon" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-user mr-2 text-[#185B3C]"></i>
                        Nama Pelaku Usaha <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="nama_pemohon" name="nama_pemohon" 
                           value="{{ old('nama_pemohon', $model->user && $model->user->name ? $model->user->name : ($model->atas_nama ?? '')) }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                           required readonly>
                </div>

                <div class="space-y-2">
                    <label for="nama_penanggung_jawab" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-user-tie mr-2 text-[#185B3C]"></i>
                        Nama Penanggung Jawab <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="nama_penanggung_jawab" name="nama_penanggung_jawab" 
                           value="{{ old('nama_penanggung_jawab', $model->user && $model->user->name ? $model->user->name : ($model->atas_nama ?? '')) }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                           required>
                </div>

                <div class="space-y-2">
                    <label for="no_nib" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-hashtag mr-2 text-[#185B3C]"></i>
                        NIB <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="no_nib" name="no_nib" 
                           value="{{ old('no_nib', $model->no_nib ?? '') }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                           required>
                </div>

                <div class="space-y-2">
                    <label for="tgl_terbit" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-calendar mr-2 text-[#185B3C]"></i>
                        Diterbitkan Tanggal <span class="text-red-500">*</span>
                    </label>
                    <input type="date" id="tgl_terbit" name="tgl_terbit" 
                           value="{{ old('tgl_terbit', $model->tgl_terbit ?? '') }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                           required>
                </div>

                <!-- KBLI Section -->
                <div class="md:col-span-2 space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-list mr-2 text-[#185B3C]"></i>
                        KBLI
                    </label>
                    <table class="w-full border border-gray-200 rounded-lg overflow-hidden" id="kbli_tbl">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Kode KBLI</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Judul KBLI</th>
                                <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700 w-20">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($kbli) && count($kbli) > 0)
                                @foreach($kbli as $kb => $kbl)
                                    <tr {{ $kb > 0 ? 'id=row_kbli_' . ($kb + 1) : '' }}>
                                        <td class="px-4 py-2 border-t">
                                            <input type="text" class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#185B3C]" 
                                                   name="kode_kbli[]" value="{{ $kbl->kode_kbli }}" required>
                                        </td>
                                        <td class="px-4 py-2 border-t">
                                            <input type="text" class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#185B3C]" 
                                                   name="judul_kbli[]" value="{{ $kbl->judul_kbli }}" required>
                                        </td>
                                        <td class="px-4 py-2 border-t text-center">
                                            @if($kb == 0)
                                                <button class="px-3 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors" 
                                                        type="button" id="add_kbli">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            @else
                                                <button class="px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors btn_remove_kbli" 
                                                        type="button" id="{{ $kb + 1 }}">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="px-4 py-2 border-t">
                                        <input type="text" class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#185B3C]" 
                                               name="kode_kbli[]" placeholder="Kode KBLI" required>
                                    </td>
                                    <td class="px-4 py-2 border-t">
                                        <input type="text" class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#185B3C]" 
                                               name="judul_kbli[]" placeholder="Judul KBLI" required>
                                    </td>
                                    <td class="px-4 py-2 border-t text-center">
                                        <button class="px-3 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors" 
                                                type="button" id="add_kbli">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <div class="space-y-2">
                    <label for="alamat_kegiatan" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-map-marker-alt mr-2 text-[#185B3C]"></i>
                        Lokasi Usaha <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="alamat_kegiatan" name="alamat_kegiatan" 
                           value="{{ old('alamat_kegiatan', $model->alamat_kegiatan ?? '') }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                           required>
                </div>

                <div class="space-y-2">
                    <label for="status_penggunaan_tanah" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-home mr-2 text-[#185B3C]"></i>
                        Penggunaan Lahan saat ini <span class="text-red-500">*</span>
                    </label>
                    <select id="status_penggunaan_tanah" name="status_penggunaan_tanah" 
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                            required>
                        <option value="">Pilih Status Penggunaan Lahan</option>
                        <option value="Sudah Terbangun" {{ old('status_penggunaan_tanah', $model->status_penggunaan_tanah ?? '') == 'Sudah Terbangun' ? 'selected' : '' }}>Sudah Terbangun</option>
                        <option value="Proses Pembangunan" {{ old('status_penggunaan_tanah', $model->status_penggunaan_tanah ?? '') == 'Proses Pembangunan' ? 'selected' : '' }}>Proses Pembangunan</option>
                        <option value="Kosong" {{ old('status_penggunaan_tanah', $model->status_penggunaan_tanah ?? '') == 'Kosong' ? 'selected' : '' }}>Kosong</option>
                    </select>
                </div>

                <div class="space-y-2">
                    <label for="luas_dimohon" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-ruler mr-2 text-[#185B3C]"></i>
                        Luas tanah yang dimohon (m²) <span class="text-red-500">*</span>
                    </label>
                    <input type="number" id="luas_dimohon" name="luas_dimohon" 
                           value="{{ old('luas_dimohon', $model->luas_dimohon ?? '') }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                           step="0.01" required>
                </div>

                <div class="space-y-2">
                    <label for="atas_nama" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-user-circle mr-2 text-[#185B3C]"></i>
                        Atas Nama <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="atas_nama" name="atas_nama" 
                           value="{{ old('atas_nama', $model->atas_nama ?? '') }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                           required>
                </div>

                <div class="space-y-2">
                    <label for="no_sk" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-file-alt mr-2 text-[#185B3C]"></i>
                        Nomor SK <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="no_sk" name="no_sk" 
                           value="{{ old('no_sk', $model->no_sk ?? '') }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                           required readonly>
                </div>

                <div class="space-y-2">
                    <label for="tanggal_sk" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-calendar-alt mr-2 text-[#185B3C]"></i>
                        Tanggal SK <span class="text-red-500">*</span>
                    </label>
                    <input type="date" id="tanggal_sk" name="tanggal_sk" 
                           value="{{ old('tanggal_sk', $model->tanggal_sk ?? '') }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                           required>
                </div>
            </div>
        </div>

        <!-- Card 2: Rencana Tata Ruang -->
        <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
            <div class="flex items-center space-x-3 mb-6">
                <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-map text-white text-sm"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900">2. Dinyatakan terhadap rencana tata ruang dengan ketentuan</h3>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @php
                    $statusLsdStored = isset($model) ? (string) ($model->status_lsd ?? '') : '';
                    $parsedStatusLsdOption = $statusLsdStored;
                    $parsedStatusLsdLuasan = '';
                    if (strpos($statusLsdStored, '=') !== false) {
                        [$parsedStatusLsdOption, $statusLsdLuasanPart] = array_map('trim', explode('=', $statusLsdStored, 2));
                        $parsedStatusLsdLuasan = preg_replace('/\s*m2$/i', '', $statusLsdLuasanPart);
                    }
                    $statusLsdCurrent = old('status_lsd', $parsedStatusLsdOption);
                    $statusLsdLuasanCurrent = old('status_lsd_luasan', $parsedStatusLsdLuasan);
                @endphp
                <div class="space-y-2">
                    <label for="status_lsd" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-seedling mr-2 text-purple-600"></i>
                        Status Lahan Sawah Dilindungi <span class="text-red-500">*</span>
                    </label>
                    <select id="status_lsd" name="status_lsd" 
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                            required>
                        <option value="">Pilih Status</option>
                        <option value="Berada" {{ $statusLsdCurrent == 'Berada' ? 'selected' : '' }}>Berada</option>
                        <option value="Tidak Berada" {{ $statusLsdCurrent == 'Tidak Berada' ? 'selected' : '' }}>Tidak Berada</option>
                    </select>
                    <div id="status_lsd_luasan_wrapper" class="mt-3" style="{{ $statusLsdCurrent === 'Berada' ? '' : 'display: none;' }}">
                        <div class="flex items-center space-x-2">
                            <span class="text-sm font-semibold text-gray-600">Berada =</span>
                            <input type="number" id="status_lsd_luasan" name="status_lsd_luasan"
                                   value="{{ $statusLsdLuasanCurrent }}"
                                   min="0" step="0.01"
                                   class="flex-1 px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm"
                                   placeholder="Masukkan luasan lahan (m²)">
                            <span class="text-sm font-semibold text-gray-600">m²</span>
                        </div>
                        @error('status_lsd_luasan')
                            <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                                <i class="fas fa-exclamation-circle text-xs"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="space-y-2">
                    <label for="rencana_manfaat" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-clipboard-list mr-2 text-purple-600"></i>
                        Rencana Pemanfaatan Ruang <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="rencana_manfaat" name="rencana_manfaat" 
                           value="{{ old('rencana_manfaat', $model->rencana_manfaat ?? '') }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                           placeholder="Masukkan rencana pemanfaatan ruang..." required>
                </div>

                <div class="space-y-2">
                    <label for="lokasi_rencana" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-map-marker-alt mr-2 text-purple-600"></i>
                        Lokasi Rencana Tata Ruang
                    </label>
                    <input type="text" id="lokasi_rencana" name="lokasi_rencana" 
                           value="{{ old('lokasi_rencana', $model->lokasi_rencana ?? '') }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                           placeholder="Masukkan lokasi rencana tata ruang...">
                </div>

                <div class="space-y-2">
                    <label for="status_rencana" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-check-circle mr-2 text-purple-600"></i>
                        Status Rencana Tata Ruang <span class="text-red-500">*</span>
                    </label>
                    <select id="status_rencana" name="status_rencana" 
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                            required onchange="toggleLuasField()">
                        <option value="">Pilih Status</option>
                        <option value="disetujui_seluruhnya" {{ old('status_rencana', $model->status_rencana ?? '') == 'disetujui_seluruhnya' ? 'selected' : '' }}>Disetujui Seluruhnya</option>
                        <option value="disetujui_sebagian" {{ old('status_rencana', $model->status_rencana ?? '') == 'disetujui_sebagian' ? 'selected' : '' }}>Disetujui Sebagian</option>
                    </select>
                </div>

                <div class="space-y-2" id="luas_disetujui_field" style="display: none;">
                    <label for="luas_disetujui" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-ruler mr-2 text-purple-600"></i>
                        Luas Lahan yang Disetujui (m²) <span class="text-red-500">*</span>
                    </label>
                    <input type="number" id="luas_disetujui" name="luas_disetujui" 
                           value="{{ old('luas_disetujui', $model->luas_disetujui ?? '') }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                           step="0.01" placeholder="Masukkan luas lahan yang disetujui...">
                </div>

                <div class="space-y-2">
                    <label for="kdb" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-percentage mr-2 text-purple-600"></i>
                        KDB - Koefisien Dasar Bangunan (maks %) <span class="text-red-500">*</span>
                    </label>
                    <input type="number" id="kdb" name="kdb" 
                           value="{{ old('kdb', $model->kdb ?? '') }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                           step="0.01" required>
                </div>

                <div class="space-y-2">
                    <label for="klb" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-percentage mr-2 text-purple-600"></i>
                        KLB - Koefisien Lantai Bangunan (maks) <span class="text-red-500">*</span>
                    </label>
                    <input type="number" id="klb" name="klb" 
                           value="{{ old('klb', $model->klb ?? '') }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                           step="0.01" required>
                </div>

                <div class="space-y-2">
                    <label for="kdh" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-percentage mr-2 text-purple-600"></i>
                        KDH - Koefisien Daerah Hijau (min %) <span class="text-red-500">*</span>
                    </label>
                    <input type="number" id="kdh" name="kdh" 
                           value="{{ old('kdh', $model->kdh ?? '') }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                           step="0.01" required>
                </div>

                <div class="space-y-2">
                    <label for="ktb" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-percentage mr-2 text-purple-600"></i>
                        KTB - Koefisien Tapak Basement (maks %)
                    </label>
                    <input type="number" id="ktb" name="ktb" 
                           value="{{ old('ktb', $model->ktb ?? '') }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                           step="0.01">
                </div>

                <div class="space-y-2">
                    <label for="gsb" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-ruler-horizontal mr-2 text-purple-600"></i>
                        Garis Sempadan Bangunan (m) <span class="text-red-500">*</span>
                    </label>
                    <input type="number" id="gsb" name="gsb" 
                           value="{{ old('gsb', $model->gsb ?? '') }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                           step="0.01" required>
                </div>

                <div class="md:col-span-2 space-y-2">
                    <label for="tinggi_bangunan" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-ruler-vertical mr-2 text-purple-600"></i>
                        Ketinggian Bangunan Maksimum (m)
                    </label>
                    <input type="number" id="tinggi_bangunan" name="tinggi_bangunan" 
                           value="{{ old('tinggi_bangunan', $model->tinggi_bangunan ?? '') }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                           step="0.01">
                </div>
            </div>
        </div>

        <!-- Card 3: Map Section -->
        <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
            <div class="flex items-center space-x-3 mb-6">
                <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-map-marked-alt text-white text-sm"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900">Peta Lokasi</h3>
            </div>

            <div class="space-y-4">
                <!-- Upload KML -->
                <div class="space-y-2">
                    <label for="f_kml" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-upload mr-2 text-blue-600"></i>
                        Upload File KML
                    </label>
                    @if(isset($model) && $model->f_kml != null)
                        <div class="flex items-center space-x-2">
                            <a href="{{ url('uploads/berkas/kkpr/' . $model->id . '/kml/' . $model->f_kml) }}" 
                               target="_blank" 
                               class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">
                                <i class="fa fa-download"></i> Download
                            </a>
                            <input type="text" class="flex-1 px-4 py-2 border border-gray-200 rounded-lg bg-gray-50" 
                                   value="{{ $model->f_kml }}" readonly>
                            <button type="button" onclick="hapusDok({{ $model->id }}, 'f_kml')" 
                                    class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    @else
                        <input type="file" id="f_kml" name="f_kml" accept=".kml" 
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    @endif
                    <textarea name="kml_geojson" id="kml_geojson" style="display: none;" cols="30" rows="10"></textarea>
                </div>

                <!-- Upload Foto Peta -->
                <div class="space-y-2">
                    <label for="foto_peta" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-image mr-2 text-blue-600"></i>
                        Upload Foto Peta
                    </label>
                    @if(isset($model) && $model->foto_peta != null)
                        <div class="flex items-center space-x-2">
                            <a href="{{ url('uploads/berkas/kkpr/' . $model->id . '/peta/' . $model->foto_peta) }}" 
                               target="_blank" 
                               class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">
                                <i class="fa fa-download"></i> Download
                            </a>
                            <input type="text" class="flex-1 px-4 py-2 border border-gray-200 rounded-lg bg-gray-50" 
                                   value="{{ $model->foto_peta }}" readonly>
                            <button type="button" onclick="hapusDok({{ $model->id }}, 'foto_peta')" 
                                    class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    @else
                        <input type="file" id="foto_peta" name="foto_peta" accept="image/*" 
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        <small class="text-gray-500">Format: JPG, JPEG, PNG. Maksimal 8MB</small>
                    @endif
                </div>

                <!-- Map Container -->
                <div id='mapKu' style='width: 100%; height: 80vh; border-radius: 0.5rem; border: 1px solid #e5e7eb;'></div>
            </div>
        </div>

        <!-- Card 4: Pertimbangan -->
        <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
            <div class="flex items-center space-x-3 mb-6">
                <div class="w-8 h-8 bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-lightbulb text-white text-sm"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900">3. Dengan mempertimbangkan</h3>
            </div>
            
            <div class="grid grid-cols-1 gap-6">
                <!-- Dynamic Pertimbangan -->
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <label class="block text-sm font-semibold text-gray-700">
                            <i class="fas fa-clipboard-check mr-2 text-orange-600"></i>
                            Pertimbangan <span class="text-red-500">*</span>
                        </label>
                        <button type="button" id="add_pertimbangan" class="px-3 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">
                            <i class="fas fa-plus mr-1"></i>Tambah
                        </button>
                    </div>
                    <div id="pertimbangan_list">
                        @if(isset($pertimbangan) && is_array($pertimbangan) && count($pertimbangan) > 0)
                            @foreach($pertimbangan as $index => $item)
                                <div class="flex items-center space-x-2 mb-2 pertimbangan-item">
                                    <input type="text" name="pertimbangan[]" value="{{ $item }}" 
                                           class="flex-1 px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                                           placeholder="Masukkan pertimbangan..." required>
                                    @if($index > 0)
                                        <button type="button" class="px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors remove-pertimbangan">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    @endif
                                </div>
                            @endforeach
                        @else
                            <div class="flex items-center space-x-2 mb-2 pertimbangan-item">
                                <input type="text" name="pertimbangan[]" value="{{ old('pertimbangan.0', '') }}" 
                                       class="flex-1 px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                                       placeholder="Masukkan pertimbangan..." required>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Dynamic Ketentuan Lain -->
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <label class="block text-sm font-semibold text-gray-700">
                            <i class="fas fa-list-ul mr-2 text-orange-600"></i>
                            Ketentuan Lain
                        </label>
                        <button type="button" id="add_ketentuan" class="px-3 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                            <i class="fas fa-plus mr-1"></i>Tambah
                        </button>
                    </div>
                    <div id="ketentuan_list">
                        @if(isset($ketentuan_lain) && is_array($ketentuan_lain) && count($ketentuan_lain) > 0)
                            @foreach($ketentuan_lain as $index => $item)
                                <div class="flex items-center space-x-2 mb-2 ketentuan-item">
                                    <input type="text" name="ketentuan_lain[]" value="{{ $item }}" 
                                           class="flex-1 px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                                           placeholder="Masukkan ketentuan lain...">
                                    <button type="button" class="px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors remove-ketentuan">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <!-- Dynamic Keterangan Lain -->
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <label class="block text-sm font-semibold text-gray-700">
                            <i class="fas fa-comment-alt mr-2 text-green-600"></i>
                            Keterangan Lain
                        </label>
                        <button type="button" id="add_keterangan" class="px-3 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">
                            <i class="fas fa-plus mr-1"></i>Tambah
                        </button>
                    </div>
                    <div id="keterangan_list">
                        @if(isset($keterangan_lain) && is_array($keterangan_lain) && count($keterangan_lain) > 0)
                            @foreach($keterangan_lain as $index => $item)
                                <div class="flex items-center space-x-2 mb-2 keterangan-item">
                                    <input type="text" name="keterangan_lain[]" value="{{ $item }}" 
                                           class="flex-1 px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                                           placeholder="Masukkan keterangan lain...">
                                    <button type="button" class="px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors remove-keterangan">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-user-check mr-2 text-orange-600"></i>
                        Pemeriksa Teknis
                    </label>
                    <div id="pemeriksa-container">
                        <div class="pemeriksa-item flex items-center space-x-2 mb-2">
                            <select name="pemeriksa_teknis[]" 
                                    class="flex-1 px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm">
                                <option value="">Pilih Pemeriksa Teknis</option>
                                @foreach($analis as $anal)
                                    <option value="{{ $anal->id }}">
                                        {{ $anal->name }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="button" onclick="removePemeriksa(this)" 
                                    class="px-3 py-3 bg-red-500 text-white rounded-xl hover:bg-red-600 transition-colors">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                    <button type="button" onclick="addPemeriksa()" 
                            class="w-full px-4 py-2 bg-orange-500 text-white rounded-xl hover:bg-orange-600 transition-colors">
                        <i class="fas fa-plus mr-2"></i>Tambah Pemeriksa Teknis
                    </button>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
            <div class="flex items-center justify-between">
                <button type="button" onclick="tolakDokumen({{ $model->id }})" class="px-6 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white font-semibold rounded-xl hover:shadow-lg transform hover:scale-105 transition-all duration-200">
                    <i class="fas fa-times-circle mr-2"></i>
                    Tolak Dokumen
                </button>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('admin.kkpr.index') }}" class="px-6 py-3 text-gray-700 bg-gray-100 hover:bg-gray-200 font-semibold rounded-xl transition-colors duration-200">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali
                    </a>
                    <button type="submit" class="px-6 py-3 bg-gradient-to-r from-[#185B3C] to-[#0F3D26] text-white font-semibold rounded-xl hover:shadow-lg transform hover:scale-105 transition-all duration-200">
                        <i class="fas fa-save mr-2"></i>
                        {{ $isEdit ? 'Update' : 'Simpan' }} Analisa
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
<!-- Leaflet Draw CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet-draw@1.0.4/dist/leaflet.draw.css" />
<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
<!-- Leaflet Draw JS -->
<script src="https://unpkg.com/leaflet-draw@1.0.4/dist/leaflet.draw.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Form Analisa initialized');
        
        // Initialize Map
        initMap();
        
        // KBLI Dynamic Rows
        initKBLIDynamic();
        
        // Dynamic Pertimbangan & Ketentuan
        initDynamicFields();
        
        // Load existing KML if available
        @if(isset($model) && $model->f_geojson != null)
            loadExistingKML();
        @endif
        
    // Initialize new features
    toggleLuasField(); // Set initial state for luas field
    initStatusLsdField();
    });

    // Toggle Luas Field berdasarkan Status Rencana
    function toggleLuasField() {
        const statusSelect = document.getElementById('status_rencana');
        const luasField = document.getElementById('luas_disetujui_field');
        const luasInput = document.getElementById('luas_disetujui');
        
        if (statusSelect.value === 'disetujui_sebagian') {
            luasField.style.display = 'block';
            luasInput.required = true;
        } else {
            luasField.style.display = 'none';
            luasInput.required = false;
            luasInput.value = '';
        }
    }

    function initStatusLsdField() {
        const statusSelect = document.getElementById('status_lsd');
        const wrapper = document.getElementById('status_lsd_luasan_wrapper');
        const luasInput = document.getElementById('status_lsd_luasan');

        if (!statusSelect || !wrapper || !luasInput) {
            return;
        }

        const toggleLuasanField = (value) => {
            if (value === 'Berada') {
                wrapper.style.display = 'block';
                luasInput.required = true;
            } else {
                wrapper.style.display = 'none';
                luasInput.required = false;
                luasInput.value = '';
            }
        };

        toggleLuasanField(statusSelect.value);

        statusSelect.addEventListener('change', function() {
            toggleLuasanField(this.value);
        });
    }

    // Dynamic Pemeriksa Teknis
    function addPemeriksa() {
        const container = document.getElementById('pemeriksa-container');
        const newItem = document.createElement('div');
        newItem.className = 'pemeriksa-item flex items-center space-x-2 mb-2';
        
        // Check if this is the first additional pemeriksa (second overall)
        const isSecondPemeriksa = container.children.length === 1;
        
        if (isSecondPemeriksa) {
            // Second pemeriksa and beyond: use text input
            newItem.innerHTML = `
                <input type="text" name="pemeriksa_teknis[]" 
                       class="flex-1 px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                       placeholder="Masukkan nama pemeriksa teknis...">
                <button type="button" onclick="removePemeriksa(this)" 
                        class="px-3 py-3 bg-red-500 text-white rounded-xl hover:bg-red-600 transition-colors">
                    <i class="fas fa-trash"></i>
                </button>
            `;
        } else {
            // First pemeriksa: use dropdown
            const selectOptions = `@foreach($analis as $anal)
                <option value="{{ $anal->id }}">{{ $anal->name }}</option>
            @endforeach`;
            
            newItem.innerHTML = `
                <select name="pemeriksa_teknis[]" 
                        class="flex-1 px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm">
                    <option value="">Pilih Pemeriksa Teknis</option>
                    ${selectOptions}
                </select>
                <button type="button" onclick="removePemeriksa(this)" 
                        class="px-3 py-3 bg-red-500 text-white rounded-xl hover:bg-red-600 transition-colors">
                    <i class="fas fa-trash"></i>
                </button>
            `;
        }
        
        container.appendChild(newItem);
    }

    function removePemeriksa(button) {
        const container = document.getElementById('pemeriksa-container');
        if (container.children.length > 1) {
            button.parentElement.remove();
        }
    }

    // Initialize Leaflet Map
    function initMap() {
        const map = L.map('mapKu').setView([-8.2191, 114.3691], 10);
        
        const osmLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        });
        
        const satelliteLayer = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            attribution: '© Esri'
        });
        
        const baseLayers = {
            "OpenStreetMap": osmLayer,
            "Satellite": satelliteLayer
        };
        
        osmLayer.addTo(map);
        L.control.layers(baseLayers).addTo(map);

        window.kkprMap = map;
        window.kkprMarkers = [];
        window.kkprPolygon = null;
        window.drawnItems = new L.FeatureGroup();
        map.addLayer(window.drawnItems);

        // Draw Control
        const drawControl = new L.Control.Draw({
            position: 'topright',
            draw: {
                polygon: {
                    allowIntersection: false,
                    showArea: true,
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
                rectangle: true,
                circle: true,
                marker: true
            },
            edit: {
                featureGroup: window.drawnItems,
                remove: true
            }
        });
        
        map.addControl(drawControl);

        // Handle KML upload
        const kmlInput = document.getElementById('f_kml');
        if (kmlInput) {
            kmlInput.addEventListener('change', function(e) {
                if (e.target.files.length > 0) {
                    const file = e.target.files[0];
                    loadKMLFile(file);
                }
            });
        }

        // Draw events
        map.on(L.Draw.Event.CREATED, function(event) {
            const layer = event.layer;
            window.drawnItems.addLayer(layer);
            updateCoordinatesFromDraw();
        });

        map.on(L.Draw.Event.EDITED, function(event) {
            updateCoordinatesFromDraw();
        });

        map.on(L.Draw.Event.DELETED, function(event) {
            updateCoordinatesFromDraw();
        });
    }

    // Load KML File
    function loadKMLFile(file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const kmlText = e.target.result;
            
            window.drawnItems.clearLayers();
            if (window.kkprPolygon) {
                window.kkprMap.removeLayer(window.kkprPolygon);
            }
            
            try {
                const geoJsonData = convertKMLToGeoJSONManual(kmlText);
                document.getElementById('kml_geojson').value = JSON.stringify(geoJsonData);
                
                const geoJsonLayer = L.geoJSON(geoJsonData, {
                    style: function(feature) {
                        return {
                            color: '#DC2626',
                            weight: 4,
                            fillColor: '#DC2626',
                            fillOpacity: 0.3
                        };
                    }
                });
                
                window.kkprMap.addLayer(geoJsonLayer);
                
                if (geoJsonLayer.getBounds) {
                    window.kkprMap.fitBounds(geoJsonLayer.getBounds());
                }
                
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'KML berhasil dimuat',
                    timer: 2000,
                    showConfirmButton: false
                });
                
            } catch (error) {
                console.error('Error loading KML:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Gagal memuat file KML'
                });
            }
        };
        reader.readAsText(file);
    }

    // Convert KML to GeoJSON
    function convertKMLToGeoJSONManual(kmlText) {
        const parser = new DOMParser();
        const kmlDoc = parser.parseFromString(kmlText, 'text/xml');
        const features = [];
        
        const placemarks = kmlDoc.querySelectorAll('Placemark');
        
        placemarks.forEach((placemark, index) => {
            const nameElement = placemark.querySelector('name');
            const name = nameElement ? nameElement.textContent.trim() : `Placemark ${index + 1}`;
            
            const lineString = placemark.querySelector('LineString');
            const polygon = placemark.querySelector('Polygon');
            const point = placemark.querySelector('Point');
            
            if (lineString) {
                const coords = extractCoordinatesFromElement(lineString);
                if (coords.length > 0) {
                    features.push({
                        type: 'Feature',
                        properties: { name: name },
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
                        properties: { name: name },
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
                        properties: { name: name },
                        geometry: {
                            type: 'Point',
                            coordinates: coords[0]
                        }
                    });
                }
            }
        });
        
        return {
            type: 'FeatureCollection',
            features: features
        };
    }

    // Extract coordinates from KML element
    function extractCoordinatesFromElement(element) {
        const coordinates = element.querySelector('coordinates');
        if (!coordinates) return [];
        
        const coordText = coordinates.textContent.trim();
        const coordPairs = coordText.split(/\s+/).filter(coord => coord.trim());
        
        return coordPairs.map(coord => {
            const parts = coord.split(',');
            return [parseFloat(parts[0]), parseFloat(parts[1]), parts[2] ? parseFloat(parts[2]) : 0];
        });
    }

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
                }
            });
            
            if (coordinates.length > 0) {
                const geoJson = {
                    type: "Feature",
                    geometry: {
                        type: "Polygon",
                        coordinates: [coordinates]
                    },
                    properties: {}
                };
                document.getElementById('kml_geojson').value = JSON.stringify(geoJson);
            }
        }
    }

    // Load existing KML
    function loadExistingKML() {
        fetch('{{ url("uploads/berkas/kkpr/" . $model->id . "/kml/" . ($model->f_geojson ?? "")) }}')
            .then(response => response.text())
            .then(geoJsonText => {
                const geoJsonData = JSON.parse(geoJsonText);
                
                const geoJsonLayer = L.geoJSON(geoJsonData, {
                    style: function(feature) {
                        return {
                            color: '#DC2626',
                            weight: 4,
                            fillColor: '#DC2626',
                            fillOpacity: 0.3
                        };
                    }
                });
                
                window.kkprMap.addLayer(geoJsonLayer);
                
                if (geoJsonLayer.getBounds) {
                    window.kkprMap.fitBounds(geoJsonLayer.getBounds());
                }
            })
            .catch(error => console.error('Error loading existing KML:', error));
    }

    // KBLI Dynamic
    function initKBLIDynamic() {
        let kbliCount = {{ isset($kbli) ? count($kbli) : 1 }};
        
        document.getElementById('add_kbli').addEventListener('click', function() {
            kbliCount++;
            const tbody = document.querySelector('#kbli_tbl tbody');
            const newRow = document.createElement('tr');
            newRow.id = `row_kbli_${kbliCount}`;
            newRow.innerHTML = `
                <td class="px-4 py-2 border-t">
                    <input type="text" class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#185B3C]" 
                           name="kode_kbli[]" placeholder="Kode KBLI" required>
                </td>
                <td class="px-4 py-2 border-t">
                    <input type="text" class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#185B3C]" 
                           name="judul_kbli[]" placeholder="Judul KBLI" required>
                </td>
                <td class="px-4 py-2 border-t text-center">
                    <button class="px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors btn_remove_kbli" 
                            type="button" id="${kbliCount}">
                        <i class="fas fa-minus"></i>
                    </button>
                </td>
            `;
            tbody.appendChild(newRow);
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('btn_remove_kbli') || e.target.parentElement.classList.contains('btn_remove_kbli')) {
                const button = e.target.classList.contains('btn_remove_kbli') ? e.target : e.target.parentElement;
                const button_id = button.getAttribute('id');
                document.getElementById('row_kbli_' + button_id).remove();
            }
        });
    }

    // Dynamic Fields for Pertimbangan & Ketentuan
    function initDynamicFields() {
        // Pertimbangan Dynamic
        document.getElementById('add_pertimbangan').addEventListener('click', function() {
            const container = document.getElementById('pertimbangan_list');
            const newItem = document.createElement('div');
            newItem.className = 'flex items-center space-x-2 mb-2 pertimbangan-item';
            newItem.innerHTML = `
                <input type="text" name="pertimbangan[]" 
                       class="flex-1 px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                       placeholder="Masukkan pertimbangan..." required>
                <button type="button" class="px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors remove-pertimbangan">
                    <i class="fas fa-minus"></i>
                </button>
            `;
            container.appendChild(newItem);
        });

        // Ketentuan Dynamic
        document.getElementById('add_ketentuan').addEventListener('click', function() {
            const container = document.getElementById('ketentuan_list');
            const newItem = document.createElement('div');
            newItem.className = 'flex items-center space-x-2 mb-2 ketentuan-item';
            newItem.innerHTML = `
                <input type="text" name="ketentuan_lain[]" 
                       class="flex-1 px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                       placeholder="Masukkan ketentuan lain...">
                <button type="button" class="px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors remove-ketentuan">
                    <i class="fas fa-minus"></i>
                </button>
            `;
            container.appendChild(newItem);
        });

        // Keterangan Dynamic
        document.getElementById('add_keterangan').addEventListener('click', function() {
            const container = document.getElementById('keterangan_list');
            const newItem = document.createElement('div');
            newItem.className = 'flex items-center space-x-2 mb-2 keterangan-item';
            newItem.innerHTML = `
                <input type="text" name="keterangan_lain[]" 
                       class="flex-1 px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                       placeholder="Masukkan keterangan lain...">
                <button type="button" class="px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors remove-keterangan">
                    <i class="fas fa-minus"></i>
                </button>
            `;
            container.appendChild(newItem);
        });

        // Remove handlers
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-pertimbangan') || e.target.parentElement.classList.contains('remove-pertimbangan')) {
                const button = e.target.classList.contains('remove-pertimbangan') ? e.target : e.target.parentElement;
                button.closest('.pertimbangan-item').remove();
            }
            
            if (e.target.classList.contains('remove-ketentuan') || e.target.parentElement.classList.contains('remove-ketentuan')) {
                const button = e.target.classList.contains('remove-ketentuan') ? e.target : e.target.parentElement;
                button.closest('.ketentuan-item').remove();
            }
            
            if (e.target.classList.contains('remove-keterangan') || e.target.parentElement.classList.contains('remove-keterangan')) {
                const button = e.target.classList.contains('remove-keterangan') ? e.target : e.target.parentElement;
                button.closest('.keterangan-item').remove();
            }
        });
    }

    // Hapus Dokumen
    function hapusDok(id, field) {
        Swal.fire({
            title: 'Hapus Dokumen?',
            text: "File akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch('{{ route("admin.kkpr.hapus.dokumen") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        id: id,
                        field: field
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Dokumen berhasil dihapus',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: data.message
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Terjadi kesalahan saat menghapus dokumen'
                    });
                });
            }
        });
    }

    // Tolak Dokumen
    function tolakDokumen(id) {
        Swal.fire({
            title: 'Tolak Dokumen?',
            html: `
                <div class="text-left space-y-4">
                    <div class="p-4 bg-red-50 border border-red-200 rounded-lg">
                        <p class="text-sm text-red-700 font-semibold mb-2">
                            <i class="fas fa-exclamation-triangle mr-2"></i>
                            PERINGATAN: Tindakan ini PERMANEN!
                        </p>
                        <p class="text-xs text-gray-600">
                            Dokumen akan ditolak dan tidak dapat diproses lebih lanjut. 
                            Status akan berubah menjadi <strong>DITOLAK</strong> dan pemohon harus mengajukan permohonan baru.
                        </p>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">Alasan Penolakan <span class="text-red-500">*</span></label>
                        <textarea id="alasanTolak" class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent" 
                                  rows="5" 
                                  placeholder="Contoh: Lokasi kegiatan tidak sesuai dengan peruntukan dalam RTRW..."
                                  required></textarea>
                    </div>
                </div>
            `,
            icon: 'error',
            showCancelButton: true,
            confirmButtonText: '<i class="fas fa-ban mr-2"></i>Ya, Tolak Dokumen',
            cancelButtonText: '<i class="fas fa-times mr-2"></i>Batal',
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#6b7280',
            width: '650px',
            customClass: {
                confirmButton: 'px-6 py-3 font-semibold',
                cancelButton: 'px-6 py-3 font-semibold'
            },
            preConfirm: () => {
                const alasan = document.getElementById('alasanTolak').value;
                if (!alasan || alasan.trim() === '') {
                    Swal.showValidationMessage('Alasan penolakan harus diisi!');
                    return false;
                }
                return alasan;
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const alasan = result.value;
                
                // Loading
                Swal.fire({
                    title: 'Memproses...',
                    text: 'Mohon tunggu sebentar',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    willOpen: () => {
                        Swal.showLoading();
                    }
                });

                fetch('{{ route("admin.kkpr.tolak.dokumen") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        id: id,
                        alasan_tolak: alasan
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Dokumen Ditolak!',
                            html: `
                                <div class="text-left space-y-2">
                                    <p class="text-sm text-gray-700">Permohonan KKPR telah <strong class="text-red-600">DITOLAK</strong> dan tidak dapat diproses lebih lanjut.</p>
                                    <div class="mt-4 p-3 bg-red-50 rounded-lg border border-red-200">
                                        <p class="text-xs font-semibold text-red-800 mb-1">Alasan Penolakan:</p>
                                        <p class="text-sm text-gray-700">${alasan}</p>
                                    </div>
                                </div>
                            `,
                            confirmButtonColor: '#185B3C',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            window.location.href = '{{ route("admin.kkpr.index") }}';
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: data.message || 'Terjadi kesalahan saat menolak dokumen',
                            confirmButtonColor: '#ef4444'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Terjadi kesalahan saat memproses penolakan',
                        confirmButtonColor: '#ef4444'
                    });
                });
            }
        });
    }
</script>
@endsection