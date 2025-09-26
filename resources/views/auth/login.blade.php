<x-guest-layout>
    <div class="text-center mb-6">
        {{-- <div class="w-12 h-12 bg-gradient-to-br from-[#1A5D3F] to-[#DAB660] rounded-xl flex items-center justify-center mx-auto mb-3">
            <i class="fas fa-sign-in-alt text-white text-lg"></i>
        </div> --}}
        <h2 class="text-2xl font-bold text-gray-900">Masuk ke SITARU</h2>
        <p class="text-gray-600 text-sm mt-1">Akses layanan digital dengan mudah dan aman</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" class="text-sm font-semibold text-gray-700 mb-1" />
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-envelope text-gray-400 text-sm"></i>
                </div>
                <x-text-input id="email" class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1A5D3F] focus:border-transparent transition-all duration-200 text-sm" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Masukkan email Anda" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs text-red-600" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Password')" class="text-sm font-semibold text-gray-700 mb-1" />
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-lock text-gray-400 text-sm"></i>
                </div>
                <x-text-input id="password" class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1A5D3F] focus:border-transparent transition-all duration-200 text-sm" type="password" name="password" required autocomplete="current-password" placeholder="Masukkan password Anda" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs text-red-600" />
        </div>

        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-[#1A5D3F] shadow-sm focus:ring-[#1A5D3F] focus:ring-offset-0" name="remember">
                <span class="ms-2 text-xs text-gray-600">{{ __('Ingat saya') }}</span>
            </label>
            
            @if (Route::has('password.request'))
                <a class="text-xs text-[#1A5D3F] hover:text-[#DAB660] font-medium transition-colors" href="{{ route('password.request') }}">
                    {{ __('Lupa password?') }}
                </a>
            @endif
        </div>

        <div>
            <x-primary-button class="w-full justify-center bg-gradient-to-r from-[#1A5D3F] to-[#DAB660] hover:from-[#DAB660] hover:to-[#1A5D3F] text-white font-semibold py-2.5 px-4 rounded-lg transition-all duration-200 text-sm">
                <i class="fas fa-sign-in-alt mr-2"></i>
                {{ __('Masuk') }}
            </x-primary-button>
        </div>
    </form>

    <div class="mt-6 text-center space-y-3">
        <div class="relative">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-200"></div>
            </div>
            <div class="relative flex justify-center text-xs">
                <span class="px-3 bg-white text-gray-500">atau</span>
            </div>
        </div>
        
        <p class="text-xs text-gray-600">
            Belum punya akun? 
            <a href="{{ route('register') }}" class="text-[#1A5D3F] hover:text-[#DAB660] font-semibold transition-colors">
                Daftar sekarang
            </a>
        </p>
        
        <div>
            <a href="{{ url('/') }}" class="inline-flex items-center text-xs text-gray-500 hover:text-[#1A5D3F] transition-colors">
                <i class="fas fa-arrow-left mr-1"></i>
                Kembali ke Beranda
            </a>
        </div>
    </div>
</x-guest-layout>
