@extends('layouts.app')

@section('title', 'Profile Settings')
@section('subtitle', 'Kelola informasi akun dan keamanan Anda')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">
    <!-- Hero Section with Gradient -->
    <div class="relative overflow-hidden bg-gradient-to-br from-[#185B3C] via-[#0F3D26] to-[#185B3C] rounded-xl p-6 text-white">
        <div class="absolute inset-0 bg-black/10"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold mb-1">Profile Settings</h1>
                    <p class="text-sm text-white/90 mb-4">Kelola informasi akun dan keamanan Anda dengan mudah</p>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                            <span class="text-xs">Akun Aktif</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-shield-alt text-xs"></i>
                            <span class="text-xs">Keamanan Terjamin</span>
                        </div>
                    </div>
                </div>
                <div class="hidden lg:block">
                    <div class="w-20 h-20 bg-white/10 rounded-full flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-user-cog text-3xl text-white/80"></i>
                    </div>
                </div>
            </div>
        </div>
        <!-- Decorative Elements -->
        <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -translate-y-16 translate-x-16"></div>
        <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full translate-y-12 -translate-x-12"></div>
    </div>

    <!-- Profile Information Section -->
    <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg border border-white/20 overflow-hidden">
        <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 bg-gradient-to-br from-[#185B3C] to-[#0F3D26] rounded-lg flex items-center justify-center">
                    <i class="fas fa-user text-white text-sm"></i>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Informasi Profile</h3>
                    <p class="text-sm text-gray-600">Update informasi akun dan alamat email Anda</p>
                </div>
            </div>
        </div>
        <div class="p-6">
            <div class="max-w-2xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>
    </div>

    <!-- Update Password Section -->
    <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg border border-white/20 overflow-hidden">
        <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-key text-white text-sm"></i>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Update Password</h3>
                    <p class="text-sm text-gray-600">Pastikan akun Anda menggunakan password yang kuat dan aman</p>
                </div>
            </div>
        </div>
        <div class="p-6">
            <div class="max-w-2xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>
    </div>

    <!-- Delete Account Section -->
    <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg border border-white/20 overflow-hidden">
        <div class="px-6 py-4 bg-gradient-to-r from-red-50 to-red-100 border-b border-red-200">
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 bg-gradient-to-br from-red-500 to-red-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-exclamation-triangle text-white text-sm"></i>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-red-900">Hapus Akun</h3>
                    <p class="text-sm text-red-600">Peringatan: Tindakan ini tidak dapat dibatalkan</p>
                </div>
            </div>
        </div>
        <div class="p-6">
            <div class="max-w-2xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Staggered animation for cards
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
    });
</script>
@endsection
