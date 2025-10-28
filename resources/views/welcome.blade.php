<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SITARU - SISTEM INFORMASI TATA RUANG</title>
        <link rel="icon" type="image/png" href="{{ asset('images/logo_bwi.png') }}">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&family=poppins:400,500,600,700,800&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        
         <!-- Leaflet CSS -->
         <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
         
         <!-- Swiper CSS -->
         <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    
            <style>
        .hero-bg { 
            background: linear-gradient(135deg, rgba(21, 93, 79, 0.8) 0%, rgba(0, 0, 0, 0.6) 50%, rgba(218, 175, 73, 0.3) 100%), 
                        url('/images/slider.jpeg') center/cover no-repeat;
        }
        .gradient-bg { background: #F7F8F9; }
        .footer-gradient { 
            background: linear-gradient(135deg, #155D4F 0%, #1a6b5c 50%, #DAAF49 100%) !important;
            background-attachment: fixed;
        }
        footer {
            background: linear-gradient(135deg, #155D4F 0%, #1a6b5c 50%, #DAAF49 100%) !important;
        }
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
        .gov-green { background: #FFFFFF; }
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
        .traditional-border {
            border-image: linear-gradient(45deg, #155D4F, #DAAF49, #155D4F) 1;
        }
        
         /* Line clamp utilities */
         .line-clamp-2 {
             display: -webkit-box;
             -webkit-line-clamp: 2;
             -webkit-box-orient: vertical;
             overflow: hidden;
         }
         
         .line-clamp-3 {
             display: -webkit-box;
             -webkit-line-clamp: 3;
             -webkit-box-orient: vertical;
             overflow: hidden;
         }
         
         /* Leaflet Map Styles */
         #contactMap {
             height: 320px !important;
             width: 100%;
             z-index: 0;
         }
         .leaflet-container {
             font-family: 'Inter', sans-serif;
         }
         
         /* Swiper Custom Styles */
         .swiper {
             padding: 20px 0 60px 0;
         }
         
         .swiper-slide {
             height: auto;
         }
         
         .swiper-button-next,
         .swiper-button-prev {
             color: #155D4F;
             background: white;
             border-radius: 50%;
             width: 50px;
             height: 50px;
             box-shadow: 0 4px 12px rgba(21, 93, 79, 0.15);
             transition: all 0.3s ease;
         }
         
         .swiper-button-next:hover,
         .swiper-button-prev:hover {
             background: #155D4F;
             color: white;
             transform: scale(1.1);
         }
         
         .swiper-button-next:after,
         .swiper-button-prev:after {
             font-size: 18px;
             font-weight: bold;
         }
         
         .swiper-pagination-bullet {
             background: #155D4F;
             opacity: 0.3;
         }
         
         .swiper-pagination-bullet-active {
             background: #155D4F;
             opacity: 1;
         }
            </style>
    </head>
<body class="font-body antialiased">
    <div class="min-h-screen gradient-bg traditional-pattern">
        <!-- Navigation -->
        <nav class="bg-white/90 backdrop-blur-md shadow-lg sticky top-0 z-50 border-b-2 border-accent">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-white rounded-lg shadow-md flex items-center justify-center overflow-hidden">
                                <img src="{{ asset('images/logo_bwi.png') }}" 
                                     alt="Logo SITARU" 
                                     class="w-6 h-8 object-contain">
                            </div>
                            <div class="flex flex-col">
                                <h1 class="text-2xl font-bold text-primary font-heading">SITARU</h1>
                                <p class="text-xs text-gray-600 font-body -mt-1">Sistem Informasi Tata Ruang</p>
                            </div>
                        </div>
                        <div class="ml-3 w-1 h-6 bg-gradient-to-b from-primary to-accent"></div>
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-10 flex items-baseline space-x-4">
                            <a href="#beranda" class="text-gray-700 hover:text-primary px-3 py-2 rounded-md text-sm font-medium transition-colors">Beranda</a>
                            <a href="#layanan" class="text-gray-700 hover:text-primary px-3 py-2 rounded-md text-sm font-medium transition-colors">Layanan</a>
                            <a href="#tentang" class="text-gray-700 hover:text-primary px-3 py-2 rounded-md text-sm font-medium transition-colors">Tentang</a>
                            <a href="#kontak" class="text-gray-700 hover:text-primary px-3 py-2 rounded-md text-sm font-medium transition-colors">Kontak</a>
                        </div>
                        </div>
                    <div class="flex items-center space-x-4">
                        @if (Route::has('login'))
                                @auth
                                <a href="{{ url('/dashboard') }}" class="btn-primary text-white px-6 py-2 rounded-lg font-medium">Dashboard</a>
                                @else
                                <a href="{{ route('login') }}" class="text-gray-700 hover:text-primary px-3 py-2 rounded-md text-sm font-medium transition-colors">Masuk</a>
                                    @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn-primary text-white px-6 py-2 rounded-lg font-medium">Daftar</a>
                                    @endif
                                @endauth
                        @endif
                    </div>
                </div>
            </div>
                            </nav>

        <!-- Hero Section -->
        <section id="beranda" class="hero-bg pt-20 pb-16 min-h-screen flex items-center relative">
            <div class="absolute inset-0 bg-gradient-to-r from-primary/20 to-transparent"></div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="text-center">
                    <div class="inline-block mb-6">
                        <div class="w-16 h-1 bg-gradient-to-r from-accent to-primary mx-auto mb-4"></div>
                        <h1 class="text-4xl md:text-6xl font-bold text-white mb-4 font-heading">
                            Selamat Datang di <span class="text-[#DAAF49] relative">
                                SITARU 
                                <div class="absolute -bottom-2 left-0 right-0 h-1 bg-gradient-to-r from-accent to-transparent"></div>
                            </span>
                        </h1>
                    </div>
                    <p class="text-xl text-gray-100 mb-8 max-w-3xl mx-auto font-body leading-relaxed">
                        <span class="text-[#DAAF49] font-semibold">Sistem Informasi Penataan Ruang</span> Kabupaten Banyuwangi</p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                        <!-- Button 1: Mulai Sekarang -->
                        <a href="{{ route('login') }}" class="group btn-primary text-white px-10 py-4 rounded-xl font-bold text-lg shadow-2xl relative overflow-hidden transform hover:scale-105 transition-all duration-300">
                            <span class="relative z-10 flex items-center justify-center">
                                <i class="fas fa-rocket mr-2 group-hover:animate-bounce"></i>
                                Mulai Sekarang
                            </span>
                            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent transform -translate-x-full group-hover:translate-x-full transition-transform duration-700"></div>
                        </a>
                        
                        <!-- Button 2: Cek Status KKPR -->
                        <a href="{{ route('cek-status.index') }}" class="group relative bg-gradient-to-r from-[#DAAF49] to-[#d4a030] text-[#155D4F] px-10 py-4 rounded-xl font-bold text-lg shadow-2xl border-2 border-[#DAAF49] transform hover:scale-105 transition-all duration-300 overflow-hidden">
                            <span class="relative z-10 flex items-center justify-center">
                                <i class="fas fa-search mr-2 group-hover:rotate-90 transition-transform duration-300"></i>
                                Cek Status Surat
                            </span>
                            <div class="absolute inset-0 bg-white/20 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></div>
                        </a>
                        
                        <!-- Button 3: Lihat Layanan -->
                        <a href="#layanan" class="group bg-white/10 backdrop-blur-md text-white px-10 py-4 rounded-xl font-bold text-lg shadow-2xl border-2 border-white/30 hover:bg-white hover:text-[#155D4F] transform hover:scale-105 transition-all duration-300 relative overflow-hidden">
                            <span class="relative z-10 flex items-center justify-center">
                                <i class="fas fa-th-large mr-2 group-hover:rotate-180 transition-transform duration-500"></i>
                                Lihat Layanan
                            </span>
                            <div class="absolute inset-0 bg-gradient-to-br from-white/0 to-white/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section id="layanan" class="py-20 section-accent relative">
            <div class="absolute inset-0 traditional-pattern opacity-30"></div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="text-center mb-20">
                    <div class="inline-block mb-6">
                        <div class="w-20 h-1 bg-gradient-to-r from-primary to-accent mx-auto mb-4"></div>
                        <h2 class="text-3xl md:text-4xl font-bold text-primary mb-4 font-heading">Layanan Unggulan Kami</h2>
                        <div class="w-16 h-1 bg-gradient-to-r from-accent to-primary mx-auto"></div>
                    </div>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto font-body">Akses berbagai layanan digital dengan mudah dan aman melalui platform terintegrasi</p>
                </div>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="feature-card bg-white p-8 rounded-xl card-shadow">
                        <div class="w-16 h-16 bg-gradient-to-br from-primary to-accent rounded-lg flex items-center justify-center mb-6 relative">
                            <div class="absolute inset-0 bg-gradient-to-br from-accent/20 to-transparent rounded-lg"></div>
                            <svg class="w-8 h-8 text-[#DAAF49] relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-primary mb-4 font-heading">Penilaian KKPR Terbit Otomatis dan Persetujuan Bagi UMK</h3>
                        <p class="text-gray-600 mb-4 font-body">Validasikan kesesuaian kegiatan penataan ruang terbit otomatis dan persetujuan bagi UMK anda</p>
                        <a href="/layanan/kkpr" class="text-primary font-medium hover:text-accent transition-colors relative group">
                            Akses Layanan 
                            <span class="inline-block transform group-hover:translate-x-1 transition-transform">→</span>
                        </a>
                    </div>

                    <div class="feature-card bg-white p-8 rounded-xl card-shadow">
                        <div class="w-16 h-16 bg-gradient-to-br from-primary to-accent rounded-lg flex items-center justify-center mb-6 relative">
                            <div class="absolute inset-0 bg-gradient-to-br from-accent/20 to-transparent rounded-lg"></div>
                            <svg class="w-8 h-8 text-[#DAAF49] relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-primary mb-4 font-heading">Peta Bhumi ATR</h3>
                        <p class="text-gray-600 mb-4 font-body">Akses peta bumi dan informasi geospasial dari Badan Pertanahan Nasional untuk referensi data tanah.</p>
                        <a href="https://bhumi.atrbpn.go.id/peta" target="_blank" class="text-primary font-medium hover:text-accent transition-colors relative group">
                            Kunjungi Peta 
                            <span class="inline-block transform group-hover:translate-x-1 transition-transform">→</span>
                        </a>
                    </div>

                    <div class="feature-card bg-white p-8 rounded-xl card-shadow">
                        <div class="w-16 h-16 bg-gradient-to-br from-primary to-accent rounded-lg flex items-center justify-center mb-6 relative">
                            <div class="absolute inset-0 bg-gradient-to-br from-accent/20 to-transparent rounded-lg"></div>
                            <svg class="w-8 h-8 text-[#DAAF49] relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-primary mb-4 font-heading">Peta Tata Ruang</h3>
                        <p class="text-gray-600 mb-4 font-body">Visualisasi peta tata ruang wilayah untuk perencanaan dan pengembangan kawasan yang terintegrasi.</p>
                        <a href="{{ url('/peta') }}" class="text-primary font-medium hover:text-accent transition-colors relative group">
                            Lihat Peta 
                            <span class="inline-block transform group-hover:translate-x-1 transition-transform">→</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- About Section -->
        <section id="tentang" class="py-20 bg-white relative overflow-hidden">
            <div class="absolute inset-0 traditional-pattern opacity-20"></div>
            <!-- Decorative Background Elements -->
            <div class="absolute top-20 right-10 w-72 h-72 bg-[#155D4F]/5 rounded-full blur-3xl"></div>
            <div class="absolute bottom-20 left-10 w-96 h-96 bg-[#DAAF49]/5 rounded-full blur-3xl"></div>
            
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <!-- Section Header -->
                <div class="text-center mb-16">
                    <div class="inline-block mb-6">
                        <div class="w-20 h-1 bg-gradient-to-r from-[#155D4F] to-[#DAAF49] mx-auto mb-4"></div>
                        <h2 class="text-3xl md:text-5xl font-bold text-[#155D4F] mb-4 font-heading">Tentang SITARU</h2>
                        <div class="w-16 h-1 bg-gradient-to-r from-[#DAAF49] to-[#155D4F] mx-auto"></div>
                    </div>
                    <p class="text-lg text-gray-600 max-w-3xl mx-auto font-body">Sistem Informasi Penataan Ruang</p>
                    <br><br>
                </div>

                <div class="grid lg:grid-cols-2 gap-12 items-start mb-16">
                    <!-- Left Column: Description -->
                    <div class="space-y-6">
                        <div class="relative overflow-hidden bg-gradient-to-br from-[#155D4F]/5 to-[#DAAF49]/5 rounded-2xl p-8 border border-[#DAAF49]/20 shadow-lg h-full">
                            <div class="absolute top-0 left-0 w-24 h-24 bg-[#155D4F]/10 rounded-full -translate-y-12 -translate-x-12"></div>
                            <div class="absolute bottom-0 right-0 w-32 h-32 bg-[#DAAF49]/10 rounded-full translate-y-16 translate-x-16"></div>
                            
                            <div class="relative z-10 text-center">
                                <div class="w-24 h-24 bg-gradient-to-br from-[#155D4F] to-[#0F3D26] rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-xl">
                                    <i class="fa fa-info-circle text-white text-4xl"></i>
                                </div>
                                <h3 class="text-2xl font-bold text-[#155D4F] mb-4 font-heading">Apa itu SITARU ?</h3>
                                <p class="text-gray-600 font-body leading-relaxed mb-8">
                                    <span class="text-[#155D4F] font-semibold">SITARU </span> adalah platform digital yang dirancang khusus untuk memudahkan akses berbagai informasi penataan ruang serta layanan penilaian kesesuaian kegiatan pemanfaatan ruang di Kabupaten Banyuwangi.
                                </p>
                                
                                <!-- Info Stats -->
                                <div class="grid grid-cols-2 gap-4 mt-6">
                                    <div class="bg-white/60 backdrop-blur-sm rounded-xl p-4 border border-[#155D4F]/20">
                                        <i class="fa fa-map-marked-alt text-[#155D4F] text-2xl mb-2"></i>
                                        <p class="text-xs text-gray-700 font-semibold">Banyuwangi</p>
                                    </div>
                                    <div class="bg-white/60 backdrop-blur-sm rounded-xl p-4 border border-[#DAAF49]/20">
                                        <i class="fa fa-globe text-[#DAAF49] text-2xl mb-2"></i>
                                        <p class="text-xs text-gray-700 font-semibold">Digital</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gradient-to-br from-[#DAAF49]/5 to-[#155D4F]/5 rounded-2xl p-8 border border-[#155D4F]/20 shadow-lg">
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-[#DAAF49] to-[#d4a030] rounded-xl flex items-center justify-center shadow-lg flex-shrink-0">
                                    <i class="fa fa-bullseye text-white text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-[#155D4F] mb-2 font-heading">Tujuan Kami</h3>
                                    <p class="text-gray-600 font-body leading-relaxed">
                                        Memberikan layanan publik yang cepat, transparan, dan efisien dengan memanfaatkan teknologi terkini untuk mendukung pembangunan berkelanjutan di Kabupaten Banyuwangi.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Feature List -->
                        <div class="grid grid-cols-2 gap-4">
                            <div class="flex items-center space-x-3 bg-white rounded-lg p-4 border border-gray-200 hover:border-[#155D4F] hover:shadow-md transition-all duration-300">
                                <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-lg flex items-center justify-center shadow-md">
                                    <i class="fa fa-check text-white"></i>
                                </div>
                                <span class="text-sm font-semibold text-gray-700">Mudah Digunakan</span>
                            </div>
                            <div class="flex items-center space-x-3 bg-white rounded-lg p-4 border border-gray-200 hover:border-[#155D4F] hover:shadow-md transition-all duration-300">
                                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center shadow-md">
                                    <i class="fa fa-shield-alt text-white"></i>
                                </div>
                                <span class="text-sm font-semibold text-gray-700">Aman & Terpercaya</span>
                            </div>
                            <div class="flex items-center space-x-3 bg-white rounded-lg p-4 border border-gray-200 hover:border-[#155D4F] hover:shadow-md transition-all duration-300">
                                <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg flex items-center justify-center shadow-md">
                                    <i class="fa fa-bolt text-white"></i>
                                </div>
                                <span class="text-sm font-semibold text-gray-700">Proses Cepat</span>
                            </div>
                            <div class="flex items-center space-x-3 bg-white rounded-lg p-4 border border-gray-200 hover:border-[#155D4F] hover:shadow-md transition-all duration-300">
                                <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg flex items-center justify-center shadow-md">
                                    <i class="fa fa-headset text-white"></i>
                                </div>
                                <span class="text-sm font-semibold text-gray-700">Support 24/7</span>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Stats & Visual -->
                    <div class="space-y-6">
                        <!-- Main Visual Card -->
                        <div class="relative overflow-hidden bg-gradient-to-br from-[#155D4F] via-[#0F3D26] to-[#155D4F] rounded-2xl p-8 shadow-2xl">
                            <div class="absolute inset-0 traditional-pattern opacity-10"></div>
                            <div class="absolute top-0 right-0 w-32 h-32 bg-[#DAAF49]/20 rounded-full -translate-y-16 translate-x-16"></div>
                            <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/10 rounded-full translate-y-12 -translate-x-12"></div>
                            
                            <div class="relative z-10 text-center text-white">
                                <div class="w-24 h-24 bg-white/10 backdrop-blur-md rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-xl">
                                    <i class="fa fa-map-marked-alt text-4xl text-[#DAAF49]"></i>
                                </div>
                                <h3 class="text-2xl font-bold mb-4 font-heading">Informasi Penataan Ruang</h3>
                                <p class="text-white/90 mb-8 leading-relaxed">Informasi penataan ruang yang efektif dan efisien</p>
                                
                                <!-- Mini Stats -->
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20">
                                        <div class="flex items-center justify-center space-x-2 mb-2">
                                            <i class="fa fa-clock text-[#DAAF49] text-xl"></i>
                                            <span class="text-3xl font-bold">24/7</span>
                                        </div>
                                        <p class="text-xs text-white/80">Akses Kapan Saja</p>
                                    </div>
                                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20">
                                        <div class="flex items-center justify-center space-x-2 mb-2">
                                            <i class="fa fa-users text-[#DAAF49] text-xl"></i>
                                            <span class="text-3xl font-bold">1K+</span>
                                        </div>
                                        <p class="text-xs text-white/80">Pengguna Aktif</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Stats Grid -->
                        <div class="grid grid-cols-3 gap-4">
                            <div class="group bg-white rounded-xl p-6 border-2 border-gray-100 hover:border-[#155D4F] shadow-md hover:shadow-xl transition-all duration-300 text-center">
                                <div class="w-14 h-14 bg-gradient-to-br from-[#155D4F] to-[#0F3D26] rounded-xl flex items-center justify-center mx-auto mb-3 shadow-lg group-hover:scale-110 transition-transform">
                                    <i class="fa fa-file-alt text-white text-2xl"></i>
                                </div>
                                <div class="text-3xl font-bold text-[#155D4F] mb-1 font-heading">500+</div>
                                <div class="text-xs text-gray-600 font-body">Dokumen Diproses</div>
                            </div>

                            <div class="group bg-white rounded-xl p-6 border-2 border-gray-100 hover:border-[#DAAF49] shadow-md hover:shadow-xl transition-all duration-300 text-center">
                                <div class="w-14 h-14 bg-gradient-to-br from-[#DAAF49] to-[#d4a030] rounded-xl flex items-center justify-center mx-auto mb-3 shadow-lg group-hover:scale-110 transition-transform">
                                    <i class="fa fa-chart-line text-white text-2xl"></i>
                                </div>
                                <div class="text-3xl font-bold text-[#DAAF49] mb-1 font-heading">99%</div>
                                <div class="text-xs text-gray-600 font-body">Kepuasan User</div>
                            </div>

                            <div class="group bg-white rounded-xl p-6 border-2 border-gray-100 hover:border-green-500 shadow-md hover:shadow-xl transition-all duration-300 text-center">
                                <div class="w-14 h-14 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center mx-auto mb-3 shadow-lg group-hover:scale-110 transition-transform">
                                    <i class="fa fa-thumbs-up text-white text-2xl"></i>
                                </div>
                                <div class="text-3xl font-bold text-green-600 mb-1 font-heading">100%</div>
                                <div class="text-xs text-gray-600 font-body">Digital</div>
                            </div>
                        </div>
                    </div>
                </div>
                <br><br>

                <!-- Bottom Stats Grid -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    <div class="group text-center p-6 bg-gradient-to-br from-[#155D4F]/5 to-white rounded-xl border-2 border-[#155D4F]/20 hover:border-[#155D4F] shadow-md hover:shadow-xl transition-all duration-300">
                        <div class="w-16 h-16 bg-gradient-to-br from-[#155D4F] to-[#0F3D26] rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:rotate-12 transition-transform">
                            <i class="fa fa-users text-white text-2xl"></i>
                        </div>
                        <div class="text-4xl font-bold text-[#155D4F] mb-2 font-heading">1000+</div>
                        <div class="text-sm text-gray-600 font-body font-semibold">Pengguna Terdaftar</div>
                    </div>

                    <div class="group text-center p-6 bg-gradient-to-br from-[#DAAF49]/5 to-white rounded-xl border-2 border-[#DAAF49]/20 hover:border-[#DAAF49] shadow-md hover:shadow-xl transition-all duration-300">
                        <div class="w-16 h-16 bg-gradient-to-br from-[#DAAF49] to-[#d4a030] rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:rotate-12 transition-transform">
                            <i class="fa fa-server text-white text-2xl"></i>
                        </div>
                        <div class="text-4xl font-bold text-[#DAAF49] mb-2 font-heading">99.9%</div>
                        <div class="text-sm text-gray-600 font-body font-semibold">Uptime Server</div>
                    </div>

                    <div class="group text-center p-6 bg-gradient-to-br from-green-500/5 to-white rounded-xl border-2 border-green-500/20 hover:border-green-500 shadow-md hover:shadow-xl transition-all duration-300">
                        <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:rotate-12 transition-transform">
                            <i class="fa fa-map-marked-alt text-white text-2xl"></i>
                        </div>
                        <div class="text-4xl font-bold text-green-600 mb-2 font-heading">25</div>
                        <div class="text-sm text-gray-600 font-body font-semibold">Kecamatan Terintegrasi</div>
                    </div>

                    <div class="group text-center p-6 bg-gradient-to-br from-blue-500/5 to-white rounded-xl border-2 border-blue-500/20 hover:border-blue-500 shadow-md hover:shadow-xl transition-all duration-300">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:rotate-12 transition-transform">
                            <i class="fa fa-clock text-white text-2xl"></i>
                        </div>
                        <div class="text-4xl font-bold text-blue-600 mb-2 font-heading">24/7</div>
                        <div class="text-sm text-gray-600 font-body font-semibold">Layanan Aktif</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Berita Section -->
        @if(isset($berita) && $berita && $berita->count() > 0)
        <section class="py-20 bg-white relative overflow-hidden">
            <div class="absolute inset-0 traditional-pattern opacity-10"></div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <!-- Header -->
                <div class="text-center mb-16">
                    <div class="inline-block mb-6">
                        <div class="w-20 h-1 bg-gradient-to-r from-primary to-accent mx-auto mb-4"></div>
                        <h2 class="text-3xl md:text-4xl font-bold text-primary mb-4 font-heading">Berita Terkini</h2>
                        <div class="w-16 h-1 bg-gradient-to-r from-accent to-primary mx-auto"></div>
                    </div>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto font-body">Informasi dan berita terbaru seputar penataan ruang</p>
                </div>

                 <!-- Swiper Carousel -->
                 <div class="swiper beritaSwiper">
                     <div class="swiper-wrapper">
                         @foreach($berita as $item)
                         <div class="swiper-slide">
                             <article class="group bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 h-full">
                                 <!-- Image -->
                                 <div class="relative overflow-hidden h-48 w-full">
                                     <img src="{{ asset('uploads/images/berita/' . $item->photo) }}" 
                                         alt="{{ $item->nama }}" 
                                         class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'; this.onerror=null;">
                                     <div class="absolute inset-0 w-full h-full bg-gray-200 flex items-center justify-center text-gray-400 text-xs" style="display: none;">
                                         Image Not Found
                                     </div>
                                     <div class="absolute top-4 left-4">
                                         <span class="inline-block bg-primary text-white px-3 py-1 rounded-lg text-xs font-medium">
                                             Berita
                                         </span>
                                     </div>
                                 </div>
                                 
                                 <!-- Content -->
                                 <div class="p-6">
                                     <!-- Date -->
                                     <div class="flex items-center text-sm text-gray-500 mb-3">
                                         <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                         </svg>
                                         {{ $item->created_at->format('d M Y') }}
                                     </div>

                                     <!-- Title -->
                                     <h3 class="text-lg font-semibold text-gray-900 mb-3 line-clamp-2 group-hover:text-primary transition-colors leading-snug">
                                         {{ $item->nama }}
                                     </h3>

                                     <!-- Description -->
                                     <p class="text-gray-600 text-sm leading-relaxed mb-4 line-clamp-3">
                                         {{ Str::limit(strip_tags($item->deskripsi), 120) }}
                                     </p>
                                     
                                     <!-- Footer -->
                                     <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                         <div class="flex items-center text-sm text-gray-500">
                                             <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                             </svg>
                                             {{ $item->dilihat ?? 0 }}
                                         </div>
                                         
                                         <a href="#" class="inline-flex items-center text-primary font-medium text-sm hover:gap-2 gap-1 transition-all">
                                             Selengkapnya
                                             <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                             </svg>
                                         </a>
                                     </div>
                                 </div>
                             </article>
                         </div>
                         @endforeach
                     </div>
                     
                     <!-- Navigation -->
                     <div class="swiper-button-next berita-next"></div>
                     <div class="swiper-button-prev berita-prev"></div>
                     
                     <!-- Pagination -->
                     <div class="swiper-pagination berita-pagination"></div>
                 </div>

                <!-- View All Button -->
                {{-- <div class="text-center mt-12">
                    <a href="#" class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-primary to-accent text-white font-medium rounded-lg hover:shadow-lg transition-all duration-300">
                        Lihat Semua Berita
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div> --}}
            </div>
        </section>
        @endif

        <!-- Informasi Section -->
        @if(isset($informasi) && $informasi && $informasi->count() > 0)
        <section class="py-20 section-accent relative">
            <div class="absolute inset-0 traditional-pattern opacity-20"></div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <!-- Header -->
                <div class="text-center mb-16">
                    <div class="inline-block mb-6">
                        <div class="w-20 h-1 bg-gradient-to-r from-primary to-accent mx-auto mb-4"></div>
                        <h2 class="text-3xl md:text-4xl font-bold text-primary mb-4 font-heading">Informasi Penting</h2>
                        <div class="w-16 h-1 bg-gradient-to-r from-accent to-primary mx-auto"></div>
                    </div>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto font-body">Informasi penting dan pengumuman terkini</p>
                </div>

                 <!-- Swiper Carousel -->
                 <div class="swiper informasiSwiper">
                     <div class="swiper-wrapper">
                         @foreach($informasi as $item)
                         <div class="swiper-slide">
                             <article class="group bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 h-full">
                                 <!-- Image -->
                                 <div class="relative overflow-hidden h-48 w-full">
                                     <img src="{{ asset('uploads/images/informasi/' . $item->photo) }}" 
                                         alt="{{ $item->nama }}" 
                                         class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'; this.onerror=null;">
                                     <div class="absolute inset-0 w-full h-full bg-gray-200 flex items-center justify-center text-gray-400 text-xs" style="display: none;">
                                         Image Not Found
                                     </div>
                                     <div class="absolute top-4 left-4">
                                         <span class="inline-block bg-gradient-to-r from-blue-500 to-blue-600 text-white px-3 py-1 rounded-lg text-xs font-medium shadow-lg">
                                             Informasi
                                         </span>
                                     </div>
                                 </div>
                                 
                                 <!-- Content -->
                                 <div class="p-6">
                                     <!-- Date -->
                                     <div class="flex items-center text-sm text-gray-500 mb-3">
                                         <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                         </svg>
                                         {{ $item->created_at->format('d M Y') }}
                                     </div>

                                     <!-- Title -->
                                     <h3 class="text-lg font-semibold text-gray-900 mb-3 line-clamp-2 group-hover:text-accent transition-colors leading-snug">
                                         {{ $item->nama }}
                                     </h3>

                                     <!-- Description -->
                                     <p class="text-gray-600 text-sm leading-relaxed mb-4 line-clamp-3">
                                         {{ Str::limit(strip_tags($item->deskripsi), 120) }}
                                     </p>
                                     
                                     <!-- Footer -->
                                     <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                         <div class="flex items-center text-sm text-gray-500">
                                             <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                             </svg>
                                             {{ $item->dilihat ?? 0 }}
                                         </div>
                                         
                                         <a href="#" class="inline-flex items-center text-accent font-medium text-sm hover:gap-2 gap-1 transition-all">
                                             Selengkapnya
                                             <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                             </svg>
                                         </a>
                                     </div>
                                 </div>
                             </article>
                         </div>
                         @endforeach
                     </div>
                     
                     <!-- Navigation -->
                     <div class="swiper-button-next informasi-next"></div>
                     <div class="swiper-button-prev informasi-prev"></div>
                     
                     <!-- Pagination -->
                     <div class="swiper-pagination informasi-pagination"></div>
                 </div>

                <!-- View All Button -->
                {{-- <div class="text-center mt-12">
                    <a href="#" class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-accent to-primary text-white font-medium rounded-lg hover:shadow-lg transition-all duration-300">
                        Lihat Semua Informasi
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div> --}}
            </div>
        </section>
         @endif

         <!-- Contact Section -->
         <section id="kontak" class="py-20 section-accent relative">
             <div class="absolute inset-0 traditional-pattern opacity-30"></div>
             <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                 <!-- Header -->
                 <div class="text-center mb-16">
                     <div class="inline-block mb-6">
                         <div class="w-20 h-1 bg-gradient-to-r from-primary to-accent mx-auto mb-4"></div>
                         <h2 class="text-3xl md:text-4xl font-bold text-primary mb-4 font-heading">Hubungi Kami</h2>
                         <div class="w-16 h-1 bg-gradient-to-r from-accent to-primary mx-auto"></div>
                     </div>
                     <p class="text-lg text-gray-600 font-body">Ada pertanyaan? Tim support kami siap membantu Anda</p>
                 </div>
                 <br>

                 <!-- Main Layout -->
                 <div class="grid lg:grid-cols-3 gap-8">
                     
                     <!-- Contact Info Cards -->
                     <div class="space-y-6">
                         <!-- Email -->
                         <div class="bg-white rounded-xl p-6 card-shadow border border-accent hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                             <div class="flex items-center gap-4 mb-3">
                                 <div class="w-12 h-12 bg-gradient-to-br from-primary to-accent rounded-lg flex items-center justify-center shadow-md flex-shrink-0">
                                     <svg class="w-6 h-6 text-[#DAAF49]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                     </svg>
                                 </div>
                                 <h3 class="text-lg font-semibold text-primary font-heading">Email</h3>
                             </div>
                             <p class="text-gray-600 font-body text-sm ml-16">{{ $settings->email ?? 'info@sitaru.com' }}</p>
                         </div>

                         <!-- Phone -->
                         <div class="bg-white rounded-xl p-6 card-shadow border border-accent hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                             <div class="flex items-center gap-4 mb-3">
                                 <div class="w-12 h-12 bg-gradient-to-br from-primary to-accent rounded-lg flex items-center justify-center shadow-md flex-shrink-0">
                                     <svg class="w-6 h-6 text-[#DAAF49]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                     </svg>
                                 </div>
                                 <h3 class="text-lg font-semibold text-primary font-heading">Telepon</h3>
                             </div>
                             <p class="text-gray-600 font-body text-sm ml-16">{{ $settings->phone ?? '(021) 1234-5678' }}</p>
                         </div>

                         <!-- Address -->
                         <div class="bg-white rounded-xl p-6 card-shadow border border-accent hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                             <div class="flex items-center gap-4 mb-3">
                                 <div class="w-12 h-12 bg-gradient-to-br from-primary to-accent rounded-lg flex items-center justify-center shadow-md flex-shrink-0">
                                     <svg class="w-6 h-6 text-[#DAAF49]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                     </svg>
                                 </div>
                                 <h3 class="text-lg font-semibold text-primary font-heading">Alamat</h3>
                             </div>
                             <div class="text-gray-600 font-body text-sm ml-16 space-y-1">
                                 <p>{{ $settings->address ?? 'Jakarta, Indonesia' }}</p>
                                 @if($settings->kelurahan)
                                     <p>{{ $settings->kelurahan }}</p>
                                 @endif
                                 @if($settings->kecamatan)
                                     <p>{{ $settings->kecamatan }}</p>
                                 @endif
                                 @if($settings->kabupaten)
                                     <p>{{ $settings->kabupaten }}</p>
                                 @endif
                                 @if($settings->poscode)
                                     <p class="font-semibold text-primary mt-2">Kode Pos: {{ $settings->poscode }}</p>
                                 @endif
                             </div>
                         </div>
                     </div>

                     <!-- Map Section -->
                     <div class="lg:col-span-2">
                         <div class="bg-white rounded-xl p-6 card-shadow border border-accent h-full">
                             <div class="flex items-center gap-4 mb-6">
                                 <div class="w-12 h-12 bg-gradient-to-br from-primary to-accent rounded-lg flex items-center justify-center shadow-md flex-shrink-0">
                                     <svg class="w-6 h-6 text-[#DAAF49]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                                     </svg>
                                 </div>
                                 <div>
                                     <h3 class="text-xl font-bold text-primary font-heading">Lokasi Kami</h3>
                                     <p class="text-sm text-gray-600 font-body">Temukan kami di peta interaktif</p>
                                 </div>
                            </div>

                            @if(isset($settings) && $settings && $settings->lat && $settings->lang)
                                <!-- Map -->
                                <div id="contactMap" class="w-full h-80 rounded-lg border-2 border-gray-200 mb-6"></div>

                                 <!-- Coordinates -->
                                 <div class="bg-gradient-to-r from-gray-50 to-gray-100 rounded-lg p-5">
                                     <div class="grid md:grid-cols-2 gap-4">
                                         <div class="flex items-center gap-3">
                                             <div class="w-3 h-3 bg-green-500 rounded-full shadow-lg flex-shrink-0"></div>
                                             <div class="flex items-center gap-2">
                                                 <span class="font-semibold text-gray-700 font-body text-sm">Latitude:</span>
                                                 <span class="font-mono text-gray-600 text-sm">{{ $settings->lat }}</span>
                                             </div>
                                         </div>
                                         <div class="flex items-center gap-3">
                                             <div class="w-3 h-3 bg-blue-500 rounded-full shadow-lg flex-shrink-0"></div>
                                             <div class="flex items-center gap-2">
                                                 <span class="font-semibold text-gray-700 font-body text-sm">Longitude:</span>
                                                 <span class="font-mono text-gray-600 text-sm">{{ $settings->lang }}</span>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             @else
                                 <div class="h-80 bg-gray-100 rounded-lg flex items-center justify-center border-2 border-gray-200">
                                     <div class="text-center text-gray-500">
                                         <svg class="w-16 h-16 mx-auto mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                                         </svg>
                                         <p class="text-sm font-medium">Koordinat tidak tersedia</p>
                                         <p class="text-xs text-gray-400 mt-1">Silakan tambahkan koordinat di pengaturan</p>
                                     </div>
                                 </div>
                             @endif
                         </div>
                     </div>

                 </div>
             </div>
         </section>

         <!-- Footer -->
        <footer class="footer-gradient text-white py-20 relative overflow-hidden" style="background: linear-gradient(135deg, #155D4F 0%, #1a6b5c 50%, #DAAF49 100%) !important;">
            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
            <div class="absolute inset-0 traditional-pattern opacity-5"></div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="grid md:grid-cols-4 gap-12">
                    <div class="md:col-span-2">
                        <div class="flex items-center mb-6">
                            <h3 class="text-3xl font-bold font-heading">SITARU </h3>
                            <div class="ml-3 w-16 h-1 bg-gradient-to-r from-white to-[#DAAF49]"></div>
                        </div>
                        <p class="text-white/90 font-body text-lg leading-relaxed mb-6 max-w-md">
                            {!! $settings->footer ?? 'Sistem Informasi Terpadu yang menghubungkan tradisi dengan teknologi modern untuk kemudahan akses layanan digital.' !!}
                        </p>
                        <div class="flex space-x-4">
                            <a href="#" class="w-12 h-12 bg-white/10 backdrop-blur-sm rounded-full flex items-center justify-center hover:bg-[#DAAF49] hover:scale-110 transition-all duration-300 group">
                                <svg class="w-5 h-5 text-white group-hover:text-primary" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                                </svg>
                            </a>
                            <a href="#" class="w-12 h-12 bg-white/10 backdrop-blur-sm rounded-full flex items-center justify-center hover:bg-[#DAAF49] hover:scale-110 transition-all duration-300 group">
                                <svg class="w-5 h-5 text-white group-hover:text-primary" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div>
                        <h4 class="text-xl font-semibold mb-6 font-heading text-[#DAAF49]">Layanan</h4>
                        <ul class="space-y-4">
                            <li><a href="/layanan/kkpr" class="text-white/80 hover:text-white transition-colors relative group font-body">
                                <span class="flex items-center">
                                    <div class="w-2 h-2 bg-[#DAAF49] rounded-full mr-3 group-hover:scale-125 transition-transform"></div>
                                    KKPR
                                </span>
                            </a></li>
                            <li><a href="#" class="text-white/80 hover:text-white transition-colors relative group font-body">
                                <span class="flex items-center">
                                    <div class="w-2 h-2 bg-[#DAAF49] rounded-full mr-3 group-hover:scale-125 transition-transform"></div>
                                    Layanan Lainnya
                                </span>
                            </a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-xl font-semibold mb-6 font-heading text-[#DAAF49]">Dukungan</h4>
                        <ul class="space-y-4">
                            <li><a href="#" class="text-white/80 hover:text-white transition-colors relative group font-body">
                                <span class="flex items-center">
                                    <div class="w-2 h-2 bg-[#DAAF49] rounded-full mr-3 group-hover:scale-125 transition-transform"></div>
                                    Bantuan
                                </span>
                            </a></li>
                            <li><a href="#" class="text-white/80 hover:text-white transition-colors relative group font-body">
                                <span class="flex items-center">
                                    <div class="w-2 h-2 bg-[#DAAF49] rounded-full mr-3 group-hover:scale-125 transition-transform"></div>
                                    FAQ
                                </span>
                            </a></li>
                            <li><a href="#" class="text-white/80 hover:text-white transition-colors relative group font-body">
                                <span class="flex items-center">
                                    <div class="w-2 h-2 bg-[#DAAF49] rounded-full mr-3 group-hover:scale-125 transition-transform"></div>
                                    Kontak
                                </span>
                            </a></li>
                        </ul>
                    </div>
                </div>
                <div class="border-t border-white/20 mt-16 pt-8">
                    <div class="flex flex-col md:flex-row justify-between items-center">
                        <div class="flex items-center mb-4 md:mb-0">
                            <div class="w-8 h-1 bg-gradient-to-r from-[#DAAF49] to-transparent mr-4"></div>
                            <p class="text-white/70 font-body">&copy; 2024 SITARU. All rights reserved.</p>
                        </div>
                        <div class="flex items-center space-x-6 text-white/70 font-body text-sm">
                            <a href="#" class="hover:text-[#DAAF49] transition-colors">Privacy Policy</a>
                            <a href="#" class="hover:text-[#DAAF49] transition-colors">Terms of Service</a>
                            <a href="#" class="hover:text-[#DAAF49] transition-colors">Cookie Policy</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        </div>

         <!-- Leaflet JS -->
         <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
         
         <!-- Swiper JS -->
         <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        
        <script>
            // Wait for Leaflet to be fully loaded
            document.addEventListener('DOMContentLoaded', function() {
                console.log('DOM loaded');
                
                // Check if Leaflet is available
                if (typeof L === 'undefined') {
                    console.error('Leaflet library is not loaded!');
                    return;
                }
                
                console.log('Leaflet loaded successfully', L.version);
                
                // Fix Leaflet default icon paths
                delete L.Icon.Default.prototype._getIconUrl;
                L.Icon.Default.mergeOptions({
                    iconUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon.png',
                    iconRetinaUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon-2x.png',
                    shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
                    iconSize: [25, 41],
                    iconAnchor: [12, 41],
                    popupAnchor: [1, -34],
                    shadowSize: [41, 41]
                });
                
                // Initialize contact map if coordinates are available
                @if(isset($settings) && $settings && $settings->lat && $settings->lang)
                    const mapElement = document.getElementById('contactMap');
                    
                    if (mapElement) {
                        console.log('Initializing map with coordinates:', {{ $settings->lat }}, {{ $settings->lang }});
                        
                        const contactMap = L.map('contactMap', {
                            zoomControl: true,
                            scrollWheelZoom: true
                        }).setView([{{ $settings->lat }}, {{ $settings->lang }}], 15);
                        
                        console.log('Map created:', contactMap);
                        
                        // Add OpenStreetMap tiles
                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                            maxZoom: 19
                        }).addTo(contactMap);
                        
                        console.log('TileLayer added');
                        
                        // Add marker
                        const marker = L.marker([{{ $settings->lat }}, {{ $settings->lang }}]).addTo(contactMap);
                        
                        console.log('Marker added:', marker);
                        
                        // Add popup with address info
                        @php
                            $popupContent = '<div class="p-2">';
                            $popupContent .= '<h4 class="font-semibold text-gray-900 mb-2">Lokasi Kami</h4>';
                            $popupContent .= '<p class="text-sm text-gray-600 mb-2">' . ($settings->address ?? '') . '</p>';
                            if($settings->kecamatan && $settings->kabupaten) {
                                $popupContent .= '<p class="text-sm text-gray-600">' . $settings->kecamatan . ', ' . $settings->kabupaten . '</p>';
                            }
                            $popupContent .= '</div>';
                        @endphp
                        const addressInfo = `{!! addslashes($popupContent) !!}`;
                        
                        console.log('Popup content:', addressInfo);
                        
                        marker.bindPopup(addressInfo).openPopup();
                        
                        console.log('Map initialization complete');
                    } else {
                        console.error('Map container "contactMap" not found!');
                    }
                 @endif
                 
                 // Initialize Berita Swiper
                 const beritaSwiper = new Swiper('.beritaSwiper', {
                     slidesPerView: 1,
                     spaceBetween: 20,
                     loop: true,
                     autoplay: {
                         delay: 5000,
                         disableOnInteraction: false,
                     },
                     pagination: {
                         el: '.berita-pagination',
                         clickable: true,
                     },
                     navigation: {
                         nextEl: '.berita-next',
                         prevEl: '.berita-prev',
                     },
                     breakpoints: {
                         640: {
                             slidesPerView: 2,
                             spaceBetween: 20,
                         },
                         1024: {
                             slidesPerView: 3,
                             spaceBetween: 30,
                         },
                     },
                 });
                 
                 // Initialize Informasi Swiper
                 const informasiSwiper = new Swiper('.informasiSwiper', {
                     slidesPerView: 1,
                     spaceBetween: 20,
                     loop: true,
                     autoplay: {
                         delay: 6000,
                         disableOnInteraction: false,
                     },
                     pagination: {
                         el: '.informasi-pagination',
                         clickable: true,
                     },
                     navigation: {
                         nextEl: '.informasi-next',
                         prevEl: '.informasi-prev',
                     },
                     breakpoints: {
                         640: {
                             slidesPerView: 2,
                             spaceBetween: 20,
                         },
                         1024: {
                             slidesPerView: 3,
                             spaceBetween: 30,
                         },
                     },
                 });
             });
         </script>
    </body>
</html>
