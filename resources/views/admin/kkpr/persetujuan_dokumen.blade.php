@extends('layouts.app')

@section('title', 'Persetujuan Dokumen KKPR Terbit Otomatis')
@section('subtitle', 'Persetujuan hasil analisa dokumen KKPR Terbit Otomatis #' . $model->id)

@section('content')
@php
    $prop = \DB::table('setup_prop')->where('NO_PROP', 35)->first();
    $kab = \DB::table('setup_kab')->where('NO_PROP', 35)->where('NO_KAB', 10)->first();
    $kec = \DB::table('setup_kec')->where('NO_PROP', 35)->where('NO_KAB', 10)->where('NO_KEC', $model->NO_KEC)->first();
    $kel = \DB::table('setup_kel_fix')->where('NO_PROP', $prop->NO_PROP ?? 35)->where('NO_KAB', 10)->where('NO_KEC', $kec->NO_KEC ?? '')->where('NO_KEL', $model->kelurahan_id)->first();
@endphp

<div class="max-w-7xl mx-auto space-y-6">
    <!-- Hero Section with Gradient -->
    <div class="relative overflow-hidden bg-gradient-to-br from-[#185B3C] via-[#0F3D26] to-[#185B3C] rounded-xl p-6 text-white">
        <div class="absolute inset-0 bg-black/10"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold mb-1">Persetujuan Dokumen KKPR Terbit Otomatis #{{ $model->id }}</h1>
                    <p class="text-sm text-white/90 mb-4">Verifikasi dan persetujuan hasil analisa kesesuaian pemanfaatan ruang</p>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-cyan-400 rounded-full animate-pulse"></div>
                            <span class="text-xs">Menunggu Persetujuan</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-calendar text-xs"></i>
                            <span class="text-xs">{{ $model->created_at->format('d M Y H:i') }}</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-user text-xs"></i>
                            <span class="text-xs">{{ $model->user->name }}</span>
                        </div>
                    </div>
                </div>
                <div class="hidden lg:block">
                    <div class="w-20 h-20 bg-white/10 rounded-full flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-file-check text-3xl text-white/80"></i>
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
            Lihat Detail Lengkap
        </a>
    </div>

    <!-- Informasi Pemohon -->
    <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
        <div class="flex items-center space-x-3 mb-6">
            <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center">
                <i class="fas fa-user text-white text-sm"></i>
            </div>
            <h3 class="text-lg font-bold text-gray-900">Informasi Pemohon</h3>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="space-y-1">
                <p class="text-xs font-medium text-gray-500 uppercase">Nama Pelaku Usaha</p>
                <p class="text-sm font-semibold text-gray-900">{{ $model->user->name }}</p>
            </div>
            <div class="space-y-1">
                <p class="text-xs font-medium text-gray-500 uppercase">NIB</p>
                <p class="text-sm font-semibold text-gray-900">{{ $model->no_nib ?? '-' }}</p>
            </div>
            <div class="space-y-1">
                <p class="text-xs font-medium text-gray-500 uppercase">Diterbitkan Tanggal</p>
                <p class="text-sm font-semibold text-gray-900">{{ $model->tgl_terbit ? date('d F Y', strtotime($model->tgl_terbit)) : '-' }}</p>
            </div>
        </div>
    </div>

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
                <label class="block text-sm font-semibold text-gray-700">
                    <i class="fas fa-map-marker-alt mr-2 text-[#185B3C]"></i>
                    Lokasi Usaha
                </label>
                <div class="px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl">
                    <p class="text-sm text-gray-900">{{ $model->alamat_kegiatan ?? '-' }}</p>
                    <p class="text-xs text-gray-500 mt-1">
                        {{ $kel->NAMA_KEL ?? '-' }}, {{ $kec->NAMA_KEC ?? '-' }}, {{ $kab->NAMA_KAB ?? '-' }}, {{ $prop->NAMA_PROP ?? '-' }}
                    </p>
                </div>
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-semibold text-gray-700">
                    <i class="fas fa-home mr-2 text-[#185B3C]"></i>
                    Penggunaan Lahan saat ini
                </label>
                <div class="px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl">
                    <p class="text-sm text-gray-900">{{ $model->status_penggunaan_tanah ?? '-' }}</p>
                </div>
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-semibold text-gray-700">
                    <i class="fas fa-ruler mr-2 text-[#185B3C]"></i>
                    Luas tanah yang dimohon (m²)
                </label>
                <div class="px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl">
                    <p class="text-sm font-bold text-gray-900">{{ number_format((float)$model->luas_dimohon ?? 0, 2) }} m²</p>
                </div>
            </div>

            <!-- Tabel KBLI -->
            <div class="md:col-span-2 space-y-2">
                <label class="block text-sm font-semibold text-gray-700">
                    <i class="fas fa-list-ul mr-2 text-[#185B3C]"></i>
                    Kode KBLI (Klasifikasi Baku Lapangan Usaha Indonesia)
                </label>
                @if(isset($kbli) && count($kbli) > 0)
                <div class="overflow-x-auto rounded-lg border border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gradient-to-r from-purple-50 to-purple-100">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">No</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Kode KBLI</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Judul KBLI</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($kbli as $index => $kb)
                            <tr class="hover:bg-purple-50 transition-colors">
                                <td class="px-4 py-3 text-sm text-gray-900">{{ $index + 1 }}</td>
                                <td class="px-4 py-3 text-sm font-mono font-semibold text-purple-700">{{ $kb->kode_kbli }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700">{{ $kb->judul_kbli }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl">
                    <p class="text-sm text-gray-500">Belum ada data KBLI</p>
                </div>
                @endif
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
            <div class="space-y-2">
                <label class="block text-sm font-semibold text-gray-700">
                    <i class="fas fa-check-circle mr-2 text-purple-600"></i>
                    Status Rencana Tata Ruang
                </label>
                <div class="px-4 py-3 bg-purple-50 border-2 border-purple-200 rounded-xl">
                    <p class="text-sm font-bold text-purple-900">{{ $model->status_rencana ?? '-' }}</p>
                </div>
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-semibold text-gray-700">
                    <i class="fas fa-seedling mr-2 text-purple-600"></i>
                    Status Lahan Sawah Dilindungi
                </label>
                <div class="px-4 py-3 bg-purple-50 border-2 border-purple-200 rounded-xl">
                    <p class="text-sm font-bold text-purple-900">{{ $model->status_lsd ?? '-' }}</p>
                </div>
            </div>

            <div class="md:col-span-2 space-y-2">
                <label class="block text-sm font-semibold text-gray-700">
                    <i class="fas fa-clipboard-list mr-2 text-purple-600"></i>
                    Rencana Pemanfaatan Ruang
                </label>
                <div class="px-4 py-3 bg-purple-50 border-2 border-purple-200 rounded-xl">
                    <p class="text-sm text-gray-700 whitespace-pre-line">{{ $model->rencana_manfaat ?? '-' }}</p>
                </div>
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-semibold text-gray-700">
                    <i class="fas fa-percentage mr-2 text-purple-600"></i>
                    KDB - Koefisien Dasar Bangunan (maks %)
                </label>
                <div class="px-4 py-3 bg-purple-50 border-2 border-purple-200 rounded-xl">
                    <p class="text-sm font-bold text-purple-900">{{ $model->kdb ?? '-' }} %</p>
                </div>
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-semibold text-gray-700">
                    <i class="fas fa-percentage mr-2 text-purple-600"></i>
                    KLB - Koefisien Lantai Bangunan (maks)
                </label>
                <div class="px-4 py-3 bg-purple-50 border-2 border-purple-200 rounded-xl">
                    <p class="text-sm font-bold text-purple-900">{{ $model->klb ?? '-' }}</p>
                </div>
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-semibold text-gray-700">
                    <i class="fas fa-percentage mr-2 text-purple-600"></i>
                    KDH - Koefisien Daerah Hijau (min %)
                </label>
                <div class="px-4 py-3 bg-purple-50 border-2 border-purple-200 rounded-xl">
                    <p class="text-sm font-bold text-purple-900">{{ $model->kdh ?? '-' }} %</p>
                </div>
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-semibold text-gray-700">
                    <i class="fas fa-ruler-horizontal mr-2 text-purple-600"></i>
                    Garis Sempadan Bangunan (m)
                </label>
                <div class="px-4 py-3 bg-purple-50 border-2 border-purple-200 rounded-xl">
                    <p class="text-sm font-bold text-purple-900">{{ $model->gsb ?? '-' }} m</p>
                </div>
            </div>

            <div class="md:col-span-2 space-y-2">
                <label class="block text-sm font-semibold text-gray-700">
                    <i class="fas fa-ruler-vertical mr-2 text-purple-600"></i>
                    Ketinggian Bangunan Maksimum (m)
                </label>
                <div class="px-4 py-3 bg-purple-50 border-2 border-purple-200 rounded-xl">
                    <p class="text-sm font-bold text-purple-900">{{ $model->tinggi_bangunan ?? '-' }} m</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Card 3: Peta Lokasi -->
    <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
        <div class="flex items-center space-x-3 mb-6">
            <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center">
                <i class="fas fa-map-marked-alt text-white text-sm"></i>
            </div>
            <h3 class="text-lg font-bold text-gray-900">Peta Lokasi & Dokumentasi</h3>
        </div>

        <div class="space-y-4">
            <!-- Foto Peta -->
            @if($model->foto_peta)
            <div class="space-y-2">
                <label class="block text-sm font-semibold text-gray-700">
                    <i class="fas fa-image mr-2 text-blue-600"></i>
                    Foto Peta
                </label>
                <div class="border-2 border-blue-200 rounded-xl overflow-hidden">
                    <img src="{{ url('uploads/berkas/kkpr/' . $model->id . '/peta/' . $model->foto_peta) }}" 
                         alt="Foto Peta" 
                         class="w-full h-auto"
                         onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'400\' height=\'300\'%3E%3Crect fill=\'%23f3f4f6\' width=\'400\' height=\'300\'/%3E%3Ctext fill=\'%236b7280\' font-family=\'Arial\' font-size=\'18\' x=\'50%25\' y=\'50%25\' text-anchor=\'middle\' dominant-baseline=\'middle\'%3EFoto tidak tersedia%3C/text%3E%3C/svg%3E';">
                </div>
            </div>
            @endif

            <!-- Map Container -->
            <div class="space-y-2">
                <label class="block text-sm font-semibold text-gray-700">
                    <i class="fas fa-map mr-2 text-blue-600"></i>
                    Peta Koordinat Lokasi
                </label>
                <div id='mapKu' style='width: 100%; height: 600px; border-radius: 0.75rem; border: 2px solid #e5e7eb;'></div>
            </div>
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
            <div class="space-y-2">
                <label class="block text-sm font-semibold text-gray-700">
                    <i class="fas fa-clipboard-check mr-2 text-orange-600"></i>
                    Pertimbangan
                </label>
                <div class="px-4 py-3 bg-orange-50 border-2 border-orange-200 rounded-xl">
                    <p class="text-sm text-gray-700 whitespace-pre-line">{{ $model->pertimbangan ?? '-' }}</p>
                </div>
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-semibold text-gray-700">
                    <i class="fas fa-user-check mr-2 text-orange-600"></i>
                    Pemeriksa Teknis
                </label>
                <div class="px-4 py-3 bg-orange-50 border-2 border-orange-200 rounded-xl">
                    <p class="text-sm font-bold text-orange-900">
                        {{ $model->pteknis->name ?? '-' }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex justify-center gap-4 mt-8 pb-8">
        <button type="button" onclick="revisiDokumen({{ $model->id }})" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-xl hover:from-red-600 hover:to-red-700 transition-all shadow-lg hover:shadow-xl font-bold text-lg">
            <i class="fas fa-exclamation-circle mr-3 text-xl"></i>
            Revisi Dokumen
        </button>
        <button type="button" onclick="setujuiDokumen({{ $model->id }})" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-green-500 to-teal-600 text-white rounded-xl hover:from-emerald-600 hover:to-teal-700 transition-all shadow-lg hover:shadow-xl font-bold text-lg">
            <i class="fas fa-check-circle mr-3 text-xl"></i>
            Setujui Dokumen
        </button>
    </div>
</div>

<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Initialize Map
    document.addEventListener('DOMContentLoaded', function() {
        initializeMap();
    });

    function initializeMap() {
        // Create map
        const map = L.map('mapKu').setView([-8.2191, 114.3691], 10);
        
        // Base layers
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

        // Load GeoJSON if exists
        @if($model->f_geojson)
            loadGeoJSON(map);
        @endif
    }

    function loadGeoJSON(map) {
        const geojsonUrl = '{{ url("uploads/berkas/kkpr/" . $model->id . "/kml/" . ($model->f_geojson ?? "")) }}';
        
        fetch(geojsonUrl)
            .then(response => response.text())
            .then(geoJsonText => {
                try {
                    const geoJsonData = JSON.parse(geoJsonText);
                    
                    const geoJsonLayer = L.geoJSON(geoJsonData, {
                        style: function(feature) {
                            return {
                                color: '#DC2626',
                                weight: 4,
                                fillColor: '#DC2626',
                                fillOpacity: 0.3
                            };
                        },
                        onEachFeature: function(feature, layer) {
                            if (feature.properties && feature.properties.name) {
                                layer.bindPopup('<strong>' + feature.properties.name + '</strong>');
                            }
                        }
                    });
                    
                    geoJsonLayer.addTo(map);
                    
                    // Fit map to bounds
                    if (geoJsonLayer.getBounds && geoJsonLayer.getBounds().isValid()) {
                        map.fitBounds(geoJsonLayer.getBounds(), {
                            padding: [50, 50]
                        });
                    }
                } catch (error) {
                    console.error('Error parsing GeoJSON:', error);
                    // Show error on map
                    L.popup()
                        .setLatLng([-8.2191, 114.3691])
                        .setContent('<div class="text-red-600 font-semibold">Gagal memuat data GeoJSON</div>')
                        .openOn(map);
                }
            })
            .catch(error => {
                console.error('Error loading GeoJSON:', error);
                // Show error on map
                L.popup()
                    .setLatLng([-8.2191, 114.3691])
                    .setContent('<div class="text-red-600 font-semibold">Gagal memuat file GeoJSON</div>')
                    .openOn(map);
            });
    }

    function revisiDokumen(id) {
        Swal.fire({
            title: 'Revisi Dokumen',
            html: `
                <div class="text-left space-y-4">
                    <p class="text-sm text-gray-600 mb-4">Dokumen akan dikembalikan ke tahap <strong>Survey (Proses 6)</strong> untuk perbaikan. Berikan catatan revisi untuk pemohon:</p>
                    <textarea id="catatanRevisi" class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent" 
                              rows="5" 
                              placeholder="Contoh: Hasil analisa perlu diperbaiki pada bagian kesesuaian zona peruntukan..."
                              required></textarea>
                </div>
            `,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: '<i class="fas fa-paper-plane mr-2"></i>Kirim Revisi',
            cancelButtonText: '<i class="fas fa-times mr-2"></i>Batal',
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            width: '600px',
            customClass: {
                confirmButton: 'px-6 py-3 font-semibold',
                cancelButton: 'px-6 py-3 font-semibold'
            },
            preConfirm: () => {
                const catatan = document.getElementById('catatanRevisi').value;
                if (!catatan || catatan.trim() === '') {
                    Swal.showValidationMessage('Catatan revisi harus diisi!');
                    return false;
                }
                return catatan;
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const catatan = result.value;
                
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

                fetch('{{ route("admin.kkpr.persetujuan.revisi") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        id: id,
                        catatan_revisi: catatan
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Dokumen Direvisi!',
                            html: `
                                <div class="text-left space-y-2">
                                    <p class="text-sm text-gray-700">Dokumen berhasil dikembalikan ke tahap <strong class="text-red-600">Survey</strong>.</p>
                                    <div class="mt-4 p-3 bg-red-50 rounded-lg border border-red-200">
                                        <p class="text-xs font-semibold text-red-800 mb-1">Catatan Revisi:</p>
                                        <p class="text-sm text-gray-700">${catatan}</p>
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
                            text: data.message || 'Terjadi kesalahan saat merevisi dokumen',
                            confirmButtonColor: '#ef4444'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Terjadi kesalahan saat memproses revisi',
                        confirmButtonColor: '#ef4444'
                    });
                });
            }
        });
    }

    function setujuiDokumen(id) {
        Swal.fire({
            title: 'Setujui Dokumen?',
            html: `
                <div class="text-left space-y-3">
                    <p class="text-sm text-gray-600">Dengan menyetujui dokumen ini, maka:</p>
                    <ul class="text-sm text-gray-700 space-y-2 ml-4">
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                            <span>Hasil analisa dinyatakan <strong class="text-green-600">SESUAI</strong></span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-arrow-right text-blue-500 mt-1 mr-2"></i>
                            <span>Proses akan dilanjutkan ke tahap <strong class="text-blue-600">Upload Draft Dokumen</strong></span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-file-signature text-purple-500 mt-1 mr-2"></i>
                            <span>Pemohon akan diberitahu untuk melanjutkan proses TTD</span>
                        </li>
                    </ul>
                </div>
            `,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: '<i class="fas fa-check-circle mr-2"></i>Ya, Setujui!',
            cancelButtonText: '<i class="fas fa-times mr-2"></i>Batal',
            confirmButtonColor: '#10b981',
            cancelButtonColor: '#6b7280',
            width: '600px',
            customClass: {
                confirmButton: 'px-6 py-3 font-semibold',
                cancelButton: 'px-6 py-3 font-semibold'
            }
        }).then((result) => {
            if (result.isConfirmed) {
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

                fetch('{{ route("admin.kkpr.persetujuan.setuju") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        id: id
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Dokumen Disetujui!',
                            html: `
                                <div class="text-left space-y-2">
                                    <p class="text-sm text-gray-700">Dokumen berhasil disetujui dan proses dilanjutkan ke tahap <strong class="text-green-600">Upload Draft</strong>.</p>
                                    <div class="mt-4 p-3 bg-green-50 rounded-lg border border-green-200">
                                        <p class="text-xs font-semibold text-green-800 mb-1"><i class="fas fa-info-circle mr-1"></i>Status:</p>
                                        <p class="text-sm text-gray-700">Menunggu upload draft dokumen oleh admin</p>
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
                            text: data.message || 'Terjadi kesalahan saat menyetujui dokumen',
                            confirmButtonColor: '#ef4444'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Terjadi kesalahan saat memproses persetujuan',
                        confirmButtonColor: '#ef4444'
                    });
                });
            }
        });
    }
</script>
@endsection

