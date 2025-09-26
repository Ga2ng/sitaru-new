<x-guest-layout>
    <div class="text-center mb-6">
        <div class="w-12 h-12 bg-gradient-to-br from-[#1A5D3F] to-[#DAB660] rounded-xl flex items-center justify-center mx-auto mb-3">
            <i class="fas fa-key text-white text-lg"></i>
        </div>
        <h2 class="text-2xl font-bold text-gray-900">Lupa Password?</h2>
        <p class="text-gray-600 text-sm mt-1">Masukkan email Anda untuk mendapatkan link reset password</p>
    </div>

    <div class="mb-4 text-xs text-gray-600 bg-blue-50 p-3 rounded-lg border border-blue-200">
        {{ __('Tidak masalah! Masukkan alamat email Anda dan kami akan mengirimkan link reset password yang memungkinkan Anda memilih password baru.') }}
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" class="text-sm font-semibold text-gray-700 mb-1" />
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-envelope text-gray-400 text-sm"></i>
                </div>
                <x-text-input id="email" class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1A5D3F] focus:border-transparent transition-all duration-200 text-sm" type="email" name="email" :value="old('email')" required autofocus placeholder="Masukkan email Anda" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs text-red-600" />
        </div>

        <div>
            <x-primary-button class="w-full justify-center bg-gradient-to-r from-[#1A5D3F] to-[#DAB660] hover:from-[#DAB660] hover:to-[#1A5D3F] text-white font-semibold py-2.5 px-4 rounded-lg transition-all duration-200 text-sm">
                <i class="fas fa-paper-plane mr-2"></i>
                {{ __('Kirim Link Reset Password') }}
            </x-primary-button>
        </div>
    </form>

    <div class="mt-6 text-center">
        <a href="{{ route('login') }}" class="inline-flex items-center text-xs text-[#1A5D3F] hover:text-[#DAB660] font-medium transition-colors">
            <i class="fas fa-arrow-left mr-1"></i>
            Kembali ke halaman login
        </a>
    </div>
</x-guest-layout>
