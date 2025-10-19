<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Status KKPR - {{ $model->no_kkpr }} - SITARU</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&family=poppins:400,500,600,700,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        .hero-bg { 
            background: linear-gradient(135deg, rgba(21, 93, 79, 0.8) 0%, rgba(0, 0, 0, 0.6) 50%, rgba(218, 175, 73, 0.3) 100%), 
                        url('/images/slider.jpeg') center/cover no-repeat;
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
    <div class="min-h-screen gradient-bg traditional-pattern">
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
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <!-- Header -->
            <div class="text-center mb-12">
                <div class="inline-block mb-6">
                    <div class="w-16 h-1 bg-gradient-to-r from-[#DAAF49] to-[#155D4F] mx-auto mb-4"></div>
                    <h1 class="text-3xl md:text-4xl font-bold text-[#155D4F] mb-4 font-heading">
                        Status <span class="text-[#DAAF49] relative">
                            KKPR
                            <div class="absolute -bottom-2 left-0 right-0 h-1 bg-gradient-to-r from-[#DAAF49] to-transparent"></div>
                        </span>
                    </h1>
                </div>
                <p class="text-lg text-gray-600 font-body">Detail status dan progress pengajuan KKPR Anda</p>
            </div>

            <!-- Info Cards -->
            <div class="grid md:grid-cols-4 gap-6 mb-12">
                <div class="feature-card bg-white p-6 rounded-xl card-shadow text-center">
                    <div class="w-14 h-14 bg-gradient-to-br from-[#155D4F] to-[#0F3D26] rounded-lg flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <i class="fa fa-hashtag text-white text-xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-[#155D4F] mb-2 font-heading">Nomor KKPR</h3>
                    <p class="text-gray-600 text-sm font-body font-mono font-bold">{{ $model->no_kkpr ?? '-' }}</p>
                </div>

                <div class="feature-card bg-white p-6 rounded-xl card-shadow text-center">
                    <div class="w-14 h-14 bg-gradient-to-br from-[#155D4F] to-[#0F3D26] rounded-lg flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <i class="fa fa-user text-white text-xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-[#155D4F] mb-2 font-heading">Pemohon</h3>
                    <p class="text-gray-600 text-sm font-body">{{ $model->user->name ?? 'N/A' }}</p>
                </div>

                <div class="feature-card bg-white p-6 rounded-xl card-shadow text-center">
                    <div class="w-14 h-14 bg-gradient-to-br from-[#155D4F] to-[#0F3D26] rounded-lg flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <i class="fa fa-calendar text-white text-xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-[#155D4F] mb-2 font-heading">Tanggal KKPR</h3>
                    <p class="text-gray-600 text-sm font-body">
                        {{ $model->tgl_kkpr ? \Carbon\Carbon::parse($model->tgl_kkpr)->format('d M Y') : '-' }}
                    </p>
                </div>

                <div class="feature-card bg-white p-6 rounded-xl card-shadow text-center">
                    <div class="w-14 h-14 bg-gradient-to-br from-[#155D4F] to-[#0F3D26] rounded-lg flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <i class="fa fa-map-marker-alt text-white text-xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-[#155D4F] mb-2 font-heading">Lokasi</h3>
                    <p class="text-gray-600 text-sm font-body">{{ $model->alamat_tanah ?? '-' }}</p>
                </div>
            </div>

            <!-- Progress Timeline -->
            <div class="bg-white rounded-2xl p-8 shadow-2xl border border-white/20 mb-8">
                <div class="text-center mb-8">
                    <div class="w-16 h-16 bg-gradient-to-br from-[#155D4F] to-[#0F3D26] rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <i class="fa fa-list-check text-white text-2xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-[#155D4F] font-heading mb-2">Progress Status</h2>
                    <p class="text-gray-600">Timeline proses pengajuan KKPR Anda</p>
                </div>

                <div class="relative">
                    <div class="absolute left-6 top-0 bottom-0 w-0.5 bg-gradient-to-b from-[#185B3C] via-gray-300 to-gray-200"></div>
                    <div class="space-y-6">
                        @php
                            $badgeConfig = [
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

                        @foreach($riwayat as $index => $r)
                            @if($r->status_id <= $model->proses)
                                @php
                                    $isRevisi = $r->status_id == $model->proses && $model->revisi == 1;
                                    $badge = $badgeConfig[$r->status_id] ?? ['icon' => 'fa-file', 'color' => '#6c757d', 'label' => 'Unknown'];
                                    $badgeIcon = $isRevisi ? 'fa-exclamation-circle' : $badge['icon'];
                                    $badgeColor = $isRevisi ? 'red' : $badge['color'];
                                    
                                    $date = \Carbon\Carbon::parse($r->updated_at);
                                    $formattedDate = $date->format('d M Y');
                                    $formattedTime = $date->format('H:i:s');
                                @endphp

                                <div class="relative pl-16 group">
                                    <div class="absolute left-0 w-12 h-12 rounded-full flex items-center justify-center shadow-lg transition-transform duration-300 group-hover:scale-110 z-10" style="background-color: {{ $badgeColor }}">
                                        <i class="fa {{ $badgeIcon }} text-white text-lg"></i>
                                    </div>
                                    <div class="{{ $isRevisi ? 'bg-red-50 border-red-200' : 'bg-white border-gray-200' }} rounded-xl p-4 shadow-md border transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                                        <div class="flex items-start justify-between mb-3">
                                            <div class="flex-1">
                                                <h4 class="font-bold text-gray-900 text-base mb-1">{{ $r->status }}</h4>
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
                                            @if($isRevisi)
                                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800 border border-red-300">
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
                                        <div class="{{ $isRevisi ? 'bg-white/50' : 'bg-gray-50' }} rounded-lg p-3">
                                            <p class="text-sm text-gray-700 leading-relaxed">{{ $r->keterangan }}</p>
                                            @if($isRevisi && $r->revisi_detail)
                                                <div class="mt-3 p-3 bg-red-50 border border-red-200 rounded-lg">
                                                    <p class="text-xs font-semibold text-red-800 mb-1">
                                                        <i class="fa fa-info-circle mr-1"></i>Detail Revisi:
                                                    </p>
                                                    <p class="text-sm text-red-700">{{ $r->revisi_detail }}</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-center items-center gap-4 flex-wrap">
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
