@extends('layouts.app')

@section('title', 'Permohonan KKPR Terbit Otomatis')
@section('subtitle', 'Kelola semua permohonan persetujuan KKPR Terbit Otomatis Anda')

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
                    <h1 class="text-2xl font-bold mb-1">Permohonan KKPR Terbit Otomatis</h1>
                    <p class="text-sm text-white/90 mb-4">Kelola semua permohonan persetujuan KKPR Terbit Otomatis Anda dengan mudah dan efisien</p>
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
        {{-- <a href="{{ route('member.kkpr.cetak.daftar') }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
            <i class="fas fa-file-pdf mr-2"></i>
            Cetak Daftar PDF
        </a> --}}
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
                            
                            @if($kkpr->deleted == 1)
                                <button onclick="openRiwayat({{ $kkpr->id }})" class="inline-flex items-center px-3 py-1.5 text-xs font-bold rounded-lg bg-orange-100 text-orange-800 border-2 border-orange-300 shadow-sm hover:bg-orange-200 hover:shadow-md hover:scale-105 transition-all cursor-pointer" title="Request Pencabutan">
                                    <i class="fas fa-times-circle mr-1.5 text-xs"></i>
                                    Pencabutan
                                </button>
                            @elseif($kkpr->deleted == 2)
                                <button onclick="openRiwayat({{ $kkpr->id }})" class="inline-flex items-center px-3 py-1.5 text-xs font-bold rounded-lg bg-gray-100 text-gray-800 border-2 border-gray-300 shadow-sm hover:bg-gray-200 hover:shadow-md hover:scale-105 transition-all cursor-pointer" title="Pencabutan Dikonfirmasi">
                                    <i class="fas fa-ban mr-1.5 text-xs"></i>
                                    Dicabut
                                </button>
                            @elseif($kkpr->revisi == 1)
                                <button onclick="openRiwayat({{ $kkpr->id }})" class="inline-flex items-center px-3 py-1.5 text-xs font-bold rounded-lg bg-red-100 text-red-800 border-2 border-red-300 shadow-sm hover:bg-red-200 hover:shadow-md hover:scale-105 transition-all cursor-pointer" title="Lihat Riwayat Proses">
                                    <i class="fas fa-exclamation-triangle mr-1.5 text-xs"></i>
                                    Revisi
                                </button>
                            @else
                                <button onclick="openRiwayat({{ $kkpr->id }})" class="inline-flex items-center px-3 py-1.5 text-xs font-bold rounded-lg {{ $status['color'] }} border-2 border-current/30 hover:shadow-md hover:scale-105 transition-all">
                                    <i class="fas {{ $status['icon'] }} mr-1.5 text-xs"></i>
                                    {{ $status['text'] }}
                                </button>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center space-x-1">
                                <button id="btn-aksi-{{ $kkpr->id }}" onclick="toggleDropdown({{ $kkpr->id }}, {{ $kkpr->proses }}, {{ $kkpr->revisi }}, {{ auth()->user()->can('Upload Draft') ? 'true' : 'false' }}, {{ $kkpr->deleted ?? 0 }})" class="inline-flex items-center space-x-1.5 px-3 py-1.5 text-xs font-medium text-gray-700 bg-white hover:bg-[#185B3C]/10 hover:text-[#185B3C] border border-gray-300 rounded-lg transition-all duration-200 hover:scale-105" title="Aksi">
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
                            <p class="text-gray-600 mb-6">Anda belum memiliki Permohonan KKPR Terbit Otomatis. Mulai buat permohonan pertama Anda.</p>
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
    function toggleDropdown(id, status, revisi, canUploadDraft, deleted) {
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
        
        // Set content first to calculate height
        let menuItems = `
            <div class="py-1">
                <a href="/member/kkpr/${id}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-[#185B3C]/10 hover:text-[#185B3C] transition-colors">
                    <i class="fas fa-eye w-4 mr-3"></i>
                    Lihat Detail
                </a>`;
        
        // Check if deleted status (pencabutan)
        const isDeleted = parseInt(deleted) > 0;
        const isRequestPencabutan = parseInt(deleted) == 1;
        
        // Jika Request Pencabutan (deleted = 1)
        if (isRequestPencabutan) {
            menuItems += `
                <div class="px-4 py-2 bg-orange-50 border-l-4 border-orange-300">
                    <p class="text-xs text-orange-700 font-semibold">Request Pencabutan</p>
                    <p class="text-xs text-orange-600 mt-1">Menunggu konfirmasi admin</p>
                </div>`;
        }
        // Jika sudah dicabut (deleted = 2)
        else if (parseInt(deleted) == 2) {
            menuItems += `
                <div class="px-4 py-3 bg-gray-100 border border-gray-300 rounded-lg">
                    <p class="text-xs font-semibold text-gray-700">
                        <i class="fas fa-ban mr-1"></i> PERMOHONAN DICABUT
                    </p>
                    <p class="text-xs text-gray-600 mt-1">Tidak dapat diproses lebih lanjut</p>
                </div>`;
        }
        // Jika status sudah selesai (10), hanya tampilkan menu view-only
        else if (parseInt(status) == 10) {
            menuItems += `
                <a href="/member/kkpr/${id}/view-draft" target="_blank" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-600 transition-colors">
                    <i class="fas fa-file-contract w-4 mr-3"></i>
                    Lihat Draft
                </a>
                <a href="/member/kkpr/${id}/peta" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600 transition-colors">
                    <i class="fas fa-map w-4 mr-3"></i>
                    Lihat Peta
                </a>
                <a href="/member/kkpr/${id}/cetak-berkas" target="_blank" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors">
                    <i class="fas fa-file-pdf w-4 mr-3"></i>
                    Cetak Berkas
                </a>`;
        } else {
            // Menu normal untuk status belum selesai
            
            // Edit - hanya muncul jika status = 1 (Pengajuan) atau revisi = 1
            if (parseInt(status) == 1 || parseInt(revisi) == 1) {
                menuItems += `
                    <a href="/member/kkpr/${id}/edit" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors">
                        <i class="fas fa-edit w-4 mr-3"></i>
                        Edit
                    </a>`;
            }
            
            // Cetak Berkas - hanya setelah analisa (proses >= 7)
            if (parseInt(status) >= 7) {
                menuItems += `
                    <a href="/member/kkpr/${id}/cetak-berkas" target="_blank" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors">
                        <i class="fas fa-file-pdf w-4 mr-3"></i>
                        Cetak Berkas
                    </a>`;
            }
            
            // Lihat Peta - selalu tersedia
            menuItems += `
                <a href="/member/kkpr/${id}/peta" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600 transition-colors">
                    <i class="fas fa-map w-4 mr-3"></i>
                    Lihat Peta
                </a>`;
            
            // Cetak PDF - menu tambahan
            // menuItems += `
            //     <a href="/member/kkpr/cetak/${id}" target="_blank" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-600 transition-colors">
            //         <i class="fas fa-file-pdf w-4 mr-3"></i>
            //         Cetak PDF
            //     </a>`;
            
            // Upload Draft - hanya dengan permission Upload Draft dan sudah persetujuan dokumen (status >= 9)
            if (canUploadDraft === 'true' && parseInt(status) >= 9 && parseInt(status) < 10) {
                menuItems += `
                    <button onclick="openUploadDraftModal(${id}); closeDropdownModal();" class="w-full flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 transition-colors text-left">
                        <i class="fas fa-file-upload w-4 mr-3"></i>
                        Upload Draft
                    </button>`;
            }
            
            // Request Pencabutan - hanya untuk proses < 3 (sebelum diverifikasi)
            if (parseInt(status) < 3) {
                menuItems += `
                    <button onclick="openPencabutanModal(${id}); closeDropdownModal();" class="w-full flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600 transition-colors text-left">
                        <i class="fas fa-times-circle w-4 mr-3"></i>
                        Request Pencabutan
                    </button>`;
            }
        }
        
        menuItems += `
            </div>
        `;
        
        content.innerHTML = menuItems;
        
        // Show modal temporarily to get height
        modal.classList.remove('hidden');
        modal.style.visibility = 'hidden';
        
        // Get button and modal dimensions
        const rect = button.getBoundingClientRect();
        const modalHeight = content.offsetHeight;
        const modalWidth = 192; // w-48 = 12rem = 192px
        const viewportHeight = window.innerHeight;
        const viewportWidth = window.innerWidth;
        
        // Calculate space available
        const spaceBelow = viewportHeight - rect.bottom;
        const spaceAbove = rect.top;
        
        // Determine vertical position
        let top;
        if (spaceBelow >= modalHeight + 8 || spaceBelow >= spaceAbove) {
            // Show below
            top = rect.bottom + window.scrollY + 8;
        } else {
            // Show above
            top = rect.top + window.scrollY - modalHeight - 8;
        }
        
        // Determine horizontal position (align to right of button)
        let left = rect.right + window.scrollX - modalWidth;
        
        // Constrain horizontal position
        if (left < 8) {
            left = 8;
        } else if (left + modalWidth > viewportWidth - 8) {
            left = viewportWidth - modalWidth - 8;
        }
        
        // Constrain vertical position
        if (top < window.scrollY + 8) {
            top = window.scrollY + 8;
        } else if (top + modalHeight > window.scrollY + viewportHeight - 8) {
            top = window.scrollY + viewportHeight - modalHeight - 8;
        }
        
        // Set final position
        modal.style.top = top + 'px';
        modal.style.left = left + 'px';
        modal.style.visibility = 'visible';
        
        modal.dataset.currentId = id;
        chevron.style.transform = 'rotate(180deg)';
        chevron.style.transition = 'transform 0.2s';
    }

    function closeDropdownModal() {
        const modal = document.getElementById('dropdown-menu-modal');
        const allChevrons = document.querySelectorAll('[onclick^="toggleDropdown"] .fa-chevron-down');
        modal.classList.add('hidden');
        modal.style.visibility = 'visible'; // Reset visibility
        delete modal.dataset.currentId;
        allChevrons.forEach(c => c.style.transform = 'rotate(0deg)');
    }

    // Open Riwayat Modal
    function openRiwayat(id) {
        const modal = document.getElementById('modal-riwayat');
        const contentDiv = document.getElementById('riwayat-content');
        const subtitleDiv = document.getElementById('modal-subtitle');
        
        contentDiv.innerHTML = '<div class="text-center py-8"><i class="fas fa-spinner fa-spin text-4xl text-[#185B3C]"></i><p class="mt-4 text-gray-600">Memuat riwayat...</p></div>';
        subtitleDiv.textContent = 'KKPR Terbit Otomatis #' + id;
        
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
            0: { icon: 'fa-times-circle', color: '#dc2626', label: 'Ditolak' },
            'pencabutan-request': { icon: 'fa-exclamation-triangle', color: '#f59e0b', label: 'Request Pencabutan' },
            'pencabutan-confirmed': { icon: 'fa-ban', color: '#6b7280', label: 'Pencabutan Dikonfirmasi' },
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
        
        // Cek apakah ada pencabutan
        const pencabutanRiwayat = riwayat.filter(r => r.status_id == 0 && (r.status.includes('Pencabutan') || r.status.includes('pencabutan')));
        const hasPencabutan = pencabutanRiwayat.length > 0;
        
        // Generate all process steps from 1 to 10
        for (let statusId = 1; statusId <= 10; statusId++) {
            // Find existing riwayat for this status_id
            const existingRiwayat = riwayat.find(r => r.status_id == statusId);
            
            if (existingRiwayat) {
                // Display existing riwayat
                const r = existingRiwayat;
                const isDitolak = r.status_id == 0;
                const isRevisi = r.status_id == model.proses && model.revisi == 1 && !isDitolak;
                const badge = badgeConfig[r.status_id] || { icon: 'fa-file', color: '#6c757d', label: 'Unknown' };
                const badgeIcon = isDitolak ? 'fa-times-circle' : (isRevisi ? 'fa-exclamation-circle' : badge.icon);
                const badgeColor = isDitolak ? '#dc2626' : (isRevisi ? '#eab308' : badge.color);
                
                const date = new Date(r.updated_at);
                const formattedDate = date.toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' });
                const formattedTime = date.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
                
                html += `
                <div class="relative pl-16 group">
                    <div class="absolute left-0 w-12 h-12 rounded-full flex items-center justify-center shadow-lg transition-transform duration-300 group-hover:scale-110 z-10" style="background-color: ${badgeColor}">
                        <i class="fa ${badgeIcon} text-white text-lg"></i>
                    </div>
                    <div class="${isDitolak ? 'bg-red-50 border-red-300 border-2' : (isRevisi ? 'bg-yellow-50 border-yellow-200' : 'bg-white border-gray-200')} rounded-xl p-4 shadow-md border transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex-1">
                                <h4 class="font-bold ${isDitolak ? 'text-red-900' : 'text-gray-900'} text-base mb-1">${r.status}</h4>
                                <div class="flex items-center space-x-3 text-xs text-gray-500">
                                    <div class="flex items-center">
                                        <i class="fa fa-calendar mr-1.5"></i>
                                        <span>${formattedDate}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fa fa-clock mr-1.5"></i>
                                        <span>${formattedTime}</span>
                                    </div>
                                </div>
                            </div>
                            ${isDitolak ? 
                                '<span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800 border-2 border-red-400"><i class="fa fa-ban mr-1"></i>Ditolak</span>' :
                                (isRevisi ? 
                                    '<span class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800 border border-yellow-300"><i class="fa fa-exclamation-circle mr-1"></i>Revisi</span>' :
                                    (r.status_id == model.proses ? 
                                        '<span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800 border border-blue-300"><i class="fa fa-spinner mr-1"></i>Aktif</span>' :
                                        '<span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800 border border-green-300"><i class="fa fa-check mr-1"></i>Selesai</span>'))
                            }
                        </div>
                        <div class="${isDitolak ? 'bg-white/70' : (isRevisi ? 'bg-white/50' : 'bg-gray-50')} rounded-lg p-3">
                            <p class="text-sm text-gray-700 leading-relaxed">${r.keterangan}</p>
                            ${isDitolak && r.revisi_detail ? 
                                `<div class="mt-3 p-3 bg-red-100 border-2 border-red-300 rounded-lg">
                                    <p class="text-xs font-semibold text-red-900 mb-1"><i class="fa fa-ban mr-1"></i>Alasan Penolakan:</p>
                                    <p class="text-sm text-red-800 font-medium">${r.revisi_detail}</p>
                                </div>` : 
                                (isRevisi && r.revisi_detail ? 
                                    `<div class="mt-3 p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                                        <p class="text-xs font-semibold text-yellow-800 mb-1"><i class="fa fa-info-circle mr-1"></i>Detail Revisi:</p>
                                        <p class="text-sm text-yellow-700">${r.revisi_detail}</p>
                                    </div>` : '')
                            }
                        </div>
                    </div>
                </div>`;
            } else {
                // Display placeholder for missing riwayat
                const badge = badgeConfig[statusId] || { icon: 'fa-file', color: '#6c757d', label: 'Unknown' };
                const isCompleted = statusId < model.proses;
                const isCurrent = statusId == model.proses;
                const isPending = statusId > model.proses;
                
                // Skip pending steps if there's pencabutan
                if (hasPencabutan && isPending) {
                    continue;
                }
                
                let statusText, statusClass, statusIcon, statusColor;
                
                if (isCompleted) {
                    statusText = 'Selesai';
                    statusClass = 'bg-green-100 text-green-800 border-green-300';
                    statusIcon = 'fa-check';
                    statusColor = '#10b981';
                } else if (isCurrent) {
                    statusText = 'Aktif';
                    statusClass = 'bg-blue-100 text-blue-800 border-blue-300';
                    statusIcon = 'fa-spinner';
                    statusColor = '#3b82f6';
                } else {
                    statusText = 'Belum Dilakukan';
                    statusClass = 'bg-gray-100 text-gray-600 border-gray-300';
                    statusIcon = 'fa-clock';
                    statusColor = '#6b7280';
                }
                
                html += `
                <div class="relative pl-16 group">
                    <div class="absolute left-0 w-12 h-12 rounded-full flex items-center justify-center shadow-lg transition-transform duration-300 group-hover:scale-110 z-10" style="background-color: ${statusColor}">
                        <i class="fa ${badge.icon} text-white text-lg"></i>
                    </div>
                    <div class="bg-white border-gray-200 rounded-xl p-4 shadow-md border transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex-1">
                                <h4 class="font-bold text-gray-900 text-base mb-1">${badge.label}</h4>
                                <div class="flex items-center space-x-3 text-xs text-gray-500">
                                    <div class="flex items-center">
                                        <i class="fa fa-info-circle mr-1.5"></i>
                                        <span>${isPending ? 'Menunggu proses sebelumnya' : 'Proses sistem'}</span>
                                    </div>
                                </div>
                            </div>
                            <span class="px-3 py-1 text-xs font-semibold rounded-full ${statusClass} border">
                                <i class="fa ${statusIcon} mr-1"></i>${statusText}
                            </span>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-3">
                            <p class="text-sm text-gray-700 leading-relaxed">
                                ${isPending ? 
                                    'Proses ini akan dilakukan setelah proses sebelumnya selesai' : 
                                    (isCompleted ? 
                                        'Proses ini telah diselesaikan oleh sistem' : 
                                        'Proses ini sedang berjalan')
                                }
                            </p>
                        </div>
                    </div>
                </div>`;
            }
        }
        
        // Tampilkan pencabutan SETELAH proses normal
        if (pencabutanRiwayat.length > 0) {
            const latestPencabutan = pencabutanRiwayat.sort((a, b) => new Date(b.updated_at) - new Date(a.updated_at))[0];
            
            const r = latestPencabutan;
            const isRequest = r.status.includes('Request');
            const badge = isRequest ? badgeConfig['pencabutan-request'] : badgeConfig['pencabutan-confirmed'];
            const bgColor = isRequest ? 'bg-orange-50 border-orange-300' : 'bg-gray-100 border-gray-300';
            const textColor = isRequest ? 'text-orange-900' : 'text-gray-900';
                
            const date = new Date(r.updated_at);
            const formattedDate = date.toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' });
            const formattedTime = date.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
            
            html += `
                <div class="relative pl-16 group">
                    <div class="absolute left-0 w-12 h-12 rounded-full flex items-center justify-center shadow-lg transition-transform duration-300 group-hover:scale-110 z-10" style="background-color: ${badge.color}">
                        <i class="fa ${badge.icon} text-white text-lg"></i>
                    </div>
                    <div class="${bgColor} border-2 rounded-xl p-4 shadow-md transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex-1">
                                <h4 class="font-bold ${textColor} text-base mb-1">${r.status}</h4>
                                <div class="flex items-center space-x-3 text-xs text-gray-600">
                                    <div class="flex items-center">
                                        <i class="fa fa-calendar mr-1.5"></i>
                                        <span>${formattedDate}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fa fa-clock mr-1.5"></i>
                                        <span>${formattedTime}</span>
                                    </div>
                                </div>
                            </div>
                            <span class="px-3 py-1 text-xs font-semibold rounded-full ${isRequest ? 'bg-orange-100 text-orange-800 border-2 border-orange-400' : 'bg-gray-100 text-gray-700 border-2 border-gray-400'}">
                                <i class="fa ${badge.icon} mr-1"></i>${badge.label}
                            </span>
                        </div>
                        <div class="bg-white/70 rounded-lg p-3">
                            <p class="text-sm text-gray-700 leading-relaxed mb-2">${r.keterangan}</p>
                            ${r.revisi_detail ? 
                                `<div class="mt-3 p-3 ${isRequest ? 'bg-orange-100 border-2 border-orange-300' : 'bg-gray-50 border-2 border-gray-200'} rounded-lg">
                                    <p class="text-xs font-semibold ${isRequest ? 'text-orange-900' : 'text-gray-800'} mb-1">
                                        <i class="fa fa-info-circle mr-1"></i>${isRequest ? 'Alasan Pencabutan:' : 'Konfirmasi:'}
                                    </p>
                                    <p class="text-sm ${isRequest ? 'text-orange-800' : 'text-gray-700'} font-medium">${r.revisi_detail}</p>
                                </div>` : ''
                            }
                        </div>
                    </div>
                </div>`;
        }
        
        // Handle rejected status (status_id = 0) if exists
        const rejectedRiwayat = riwayat.find(r => r.status_id == 0);
        if (rejectedRiwayat) {
            const r = rejectedRiwayat;
            const date = new Date(r.updated_at);
            const formattedDate = date.toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' });
            const formattedTime = date.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
            
            html += `
            <div class="relative pl-16 group">
                <div class="absolute left-0 w-12 h-12 rounded-full flex items-center justify-center shadow-lg transition-transform duration-300 group-hover:scale-110 z-10" style="background-color: #dc2626">
                    <i class="fa fa-times-circle text-white text-lg"></i>
                </div>
                <div class="bg-red-50 border-red-300 border-2 rounded-xl p-4 shadow-md transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex-1">
                            <h4 class="font-bold text-red-900 text-base mb-1">${r.status}</h4>
                            <div class="flex items-center space-x-3 text-xs text-gray-500">
                                <div class="flex items-center">
                                    <i class="fa fa-calendar mr-1.5"></i>
                                    <span>${formattedDate}</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fa fa-clock mr-1.5"></i>
                                    <span>${formattedTime}</span>
                                </div>
                            </div>
                        </div>
                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800 border-2 border-red-400">
                            <i class="fa fa-ban mr-1"></i>Ditolak
                        </span>
                    </div>
                    <div class="bg-white/70 rounded-lg p-3">
                        <p class="text-sm text-gray-700 leading-relaxed">${r.keterangan}</p>
                        ${r.revisi_detail ? 
                            `<div class="mt-3 p-3 bg-red-100 border-2 border-red-300 rounded-lg">
                                <p class="text-xs font-semibold text-red-900 mb-1"><i class="fa fa-ban mr-1"></i>Alasan Penolakan:</p>
                                <p class="text-sm text-red-800 font-medium">${r.revisi_detail}</p>
                            </div>` : ''
                        }
                    </div>
                </div>
            </div>`;
        }
        
        html += '</div></div>';
        console.log('Generated HTML length:', html.length);
        contentDiv.innerHTML = html;
        console.log('Timeline rendered successfully');
    }

    function closeRiwayatModal() {
        const modal = document.getElementById('modal-riwayat');
        const backdrop = document.querySelector('.modal-backdrop');
        const contentDiv = document.getElementById('riwayat-content');
        const subtitleDiv = document.getElementById('modal-subtitle');
        
        modal.style.display = 'none';
        if (backdrop) backdrop.remove();
        
        contentDiv.innerHTML = '<div class="text-center py-8"><i class="fas fa-spinner fa-spin text-4xl text-[#185B3C]"></i><p class="mt-4 text-gray-600">Memuat riwayat...</p></div>';
        subtitleDiv.textContent = 'KKPR Terbit Otomatis';
    }

    // Open Upload Draft Modal
    function openUploadDraftModal(id) {
        document.getElementById('upload_draft_kkpr_id').value = id;
        document.getElementById('upload-draft-modal').style.display = 'block';
        document.getElementById('upload-draft-backdrop').style.display = 'block';
        document.body.style.overflow = 'hidden';
    }

    // Close Upload Draft Modal
    function closeUploadDraftModal() {
        document.getElementById('upload-draft-modal').style.display = 'none';
        document.getElementById('upload-draft-backdrop').style.display = 'none';
        document.getElementById('upload-draft-form').reset();
        document.getElementById('file-name-display').textContent = 'Belum ada file dipilih';
        document.getElementById('file-size-display').textContent = '';
        document.getElementById('file-preview-section').style.display = 'none';
        document.body.style.overflow = 'auto';
    }

    // Open Pencabutan Modal
    function openPencabutanModal(id) {
        document.getElementById('pencabutan_kkpr_id').value = id;
        document.getElementById('pencabutan-modal').style.display = 'block';
        document.getElementById('pencabutan-backdrop').style.display = 'block';
        document.body.style.overflow = 'hidden';
    }

    // Close Pencabutan Modal
    function closePencabutanModal() {
        document.getElementById('pencabutan-modal').style.display = 'none';
        document.getElementById('pencabutan-backdrop').style.display = 'none';
        document.getElementById('pencabutan-form').reset();
        document.body.style.overflow = 'auto';
    }

    // Handle Pencabutan Form Submit
    document.addEventListener('DOMContentLoaded', function() {
        const pencabutanForm = document.getElementById('pencabutan-form');
        if (pencabutanForm) {
            pencabutanForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                const id = formData.get('kkpr_id');
                
                // Create manual loading overlay
                const loadingOverlay = document.createElement('div');
                loadingOverlay.id = 'loading-overlay';
                loadingOverlay.style.cssText = 'position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.7); z-index: 99999; display: flex; align-items: center; justify-content: center;';
                loadingOverlay.innerHTML = `
                    <div style="background: white; padding: 30px; border-radius: 10px; text-align: center;">
                        <div class="spinner-border text-primary" role="status" style="width: 50px; height: 50px;">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p style="margin-top: 20px; font-size: 16px; font-weight: 600;">Mohon Tunggu...</p>
                        <p style="color: #666;">Sedang mengirim request pencabutan</p>
                    </div>
                `;
                document.body.appendChild(loadingOverlay);
                
                // Disable submit button and change text
                const submitBtn = this.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                if (submitBtn) {
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin" style="margin-right: 0.5rem;"></i>Loading...';
                }
                
                fetch(`/member/kkpr/${id}/request-pencabutan`, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    // Re-enable submit button
                    if (submitBtn) {
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = originalText;
                    }
                    
                    if (data.success || data.message) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: data.success || data.message || 'Request pencabutan telah dikirim',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => location.reload());
                    } else {
                        Swal.fire('Error!', data.message || 'Gagal mengirim request pencabutan', 'error');
                    }
                })
                .catch(error => {
                    // Re-enable submit button on error
                    if (submitBtn) {
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = originalText;
                    }
                    console.error('Error:', error);
                    Swal.fire('Error!', 'Terjadi kesalahan', 'error');
                });
            });
        }
    });

    // Handle file selection
    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.getElementById('draft_file');
        if (fileInput) {
            fileInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    // Display file info
                    document.getElementById('file-name-display').textContent = file.name;
                    const fileSize = (file.size / 1024 / 1024).toFixed(2);
                    document.getElementById('file-size-display').textContent = `${fileSize} MB`;
                    document.getElementById('file-preview-section').classList.remove('hidden');
                    
                    // Validate file size
                    if (file.size > 10 * 1024 * 1024) {
                        Swal.fire({
                            icon: 'error',
                            title: 'File Terlalu Besar!',
                            text: 'Ukuran file maksimal 10 MB'
                        });
                        fileInput.value = '';
                        document.getElementById('file-preview-section').classList.add('hidden');
                    }
                }
            });
        }
    });
</script>

<!-- Dropdown Menu Modal -->
<div id="dropdown-menu-modal" class="hidden fixed" style="z-index: 9999;">
    <div class="bg-white rounded-lg shadow-2xl border border-gray-200 w-48 max-h-[80vh] overflow-y-auto" id="dropdown-menu-content">
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
                        <p class="text-sm text-white/80" id="modal-subtitle">KKPR Terbit Otomatis</p>
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

<!-- Upload Draft Modal - Inline CSS Version -->
<div id="upload-draft-backdrop" style="display: none; position: fixed; top: 0; right: 0; bottom: 0; left: 0; background-color: rgba(0, 0, 0, 0.5); backdrop-filter: blur(4px); z-index: 9998; transition: opacity 0.15s;" onclick="closeUploadDraftModal()"></div>
<div id="upload-draft-modal" style="display: none; position: fixed; top: 0; right: 0; bottom: 0; left: 0; z-index: 9999; overflow-y: auto;">
    <div style="display: flex; min-height: 100%; align-items: center; justify-content: center; padding: 1rem;">
        <div style="position: relative; background-color: #ffffff; border-radius: 1rem; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25); max-width: 32rem; width: 100%; transform: translateY(0); transition: all 0.15s;">
            <!-- Modal Header -->
            <div style="position: relative; overflow: hidden; background: linear-gradient(to bottom right, #10b981, #059669, #0d9488); padding: 2rem 1.5rem; border-radius: 1rem 1rem 0 0;">
                <div style="position: absolute; top: 0; right: 0; bottom: 0; left: 0; background-color: rgba(0, 0, 0, 0.1);"></div>
                <div style="position: relative; z-index: 10; display: flex; align-items: center; justify-content: space-between;">
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <div style="width: 3.5rem; height: 3.5rem; background-color: rgba(255, 255, 255, 0.2); backdrop-filter: blur(4px); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);">
                            <i class="fas fa-file-upload" style="font-size: 1.875rem; color: #ffffff;"></i>
                        </div>
                        <div>
                            <h3 style="font-size: 1.5rem; font-weight: 700; color: #ffffff; margin: 0;">Upload Draft Dokumen</h3>
                            <p style="font-size: 0.875rem; color: rgba(255, 255, 255, 0.8); margin: 0.25rem 0 0 0;">Upload dokumen hasil penilaian (PDF)</p>
                        </div>
                    </div>
                    <button type="button" onclick="closeUploadDraftModal()" style="color: rgba(255, 255, 255, 0.8); border: none; background: transparent; border-radius: 0.5rem; padding: 0.5rem; transition: all 0.15s; cursor: pointer;" onmouseover="this.style.color='#ffffff'; this.style.backgroundColor='rgba(255, 255, 255, 0.2)';" onmouseout="this.style.color='rgba(255, 255, 255, 0.8)'; this.style.backgroundColor='transparent';">
                        <i class="fas fa-times" style="font-size: 1.25rem;"></i>
                    </button>
                </div>
                <!-- Decorative circles -->
                <div style="position: absolute; top: 0; right: 0; width: 8rem; height: 8rem; background-color: rgba(255, 255, 255, 0.1); border-radius: 50%; transform: translate(4rem, -4rem);"></div>
                <div style="position: absolute; bottom: 0; left: 0; width: 6rem; height: 6rem; background-color: rgba(255, 255, 255, 0.1); border-radius: 50%; transform: translate(-3rem, 3rem);"></div>
            </div>

            <!-- Modal Body -->
            <form id="upload-draft-form" action="{{ route('member.kkpr.upload.draft') }}" method="POST" enctype="multipart/form-data" style="padding: 1.5rem;">
                @csrf
                <input type="hidden" name="kkpr_id" id="upload_draft_kkpr_id">

                <!-- Upload Area -->
                <div style="display: flex; flex-direction: column; gap: 1rem;">
                    <!-- Info Box -->
                    <div style="background: linear-gradient(to right, #d1fae5, #ccfbf1); border-left: 4px solid #10b981; border-radius: 0.5rem; padding: 1rem;">
                        <div style="display: flex; align-items: flex-start; gap: 0.75rem;">
                            <i class="fas fa-info-circle" style="color: #059669; margin-top: 0.125rem;"></i>
                            <div style="flex: 1;">
                                <p style="font-size: 0.875rem; font-weight: 500; color: #064e3b; margin: 0 0 0.5rem 0;">Informasi Upload</p>
                                <ul style="font-size: 0.75rem; color: #047857; margin: 0; padding-left: 1.25rem; list-style: disc;">
                                    <li style="margin-bottom: 0.25rem;">Format file: <strong>PDF</strong></li>
                                    <li style="margin-bottom: 0.25rem;">Ukuran maksimal: <strong>10 MB</strong></li>
                                    <li>Dokumen akan otomatis menyelesaikan proses</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- File Upload Area -->
                    <div style="position: relative;">
                        <label style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 0.75rem;">
                            <i class="fas fa-file-pdf" style="margin-right: 0.5rem; color: #059669;"></i>
                            Pilih File PDF <span style="color: #ef4444;">*</span>
                        </label>
                        
                        <div style="position: relative; border: 2px dashed #d1d5db; border-radius: 0.75rem; padding: 2rem; text-align: center; background: linear-gradient(to bottom right, #f9fafb, #e5e7eb); transition: border-color 0.3s;" onmouseover="this.style.borderColor='#10b981';" onmouseout="this.style.borderColor='#d1d5db';">
                            <input type="file" id="draft_file" name="draft_file" accept="application/pdf" required
                                   style="position: absolute; top: 0; right: 0; bottom: 0; left: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer; z-index: 10;">
                            
                            <div style="pointer-events: none;">
                                <div style="width: 4rem; height: 4rem; background: linear-gradient(to bottom right, #10b981, #0d9488); border-radius: 1rem; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem auto; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);">
                                    <i class="fas fa-cloud-upload-alt" style="font-size: 1.875rem; color: #ffffff;"></i>
                                </div>
                                <p style="font-size: 1rem; font-weight: 600; color: #374151; margin: 0 0 0.25rem 0;">Klik atau drag file ke sini</p>
                                <p style="font-size: 0.75rem; color: #6b7280; margin: 0;">PDF, maksimal 10 MB</p>
                            </div>
                        </div>

                        <!-- File Preview -->
                        <div id="file-preview-section" style="display: none; margin-top: 1rem; padding: 1rem; background-color: #ffffff; border: 2px solid #a7f3d0; border-radius: 0.75rem;">
                            <div style="display: flex; align-items: center; gap: 1rem;">
                                <div style="width: 3rem; height: 3rem; background: linear-gradient(to bottom right, #ef4444, #dc2626); border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
                                    <i class="fas fa-file-pdf" style="font-size: 1.5rem; color: #ffffff;"></i>
                                </div>
                                <div style="flex: 1; min-width: 0;">
                                    <p style="font-size: 0.875rem; font-weight: 600; color: #111827; margin: 0; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" id="file-name-display">Belum ada file dipilih</p>
                                    <div style="display: flex; align-items: center; gap: 0.5rem; margin-top: 0.25rem;">
                                        <span style="font-size: 0.75rem; color: #6b7280;" id="file-size-display"></span>
                                        <span style="display: inline-flex; align-items: center; padding: 0.125rem 0.5rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 500; background-color: #d1fae5; color: #065f46;">
                                            <i class="fas fa-check-circle" style="margin-right: 0.25rem;"></i>
                                            Siap Upload
                                        </span>
                                    </div>
                                </div>
                                <button type="button" onclick="document.getElementById('draft_file').value=''; document.getElementById('file-preview-section').style.display='none';" 
                                        style="color: #9ca3af; border: none; background: transparent; cursor: pointer; transition: color 0.15s; padding: 0.25rem;" onmouseover="this.style.color='#dc2626';" onmouseout="this.style.color='#9ca3af';">
                                    <i class="fas fa-times-circle" style="font-size: 1.25rem;"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div style="display: flex; align-items: center; justify-content: flex-end; gap: 0.75rem; margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid #e5e7eb;">
                    <button type="button" onclick="closeUploadDraftModal()" 
                            style="padding: 0.625rem 1.5rem; color: #374151; background-color: #f3f4f6; font-weight: 600; border-radius: 0.75rem; transition: all 0.2s; border: none; cursor: pointer;" onmouseover="this.style.backgroundColor='#e5e7eb';" onmouseout="this.style.backgroundColor='#f3f4f6';">
                        <i class="fas fa-times" style="margin-right: 0.5rem;"></i>
                        Batal
                    </button>
                    <button type="submit" 
                            style="padding: 0.625rem 1.5rem; background: linear-gradient(to right, #10b981, #0d9488); color: #ffffff; font-weight: 600; border-radius: 0.75rem; transition: all 0.2s; border: none; cursor: pointer;" onmouseover="this.style.boxShadow='0 10px 15px -3px rgba(0, 0, 0, 0.1)'; this.style.transform='scale(1.05)';" onmouseout="this.style.boxShadow='none'; this.style.transform='scale(1)';">
                        <i class="fas fa-upload" style="margin-right: 0.5rem;"></i>
                        Upload Dokumen
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Request Pencabutan Modal -->
<div id="pencabutan-backdrop" style="display: none; position: fixed; top: 0; right: 0; bottom: 0; left: 0; background-color: rgba(0, 0, 0, 0.5); backdrop-filter: blur(4px); z-index: 9998; transition: opacity 0.15s;" onclick="closePencabutanModal()"></div>
<div id="pencabutan-modal" style="display: none; position: fixed; top: 0; right: 0; bottom: 0; left: 0; z-index: 9999; overflow-y: auto;">
    <div style="display: flex; min-height: 100%; align-items: center; justify-content: center; padding: 1rem;">
        <div style="position: relative; background-color: #ffffff; border-radius: 1rem; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25); max-width: 32rem; width: 100%; transform: translateY(0); transition: all 0.15s;">
            <!-- Modal Header -->
            <div style="position: relative; overflow: hidden; background: linear-gradient(to bottom right, #f59e0b, #d97706, #b45309); padding: 2rem 1.5rem; border-radius: 1rem 1rem 0 0;">
                <div style="position: absolute; top: 0; right: 0; bottom: 0; left: 0; background-color: rgba(0, 0, 0, 0.1);"></div>
                <div style="position: relative; z-index: 10; display: flex; align-items: center; justify-content: space-between;">
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <div style="width: 3.5rem; height: 3.5rem; background-color: rgba(255, 255, 255, 0.2); backdrop-filter: blur(4px); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);">
                            <i class="fas fa-times-circle" style="font-size: 1.875rem; color: #ffffff;"></i>
                        </div>
                        <div>
                            <h3 style="font-size: 1.5rem; font-weight: 700; color: #ffffff; margin: 0;">Request Pencabutan</h3>
                            <p style="font-size: 0.875rem; color: rgba(255, 255, 255, 0.8); margin: 0.25rem 0 0 0;">Berikan alasan pencabutan permohonan</p>
                        </div>
                    </div>
                    <button type="button" onclick="closePencabutanModal()" style="color: rgba(255, 255, 255, 0.8); border: none; background: transparent; border-radius: 0.5rem; padding: 0.5rem; transition: all 0.15s; cursor: pointer;" onmouseover="this.style.color='#ంద'; this.style.backgroundColor='rgba(255, 255, 255, 0.2)';" onmouseout="this.style.color='rgba(255, 255, 255, 0.8)'; this.style.backgroundColor='transparent';">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>

            <!-- Modal Body -->
            <form id="pencabutan-form" action="#" method="POST" style="padding: 1.5rem;">
                @csrf
                <input type="hidden" name="kkpr_id" id="pencabutan_kkpr_id">

                <!-- Alasan Pencabutan -->
                <div style="display: flex; flex-direction: column; gap: 1rem;">
                    <div style="background: linear-gradient(to right, #fef3c7, #fde68a); border-left: 4px solid #f59e0b; border-radius: 0.5rem; padding: 1rem;">
                        <div style="display: flex; align-items: flex-start; gap: 0.75rem;">
                            <i class="fas fa-info-circle" style="color: #d97706; margin-top: 0.125rem;"></i>
                            <div style="flex: 1;">
                                <p style="font-size: 0.875rem; font-weight: 500; color: #92400e; margin: 0;">Informasi Pencabutan</p>
                                <ul style="font-size: 0.75rem; color: #a16207; margin: 0.25rem 0 0 0; padding-left: 1.25rem; list-style: disc;">
                                    <li>Request pencabutan hanya dapat dilakukan sebelum verifikasi</li>
                                    <li>Alasan pencabutan wajib diisi</li>
                                    <li>Request akan disetujui oleh admin</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">
                            <i class="fas fa-comment-alt" style="margin-right: 0.5rem; color: #f59e0b;"></i>
                            Alasan Pencabutan <span style="color: #ef4444;">*</span>
                        </label>
                        <textarea name="alasan_pencabutan" rows="4" required
                                  style="width: 100%; padding: 0.75rem; border: 2px solid #e5e7eb; border-radius: 0.5rem; font-size: 0.875rem; transition: all 0.2s; resize: vertical;"
                                  placeholder="Berikan alasan mengapa permohonan dicabut..."></textarea>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div style="display: flex; align-items: center; justify-content: flex-end; gap: 0.75rem; margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid #e5e7eb;">
                    <button type="button" onclick="closePencabutanModal()" 
                            style="padding: 0.625rem 1.5rem; color: #374151; background-color: #f3f4f6; font-weight: 600; border-radius: 0.75rem; transition: all 0.2s; border: none; cursor: pointer;" onmouseover="this.style.backgroundColor='#e5e7eb';" onmouseout="this.style.backgroundColor='#f3f4f6';">
                        <i class="fas fa-times" style="margin-right: 0.5rem;"></i>
                        Batal
                    </button>
                    <button type="submit" 
                            style="padding: 0.625rem 1.5rem; background: linear-gradient(to right, #f59e0b, #d97706); color: #ffffff; font-weight: 600; border-radius: 0.75rem; transition: all 0.2s; border: none; cursor: pointer;" onmouseover="this.style.boxShadow='0 10px 15px -3px rgba(0, 0, 0, 0.1)'; this.style.transform='scale(1.05)';" onmouseout="this.style.boxShadow='none'; this.style.transform='scale(1)';">
                        <i class="fas fa-paper-plane" style="margin-right: 0.5rem;"></i>
                        Kirim Request
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection




