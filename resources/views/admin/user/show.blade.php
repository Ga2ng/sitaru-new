@extends('layouts.app')

@section('title', 'Detail User')
@section('subtitle', 'Informasi lengkap pengguna')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Detail User</h3>
                    <p class="text-sm text-gray-500">Informasi lengkap pengguna sistem</p>
                </div>
                <div class="flex space-x-2">
                    <a href="{{ route('admin.users.edit', $user) }}" 
                       class="inline-flex items-center px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md transition-colors">
                        <i class="fas fa-edit mr-2"></i>
                        Edit
                    </a>
                    <a href="{{ route('admin.users.index') }}" 
                       class="inline-flex items-center px-3 py-2 bg-gray-600 hover:bg-gray-700 text-white text-sm font-medium rounded-md transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali
                    </a>
                </div>
            </div>
        </div>
        
        <div class="p-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- User Info -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Basic Information -->
                    <div>
                        <h4 class="text-lg font-medium text-gray-900 mb-4">Informasi Dasar</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Nama Lengkap</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $user->name }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Username</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $user->username }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Email</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $user->email }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Telepon</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $user->phone ?? '-' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">NIP</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $user->nip ?? '-' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">NIK</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $user->nik ?? '-' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Pekerjaan</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $user->work ?? '-' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">KTP</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $user->ktp ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-500">Alamat</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $user->address ?? '-' }}</p>
                        </div>
                    </div>
                    
                    <!-- Role & Permission -->
                    <div>
                        <h4 class="text-lg font-medium text-gray-900 mb-4">Role & Permission</h4>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Role</label>
                                <div class="mt-1 flex flex-wrap gap-2">
                                    @forelse($user->roles as $role)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            {{ $role->name }}
                                        </span>
                                    @empty
                                        <span class="text-sm text-gray-500">Tidak ada role</span>
                                    @endforelse
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Permission</label>
                                <div class="mt-1 flex flex-wrap gap-2">
                                    @forelse($user->permissions as $permission)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            {{ $permission->name }}
                                        </span>
                                    @empty
                                        <span class="text-sm text-gray-500">Tidak ada permission</span>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Sidebar Info -->
                <div class="space-y-6">
                    <!-- Status Card -->
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h4 class="text-lg font-medium text-gray-900 mb-4">Status</h4>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-500">Status Akun</span>
                                @if($user->active)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle mr-1"></i>Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        <i class="fas fa-times-circle mr-1"></i>Nonaktif
                                    </span>
                                @endif
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-500">Dibuat</span>
                                <span class="text-sm text-gray-900">{{ $user->created_at->format('d M Y H:i') }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-500">Diperbarui</span>
                                <span class="text-sm text-gray-900">{{ $user->updated_at->format('d M Y H:i') }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Quick Actions -->
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h4 class="text-lg font-medium text-gray-900 mb-4">Aksi Cepat</h4>
                        <div class="space-y-2">
                            <button onclick="toggleUserStatus({{ $user->id }}, {{ $user->active ? 'false' : 'true' }})" 
                                    class="w-full text-left px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md transition-colors">
                                <i class="fas fa-power-off mr-2"></i>
                                {{ $user->active ? 'Nonaktifkan' : 'Aktifkan' }} User
                            </button>
                            <button onclick="resetPassword({{ $user->id }})" 
                                    class="w-full text-left px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md transition-colors">
                                <i class="fas fa-key mr-2"></i>
                                Reset Password
                            </button>
                            <button onclick="deleteUser({{ $user->id }})" 
                                    class="w-full text-left px-3 py-2 text-sm text-red-600 hover:bg-red-50 rounded-md transition-colors">
                                <i class="fas fa-trash mr-2"></i>
                                Hapus User
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Reset Password Modal -->
<div id="resetPasswordModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium text-gray-900">Reset Password</h3>
                <button onclick="closeResetModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <form id="resetPasswordForm" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
                    <input type="password" name="password" id="reset_password" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" id="reset_password_confirmation" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                
                <div class="flex justify-end space-x-3 pt-4">
                    <button type="button" onclick="closeResetModal()" 
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 hover:bg-gray-300 rounded-md transition-colors">
                        Batal
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 text-sm font-medium text-white bg-yellow-600 hover:bg-yellow-700 rounded-md transition-colors">
                        Reset Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function toggleUserStatus(id, checked) {
    if (confirm('Apakah Anda yakin ingin mengubah status user ini?')) {
        $.ajax({
            url: `/admin/users/${id}/toggle-status`,
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                id: id,
                value: checked ? 1 : 0
            },
            success: function(response) {
                location.reload();
            }
        });
    }
}

function resetPassword(id) {
    $('#resetPasswordForm')[0].reset();
    $('#resetPasswordModal').removeClass('hidden');
}

function deleteUser(id) {
    if (confirm('Apakah Anda yakin ingin menghapus user ini?')) {
        $.ajax({
            url: `/admin/users/${id}`,
            type: 'DELETE',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                window.location.href = '/admin/users';
            }
        });
    }
}

$('#resetPasswordForm').on('submit', function(e) {
    e.preventDefault();
    
    $.ajax({
        url: `/admin/users/{{ $user->id }}/update-password`,
        type: 'PATCH',
        data: $(this).serialize(),
        success: function(response) {
            closeResetModal();
            showNotification('success', response.message);
        },
        error: function(xhr) {
            const errors = xhr.responseJSON.errors;
            showNotification('error', Object.values(errors).flat().join(', '));
        }
    });
});

function closeResetModal() {
    $('#resetPasswordModal').addClass('hidden');
}

function showNotification(type, message) {
    const notification = $(`
        <div class="fixed top-4 right-4 p-4 rounded-md shadow-lg z-50 ${type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'}">
            ${message}
        </div>
    `);
    
    $('body').append(notification);
    
    setTimeout(() => {
        notification.fadeOut();
    }, 3000);
}
</script>
@endpush
