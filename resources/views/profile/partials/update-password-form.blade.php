<div class="space-y-6">
    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <!-- Current Password Field -->
        <div class="space-y-2">
            <label for="update_password_current_password" class="block text-sm font-semibold text-gray-700">
                <i class="fas fa-lock mr-2 text-[#185B3C]"></i>
                {{ __('Password Saat Ini') }}
            </label>
            <div class="relative">
                <input 
                    id="update_password_current_password" 
                    name="current_password" 
                    type="password" 
                    class="w-full px-4 py-3 pr-12 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                    autocomplete="current-password"
                    placeholder="Masukkan password saat ini"
                />
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                    <i class="fas fa-eye text-gray-400 text-sm cursor-pointer" onclick="togglePassword('update_password_current_password')"></i>
                </div>
            </div>
            @error('current_password', 'updatePassword')
                <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                    <i class="fas fa-exclamation-circle text-xs"></i>
                    <span>{{ $message }}</span>
                </div>
            @enderror
        </div>

        <!-- New Password Field -->
        <div class="space-y-2">
            <label for="update_password_password" class="block text-sm font-semibold text-gray-700">
                <i class="fas fa-key mr-2 text-[#185B3C]"></i>
                {{ __('Password Baru') }}
            </label>
            <div class="relative">
                <input 
                    id="update_password_password" 
                    name="password" 
                    type="password" 
                    class="w-full px-4 py-3 pr-12 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                    autocomplete="new-password"
                    placeholder="Masukkan password baru"
                />
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                    <i class="fas fa-eye text-gray-400 text-sm cursor-pointer" onclick="togglePassword('update_password_password')"></i>
                </div>
            </div>
            @error('password', 'updatePassword')
                <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                    <i class="fas fa-exclamation-circle text-xs"></i>
                    <span>{{ $message }}</span>
                </div>
            @enderror
            
            <!-- Password Strength Indicator -->
            <div class="mt-2">
                <div class="text-xs text-gray-500 mb-2">Kekuatan password:</div>
                <div class="flex space-x-1">
                    <div class="h-1 w-full bg-gray-200 rounded-full overflow-hidden">
                        <div id="password-strength" class="h-full transition-all duration-300" style="width: 0%"></div>
                    </div>
                </div>
                <div id="password-strength-text" class="text-xs text-gray-500 mt-1"></div>
            </div>
        </div>

        <!-- Confirm Password Field -->
        <div class="space-y-2">
            <label for="update_password_password_confirmation" class="block text-sm font-semibold text-gray-700">
                <i class="fas fa-check-double mr-2 text-[#185B3C]"></i>
                {{ __('Konfirmasi Password Baru') }}
            </label>
            <div class="relative">
                <input 
                    id="update_password_password_confirmation" 
                    name="password_confirmation" 
                    type="password" 
                    class="w-full px-4 py-3 pr-12 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                    autocomplete="new-password"
                    placeholder="Konfirmasi password baru"
                />
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                    <i class="fas fa-eye text-gray-400 text-sm cursor-pointer" onclick="togglePassword('update_password_password_confirmation')"></i>
                </div>
            </div>
            @error('password_confirmation', 'updatePassword')
                <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                    <i class="fas fa-exclamation-circle text-xs"></i>
                    <span>{{ $message }}</span>
                </div>
            @enderror
        </div>

        <!-- Password Requirements -->
        <div class="p-4 bg-blue-50 border border-blue-200 rounded-xl">
            <div class="flex items-start space-x-3">
                <div class="flex-shrink-0">
                    <i class="fas fa-info-circle text-blue-600 text-sm mt-0.5"></i>
                </div>
                <div class="flex-1">
                    <h4 class="text-sm font-semibold text-blue-800 mb-2">Persyaratan Password:</h4>
                    <ul class="text-sm text-blue-700 space-y-1">
                        <li class="flex items-center space-x-2">
                            <i class="fas fa-check text-xs"></i>
                            <span>Minimal 8 karakter</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <i class="fas fa-check text-xs"></i>
                            <span>Mengandung huruf besar dan kecil</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <i class="fas fa-check text-xs"></i>
                            <span>Mengandung angka dan simbol</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center justify-between pt-6 border-t border-gray-200">
            <div class="flex items-center space-x-4">
                <button 
                    type="submit" 
                    class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-semibold rounded-xl hover:shadow-lg transform hover:scale-105 transition-all duration-200"
                >
                    <i class="fas fa-save mr-2 text-sm"></i>
                    {{ __('Simpan Password') }}
                </button>

                @if (session('status') === 'password-updated')
                    <div 
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 3000)"
                        class="flex items-center space-x-2 text-green-600 text-sm font-medium"
                    >
                        <i class="fas fa-check-circle text-sm"></i>
                        <span>{{ __('Password berhasil diperbarui!') }}</span>
                    </div>
                @endif
            </div>
            
            <div class="text-sm text-gray-500">
                <i class="fas fa-shield-alt mr-1"></i>
                Password akan dienkripsi dengan aman
            </div>
        </div>
    </form>
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

// Password strength checker
document.getElementById('update_password_password').addEventListener('input', function() {
    const password = this.value;
    const strengthBar = document.getElementById('password-strength');
    const strengthText = document.getElementById('password-strength-text');
    
    let strength = 0;
    let strengthLabel = '';
    let strengthColor = '';
    
    if (password.length >= 8) strength += 20;
    if (/[a-z]/.test(password)) strength += 20;
    if (/[A-Z]/.test(password)) strength += 20;
    if (/[0-9]/.test(password)) strength += 20;
    if (/[^A-Za-z0-9]/.test(password)) strength += 20;
    
    if (strength < 40) {
        strengthLabel = 'Lemah';
        strengthColor = 'bg-red-500';
    } else if (strength < 80) {
        strengthLabel = 'Sedang';
        strengthColor = 'bg-yellow-500';
    } else {
        strengthLabel = 'Kuat';
        strengthColor = 'bg-green-500';
    }
    
    strengthBar.style.width = strength + '%';
    strengthBar.className = 'h-full transition-all duration-300 ' + strengthColor;
    strengthText.textContent = strengthLabel;
});
</script>
