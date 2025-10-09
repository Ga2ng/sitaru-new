@extends('layouts.app')

@section('title', 'Permohonan UMK')
@section('subtitle', 'Kelola semua permohonan persetujuan UMK Anda')

@section('content')
<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<div class="max-w-7xl mx-auto space-y-6">
    <!-- Hero Section -->
    <div class="relative overflow-hidden bg-gradient-to-br from-[#185B3C] via-[#0F3D26] to-[#185B3C] rounded-xl p-6 text-white">
        <div class="absolute inset-0 bg-black/10"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold mb-1">Permohonan UMK</h1>
                    <p class="text-sm text-white/90 mb-4">Kelola semua permohonan persetujuan UMK Anda dengan mudah dan efisien</p>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                            <span class="text-xs">Sistem Aktif</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-clock text-xs"></i>
                            <span class="text-xs">24/7 Tersedia</span>
                        </div>
                    </div>
                </div>
                <div class="hidden lg:block">
                    <div class="w-20 h-20 bg-white/10 rounded-full flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-building text-3xl text-white/80"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -translate-y-16 translate-x-16"></div>
        <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full translate-y-12 -translate-x-12"></div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="group relative overflow-hidden bg-white/80 backdrop-blur-sm rounded-xl p-4 shadow-lg border border-white/20 hover:shadow-xl transition-all duration-300">
            <div class="absolute inset-0 bg-gradient-to-br from-[#185B3C]/5 to-transparent"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-[#185B3C] to-[#0F3D26] rounded-lg flex items-center justify-center shadow-md">
                        <i class="fas fa-file-alt text-white text-sm"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-2xl font-bold text-[#185B3C]">{{ $permohonan->count() }}</p>
                        <p class="text-xs text-gray-500">Total</p>
                    </div>
                </div>
                <h3 class="text-sm font-semibold text-gray-900 mb-1">Total Permohonan</h3>
                <div class="flex items-center text-xs text-green-600">
                    <i class="fas fa-check mr-1"></i>
                    <span>Semua permohonan Anda</span>
                </div>
            </div>
        </div>
        
        <div class="group relative overflow-hidden bg-white/80 backdrop-blur-sm rounded-xl p-4 shadow-lg border border-white/20 hover:shadow-xl transition-all duration-300">
            <div class="absolute inset-0 bg-gradient-to-br from-green-500/5 to-transparent"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-lg flex items-center justify-center shadow-md">
                        <i class="fas fa-check-circle text-white text-sm"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-2xl font-bold text-green-600">{{ $permohonan->where('proses', 10)->count() }}</p>
                        <p class="text-xs text-gray-500">Selesai</p>
                    </div>
                </div>
                <h3 class="text-sm font-semibold text-gray-900 mb-1">Permohonan Selesai</h3>
                <div class="flex items-center text-xs text-green-600">
                    <i class="fas fa-certificate mr-1"></i>
                    <span>Dokumen terbit</span>
                </div>
            </div>
        </div>
        
        <div class="group relative overflow-hidden bg-white/80 backdrop-blur-sm rounded-xl p-4 shadow-lg border border-white/20 hover:shadow-xl transition-all duration-300">
            <div class="absolute inset-0 bg-gradient-to-br from-orange-500/5 to-transparent"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg flex items-center justify-center shadow-md">
                        <i class="fas fa-clock text-white text-sm"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-2xl font-bold text-orange-600">{{ $permohonan->where('proses', '!=', 10)->count() }}</p>
                        <p class="text-xs text-gray-500">Proses</p>
                    </div>
                </div>
                <h3 class="text-sm font-semibold text-gray-900 mb-1">Sedang Diproses</h3>
                <div class="flex items-center text-xs text-orange-600">
                    <i class="fas fa-hourglass-half mr-1"></i>
                    <span>Dalam review</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex flex-wrap gap-4">
        <a href="{{ route('member.kkpr.create') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-[#185B3C] to-[#0F3D26] text-white rounded-lg hover:shadow-lg transition-all">
            <i class="fas fa-plus mr-2"></i>
            Buat Permohonan Baru
        </a>
        <a href="{{ route('member.kkpr.cetak.daftar') }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
            <i class="fas fa-file-pdf mr-2"></i>
            Cetak Daftar PDF
        </a>
    </div>

    <!-- Data Table -->
    <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg border border-white/20 overflow-hidden">
        <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-gradient-to-br from-[#185B3C] to-[#0F3D26] rounded-lg flex items-center justify-center">
                        <i class="fas fa-list text-white text-sm"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Daftar Permohonan</h3>
                        <p class="text-sm text-gray-600">Total {{ $permohonan->count() }} permohonan</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50/80 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Fungsi Kegiatan</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Alamat</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($permohonan as $index => $kkpr)
                    <tr class="group hover:bg-gradient-to-r hover:from-[#185B3C]/5 hover:to-transparent transition-all duration-300">
                        <td class="px-6 py-4">
                            <span class="text-sm font-semibold text-gray-900">{{ $index + 1 }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm font-medium text-gray-900">{{ $kkpr->created_at->format('d M Y') }}</p>
                            <p class="text-xs text-gray-500">{{ $kkpr->created_at->format('H:i') }} WIB</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm font-semibold text-gray-900">{{ is_array($kkpr->fungsi) ? implode(', ', $kkpr->fungsi) : ($kkpr->fungsi ?? '-') }}</p>
                            <p class="text-xs text-gray-500">{{ $kkpr->jenis_kegiatan ?? '-' }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-gray-900">{{ Str::limit(is_array($kkpr->alamat_kegiatan) ? implode(', ', $kkpr->alamat_kegiatan) : ($kkpr->alamat_kegiatan ?? $kkpr->alamat_tanah ?? '-'), 40) }}</p>
                            <p class="text-xs text-gray-500">{{ $kkpr->luas_dimohon ? number_format((float)$kkpr->luas_dimohon) . ' m²' : '-' }}</p>
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $statusMap = [
                                    1 => ['text' => 'Pengajuan', 'color' => 'bg-blue-100 text-blue-800', 'icon' => 'fa-paper-plane'],
                                    2 => ['text' => 'Upload Dokumen', 'color' => 'bg-yellow-100 text-yellow-800', 'icon' => 'fa-upload'],
                                    3 => ['text' => 'Verifikasi', 'color' => 'bg-purple-100 text-purple-800', 'icon' => 'fa-check-circle'],
                                    4 => ['text' => 'Upload Bayar', 'color' => 'bg-orange-100 text-orange-800', 'icon' => 'fa-credit-card'],
                                    5 => ['text' => 'Verifikasi Bayar', 'color' => 'bg-indigo-100 text-indigo-800', 'icon' => 'fa-receipt'],
                                    6 => ['text' => 'Survey', 'color' => 'bg-pink-100 text-pink-800', 'icon' => 'fa-search'],
                                    7 => ['text' => 'Validasi', 'color' => 'bg-teal-100 text-teal-800', 'icon' => 'fa-check'],
                                    8 => ['text' => 'Analisa', 'color' => 'bg-cyan-100 text-cyan-800', 'icon' => 'fa-chart-line'],
                                    9 => ['text' => 'Persetujuan', 'color' => 'bg-emerald-100 text-emerald-800', 'icon' => 'fa-file-check'],
                                    10 => ['text' => 'Selesai', 'color' => 'bg-green-100 text-green-800', 'icon' => 'fa-certificate'],
                                ];
                                $status = $statusMap[$kkpr->proses] ?? $statusMap[1];
                            @endphp
                            
                            @if($kkpr->revisi == 1)
                                <span class="inline-flex items-center px-3 py-1.5 text-xs font-bold rounded-lg bg-red-100 text-red-800 border-2 border-red-300 shadow-sm">
                                    <i class="fas fa-exclamation-triangle mr-1.5 text-xs"></i>
                                    Revisi
                                </span>
                            @else
                                <button onclick="openRiwayat({{ $kkpr->id }})" class="inline-flex items-center px-3 py-1.5 text-xs font-bold rounded-lg {{ $status['color'] }} border-2 border-current/30 hover:shadow-md hover:scale-105 transition-all">
                                    <i class="fas {{ $status['icon'] }} mr-1.5 text-xs"></i>
                                    {{ $status['text'] }}
                                </button>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center space-x-1">
                                <button id="btn-aksi-{{ $kkpr->id }}" onclick="toggleDropdown({{ $kkpr->id }})" class="inline-flex items-center space-x-1.5 px-3 py-1.5 text-xs font-medium text-gray-700 bg-white hover:bg-[#185B3C]/10 hover:text-[#185B3C] border border-gray-300 rounded-lg transition-all duration-200 hover:scale-105" title="Aksi">
                                    <i class="fas fa-cog"></i>
                                    <span>Aksi</span>
                                    <i class="fas fa-chevron-down text-xs"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-file-alt text-gray-400 text-2xl"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum Ada Permohonan</h3>
                            <p class="text-gray-600 mb-6">Anda belum memiliki permohonan UMK. Mulai buat permohonan pertama Anda.</p>
                            <a href="{{ route('member.kkpr.create') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-[#185B3C] to-[#0F3D26] text-white rounded-lg hover:shadow-lg transition-all">
                                <i class="fas fa-plus mr-2"></i>
                                Buat Permohonan Pertama
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Table Footer -->
        <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-gray-100 border-t border-gray-200">
            <div class="flex items-center justify-between">
                <p class="text-sm text-gray-600">Menampilkan <span class="font-semibold text-[#185B3C]">{{ $permohonan->count() }}</span> permohonan</p>
            </div>
        </div>
    </div>
</div>

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animation
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

        // Close modal when clicking outside
        const modal = document.getElementById('modal-riwayat');
        if (modal) {
            modal.addEventListener('click', function(e) {
                if (e.target === this) {
                    closeRiwayatModal();
                }
            });
        }
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            if (!event.target.closest('[onclick^="toggleDropdown"]') && !event.target.closest('#dropdown-menu-modal')) {
                closeDropdownModal();
            }
        });
    });

    // Dropdown Toggle
    function toggleDropdown(id) {
        const button = event.currentTarget;
        const chevron = button.querySelector('.fa-chevron-down');
        const modal = document.getElementById('dropdown-menu-modal');
        const content = document.getElementById('dropdown-menu-content');
        const allChevrons = document.querySelectorAll('[onclick^="toggleDropdown"] .fa-chevron-down');
        
        if (!modal.classList.contains('hidden') && modal.dataset.currentId == id) {
            modal.classList.add('hidden');
            chevron.style.transform = 'rotate(0deg)';
            delete modal.dataset.currentId;
            return;
        }
        
        allChevrons.forEach(c => {
            c.style.transform = 'rotate(0deg)';
            c.style.transition = 'transform 0.2s';
        });
        
        const rect = button.getBoundingClientRect();
        modal.style.top = (rect.bottom + window.scrollY + 8) + 'px';
        modal.style.left = (rect.right + window.scrollX - 192) + 'px';
        
        content.innerHTML = `
            <div class="py-1">
                <a href="/member/kkpr/${id}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-[#185B3C]/10 hover:text-[#185B3C] transition-colors">
                    <i class="fas fa-eye w-4 mr-3"></i>
                    Lihat Detail
                </a>
                <a href="/member/kkpr/${id}/edit" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors">
                    <i class="fas fa-edit w-4 mr-3"></i>
                    Edit
                </a>
                <a href="/member/kkpr/cetak/${id}" target="_blank" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600 transition-colors">
                    <i class="fas fa-file-pdf w-4 mr-3"></i>
                    Cetak PDF
                </a>
                <button onclick="deleteKkpr(${id}); closeDropdownModal();" class="w-full flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 transition-colors text-left">
                    <i class="fas fa-trash w-4 mr-3"></i>
                    Hapus
                </button>
            </div>
        `;
        
        modal.classList.remove('hidden');
        modal.dataset.currentId = id;
        chevron.style.transform = 'rotate(180deg)';
        chevron.style.transition = 'transform 0.2s';
    }

    function closeDropdownModal() {
        const modal = document.getElementById('dropdown-menu-modal');
        const allChevrons = document.querySelectorAll('[onclick^="toggleDropdown"] .fa-chevron-down');
        modal.classList.add('hidden');
        delete modal.dataset.currentId;
        allChevrons.forEach(c => c.style.transform = 'rotate(0deg)');
    }

    // Open Riwayat Modal
    function openRiwayat(id) {
        const modal = document.getElementById('modal-riwayat');
        const contentDiv = document.getElementById('riwayat-content');
        const subtitleDiv = document.getElementById('modal-subtitle');
        
        contentDiv.innerHTML = '<div class="text-center py-8"><i class="fas fa-spinner fa-spin text-4xl text-[#185B3C]"></i><p class="mt-4 text-gray-600">Memuat riwayat...</p></div>';
        subtitleDiv.textContent = 'UMK #' + id;
        
        modal.style.display = 'block';
        modal.classList.remove('fade');
        
        let backdrop = document.querySelector('.modal-backdrop');
        if (!backdrop) {
            backdrop = document.createElement('div');
            backdrop.className = 'modal-backdrop';
            backdrop.style.cssText = 'position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 1040;';
            backdrop.onclick = closeRiwayatModal;
            document.body.appendChild(backdrop);
        }
        
        fetch(`/member/kkpr/riwayat-data/${id}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    renderRiwayat(data);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                contentDiv.innerHTML = '<div class="text-center py-8 text-red-600"><i class="fas fa-exclamation-circle text-4xl"></i><p class="mt-4">Gagal memuat riwayat</p></div>';
            });
    }

    function renderRiwayat(data) {
        const contentDiv = document.getElementById('riwayat-content');
        const riwayat = data.riwayat;
        const model = data.model;
        
        const badgeConfig = {
            1: { icon: 'fa-address-card', color: '#db3102', label: 'Pengajuan' },
            2: { icon: 'fa-upload', color: '#dbac02', label: 'Upload Dokumen' },
            3: { icon: 'fa-check-circle', color: '#9edb02', label: 'Validasi' },
            4: { icon: 'fa-upload', color: '#38db02', label: 'Upload' },
            5: { icon: 'fa-upload', color: '#02db84', label: 'Validasi' },
            6: { icon: 'fa-edit', color: '#02d7db', label: 'Survey' },
            7: { icon: 'fa-check-circle', color: '#8102db', label: 'Analisa' },
            8: { icon: 'fa-check-circle', color: '#cd02db', label: 'Persetujuan' },
            9: { icon: 'fa-check-circle', color: '#db02db', label: 'TTE' },
            10: { icon: 'fa-handshake', color: '#db0293', label: 'Selesai' },
            11: { icon: 'fa-file', color: '#0252db', label: 'Dokumen' }
        };
        
        let html = '<div class="relative"><div class="absolute left-6 top-0 bottom-0 w-0.5 bg-gradient-to-b from-[#185B3C] via-gray-300 to-gray-200"></div><div class="space-y-6">';
        
        riwayat.forEach((r, index) => {
            const isRevisi = r.status_id == model.proses && model.revisi == 1;
            const badge = badgeConfig[r.status_id] || { icon: 'fa-file', color: '#6B7280', label: 'Unknown' };
            const badgeIcon = isRevisi ? 'fa-exclamation-circle' : badge.icon;
            const badgeColor = isRevisi ? '#EF4444' : badge.color;
            
            html += `
                <div class="relative flex items-start space-x-4 pl-2">
                    <div class="relative z-10 flex items-center justify-center w-12 h-12 rounded-full shadow-lg" style="background: linear-gradient(135deg, ${badgeColor}, ${badgeColor}dd);">
                        <i class="fas ${badgeIcon} text-white text-lg"></i>
                    </div>
                    <div class="flex-1 bg-white rounded-xl p-5 shadow-md hover:shadow-lg transition-all border-l-4" style="border-left-color: ${badgeColor};">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center space-x-2">
                                <h4 class="font-bold text-gray-900 text-base">${r.status}</h4>
                                ${isRevisi ? '<span class="px-2 py-1 bg-red-100 text-red-700 text-xs font-semibold rounded-full">Revisi</span>' : ''}
                            </div>
                            <span class="text-xs font-medium text-gray-500 bg-gray-100 px-3 py-1 rounded-full">
                                <i class="fas fa-calendar-alt mr-1"></i>${new Date(r.created_at).toLocaleDateString('id-ID')}
                            </span>
                        </div>
                        <p class="text-sm text-gray-700 leading-relaxed">${r.keterangan}</p>
                        ${r.revisi_detail ? `<div class="mt-3 p-3 bg-red-50 border-l-4 border-red-400 rounded-r-lg"><p class="text-xs text-red-800"><i class="fas fa-exclamation-triangle mr-2"></i><strong>Catatan Revisi:</strong> ${r.revisi_detail}</p></div>` : ''}
                    </div>
                </div>
            `;
        });
        html += '</div></div>';
        
        contentDiv.innerHTML = html;
    }

    function closeRiwayatModal() {
        const modal = document.getElementById('modal-riwayat');
        const backdrop = document.querySelector('.modal-backdrop');
        const contentDiv = document.getElementById('riwayat-content');
        const subtitleDiv = document.getElementById('modal-subtitle');
        
        modal.style.display = 'none';
        if (backdrop) backdrop.remove();
        
        contentDiv.innerHTML = '<div class="text-center py-8"><i class="fas fa-spinner fa-spin text-4xl text-[#185B3C]"></i><p class="mt-4 text-gray-600">Memuat riwayat...</p></div>';
        subtitleDiv.textContent = 'UMK';
    }

    // Delete KKPR
    function deleteKkpr(id) {
        Swal.fire({
            title: 'Hapus Permohonan?',
            text: "Data akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/member/kkpr/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Data berhasil dihapus',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => location.reload());
                    } else {
                        Swal.fire('Error!', data.message || 'Gagal menghapus data', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire('Error!', 'Terjadi kesalahan', 'error');
                });
            }
        });
    }
</script>

<!-- Dropdown Menu Modal -->
<div id="dropdown-menu-modal" class="hidden fixed" style="z-index: 9999;">
    <div class="bg-white rounded-lg shadow-2xl border border-gray-200 w-48" id="dropdown-menu-content">
    </div>
</div>

<!-- Modal Riwayat -->
<div class="modal fade" id="modal-riwayat" tabindex="-1" role="dialog" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 1050; overflow: auto;">
    <div class="modal-dialog modal-lg" role="document" style="position: relative; max-width: 800px; margin: 1.75rem auto;">
        <div class="modal-content border-0 shadow-2xl rounded-xl">
            <div class="bg-gradient-to-r from-[#185B3C] to-[#0F3D26] text-white rounded-t-xl px-6 py-4 relative">
                <div class="flex items-center space-x-3 pr-12">
                    <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-history"></i>
                    </div>
                    <div>
                        <h5 class="text-lg font-bold">Riwayat Proses</h5>
                        <p class="text-sm text-white/80" id="modal-subtitle">UMK</p>
                    </div>
                </div>
                <button type="button" class="absolute top-4 right-4 w-8 h-8 flex items-center justify-center text-white/80 hover:text-white hover:bg-white/10 rounded-lg transition-all" onclick="closeRiwayatModal()">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>
            
            <div class="p-6 bg-gray-50" style="max-height: 70vh; overflow-y: auto;" id="riwayat-content">
                <div class="text-center py-8">
                    <i class="fas fa-spinner fa-spin text-4xl text-[#185B3C]"></i>
                    <p class="mt-4 text-gray-600">Memuat riwayat...</p>
                </div>
            </div>
            
            <div class="bg-gray-50 rounded-b-xl p-4">
                <button type="button" class="w-full px-4 py-3 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors font-semibold" onclick="closeRiwayatModal()">
                    <i class="fas fa-times mr-2"></i>
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

