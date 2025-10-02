@extends('layouts.app')

@section('title', 'Detail Permohonan UMK')
@section('subtitle', 'Detail Permohonan Persetujuan UMK')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">
    <!-- Hero Section -->
    <div class="relative overflow-hidden bg-gradient-to-br from-[#185B3C] via-[#0F3D26] to-[#185B3C] rounded-xl p-6 text-white">
        <div class="absolute inset-0 bg-black/10"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold mb-1">Detail Permohonan UMK</h1>
                    <p class="text-sm text-white/90 mb-4">Informasi lengkap permohonan persetujuan UMK</p>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                            <span class="text-xs">Status: {{ $model->proses == 1 ? 'Pengajuan' : 'Diproses' }}</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-calendar text-xs"></i>
                            <span class="text-xs">{{ $model->created_at->format('d M Y') }}</span>
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
    </div>

    <!-- Status Card -->
    <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg border border-white/20 p-6">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 bg-gradient-to-br from-[#185B3C] to-[#0F3D26] rounded-lg flex items-center justify-center">
                    <i class="fas fa-info-circle text-white text-lg"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Status Permohonan</h3>
                    <p class="text-sm text-gray-600">Informasi status terkini</p>
                </div>
            </div>
            <div class="text-right">
                @if($model->revisi == 1)
                    <span class="inline-flex px-4 py-2 text-sm font-semibold rounded-full bg-red-100 text-red-800 border border-red-300">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        Perlu Revisi
                    </span>
                @else
                    <span class="inline-flex px-4 py-2 text-sm font-semibold rounded-full bg-blue-100 text-blue-800 border border-blue-300">
                        <i class="fas fa-clock mr-2"></i>
                        Sedang Diproses
                    </span>
                @endif
            </div>
        </div>
    </div>

    <!-- Detail Information -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Data Pemohon -->
        <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg border border-white/20 p-6">
            <div class="flex items-center space-x-3 mb-6">
                <div class="w-1 h-8 bg-gradient-to-b from-[#185B3C] to-[#DAAF49] rounded-full"></div>
                <h4 class="text-lg font-semibold text-gray-900">Data Pemohon</h4>
            </div>
            
            <div class="space-y-4">
                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-sm font-medium text-gray-600">Nama Lengkap</span>
                    <span class="text-sm text-gray-900">{{ $model->user->name }}</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-sm font-medium text-gray-600">Email</span>
                    <span class="text-sm text-gray-900">{{ $model->user->email }}</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-sm font-medium text-gray-600">No. HP</span>
                    <span class="text-sm text-gray-900">{{ $model->user->phone ?? '-' }}</span>
                </div>
                <div class="flex justify-between items-center py-2">
                    <span class="text-sm font-medium text-gray-600">Alamat</span>
                    <span class="text-sm text-gray-900">{{ $model->user->address ?? '-' }}</span>
                </div>
            </div>
        </div>

        <!-- Data Tanah -->
        <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg border border-white/20 p-6">
            <div class="flex items-center space-x-3 mb-6">
                <div class="w-1 h-8 bg-gradient-to-b from-[#185B3C] to-[#DAAF49] rounded-full"></div>
                <h4 class="text-lg font-semibold text-gray-900">Data Tanah</h4>
            </div>
            
            <div class="space-y-4">
                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-sm font-medium text-gray-600">Alamat Tanah</span>
                    <span class="text-sm text-gray-900">{{ $model->alamat_tanah ?? '-' }}</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-sm font-medium text-gray-600">Luas Tanah</span>
                    <span class="text-sm text-gray-900">{{ $model->luas ? number_format($model->luas) . ' m²' : '-' }}</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-sm font-medium text-gray-600">RT/RW</span>
                    <span class="text-sm text-gray-900">{{ $model->rt ? $model->rt . '/' . $model->rw : '-' }}</span>
                </div>
                <div class="flex justify-between items-center py-2">
                    <span class="text-sm font-medium text-gray-600">Koordinat</span>
                    <span class="text-sm text-gray-900">
                        @if($model->longitude && $model->lattitude)
                            {{ $model->longitude }}, {{ $model->lattitude }}
                        @else
                            -
                        @endif
                    </span>
                </div>
            </div>
        </div>

        <!-- Data Kegiatan -->
        <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg border border-white/20 p-6">
            <div class="flex items-center space-x-3 mb-6">
                <div class="w-1 h-8 bg-gradient-to-b from-[#185B3C] to-[#DAAF49] rounded-full"></div>
                <h4 class="text-lg font-semibold text-gray-900">Data Kegiatan</h4>
            </div>
            
            <div class="space-y-4">
                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-sm font-medium text-gray-600">Jenis Kegiatan</span>
                    <span class="text-sm text-gray-900">{{ $model->jenis_kegiatan ?? '-' }}</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-sm font-medium text-gray-600">Fungsi Bangunan</span>
                    <span class="text-sm text-gray-900">{{ $model->fungsi ?? '-' }}</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-sm font-medium text-gray-600">Alamat Kegiatan</span>
                    <span class="text-sm text-gray-900">{{ $model->alamat_kegiatan ?? '-' }}</span>
                </div>
                <div class="flex justify-between items-center py-2">
                    <span class="text-sm font-medium text-gray-600">Luas Dimohon</span>
                    <span class="text-sm text-gray-900">{{ $model->luas_dimohon ? number_format($model->luas_dimohon) . ' m²' : '-' }}</span>
                </div>
            </div>
        </div>

        <!-- Data Sertifikat -->
        <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg border border-white/20 p-6">
            <div class="flex items-center space-x-3 mb-6">
                <div class="w-1 h-8 bg-gradient-to-b from-[#185B3C] to-[#DAAF49] rounded-full"></div>
                <h4 class="text-lg font-semibold text-gray-900">Data Sertifikat</h4>
            </div>
            
            <div class="space-y-4">
                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-sm font-medium text-gray-600">Jenis Sertifikat</span>
                    <span class="text-sm text-gray-900">{{ $model->jns_sertifikat ?? '-' }}</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-sm font-medium text-gray-600">No. Sertifikat</span>
                    <span class="text-sm text-gray-900">{{ $model->no_sertifikat ?? '-' }}</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-sm font-medium text-gray-600">Atas Nama</span>
                    <span class="text-sm text-gray-900">{{ $model->an_sertifikat ?? '-' }}</span>
                </div>
                <div class="flex justify-between items-center py-2">
                    <span class="text-sm font-medium text-gray-600">Tahun Sertifikat</span>
                    <span class="text-sm text-gray-900">{{ $model->thn_sertifikat ?? '-' }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg border border-white/20 p-6">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <a href="{{ route('member.kkpr.index') }}" class="flex items-center px-4 py-2 text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali
                </a>
                <a href="{{ route('member.kkpr.edit', $model->id) }}" class="flex items-center px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors">
                    <i class="fas fa-edit mr-2"></i>
                    Edit
                </a>
            </div>
            <div class="flex items-center space-x-4">
                <a href="{{ route('member.kkpr.cetak.detail', $model->id) }}" target="_blank" class="flex items-center px-4 py-2 text-white bg-green-600 rounded-lg hover:bg-green-700 transition-colors">
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
    </div>
</div>

<script>
function printData() {
    window.print();
}

function shareData() {
    if (navigator.share) {
        navigator.share({
            title: 'Detail Permohonan UMK',
            text: 'Lihat detail permohonan UMK saya',
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
