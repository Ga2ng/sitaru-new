<x-guest-layout>
    <div class="text-center mb-6">
        {{-- <div class="w-12 h-12 bg-gradient-to-br from-[#1A5D3F] to-[#DAB660] rounded-xl flex items-center justify-center mx-auto mb-3">
            <i class="fas fa-shield-alt text-white text-lg"></i>
        </div> --}}
        <h2 class="text-2xl font-bold text-gray-900">Konfirmasi Password</h2>
        <p class="text-gray-600 text-sm mt-1">Masukkan password untuk melanjutkan</p>
    </div>

    <div class="mb-4 text-xs text-gray-600 bg-yellow-50 p-3 rounded-lg border border-yellow-200">
        <div class="flex items-start">
            <div class="flex-shrink-0">
                <i class="fas fa-exclamation-triangle text-yellow-500 text-sm mr-2"></i>
            </div>
            <p>{{ __('Ini adalah area aman dari aplikasi. Silakan konfirmasi password Anda sebelum melanjutkan.') }}</p>
        </div>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-4">
        @csrf

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

        <div>
            <x-primary-button class="w-full justify-center bg-gradient-to-r from-[#1A5D3F] to-[#DAB660] hover:from-[#DAB660] hover:to-[#1A5D3F] text-white font-semibold py-2.5 px-4 rounded-lg transition-all duration-200 text-sm">
                <i class="fas fa-check mr-2"></i>
                {{ __('Konfirmasi') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>