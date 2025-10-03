@php
    $statusConfig = [
        1 => ['label' => 'Pengajuan', 'class' => 'bg-blue-100 text-blue-800', 'icon' => 'fas fa-paper-plane'],
        2 => ['label' => 'Upload Dokumen', 'class' => 'bg-yellow-100 text-yellow-800', 'icon' => 'fas fa-upload'],
        3 => ['label' => 'Verifikasi Dokumen', 'class' => 'bg-purple-100 text-purple-800', 'icon' => 'fas fa-check-circle'],
        4 => ['label' => 'Upload Bukti Bayar', 'class' => 'bg-orange-100 text-orange-800', 'icon' => 'fas fa-credit-card'],
        5 => ['label' => 'Survey', 'class' => 'bg-indigo-100 text-indigo-800', 'icon' => 'fas fa-map-marked-alt'],
        6 => ['label' => 'Analisa', 'class' => 'bg-pink-100 text-pink-800', 'icon' => 'fas fa-search'],
        7 => ['label' => 'Persetujuan Dokumen', 'class' => 'bg-cyan-100 text-cyan-800', 'icon' => 'fas fa-file-signature'],
        8 => ['label' => 'Dokumen Terbit', 'class' => 'bg-green-100 text-green-800', 'icon' => 'fas fa-check-double'],
        9 => ['label' => 'Selesai', 'class' => 'bg-emerald-100 text-emerald-800', 'icon' => 'fas fa-flag-checkered'],
        10 => ['label' => 'Selesai', 'class' => 'bg-emerald-100 text-emerald-800', 'icon' => 'fas fa-flag-checkered'],
    ];
    
    $currentStatus = $statusConfig[$model->proses] ?? $statusConfig[1];
    $isRevisi = $model->revisi == 1;
@endphp

<div class="flex flex-col space-y-1">
    <div class="flex items-center space-x-2">
        <div class="flex items-center space-x-1">
            <i class="{{ $currentStatus['icon'] }} text-xs"></i>
            <span class="text-xs font-medium {{ $currentStatus['class'] }} px-2 py-1 rounded-full">
                {{ $currentStatus['label'] }}
            </span>
        </div>
        @if($isRevisi)
            <span class="text-xs font-medium bg-red-100 text-red-800 px-2 py-1 rounded-full">
                <i class="fas fa-exclamation-triangle mr-1"></i>
                Revisi
            </span>
        @endif
    </div>
    
    @if($isRevisi)
        <p class="text-xs text-red-600">
            <i class="fas fa-info-circle mr-1"></i>
            Perlu perbaikan dokumen
        </p>
    @else
        <p class="text-xs text-gray-500">
            <i class="fas fa-clock mr-1"></i>
            {{ $model->proses == 10 ? 'Proses selesai' : 'Sedang diproses' }}
        </p>
    @endif
</div>
