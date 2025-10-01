@extends('layouts.app')

@section('title', 'Detail Pengaduan - ' . $model->id)
@section('subtitle', 'Detail lengkap pengaduan pemohon')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">
    <!-- Hero Section -->
    <div class="relative overflow-hidden bg-gradient-to-br from-[#185B3C] via-[#0F3D26] to-[#185B3C] rounded-xl p-6 text-white">
        <div class="absolute inset-0 bg-black/10"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold mb-1">Detail Pengaduan #{{ $model->id }}</h1>
                    <p class="text-sm text-white/90 mb-4">Informasi lengkap pengaduan pemohon</p>
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
                        <i class="fas fa-bullhorn text-3xl text-white/80"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -translate-y-16 translate-x-16"></div>
        <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full translate-y-12 -translate-x-12"></div>
    </div>

    <!-- Action Buttons -->
    <div class="flex flex-wrap gap-4">
        <a href="{{ route('admin.pengaduan.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali
        </a>
        <a href="{{ route('admin.pengaduan.edit', $model->id) }}" class="inline-flex items-center px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition-colors">
            <i class="fas fa-cog mr-2"></i>
            Proses/Tindak Lanjut
        </a>
        @if($model->status == 'Data Masuk')
        <button onclick="tolakPengaduan({{ $model->id }})" class="inline-flex items-center px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
            <i class="fas fa-ban mr-2"></i>
            Tolak Pengaduan
        </button>
        @endif
    </div>

    <!-- Information Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Informasi Pengadu -->
        <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
            <div class="flex items-center space-x-3 mb-4">
                <div class="w-8 h-8 bg-gradient-to-br from-[#185B3C] to-[#0F3D26] rounded-lg flex items-center justify-center">
                    <i class="fas fa-user text-white text-sm"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900">Informasi Pengadu</h3>
            </div>
            <div class="space-y-3">
                <div>
                    <label class="text-sm font-semibold text-gray-600">Nama Pengadu</label>
                    <p class="text-gray-900">{{ $model->nama_pengadu }}</p>
                </div>
                <div>
                    <label class="text-sm font-semibold text-gray-600">No. Telepon</label>
                    <p class="text-gray-900">{{ $model->telp_pengadu }}</p>
                </div>
                <div>
                    <label class="text-sm font-semibold text-gray-600">Alamat</label>
                    <p class="text-gray-900">{{ $model->alamat }}</p>
                </div>
                <div>
                    <label class="text-sm font-semibold text-gray-600">Kecamatan</label>
                    <p class="text-gray-900">{{ $model->kecamatan->nama ?? 'N/A' }}</p>
                </div>
                <div>
                    <label class="text-sm font-semibold text-gray-600">Kelurahan</label>
                    <p class="text-gray-900">{{ $model->desa->nama ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

        <!-- Informasi Lahan -->
        <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
            <div class="flex items-center space-x-3 mb-4">
                <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-map-marked-alt text-white text-sm"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900">Informasi Lahan</h3>
            </div>
            <div class="space-y-3">
                <div>
                    <label class="text-sm font-semibold text-gray-600">Kepemilikan</label>
                    <p class="text-gray-900">{{ $model->kepemilikan ?? 'N/A' }}</p>
                </div>
                <div>
                    <label class="text-sm font-semibold text-gray-600">Kondisi Lahan</label>
                    <p class="text-gray-900">{{ $model->kondisi_lahan ?? 'N/A' }}</p>
                </div>
                <div>
                    <label class="text-sm font-semibold text-gray-600">Luas</label>
                    <p class="text-gray-900">{{ $model->luas ?? 'N/A' }} m²</p>
                </div>
                <div>
                    <label class="text-sm font-semibold text-gray-600">Batas Kiri</label>
                    <p class="text-gray-900">{{ $model->bts_kiri ?? 'N/A' }}</p>
                </div>
                <div>
                    <label class="text-sm font-semibold text-gray-600">Batas Kanan</label>
                    <p class="text-gray-900">{{ $model->bts_kanan ?? 'N/A' }}</p>
                </div>
                <div>
                    <label class="text-sm font-semibold text-gray-600">Dampak</label>
                    <p class="text-gray-900">{{ $model->dampak ?? 'N/A' }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Uraian Pengaduan -->
    <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
        <div class="flex items-center space-x-3 mb-4">
            <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg flex items-center justify-center">
                <i class="fas fa-align-left text-white text-sm"></i>
            </div>
            <h3 class="text-lg font-bold text-gray-900">Uraian Pengaduan</h3>
        </div>
        <p class="text-gray-900 text-justify">{{ $model->uraian }}</p>
    </div>

    <!-- Kendala & Solusi -->
    @if($model->kendala || $model->solusi)
    <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
        <div class="flex items-center space-x-3 mb-4">
            <div class="w-8 h-8 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-lg flex items-center justify-center">
                <i class="fas fa-wrench text-white text-sm"></i>
            </div>
            <h3 class="text-lg font-bold text-gray-900">Kendala & Solusi</h3>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="text-sm font-semibold text-gray-600">Kendala</label>
                <p class="text-gray-900">{{ $model->kendala ?? '-' }}</p>
            </div>
            <div>
                <label class="text-sm font-semibold text-gray-600">Solusi</label>
                <p class="text-gray-900">{{ $model->solusi ?? '-' }}</p>
            </div>
        </div>
    </div>
    @endif

    <!-- Foto Dokumentasi -->
    @if($model->foto_1 || $model->foto_2 || $model->foto_3 || $model->foto_4 || $model->foto_5)
    <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
        <div class="flex items-center space-x-3 mb-4">
            <div class="w-8 h-8 bg-gradient-to-br from-pink-500 to-pink-600 rounded-lg flex items-center justify-center">
                <i class="fas fa-images text-white text-sm"></i>
            </div>
            <h3 class="text-lg font-bold text-gray-900">Foto Dokumentasi</h3>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
            @foreach(['foto_1', 'foto_2', 'foto_3', 'foto_4', 'foto_5'] as $foto)
                @if($model->$foto)
                <div class="relative group">
                    <img src="{{ asset('uploads/berkas/pengaduan/' . $model->id . '/' . $model->$foto) }}" 
                         alt="{{ $foto }}" 
                         class="w-full h-40 object-cover rounded-lg shadow-md group-hover:shadow-xl transition-all duration-300 cursor-pointer"
                         onclick="showImage('{{ asset('uploads/berkas/pengaduan/' . $model->id . '/' . $model->$foto) }}')">
                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity rounded-lg flex items-center justify-center">
                        <i class="fas fa-search-plus text-white text-2xl"></i>
                    </div>
                </div>
                @endif
            @endforeach
        </div>
    </div>
    @endif

    <!-- Riwayat -->
    @if($riwayat->count() > 0)
    <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
        <div class="flex items-center space-x-3 mb-4">
            <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-lg flex items-center justify-center">
                <i class="fas fa-history text-white text-sm"></i>
            </div>
            <h3 class="text-lg font-bold text-gray-900">Riwayat Proses</h3>
        </div>
        <div class="space-y-4">
            @foreach($riwayat as $r)
            <div class="flex items-start space-x-4 p-4 bg-gray-50 rounded-lg">
                <div class="flex-shrink-0">
                    @php
                        $statusIcons = [
                            'Data Masuk' => ['icon' => 'inbox', 'color' => 'blue'],
                            'Proses' => ['icon' => 'cog', 'color' => 'orange'],
                            'Ditolak' => ['icon' => 'times-circle', 'color' => 'red'],
                            'Selesai' => ['icon' => 'check-circle', 'color' => 'green']
                        ];
                        $statusIcon = $statusIcons[$r->status] ?? ['icon' => 'question', 'color' => 'gray'];
                    @endphp
                    <div class="w-10 h-10 bg-gradient-to-br from-{{ $statusIcon['color'] }}-500 to-{{ $statusIcon['color'] }}-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-{{ $statusIcon['icon'] }} text-white text-sm"></i>
                    </div>
                </div>
                <div class="flex-1">
                    <h4 class="font-bold text-gray-900 text-sm">{{ $r->status }}</h4>
                    <p class="text-gray-600 text-sm mt-1">{{ $r->keterangan }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>

<!-- Image Modal -->
<div id="imageModal" class="fixed inset-0 z-50 hidden bg-black/80 p-4" style="align-items: center; justify-content: center;" onclick="hideImage()">
    <div class="relative max-w-4xl w-full">
        <button onclick="hideImage()" class="absolute top-4 right-4 text-white bg-black/50 hover:bg-black/70 rounded-full w-10 h-10 flex items-center justify-center">
            <i class="fas fa-times"></i>
        </button>
        <img id="modalImage" src="" alt="Preview" class="w-full h-auto rounded-lg shadow-2xl">
    </div>
</div>

<script>
    function showImage(src) {
        const modal = document.getElementById('imageModal');
        document.getElementById('modalImage').src = src;
        modal.classList.remove('hidden');
        modal.style.display = 'flex';
    }

    function hideImage() {
        const modal = document.getElementById('imageModal');
        modal.classList.add('hidden');
        modal.style.display = 'none';
    }

    function tolakPengaduan(id) {
        if (confirm('Apakah Anda yakin ingin menolak pengaduan ini?')) {
            fetch('/admin/pengaduan/tolak', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ pengaduan_id: id })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Gagal menolak pengaduan');
                }
            });
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

