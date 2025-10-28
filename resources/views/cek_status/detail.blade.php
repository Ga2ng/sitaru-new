<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Detail Status Surat {{ $model->no_kkpr }} - SITARU - SISTEM INFORMASI TATA RUANG</title>
        <link rel="icon" type="image/png" href="{{ asset('images/logo_bwi.png') }}">
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&family=poppins:400,500,600,700,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        .hero-bg { 
            background: linear-gradient(135deg, rgba(21, 93, 79, 0.8) 0%, rgba(0, 0, 0, 0.6) 50%, rgba(218, 175, 73, 0.3) 100%), 
                        url('{{ asset("images/slider.jpeg") }}') center/cover no-repeat;
        }
        .gradient-bg { background: #F7F8F9; }
        .card-shadow { box-shadow: 0 8px 32px rgba(21, 93, 79, 0.12); }
        .btn-primary { 
            background: linear-gradient(135deg, #155D4F 0%, #0F3D26 100%); 
            transition: all 0.3s ease; 
            border: 2px solid #DAAF49;
            position: relative;
            overflow: hidden;
        }
        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(218, 175, 73, 0.3), transparent);
            transition: left 0.5s;
        }
        .btn-primary:hover::before { left: 100%; }
        .btn-primary:hover { 
            transform: translateY(-2px); 
            box-shadow: 0 12px 35px rgba(21, 93, 79, 0.4);
            border-color: #DAAF49;
        }
        .feature-card { 
            transition: all 0.3s ease; 
            border: 1px solid #E8F5F0;
            position: relative;
            overflow: hidden;
        }
        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #155D4F, #DAAF49, #155D4F);
        }
        .feature-card:hover { 
            transform: translateY(-8px); 
            box-shadow: 0 20px 40px rgba(21, 93, 79, 0.2);
            border-color: #DAAF49;
        }
        .section-accent { background: linear-gradient(135deg, #F7F8F9 0%, #E8F5F0 100%); }
        .text-accent { color: #155D4F; }
        .bg-accent { background-color: #E8F5F0; }
        .border-accent { border-color: #DAAF49; }
        .text-primary { color: #155D4F; }
        .bg-primary { background-color: #155D4F; }
        .border-primary { border-color: #155D4F; }
        .traditional-pattern {
            background-image: 
                radial-gradient(circle at 25px 25px, rgba(218, 175, 73, 0.1) 2px, transparent 0),
                radial-gradient(circle at 75px 75px, rgba(21, 93, 79, 0.1) 2px, transparent 0);
            background-size: 100px 100px;
        }
        .font-heading { font-family: 'Poppins', sans-serif; }
        .font-body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="font-body antialiased">
    <div class="min-h-screen traditional-pattern" style="background: linear-gradient(135deg, #155D4F 0%, #0F3D26 25%, #DAAF49 75%, #F4D03F 100%);">
        <!-- Navigation -->
        <nav class="bg-white/90 backdrop-blur-md shadow-lg sticky top-0 z-50 border-b-2 border-accent">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center">
                        <a href="{{ url('/') }}" class="text-2xl font-bold text-primary font-heading">SITARU</a>
                        <div class="ml-2 w-1 h-6 bg-gradient-to-b from-primary to-accent"></div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('cek-status.index') }}" class="text-gray-700 hover:text-[#155D4F] px-3 py-2 rounded-md text-sm font-medium transition-colors">
                            <i class="fa fa-search mr-1"></i>Cek Lagi
                        </a>
                        <a href="{{ url('/') }}" class="text-gray-700 hover:text-[#155D4F] px-3 py-2 rounded-md text-sm font-medium transition-colors">Beranda</a>
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn-primary text-white px-6 py-2 rounded-lg font-medium">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="text-gray-700 hover:text-[#155D4F] px-3 py-2 rounded-md text-sm font-medium transition-colors">Masuk</a>
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <!-- Content -->
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 relative z-10">
            <!-- Header -->
            <div class="text-center mb-12">
                <div class="inline-block mb-6">
                    <div class="w-16 h-1 bg-gradient-to-r from-[#DAAF49] to-[#155D4F] mx-auto mb-4"></div>
                    <h1 class="text-3xl md:text-4xl font-bold text-[#155D4F] mb-4 font-heading">
                        Status <span class="text-[#DAAF49] relative">
                            Surat
                            <div class="absolute -bottom-2 left-0 right-0 h-1 bg-gradient-to-r from-[#DAAF49] to-transparent"></div>
                        </span>
                    </h1>
                </div>
                <p class="text-lg text-gray-600 font-body">Detail status dan progress pengajuan Surat Anda</p>
            </div>

            <!-- Info Cards -->
            <div class="grid md:grid-cols-4 gap-6 mb-12">
                <div class="feature-card bg-white/90 backdrop-blur-sm p-6 rounded-xl card-shadow text-center">
                    <div class="w-14 h-14 bg-gradient-to-br from-[#155D4F] to-[#0F3D26] rounded-lg flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <i class="fa fa-hashtag text-white text-xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-[#155D4F] mb-2 font-heading">Nomor Surat</h3>
                    <p class="text-gray-600 text-sm font-body font-mono font-bold">{{ $model->no_kkpr ?? '-' }}</p>
                </div>

                <div class="feature-card bg-white/90 backdrop-blur-sm p-6 rounded-xl card-shadow text-center">
                    <div class="w-14 h-14 bg-gradient-to-br from-[#155D4F] to-[#0F3D26] rounded-lg flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <i class="fa fa-user text-white text-xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-[#155D4F] mb-2 font-heading">Pemohon</h3>
                    <p class="text-gray-600 text-sm font-body">{{ $model->user->name ?? 'N/A' }}</p>
                </div>

                <div class="feature-card bg-white/90 backdrop-blur-sm p-6 rounded-xl card-shadow text-center">
                    <div class="w-14 h-14 bg-gradient-to-br from-[#155D4F] to-[#0F3D26] rounded-lg flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <i class="fa fa-calendar text-white text-xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-[#155D4F] mb-2 font-heading">Tanggal Surat</h3>
                    <p class="text-gray-600 text-sm font-body">
                        {{ $model->tgl_kkpr ? \Carbon\Carbon::parse($model->tgl_kkpr)->format('d M Y') : '-' }}
                    </p>
                </div>

                <div class="feature-card bg-white/90 backdrop-blur-sm p-6 rounded-xl card-shadow text-center">
                    <div class="w-14 h-14 bg-gradient-to-br from-[#155D4F] to-[#0F3D26] rounded-lg flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <i class="fa fa-tag text-white text-xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-[#155D4F] mb-2 font-heading">Jenis Surat</h3>
                    <p class="text-gray-600 text-sm font-body">{{ $model->jenis == 'non_umk' ? 'KKPR' : ucwords(str_replace('_', ' ', $model->jenis)) }}</p>
                </div>
            </div>

            <!-- Progress Timeline -->
            <div class="bg-white/95 backdrop-blur-sm rounded-2xl p-8 shadow-2xl border border-white/20 mb-8">
                <div class="text-center mb-8">
                    <div class="w-16 h-16 bg-gradient-to-br from-[#155D4F] to-[#0F3D26] rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <i class="fa fa-list-check text-white text-2xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-[#155D4F] font-heading mb-2">Progress Status</h2>
                    <p class="text-gray-600">Timeline proses pengajuan Surat Anda</p>
                </div>

                <div class="relative">
                    <div class="absolute left-6 top-0 bottom-0 w-0.5 bg-gradient-to-b from-[#185B3C] via-gray-300 to-gray-200"></div>
                    <div class="space-y-6">
                        @php
                            $badgeConfig = [
                                0 => ['icon' => 'fa-times-circle', 'color' => '#dc2626', 'label' => 'Ditolak'],
                                'pencabutan-request' => ['icon' => 'fa-exclamation-triangle', 'color' => '#f59e0b', 'label' => 'Request Pencabutan'],
                                'pencabutan-confirmed' => ['icon' => 'fa-ban', 'color' => '#6b7280', 'label' => 'Pencabutan Dikonfirmasi'],
                                1 => ['icon' => 'fa-address-card', 'color' => '#db3102', 'label' => 'Pengajuan'],
                                2 => ['icon' => 'fa-upload', 'color' => '#dbac02', 'label' => 'Upload Dokumen'],
                                3 => ['icon' => 'fa-check-circle', 'color' => '#9edb02', 'label' => 'Validasi'],
                                4 => ['icon' => 'fa-upload', 'color' => '#38db02', 'label' => 'Upload'],
                                5 => ['icon' => 'fa-upload', 'color' => '#02db84', 'label' => 'Validasi'],
                                6 => ['icon' => 'fa-edit', 'color' => '#02d7db', 'label' => 'Survey'],
                                7 => ['icon' => 'fa-check-circle', 'color' => '#8102db', 'label' => 'Analisa'],
                                8 => ['icon' => 'fa-check-circle', 'color' => '#cd02db', 'label' => 'Persetujuan'],
                                9 => ['icon' => 'fa-check-circle', 'color' => '#db02db', 'label' => 'TTE'],
                                10 => ['icon' => 'fa-handshake', 'color' => '#db0293', 'label' => 'Selesai'],
                                11 => ['icon' => 'fa-file', 'color' => '#0252db', 'label' => 'Dokumen']
                            ];
                        @endphp

                        @php
                            // Cek dan tampilkan riwayat pencabutan jika ada (status_id = 0)
                            $pencabutanRiwayat = $riwayat->filter(function($r) {
                                return $r->status_id == 0 && (str_contains($r->status, 'Pencabutan') || str_contains($r->status, 'pencabutan'));
                            });
                            $hasPencabutan = $pencabutanRiwayat->count() > 0;
                        @endphp

                        @for($statusId = 1; $statusId <= 10; $statusId++)
                            @php
                                // Find existing riwayat for this status_id
                                $existingRiwayat = $riwayat->firstWhere('status_id', $statusId);
                                
                                // Skip pending steps if there's pencabutan
                                if ($hasPencabutan && $statusId > $model->proses) {
                                    continue; // Skip pending steps when there's pencabutan
                                }
                            @endphp

                            @if($existingRiwayat)
                                @php
                                    $r = $existingRiwayat;
                                    $isDitolak = $r->status_id == 0;
                                    $isRevisi = $r->status_id == $model->proses && $model->revisi == 1 && !$isDitolak;
                                    $badge = $badgeConfig[$r->status_id] ?? ['icon' => 'fa-file', 'color' => '#6c757d', 'label' => 'Unknown'];
                                    $badgeIcon = $isDitolak ? 'fa-times-circle' : ($isRevisi ? 'fa-exclamation-circle' : $badge['icon']);
                                    $badgeColor = $isDitolak ? '#dc2626' : ($isRevisi ? '#eab308' : $badge['color']);
                                    
                                    $date = \Carbon\Carbon::parse($r->updated_at);
                                    $formattedDate = $date->format('d M Y');
                                    $formattedTime = $date->format('H:i:s');
                                @endphp

                                <div class="relative pl-16 group">
                                    <div class="absolute left-0 w-12 h-12 rounded-full flex items-center justify-center shadow-lg transition-transform duration-300 group-hover:scale-110 z-10" style="background-color: {{ $badgeColor }}">
                                        <i class="fa {{ $badgeIcon }} text-white text-lg"></i>
                                    </div>
                                    <div class="{{ $isDitolak ? 'bg-red-50 border-red-300 border-2' : ($isRevisi ? 'bg-yellow-50 border-yellow-200' : 'bg-white border-gray-200') }} rounded-xl p-4 shadow-md border transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                                        <div class="flex items-start justify-between mb-3">
                                            <div class="flex-1">
                                                <h4 class="font-bold {{ $isDitolak ? 'text-red-900' : 'text-gray-900' }} text-base mb-1">{{ $r->status }}</h4>
                                                <div class="flex items-center space-x-3 text-xs text-gray-500">
                                                    <div class="flex items-center">
                                                        <i class="fa fa-calendar mr-1.5"></i>
                                                        <span>{{ $formattedDate }}</span>
                                                    </div>
                                                    <div class="flex items-center">
                                                        <i class="fa fa-clock mr-1.5"></i>
                                                        <span>{{ $formattedTime }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            @if($isDitolak)
                                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800 border-2 border-red-400">
                                                    <i class="fa fa-ban mr-1"></i>Ditolak
                                                </span>
                                            @elseif($isRevisi)
                                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800 border border-yellow-300">
                                                    <i class="fa fa-exclamation-circle mr-1"></i>Revisi
                                                </span>
                                            @elseif($r->status_id == $model->proses)
                                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800 border border-blue-300">
                                                    <i class="fa fa-spinner mr-1"></i>Aktif
                                                </span>
                                            @else
                                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800 border border-green-300">
                                                    <i class="fa fa-check mr-1"></i>Selesai
                                                </span>
                                            @endif
                                        </div>
                                        <div class="{{ $isDitolak ? 'bg-white/70' : ($isRevisi ? 'bg-white/50' : 'bg-gray-50') }} rounded-lg p-3">
                                            <p class="text-sm text-gray-700 leading-relaxed">{{ $r->keterangan }}</p>
                                            @if($isDitolak && $r->revisi_detail)
                                                <div class="mt-3 p-3 bg-red-100 border-2 border-red-300 rounded-lg">
                                                    <p class="text-xs font-semibold text-red-900 mb-1">
                                                        <i class="fa fa-ban mr-1"></i>Alasan Penolakan:
                                                    </p>
                                                    <p class="text-sm text-red-800 font-medium">{{ $r->revisi_detail }}</p>
                                                </div>
                                            @elseif($isRevisi && $r->revisi_detail)
                                                <div class="mt-3 p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                                                    <p class="text-xs font-semibold text-yellow-800 mb-1">
                                                        <i class="fa fa-info-circle mr-1"></i>Detail Revisi:
                                                    </p>
                                                    <p class="text-sm text-yellow-700">{{ $r->revisi_detail }}</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @else
                                @php
                                    // Display placeholder for missing riwayat
                                    $badge = $badgeConfig[$statusId] ?? ['icon' => 'fa-file', 'color' => '#6c757d', 'label' => 'Unknown'];
                                    $isCompleted = $statusId < $model->proses;
                                    $isCurrent = $statusId == $model->proses;
                                    $isPending = $statusId > $model->proses;
                                    
                                    $statusText = $isCompleted ? 'Selesai' : ($isCurrent ? 'Aktif' : 'Belum Dilakukan');
                                    $statusClass = $isCompleted ? 'bg-green-100 text-green-800 border-green-300' : ($isCurrent ? 'bg-blue-100 text-blue-800 border-blue-300' : 'bg-gray-100 text-gray-600 border-gray-300');
                                    $statusIcon = $isCompleted ? 'fa-check' : ($isCurrent ? 'fa-spinner' : 'fa-clock');
                                    $statusColor = $isCompleted ? '#10b981' : ($isCurrent ? '#3b82f6' : '#6b7280');
                                @endphp

                                <div class="relative pl-16 group">
                                    <div class="absolute left-0 w-12 h-12 rounded-full flex items-center justify-center shadow-lg transition-transform duration-300 group-hover:scale-110 z-10" style="background-color: {{ $statusColor }}">
                                        <i class="fa {{ $badge['icon'] }} text-white text-lg"></i>
                                    </div>
                                    <div class="bg-white border-gray-200 rounded-xl p-4 shadow-md border transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                                        <div class="flex items-start justify-between mb-3">
                                            <div class="flex-1">
                                                <h4 class="font-bold text-gray-900 text-base mb-1">{{ $badge['label'] }}</h4>
                                                <div class="flex items-center space-x-3 text-xs text-gray-500">
                                                    <div class="flex items-center">
                                                        <i class="fa fa-info-circle mr-1.5"></i>
                                                        <span>{{ $isPending ? 'Menunggu proses sebelumnya' : 'Proses sistem' }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $statusClass }} border">
                                                <i class="fa {{ $statusIcon }} mr-1"></i>{{ $statusText }}
                                            </span>
                                        </div>
                                        <div class="bg-gray-50 rounded-lg p-3">
                                            <p class="text-sm text-gray-700 leading-relaxed">
                                                {{ $isPending ? 'Proses ini akan dilakukan setelah proses sebelumnya selesai' : ($isCompleted ? 'Proses ini telah diselesaikan oleh sistem' : 'Proses ini sedang berjalan') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endfor

                        @if($pencabutanRiwayat->count() > 0)
                            @foreach($pencabutanRiwayat->sortBy('updated_at') as $r)
                                @php
                                    $isRequest = str_contains($r->status, 'Request');
                                    $badge = $isRequest ? $badgeConfig['pencabutan-request'] : $badgeConfig['pencabutan-confirmed'];
                                    $bgColor = $isRequest ? 'bg-orange-50 border-orange-300' : 'bg-gray-100 border-gray-300';
                                    $textColor = $isRequest ? 'text-orange-900' : 'text-gray-900';
                                    
                                    $date = \Carbon\Carbon::parse($r->updated_at);
                                    $formattedDate = $date->format('d M Y');
                                    $formattedTime = $date->format('H:i');
                                @endphp

                                <div class="relative pl-16 group">
                                    <div class="absolute left-0 w-12 h-12 rounded-full flex items-center justify-center shadow-lg transition-transform duration-300 group-hover:scale-110 z-10" style="background-color: {{ $badge['color'] }}">
                                        <i class="fa {{ $badge['icon'] }} text-white text-lg"></i>
                                    </div>
                                    <div class="{{ $bgColor }} border-2 rounded-xl p-4 shadow-md transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                                        <div class="flex items-start justify-between mb-3">
                                            <div class="flex-1">
                                                <h4 class="font-bold {{ $textColor }} text-base mb-1">{{ $r->status }}</h4>
                                                <div class="flex items-center space-x-3 text-xs text-gray-600">
                                                    <div class="flex items-center">
                                                        <i class="fa fa-calendar mr-1.5"></i>
                                                        <span>{{ $formattedDate }}</span>
                                                    </div>
                                                    <div class="flex items-center">
                                                        <i class="fa fa-clock mr-1.5"></i>
                                                        <span>{{ $formattedTime }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $isRequest ? 'bg-orange-100 text-orange-800 border-2 border-orange-400' : 'bg-gray-100 text-gray-700 border-2 border-gray-400' }}">
                                                <i class="fa {{ $badge['icon'] }} mr-1"></i>{{ $badge['label'] }}
                                            </span>
                                        </div>
                                        <div class="bg-white/70 rounded-lg p-3">
                                            <p class="text-sm text-gray-700 leading-relaxed mb-2">{{ $r->keterangan }}</p>
                                            @if($r->revisi_detail)
                                                <div class="mt-3 p-3 {{ $isRequest ? 'bg-orange-100 border-2 border-orange-300' : 'bg-gray-50 border-2 border-gray-200' }} rounded-lg">
                                                    <p class="text-xs font-semibold {{ $isRequest ? 'text-orange-900' : 'text-gray-800' }} mb-1">
                                                        <i class="fa fa-info-circle mr-1"></i>{{ $isRequest ? 'Alasan Pencabutan:' : 'Konfirmasi:' }}
                                                    </p>
                                                    <p class="text-sm {{ $isRequest ? 'text-orange-800' : 'text-gray-700' }} font-medium">{{ $r->revisi_detail }}</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                        @php
                            // Handle rejected status (status_id = 0) if exists and not pencabutan
                            $rejectedRiwayat = $riwayat->first(function($r) {
                                return $r->status_id == 0 && !str_contains($r->status, 'Pencabutan') && !str_contains($r->status, 'pencabutan');
                            });
                        @endphp

                        @if($rejectedRiwayat)
                            @php
                                $r = $rejectedRiwayat;
                                $date = \Carbon\Carbon::parse($r->updated_at);
                                $formattedDate = $date->format('d M Y');
                                $formattedTime = $date->format('H:i:s');
                            @endphp

                            <div class="relative pl-16 group">
                                <div class="absolute left-0 w-12 h-12 rounded-full flex items-center justify-center shadow-lg transition-transform duration-300 group-hover:scale-110 z-10" style="background-color: #dc2626">
                                    <i class="fa fa-times-circle text-white text-lg"></i>
                                </div>
                                <div class="bg-red-50 border-red-300 border-2 rounded-xl p-4 shadow-md transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                                    <div class="flex items-start justify-between mb-3">
                                        <div class="flex-1">
                                            <h4 class="font-bold text-red-900 text-base mb-1">{{ $r->status }}</h4>
                                            <div class="flex items-center space-x-3 text-xs text-gray-500">
                                                <div class="flex items-center">
                                                    <i class="fa fa-calendar mr-1.5"></i>
                                                    <span>{{ $formattedDate }}</span>
                                                </div>
                                                <div class="flex items-center">
                                                    <i class="fa fa-clock mr-1.5"></i>
                                                    <span>{{ $formattedTime }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800 border-2 border-red-400">
                                            <i class="fa fa-ban mr-1"></i>Ditolak
                                        </span>
                                    </div>
                                    <div class="bg-white/70 rounded-lg p-3">
                                        <p class="text-sm text-gray-700 leading-relaxed">{{ $r->keterangan }}</p>
                                        @if($r->revisi_detail)
                                            <div class="mt-3 p-3 bg-red-100 border-2 border-red-300 rounded-lg">
                                                <p class="text-xs font-semibold text-red-900 mb-1">
                                                    <i class="fa fa-ban mr-1"></i>Alasan Penolakan:
                                                </p>
                                                <p class="text-sm text-red-800 font-medium">{{ $r->revisi_detail }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Info Cards -->
            <div class="grid md:grid-cols-3 gap-6 mt-12">
                <div class="feature-card bg-white/90 backdrop-blur-sm p-6 rounded-xl card-shadow text-center">
                    <div class="w-14 h-14 bg-gradient-to-br from-[#155D4F] to-[#0F3D26] rounded-lg flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <i class="fa fa-shield-alt text-white text-xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-[#155D4F] mb-2 font-heading">Aman & Terpercaya</h3>
                    <p class="text-gray-600 text-sm font-body">Data Anda terlindungi dengan sistem keamanan terbaik</p>
                </div>

                <div class="feature-card bg-white/90 backdrop-blur-sm p-6 rounded-xl card-shadow text-center">
                    <div class="w-14 h-14 bg-gradient-to-br from-[#155D4F] to-[#0F3D26] rounded-lg flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <i class="fa fa-clock text-white text-xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-[#155D4F] mb-2 font-heading">Real-time</h3>
                    <p class="text-gray-600 text-sm font-body">Informasi status terbaru dan akurat</p>
                </div>

                <div class="feature-card bg-white/90 backdrop-blur-sm p-6 rounded-xl card-shadow text-center">
                    <div class="w-14 h-14 bg-gradient-to-br from-[#155D4F] to-[#0F3D26] rounded-lg flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <i class="fa fa-mobile-alt text-white text-xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-[#155D4F] mb-2 font-heading">Mudah Diakses</h3>
                    <p class="text-gray-600 text-sm font-body">Bisa diakses kapan saja dan di mana saja</p>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-8 flex justify-center items-center gap-4 flex-wrap">
                <a href="{{ route('cek-status.index') }}" class="btn-primary text-white px-8 py-3 rounded-lg font-semibold shadow-xl relative overflow-hidden">
                    <span class="relative z-10 flex items-center">
                        <i class="fa fa-search mr-2"></i>
                        Cek Status Lain
                    </span>
                </a>
                <a href="{{ url('/') }}" class="bg-transparent text-[#155D4F] px-8 py-3 rounded-lg font-semibold border-2 border-[#155D4F] hover:bg-[#155D4F] hover:text-white transition-all duration-300">
                    <i class="fa fa-home mr-2"></i>
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</body>
</html>
