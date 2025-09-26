<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SITARU - Sistem Informasi Terpadu</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&family=poppins:400,500,600,700,800&display=swap" rel="stylesheet" />

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
            </style>
    </head>
<body class="font-body antialiased">
    <div class="min-h-screen gradient-bg traditional-pattern">
        <!-- Navigation -->
        <nav class="bg-white/90 backdrop-blur-md shadow-lg sticky top-0 z-50 border-b-2 border-accent">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center">
                        <h1 class="text-2xl font-bold text-primary font-heading">SITARU</h1>
                        <div class="ml-2 w-1 h-6 bg-gradient-to-b from-primary to-accent"></div>
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
                        <span class="text-[#DAAF49] font-semibold">Sistem Informasi Terpadu</span> yang memudahkan Anda mengakses berbagai layanan digital dengan cepat, aman, dan efisien.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-6 justify-center">
                        <a href="{{ route('login') }}" class="btn-primary text-white px-10 py-4 rounded-lg font-semibold text-lg shadow-xl relative overflow-hidden">
                            <span class="relative z-10">Mulai Sekarang</span>
                        </a>
                        <a href="#layanan" class="bg-transparent text-white px-10 py-4 rounded-lg font-semibold text-lg border-2 border-accent hover:bg-accent hover:text-primary transition-all duration-300 shadow-lg">Lihat Layanan</a>
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
                        <h3 class="text-xl font-semibold text-primary mb-4 font-heading">KKPR</h3>
                        <p class="text-gray-600 mb-4 font-body">Kelengkapan Kependudukan dan Pencatatan Sipil untuk berbagai keperluan administrasi kependudukan.</p>
                        <a href="/layanan/kkpr" class="text-primary font-medium hover:text-accent transition-colors relative group">
                            Akses Layanan 
                            <span class="inline-block transform group-hover:translate-x-1 transition-transform">→</span>
                        </a>
                                        </div>

                    <div class="feature-card bg-white p-8 rounded-xl card-shadow">
                        <div class="w-16 h-16 bg-gradient-to-br from-primary to-accent rounded-lg flex items-center justify-center mb-6 relative">
                            <div class="absolute inset-0 bg-gradient-to-br from-accent/20 to-transparent rounded-lg"></div>
                            <svg class="w-8 h-8 text-[#DAAF49] relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-primary mb-4 font-heading">Keamanan Data</h3>
                        <p class="text-gray-600 mb-4 font-body">Data Anda terlindungi dengan enkripsi tingkat tinggi dan sistem keamanan berlapis.</p>
                        <a href="#" class="text-primary font-medium hover:text-accent transition-colors relative group">
                            Pelajari Lebih Lanjut 
                            <span class="inline-block transform group-hover:translate-x-1 transition-transform">→</span>
                        </a>
                    </div>
                    
                    <div class="feature-card bg-white p-8 rounded-xl card-shadow">
                        <div class="w-16 h-16 bg-gradient-to-br from-primary to-accent rounded-lg flex items-center justify-center mb-6 relative">
                            <div class="absolute inset-0 bg-gradient-to-br from-accent/20 to-transparent rounded-lg"></div>
                            <svg class="w-8 h-8 text-[#DAAF49] relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-primary mb-4 font-heading">Akses Cepat</h3>
                        <p class="text-gray-600 mb-4 font-body">Proses yang cepat dan efisien untuk semua layanan dengan antarmuka yang user-friendly.</p>
                        <a href="#" class="text-primary font-medium hover:text-accent transition-colors relative group">
                            Coba Sekarang 
                            <span class="inline-block transform group-hover:translate-x-1 transition-transform">→</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- About Section -->
        <section id="tentang" class="py-20 bg-white relative">
            <div class="absolute inset-0 traditional-pattern opacity-20"></div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="grid lg:grid-cols-2 gap-16 items-center">
                    <div>
                        <div class="inline-block mb-6">
                            <div class="w-20 h-1 bg-gradient-to-r from-primary to-accent mb-4"></div>
                            <h2 class="text-3xl md:text-4xl font-bold text-primary mb-4 font-heading">Tentang SITARU</h2>
                            <div class="w-16 h-1 bg-gradient-to-r from-accent to-primary"></div>
                        </div>
                        <p class="text-lg text-gray-600 mb-6 font-body leading-relaxed">
                            <span class="text-primary font-semibold">SITARU</span> adalah platform digital terintegrasi yang dirancang khusus untuk memudahkan akses berbagai layanan administrasi kependudukan dan pencatatan sipil.
                        </p>
                        <p class="text-lg text-gray-600 mb-8 font-body leading-relaxed">
                            Dengan teknologi terkini dan antarmuka yang intuitif, kami berkomitmen memberikan pengalaman terbaik untuk semua pengguna.
                        </p>
                        <div class="grid grid-cols-2 gap-8">
                            <div class="text-center p-6 bg-gradient-to-br from-bg-accent to-white rounded-xl border border-accent">
                                <div class="text-4xl font-bold text-primary mb-2 font-heading">1000+</div>
                                <div class="text-gray-600 font-body">Pengguna Aktif</div>
                            </div>
                            <div class="text-center p-6 bg-gradient-to-br from-bg-accent to-white rounded-xl border border-accent">
                                <div class="text-4xl font-bold text-primary mb-2 font-heading">99.9%</div>
                                <div class="text-gray-600 font-body">Uptime</div>
                            </div>
                        </div>
                    </div>
                    <div class="lg:text-right">
                        <div class="bg-white p-8 rounded-xl card-shadow border border-accent relative overflow-hidden">
                            <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-primary to-accent"></div>
                            <div class="w-full h-64 bg-gradient-to-br from-bg-accent to-primary/10 rounded-lg flex items-center justify-center border border-accent relative">
                                <div class="absolute inset-0 traditional-pattern opacity-10"></div>
                                <svg class="w-24 h-24 text-primary relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                                </div>
        </section>

        <!-- Contact Section -->
        <section id="kontak" class="py-20 section-accent relative">
            <div class="absolute inset-0 traditional-pattern opacity-30"></div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="text-center mb-20">
                    <div class="inline-block mb-6">
                        <div class="w-20 h-1 bg-gradient-to-r from-primary to-accent mx-auto mb-4"></div>
                        <h2 class="text-3xl md:text-4xl font-bold text-primary mb-4 font-heading">Hubungi Kami</h2>
                        <div class="w-16 h-1 bg-gradient-to-r from-accent to-primary mx-auto"></div>
                    </div>
                    <p class="text-lg text-gray-600 font-body">Ada pertanyaan? Tim support kami siap membantu Anda</p>
                                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <div class="text-center p-8 bg-white rounded-xl card-shadow border border-accent hover:shadow-xl transition-all duration-300">
                        <div class="w-16 h-16 bg-gradient-to-br from-primary to-accent rounded-lg flex items-center justify-center mx-auto mb-6 relative">
                            <div class="absolute inset-0 bg-gradient-to-br from-accent/20 to-transparent rounded-lg"></div>
                            <svg class="w-8 h-8 text-[#DAAF49] relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-primary mb-2 font-heading">Email</h3>
                        <p class="text-gray-600 font-body">info@sitaru.com</p>
                                </div>

                    <div class="text-center p-8 bg-white rounded-xl card-shadow border border-accent hover:shadow-xl transition-all duration-300">
                        <div class="w-16 h-16 bg-gradient-to-br from-primary to-accent rounded-lg flex items-center justify-center mx-auto mb-6 relative">
                            <div class="absolute inset-0 bg-gradient-to-br from-accent/20 to-transparent rounded-lg"></div>
                            <svg class="w-8 h-8 text-[#DAAF49] relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                                </div>
                        <h3 class="text-lg font-semibold text-primary mb-2 font-heading">Telepon</h3>
                        <p class="text-gray-600 font-body">(021) 1234-5678</p>
                                </div>

                    <div class="text-center p-8 bg-white rounded-xl card-shadow border border-accent hover:shadow-xl transition-all duration-300">
                        <div class="w-16 h-16 bg-gradient-to-br from-primary to-accent rounded-lg flex items-center justify-center mx-auto mb-6 relative">
                            <div class="absolute inset-0 bg-gradient-to-br from-accent/20 to-transparent rounded-lg"></div>
                            <svg class="w-8 h-8 text-[#DAAF49] relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                        <h3 class="text-lg font-semibold text-primary mb-2 font-heading">Alamat</h3>
                        <p class="text-gray-600 font-body">Jakarta, Indonesia</p>
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
                            <h3 class="text-3xl font-bold font-heading">SITARU</h3>
                            <div class="ml-3 w-16 h-1 bg-gradient-to-r from-white to-[#DAAF49]"></div>
                        </div>
                        <p class="text-white/90 font-body text-lg leading-relaxed mb-6 max-w-md">
                            Sistem Informasi Terpadu yang menghubungkan tradisi dengan teknologi modern untuk kemudahan akses layanan digital.
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
    </body>
</html>
