<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'SITARU') }}</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    
    <style>
        .sidebar-gradient { 
            background: #FAFBFC;
            border-right: 1px solid #E8EAED;
        }
        .main-gradient { 
            background: #F8F9FA;
        }
        
        .nav-item { 
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 8px;
            position: relative;
            margin: 2px 0;
        }
        
        .nav-item:hover:not(.active) { 
            background: #F1F5F9;
            color: #1E293B;
        }
        
        .nav-item.active { 
            background: #185B3C;
            color: white;
            box-shadow: 0 2px 8px rgba(24, 91, 60, 0.25);
        }
        
        .nav-item.active::before {
            content: '';
            position: absolute;
            left: -16px;
            top: 50%;
            transform: translateY(-50%);
            width: 3px;
            height: 20px;
            background: #185B3C;
            border-radius: 0 2px 2px 0;
        }
        
        .nav-item.active svg,
        .nav-item.active i {
            color: white;
        }
        
        .nav-section-title {
            color: #64748B;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            margin: 24px 0 8px 0;
        }
        
        .user-avatar {
            background: linear-gradient(135deg, #185B3C 0%, #0F3D26 100%);
        }
        
        .logo-container {
            background: linear-gradient(135deg, #185B3C 0%, #0F3D26 100%);
        }
        
        .mobile-app-card {
            background: linear-gradient(135deg, #1F2937 0%, #111827 100%);
            border-radius: 12px;
            padding: 16px;
            margin: 16px;
            margin-top: auto;
        }
        
        .dropdown-menu {
            background: white;
            border: 1px solid #E5E7EB;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        .primary-color { color: #185B3C; }
        .primary-bg { background-color: #185B3C; }
        .primary-border { border-color: #185B3C; }
        .primary-hover:hover { background-color: #0F3D26; }
        .primary-light { background-color: #22C55E; }
        .primary-focus:focus { ring-color: #185B3C; }
        
        /* Fixed sidebar styles */
        .sidebar-fixed {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 256px;
            z-index: 30;
        }
        
        .sidebar-scroll {
            height: 100vh;
            overflow-y: auto;
            overflow-x: hidden;
        }
        
        .sidebar-scroll::-webkit-scrollbar {
            width: 4px;
        }
        
        .sidebar-scroll::-webkit-scrollbar-track {
            background: transparent;
        }
        
        .sidebar-scroll::-webkit-scrollbar-thumb {
            background: #CBD5E1;
            border-radius: 2px;
        }
        
        .sidebar-scroll::-webkit-scrollbar-thumb:hover {
            background: #94A3B8;
        }
        
        .content-area {
            margin-left: 256px;
            min-height: 100vh;
        }
        
        .content-scroll {
            height: calc(100vh - 80px);
            overflow-y: auto;
            overflow-x: hidden;
        }
        
        .content-scroll::-webkit-scrollbar {
            width: 6px;
        }
        
        .content-scroll::-webkit-scrollbar-track {
            background: #F1F5F9;
        }
        
        .content-scroll::-webkit-scrollbar-thumb {
            background: #CBD5E1;
            border-radius: 3px;
        }
        
        .content-scroll::-webkit-scrollbar-thumb:hover {
            background: #94A3B8;
        }
        
        /* Settings Dropdown Styles */
        .settings-dropdown {
            background: white;
            border: 1px solid #E5E7EB;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-left: 32px;
            margin-top: 4px;
        }
        
        .settings-dropdown .nav-item {
            margin: 0;
            border-radius: 6px;
        }
        
        .settings-dropdown .nav-item:hover {
            background: #F1F5F9;
        }
        
        .settings-dropdown .nav-item.active {
            background: #185B3C;
            color: white;
        }
        
        .settings-dropdown .nav-item.active i {
            color: white;
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50" x-data="{ sidebarOpen: false, userDropdownOpen: false }">
    <div class="min-h-screen flex">
        <!-- Fixed Sidebar -->
        <div class="sidebar-fixed sidebar-gradient flex flex-col">
            <div class="sidebar-scroll">
                <!-- Logo Section -->
                <div class="p-4 border-b border-gray-100">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 logo-container rounded-lg flex items-center justify-center">
                            <i class="fas fa-building text-white text-sm"></i>
                        </div>
                        <div>
                            <h1 class="text-lg font-semibold text-gray-900">SITARU</h1>
                        </div>
                    </div>
                </div>

                <!-- Navigation Menu -->
                <div class="px-4 py-6">
                    @role('admin|superadmin')
                    <!-- MENU Section - Admin -->
                    <div class="nav-section-title">MENU</div>
                    
                    <div class="space-y-1">
                        <a href="{{ url('/dashboard') }}" class="nav-item flex items-center space-x-3 px-3 py-2.5 text-sm font-medium {{ request()->is('dashboard') ? 'active' : '' }}">
                            <i class="fas fa-tachometer-alt w-4 h-4"></i>
                            <span>Dashboard</span>
                        </a>
                    </div>

                    <!-- LAYANAN Section - Admin -->
                    <div class="nav-section-title">LAYANAN</div>
                    
                    <div class="space-y-1">
                        <a href="{{ route('admin.kkpr.index') }}" class="nav-item flex items-center space-x-3 px-3 py-2.5 text-sm font-medium {{ request()->is('admin/kkpr') || request()->is('admin/kkpr/*') ? 'active' : '' }}">
                            <i class="fas fa-file-alt w-4 h-4"></i>
                            <span>Persetujuan Bagi UMK</span>
                        </a>

                        <a href="{{ route('admin.kkprnon.index') }}" class="nav-item flex items-center space-x-3 px-3 py-2.5 text-sm font-medium {{ request()->is('admin/kkprnon*') ? 'active' : '' }}">
                            <i class="fas fa-file-contract w-4 h-4"></i>
                            <span>Penilaian KKPR Terbit Otomatis</span>
                        </a>

                        <a href="{{ route('admin.pengaduan.index') }}" class="nav-item flex items-center space-x-3 px-3 py-2.5 text-sm font-medium {{ request()->is('admin/pengaduan*') ? 'active' : '' }}">
                            <i class="fas fa-bullhorn w-4 h-4"></i>
                            <span>Pengaduan</span>
                        </a>
                    </div>

                    <!-- INFORMASI Section - Admin -->
                    <div class="nav-section-title">INFORMASI</div>
                    
                    <div class="space-y-1">
                        <a href="{{ route('admin.peta.index') }}" class="nav-item flex items-center space-x-3 px-3 py-2.5 text-sm font-medium {{ request()->is('admin/peta*') ? 'active' : '' }}">
                            <i class="fas fa-map-marked-alt w-4 h-4"></i>
                            <span>Peta Persebaran</span>
                        </a>

                        <a href="{{ route('admin.informasi.index') }}" class="nav-item flex items-center space-x-3 px-3 py-2.5 text-sm font-medium {{ request()->is('admin/informasi*') ? 'active' : '' }}">
                            <i class="fas fa-info-circle w-4 h-4"></i>
                            <span>Informasi</span>
                        </a>

                        <a href="{{ route('admin.berita.index') }}" class="nav-item flex items-center space-x-3 px-3 py-2.5 text-sm font-medium {{ request()->is('admin/berita*') ? 'active' : '' }}">
                            <i class="fas fa-newspaper w-4 h-4"></i>
                            <span>Berita</span>
                        </a>

                        <a href="{{ route('admin.slider.index') }}" class="nav-item flex items-center space-x-3 px-3 py-2.5 text-sm font-medium {{ request()->is('admin/slider*') ? 'active' : '' }}">
                            <i class="fas fa-images w-4 h-4"></i>
                            <span>Slider</span>
                        </a>

                        <a href="{{ route('admin.kontak.index') }}" class="nav-item flex items-center space-x-3 px-3 py-2.5 text-sm font-medium {{ request()->is('admin/kontak*') ? 'active' : '' }}">
                            <i class="fas fa-phone w-4 h-4"></i>
                            <span>Kontak Pengaduan</span>
                        </a>
                    </div>

                    <!-- ACCOUNT Section - Admin -->
                    <div class="nav-section-title">ACCOUNT</div>
                    
                    <div class="space-y-1">
                        <a href="{{ route('profile.edit') }}" class="nav-item flex items-center space-x-3 px-3 py-2.5 text-sm font-medium {{ request()->is('profile*') ? 'active' : '' }}">
                            <i class="fas fa-user w-4 h-4"></i>
                            <span>Profile</span>
                        </a>

                        <!-- Settings Dropdown - Admin Only -->
                        <div class="relative" x-data="{ settingsOpen: false }">
                            <button @click="settingsOpen = !settingsOpen" class="nav-item flex items-center justify-between w-full space-x-3 px-3 py-2.5 text-sm font-medium text-gray-600 hover:text-gray-900">
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-cog w-4 h-4"></i>
                                    <span>Pengaturan</span>
                                </div>
                                <i class="fas fa-chevron-down text-xs transition-transform duration-200" :class="{ 'rotate-180': settingsOpen }"></i>
                            </button>
                            
                            <!-- Dropdown Menu -->
                            <div x-show="settingsOpen" @click.away="settingsOpen = false" x-transition class="settings-dropdown p-2 space-y-1">
                                <a href="{{ route('admin.settings.index') }}" class="nav-item flex items-center space-x-3 px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 {{ request()->is('admin/settings*') ? 'active' : '' }}">
                                    <i class="fas fa-cog w-3 h-3"></i>
                                    <span>Settings</span>
                                </a>
                                
                                <a href="/admin/users" class="nav-item flex items-center space-x-3 px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 {{ request()->is('admin/users*') ? 'active' : '' }}">
                                    <i class="fas fa-users w-3 h-3"></i>
                                    <span>User Management</span>
                                </a>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('logout') }}" class="mt-2">
                            @csrf
                            <button type="submit" class="nav-item flex items-center w-full space-x-3 px-3 py-2.5 text-sm font-medium text-gray-600 hover:text-red-600">
                                <i class="fas fa-sign-out-alt w-4 h-4"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                    @endrole

                    @role('member')
                    <!-- MENU Section - Member -->
                    <div class="nav-section-title">MENU</div>
                    
                    <div class="space-y-1">
                        <a href="{{ url('/dashboard') }}" class="nav-item flex items-center space-x-3 px-3 py-2.5 text-sm font-medium {{ request()->is('dashboard') ? 'active' : '' }}">
                            <i class="fas fa-home w-4 h-4"></i>
                            <span>Beranda</span>
                        </a>
                    </div>

                    <!-- LAYANAN Section - Member -->
                    <div class="nav-section-title">LAYANAN SAYA</div>
                    
                    <div class="space-y-1">
                        <a href="{{ route('member.kkpr.index') }}" class="nav-item flex items-center space-x-3 px-3 py-2.5 text-sm font-medium {{ request()->routeIs('member.kkpr.index') || request()->routeIs('member.kkpr.create') || request()->routeIs('member.kkpr.show') || request()->routeIs('member.kkpr.edit') || request()->routeIs('member.kkpr.cetak.*') ? 'active' : '' }}">
                            <i class="fas fa-file-alt w-4 h-4"></i>
                            <span>Persetujuan Bagi UMK</span>
                        </a>

                        <a href="{{ route('member.kkprnon.index') }}" class="nav-item flex items-center space-x-3 px-3 py-2.5 text-sm font-medium {{ request()->routeIs('member.kkprnon.index') || request()->routeIs('member.kkprnon.create') || request()->routeIs('member.kkprnon.show') || request()->routeIs('member.kkprnon.edit') || request()->routeIs('member.kkprnon.cetak.*') ? 'active' : '' }}">
                            <i class="fas fa-home w-4 h-4"></i>
                            <span>KKPR Terbit Otomatis</span>
                        </a>

                        {{-- <a href="#" class="nav-item flex items-center space-x-3 px-3 py-2.5 text-sm font-medium text-gray-600">
                            <i class="fas fa-bullhorn w-4 h-4"></i>
                            <span>Pengaduan Saya</span>
                        </a>

                        <a href="#" class="nav-item flex items-center space-x-3 px-3 py-2.5 text-sm font-medium text-gray-600">
                            <i class="fas fa-history w-4 h-4"></i>
                            <span>Riwayat Pengajuan</span>
                        </a> --}}
                    </div>

                    <!-- INFORMASI Section - Member -->
                    {{-- <div class="nav-section-title">INFORMASI</div>
                    
                    <div class="space-y-1">
                        <a href="#" class="nav-item flex items-center space-x-3 px-3 py-2.5 text-sm font-medium text-gray-600">
                            <i class="fas fa-info-circle w-4 h-4"></i>
                            <span>Informasi</span>
                        </a>

                        <a href="#" class="nav-item flex items-center space-x-3 px-3 py-2.5 text-sm font-medium text-gray-600">
                            <i class="fas fa-newspaper w-4 h-4"></i>
                            <span>Berita</span>
                        </a>

                        <a href="#" class="nav-item flex items-center space-x-3 px-3 py-2.5 text-sm font-medium text-gray-600">
                            <i class="fas fa-book w-4 h-4"></i>
                            <span>Panduan</span>
                        </a>
                    </div> --}}

                    <!-- ACCOUNT Section - Member -->
                    <div class="nav-section-title">AKUN SAYA</div>
                    
                    <div class="space-y-1">
                        <a href="{{ route('profile.edit') }}" class="nav-item flex items-center space-x-3 px-3 py-2.5 text-sm font-medium {{ request()->is('profile*') ? 'active' : '' }}">
                            <i class="fas fa-user w-4 h-4"></i>
                            <span>Profile</span>
                        </a>

                        {{-- <a href="#" class="nav-item flex items-center space-x-3 px-3 py-2.5 text-sm font-medium text-gray-600">
                            <i class="fas fa-bell w-4 h-4"></i>
                            <span>Notifikasi</span>
                        </a> --}}

                        <form method="POST" action="{{ route('logout') }}" class="mt-2">
                            @csrf
                            <button type="submit" class="nav-item flex items-center w-full space-x-3 px-3 py-2.5 text-sm font-medium text-gray-600 hover:text-red-600">
                                <i class="fas fa-sign-out-alt w-4 h-4"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                    @endrole
                </div>

                <!-- Mobile App Download Card -->
                {{-- <div class="mobile-app-card">
                    <div class="flex items-start space-x-3">
                        <div class="w-10 h-10 primary-bg rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-mobile-alt text-white"></i>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-white font-medium text-sm mb-1">Download our Mobile App</h3>
                            <p class="text-gray-400 text-xs mb-3">Get better experience from your mobile.</p>
                            <button class="w-full primary-bg hover:primary-hover text-white text-xs font-medium py-2 px-3 rounded-lg transition-colors">
                                Download
                            </button>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="content-area flex-1 flex flex-col main-gradient">
            <!-- Fixed Top Navigation -->
            <header class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-20">
                <div class="px-6 py-4">
                    <div class="flex justify-between items-center">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-900">@yield('title', 'Dashboard')</h2>
                            <p class="text-sm text-gray-500">@yield('subtitle', 'Selamat datang di SITARU')</p>
                        </div>
                        
                        <div class="flex items-center space-x-4">
                            <!-- Search -->
                            <div class="relative">
                                <input type="text" placeholder="Search..." class="pl-9 pr-4 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent">
                                <i class="fas fa-search absolute left-3 top-2.5 text-gray-400 text-sm"></i>
                            </div>

                            <!-- Notifications -->
                            <button class="relative p-2 text-gray-400 hover:text-gray-600 rounded-lg hover:bg-gray-100">
                                <i class="fas fa-bell"></i>
                                <span class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 rounded-full text-xs text-white flex items-center justify-center">3</span>
                            </button>
                            
                            <!-- User Dropdown -->
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open" class="flex items-center space-x-2 p-1.5 text-sm rounded-lg hover:bg-gray-100 focus:outline-none">
                                    <div class="w-7 h-7 user-avatar rounded-full flex items-center justify-center">
                                        <span class="text-white font-medium text-xs">{{ substr(auth()->user()->name ?? 'U', 0, 1) }}</span>
                                    </div>
                                    <i class="fas fa-chevron-down text-xs text-gray-400"></i>
                                </button>
                                
                                <!-- Dropdown menu -->
                                <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-2 w-56 dropdown-menu" style="z-index: 9999;">
                                    <div class="px-4 py-3 border-b border-gray-100">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 user-avatar rounded-full flex items-center justify-center">
                                                <span class="text-white font-medium text-sm">{{ substr(auth()->user()->name ?? 'U', 0, 1) }}</span>
                                            </div>
                                            <div>
                                                <div class="font-medium text-sm text-gray-900">{{ auth()->user()->name }}</div>
                                                <div class="text-gray-500 text-xs">{{ auth()->user()->email }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="py-1">
                                        <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                            <i class="fas fa-user w-4 h-4 mr-3 text-gray-400"></i>
                                            Profile Settings
                                        </a>
                                        {{-- <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                            <i class="fas fa-cog w-4 h-4 mr-3 text-gray-400"></i>
                                            Account Settings
                                        </a>
                                        <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                            <i class="fas fa-question-circle w-4 h-4 mr-3 text-gray-400"></i>
                                            Help & Support
                                        </a> --}}
                                        <hr class="my-1">
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                                <i class="fas fa-sign-out-alt w-4 h-4 mr-3"></i>
                                                Sign out
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Flash Messages -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mx-6 mt-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none'">
                        <i class="fas fa-times cursor-pointer"></i>
                    </span>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mx-6 mt-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none'">
                        <i class="fas fa-times cursor-pointer"></i>
                    </span>
                </div>
            @endif

            <!-- Scrollable Page Content -->
            <main class="content-scroll p-6">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
