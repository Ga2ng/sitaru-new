@extends('layouts.app')

@section('title', 'Tambah User')
@section('subtitle', 'Buat user baru dalam sistem')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg border border-white/20 overflow-hidden">
        <!-- Header -->
        <div class="px-6 py-4 bg-gradient-to-r from-[#185B3C] to-[#0F3D26] text-white">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                        <i class="fas fa-user-plus text-white text-sm"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold">Tambah User Baru</h3>
                        <p class="text-sm text-white/90">Buat akun pengguna baru dengan role dan permission</p>
                    </div>
                </div>
                <a href="{{ route('admin.users.index') }}" 
                   class="flex items-center px-3 py-2 bg-white/20 hover:bg-white/30 text-white text-sm font-medium rounded-lg transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali
                </a>
            </div>
        </div>
        
        <!-- Form -->
        <div class="p-6">
            <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <!-- Basic Information -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-user mr-2 text-[#185B3C]"></i>
                        Informasi Dasar
                    </h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" name="name" value="{{ old('name') }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent @error('name') border-red-500 @enderror">
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Username <span class="text-red-500">*</span></label>
                            <input type="text" name="username" value="{{ old('username') }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent @error('username') border-red-500 @enderror">
                            @error('username')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
                            <input type="email" name="email" value="{{ old('email') }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent @error('email') border-red-500 @enderror">
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Telepon</label>
                            <input type="text" name="phone" value="{{ old('phone') }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent @error('phone') border-red-500 @enderror">
                            @error('phone')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <!-- Additional Information -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-info-circle mr-2 text-[#185B3C]"></i>
                        Informasi Tambahan
                    </h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">NIP</label>
                            <input type="text" name="nip" value="{{ old('nip') }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent @error('nip') border-red-500 @enderror">
                            @error('nip')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">NIK</label>
                            <input type="text" name="nik" value="{{ old('nik') }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent @error('nik') border-red-500 @enderror">
                            @error('nik')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pekerjaan</label>
                        <input type="text" name="work" value="{{ old('work') }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent @error('work') border-red-500 @enderror">
                        @error('work')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                        <textarea name="address" rows="3" 
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent @error('address') border-red-500 @enderror">{{ old('address') }}</textarea>
                        @error('address')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">KTP</label>
                        <input type="text" name="ktp" value="{{ old('ktp') }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent @error('ktp') border-red-500 @enderror">
                        @error('ktp')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <!-- Security -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-shield-alt mr-2 text-[#185B3C]"></i>
                        Keamanan & Akses
                    </h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Password <span class="text-red-500">*</span></label>
                            <input type="password" name="password" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent @error('password') border-red-500 @enderror">
                            @error('password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password <span class="text-red-500">*</span></label>
                            <input type="password" name="password_confirmation" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent">
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Role <span class="text-red-500">*</span></label>
                        <select name="role_id" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent @error('role_id') border-red-500 @enderror">
                            <option value="">Pilih Role</option>
                            @foreach($roles as $id => $name)
                                <option value="{{ $id }}" {{ old('role_id') == $id ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                        @error('role_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Permission</label>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-2 max-h-32 overflow-y-auto border border-gray-300 rounded-md p-3">
                            @foreach($permissions as $id => $name)
                                <label class="flex items-center">
                                    <input type="checkbox" name="permission_lists[]" value="{{ $id }}" 
                                           {{ in_array($id, old('permission_lists', [])) ? 'checked' : '' }}
                                           class="rounded border-gray-300 text-[#185B3C] focus:ring-[#185B3C]">
                                    <span class="ml-2 text-sm text-gray-700">{{ $name }}</span>
                                </label>
                            @endforeach
                        </div>
                        @error('permission_lists')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <!-- Actions -->
                <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.users.index') }}" 
                       class="px-6 py-2 text-sm font-medium text-gray-700 bg-gray-200 hover:bg-gray-300 rounded-lg transition-colors">
                        Batal
                    </a>
                    <button type="submit" 
                            class="px-6 py-2 text-sm font-medium text-white bg-[#185B3C] hover:bg-[#0F3D26] rounded-lg transition-colors">
                        <i class="fas fa-save mr-2"></i>
                        Simpan User
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
