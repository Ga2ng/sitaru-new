<div class="space-y-6">
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <!-- Personal Information Section -->
        <div class="space-y-6">
            <div class="flex items-center space-x-3 mb-4">
                <div class="w-8 h-8 bg-gradient-to-br from-[#185B3C] to-[#0F3D26] rounded-lg flex items-center justify-center">
                    <i class="fas fa-user text-white text-sm"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900">Informasi Pribadi</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name Field -->
                <div class="space-y-2">
                    <label for="name" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-user mr-2 text-[#185B3C]"></i>
                        {{ __('Nama Lengkap') }} <span class="text-red-500">*</span>
                    </label>
                    <input 
                        id="name" 
                        name="name" 
                        type="text" 
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                        value="{{ old('name', $user->name) }}" 
                        required 
                        autofocus 
                        autocomplete="name"
                        placeholder="Masukkan nama lengkap Anda"
                    />
                    @error('name')
                        <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                            <i class="fas fa-exclamation-circle text-xs"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <!-- Username Field -->
                <div class="space-y-2">
                    <label for="username" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-at mr-2 text-[#185B3C]"></i>
                        {{ __('Username') }}
                    </label>
                    <input 
                        id="username" 
                        name="username" 
                        type="text" 
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                        value="{{ old('username', $user->username) }}" 
                        autocomplete="username"
                        placeholder="Masukkan username Anda"
                    />
                    @error('username')
                        <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                            <i class="fas fa-exclamation-circle text-xs"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>
            </div>

            <!-- Email Field -->
            <div class="space-y-2">
                <label for="email" class="block text-sm font-semibold text-gray-700">
                    <i class="fas fa-envelope mr-2 text-[#185B3C]"></i>
                    {{ __('Alamat Email') }} <span class="text-red-500">*</span>
                </label>
                <input 
                    id="email" 
                    name="email" 
                    type="email" 
                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                    value="{{ old('email', $user->email) }}" 
                    required 
                    autocomplete="username"
                    placeholder="Masukkan alamat email Anda"
                />
                @error('email')
                    <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                        <i class="fas fa-exclamation-circle text-xs"></i>
                        <span>{{ $message }}</span>
                    </div>
                @enderror

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="mt-3 p-4 bg-yellow-50 border border-yellow-200 rounded-xl">
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-triangle text-yellow-600 text-sm mt-0.5"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-yellow-800 font-medium">
                                    {{ __('Alamat email Anda belum diverifikasi.') }}
                                </p>
                                <p class="text-sm text-yellow-700 mt-1">
                                    {{ __('Klik tombol di bawah untuk mengirim ulang email verifikasi.') }}
                                </p>
                                <button 
                                    form="send-verification" 
                                    class="mt-2 inline-flex items-center px-3 py-2 text-sm font-medium text-yellow-800 bg-yellow-100 hover:bg-yellow-200 rounded-lg transition-colors duration-200"
                                >
                                    <i class="fas fa-paper-plane mr-2 text-xs"></i>
                                    {{ __('Kirim Ulang Email Verifikasi') }}
                                </button>
                            </div>
                        </div>

                        @if (session('status') === 'verification-link-sent')
                            <div class="mt-3 p-3 bg-green-50 border border-green-200 rounded-lg">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-check-circle text-green-600 text-sm"></i>
                                    <p class="text-sm font-medium text-green-800">
                                        {{ __('Link verifikasi baru telah dikirim ke alamat email Anda.') }}
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        <!-- Contact Information Section -->
        <div class="space-y-6">
            <div class="flex items-center space-x-3 mb-4">
                <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-phone text-white text-sm"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900">Informasi Kontak</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Phone Field -->
                <div class="space-y-2">
                    <label for="phone" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-phone mr-2 text-blue-600"></i>
                        {{ __('Nomor Telepon') }}
                    </label>
                    <input 
                        id="phone" 
                        name="phone" 
                        type="tel" 
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                        value="{{ old('phone', $user->phone) }}" 
                        autocomplete="tel"
                        placeholder="Masukkan nomor telepon Anda"
                    />
                    @error('phone')
                        <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                            <i class="fas fa-exclamation-circle text-xs"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <!-- Age Field -->
                <div class="space-y-2">
                    <label for="age" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-birthday-cake mr-2 text-blue-600"></i>
                        {{ __('Usia') }}
                    </label>
                    <input 
                        id="age" 
                        name="age" 
                        type="number" 
                        min="1" 
                        max="120"
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                        value="{{ old('age', $user->age) }}" 
                        placeholder="Masukkan usia Anda"
                    />
                    @error('age')
                        <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                            <i class="fas fa-exclamation-circle text-xs"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>
            </div>

            <!-- Work Field -->
            <div class="space-y-2">
                <label for="work" class="block text-sm font-semibold text-gray-700">
                    <i class="fas fa-briefcase mr-2 text-blue-600"></i>
                    {{ __('Pekerjaan') }}
                </label>
                <input 
                    id="work" 
                    name="work" 
                    type="text" 
                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                    value="{{ old('work', $user->work) }}" 
                    placeholder="Masukkan pekerjaan Anda"
                />
                @error('work')
                    <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                        <i class="fas fa-exclamation-circle text-xs"></i>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>

            <!-- Address Field -->
            <div class="space-y-2">
                <label for="address" class="block text-sm font-semibold text-gray-700">
                    <i class="fas fa-map-marker-alt mr-2 text-blue-600"></i>
                    {{ __('Alamat') }}
                </label>
                <textarea 
                    id="address" 
                    name="address" 
                    rows="3"
                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm resize-none" 
                    placeholder="Masukkan alamat lengkap Anda"
                >{{ old('address', $user->address) }}</textarea>
                @error('address')
                    <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                        <i class="fas fa-exclamation-circle text-xs"></i>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>
        </div>

        <!-- Identity Information Section -->
        <div class="space-y-6">
            <div class="flex items-center space-x-3 mb-4">
                <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-id-card text-white text-sm"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900">Informasi Identitas</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- NIK Field -->
                <div class="space-y-2">
                    <label for="nik" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-id-card mr-2 text-purple-600"></i>
                        {{ __('NIK') }}
                    </label>
                    <input 
                        id="nik" 
                        name="nik" 
                        type="text" 
                        maxlength="16"
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                        value="{{ old('nik', $user->nik) }}" 
                        placeholder="Masukkan NIK Anda"
                    />
                    @error('nik')
                        <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                            <i class="fas fa-exclamation-circle text-xs"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <!-- KTP Field -->
                <div class="space-y-2">
                    <label for="ktp" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-credit-card mr-2 text-purple-600"></i>
                        {{ __('No. KTP') }}
                    </label>
                    <input 
                        id="ktp" 
                        name="ktp" 
                        type="text" 
                        maxlength="16"
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                        value="{{ old('ktp', $user->ktp) }}" 
                        placeholder="Masukkan nomor KTP Anda"
                    />
                    @error('ktp')
                        <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                            <i class="fas fa-exclamation-circle text-xs"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- NPWP Field -->
                <div class="space-y-2">
                    <label for="npwp" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-file-invoice mr-2 text-purple-600"></i>
                        {{ __('NPWP') }}
                    </label>
                    <input 
                        id="npwp" 
                        name="npwp" 
                        type="text" 
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                        value="{{ old('npwp', $user->npwp) }}" 
                        placeholder="Masukkan NPWP Anda"
                    />
                    @error('npwp')
                        <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                            <i class="fas fa-exclamation-circle text-xs"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <!-- NIP Field -->
                <div class="space-y-2">
                    <label for="nip" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-badge mr-2 text-purple-600"></i>
                        {{ __('NIP') }}
                    </label>
                    <input 
                        id="nip" 
                        name="nip" 
                        type="text" 
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                        value="{{ old('nip', $user->nip) }}" 
                        placeholder="Masukkan NIP Anda"
                    />
                    @error('nip')
                        <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                            <i class="fas fa-exclamation-circle text-xs"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>
            </div>

            <!-- KTP Status Fields -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="status_ktp" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-check-circle mr-2 text-purple-600"></i>
                        {{ __('Status KTP') }}
                    </label>
                    <select 
                        id="status_ktp" 
                        name="status_ktp" 
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm"
                    >
                        <option value="">Pilih Status KTP</option>
                        <option value="Valid" {{ old('status_ktp', $user->status_ktp) == 'Valid' ? 'selected' : '' }}>Valid</option>
                        <option value="Tidak Valid" {{ old('status_ktp', $user->status_ktp) == 'Tidak Valid' ? 'selected' : '' }}>Tidak Valid</option>
                        <option value="Belum Verifikasi" {{ old('status_ktp', $user->status_ktp) == 'Belum Verifikasi' ? 'selected' : '' }}>Belum Verifikasi</option>
                    </select>
                    @error('status_ktp')
                        <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                            <i class="fas fa-exclamation-circle text-xs"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="ket_ktp" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-comment mr-2 text-purple-600"></i>
                        {{ __('Keterangan KTP') }}
                    </label>
                    <input 
                        id="ket_ktp" 
                        name="ket_ktp" 
                        type="text" 
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                        value="{{ old('ket_ktp', $user->ket_ktp) }}" 
                        placeholder="Masukkan keterangan KTP"
                    />
                    @error('ket_ktp')
                        <div class="flex items-center space-x-2 text-red-600 text-sm mt-1">
                            <i class="fas fa-exclamation-circle text-xs"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center justify-between pt-6 border-t border-gray-200">
            <div class="flex items-center space-x-4">
                <button 
                    type="submit" 
                    class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-[#185B3C] to-[#0F3D26] text-white font-semibold rounded-xl hover:shadow-lg transform hover:scale-105 transition-all duration-200"
                >
                    <i class="fas fa-save mr-2 text-sm"></i>
                    {{ __('Simpan Perubahan') }}
                </button>

                @if (session('status') === 'profile-updated')
                    <div 
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 3000)"
                        class="flex items-center space-x-2 text-green-600 text-sm font-medium"
                    >
                        <i class="fas fa-check-circle text-sm"></i>
                        <span>{{ __('Berhasil disimpan!') }}</span>
                    </div>
                @endif
            </div>
            
            <div class="text-sm text-gray-500">
                <i class="fas fa-info-circle mr-1"></i>
                Perubahan akan disimpan secara otomatis
            </div>
        </div>
    </form>
</div>
