@extends('layouts.app')

@section('title', 'Detail Persetujuan Bagi UMK - ' . $model->id)
@section('subtitle', 'Detail lengkap permohonan Persetujuan Bagi UMK')

@section('content')
@php
    $img_path = url('/uploads/berkas/umk/').'/'.$model->id.'/';
    $prop = \DB::table('setup_prop')->where('NO_PROP', 35)->first();
    $kab = \DB::table('setup_kab')->where('NO_PROP', 35)->where('NO_KAB', 10)->first();
    $kec = \DB::table('setup_kec')->where('NO_PROP', 35)->where('NO_KAB', 10)->where('NO_KEC', $model->NO_KEC)->first();
    $kel = \DB::table('setup_kel_fix')->where('NO_PROP', $prop->NO_PROP)->where('NO_KAB',  10)->where('NO_KEC',$kec->NO_KEC ?? '')->where('NO_KEL', $model->NO_KEL)->first();
@endphp

<div class="max-w-7xl mx-auto space-y-6">
    <!-- Hero Section with Gradient -->
    <div class="relative overflow-hidden bg-gradient-to-br from-[#185B3C] via-[#0F3D26] to-[#185B3C] rounded-xl p-6 text-white">
        <div class="absolute inset-0 bg-black/10"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold mb-1">Detail Persetujuan Bagi UMK #{{ $model->id }}</h1>
                    <p class="text-sm text-white/90 mb-4">Informasi lengkap permohonan Persetujuan Bagi UMK</p>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                            <span class="text-xs">Status: {{ $model->proses == 10 ? 'Selesai' : 'Proses' }}</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-calendar text-xs"></i>
                            <span class="text-xs">{{ $model->created_at->format('d M Y H:i') }}</span>
                        </div>
                    </div>
                </div>
                <div class="hidden lg:block">
                    <div class="w-20 h-20 bg-white/10 rounded-full flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-home text-3xl text-white/80"></i>
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
        <a href="{{ route('member.kkprnon.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali
        </a>
        @if($model->proses < 3)
            @can('OPD eksternal')
                <a href="{{ route('member.kkprnon.edit', $model->id) }}" class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                    <i class="fas fa-edit mr-2"></i>
                    Edit
                </a>
                <button onclick="deleteKkprNon({{ $model->id }})" class="inline-flex items-center px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                    <i class="fas fa-trash mr-2"></i>
                    Hapus
                </button>
            @endcan
        @endif
    </div>

    <!-- Stats Cards with Glassmorphism -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="group relative overflow-hidden bg-white/80 backdrop-blur-sm rounded-xl p-4 shadow-lg border border-white/20 hover:shadow-xl transition-all duration-300">
            <div class="absolute inset-0 bg-gradient-to-br from-[#185B3C]/5 to-transparent"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-[#185B3C] to-[#0F3D26] rounded-lg flex items-center justify-center shadow-md">
                    <i class="fas fa-user text-white text-sm"></i>
                </div>
                    <div class="text-right">
                        <p class="text-2xl font-bold text-[#185B3C]">{{ $model->user->name ?? 'N/A' }}</p>
                        <p class="text-xs text-gray-500">Pemohon</p>
            </div>
                </div>
                <h3 class="text-sm font-semibold text-gray-900 mb-1">Biodata Pemohon</h3>
                <div class="flex items-center text-xs text-gray-600">
                    <i class="fas fa-id-card mr-1"></i>
                    <span>{{ $model->user->username ?? 'N/A' }}</span>
                </div>
            </div>
        </div>

        <div class="group relative overflow-hidden bg-white/80 backdrop-blur-sm rounded-xl p-4 shadow-lg border border-white/20 hover:shadow-xl transition-all duration-300">
            <div class="absolute inset-0 bg-gradient-to-br from-green-500/5 to-transparent"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-lg flex items-center justify-center shadow-md">
                    <i class="fas fa-map-marker-alt text-white text-sm"></i>
                </div>
                    <div class="text-right">
                        <p class="text-2xl font-bold text-green-600">{{ $model->luas_tanah ?? 'N/A' }}</p>
                        <p class="text-xs text-gray-500">m²</p>
            </div>
                </div>
                <h3 class="text-sm font-semibold text-gray-900 mb-1">Luas Tanah</h3>
                <div class="flex items-center text-xs text-gray-600">
                    <i class="fas fa-ruler mr-1"></i>
                    <span>{{ $model->luas_dimohon ?? 'N/A' }} m² dimohon</span>
                </div>
            </div>
        </div>
        
        <div class="group relative overflow-hidden bg-white/80 backdrop-blur-sm rounded-xl p-4 shadow-lg border border-white/20 hover:shadow-xl transition-all duration-300">
            <div class="absolute inset-0 bg-gradient-to-br from-orange-500/5 to-transparent"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg flex items-center justify-center shadow-md">
                        <i class="fas fa-building text-white text-sm"></i>
                </div>
                    <div class="text-right">
                        <p class="text-2xl font-bold text-orange-600">{{ $model->jumlah_lantai ?? 'N/A' }}</p>
                        <p class="text-xs text-gray-500">Lantai</p>
                </div>
                </div>
                <h3 class="text-sm font-semibold text-gray-900 mb-1">Rencana Bangunan</h3>
                <div class="flex items-center text-xs text-gray-600">
                    <i class="fas fa-arrow-up mr-1"></i>
                    <span>{{ $model->tinggi_bangunan ?? 'N/A' }} m tinggi</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Information Cards -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        <!-- Informasi Pemohon -->
        <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
            <div class="flex items-center space-x-3 mb-6">
                <div class="w-10 h-10 bg-gradient-to-br from-[#185B3C] to-[#0F3D26] rounded-xl flex items-center justify-center shadow-md">
                    <i class="fas fa-user text-white text-sm"></i>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Biodata Pemohon</h3>
                    <p class="text-sm text-gray-500">Informasi lengkap pemohon</p>
                </div>
            </div>
            
            <!-- Profile Card -->
            <div class="bg-gradient-to-br from-[#185B3C]/5 to-transparent rounded-lg p-4 mb-6">
                <div class="flex items-center space-x-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-[#185B3C] to-[#0F3D26] rounded-full flex items-center justify-center shadow-lg">
                        <i class="fas fa-user text-white text-xl"></i>
                    </div>
                    <div class="flex-1">
                        <h4 class="text-lg font-bold text-gray-900">{{ $model->user->name ?? 'N/A' }}</h4>
                        <p class="text-sm text-gray-600">{{ $model->user->username ?? 'N/A' }}</p>
                        <p class="text-xs text-gray-500 mt-1">{{ $model->user->work ?? 'N/A' }}</p>
                </div>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="space-y-4">
                <div class="flex items-start space-x-3">
                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                        <i class="fas fa-envelope text-blue-600 text-xs"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-gray-600">Email</p>
                        <p class="text-sm text-gray-900 break-all">{{ $model->user->email ?? 'N/A' }}</p>
                    </div>
                </div>
                
                <div class="flex items-start space-x-3">
                    <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                        <i class="fas fa-phone text-green-600 text-xs"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-gray-600">No HP</p>
                        <p class="text-sm text-gray-900">{{ $model->user->phone ?? 'N/A' }}</p>
                    </div>
                </div>
                
                <div class="flex items-start space-x-3">
                    <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                        <i class="fas fa-map-marker-alt text-purple-600 text-xs"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-gray-600">Alamat</p>
                        <p class="text-sm text-gray-900">{{ $model->user->address ?? 'N/A' }}</p>
                    </div>
                </div>
        </div>
            </div>

        <!-- Data Pengajuan Kegiatan dan Lokasi Kegiatan -->
        <div class="xl:col-span-2 bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
            <div class="flex items-center space-x-3 mb-6">
                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-md">
                    <i class="fas fa-home text-white text-sm"></i>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Data Pengajuan Persetujuan Bagi UMK</h3>
                    <p class="text-sm text-gray-500">Informasi lengkap kegiatan dan lokasi</p>
                </div>
            </div>

            <!-- Tabs Navigation -->
            <div class="flex space-x-1 mb-6 bg-gray-100 p-1 rounded-lg">
                <button onclick="showTab('kegiatan')" id="tab-kegiatan" class="flex-1 px-4 py-2 text-sm font-medium rounded-md bg-white text-[#185B3C] shadow-sm transition-all duration-200">
                    <i class="fas fa-home mr-2"></i>Kegiatan
                </button>
                <button onclick="showTab('lokasi')" id="tab-lokasi" class="flex-1 px-4 py-2 text-sm font-medium rounded-md text-gray-600 hover:text-[#185B3C] transition-all duration-200">
                    <i class="fas fa-map-marker-alt mr-2"></i>Lokasi
                </button>
                <button onclick="showTab('bangunan')" id="tab-bangunan" class="flex-1 px-4 py-2 text-sm font-medium rounded-md text-gray-600 hover:text-[#185B3C] transition-all duration-200">
                    <i class="fas fa-building mr-2"></i>Bangunan
                </button>
            </div>

            <!-- Tab Content -->
            <div id="content-kegiatan" class="tab-content">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Left Column -->
                    <div class="space-y-4">
                        <div class="bg-gradient-to-r from-blue-50 to-blue-100 rounded-lg p-4">
                            <div class="flex items-center space-x-3 mb-3">
                                <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-home text-white text-sm"></i>
                </div>
                                <h4 class="font-semibold text-gray-900">Informasi Kegiatan</h4>
                </div>
                            <div class="space-y-3">
                <div>
                                    <label class="text-sm font-semibold text-gray-600">Fungsi</label>
                                    <p class="text-gray-900 mt-1">{{ is_array($model->fungsi) ? implode(', ', $model->fungsi) : ($model->fungsi ?? 'N/A') }}</p>
                </div>
                <div>
                                    <label class="text-sm font-semibold text-gray-600">Alamat Kegiatan</label>
                                    <p class="text-gray-900 mt-1">{{ is_array($model->alamat_kegiatan) ? implode(', ', $model->alamat_kegiatan) : ($model->alamat_kegiatan ?? 'N/A') }}</p>
                </div>
                </div>
            </div>
        </div>

                    <!-- Right Column -->
                    <div class="space-y-4">
                        <div class="bg-gradient-to-r from-purple-50 to-purple-100 rounded-lg p-4">
                            <div class="flex items-center space-x-3 mb-3">
                                <div class="w-8 h-8 bg-purple-500 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-map text-white text-sm"></i>
                </div>
                                <h4 class="font-semibold text-gray-900">Status Tanah</h4>
            </div>
            <div class="space-y-3">
                <div>
                                    <label class="text-sm font-semibold text-gray-600">Status Tanah</label>
                                    <p class="text-gray-900 mt-1">{{ is_array($model->status_tanah) ? implode(', ', $model->status_tanah) : ($model->status_tanah ?? 'N/A') }}</p>
                </div>
                <div>
                                    <label class="text-sm font-semibold text-gray-600">Penggunaan Sekarang</label>
                                    <p class="text-gray-900 mt-1">{{ is_array($model->penggunaan_sekarang) ? implode(', ', $model->penggunaan_sekarang) : ($model->penggunaan_sekarang ?? 'N/A') }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gradient-to-r from-orange-50 to-orange-100 rounded-lg p-4">
                            <div class="flex items-center space-x-3 mb-3">
                                <div class="w-8 h-8 bg-orange-500 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-ruler-combined text-white text-sm"></i>
                                </div>
                                <h4 class="font-semibold text-gray-900">Luas Tanah</h4>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="text-center">
                                    <p class="text-2xl font-bold text-orange-600">{{ $model->luas_tanah ?? 'N/A' }}</p>
                                    <p class="text-xs text-gray-600">Sertifikat (m²)</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-2xl font-bold text-orange-600">{{ $model->luas_dimohon ?? 'N/A' }}</p>
                                    <p class="text-xs text-gray-600">Dimohon (m²)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>

            <div id="content-lokasi" class="tab-content hidden">
                <div class="bg-gradient-to-r from-indigo-50 to-indigo-100 rounded-lg p-6">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-10 h-10 bg-indigo-500 rounded-lg flex items-center justify-center">
                            <i class="fas fa-map-marker-alt text-white text-sm"></i>
                </div>
                        <h4 class="text-lg font-semibold text-gray-900">Lokasi Kegiatan</h4>
                </div>
                    <div class="bg-white rounded-lg p-4 border border-indigo-200">
                        <p class="text-gray-900 leading-relaxed">
                            {{ is_array($model->alamat_kegiatan) ? implode(', ', $model->alamat_kegiatan) : ($model->alamat_kegiatan ?? 'N/A') }}, {{ ucFirst(strToLower($kel->NAMA_KEL ?? '')) }} Kecamatan {{ ucFirst(strToLower($kec->NAMA_KEC ?? '')) }} Kabupaten {{ ucFirst(strToLower($kab->NAMA_KAB ?? '')) }}.
                        </p>
                        <div class="mt-4 flex items-center space-x-4">
                            <a href="{{ route('member.kkprnon.peta', $model->id) }}" class="inline-flex items-center px-4 py-2 bg-indigo-500 text-white rounded-lg hover:bg-indigo-600 transition-colors">
                                <i class="fas fa-search mr-2"></i> Lihat Koordinat
                            </a>
                        </div>
                    </div>
        </div>
    </div>

            <div id="content-bangunan" class="tab-content hidden">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-gradient-to-r from-teal-50 to-teal-100 rounded-lg p-4">
        <div class="flex items-center space-x-3 mb-4">
                            <div class="w-8 h-8 bg-teal-500 rounded-lg flex items-center justify-center">
                <i class="fas fa-building text-white text-sm"></i>
            </div>
                            <h4 class="font-semibold text-gray-900">Rencana Bangunan</h4>
        </div>
            <div class="space-y-3">
                            <div class="flex justify-between items-center">
                                <span class="text-sm font-semibold text-gray-600">Jumlah Lantai</span>
                                <span class="text-lg font-bold text-teal-600">{{ $model->jumlah_lantai ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm font-semibold text-gray-600">Tinggi Bangunan</span>
                                <span class="text-lg font-bold text-teal-600">{{ $model->tinggi_bangunan ?? 'N/A' }} m</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm font-semibold text-gray-600">Luas Bangunan</span>
                                <span class="text-lg font-bold text-teal-600">{{ $model->luas_bangunan ?? 'N/A' }} m²</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-r from-pink-50 to-pink-100 rounded-lg p-4">
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="w-8 h-8 bg-pink-500 rounded-lg flex items-center justify-center">
                                <i class="fas fa-layer-group text-white text-sm"></i>
                            </div>
                            <h4 class="font-semibold text-gray-900">Luas Lantai</h4>
                        </div>
                        <div class="space-y-2">
                            @if(is_array($model->luas_lantai))
                                @foreach($model->luas_lantai as $index => $luas)
                                <div class="flex justify-between items-center bg-white rounded-lg p-2 border border-pink-200">
                                    <span class="text-sm font-semibold text-gray-600">Lantai {{ $index + 1 }}</span>
                                    <span class="text-sm font-bold text-pink-600">{{ $luas }} m²</span>
                                </div>
                                @endforeach
                            @else
                                <div class="flex justify-between items-center bg-white rounded-lg p-2 border border-pink-200">
                                    <span class="text-sm font-semibold text-gray-600">Total</span>
                                    <span class="text-sm font-bold text-pink-600">{{ $model->luas_lantai ?? 'N/A' }} m²</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Dokumen Kegiatan Section -->
    <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
        <div class="flex items-center space-x-3 mb-6">
            <div class="w-10 h-10 bg-gradient-to-br from-[#185B3C] to-[#0F3D26] rounded-xl flex items-center justify-center shadow-md">
                <i class="fas fa-file-alt text-white text-sm"></i>
                </div>
                <div>
                <h3 class="text-lg font-bold text-gray-900">Dokumen Kegiatan</h3>
                <p class="text-sm text-gray-500">Daftar dokumen yang telah diupload</p>
            </div>
        </div>
                
                <!-- Modern Data Table -->
                <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg border border-white/20 overflow-hidden">
                    <!-- Table Header -->
                    <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-gradient-to-br from-[#185B3C] to-[#0F3D26] rounded-lg flex items-center justify-center">
                                    <i class="fas fa-file-alt text-white text-sm"></i>
                </div>
                <div>
                                    <h3 class="text-lg font-bold text-gray-900">Dokumen Persyaratan</h3>
                                    <p class="text-sm text-gray-600">Daftar dokumen yang telah diupload</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Table Content -->
                    <div class="overflow-hidden">
                        <!-- Table Headers -->
                        <div class="px-6 py-3 bg-gray-50/80 border-b border-gray-100">
                            <div class="grid grid-cols-12 gap-4">
                                <div class="col-span-6">
                                    <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">JENIS DOKUMEN</span>
                                </div>
                                <div class="col-span-3">
                                    <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">STATUS</span>
                                </div>
                                <div class="col-span-3">
                                    <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">AKSI</span>
                                </div>
                            </div>
                        </div>

                        <!-- Table Rows -->
                        <div class="divide-y divide-gray-100">

                            <!-- Dokumen Kepemilikan -->
                            <div class="px-6 py-4 hover:bg-gradient-to-r hover:from-[#185B3C]/5 hover:to-transparent transition-all duration-300 group">
                                <div class="grid grid-cols-12 gap-4 items-center">
                                    <div class="col-span-6">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 bg-gradient-to-br from-[#185B3C] to-[#0F3D26] rounded-xl flex items-center justify-center shadow-md group-hover:scale-105 transition-transform">
                                                <i class="fas fa-file-contract text-white text-sm"></i>
                </div>
                <div>
                                                <p class="font-bold text-gray-900 text-sm">Surat Kepemilikan Tanah</p>
                                                <p class="text-xs text-gray-500">Dokumen wajib</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-3">
                                        @if ($model->dok_kepemilikan != null)
                                            <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-gradient-to-r from-green-100 to-green-200 text-green-800 border border-green-300">
                                                <i class="fas fa-check-circle mr-1 text-xs"></i>
                                                Terupload
                                            </span>
                                        @else
                                            <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-gradient-to-r from-yellow-100 to-yellow-200 text-yellow-800 border border-yellow-300">
                                                <i class="fas fa-clock mr-1 text-xs"></i>
                                                Belum Upload
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-span-3">
                                        <div class="flex items-center space-x-1">
                                            @if ($model->dok_kepemilikan != null)
                                                <a target="_blank" href="{{ asset('uploads/berkas/umk/'.$model->id. '/dokumen_kepemilikan/' .$model->dok_kepemilikan) }}" class="p-2 text-gray-400 hover:text-[#185B3C] hover:bg-[#185B3C]/10 rounded-lg transition-all duration-200 hover:scale-105" title="Lihat Dokumen">
                                                    <i class="fas fa-eye text-xs"></i>
                                                </a>
                                            @else
                                                <span class="p-2 text-gray-300" title="Dokumen Kosong">
                                                    <i class="fas fa-eye-slash text-xs"></i>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Surat Pernyataan Mandiri -->
                            <div class="px-6 py-4 hover:bg-gradient-to-r hover:from-blue-50 hover:to-transparent transition-all duration-300 group">
                                <div class="grid grid-cols-12 gap-4 items-center">
                                    <div class="col-span-6">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-md group-hover:scale-105 transition-transform">
                                                <i class="fas fa-file-contract text-white text-sm"></i>
                                            </div>
                                            <div>
                                                <p class="font-bold text-gray-900 text-sm">Surat Pernyataan Mandiri</p>
                                                <p class="text-xs text-gray-500">Dokumen wajib</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-3">
                                        @if ($model->dok_kepemilikan != null)
                                            <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-gradient-to-r from-green-100 to-green-200 text-green-800 border border-green-300">
                                                <i class="fas fa-check-circle mr-1 text-xs"></i>
                                                Terupload
                                            </span>
                                        @else
                                            <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-gradient-to-r from-yellow-100 to-yellow-200 text-yellow-800 border border-yellow-300">
                                                <i class="fas fa-clock mr-1 text-xs"></i>
                                                Belum Upload
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-span-3">
                                        <div class="flex items-center space-x-1">
                                            @if ($model->dok_kepemilikan != null)
                                                <a target="_blank" href="{{ asset('uploads/berkas/umk/'.$model->id. '/dok_kepemilikan/' .$model->dok_kepemilikan) }}" class="p-2 text-gray-400 hover:text-[#185B3C] hover:bg-[#185B3C]/10 rounded-lg transition-all duration-200 hover:scale-105" title="Lihat Dokumen">
                                                    <i class="fas fa-eye text-xs"></i>
                                                </a>
                                            @else
                                                <span class="p-2 text-gray-300" title="Dokumen Kosong">
                                                    <i class="fas fa-eye-slash text-xs"></i>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
            </div>

                            <!-- KTP Pemohon -->
                            <div class="px-6 py-4 hover:bg-gradient-to-r hover:from-green-50 hover:to-transparent transition-all duration-300 group">
                                <div class="grid grid-cols-12 gap-4 items-center">
                                    <div class="col-span-6">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center shadow-md group-hover:scale-105 transition-transform">
                                                <i class="fas fa-id-card text-white text-sm"></i>
        </div>
                <div>
                                                <p class="font-bold text-gray-900 text-sm">KTP Pemohon</p>
                                                <p class="text-xs text-gray-500">Dokumen wajib</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-3">
                                        @if ($model->f_ktp != null)
                                            <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-gradient-to-r from-green-100 to-green-200 text-green-800 border border-green-300">
                                                <i class="fas fa-check-circle mr-1 text-xs"></i>
                                                Terupload
                                            </span>
                                        @else
                                            <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-gradient-to-r from-yellow-100 to-yellow-200 text-yellow-800 border border-yellow-300">
                                                <i class="fas fa-clock mr-1 text-xs"></i>
                                                Belum Upload
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-span-3">
                                        <div class="flex items-center space-x-1">
                                            @if ($model->f_ktp != null)
                                                <a target="_blank" href="{{ asset('uploads/berkas/umk/'.$model->id. '/f_ktp/' .$model->f_ktp) }}" class="p-2 text-gray-400 hover:text-[#185B3C] hover:bg-[#185B3C]/10 rounded-lg transition-all duration-200 hover:scale-105" title="Lihat Dokumen">
                                                    <i class="fas fa-eye text-xs"></i>
                                                </a>
                                            @else
                                                <span class="p-2 text-gray-300" title="Dokumen Kosong">
                                                    <i class="fas fa-eye-slash text-xs"></i>
                    </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Sertifikat Tanah -->
                            <div class="px-6 py-4 hover:bg-gradient-to-r hover:from-purple-50 hover:to-transparent transition-all duration-300 group">
                                <div class="grid grid-cols-12 gap-4 items-center">
                                    <div class="col-span-6">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center shadow-md group-hover:scale-105 transition-transform">
                                                <i class="fas fa-certificate text-white text-sm"></i>
                </div>
                <div>
                                                <p class="font-bold text-gray-900 text-sm">Sertifikat Tanah</p>
                                                <p class="text-xs text-gray-500">Dokumen wajib</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-3">
                                        @if ($model->f_sertifikat != null)
                                            <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-gradient-to-r from-green-100 to-green-200 text-green-800 border border-green-300">
                                                <i class="fas fa-check-circle mr-1 text-xs"></i>
                                                Terupload
                                            </span>
                                        @else
                                            <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-gradient-to-r from-yellow-100 to-yellow-200 text-yellow-800 border border-yellow-300">
                                                <i class="fas fa-clock mr-1 text-xs"></i>
                                                Belum Upload
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-span-3">
                                        <div class="flex items-center space-x-1">
                                            @if ($model->f_sertifikat != null)
                                                <a target="_blank" href="{{ asset('uploads/berkas/umk/'.$model->id. '/f_sertifikat/' .$model->f_sertifikat) }}" class="p-2 text-gray-400 hover:text-[#185B3C] hover:bg-[#185B3C]/10 rounded-lg transition-all duration-200 hover:scale-105" title="Lihat Dokumen">
                                                    <i class="fas fa-eye text-xs"></i>
                                                </a>
                                            @else
                                                <span class="p-2 text-gray-300" title="Dokumen Kosong">
                                                    <i class="fas fa-eye-slash text-xs"></i>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Siteplan/Denah Lokasi -->
                            <div class="px-6 py-4 hover:bg-gradient-to-r hover:from-orange-50 hover:to-transparent transition-all duration-300 group">
                                <div class="grid grid-cols-12 gap-4 items-center">
                                    <div class="col-span-6">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl flex items-center justify-center shadow-md group-hover:scale-105 transition-transform">
                                                <i class="fas fa-map text-white text-sm"></i>
                </div>
                <div>
                                                <p class="font-bold text-gray-900 text-sm">Siteplan/Denah Lokasi</p>
                                                <p class="text-xs text-gray-500">Dokumen wajib</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-3">
                                        @if ($model->f_siteplan != null)
                                            <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-gradient-to-r from-green-100 to-green-200 text-green-800 border border-green-300">
                                                <i class="fas fa-check-circle mr-1 text-xs"></i>
                                                Terupload
                                            </span>
                                        @else
                                            <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-gradient-to-r from-yellow-100 to-yellow-200 text-yellow-800 border border-yellow-300">
                                                <i class="fas fa-clock mr-1 text-xs"></i>
                                                Belum Upload
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-span-3">
                                        <div class="flex items-center space-x-1">
                                            @if ($model->f_siteplan != null)
                                                <a target="_blank" href="{{ asset('uploads/berkas/umk/'.$model->id. '/f_siteplan/' .$model->f_siteplan) }}" class="p-2 text-gray-400 hover:text-[#185B3C] hover:bg-[#185B3C]/10 rounded-lg transition-all duration-200 hover:scale-105" title="Lihat Dokumen">
                                                    <i class="fas fa-eye text-xs"></i>
                                                </a>
                                            @else
                                                <span class="p-2 text-gray-300" title="Dokumen Kosong">
                                                    <i class="fas fa-eye-slash text-xs"></i>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                </div>
            </div>

                            <!-- Akta Perusahaan -->
                            <div class="px-6 py-4 hover:bg-gradient-to-r hover:from-indigo-50 hover:to-transparent transition-all duration-300 group">
                                <div class="grid grid-cols-12 gap-4 items-center">
                                    <div class="col-span-6">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-md group-hover:scale-105 transition-transform">
                                                <i class="fas fa-building text-white text-sm"></i>
                                            </div>
                <div>
                                                <p class="font-bold text-gray-900 text-sm">Akta Perusahaan</p>
                                                <p class="text-xs text-gray-500">Dokumen wajib</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-3">
                                        @if ($model->f_akta != null)
                                            <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-gradient-to-r from-green-100 to-green-200 text-green-800 border border-green-300">
                                                <i class="fas fa-check-circle mr-1 text-xs"></i>
                                                Terupload
                                            </span>
                                        @else
                                            <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-gradient-to-r from-yellow-100 to-yellow-200 text-yellow-800 border border-yellow-300">
                                                <i class="fas fa-clock mr-1 text-xs"></i>
                                                Belum Upload
                                            </span>
                                        @endif
                </div>
                                    <div class="col-span-3">
                                        <div class="flex items-center space-x-1">
                                            @if ($model->f_akta != null)
                                                <a target="_blank" href="{{ asset('uploads/berkas/umk/'.$model->id. '/f_akta/' .$model->f_akta) }}" class="p-2 text-gray-400 hover:text-[#185B3C] hover:bg-[#185B3C]/10 rounded-lg transition-all duration-200 hover:scale-105" title="Lihat Dokumen">
                                                    <i class="fas fa-eye text-xs"></i>
                                                </a>
                                            @else
                                                <span class="p-2 text-gray-300" title="Dokumen Kosong">
                                                    <i class="fas fa-eye-slash text-xs"></i>
                                                </span>
                @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Dokumen NIB -->
                            <div class="px-6 py-4 hover:bg-gradient-to-r hover:from-teal-50 hover:to-transparent transition-all duration-300 group">
                                <div class="grid grid-cols-12 gap-4 items-center">
                                    <div class="col-span-6">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 bg-gradient-to-br from-teal-500 to-teal-600 rounded-xl flex items-center justify-center shadow-md group-hover:scale-105 transition-transform">
                                                <i class="fas fa-file-invoice text-white text-sm"></i>
                                            </div>
                <div>
                                                <p class="font-bold text-gray-900 text-sm">Dokumen NIB</p>
                                                <p class="text-xs text-gray-500">Dokumen wajib</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-3">
                                        @if ($model->f_nib != null)
                                            <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-gradient-to-r from-green-100 to-green-200 text-green-800 border border-green-300">
                                                <i class="fas fa-check-circle mr-1 text-xs"></i>
                                                Terupload
                                            </span>
                                        @else
                                            <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-gradient-to-r from-yellow-100 to-yellow-200 text-yellow-800 border border-yellow-300">
                                                <i class="fas fa-clock mr-1 text-xs"></i>
                                                Belum Upload
                                            </span>
                                        @endif
                </div>
                                    <div class="col-span-3">
                                        <div class="flex items-center space-x-1">
                                            @if ($model->f_nib != null)
                                                <a target="_blank" href="{{ asset('uploads/berkas/umk/'.$model->id. '/f_nib/' .$model->f_nib) }}" class="p-2 text-gray-400 hover:text-[#185B3C] hover:bg-[#185B3C]/10 rounded-lg transition-all duration-200 hover:scale-105" title="Lihat Dokumen">
                                                    <i class="fas fa-eye text-xs"></i>
                                                </a>
                                            @else
                                                <span class="p-2 text-gray-300" title="Dokumen Kosong">
                                                    <i class="fas fa-eye-slash text-xs"></i>
                                                </span>
                @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- KML File -->
                            <div class="px-6 py-4 hover:bg-gradient-to-r hover:from-pink-50 hover:to-transparent transition-all duration-300 group">
                                <div class="grid grid-cols-12 gap-4 items-center">
                                    <div class="col-span-6">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 bg-gradient-to-br from-pink-500 to-pink-600 rounded-xl flex items-center justify-center shadow-md group-hover:scale-105 transition-transform">
                                                <i class="fas fa-map-marked-alt text-white text-sm"></i>
                                            </div>
                <div>
                                                <p class="font-bold text-gray-900 text-sm">KML File</p>
                                                <p class="text-xs text-gray-500">File koordinat</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-3">
                                        @if ($model->f_kml != null)
                                            <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-gradient-to-r from-green-100 to-green-200 text-green-800 border border-green-300">
                                                <i class="fas fa-check-circle mr-1 text-xs"></i>
                                                Terupload
                                            </span>
                                        @else
                                            <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-gradient-to-r from-yellow-100 to-yellow-200 text-yellow-800 border border-yellow-300">
                                                <i class="fas fa-clock mr-1 text-xs"></i>
                                                Belum Upload
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-span-3">
                                        <div class="flex items-center space-x-1">
                                            @if ($model->f_kml != null)
                                                <a target="_blank" href="{{ asset('uploads/berkas/umk/'.$model->id. '/kml/' .$model->f_kml) }}" class="p-2 text-gray-400 hover:text-[#185B3C] hover:bg-[#185B3C]/10 rounded-lg transition-all duration-200 hover:scale-105" title="Lihat Dokumen">
                                                    <i class="fas fa-eye text-xs"></i>
                                                </a>
                                            @else
                                                <span class="p-2 text-gray-300" title="Dokumen Kosong">
                                                    <i class="fas fa-eye-slash text-xs"></i>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>


<!-- Modal Koordinat -->
<div class="modal fade" id="modal-kor" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content"></div>
    </div>
</div>

<script>
    function deleteKkprNon(id) {
        if (confirm('Apakah Anda yakin ingin menghapus permohonan ini?')) {
            fetch(`/admin/kkprnon/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = '/admin/kkprnon';
                } else {
                    alert('Gagal menghapus data');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan');
            });
        }
    }

    function open_koordinat(id) {
        modal = $('#modal-kor').modal('show');
        $.ajax({
            url: '{{ route("member.kkprnon.koordinat", "") }}/' + id,
            type: "GET",
            success: function(data) {
                $('#modal-kor .modal-content').html(data);
            },
            error: function() {
                alert('Gagal memuat data koordinat');
            }
        });
    }

    function showTab(tabName) {
        // Hide all tab contents
        document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.add('hidden');
        });
        
        // Remove active class from all tabs
        document.querySelectorAll('[id^="tab-"]').forEach(tab => {
            tab.classList.remove('bg-white', 'text-[#185B3C]', 'shadow-sm');
            tab.classList.add('text-gray-600');
        });
        
        // Show selected tab content
        document.getElementById('content-' + tabName).classList.remove('hidden');
        
        // Add active class to selected tab
        const activeTab = document.getElementById('tab-' + tabName);
        activeTab.classList.add('bg-white', 'text-[#185B3C]', 'shadow-sm');
        activeTab.classList.remove('text-gray-600');
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




