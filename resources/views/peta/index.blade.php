<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SITARU - Peta Tata Ruang Banyuwangi</title>
    <meta name="description" content="Sistem Informasi Tata Ruang Banyuwangi - Peta Interaktif">
    <meta name="keywords" content="Sitaru, Sitaru Banyuwangi, Peta Tata Ruang, SISTEM INFORMASI TATA RUANG BANYUWANGI">
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&family=poppins:400,500,600,700,800&display=swap" rel="stylesheet" />
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- OpenLayers CSS -->
    <link href="https://cdn.jsdelivr.net/npm/openlayers@4.6.5/dist/ol.min.css" rel="stylesheet">
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
        }
        
        .font-heading { 
            font-family: 'Poppins', sans-serif; 
        }
        
        .font-body { 
            font-family: 'Inter', sans-serif; 
        }
        
        /* Layer Control Styling */
        .layer-item {
            transition: all 0.3s ease;
        }

        .layer-item:hover {
            background: #f8f9fa !important;
            transform: translateX(2px);
        }

        .opacity-control {
            margin-top: 8px;
        }

        .opacity-slider {
            height: 6px;
            border-radius: 3px;
            background: #dee2e6;
            outline: none;
            -webkit-appearance: none;
        }

        .opacity-slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: #185B3C;
            cursor: pointer;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }

        .opacity-slider::-moz-range-thumb {
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: #185B3C;
            cursor: pointer;
            border: none;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }

        .form-range::-webkit-slider-track {
            background: linear-gradient(to right, #185B3C 0%, #185B3C 50%, #dee2e6 50%, #dee2e6 100%);
            border-radius: 3px;
        }

        #layers-control {
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .layer-controls {
            max-height: 60vh;
            overflow-y: auto;
        }

        .layer-controls::-webkit-scrollbar {
            width: 6px;
        }

        .layer-controls::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }

        .layer-controls::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 3px;
        }

        .layer-controls::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            #layers-control {
                position: relative !important;
                top: 20px !important;
                right: auto !important;
                margin: 0 auto 20px auto;
                max-width: 100% !important;
                max-height: none !important;
            }
            
            .layer-controls {
                max-height: 40vh;
            }
        }

        /* Animation for layer items */
        .layer-item {
            animation: fadeInUp 0.3s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Hover effects for buttons */
        #resetAllOpacity:hover {
            transform: scale(1.05);
            transition: transform 0.2s ease;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation Bar -->
    <nav class="bg-white/90 backdrop-blur-md shadow-lg fixed w-full top-0 z-50 border-b-2 border-[#DAAF49]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="{{ url('/') }}" class="flex items-center space-x-3 group">
                        <img src="{{ asset('images/maskot.png') }}" alt="Logo" class="h-10 w-auto group-hover:scale-105 transition-transform duration-300">
                        <div>
                            <h1 class="text-2xl font-bold text-[#155D4F] font-heading group-hover:text-[#0F3D26] transition-colors">SITARU</h1>
                            <div class="flex items-center space-x-2">
                                <p class="text-xs text-gray-600 font-body">Sistem Informasi Tata Ruang</p>
                                <div class="w-1 h-4 bg-gradient-to-b from-[#155D4F] to-[#DAAF49] rounded-full"></div>
                            </div>
                        </div>
                    </a>
                </div>
                
                <!-- Desktop Navigation -->
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-6">
                        <a href="{{ url('/') }}" class="text-gray-700 hover:text-[#155D4F] px-3 py-2 rounded-md text-sm font-medium transition-all duration-300 hover:bg-[#E8F5F0] relative group">
                            <i class="fas fa-home mr-2"></i> Beranda
                            <div class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-[#155D4F] to-[#DAAF49] group-hover:w-full transition-all duration-300"></div>
                        </a>
                        <a href="{{ url('/peta') }}" class="text-[#155D4F] bg-[#E8F5F0] px-4 py-2 rounded-lg text-sm font-semibold transition-all duration-300 hover:bg-[#155D4F] hover:text-white relative group shadow-sm">
                            <i class="fas fa-map mr-2"></i> Peta
                            <div class="absolute inset-0 bg-gradient-to-r from-[#155D4F] to-[#0F3D26] rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <span class="relative z-10">Peta</span>
                        </a>
                        <a href="https://bhumi.atrbpn.go.id/peta" target="_blank" class="text-gray-700 hover:text-[#155D4F] px-3 py-2 rounded-md text-sm font-medium transition-all duration-300 hover:bg-[#E8F5F0] relative group">
                            <i class="fas fa-globe mr-2"></i> Peta Bhumi ATR
                            <div class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-[#155D4F] to-[#DAAF49] group-hover:w-full transition-all duration-300"></div>
                        </a>
                    </div>
                </div>
                
                <!-- Auth Buttons -->
                <div class="flex items-center space-x-3">
                    @if(Auth::check())
                        <a href="{{ url('/dashboard') }}" class="bg-gradient-to-r from-[#155D4F] to-[#0F3D26] text-white px-6 py-2 rounded-lg font-medium hover:shadow-lg hover:scale-105 transition-all duration-300 relative overflow-hidden group">
                            <div class="absolute inset-0 bg-gradient-to-r from-[#DAAF49] to-[#155D4F] opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
                            <i class="fas fa-tachometer-alt mr-2 relative z-10"></i>
                            <span class="relative z-10">Dashboard</span>
                        </a>
                    @else
                        <a href="{{ url('/login') }}" class="text-gray-700 hover:text-[#155D4F] px-3 py-2 rounded-md text-sm font-medium transition-all duration-300 hover:bg-[#E8F5F0] relative group">
                            <i class="fas fa-sign-in-alt mr-2"></i> Masuk
                            <div class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-[#155D4F] to-[#DAAF49] group-hover:w-full transition-all duration-300"></div>
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="bg-gradient-to-r from-[#155D4F] to-[#0F3D26] text-white px-6 py-2 rounded-lg font-medium hover:shadow-lg hover:scale-105 transition-all duration-300 relative overflow-hidden group">
                                <div class="absolute inset-0 bg-gradient-to-r from-[#DAAF49] to-[#155D4F] opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
                                <span class="relative z-10">Daftar</span>
                            </a>
                        @endif
                    @endif
                    
                    <!-- Mobile Menu Button -->
                    <button class="md:hidden p-2 rounded-md text-gray-700 hover:text-[#155D4F] hover:bg-[#E8F5F0] transition-colors" onclick="toggleMobileMenu()">
                        <i class="fas fa-bars text-lg"></i>
                    </button>
                </div>
            </div>
            
            <!-- Mobile Navigation -->
            <div id="mobile-menu" class="md:hidden hidden bg-white/95 backdrop-blur-md border-t border-[#DAAF49] py-4">
                <div class="px-2 space-y-2">
                    <a href="{{ url('/') }}" class="block text-gray-700 hover:text-[#155D4F] px-3 py-2 rounded-md text-sm font-medium transition-colors hover:bg-[#E8F5F0]">
                        <i class="fas fa-home mr-2"></i> Beranda
                    </a>
                    <a href="{{ url('/peta') }}" class="block text-[#155D4F] bg-[#E8F5F0] px-3 py-2 rounded-md text-sm font-semibold">
                        <i class="fas fa-map mr-2"></i> Peta
                    </a>
                    <a href="https://bhumi.atrbpn.go.id/peta" target="_blank" class="block text-gray-700 hover:text-[#155D4F] px-3 py-2 rounded-md text-sm font-medium transition-colors hover:bg-[#E8F5F0]">
                        <i class="fas fa-globe mr-2"></i> Peta Bhumi ATR
                    </a>
                    @if(Auth::check())
                        <a href="{{ url('/dashboard') }}" class="block bg-gradient-to-r from-[#155D4F] to-[#0F3D26] text-white px-3 py-2 rounded-md text-sm font-medium text-center mt-4">
                            <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                        </a>
                    @else
                        <div class="flex space-x-2 mt-4">
                            <a href="{{ url('/login') }}" class="flex-1 text-center text-gray-700 hover:text-[#155D4F] px-3 py-2 rounded-md text-sm font-medium transition-colors hover:bg-[#E8F5F0]">
                                <i class="fas fa-sign-in-alt mr-2"></i> Masuk
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="flex-1 text-center bg-gradient-to-r from-[#155D4F] to-[#0F3D26] text-white px-3 py-2 rounded-md text-sm font-medium">
                                    Daftar
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="pt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-6">
    <!-- Hero Section with Gradient -->
    <div class="relative overflow-hidden bg-gradient-to-br from-[#185B3C] via-[#0F3D26] to-[#185B3C] rounded-xl p-6 text-white">
        <div class="absolute inset-0 bg-black/10"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold mb-1">Peta Tata Ruang</h1>
                    <p class="text-sm text-white/90 mb-4">Eksplorasi peta tata ruang Banyuwangi dengan interaktif dan informatif</p>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                            <span class="text-xs">Sistem Aktif</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-map-marked-alt text-xs"></i>
                            <span class="text-xs">Interactive Map</span>
                        </div>
                    </div>
                </div>
                <div class="hidden lg:block">
                    <div class="w-20 h-20 bg-white/10 rounded-full flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-map text-3xl text-white/80"></i>
                    </div>
                </div>
            </div>
        </div>
        <!-- Decorative Elements -->
        <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -translate-y-16 translate-x-16"></div>
        <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full translate-y-12 -translate-x-12"></div>
    </div>

    <!-- Map Container with Modern Design -->
    <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg border border-white/20 overflow-hidden">
        <!-- Map Header -->
        <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-gradient-to-br from-[#185B3C] to-[#0F3D26] rounded-lg flex items-center justify-center">
                        <i class="fas fa-map-marked-alt text-white text-sm"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Peta Interaktif</h3>
                        <p class="text-sm text-gray-600">Eksplorasi tata ruang Banyuwangi</p>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    <button class="flex items-center px-3 py-2 text-sm text-gray-600 hover:text-gray-900 hover:bg-white/80 rounded-lg transition-colors">
                        <i class="fas fa-expand-arrows-alt mr-1 text-xs"></i>
                        Fullscreen
                    </button>
                    <button class="flex items-center px-3 py-2 text-sm text-gray-600 hover:text-gray-900 hover:bg-white/80 rounded-lg transition-colors">
                        <i class="fas fa-download mr-1 text-xs"></i>
                        Export
                    </button>
                </div>
            </div>
        </div>

        <!-- Map Content -->
        <div class="relative">
            <div id='map' style='width: 100%; height: 75vh;'></div>
            <!-- Loading Overlay -->
            <div id="map-loading-overlay" class="absolute inset-0 z-50 flex items-center justify-center bg-white/90 backdrop-blur-sm">
                <div class="flex flex-col items-center gap-3">
                    <div class="w-10 h-10 rounded-full border-4 border-[#185B3C]/20 border-t-[#185B3C] animate-spin"></div>
                    <div class="text-sm text-gray-700 font-medium">Memuat peta dan data…</div>
                </div>
            </div>
            
            <!-- Layer Control Panel -->
            <div id="layers-control" class="absolute top-4 right-4 bg-white/95 backdrop-blur-sm p-4 rounded-xl shadow-lg border border-white/20 max-w-80 max-h-96 overflow-y-auto">
                <div class="flex justify-between items-center mb-4">
                    <h6 class="font-bold text-gray-900">Layer Control</h6>
                    <button class="btn btn-sm btn-outline-primary" id="resetAllOpacity" title="Reset semua opacity ke 100%">
                        <i class="fas fa-undo text-xs"></i>
                    </button>
                </div>
                
                <!-- Koordinat Search -->
                <div class="mb-4 p-3 bg-gray-50 rounded-lg">
                    <label class="form-label font-semibold text-sm">Cari Koordinat</label>
                    <div class="space-y-2">
                        <input type="text" class="form-control form-control-sm" id="longitude" placeholder="Longitude">
                        <input type="text" class="form-control form-control-sm" id="latitude" placeholder="Latitude">
                        <div class="flex gap-2">
                            <button class="btn btn-primary btn-sm flex-1" id="searchCoordinate">Cari</button>
                            <button class="btn btn-secondary btn-sm flex-1" id="resetMap">Reset</button>
                        </div>
                    </div>
                </div>
                
                <hr class="my-3">
                
                <!-- Layer Controls -->
                <div class="space-y-3">
                    <!-- Batas Kecamatan -->
                    <div class="layer-item p-3 border rounded-lg bg-white/50">
                        <div class="flex justify-between items-center mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="batasKecamatanCheck">
                                <label class="form-check-label font-semibold text-sm" for="batasKecamatanCheck">Batas Kecamatan</label>
                            </div>
                        </div>
                        <div class="opacity-control">
                            <label class="form-label small mb-1">Opacity: <span id="batasKecamatanOpacity">100%</span></label>
                            <input type="range" class="form-range opacity-slider" id="batasKecamatanOpacitySlider" min="0" max="100" value="100">
                        </div>
                    </div>
                    
                    <!-- LSD -->
                    <!-- <div class="layer-item p-3 border rounded-lg bg-white/50">
                        <div class="flex justify-between items-center mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="lsdCheck">
                                <label class="form-check-label font-semibold text-sm" for="lsdCheck">LSD</label>
                            </div>
                        </div>
                        <div class="opacity-control">
                            <label class="form-label small mb-1">Opacity: <span id="lsdOpacity">100%</span></label>
                            <input type="range" class="form-range opacity-slider" id="lsdOpacitySlider" min="0" max="100" value="100">
                        </div>
                    </div> -->
                    
                    <!-- RTRW 2024 -->
                    <div class="layer-item p-3 border rounded-lg bg-white/50">
                        <div class="flex justify-between items-center mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="rtrwCheck">
                                <label class="form-check-label font-semibold text-sm" for="rtrwCheck">RTRW 2024</label>
                            </div>
                        </div>
                        <div class="opacity-control">
                            <label class="form-label small mb-1">Opacity: <span id="rtrwOpacity">100%</span></label>
                            <input type="range" class="form-range opacity-slider" id="rtrwOpacitySlider" min="0" max="100" value="100">
                        </div>
                    </div>
                    
                    <!-- RDTR Glagah-Giri -->
                    <div class="layer-item p-3 border rounded-lg bg-white/50">
                        <div class="flex justify-between items-center mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="rdtrGlagahGiriCheck">
                                <label class="form-check-label font-semibold text-sm" for="rdtrGlagahGiriCheck">RDTR Glagah-Giri</label>
                            </div>
                        </div>
                        <div class="opacity-control">
                            <label class="form-label small mb-1">Opacity: <span id="rdtrGlagahGiriOpacity">100%</span></label>
                            <input type="range" class="form-range opacity-slider" id="rdtrGlagahGiriOpacitySlider" min="0" max="100" value="100">
                        </div>
                    </div>
                    
                    <!-- RDTR Licin -->
                    <div class="layer-item p-3 border rounded-lg bg-white/50">
                        <div class="flex justify-between items-center mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="rdtrLicinCheck">
                                <label class="form-check-label font-semibold text-sm" for="rdtrLicinCheck">RDTR Licin</label>
                            </div>
                        </div>
                        <div class="opacity-control">
                            <label class="form-label small mb-1">Opacity: <span id="rdtrLicinOpacity">100%</span></label>
                            <input type="range" class="form-range opacity-slider" id="rdtrLicinOpacitySlider" min="0" max="100" value="100">
                        </div>
                    </div>
                    
                    <!-- RDTR Kabat -->
                    <div class="layer-item p-3 border rounded-lg bg-white/50">
                        <div class="flex justify-between items-center mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="rdtrKabatCheck">
                                <label class="form-check-label font-semibold text-sm" for="rdtrKabatCheck">RDTR Kabat</label>
                            </div>
                        </div>
                        <div class="opacity-control">
                            <label class="form-label small mb-1">Opacity: <span id="rdtrKabatOpacity">100%</span></label>
                            <input type="range" class="form-range opacity-slider" id="rdtrKabatOpacitySlider" min="0" max="100" value="100">
                        </div>
                    </div>
                    
                    <!-- RDTR Rogojampi -->
                    <div class="layer-item p-3 border rounded-lg bg-white/50">
                        <div class="flex justify-between items-center mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="rdtrRogojampiCheck">
                                <label class="form-check-label font-semibold text-sm" for="rdtrRogojampiCheck">RDTR Rogojampi</label>
                            </div>
                        </div>
                        <div class="opacity-control">
                            <label class="form-label small mb-1">Opacity: <span id="rdtrRogojampiOpacity">100%</span></label>
                            <input type="range" class="form-range opacity-slider" id="rdtrRogojampiOpacitySlider" min="0" max="100" value="100">
                        </div>
                    </div>

                    <!-- RDTR Genteng -->
                    <div class="layer-item p-3 border rounded-lg bg-white/50">
                        <div class="flex justify-between items-center mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="rdtrGentengCheck">
                                <label class="form-check-label font-semibold text-sm" for="rdtrGentengCheck">RDTR Genteng</label>
                            </div>
                        </div>
                        <div class="opacity-control">
                            <label class="form-label small mb-1">Opacity: <span id="rdtrGentengOpacity">100%</span></label>
                            <input type="range" class="form-range opacity-slider" id="rdtrGentengOpacitySlider" min="0" max="100" value="100">
                        </div>
                    </div>

                    <!-- RDTR Singojuruh -->
                    <div class="layer-item p-3 border rounded-lg bg-white/50">
                        <div class="flex justify-between items-center mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="rdtrSingojuruhCheck">
                                <label class="form-check-label font-semibold text-sm" for="rdtrSingojuruhCheck">RDTR Singojuruh</label>
                            </div>
                        </div>
                        <div class="opacity-control">
                            <label class="form-label small mb-1">Opacity: <span id="rdtrSingojuruhOpacity">100%</span></label>
                            <input type="range" class="form-range opacity-slider" id="rdtrSingojuruhOpacitySlider" min="0" max="100" value="100">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Legend Panel -->
            <div id="legend-panel" class="absolute top-4 left-4 bg-white/95 backdrop-blur-sm p-4 rounded-xl shadow-lg border border-white/20 max-w-72 max-h-96 overflow-y-auto">
                <div class="font-bold text-lg text-gray-900 mb-3 flex items-center gap-2">
                    <i class="fas fa-list-ul"></i>
                    Legenda Peta
                </div>
                <div id="legend-content"></div>
            </div>

            <!-- Info Zona Card -->
            <div id="info-zona-container" class="absolute bottom-4 left-1/2 transform -translate-x-1/2 w-full max-w-2xl px-4">
                <div id="info-zona-card" class="hidden bg-white/95 backdrop-blur-sm rounded-xl shadow-lg border border-white/20 overflow-hidden">
                    <!-- Header -->
                    <div id="info-zona-header" class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-3 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span id="info-zona-color" class="w-5 h-5 rounded bg-gray-300"></span>
                            <div>
                                <div id="info-zona-title" class="font-semibold text-base">Informasi Zona</div>
                                <div id="info-zona-layer" class="text-xs opacity-90">-</div>
                            </div>
                        </div>
                        <button id="close-info-zona" class="text-white hover:text-gray-200 transition-colors p-1">
                            <i class="fas fa-times text-lg"></i>
                        </button>
                    </div>
                    <!-- Content -->
                    <div class="p-4">
                        <div class="grid grid-cols-1 gap-4">
                            <div class="bg-white rounded-lg p-3 border-l-4 border-blue-500">
                                <div id="info-zona-namobj"></div>
                            </div>
                            <div class="bg-gray-50 rounded-lg p-3">
                                <div class="font-semibold text-gray-900 mb-2 flex items-center gap-2 text-sm">
                                    <i class="fas fa-info-circle text-blue-500"></i>
                                    Ringkasan Zona
                                </div>
                                <div id="info-zona-namobj-summary"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include OpenLayers JS -->
<script src="https://cdn.jsdelivr.net/npm/openlayers@4.6.5/dist/ol.min.js"></script>

<style>
    /* Layer Control Styling */
    .layer-item {
        transition: all 0.3s ease;
    }

    .layer-item:hover {
        background: #f8f9fa !important;
        transform: translateX(2px);
    }

    .opacity-control {
        margin-top: 8px;
    }

    .opacity-slider {
        height: 6px;
        border-radius: 3px;
        background: #dee2e6;
        outline: none;
        -webkit-appearance: none;
    }

    .opacity-slider::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background: #185B3C;
        cursor: pointer;
        box-shadow: 0 2px 4px rgba(0,0,0,0.2);
    }

    .opacity-slider::-moz-range-thumb {
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background: #185B3C;
        cursor: pointer;
        border: none;
        box-shadow: 0 2px 4px rgba(0,0,0,0.2);
    }

    .form-range::-webkit-slider-track {
        background: linear-gradient(to right, #185B3C 0%, #185B3C 50%, #dee2e6 50%, #dee2e6 100%);
        border-radius: 3px;
    }

    #layers-control {
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .layer-controls {
        max-height: 60vh;
        overflow-y: auto;
    }

    .layer-controls::-webkit-scrollbar {
        width: 6px;
    }

    .layer-controls::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 3px;
    }

    .layer-controls::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 3px;
    }

    .layer-controls::-webkit-scrollbar-thumb:hover {
        background: #a8a8a8;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        #layers-control {
            position: relative !important;
            top: 20px !important;
            right: auto !important;
            margin: 0 auto 20px auto;
            max-width: 100% !important;
            max-height: none !important;
        }
        
        .layer-controls {
            max-height: 40vh;
        }
    }

    /* Animation for layer items */
    .layer-item {
        animation: fadeInUp 0.3s ease-out;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Hover effects for buttons */
    #resetAllOpacity:hover {
        transform: scale(1.05);
        transition: transform 0.2s ease;
    }
</style>

<script>
    // Inisialisasi peta dengan center di Banyuwangi
    // Scheduler untuk memastikan legenda ter-update saat layer dinyalakan
    function scheduleLegendUpdateFor(layer) {
        try {
            if (!layer) return;
            var src = layer.getSource && layer.getSource();
            if (layer.getVisible && layer.getVisible()) {
                if (src && typeof src.getFeatures === 'function' && src.getFeatures().length === 0) {
                    var once = function() {
                        setTimeout(updateLegend, 0);
                        src.un('featuresloadend', once);
                    };
                    src.on('featuresloadend', once);
                } else {
                    setTimeout(updateLegend, 0);
                }
            } else {
                setTimeout(updateLegend, 0);
            }
        } catch (e) { console.warn('scheduleLegendUpdateFor failed', e); }
    }

    function showOverlay() {
        try {
            var overlayEl = document.getElementById('map-loading-overlay');
            if (overlayEl) overlayEl.style.display = 'flex';
        } catch (e) {}
    }

    function hideOverlay() {
        try {
            var overlayEl = document.getElementById('map-loading-overlay');
            if (overlayEl) overlayEl.style.display = 'none';
        } catch (e) {}
    }

    function toggleLayerWithLoading(layer, checked) {
        try {
            showOverlay();
            layer.setVisible(checked);
            var src = layer.getSource && layer.getSource();
            var finished = false;
            function finish() {
                if (finished) return;
                finished = true;
                try { setTimeout(updateLegend, 0); } catch (e) {}
                hideOverlay();
            }
            if (checked) {
                if (src && typeof src.getFeatures === 'function' && src.getFeatures().length === 0) {
                    var once = function() { try { src.un('featuresloadend', once); } catch (e) {} finish(); };
                    try { src.on('featuresloadend', once); } catch (e) {}
                    setTimeout(finish, 2000);
                } else {
                    setTimeout(finish, 150);
                }
            } else {
                setTimeout(finish, 100);
            }
        } catch (e) { hideOverlay(); }
    }
    // Helper: generate warna konsisten dari string kategori
    function colorFromCategory(category) {
        try {
            var str = String(category || 'LAINNYA');
            var hash = 0;
            for (var i = 0; i < str.length; i++) {
                hash = str.charCodeAt(i) + ((hash << 5) - hash);
                hash = hash & hash;
            }
            var hue = Math.abs(hash) % 360;
            var saturation = 65;
            var lightness = 55;
            return 'hsl(' + hue + ',' + saturation + '%,' + lightness + '%)';
        } catch (e) {
            return '#9aa0a6';
        }
    }
    var map = new ol.Map({
        target: 'map',
        layers: [
            new ol.layer.Tile({
                source: new ol.source.OSM()
            })
        ],
        view: new ol.View({
            // Koordinat center Banyuwangi
            center: ol.proj.fromLonLat([114.3691, -8.2191]),
            zoom: 10
        })
    });

    // Layer WMS untuk batas kecamatan
    var batasKecamatan = new ol.layer.Vector({
        title: 'Batas Kecamatan',
        source: new ol.source.Vector({
            url: '{{ asset('mapdata/newgeo/BATAS KECAMATAN.geojson') }}',
            format: new ol.format.GeoJSON()
        }),
        visible: false,
        opacity: 1,
        style: function(feature) {
            return new ol.style.Style({
                fill: new ol.style.Fill({
                    color: feature.get('WARNA')
                }),
                stroke: new ol.style.Stroke({
                    color: feature.get('WARNA'),
                    width: 2
                })
            });
        }
    });

    // Event listener untuk memastikan layer sudah ter-load
    batasKecamatan.getSource().on('featuresloadend', function() {
        console.log('Batas Kecamatan layer loaded');
        batasKecamatan.setOpacity(1);
        if (batasKecamatan.getVisible && batasKecamatan.getVisible()) setTimeout(updateLegend, 0);
    });

    // Layer LSD
    var lsdLayer = new ol.layer.Vector({
        title: 'LSD',
        source: new ol.source.Vector({
            url: '{{ asset('mapdata/newgeo/LSD BANYUWANGI.geojson') }}',
            format: new ol.format.GeoJSON()
        }),
        visible: false,
        opacity: 1,
        style: function(feature) {
            var lsdType = feature.get('LSD');
            var fillColor;
            
            if (lsdType === 'Lahan Sawah yang Dilindungi di Dalam Kawasan Hutan') {
                fillColor = '#13a126';
            } else if (lsdType === 'Lahan Sawah yang Dilindungi di Luar Kawasan Hutan') {
                fillColor = '#b6fc60';
            } else {
                fillColor = '#d9faf4';
            }
            
            return new ol.style.Style({
                fill: new ol.style.Fill({
                    color: fillColor,
                    opacity: 0.5
                }),
                stroke: new ol.style.Stroke({
                    color: 'black',
                    width: 0,
                    opacity: 0.2
                })
            });
        }
    });

    lsdLayer.getSource().on('featuresloadend', function() {
        console.log('LSD layer loaded');
        lsdLayer.setOpacity(1);
        if (lsdLayer.getVisible && lsdLayer.getVisible()) setTimeout(updateLegend, 0);
    });

    // Layer RTRW 2024
    var rtrwLayer = new ol.layer.Vector({
        title: 'RTRW 2024',
        source: new ol.source.Vector({
            url: '{{ asset('mapdata/newgeo/RTRW BWI 24.geojson') }}',
            format: new ol.format.GeoJSON()
        }),
        visible: false,
        opacity: 1,
        style: function(feature) {
            return new ol.style.Style({
                fill: new ol.style.Fill({
                    color: feature.get('WARNA')
                }),
                stroke: new ol.style.Stroke({
                    color: feature.get('WARNA'),
                    width: 2
                })
            });
        }
    });

    rtrwLayer.getSource().on('featuresloadend', function() {
        console.log('RTRW layer loaded');
        rtrwLayer.setOpacity(1);
        if (rtrwLayer.getVisible && rtrwLayer.getVisible()) setTimeout(updateLegend, 0);
    });

    // Layer RDTR Glagah-Giri
    var rdtrGlagahGiri = new ol.layer.Vector({
        title: 'RDTR Glagah-Giri',
        source: new ol.source.Vector({
            url: '{{ asset('mapdata/newgeo/RDTR GLAGAH GIRI.geojson') }}',
            format: new ol.format.GeoJSON()
        }),
        visible: false,
        opacity: 1,
        style: function(feature) {
            return new ol.style.Style({
                fill: new ol.style.Fill({
                    color: feature.get('WARNA')
                }),
                stroke: new ol.style.Stroke({
                    color: feature.get('WARNA'),
                    width: 2
                })
            });
        }
    });

    rdtrGlagahGiri.getSource().on('featuresloadend', function() {
        console.log('RDTR Glagah-Giri layer loaded');
        rdtrGlagahGiri.setOpacity(1);
        if (rdtrGlagahGiri.getVisible && rdtrGlagahGiri.getVisible()) setTimeout(updateLegend, 0);
    });

    // Layer RDTR Licin
    var rdtrLicin = new ol.layer.Vector({
        title: 'RDTR Licin',
        source: new ol.source.Vector({
            url: '{{ asset('mapdata/newgeo/LICIN.geojson') }}',
            format: new ol.format.GeoJSON()
        }),
        visible: false,
        opacity: 1,
        style: function(feature) {
            return new ol.style.Style({
                fill: new ol.style.Fill({
                    color: feature.get('WARNA')
                }),
                stroke: new ol.style.Stroke({
                    color: feature.get('WARNA'),
                    width: 2
                })
            });
        }
    });

    rdtrLicin.getSource().on('featuresloadend', function() {
        console.log('RDTR Licin layer loaded');
        rdtrLicin.setOpacity(1);
        if (rdtrLicin.getVisible && rdtrLicin.getVisible()) setTimeout(updateLegend, 0);
    });

    // Layer RDTR Kabat
    var rdtrKabat = new ol.layer.Vector({
        title: 'RDTR Kabat',
        source: new ol.source.Vector({
            url: '{{ asset('mapdata/newgeo/KABAT.geojson') }}',
            format: new ol.format.GeoJSON()
        }),
        visible: false,
        opacity: 1,
        style: function(feature) {
            return new ol.style.Style({
                fill: new ol.style.Fill({
                    color: feature.get('WARNA')
                }),
                stroke: new ol.style.Stroke({
                    color: feature.get('WARNA'),
                    width: 2
                })
            });
        }
    });

    rdtrKabat.getSource().on('featuresloadend', function() {
        console.log('RDTR Kabat layer loaded');
        rdtrKabat.setOpacity(1);
        if (rdtrKabat.getVisible && rdtrKabat.getVisible()) setTimeout(updateLegend, 0);
    });

    // Layer RDTR Rogojampi
    var rdtrRogojampi = new ol.layer.Vector({
        title: 'RDTR Rogojampi', 
        source: new ol.source.Vector({
            url: '{{ asset('mapdata/newgeo/ROGOJAMPI.geojson') }}',
            format: new ol.format.GeoJSON()
        }),
        visible: false,
        opacity: 1,
        style: function(feature) {
            return new ol.style.Style({
                fill: new ol.style.Fill({
                    color: feature.get('WARNA')
                }),
                stroke: new ol.style.Stroke({
                    color: feature.get('WARNA'),
                    width: 2
                })
            });
        }
    });

    rdtrRogojampi.getSource().on('featuresloadend', function() {
        console.log('RDTR Rogojampi layer loaded');
        rdtrRogojampi.setOpacity(1);
        if (rdtrRogojampi.getVisible && rdtrRogojampi.getVisible()) setTimeout(updateLegend, 0);
    });

    // Layer RDTR Genteng
    var rdtrGenteng = new ol.layer.Vector({
        title: 'RDTR Genteng',
        source: new ol.source.Vector({
            url: '{{ asset('mapdata/newgeo/Genteng.geojson') }}',
            format: new ol.format.GeoJSON()
        }),
        visible: false,
        opacity: 1,
        style: function(feature) {
            var kategori = feature.get('NAMOBJ') || feature.get('namobj') || feature.get('NAMZON') || feature.get('KODZON') || 'LAINNYA';
            var warna = feature.get('WARNA') || feature.get('warna') || colorFromCategory(kategori);
            feature.set('warna', warna, true);
            return new ol.style.Style({
                fill: new ol.style.Fill({ color: warna }),
                stroke: new ol.style.Stroke({ color: warna, width: 1 })
            });
        }
    });

    rdtrGenteng.getSource().on('featuresloadend', function() {
        console.log('RDTR Genteng layer loaded');
        try {
            var feats = rdtrGenteng.getSource().getFeatures();
            for (var i = 0; i < feats.length; i++) {
                var f = feats[i];
                var kategori = f.get('NAMOBJ') || f.get('namobj') || f.get('NAMZON') || f.get('KODZON') || 'LAINNYA';
                var warna = f.get('WARNA') || f.get('warna') || colorFromCategory(kategori);
                f.set('warna', warna, true);
            }
        } catch (e) { console.warn('genteng color init error', e); }
        rdtrGenteng.setOpacity(1);
        if (rdtrGenteng.getVisible && rdtrGenteng.getVisible()) setTimeout(updateLegend, 0);
    });

    // Layer RDTR Singojuruh
    var rdtrSingojuruh = new ol.layer.Vector({
        title: 'RDTR Singojuruh',
        source: new ol.source.Vector({
            url: '{{ asset('mapdata/newgeo/Singojuruh.geojson') }}',
            format: new ol.format.GeoJSON()
        }),
        visible: false,
        opacity: 1,
        style: function(feature) {
            var kategori = feature.get('NAMOBJ') || feature.get('namobj') || feature.get('NAMZON') || feature.get('KODZON') || 'LAINNYA';
            var warna = feature.get('WARNA') || feature.get('warna') || colorFromCategory(kategori);
            feature.set('warna', warna, true);
            return new ol.style.Style({
                fill: new ol.style.Fill({ color: warna }),
                stroke: new ol.style.Stroke({ color: warna, width: 1 })
            });
        }
    });

    rdtrSingojuruh.getSource().on('featuresloadend', function() {
        console.log('RDTR Singojuruh layer loaded');
        try {
            var feats = rdtrSingojuruh.getSource().getFeatures();
            for (var i = 0; i < feats.length; i++) {
                var f = feats[i];
                var kategori = f.get('NAMOBJ') || f.get('namobj') || f.get('NAMZON') || f.get('KODZON') || 'LAINNYA';
                var warna = f.get('WARNA') || f.get('warna') || colorFromCategory(kategori);
                f.set('warna', warna, true);
            }
        } catch (e) { console.warn('singojuruh color init error', e); }
        rdtrSingojuruh.setOpacity(1);
        if (rdtrSingojuruh.getVisible && rdtrSingojuruh.getVisible()) setTimeout(updateLegend, 0);
    });

    // Membuat layer untuk marker pencarian
    var markerSource = new ol.source.Vector();
    var markerLayer = new ol.layer.Vector({
        source: markerSource,
        style: new ol.style.Style({
            image: new ol.style.Icon({
                anchor: [0.5, 1],
                src: '{{ asset("frontend/img/map-marker.png") }}',
                scale: 0.5
            })
        }),
        zIndex: 9999
    });

    // Simpan view awal untuk reset
    var initialCenter = ol.proj.fromLonLat([114.3691, -8.2191]);
    var initialZoom = 10;

    // Fungsi untuk mencari koordinat
    $('#searchCoordinate').on('click', function() {
        var lon = parseFloat($('#longitude').val());
        var lat = parseFloat($('#latitude').val());
        
        if (isNaN(lon) || isNaN(lat)) {
            alert('Masukkan koordinat yang valid');
            return;
        }
        
        markerSource.clear();
        
        var marker = new ol.Feature({
            geometry: new ol.geom.Point(ol.proj.fromLonLat([lon, lat]))
        });
        markerSource.addFeature(marker);
        
        map.getView().animate({
            center: ol.proj.fromLonLat([lon, lat]),
            zoom: 15,
            duration: 1000
        });
        
        setTimeout(function() {
            markerLayer.setZIndex(9999);
            map.render();
        }, 1100);
    });

    // Fungsi untuk reset peta
    $('#resetMap').on('click', function() {
        markerSource.clear();
        $('#longitude').val('');
        $('#latitude').val('');
        
        map.getView().animate({
            center: initialCenter,
            zoom: initialZoom,
            duration: 1000
        });
        
        setTimeout(function() {
            markerLayer.setZIndex(9999);
            map.render();
        }, 1100);
    });

    // Event listeners untuk checkbox layer control
    $(document).ready(function() {
        function ensureMarkerOnTop() {
            markerLayer.setZIndex(9999);
            map.render();
        }
        
        $('#batasKecamatanCheck').on('change', function() {
            toggleLayerWithLoading(batasKecamatan, this.checked);
            ensureMarkerOnTop();
        });

        $('#lsdCheck').on('change', function() {
            toggleLayerWithLoading(lsdLayer, this.checked);
            ensureMarkerOnTop();
        });

        $('#rtrwCheck').on('change', function() {
            toggleLayerWithLoading(rtrwLayer, this.checked);
            ensureMarkerOnTop();
        });

        $('#rdtrGlagahGiriCheck').on('change', function() {
            toggleLayerWithLoading(rdtrGlagahGiri, this.checked);
            ensureMarkerOnTop();
        });

        $('#rdtrLicinCheck').on('change', function() {
            toggleLayerWithLoading(rdtrLicin, this.checked);
            ensureMarkerOnTop();
        });

        $('#rdtrKabatCheck').on('change', function() {
            toggleLayerWithLoading(rdtrKabat, this.checked);
            ensureMarkerOnTop();
        });

        $('#rdtrRogojampiCheck').on('change', function() {
            toggleLayerWithLoading(rdtrRogojampi, this.checked);
            ensureMarkerOnTop();
        });

        $('#rdtrGentengCheck').on('change', function() {
            toggleLayerWithLoading(rdtrGenteng, this.checked);
            ensureMarkerOnTop();
        });

        $('#rdtrSingojuruhCheck').on('change', function() {
            toggleLayerWithLoading(rdtrSingojuruh, this.checked);
            ensureMarkerOnTop();
        });
    });

    // Event listeners untuk opacity sliders
    $(document).ready(function() {
        function ensureMarkerOnTop() {
            markerLayer.setZIndex(9999);
            map.render();
        }
        
        function setLayerOpacity(layer, sliderId, labelId) {
            try {
                var opacity = parseFloat($(sliderId).val()) / 100;
                layer.setOpacity(opacity);
                $(labelId).text($(sliderId).val() + '%');
                map.render();
                ensureMarkerOnTop();
            } catch (error) {
                console.error('Error setting opacity:', error);
            }
        }

        $('#batasKecamatanOpacitySlider').on('input', function() {
            setLayerOpacity(batasKecamatan, '#batasKecamatanOpacitySlider', '#batasKecamatanOpacity');
        });

        $('#lsdOpacitySlider').on('input', function() {
            setLayerOpacity(lsdLayer, '#lsdOpacitySlider', '#lsdOpacity');
        });

        $('#rtrwOpacitySlider').on('input', function() {
            setLayerOpacity(rtrwLayer, '#rtrwOpacitySlider', '#rtrwOpacity');
        });

        $('#rdtrGlagahGiriOpacitySlider').on('input', function() {
            setLayerOpacity(rdtrGlagahGiri, '#rdtrGlagahGiriOpacitySlider', '#rdtrGlagahGiriOpacity');
        });

        $('#rdtrLicinOpacitySlider').on('input', function() {
            setLayerOpacity(rdtrLicin, '#rdtrLicinOpacitySlider', '#rdtrLicinOpacity');
        });

        $('#rdtrKabatOpacitySlider').on('input', function() {
            setLayerOpacity(rdtrKabat, '#rdtrKabatOpacitySlider', '#rdtrKabatOpacity');
        });

        $('#rdtrRogojampiOpacitySlider').on('input', function() {
            setLayerOpacity(rdtrRogojampi, '#rdtrRogojampiOpacitySlider', '#rdtrRogojampiOpacity');
        });

        $('#rdtrGentengOpacitySlider').on('input', function() {
            setLayerOpacity(rdtrGenteng, '#rdtrGentengOpacitySlider', '#rdtrGentengOpacity');
        });

        $('#rdtrSingojuruhOpacitySlider').on('input', function() {
            setLayerOpacity(rdtrSingojuruh, '#rdtrSingojuruhOpacitySlider', '#rdtrSingojuruhOpacity');
        });
    });

    // Reset semua opacity ke 100%
    $('#resetAllOpacity').on('click', function() {
        $('.opacity-slider').val(100);
        
        batasKecamatan.setOpacity(1);
        lsdLayer.setOpacity(1);
        rtrwLayer.setOpacity(1);
        rdtrGlagahGiri.setOpacity(1);
        rdtrLicin.setOpacity(1);
        rdtrKabat.setOpacity(1);
        rdtrRogojampi.setOpacity(1);
        
        $('.opacity-slider').each(function() {
            var id = $(this).attr('id');
            var labelId = id.replace('Slider', '');
            $('#' + labelId).text('100%');
        });
        
        markerLayer.setZIndex(9999);
        map.render();
    });

    // Tambahkan layer ke peta
    map.addLayer(batasKecamatan);
    map.addLayer(rtrwLayer);
    map.addLayer(rdtrGlagahGiri);
    map.addLayer(rdtrLicin);
    map.addLayer(rdtrKabat);
    map.addLayer(rdtrRogojampi);
    map.addLayer(rdtrGenteng);
    map.addLayer(rdtrSingojuruh);
    map.addLayer(lsdLayer);
    map.addLayer(markerLayer);
    markerLayer.setZIndex(9999);

    // Hover effect untuk layer LSD
    var highlightFeature = null;
    
    function getLSDHighlightStyle(lsdType) {
        var fillColor;
        if (lsdType === 'Lahan Sawah yang Dilindungi di Dalam Kawasan Hutan') {
            fillColor = '#13a126';
        } else if (lsdType === 'Lahan Sawah yang Dilindungi di Luar Kawasan Hutan') {
            fillColor = '#b6fc60';
        } else {
            fillColor = '#d9faf4';
        }
        
        return new ol.style.Style({
            fill: new ol.style.Fill({
                color: fillColor,
                opacity: 0.8
            }),
            stroke: new ol.style.Stroke({
                color: 'green',
                width: 1,
                opacity: 0.2
            })
        });
    }
    
    map.on('pointermove', function(evt) {
        if (evt.dragging) {
            return;
        }
        
        var pixel = map.getEventPixel(evt.originalEvent);
        var hit = map.hasFeatureAtPixel(pixel);
        map.getTargetElement().style.cursor = hit ? 'pointer' : '';
        
        if (highlightFeature) {
            highlightFeature.setStyle(null);
            highlightFeature = null;
        }
        
        if (hit && lsdLayer.getVisible()) {
            map.forEachFeatureAtPixel(pixel, function(feature, layer) {
                if (layer === lsdLayer) {
                    highlightFeature = feature;
                    var lsdType = feature.get('LSD');
                    feature.setStyle(getLSDHighlightStyle(lsdType));
                    return true;
                }
            });
        }
    });

    // Fungsi untuk menampilkan info zona
    function showInfoZona(layerName, color, namobj, extra) {
        $('#info-zona-title').text('Informasi ' + layerName);
        $('#info-zona-layer').text('Detail zona tata ruang ' + layerName);
        $('#info-zona-color').css('background', color);
        
        function infoRow(label, value) {
            return '<div class="mb-2">'
                +'<div class="flex items-center gap-2 mb-1">'
                    +'<i class="fas fa-info-circle text-blue-500 text-xs"></i>'
                    +'<span class="text-blue-500 font-semibold text-sm">'+label+'</span>'
                +'</div>'
                +'<div class="ml-5 text-gray-700 text-sm">'+value+'</div>'
            +'</div>';
        }
        
        let html = '';
        if(extra && extra.type === 'kecamatan') {
            html += infoRow('KECAMATAN', extra.kecamatan);
            html += infoRow('LUAS (ha)', extra.luas);
            $('#info-zona-namobj').html(html);
            $('#info-zona-namobj-summary').html(html);
        } else if(extra && extra.type === 'lsd') {
            html += infoRow('LSD', extra.lsd);
            html += infoRow('HUTAN', extra.hutan);
            $('#info-zona-namobj').html(html);
            $('#info-zona-namobj-summary').html(html);
        } else {
            html += infoRow('Nama Zona', namobj || '-');
            $('#info-zona-namobj').html(html);
            $('#info-zona-namobj-summary').html(html);
        }
        $('#info-zona-card').removeClass('hidden');
    }

    // Map click handler untuk semua vector layer
    map.on('singleclick', function(evt) {
        var found = false;
        var layers = [
            {layer: batasKecamatan, name: 'Batas Kecamatan'},
            {layer: lsdLayer, name: 'LSD'},
            {layer: rtrwLayer, name: 'RTRW 2024'},
            {layer: rdtrGlagahGiri, name: 'RDTR Glagah-Giri'},
            {layer: rdtrLicin, name: 'RDTR Licin'},
            {layer: rdtrKabat, name: 'RDTR Kabat'},
            {layer: rdtrRogojampi, name: 'RDTR Rogojampi'},
            {layer: rdtrGenteng, name: 'RDTR Genteng'},
            {layer: rdtrSingojuruh, name: 'RDTR Singojuruh'}
        ];
        
        map.forEachFeatureAtPixel(evt.pixel, function(feature, layerRef) {
            for (var i=0; i<layers.length; i++) {
                if (layerRef === layers[i].layer && layerRef.getVisible()) {
                    var extra = null;
                    var namobj = feature.get('NAMOBJ') || feature.get('namobj');
                    if(feature.get('Kecamatan')) {
                        extra = {
                            type: 'kecamatan',
                            kecamatan: feature.get('Kecamatan'),
                            luas: feature.get('Luas') ? parseFloat(feature.get('Luas')).toFixed(2) : '-'
                        };
                        namobj = feature.get('Kecamatan');
                    } else if(feature.get('LSD')) {
                        extra = {
                            type: 'lsd',
                            lsd: feature.get('LSD'),
                            hutan: feature.get('HUTAN') || '-'
                        };
                        namobj = feature.get('LSD');
                    }
                    if(!namobj) namobj = '-';
                    var warna;
                    if(layerRef === lsdLayer) {
                        var lsdType = feature.get('LSD');
                        if (lsdType === 'Lahan Sawah yang Dilindungi di Dalam Kawasan Hutan') {
                            warna = '#13a126';
                        } else if (lsdType === 'Lahan Sawah yang Dilindungi di Luar Kawasan Hutan') {
                            warna = '#b6fc60';
                        } else {
                            warna = '#d9faf4';
                        }
                    } else {
                        warna = feature.get('WARNA') || feature.get('warna') || '#eee';
                    }
                    showInfoZona(layers[i].name, warna, namobj, extra);
                    found = true;
                    return true;
                }
            }
        });
    });

    // Handler klik pada peta untuk menampilkan marker dan mengisi input koordinat
    map.on('singleclick', function(evt) {
        var lonlat = ol.proj.toLonLat(evt.coordinate);
        var lon = lonlat[0].toFixed(6);
        var lat = lonlat[1].toFixed(6);
        $('#longitude').val(lon);
        $('#latitude').val(lat);
        markerSource.clear();
        var marker = new ol.Feature({
            geometry: new ol.geom.Point(evt.coordinate)
        });
        markerSource.addFeature(marker);
        markerLayer.setZIndex(9999);
        map.render();
    });

    // Fungsi untuk update legenda sesuai layer aktif
    function updateLegend() {
        var legend = [];
        var layers = [
            {layer: batasKecamatan, name: 'Batas Kecamatan', utama: 'Kecamatan'},
            {layer: lsdLayer, name: 'LSD', utama: 'LSD'},
            {layer: rtrwLayer, name: 'RTRW 2024', utama: 'NAMOBJ'},
            {layer: rdtrGlagahGiri, name: 'RDTR Glagah-Giri', utama: 'NAMOBJ'},
            {layer: rdtrLicin, name: 'RDTR Licin', utama: 'NAMOBJ'},
            {layer: rdtrKabat, name: 'RDTR Kabat', utama: 'NAMOBJ'},
            {layer: rdtrRogojampi, name: 'RDTR Rogojampi', utama: 'NAMOBJ'},
            {layer: rdtrGenteng, name: 'RDTR Genteng', utama: 'NAMOBJ'},
            {layer: rdtrSingojuruh, name: 'RDTR Singojuruh', utama: 'NAMOBJ'}
        ];
        
        for(var i=0;i<layers.length;i++){
            var lyr = layers[i].layer;
            if(lyr.getVisible()){
                var feats = lyr.getSource().getFeatures();
                if(feats.length>0){
                    legend.push('<div class="font-semibold text-gray-900 mb-2">'+layers[i].name+'</div>');
                    
                    if(lyr === lsdLayer) {
                        var lsdTypes = [
                            {name: 'Lahan Sawah yang Dilindungi di Dalam Kawasan Hutan', color: '#13a126'},
                            {name: 'Lahan Sawah yang Dilindungi di Luar Kawasan Hutan', color: '#b6fc60'},
                            {name: 'Lainnya', color: '#d9faf4'}
                        ];
                        
                        for(var k=0; k<lsdTypes.length; k++) {
                            legend.push('<div class="flex items-center gap-2 mb-2">'
                                +'<span class="w-6 h-6 rounded bg-gray-200 border-2 border-gray-400" style="background:'+lsdTypes[k].color+'"></span>'
                                +'<span class="text-sm text-gray-700">'+lsdTypes[k].name+'</span>'
                            +'</div>');
                        }
                    } else {
                        var seenUtama = Object.create(null);
                        for(var j=0;j<feats.length;j++){
                            var f = feats[j];
                            var utama = f.get(layers[i].utama)||'-';
                            var key = String(utama);
                            if(seenUtama[key]) continue;
                            seenUtama[key] = true;
                            var warnaLegend = f.get('WARNA')||f.get('warna')||colorFromCategory(utama);
                            legend.push('<div class="flex items-center gap-2 mb-2">'
                                +'<span class="w-6 h-6 rounded bg-gray-200 border-2 border-gray-400" style="background:'+warnaLegend+'"></span>'
                                +'<span class="text-sm text-gray-700">'+utama+'</span>'
                            +'</div>');
                        }
                    }
                }
            }
        }
        
        if(legend.length===0){
            $('#legend-content').html('<span class="text-gray-500 text-sm">Tidak ada layer aktif</span>');
        }else{
            $('#legend-content').html(legend.join(''));
        }
    }
    
    // Event listener untuk tombol close modal
    $(document).ready(function(){
        $('#close-info-zona').on('click', function() {
            $('#info-zona-card').addClass('hidden');
        });
        
        // Close modal saat klik di luar area modal
        $(document).on('click', function(e) {
            if (!$(e.target).closest('#info-zona-card, #info-zona-container').length) {
                $('#info-zona-card').addClass('hidden');
            }
        });
    });

    // Update legenda saat layer diaktifkan/nonaktifkan
    $(document).ready(function(){
        updateLegend();
        $('#batasKecamatanCheck,#lsdCheck,#rtrwCheck,#rdtrGlagahGiriCheck,#rdtrLicinCheck,#rdtrKabatCheck,#rdtrRogojampiCheck,#rdtrGentengCheck,#rdtrSingojuruhCheck').on('change',function(){
            setTimeout(updateLegend,300);
        });

        // Fake loading state 2 detik saat pertama kali akses halaman peta
        try {
            var overlayEl = document.getElementById('map-loading-overlay');
            if (overlayEl) {
                setTimeout(function(){
                    overlayEl.style.display = 'none';
                }, 2000);
            }
        } catch (e) { console.warn('overlay hide failed', e); }
    });
</script>

    </div>
    </div>

    <!-- Mobile Menu Toggle Script -->
    <script>
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        }
        
        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            const mobileMenu = document.getElementById('mobile-menu');
            const menuButton = document.querySelector('[onclick="toggleMobileMenu()"]');
            
            if (!mobileMenu.contains(event.target) && !menuButton.contains(event.target)) {
                mobileMenu.classList.add('hidden');
            }
        });
    </script>
</body>
</html>
