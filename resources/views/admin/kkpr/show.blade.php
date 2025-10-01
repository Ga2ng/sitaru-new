@extends('layouts.app')

@section('title', 'Detail KKPR - ' . $model->id)
@section('subtitle', 'Detail lengkap permohonan KKPR')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">
    <!-- Hero Section with Gradient -->
    <div class="relative overflow-hidden bg-gradient-to-br from-[#185B3C] via-[#0F3D26] to-[#185B3C] rounded-xl p-6 text-white">
        <div class="absolute inset-0 bg-black/10"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold mb-1">Detail KKPR #{{ $model->id }}</h1>
                    <p class="text-sm text-white/90 mb-4">Informasi lengkap permohonan KKPR</p>
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
                        <i class="fas fa-file-alt text-3xl text-white/80"></i>
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
        <a href="{{ route('admin.kkpr.edit', $model->id) }}" class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
            <i class="fas fa-edit mr-2"></i>
            Edit
        </a>
        <button onclick="deleteKkpr({{ $model->id }})" class="inline-flex items-center px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
            <i class="fas fa-trash mr-2"></i>
            Hapus
        </button>
    </div>

    <!-- Information Cards -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Informasi Pemohon -->
        <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
            <div class="flex items-center space-x-3 mb-4">
                <div class="w-8 h-8 bg-gradient-to-br from-[#185B3C] to-[#0F3D26] rounded-lg flex items-center justify-center">
                    <i class="fas fa-user text-white text-sm"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900">Informasi Pemohon</h3>
            </div>
            <div class="space-y-3">
                <div>
                    <label class="text-sm font-semibold text-gray-600">Nama Lengkap</label>
                    <p class="text-gray-900">{{ $model->user->name ?? 'N/A' }}</p>
                </div>
                <div>
                    <label class="text-sm font-semibold text-gray-600">NIK</label>
                    <p class="text-gray-900">{{ $model->user->nik ?? 'N/A' }}</p>
                </div>
                <div>
                    <label class="text-sm font-semibold text-gray-600">Email</label>
                    <p class="text-gray-900">{{ $model->user->email ?? 'N/A' }}</p>
                </div>
                <div>
                    <label class="text-sm font-semibold text-gray-600">Telepon</label>
                    <p class="text-gray-900">{{ $model->user->phone ?? 'N/A' }}</p>
                </div>
                <div>
                    <label class="text-sm font-semibold text-gray-600">Pekerjaan</label>
                    <p class="text-gray-900">{{ $model->user->work ?? 'N/A' }}</p>
                </div>
                <div>
                    <label class="text-sm font-semibold text-gray-600">Alamat</label>
                    <p class="text-gray-900">{{ $model->user->address ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

        <!-- Informasi Tanah -->
        <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
            <div class="flex items-center space-x-3 mb-4">
                <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-map-marker-alt text-white text-sm"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900">Informasi Tanah</h3>
            </div>
            <div class="space-y-3">
                <div>
                    <label class="text-sm font-semibold text-gray-600">Alamat Tanah</label>
                    <p class="text-gray-900">{{ $model->alamat_tanah ?? 'N/A' }}</p>
                </div>
                <div>
                    <label class="text-sm font-semibold text-gray-600">Kabupaten</label>
                    <p class="text-gray-900">{{ $model->kabupaten->NAMA_KAB ?? 'N/A' }}</p>
                </div>
                <div>
                    <label class="text-sm font-semibold text-gray-600">Kecamatan</label>
                    <p class="text-gray-900">{{ $model->kecamatan->NAMA_KEC ?? 'N/A' }}</p>
                </div>
                <div>
                    <label class="text-sm font-semibold text-gray-600">Kelurahan</label>
                    <p class="text-gray-900">{{ $model->kelurahan->NAMA_KEL ?? 'N/A' }}</p>
                </div>
                <div>
                    <label class="text-sm font-semibold text-gray-600">Luas Tanah</label>
                    <p class="text-gray-900">{{ $model->luas ?? 'N/A' }} m²</p>
                </div>
                <div>
                    <label class="text-sm font-semibold text-gray-600">RT/RW</label>
                    <p class="text-gray-900">{{ $model->rt ?? 'N/A' }}/{{ $model->rw ?? 'N/A' }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Informasi Kegiatan -->
    <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
        <div class="flex items-center space-x-3 mb-4">
            <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg flex items-center justify-center">
                <i class="fas fa-building text-white text-sm"></i>
            </div>
            <h3 class="text-lg font-bold text-gray-900">Informasi Kegiatan</h3>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-3">
                <div>
                    <label class="text-sm font-semibold text-gray-600">Fungsi</label>
                    <p class="text-gray-900">{{ $model->fungsi ?? 'N/A' }}</p>
                </div>
                <div>
                    <label class="text-sm font-semibold text-gray-600">Jenis Kegiatan</label>
                    <p class="text-gray-900">{{ $model->jenis_kegiatan ?? 'N/A' }}</p>
                </div>
                <div>
                    <label class="text-sm font-semibold text-gray-600">Alamat Kegiatan</label>
                    <p class="text-gray-900">{{ $model->alamat_kegiatan ?? 'N/A' }}</p>
                </div>
                <div>
                    <label class="text-sm font-semibold text-gray-600">Luas Dimohon</label>
                    <p class="text-gray-900">{{ $model->luas_dimohon ?? 'N/A' }} m²</p>
                </div>
            </div>
            <div class="space-y-3">
                <div>
                    <label class="text-sm font-semibold text-gray-600">Status Penggunaan Tanah</label>
                    <p class="text-gray-900">{{ $model->status_penggunaan_tanah ?? 'N/A' }}</p>
                </div>
                <div>
                    <label class="text-sm font-semibold text-gray-600">Jumlah Lantai</label>
                    <p class="text-gray-900">{{ $model->jumlah_lantai ?? 'N/A' }}</p>
                </div>
                <div>
                    <label class="text-sm font-semibold text-gray-600">Tinggi Bangunan</label>
                    <p class="text-gray-900">{{ $model->tinggi_bangunan ?? 'N/A' }} m</p>
                </div>
                <div>
                    <label class="text-sm font-semibold text-gray-600">NIB</label>
                    <p class="text-gray-900">{{ $model->nib ?? 'N/A' }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- KBLI Information -->
    @if($model->kkpr_kbli && $model->kkpr_kbli->count() > 0)
    <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
        <div class="flex items-center space-x-3 mb-4">
            <div class="w-8 h-8 bg-gradient-to-br from-green-500 to-green-600 rounded-lg flex items-center justify-center">
                <i class="fas fa-list text-white text-sm"></i>
            </div>
            <h3 class="text-lg font-bold text-gray-900">KBLI</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="text-left py-2 text-sm font-semibold text-gray-600">Kode KBLI</th>
                        <th class="text-left py-2 text-sm font-semibold text-gray-600">Judul KBLI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($model->kkpr_kbli as $kbli)
                    <tr class="border-b border-gray-100">
                        <td class="py-2 text-sm text-gray-900">{{ $kbli->kode_kbli }}</td>
                        <td class="py-2 text-sm text-gray-900">{{ $kbli->judul_kbli }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    <!-- Koordinat Information -->
    @if($model->kkpr_koordinat && $model->kkpr_koordinat->count() > 0)
    <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
        <div class="flex items-center space-x-3 mb-4">
            <div class="w-8 h-8 bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg flex items-center justify-center">
                <i class="fas fa-map text-white text-sm"></i>
            </div>
            <h3 class="text-lg font-bold text-gray-900">Koordinat</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="text-left py-2 text-sm font-semibold text-gray-600">Longitude</th>
                        <th class="text-left py-2 text-sm font-semibold text-gray-600">Latitude</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($model->kkpr_koordinat as $koordinat)
                    <tr class="border-b border-gray-100">
                        <td class="py-2 text-sm text-gray-900">{{ $koordinat->longi }}</td>
                        <td class="py-2 text-sm text-gray-900">{{ $koordinat->lati }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    <!-- Status Information -->
    <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
        <div class="flex items-center space-x-3 mb-4">
            <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-lg flex items-center justify-center">
                <i class="fas fa-info-circle text-white text-sm"></i>
            </div>
            <h3 class="text-lg font-bold text-gray-900">Status & Riwayat</h3>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-3">
                <div>
                    <label class="text-sm font-semibold text-gray-600">Status Proses</label>
                    @php
                        $statusConfig = [
                            1 => ['label' => 'Pengajuan', 'color' => 'blue'],
                            2 => ['label' => 'Upload Dokumen', 'color' => 'yellow'],
                            3 => ['label' => 'Validasi', 'color' => 'orange'],
                            4 => ['label' => 'Bayar', 'color' => 'purple'],
                            5 => ['label' => 'Validasi Bayar', 'color' => 'indigo'],
                            6 => ['label' => 'Survey', 'color' => 'pink'],
                            7 => ['label' => 'Analisa', 'color' => 'cyan'],
                            8 => ['label' => 'Persetujuan', 'color' => 'teal'],
                            9 => ['label' => 'TTE', 'color' => 'emerald'],
                            10 => ['label' => 'Selesai', 'color' => 'green'],
                        ];
                        $status = $statusConfig[$model->proses] ?? ['label' => 'Unknown', 'color' => 'gray'];
                    @endphp
                    <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-{{ $status['color'] }}-100 text-{{ $status['color'] }}-800 border border-{{ $status['color'] }}-300">
                        {{ $status['label'] }}
                    </span>
                </div>
                <div>
                    <label class="text-sm font-semibold text-gray-600">Tanggal Dibuat</label>
                    <p class="text-gray-900">{{ $model->created_at->format('d M Y H:i') }}</p>
                </div>
                <div>
                    <label class="text-sm font-semibold text-gray-600">Terakhir Diupdate</label>
                    <p class="text-gray-900">{{ $model->updated_at->format('d M Y H:i') }}</p>
                </div>
            </div>
            <div class="space-y-3">
                @if($model->penerima)
                <div>
                    <label class="text-sm font-semibold text-gray-600">Penerima</label>
                    <p class="text-gray-900">{{ $model->penerima }}</p>
                </div>
                @endif
                @if($model->tgl_terima)
                <div>
                    <label class="text-sm font-semibold text-gray-600">Tanggal Terima</label>
                    <p class="text-gray-900">{{ $model->tgl_terima }}</p>
                </div>
                @endif
                @if($model->jam_terima)
                <div>
                    <label class="text-sm font-semibold text-gray-600">Jam Terima</label>
                    <p class="text-gray-900">{{ $model->jam_terima }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    function deleteKkpr(id) {
        if (confirm('Apakah Anda yakin ingin menghapus permohonan ini?')) {
            fetch(`/admin/kkpr/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = '/admin/kkpr';
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
