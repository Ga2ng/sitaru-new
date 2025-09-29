@extends('layouts.app')

@section('title', 'Pengaturan Website')
@section('subtitle', 'Kelola pengaturan umum website')

@section('content')
<div class="max-w-6xl mx-auto space-y-6">
    <!-- Hero Section with Gradient -->
    <div class="relative overflow-hidden bg-gradient-to-br from-[#185B3C] via-[#0F3D26] to-[#185B3C] rounded-xl p-6 text-white">
        <div class="absolute inset-0 bg-black/10"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold mb-1">Pengaturan Website</h1>
                    <p class="text-sm text-white/90 mb-4">Kelola pengaturan umum website dan konfigurasi sistem</p>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                            <span class="text-xs">Form Aktif</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-cog text-xs"></i>
                            <span class="text-xs">Konfigurasi</span>
                        </div>
                    </div>
                </div>
                <div class="hidden lg:block">
                    <div class="w-20 h-20 bg-white/10 rounded-full flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-cog text-3xl text-white/80"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -translate-y-16 translate-x-16"></div>
        <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full translate-y-12 -translate-x-12"></div>
    </div>

    <!-- Settings Form -->
    <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Informasi Website -->
        <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
            <div class="flex items-center space-x-3 mb-6">
                <div class="w-10 h-10 bg-gradient-to-br from-[#185B3C] to-[#0F3D26] rounded-lg flex items-center justify-center shadow-md">
                    <i class="fas fa-info-circle text-white text-sm"></i>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Informasi Website</h3>
                    <p class="text-sm text-gray-600">Pengaturan dasar website</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div>
                        <label for="site_name" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Website <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="site_name" 
                               name="site_name" 
                               value="{{ old('site_name', $setting->site_name) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#185B3C] focus:border-transparent transition-colors @error('site_name') border-red-500 @enderror"
                               placeholder="Nama Website"
                               required>
                        @error('site_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" 
                               id="email" 
                               name="email" 
                               value="{{ old('email', $setting->email) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#185B3C] focus:border-transparent transition-colors @error('email') border-red-500 @enderror"
                               placeholder="email@website.com"
                               required>
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="m_keyword" class="block text-sm font-medium text-gray-700 mb-2">
                            Kata Kunci <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="m_keyword" 
                               name="m_keyword" 
                               value="{{ old('m_keyword', $setting->m_keyword) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#185B3C] focus:border-transparent transition-colors @error('m_keyword') border-red-500 @enderror"
                               placeholder="key1, key2, key3"
                               required>
                        <p class="mt-1 text-xs text-gray-500">Pisahkan dengan tanda koma (,)</p>
                        @error('m_keyword')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <label for="m_desc" class="block text-sm font-medium text-gray-700 mb-2">
                            Meta Deskripsi <span class="text-red-500">*</span>
                        </label>
                        <textarea id="m_desc" 
                                  name="m_desc" 
                                  rows="3"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#185B3C] focus:border-transparent transition-colors @error('m_desc') border-red-500 @enderror"
                                  placeholder="Meta deskripsi website"
                                  required>{{ old('m_desc', $setting->m_desc) }}</textarea>
                        <p class="mt-1 text-xs text-gray-500">Deskripsi singkat tentang aplikasi</p>
                        @error('m_desc')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                            Phone <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="phone" 
                               name="phone" 
                               value="{{ old('phone', $setting->phone) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#185B3C] focus:border-transparent transition-colors @error('phone') border-red-500 @enderror"
                               placeholder="(0333) 123-456"
                               required>
                        @error('phone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Kontak & Alamat Perusahaan -->
        <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
            <div class="flex items-center space-x-3 mb-6">
                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center shadow-md">
                    <i class="fas fa-map-marker-alt text-white text-sm"></i>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Kontak & Alamat Perusahaan</h3>
                    <p class="text-sm text-gray-600">Informasi kontak dan lokasi</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-2">
                            Alamat <span class="text-red-500">*</span>
                        </label>
                        <textarea id="address" 
                                  name="address" 
                                  rows="3"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#185B3C] focus:border-transparent transition-colors @error('address') border-red-500 @enderror"
                                  placeholder="Jl. Nama Jalan"
                                  required>{{ old('address', $setting->address) }}</textarea>
                        @error('address')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="kelurahan" class="block text-sm font-medium text-gray-700 mb-2">
                                Kelurahan <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="kelurahan" 
                                   name="kelurahan" 
                                   value="{{ old('kelurahan', $setting->kelurahan) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#185B3C] focus:border-transparent transition-colors @error('kelurahan') border-red-500 @enderror"
                                   placeholder="Kelurahan"
                                   required>
                            @error('kelurahan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="kecamatan" class="block text-sm font-medium text-gray-700 mb-2">
                                Kecamatan <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="kecamatan" 
                                   name="kecamatan" 
                                   value="{{ old('kecamatan', $setting->kecamatan) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#185B3C] focus:border-transparent transition-colors @error('kecamatan') border-red-500 @enderror"
                                   placeholder="Kecamatan"
                                   required>
                            @error('kecamatan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="kabupaten" class="block text-sm font-medium text-gray-700 mb-2">
                            Kabupaten <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="kabupaten" 
                               name="kabupaten" 
                               value="{{ old('kabupaten', $setting->kabupaten) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#185B3C] focus:border-transparent transition-colors @error('kabupaten') border-red-500 @enderror"
                               placeholder="Kabupaten"
                               required>
                        @error('kabupaten')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <label for="poscode" class="block text-sm font-medium text-gray-700 mb-2">
                            Kode Pos <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="poscode" 
                               name="poscode" 
                               value="{{ old('poscode', $setting->poscode) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#185B3C] focus:border-transparent transition-colors @error('poscode') border-red-500 @enderror"
                               placeholder="68123"
                               required>
                        @error('poscode')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="lat" class="block text-sm font-medium text-gray-700 mb-2">
                                Latitude <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="lat" 
                                   name="lat" 
                                   value="{{ old('lat', $setting->lat) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#185B3C] focus:border-transparent transition-colors @error('lat') border-red-500 @enderror"
                                   placeholder="-8.2131639"
                                   required>
                            <p class="mt-1 text-xs text-gray-500">Latitude Google Map</p>
                            @error('lat')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="lang" class="block text-sm font-medium text-gray-700 mb-2">
                                Longitude <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="lang" 
                                   name="lang" 
                                   value="{{ old('lang', $setting->lang) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#185B3C] focus:border-transparent transition-colors @error('lang') border-red-500 @enderror"
                                   placeholder="114.3477306"
                                   required>
                            <p class="mt-1 text-xs text-gray-500">Longitude Google Map</p>
                            @error('lang')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="place_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Place ID <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="place_id" 
                               name="place_id" 
                               value="{{ old('place_id', $setting->place_id) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#185B3C] focus:border-transparent transition-colors @error('place_id') border-red-500 @enderror"
                               placeholder="ChIJAUlhhU9F0S0RNLSrCpmrgP8"
                               required>
                        <p class="mt-1 text-xs text-gray-500">Place ID Google Map</p>
                        @error('place_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Add On Website -->
        <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
            <div class="flex items-center space-x-3 mb-6">
                <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg flex items-center justify-center shadow-md">
                    <i class="fas fa-puzzle-piece text-white text-sm"></i>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Add On Website</h3>
                    <p class="text-sm text-gray-600">Aktifkan atau nonaktifkan fitur website</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3">Berita</label>
                        <div class="flex space-x-4">
                            <label class="flex items-center">
                                <input type="radio" 
                                       name="berita" 
                                       value="1" 
                                       {{ old('berita', $setting->berita) == '1' ? 'checked' : '' }}
                                       class="w-4 h-4 text-[#185B3C] bg-gray-100 border-gray-300 focus:ring-[#185B3C] focus:ring-2">
                                <span class="ml-2 text-sm text-gray-700">Enable</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" 
                                       name="berita" 
                                       value="0" 
                                       {{ old('berita', $setting->berita) == '0' ? 'checked' : '' }}
                                       class="w-4 h-4 text-[#185B3C] bg-gray-100 border-gray-300 focus:ring-[#185B3C] focus:ring-2">
                                <span class="ml-2 text-sm text-gray-700">Disable</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3">Informasi AP</label>
                        <div class="flex space-x-4">
                            <label class="flex items-center">
                                <input type="radio" 
                                       name="home_info" 
                                       value="1" 
                                       {{ old('home_info', $setting->home_info) == '1' ? 'checked' : '' }}
                                       class="w-4 h-4 text-[#185B3C] bg-gray-100 border-gray-300 focus:ring-[#185B3C] focus:ring-2">
                                <span class="ml-2 text-sm text-gray-700">Enable</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" 
                                       name="home_info" 
                                       value="0" 
                                       {{ old('home_info', $setting->home_info) == '0' ? 'checked' : '' }}
                                       class="w-4 h-4 text-[#185B3C] bg-gray-100 border-gray-300 focus:ring-[#185B3C] focus:ring-2">
                                <span class="ml-2 text-sm text-gray-700">Disable</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3">News Letter</label>
                        <div class="flex space-x-4">
                            <label class="flex items-center">
                                <input type="radio" 
                                       name="newsletter" 
                                       value="1" 
                                       {{ old('newsletter', $setting->newsletter) == '1' ? 'checked' : '' }}
                                       class="w-4 h-4 text-[#185B3C] bg-gray-100 border-gray-300 focus:ring-[#185B3C] focus:ring-2">
                                <span class="ml-2 text-sm text-gray-700">Enable</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" 
                                       name="newsletter" 
                                       value="0" 
                                       {{ old('newsletter', $setting->newsletter) == '0' ? 'checked' : '' }}
                                       class="w-4 h-4 text-[#185B3C] bg-gray-100 border-gray-300 focus:ring-[#185B3C] focus:ring-2">
                                <span class="ml-2 text-sm text-gray-700">Disable</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Website -->
        <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
            <div class="flex items-center space-x-3 mb-6">
                <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg flex items-center justify-center shadow-md">
                    <i class="fas fa-align-center text-white text-sm"></i>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Footer Website</h3>
                    <p class="text-sm text-gray-600">Konten footer website</p>
                </div>
            </div>

            <div>
                <label for="footer" class="block text-sm font-medium text-gray-700 mb-2">
                    Footer Content
                </label>
                <textarea id="footer" 
                          name="footer" 
                          rows="6"
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#185B3C] focus:border-transparent transition-colors @error('footer') border-red-500 @enderror tinymce-editor"
                          placeholder="Masukkan konten footer...">{{ old('footer', $setting->footer) }}</textarea>
                @error('footer')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Submit Button -->
        <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
            <div class="flex items-center justify-end">
                <button type="submit" 
                        class="px-8 py-3 text-sm font-medium text-white bg-[#185B3C] rounded-lg hover:bg-[#0F3D26] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#185B3C] transition-colors shadow-md">
                    <i class="fas fa-save mr-2"></i>
                    Simpan Pengaturan
                </button>
            </div>
        </div>
    </form>
</div>

<!-- TinyMCE CDN (No API Key Required) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.7.2/tinymce.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize TinyMCE
        tinymce.init({
            selector: '.tinymce-editor',
            height: 300,
            menubar: false,
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', 'media', 'table', 'help', 'wordcount'
            ],
            toolbar: 'undo redo | blocks | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
            content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; font-size: 14px; }',
            branding: false,
            promotion: false,
            setup: function (editor) {
                editor.on('change', function () {
                    editor.save();
                });
            }
        });

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
