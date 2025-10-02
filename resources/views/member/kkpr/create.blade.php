@extends('layouts.app')

@section('title', 'Buat Permohonan UMK')
@section('subtitle', 'Formulir Pengajuan Persetujuan UMK')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">
    <!-- Hero Section -->
    <div class="relative overflow-hidden bg-gradient-to-br from-[#185B3C] via-[#0F3D26] to-[#185B3C] rounded-xl p-6 text-white">
        <div class="absolute inset-0 bg-black/10"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold mb-1">Buat Permohonan UMK</h1>
                    <p class="text-sm text-white/90 mb-4">Isi formulir di bawah ini untuk mengajukan persetujuan UMK</p>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                            <span class="text-xs">Formulir Aktif</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-info-circle text-xs"></i>
                            <span class="text-xs">Lengkapi semua data</span>
                        </div>
                    </div>
                </div>
                <div class="hidden lg:block">
                    <div class="w-20 h-20 bg-white/10 rounded-full flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-file-alt text-3xl text-white/80"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Section -->
    <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg border border-white/20 overflow-hidden">
        <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 bg-gradient-to-br from-[#185B3C] to-[#0F3D26] rounded-lg flex items-center justify-center">
                    <i class="fas fa-edit text-white text-sm"></i>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Formulir Pengajuan</h3>
                    <p class="text-sm text-gray-600">Lengkapi semua data yang diperlukan</p>
                </div>
            </div>
        </div>

        <form action="{{ route('member.kkpr.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-8">
            @csrf
            
            <!-- Data Pemohon -->
            <div class="space-y-6">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-1 h-8 bg-gradient-to-b from-[#185B3C] to-[#DAAF49] rounded-full"></div>
                    <h4 class="text-lg font-semibold text-gray-900">Data Pemohon</h4>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                        <input type="text" value="{{ $user->name }}" readonly class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-50 text-gray-600">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" value="{{ $user->email }}" readonly class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-50 text-gray-600">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">No. HP</label>
                        <input type="text" value="{{ $user->phone }}" readonly class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-50 text-gray-600">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                        <input type="text" value="{{ $user->address }}" readonly class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-50 text-gray-600">
                    </div>
                </div>
            </div>

            <!-- Data Tanah -->
            <div class="space-y-6">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-1 h-8 bg-gradient-to-b from-[#185B3C] to-[#DAAF49] rounded-full"></div>
                    <h4 class="text-lg font-semibold text-gray-900">Data Tanah</h4>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Tanah <span class="text-red-500">*</span></label>
                        <textarea name="alamat_tanah" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#185B3C] focus:border-transparent" required></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Luas Tanah (m²) <span class="text-red-500">*</span></label>
                        <input type="number" name="luas" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#185B3C] focus:border-transparent" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kabupaten</label>
                        <select name="kabupaten_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#185B3C] focus:border-transparent">
                            <option value="">Pilih Kabupaten</option>
                            @foreach($kabupaten as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kecamatan</label>
                        <select name="kecamatan_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#185B3C] focus:border-transparent">
                            <option value="">Pilih Kecamatan</option>
                            @foreach($kecamatan as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kelurahan</label>
                        <select name="kelurahan_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#185B3C] focus:border-transparent">
                            <option value="">Pilih Kelurahan</option>
                            @foreach($kelurahan as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">RT/RW</label>
                        <div class="flex space-x-2">
                            <input type="text" name="rt" placeholder="RT" class="w-1/2 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#185B3C] focus:border-transparent">
                            <input type="text" name="rw" placeholder="RW" class="w-1/2 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#185B3C] focus:border-transparent">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Kegiatan -->
            <div class="space-y-6">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-1 h-8 bg-gradient-to-b from-[#185B3C] to-[#DAAF49] rounded-full"></div>
                    <h4 class="text-lg font-semibold text-gray-900">Data Kegiatan</h4>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kegiatan <span class="text-red-500">*</span></label>
                        <select name="jenis_kegiatan" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#185B3C] focus:border-transparent" required>
                            <option value="">Pilih Jenis Kegiatan</option>
                            <option value="perdagangan">Perdagangan</option>
                            <option value="industri">Industri</option>
                            <option value="jasa">Jasa</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Fungsi Bangunan <span class="text-red-500">*</span></label>
                        <input type="text" name="fungsi" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#185B3C] focus:border-transparent" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Kegiatan <span class="text-red-500">*</span></label>
                        <textarea name="alamat_kegiatan" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#185B3C] focus:border-transparent" required></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Luas Dimohon (m²) <span class="text-red-500">*</span></label>
                        <input type="number" name="luas_dimohon" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#185B3C] focus:border-transparent" required>
                    </div>
                </div>
            </div>

            <!-- Data Sertifikat -->
            <div class="space-y-6">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-1 h-8 bg-gradient-to-b from-[#185B3C] to-[#DAAF49] rounded-full"></div>
                    <h4 class="text-lg font-semibold text-gray-900">Data Sertifikat</h4>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Sertifikat</label>
                        <select name="jns_sertifikat" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#185B3C] focus:border-transparent">
                            <option value="">Pilih Jenis Sertifikat</option>
                            <option value="SHM">SHM (Sertifikat Hak Milik)</option>
                            <option value="SHGB">SHGB (Sertifikat Hak Guna Bangunan)</option>
                            <option value="HGB">HGB (Hak Guna Bangunan)</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">No. Sertifikat</label>
                        <input type="text" name="no_sertifikat" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#185B3C] focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Atas Nama</label>
                        <input type="text" name="an_sertifikat" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#185B3C] focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tahun Sertifikat</label>
                        <input type="number" name="thn_sertifikat" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#185B3C] focus:border-transparent">
                    </div>
                </div>
            </div>

            <!-- Koordinat -->
            <div class="space-y-6">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-1 h-8 bg-gradient-to-b from-[#185B3C] to-[#DAAF49] rounded-full"></div>
                    <h4 class="text-lg font-semibold text-gray-900">Koordinat Lokasi</h4>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Longitude</label>
                        <input type="text" name="longitude" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#185B3C] focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Latitude</label>
                        <input type="text" name="lattitude" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#185B3C] focus:border-transparent">
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                <a href="{{ route('member.kkpr.index') }}" class="px-6 py-2 text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2 bg-gradient-to-r from-[#185B3C] to-[#0F3D26] text-white rounded-lg hover:shadow-lg transition-all duration-300">
                    <i class="fas fa-save mr-2"></i>
                    Simpan Permohonan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Form validation and enhancement
    document.addEventListener('DOMContentLoaded', function() {
        // Add form validation
        const form = document.querySelector('form');
        form.addEventListener('submit', function(e) {
            const requiredFields = form.querySelectorAll('[required]');
            let isValid = true;
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    field.classList.add('border-red-500');
                    isValid = false;
                } else {
                    field.classList.remove('border-red-500');
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                alert('Mohon lengkapi semua field yang wajib diisi');
            }
        });
        
        // Remove error styling on input
        const inputs = form.querySelectorAll('input, textarea, select');
        inputs.forEach(input => {
            input.addEventListener('input', function() {
                this.classList.remove('border-red-500');
            });
        });
    });
</script>
@endsection
