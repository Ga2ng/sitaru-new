@php
    $statusMap = [
        1 => ['text' => 'Pengajuan', 'color' => 'bg-blue-100 text-blue-800 border-blue-300'],
        2 => ['text' => 'Upload Dokumen', 'color' => 'bg-yellow-100 text-yellow-800 border-yellow-300'],
        3 => ['text' => 'Verifikasi Dokumen', 'color' => 'bg-purple-100 text-purple-800 border-purple-300'],
        4 => ['text' => 'Upload Bukti Bayar', 'color' => 'bg-orange-100 text-orange-800 border-orange-300'],
        5 => ['text' => 'Verifikasi Pembayaran', 'color' => 'bg-indigo-100 text-indigo-800 border-indigo-300'],
        6 => ['text' => 'Survey', 'color' => 'bg-pink-100 text-pink-800 border-pink-300'],
        7 => ['text' => 'Verifikasi Dokumen', 'color' => 'bg-purple-100 text-purple-800 border-purple-300'],
        8 => ['text' => 'Analisa', 'color' => 'bg-cyan-100 text-cyan-800 border-cyan-300'],
        9 => ['text' => 'Persetujuan Dokumen', 'color' => 'bg-teal-100 text-teal-800 border-teal-300'],
        10 => ['text' => 'Dokumen Terbit', 'color' => 'bg-green-100 text-green-800 border-green-300'],
    ];
    
    $currentStatus = $model->proses ?? 1;
    $isRevisi = $model->revisi == 1;
    $statusInfo = $statusMap[$currentStatus] ?? $statusMap[1];
@endphp

<div class="flex items-center space-x-2">
    @if($isRevisi)
        <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800 border border-red-300">
            <i class="fas fa-exclamation-triangle mr-1 text-xs"></i>
            Revisi
        </span>
    @else
        <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full {{ $statusInfo['color'] }}">
            @if($currentStatus == 1)
                <i class="fas fa-paper-plane mr-1 text-xs"></i>
            @elseif($currentStatus == 2)
                <i class="fas fa-upload mr-1 text-xs"></i>
            @elseif($currentStatus == 3 || $currentStatus == 7)
                <i class="fas fa-check-circle mr-1 text-xs"></i>
            @elseif($currentStatus == 4)
                <i class="fas fa-credit-card mr-1 text-xs"></i>
            @elseif($currentStatus == 5)
                <i class="fas fa-receipt mr-1 text-xs"></i>
            @elseif($currentStatus == 6)
                <i class="fas fa-search mr-1 text-xs"></i>
            @elseif($currentStatus == 8)
                <i class="fas fa-chart-line mr-1 text-xs"></i>
            @elseif($currentStatus == 9)
                <i class="fas fa-file-check mr-1 text-xs"></i>
            @elseif($currentStatus == 10)
                <i class="fas fa-certificate mr-1 text-xs"></i>
            @else
                <i class="fas fa-clock mr-1 text-xs"></i>
            @endif
            {{ $statusInfo['text'] }}
        </span>
    @endif
    
    @if($currentStatus >= 2)
        <button onclick="showProgress({{ $model->id }})" 
                class="p-1 text-gray-400 hover:text-[#185B3C] hover:bg-[#185B3C]/10 rounded transition-all duration-200" 
                title="Lihat Progress">
            <i class="fas fa-history text-xs"></i>
        </button>
    @endif
</div>

<script>
function showProgress(id) {
    // This would typically open a modal or redirect to a progress page
    // For now, we'll just show an alert
    alert('Fitur progress akan segera tersedia');
}
</script>
