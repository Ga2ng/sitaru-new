<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cek Status KKPR - SITARU</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&family=poppins:400,500,600,700,800&display=swap" rel="stylesheet" />
    
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
                        <a href="{{ url('/') }}" class="text-gray-700 hover:text-primary px-3 py-2 rounded-md text-sm font-medium transition-colors">Beranda</a>
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn-primary text-white px-6 py-2 rounded-lg font-medium">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="text-gray-700 hover:text-primary px-3 py-2 rounded-md text-sm font-medium transition-colors">Masuk</a>
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="hero-bg pt-20 pb-16 min-h-screen flex items-center relative">
            <div class="absolute inset-0 bg-gradient-to-r from-primary/20 to-transparent"></div>
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="text-center mb-12">
                    <div class="inline-block mb-6">
                        <div class="w-16 h-1 bg-gradient-to-r from-accent to-primary mx-auto mb-4"></div>
                        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4 font-heading">
                            Cek Status <span class="text-[#DAAF49] relative">
                                KKPR
                                <div class="absolute -bottom-2 left-0 right-0 h-1 bg-gradient-to-r from-accent to-transparent"></div>
                            </span>
                        </h1>
                    </div>
                    <p class="text-xl text-gray-100 mb-8 max-w-2xl mx-auto font-body leading-relaxed">
                        Masukkan <span class="text-[#DAAF49] font-semibold">Nomor KKPR</span> untuk melihat status dan progress pengajuan Anda
                    </p>
                </div>

                <!-- Search Form -->
                <div class="bg-white/95 backdrop-blur-sm rounded-2xl p-8 shadow-2xl border border-white/20">
                    <form method="POST" action="{{ route('cek-status.search') }}" class="space-y-6">
                        @csrf
                        <div class="text-center mb-6">
                            <div class="w-16 h-16 bg-gradient-to-br from-primary to-accent rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-search text-white text-xl"></i>
                            </div>
                            <h2 class="text-2xl font-bold text-primary font-heading">Cari Status KKPR</h2>
                            <p class="text-gray-600 mt-2">Masukkan nomor KKPR yang ingin Anda cek</p>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <label for="no_kkpr" class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-hashtag mr-2 text-primary"></i>
                                    Nomor KKPR <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="no_kkpr" name="no_kkpr" value="{{ old('no_kkpr') }}" 
                                       class="w-full px-6 py-4 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200 text-lg font-medium" 
                                       placeholder="Masukkan nomor KKPR" required>
                                @error('no_kkpr')
                                    <div class="flex items-center space-x-2 text-red-600 text-sm mt-2">
                                        <i class="fas fa-exclamation-circle text-xs"></i>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>

                            @if(session('error'))
                                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                                    <div class="flex items-center">
                                        <i class="fas fa-exclamation-circle mr-2"></i>
                                        <span>{{ session('error') }}</span>
                                    </div>
                                </div>
                            @endif

                            <div class="text-center">
                                <button type="submit" class="btn-primary text-white px-12 py-4 rounded-xl font-semibold text-lg shadow-xl relative overflow-hidden">
                                    <span class="relative z-10">
                                        <i class="fas fa-search mr-2"></i>
                                        Cek Status
                                    </span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Info Cards -->
                <div class="grid md:grid-cols-3 gap-6 mt-12">
                    <div class="feature-card bg-white/90 backdrop-blur-sm p-6 rounded-xl card-shadow text-center">
                        <div class="w-12 h-12 bg-gradient-to-br from-primary to-accent rounded-lg flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-shield-alt text-white"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-primary mb-2 font-heading">Aman & Terpercaya</h3>
                        <p class="text-gray-600 text-sm font-body">Data Anda terlindungi dengan sistem keamanan terbaik</p>
                    </div>

                    <div class="feature-card bg-white/90 backdrop-blur-sm p-6 rounded-xl card-shadow text-center">
                        <div class="w-12 h-12 bg-gradient-to-br from-primary to-accent rounded-lg flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-clock text-white"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-primary mb-2 font-heading">Real-time</h3>
                        <p class="text-gray-600 text-sm font-body">Informasi status terbaru dan akurat</p>
                    </div>

                    <div class="feature-card bg-white/90 backdrop-blur-sm p-6 rounded-xl card-shadow text-center">
                        <div class="w-12 h-12 bg-gradient-to-br from-primary to-accent rounded-lg flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-mobile-alt text-white"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-primary mb-2 font-heading">Mudah Diakses</h3>
                        <p class="text-gray-600 text-sm font-body">Bisa diakses kapan saja dan di mana saja</p>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>
</html>
