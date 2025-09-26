<x-guest-layout>
    <div class="text-center mb-6">
        {{-- <div class="w-12 h-12 bg-gradient-to-br from-[#1A5D3F] to-[#DAB660] rounded-xl flex items-center justify-center mx-auto mb-3">
            <i class="fas fa-envelope-open text-white text-lg"></i>
        </div> --}}
        <h2 class="text-2xl font-bold text-gray-900">Verifikasi Email</h2>
        <p class="text-gray-600 text-sm mt-1">Periksa email Anda untuk verifikasi akun</p>
    </div>

    <div class="mb-4 text-xs text-gray-600 bg-blue-50 p-3 rounded-lg border border-blue-200">
        <div class="flex items-start">
            <div class="flex-shrink-0">
                <i class="fas fa-info-circle text-blue-500 text-sm mr-2"></i>
            </div>
            <p>{{ __('Terima kasih telah mendaftar! Sebelum memulai, silakan verifikasi alamat email Anda dengan mengklik link yang baru saja kami kirimkan ke email Anda. Jika Anda tidak menerima email, kami akan dengan senang hati mengirimkan yang lain.') }}</p>
        </div>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 text-xs text-gray-600 bg-green-50 p-3 rounded-lg border border-green-200">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <i class="fas fa-check-circle text-green-500 text-sm mr-2"></i>
                </div>
                <p class="font-medium">{{ __('Link verifikasi baru telah dikirim ke alamat email yang Anda berikan saat pendaftaran.') }}</p>
            </div>
        </div>
    @endif

    <div class="space-y-3">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <x-primary-button class="w-full justify-center bg-gradient-to-r from-[#1A5D3F] to-[#DAB660] hover:from-[#DAB660] hover:to-[#1A5D3F] text-white font-semibold py-2.5 px-4 rounded-lg transition-all duration-200 text-sm">
                <i class="fas fa-paper-plane mr-2"></i>
                {{ __('Kirim Ulang Email Verifikasi') }}
            </x-primary-button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-center text-xs text-gray-600 hover:text-gray-900 py-2.5 px-4 border border-gray-300 rounded-lg hover:bg-gray-50 transition-all duration-200 font-medium">
                <i class="fas fa-sign-out-alt mr-2"></i>
                {{ __('Keluar') }}
            </button>
        </form>
    </div>
</x-guest-layout>