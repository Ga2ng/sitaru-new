<div class="space-y-6">
    <!-- Warning Section -->
    <div class="p-6 bg-red-50 border border-red-200 rounded-xl">
        <div class="flex items-start space-x-4">
            <div class="flex-shrink-0">
                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-exclamation-triangle text-red-600 text-lg"></i>
                </div>
            </div>
            <div class="flex-1">
                <h3 class="text-lg font-bold text-red-900 mb-2">Hapus Akun Permanen</h3>
                <p class="text-sm text-red-800 mb-4">
                    {{ __('Setelah akun Anda dihapus, semua data dan sumber daya akan dihapus secara permanen. Sebelum menghapus akun, silakan unduh data atau informasi yang ingin Anda simpan.') }}
                </p>
                <div class="bg-red-100 border border-red-300 rounded-lg p-4">
                    <h4 class="text-sm font-semibold text-red-900 mb-2">Data yang akan dihapus:</h4>
                    <ul class="text-sm text-red-800 space-y-1">
                        <li class="flex items-center space-x-2">
                            <i class="fas fa-times text-xs"></i>
                            <span>Profil dan informasi pribadi</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <i class="fas fa-times text-xs"></i>
                            <span>Semua permohonan dan dokumen</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <i class="fas fa-times text-xs"></i>
                            <span>Riwayat aktivitas dan log</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <i class="fas fa-times text-xs"></i>
                            <span>Hak akses dan izin</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Button -->
    <div class="flex justify-center">
        <button
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
            class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-red-500 to-red-600 text-white font-bold rounded-xl hover:shadow-lg transform hover:scale-105 transition-all duration-200"
        >
            <i class="fas fa-trash-alt mr-3 text-lg"></i>
            {{ __('Hapus Akun Saya') }}
        </button>
    </div>

    <!-- Confirmation Modal -->
    <div 
        x-data="{ show: false }"
        x-show="show"
        x-on:open-modal.window="show = true"
        x-on:close.window="show = false"
        x-on:keydown.escape.window="show = false"
        class="fixed inset-0 z-50 overflow-y-auto"
        style="display: none;"
    >
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div 
                x-show="show"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                x-on:click="show = false"
            ></div>

            <!-- Modal panel -->
            <div 
                x-show="show"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="inline-block align-bottom bg-white rounded-2xl px-6 pt-6 pb-6 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
            >
                <form method="post" action="{{ route('profile.destroy') }}" class="space-y-6">
                    @csrf
                    @method('delete')

                    <!-- Modal Header -->
                    <div class="flex items-center space-x-4 mb-6">
                        <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-exclamation-triangle text-red-600 text-lg"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-gray-900">
                                {{ __('Konfirmasi Penghapusan Akun') }}
                            </h2>
                            <p class="text-sm text-gray-600">Tindakan ini tidak dapat dibatalkan</p>
                        </div>
                    </div>

                    <!-- Warning Message -->
                    <div class="p-4 bg-red-50 border border-red-200 rounded-xl">
                        <p class="text-sm text-red-800 font-medium">
                            {{ __('Apakah Anda yakin ingin menghapus akun Anda?') }}
                        </p>
                        <p class="text-sm text-red-700 mt-2">
                            {{ __('Setelah akun dihapus, semua data dan sumber daya akan dihapus secara permanen. Masukkan password Anda untuk mengonfirmasi penghapusan akun.') }}
                        </p>
                    </div>

                    <!-- Password Field -->
                    <div class="space-y-2">
                        <label for="password" class="block text-sm font-semibold text-gray-700">
                            <i class="fas fa-lock mr-2 text-red-600"></i>
                            {{ __('Password Konfirmasi') }}
                        </label>
                        <div class="relative">
                            <input
                                id="password"
                                name="password"
                                type="password"
                                class="w-full px-4 py-3 pr-12 border border-red-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200 bg-white"
                                placeholder="{{ __('Masukkan password Anda') }}"
                                required
                            />
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <i class="fas fa-eye text-gray-400 text-sm cursor-pointer" onclick="togglePassword('password')"></i>
                            </div>
                        </div>
                        @error('password', 'userDeletion')
                            <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                                <i class="fas fa-exclamation-circle text-xs"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                        <button 
                            type="button"
                            x-on:click="show = false"
                            class="px-6 py-3 text-gray-700 bg-gray-100 hover:bg-gray-200 font-semibold rounded-xl transition-colors duration-200"
                        >
                            <i class="fas fa-times mr-2 text-sm"></i>
                            {{ __('Batal') }}
                        </button>

                        <button 
                            type="submit"
                            class="px-6 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white font-bold rounded-xl hover:shadow-lg transform hover:scale-105 transition-all duration-200"
                        >
                            <i class="fas fa-trash-alt mr-2 text-sm"></i>
                            {{ __('Hapus Akun') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const icon = field.nextElementSibling.querySelector('i');
    
    if (field.type === 'password') {
        field.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        field.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}
</script>
