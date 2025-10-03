@extends('layouts.app')

@section('title', 'Detail KKPR Non Usaha')
@section('subtitle', 'Detail Permohonan KKPR Non Usaha')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">
    <!-- Header Actions -->
    <div class="flex justify-between items-center mb-6">
        <div class="flex items-center space-x-4">
            <a href="{{ route('member.kkprnon.index') }}" class="flex items-center px-4 py-2 text-gray-600 bg-white rounded-lg hover:bg-gray-100 transition-colors border border-gray-300">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali
            </a>
            <a href="{{ route('member.kkprnon.edit', $model->id) }}" class="flex items-center px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors">
                <i class="fas fa-edit mr-2"></i>
                Edit
            </a>
        </div>
        <div class="flex items-center space-x-4">
            <a href="{{ route('member.kkprnon.cetak.detail', $model->id) }}" target="_blank" class="flex items-center px-4 py-2 text-white bg-green-600 rounded-lg hover:bg-green-700 transition-colors">
                <i class="fas fa-file-pdf mr-2"></i>
                Cetak PDF
            </a>
            <button onclick="printData()" class="flex items-center px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors">
                <i class="fas fa-print mr-2"></i>
                Print
            </button>
            <button onclick="shareData()" class="flex items-center px-4 py-2 text-white bg-purple-600 rounded-lg hover:bg-purple-700 transition-colors">
                <i class="fas fa-share mr-2"></i>
                Bagikan
            </button>
        </div>
    </div>

    <!-- Status Card -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="w-16 h-16 bg-gradient-to-br from-[#185B3C] to-[#0F3D26] rounded-xl flex items-center justify-center">
                    <i class="fas fa-home text-white text-2xl"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Detail KKPR Non Usaha</h1>
                    <p class="text-gray-600">ID: #KKPR-NON-{{ str_pad($model->id, 6, '0', STR_PAD_LEFT) }}</p>
                </div>
            </div>
            <div class="text-right">
                @include('member.kkprnon._proses_berkas', ['model' => $model])
            </div>
        </div>
    </div>

    <!-- Data Pemohon -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6">
        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
            <i class="fas fa-user mr-2 text-[#185B3C]"></i>
            Data Pemohon
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                <p class="text-gray-900">{{ $model->user->name ?? '-' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <p class="text-gray-900">{{ $model->user->email ?? '-' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">NIK</label>
                <p class="text-gray-900">{{ $model->user->nik ?? '-' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">No. Telepon</label>
                <p class="text-gray-900">{{ $model->user->phone ?? '-' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Pekerjaan</label>
                <p class="text-gray-900">{{ $model->user->work ?? '-' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                <p class="text-gray-900">{{ $model->user->address ?? '-' }}</p>
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
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Tanah</label>
                <p class="text-gray-900">{{ $model->alamat_tanah ?? '-' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Luas Tanah</label>
                <p class="text-gray-900">{{ $model->luas ? number_format((float)$model->luas) . ' m²' : '-' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">RT/RW</label>
                <p class="text-gray-900">{{ $model->rt ? $model->rt . '/' . $model->rw : '-' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status Penggunaan Tanah</label>
                <p class="text-gray-900">{{ $model->status_penggunaan_tanah ?? '-' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Koordinat</label>
                <p class="text-gray-900">
                    @if($model->longitude && $model->lattitude)
                        {{ $model->longitude }}, {{ $model->lattitude }}
                    @else
                        -
                    @endif
                </p>
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
                <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kegiatan</label>
                <p class="text-gray-900">{{ $model->jenis_kegiatan ?? '-' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Fungsi</label>
                <p class="text-gray-900">{{ $model->fungsi ?? '-' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Kegiatan</label>
                <p class="text-gray-900">{{ $model->alamat_kegiatan ?? '-' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Luas Dimohon</label>
                <p class="text-gray-900">{{ $model->luas_dimohon ? number_format((float)$model->luas_dimohon) . ' m²' : '-' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status Lahan</label>
                <p class="text-gray-900">{{ $model->status_lahan ?? '-' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Penggunaan Sekarang</label>
                <p class="text-gray-900">{{ $model->penggunaan_sekarang ?? '-' }}</p>
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
                <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah Lantai</label>
                <p class="text-gray-900">{{ $model->jumlah_lantai ?? '-' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tinggi Bangunan</label>
                <p class="text-gray-900">{{ $model->tinggi_bangunan ? $model->tinggi_bangunan . ' m' : '-' }}</p>
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Luas Lantai</label>
                <p class="text-gray-900">
                    @if($model->luas_lantai)
                        @if(is_array($model->luas_lantai))
                            @foreach($model->luas_lantai as $index => $luas)
                                Lantai {{ $index + 1 }}: {{ number_format((float)$luas) }} m²<br>
                            @endforeach
                        @else
                            {{ number_format((float)$model->luas_lantai) }} m²
                        @endif
                    @else
                        -
                    @endif
                </p>
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
                <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Sertifikat</label>
                <p class="text-gray-900">{{ $model->jns_sertifikat ?? '-' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">No. Sertifikat</label>
                <p class="text-gray-900">{{ $model->no_sertifikat ?? '-' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Atas Nama</label>
                <p class="text-gray-900">{{ $model->an_sertifikat ?? '-' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tahun Sertifikat</label>
                <p class="text-gray-900">{{ $model->thn_sertifikat ?? '-' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Luas Sertifikat</label>
                <p class="text-gray-900">{{ $model->luas_sertifikat ? number_format((float)$model->luas_sertifikat) . ' m²' : '-' }}</p>
            </div>
        </div>
    </div>

    <!-- Data NIB -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6">
        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
            <i class="fas fa-id-card mr-2 text-[#185B3C]"></i>
            Data NIB
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">No. NIB</label>
                <p class="text-gray-900">{{ $model->no_nib ?? '-' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Terbit</label>
                <p class="text-gray-900">{{ $model->tgl_terbit ?? '-' }}</p>
            </div>
        </div>
    </div>

    <!-- Data KKPR -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6">
        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
            <i class="fas fa-file-alt mr-2 text-[#185B3C]"></i>
            Data KKPR
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">No. KKPR</label>
                <p class="text-gray-900">{{ $model->no_kkpr ?? '-' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal KKPR</label>
                <p class="text-gray-900">{{ $model->tgl_kkpr ?? '-' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Surat</label>
                <p class="text-gray-900">{{ $model->tgl_surat ?? '-' }}</p>
            </div>
        </div>
    </div>

    <!-- KBLI Data -->
    @if($model->kkpr_kbli && $model->kkpr_kbli->count() > 0)
    <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6">
        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
            <i class="fas fa-list mr-2 text-[#185B3C]"></i>
            Data KBLI
        </h3>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode KBLI</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul KBLI</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($model->kkpr_kbli as $kbli)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $kbli->kode_kbli }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $kbli->judul_kbli }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    <!-- Koordinat Data -->
    @if($model->kkpr_koordinat && $model->kkpr_koordinat->count() > 0)
    <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6">
        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
            <i class="fas fa-map mr-2 text-[#185B3C]"></i>
            Data Koordinat
        </h3>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Longitude</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Latitude</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($model->kkpr_koordinat as $koordinat)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $koordinat->longi }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $koordinat->lati }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>

<script>
function printData() {
    window.print();
}

function shareData() {
    if (navigator.share) {
        navigator.share({
            title: 'Detail KKPR Non Usaha',
            text: 'Lihat detail permohonan KKPR Non Usaha',
            url: window.location.href
        });
    } else {
        // Fallback untuk browser yang tidak mendukung Web Share API
        navigator.clipboard.writeText(window.location.href).then(() => {
            alert('Link berhasil disalin ke clipboard');
        });
    }
}
</script>
@endsection
