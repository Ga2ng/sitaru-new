@extends('layouts.app')

@section('title', 'Proses Pengaduan - ' . $model->id)
@section('subtitle', 'Tindak lanjut pengaduan pemohon')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">
    <!-- Hero Section -->
    <div class="relative overflow-hidden bg-gradient-to-br from-[#185B3C] via-[#0F3D26] to-[#185B3C] rounded-xl p-6 text-white">
        <div class="absolute inset-0 bg-black/10"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold mb-1">Proses Pengaduan #{{ $model->id }}</h1>
                    <p class="text-sm text-white/90 mb-4">Tindak lanjut dan penanganan pengaduan</p>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-2">
                            @php
                                $statusColors = [
                                    'Data Masuk' => 'blue',
                                    'Proses' => 'orange',
                                    'Ditolak' => 'red',
                                    'Selesai' => 'green'
                                ];
                                $color = $statusColors[$model->status] ?? 'gray';
                            @endphp
                            <div class="w-2 h-2 bg-{{ $color }}-400 rounded-full animate-pulse"></div>
                            <span class="text-xs">Status: {{ $model->status }}</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-calendar text-xs"></i>
                            <span class="text-xs">{{ \Carbon\Carbon::parse($model->tgl_masuk)->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>
                <div class="hidden lg:block">
                    <div class="w-20 h-20 bg-white/10 rounded-full flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-cog text-3xl text-white/80"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -translate-y-16 translate-x-16"></div>
        <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full translate-y-12 -translate-x-12"></div>
    </div>

    <!-- Tab Navigation -->
    <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg border border-white/20 overflow-hidden">
        <div class="flex border-b border-gray-200">
            <button onclick="showTab('detail')" id="tab-detail" class="flex-1 px-6 py-4 text-sm font-semibold text-[#185B3C] border-b-2 border-[#185B3C] hover:bg-gray-50 transition-colors">
                <i class="fas fa-info-circle mr-2"></i>
                DETAIL PENGADUAN
            </button>
            <button onclick="showTab('penanganan')" id="tab-penanganan" class="flex-1 px-6 py-4 text-sm font-semibold text-gray-600 border-b-2 border-transparent hover:bg-gray-50 transition-colors">
                <i class="fas fa-wrench mr-2"></i>
                PENANGANAN
            </button>
        </div>
    </div>

    <!-- Tab Content: Detail Pengaduan -->
    <div id="content-detail" class="space-y-6">
        <!-- Detail Pengaduan Card -->
        <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
            <div class="flex items-center space-x-3 mb-6 pb-4 border-b border-gray-200">
                <div class="w-8 h-8 bg-gradient-to-br from-[#185B3C] to-[#0F3D26] rounded-lg flex items-center justify-center">
                    <i class="fas fa-file-alt text-white text-sm"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900">Detail Pengaduan</h3>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="space-y-4">
                    <div>
                        <p class="text-sm font-semibold text-gray-600 mb-1">Nama</p>
                        <p class="text-gray-900">{{ $model->user->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-600 mb-1">No HP</p>
                        <p class="text-gray-900">{{ $model->telp_pengadu }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-600 mb-1">Alamat</p>
                        <p class="text-gray-900">{{ $model->alamat }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-600 mb-1">Kecamatan</p>
                        <p class="text-gray-900">{{ ucfirst(strtolower($kec->NAMA_KEC ?? '')) }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-600 mb-1">Desa</p>
                        <p class="text-gray-900">{{ ucfirst(strtolower($kel->NAMA_KEL ?? '')) }}</p>
                    </div>
                </div>
                
                <div class="space-y-4">
                    <div>
                        <p class="text-sm font-semibold text-gray-600 mb-1">Kondisi Lahan</p>
                        <p class="text-gray-900">{{ $model->kondisi_lahan }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-600 mb-1">Dampak</p>
                        <p class="text-gray-900">{{ $model->dampak }}</p>
                    </div>
                </div>
                
                <div class="space-y-4">
                    <div>
                        <p class="text-sm font-semibold text-gray-600 mb-1">Uraian Pelaporan</p>
                        <p class="text-gray-900 text-justify">{{ $model->uraian }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Lokasi Pengaduan Card -->
        <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
            <div class="flex items-center space-x-3 mb-6 pb-4 border-b border-gray-200">
                <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-map-marked-alt text-white text-sm"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900">Lokasi Pengaduan</h3>
            </div>
            
            <div id="mapKu" class="w-full h-96 rounded-xl border border-gray-200"></div>
        </div>
    </div>

    <!-- Tab Content: Penanganan -->
    <div id="content-penanganan" class="hidden">
        @if($model->status == 'Data Masuk' || $model->status == 'Verifikasi' || $model->status == 'Survey' || $model->status == 'Analisis' || $model->status == 'Draft' || $model->status == 'Proses')
        <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
            <div class="flex items-center space-x-3 mb-6 pb-4 border-b border-gray-200">
                <div class="w-8 h-8 bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-wrench text-white text-sm"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900">Penanganan</h3>
            </div>
            
            <form action="{{ route('admin.pengaduan.proses') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="pengaduan_id" value="{{ $model->id }}">
                
                <div class="space-y-2">
                    <label for="kendala" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-exclamation-circle mr-2 text-orange-600"></i>
                        Kendala <span class="text-red-500">*</span>
                    </label>
                    <textarea id="kendala" name="kendala" rows="4" 
                              class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm resize-none" 
                              placeholder="Jelaskan kendala yang dihadapi" required>{{ old('kendala', $model->kendala) }}</textarea>
                    @error('kendala')
                        <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                            <i class="fas fa-exclamation-circle text-xs"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="solusi" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-lightbulb mr-2 text-orange-600"></i>
                        Solusi <span class="text-red-500">*</span>
                    </label>
                    <textarea id="solusi" name="solusi" rows="4" 
                              class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm resize-none" 
                              placeholder="Jelaskan solusi yang diberikan" required>{{ old('solusi', $model->solusi) }}</textarea>
                    @error('solusi')
                        <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                            <i class="fas fa-exclamation-circle text-xs"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="status" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-flag mr-2 text-orange-600"></i>
                        Status Pengaduan <span class="text-red-500">*</span>
                    </label>
                    <select id="status" name="status" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" required>
                        @foreach(\App\Models\Pengaduan::$statusList as $key => $value)
                            <option value="{{ $key }}" {{ $model->status == $key ? 'selected' : '' }}>{{ $value }}</option>
                        @endforeach
                    </select>
                    @error('status')
                        <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                            <i class="fas fa-exclamation-circle text-xs"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div class="flex items-center justify-center space-x-4 pt-6 border-t border-gray-200">
                    <button type="submit" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-orange-500 to-orange-600 text-white font-semibold rounded-xl hover:shadow-lg transform hover:scale-105 transition-all duration-200">
                        <i class="fas fa-save mr-2"></i>
                        Simpan
                    </button>
                    <a href="{{ route('admin.pengaduan.index') }}" class="inline-flex items-center px-6 py-3 bg-gray-800 hover:bg-gray-900 text-white font-semibold rounded-xl transition-colors duration-200">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali
                    </a>
                </div>
            </form>
        </div>
        @else
        <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-6">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-info-circle text-yellow-600 text-lg"></i>
                </div>
                <div>
                    <h4 class="font-bold text-yellow-900">Pengaduan Sudah Diproses</h4>
                    <p class="text-sm text-yellow-700">Pengaduan ini sudah dalam status {{ $model->status }}</p>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

<script>
    // Initialize map
    var latlngku = [{{ $model->lat_pengaduan ?? '-8.218079' }}, {{ $model->lng_pengaduan ?? '114.3290605' }}];
    var mapku = L.map('mapKu').setView(latlngku, 16);
    
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors',
        maxZoom: 19
    }).addTo(mapku);

    var marker = L.marker(latlngku).addTo(mapku);

    marker.on('click', function() {
        mapku.setView(marker.getLatLng(), 18);
    });

    // Tab switching
    function showTab(tab) {
        // Hide all contents
        document.getElementById('content-detail').classList.add('hidden');
        document.getElementById('content-penanganan').classList.add('hidden');
        
        // Remove active state from all tabs
        document.getElementById('tab-detail').classList.remove('text-[#185B3C]', 'border-[#185B3C]');
        document.getElementById('tab-detail').classList.add('text-gray-600', 'border-transparent');
        document.getElementById('tab-penanganan').classList.remove('text-[#185B3C]', 'border-[#185B3C]');
        document.getElementById('tab-penanganan').classList.add('text-gray-600', 'border-transparent');
        
        // Show selected content and activate tab
        if (tab === 'detail') {
            document.getElementById('content-detail').classList.remove('hidden');
            document.getElementById('tab-detail').classList.remove('text-gray-600', 'border-transparent');
            document.getElementById('tab-detail').classList.add('text-[#185B3C]', 'border-[#185B3C]');
        } else {
            document.getElementById('content-penanganan').classList.remove('hidden');
            document.getElementById('tab-penanganan').classList.remove('text-gray-600', 'border-transparent');
            document.getElementById('tab-penanganan').classList.add('text-[#185B3C]', 'border-[#185B3C]');
        }
        
        // Refresh map
        setTimeout(function() {
            mapku.invalidateSize();
        }, 100);
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

