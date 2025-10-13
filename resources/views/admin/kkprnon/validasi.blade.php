@extends('layouts.app')

@section('title', 'Validasi Dokumen Persetujuan Bagi UMK')
@section('subtitle', 'Validasi dokumen permohonan Persetujuan Bagi UMK #' . $model->id)

@section('content')
@php
    $prop = \DB::table('setup_prop')->where('NO_PROP', 35)->first();
    $kab = \DB::table('setup_kab')->where('NO_PROP', 35)->where('NO_KAB', 10)->first();
    $kec = \DB::table('setup_kec')->where('NO_PROP', 35)->where('NO_KAB', 10)->where('NO_KEC', $model->NO_KEC)->first();
    $kel = \DB::table('setup_kel_fix')->where('NO_PROP', $prop->NO_PROP)->where('NO_KAB', 10)->where('NO_KEC', $kec->NO_KEC ?? '')->where('NO_KEL', $model->kelurahan_id)->first();
@endphp

<div class="max-w-7xl mx-auto space-y-6">
    <!-- Hero Section with Gradient -->
    <div class="relative overflow-hidden bg-gradient-to-br from-[#185B3C] via-[#0F3D26] to-[#185B3C] rounded-xl p-6 text-white">
        <div class="absolute inset-0 bg-black/10"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold mb-1">Validasi Dokumen Persetujuan Bagi UMK #{{ $model->id }}</h1>
                    <p class="text-sm text-white/90 mb-4">Validasi kelengkapan dokumen permohonan Persetujuan Bagi UMK</p>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-yellow-400 rounded-full animate-pulse"></div>
                            <span class="text-xs">Menunggu Validasi</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-calendar text-xs"></i>
                            <span class="text-xs">{{ $model->created_at->format('d M Y H:i') }}</span>
                        </div>
                    </div>
                </div>
                <div class="hidden lg:block">
                    <div class="w-20 h-20 bg-white/10 rounded-full flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-check-circle text-3xl text-white/80"></i>
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
        <a href="{{ route('admin.kkprnon.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali
        </a>
    </div>

    <!-- Main Content -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        <!-- Biodata Pemohon -->
        <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
            <div class="flex items-center space-x-3 mb-6">
                <div class="w-10 h-10 bg-gradient-to-br from-[#185B3C] to-[#0F3D26] rounded-xl flex items-center justify-center shadow-md">
                    <i class="fas fa-user text-white text-sm"></i>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Biodata Pemohon</h3>
                    <p class="text-sm text-gray-500">Informasi lengkap pemohon</p>
                </div>
            </div>
            
            <!-- Profile Card -->
            <div class="bg-gradient-to-br from-[#185B3C]/5 to-transparent rounded-lg p-4 mb-6">
                <div class="flex items-center space-x-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-[#185B3C] to-[#0F3D26] rounded-full flex items-center justify-center shadow-lg">
                        <i class="fas fa-user text-white text-xl"></i>
                    </div>
                    <div class="flex-1">
                        <h4 class="text-lg font-bold text-gray-900">{{ $user->name ?? 'N/A' }}</h4>
                        <p class="text-sm text-gray-600">{{ $user->username ?? 'N/A' }}</p>
                        <p class="text-xs text-gray-500 mt-1">{{ $user->work ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="space-y-4">
                <div class="flex items-start space-x-3">
                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                        <i class="fas fa-envelope text-blue-600 text-xs"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-gray-600">Email</p>
                        <p class="text-sm text-gray-900 break-all">{{ $user->email ?? 'N/A' }}</p>
                    </div>
                </div>
                
                <div class="flex items-start space-x-3">
                    <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                        <i class="fas fa-phone text-green-600 text-xs"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-gray-600">No HP</p>
                        <p class="text-sm text-gray-900">{{ $user->phone ?? 'N/A' }}</p>
                    </div>
                </div>
                
                <div class="flex items-start space-x-3">
                    <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                        <i class="fas fa-map-marker-alt text-purple-600 text-xs"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-gray-600">Alamat</p>
                        <p class="text-sm text-gray-900">{{ $user->address ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Pengajuan -->
        <div class="xl:col-span-2 space-y-6">
            <!-- Data Kegiatan -->
            <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-md">
                        <i class="fas fa-home text-white text-sm"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Data Pengajuan Persetujuan Bagi UMK</h3>
                        <p class="text-sm text-gray-500">Informasi lengkap kegiatan dan lokasi</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div class="bg-gradient-to-r from-blue-50 to-blue-100 rounded-lg p-4">
                            <div class="space-y-3">
                                <div>
                                    <label class="text-sm font-semibold text-gray-600">Fungsi</label>
                                    <p class="text-gray-900 mt-1">{{ is_array($model->fungsi) ? implode(', ', $model->fungsi) : ($model->fungsi ?? 'N/A') }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-semibold text-gray-600">Alamat Kegiatan</label>
                                    <p class="text-gray-900 mt-1">{{ is_array($model->alamat_kegiatan) ? implode(', ', $model->alamat_kegiatan) : ($model->alamat_kegiatan ?? 'N/A') }}, {{ ucFirst(strToLower($kel->NAMA_KEL ?? '')) }} Kecamatan {{ ucFirst(strToLower($kec->NAMA_KEC ?? '')) }} Kabupaten {{ ucFirst(strToLower($kab->NAMA_KAB ?? '')) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="bg-gradient-to-r from-purple-50 to-purple-100 rounded-lg p-4">
                            <div class="space-y-3">
                                <div>
                                    <label class="text-sm font-semibold text-gray-600">Luas Tanah Sertifikat</label>
                                    <p class="text-gray-900 mt-1">{{ $model->luas_tanah ?? 'N/A' }} m²</p>
                                </div>
                                <div>
                                    <label class="text-sm font-semibold text-gray-600">Luas Yang Dimohon</label>
                                    <p class="text-gray-900 mt-1">{{ $model->luas_dimohon ?? 'N/A' }} m²</p>
                                </div>
                                <div>
                                    <label class="text-sm font-semibold text-gray-600">Status Tanah</label>
                                    <p class="text-gray-900 mt-1">{{ is_array($model->status_tanah) ? implode(', ', $model->status_tanah) : ($model->status_tanah ?? 'N/A') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                    <div class="bg-gradient-to-r from-orange-50 to-orange-100 rounded-lg p-4">
                        <label class="text-sm font-semibold text-gray-600">Penggunaan Sekarang</label>
                        <p class="text-gray-900 mt-1">{{ is_array($model->penggunaan_sekarang) ? implode(', ', $model->penggunaan_sekarang) : ($model->penggunaan_sekarang ?? 'N/A') }}</p>
                    </div>
                    <div class="bg-gradient-to-r from-teal-50 to-teal-100 rounded-lg p-4">
                        <label class="text-sm font-semibold text-gray-600">Jumlah Lantai</label>
                        <p class="text-gray-900 mt-1">{{ $model->jumlah_lantai ?? 'N/A' }} Lantai</p>
                    </div>
                    <div class="bg-gradient-to-r from-pink-50 to-pink-100 rounded-lg p-4">
                        <label class="text-sm font-semibold text-gray-600">Tinggi Bangunan</label>
                        <p class="text-gray-900 mt-1">{{ $model->tinggi_bangunan ?? 'N/A' }} m</p>
                    </div>
                </div>

                <div class="mt-4">
                    <div class="bg-gradient-to-r from-indigo-50 to-indigo-100 rounded-lg p-4">
                        <label class="text-sm font-semibold text-gray-600">Luas Lantai Bangunan</label>
                        @if(is_array($model->luas_lantai))
                            <div class="mt-2 space-y-1">
                                @foreach($model->luas_lantai as $index => $luas)
                                    <p class="text-gray-900 text-sm">Lantai {{ $index + 1 }}: {{ $luas }} m²</p>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-900 mt-1">{{ $model->luas_lantai ?? 'N/A' }} m²</p>
                        @endif
                    </div>
                </div>

                <div class="mt-4">
                    <div class="bg-gradient-to-r from-green-50 to-green-100 rounded-lg p-4">
                        <label class="text-sm font-semibold text-gray-600">Koordinat Lokasi</label>
                        <button onclick="open_koordinat({{ $model->id }})" class="mt-2 inline-flex items-center px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">
                            <i class="fas fa-search mr-2"></i> Lihat Koordinat
                        </button>
                    </div>
                </div>
            </div>

            <!-- Dokumen -->
            <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg border border-white/20 overflow-hidden">
                <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-gradient-to-br from-[#185B3C] to-[#0F3D26] rounded-lg flex items-center justify-center">
                            <i class="fas fa-file-alt text-white text-sm"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Dokumen Persyaratan</h3>
                            <p class="text-sm text-gray-600">Daftar dokumen yang telah diupload</p>
                        </div>
                    </div>
                </div>

                <div class="divide-y divide-gray-100">
                    <!-- KTP Pemohon -->
                    <div class="px-6 py-4 hover:bg-gradient-to-r hover:from-blue-50 hover:to-transparent transition-all">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-id-card text-blue-600 text-lg"></i>
                                <span class="font-medium text-gray-900">KTP Pemohon</span>
                            </div>
                            <div>
                                @if ($user->ktp != null)
                                    <a target="_blank" href="{{ url('/uploads/images/ktp/').'/'.$user->ktp }}" class="text-[#185B3C] hover:underline text-sm">{{ $user->ktp }}</a>
                                @else 
                                    <span class="text-yellow-600 text-sm">Tidak Upload</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- KTP Pemilik -->
                    <div class="px-6 py-4 hover:bg-gradient-to-r hover:from-purple-50 hover:to-transparent transition-all">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-id-card text-purple-600 text-lg"></i>
                                <span class="font-medium text-gray-900">KTP Pemilik</span>
                            </div>
                            <div>
                                @if ($model->ktp_pemilik != null)
                                    <a target="_blank" href="{{ url('/uploads/images/ktp/pemilik/').'/'.$model->id.'/'.$model->ktp_pemilik }}" class="text-[#185B3C] hover:underline text-sm">{{ $model->ktp_pemilik }}</a>
                                @else 
                                    <span class="text-yellow-600 text-sm">Tidak Upload</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Foto Utara -->
                    <div class="px-6 py-4 hover:bg-gradient-to-r hover:from-orange-50 hover:to-transparent transition-all">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-camera text-orange-600 text-lg"></i>
                                <span class="font-medium text-gray-900">Foto Utara</span>
                            </div>
                            <div>
                                @if ($model->foto_utara != null)
                                    <a target="_blank" href="{{ url('/uploads/berkas/kkpr/').'/'.$model->id.'/'.$model->foto_utara }}" class="text-[#185B3C] hover:underline text-sm">{{ $model->foto_utara }}</a>
                                @else 
                                    <span class="text-yellow-600 text-sm">Tidak Upload</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Foto Selatan -->
                    <div class="px-6 py-4 hover:bg-gradient-to-r hover:from-green-50 hover:to-transparent transition-all">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-camera text-green-600 text-lg"></i>
                                <span class="font-medium text-gray-900">Foto Selatan</span>
                            </div>
                            <div>
                                @if ($model->foto_selatan != null)
                                    <a target="_blank" href="{{ url('/uploads/berkas/kkpr/').'/'.$model->id.'/'.$model->foto_selatan }}" class="text-[#185B3C] hover:underline text-sm">{{ $model->foto_selatan }}</a>
                                @else 
                                    <span class="text-yellow-600 text-sm">Tidak Upload</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Foto Barat -->
                    <div class="px-6 py-4 hover:bg-gradient-to-r hover:from-indigo-50 hover:to-transparent transition-all">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-camera text-indigo-600 text-lg"></i>
                                <span class="font-medium text-gray-900">Foto Barat</span>
                            </div>
                            <div>
                                @if ($model->foto_barat != null)
                                    <a target="_blank" href="{{ url('/uploads/berkas/kkpr/').'/'.$model->id.'/'.$model->foto_barat }}" class="text-[#185B3C] hover:underline text-sm">{{ $model->foto_barat }}</a>
                                @else 
                                    <span class="text-yellow-600 text-sm">Tidak Upload</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Foto Timur -->
                    <div class="px-6 py-4 hover:bg-gradient-to-r hover:from-pink-50 hover:to-transparent transition-all">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-camera text-pink-600 text-lg"></i>
                                <span class="font-medium text-gray-900">Foto Timur</span>
                            </div>
                            <div>
                                @if ($model->foto_timur != null)
                                    <a target="_blank" href="{{ url('/uploads/berkas/kkpr/').'/'.$model->id.'/'.$model->foto_timur }}" class="text-[#185B3C] hover:underline text-sm">{{ $model->foto_timur }}</a>
                                @else 
                                    <span class="text-yellow-600 text-sm">Tidak Upload</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- KBLI -->
            @if($kbli && $kbli->count() > 0)
            <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg border border-white/20 overflow-hidden">
                <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-list text-white text-sm"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">KBLI</h3>
                            <p class="text-sm text-gray-600">Klasifikasi Baku Lapangan Usaha Indonesia</p>
                        </div>
                    </div>
                </div>

                <div class="px-6 py-4">
                    <div class="space-y-2">
                        @foreach ($kbli as $kb)
                        <div class="flex items-center justify-between bg-gradient-to-r from-purple-50 to-purple-100 rounded-lg p-3 border border-purple-200">
                            <span class="font-mono text-sm font-semibold text-purple-700">{{ $kb->kode_kbli }}</span>
                            <span class="text-sm text-gray-700">{{ $kb->judul_kbli }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex justify-center gap-4 mt-8">
        <button type="button" onclick="revisi_dokumen({{ $model->id }})" class="inline-flex items-center px-6 py-3 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors shadow-lg hover:shadow-xl font-semibold">
            <i class="fas fa-exclamation-circle mr-2"></i>
            Revisi Dokumen
        </button>
        <button type="button" onclick="validasi_dokumen({{ $model->id }})" class="inline-flex items-center px-6 py-3 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors shadow-lg hover:shadow-xl font-semibold">
            <i class="fas fa-check-circle mr-2"></i>
            Validasi Dokumen
        </button>
    </div>
</div>

<!-- Modal Koordinat -->
<div class="modal fade" id="modal-kor" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content"></div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function revisi_dokumen(id) {
        Swal.fire({
            title: "Revisi Dokumen",
            text: "Masukkan pesan revisi yang akan dikirimkan ke pemohon",
            input: 'textarea',
            inputPlaceholder: 'Tulis detail revisi di sini...',
            showCancelButton: true,
            confirmButtonText: 'Kirim Revisi',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            inputValidator: (value) => {
                if (!value) {
                    return 'Detail revisi harus diisi!'
                }
            }
        }).then((result) => {
            if (result.isConfirmed) {
                fetch('{{ route("admin.kkprnon.revisi") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        id: id,
                        revisi_detail: result.value
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Dokumen dikembalikan ke pemohon untuk direvisi',
                            confirmButtonColor: '#185B3C'
                        }).then(() => {
                            window.location.href = '{{ route("admin.kkprnon.index") }}';
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Dokumen gagal dikembalikan',
                            confirmButtonColor: '#ef4444'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Terjadi kesalahan',
                        confirmButtonColor: '#ef4444'
                    });
                });
            }
        });
    }

    function validasi_dokumen(id) {
        Swal.fire({
            title: "Validasi Dokumen",
            text: "Apa anda yakin akan memvalidasi pengajuan Persetujuan Bagi UMK ini?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Validasi',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#22c55e',
            cancelButtonColor: '#6b7280'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch('{{ route("admin.kkprnon.validasi.store") }}', {
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
                            title: 'Berhasil!',
                            text: 'Dokumen berhasil divalidasi',
                            confirmButtonColor: '#185B3C'
                        }).then(() => {
                            window.location.href = '{{ route("admin.kkprnon.index") }}';
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Dokumen gagal divalidasi',
                            confirmButtonColor: '#ef4444'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Terjadi kesalahan',
                        confirmButtonColor: '#ef4444'
                    });
                });
            }
        });
    }

    function open_koordinat(id) {
        const modal = $('#modal-kor');
        modal.modal('show');
        $.ajax({
            url: '{{ route("admin.kkprnon.koordinat", "") }}/' + id,
            type: "GET",
            dataType: "html",
            success: function(data) {
                modal.find('.modal-content').html(data);
            }
        });
    }
</script>
@endsection



