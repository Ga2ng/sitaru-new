@extends('layouts.app')

@section('title', 'User Management')
@section('subtitle', 'Kelola data pengguna sistem')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">
    <!-- Hero Section with Gradient -->
    <div class="relative overflow-hidden bg-gradient-to-br from-[#185B3C] via-[#0F3D26] to-[#185B3C] rounded-xl p-6 text-white">
        <div class="absolute inset-0 bg-black/10"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold mb-1">User Management</h1>
                    <p class="text-sm text-white/90 mb-4">Kelola data pengguna dan hak akses sistem dengan mudah dan efisien</p>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                            <span class="text-xs">Sistem Aktif</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-users text-xs"></i>
                            <span class="text-xs">{{ $totalUsers }} Total Users</span>
                        </div>
                    </div>
                </div>
                <div class="hidden lg:block">
                    <div class="w-20 h-20 bg-white/10 rounded-full flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-users text-3xl text-white/80"></i>
                    </div>
                </div>
            </div>
        </div>
        <!-- Decorative Elements -->
        <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -translate-y-16 translate-x-16"></div>
        <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full translate-y-12 -translate-x-12"></div>
    </div>

    <!-- Stats Cards with Glassmorphism -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="group relative overflow-hidden bg-white/80 backdrop-blur-sm rounded-xl p-4 shadow-lg border border-white/20 hover:shadow-xl transition-all duration-300">
            <div class="absolute inset-0 bg-gradient-to-br from-[#185B3C]/5 to-transparent"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-[#185B3C] to-[#0F3D26] rounded-lg flex items-center justify-center shadow-md">
                        <i class="fas fa-users text-white text-sm"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-2xl font-bold text-[#185B3C]">{{ $totalUsers }}</p>
                        <p class="text-xs text-gray-500">Total</p>
                    </div>
                </div>
                <h3 class="text-sm font-semibold text-gray-900 mb-1">Total Users</h3>
                <div class="flex items-center text-xs text-green-600">
                    <i class="fas fa-arrow-up mr-1"></i>
                    <span>+5% dari bulan lalu</span>
                </div>
            </div>
        </div>
        
        <div class="group relative overflow-hidden bg-white/80 backdrop-blur-sm rounded-xl p-4 shadow-lg border border-white/20 hover:shadow-xl transition-all duration-300">
            <div class="absolute inset-0 bg-gradient-to-br from-green-500/5 to-transparent"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-lg flex items-center justify-center shadow-md">
                        <i class="fas fa-check-circle text-white text-sm"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-2xl font-bold text-green-600">{{ $activeUsers }}</p>
                        <p class="text-xs text-gray-500">Aktif</p>
                    </div>
                </div>
                <h3 class="text-sm font-semibold text-gray-900 mb-1">Users Aktif</h3>
                <div class="flex items-center text-xs text-green-600">
                    <i class="fas fa-arrow-up mr-1"></i>
                    <span>+3% dari bulan lalu</span>
                </div>
            </div>
        </div>
        
        <div class="group relative overflow-hidden bg-white/80 backdrop-blur-sm rounded-xl p-4 shadow-lg border border-white/20 hover:shadow-xl transition-all duration-300">
            <div class="absolute inset-0 bg-gradient-to-br from-orange-500/5 to-transparent"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg flex items-center justify-center shadow-md">
                        <i class="fas fa-user-shield text-white text-sm"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-2xl font-bold text-orange-600">{{ $adminUsers }}</p>
                        <p class="text-xs text-gray-500">Admin</p>
                    </div>
                </div>
                <h3 class="text-sm font-semibold text-gray-900 mb-1">Admin Users</h3>
                <div class="flex items-center text-xs text-orange-600">
                    <i class="fas fa-shield-alt mr-1"></i>
                    <span>Hak akses penuh</span>
                </div>
            </div>
        </div>
        
        <div class="group relative overflow-hidden bg-white/80 backdrop-blur-sm rounded-xl p-4 shadow-lg border border-white/20 hover:shadow-xl transition-all duration-300">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-transparent"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center shadow-md">
                        <i class="fas fa-user-cog text-white text-sm"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-2xl font-bold text-blue-600">{{ $petugasUsers }}</p>
                        <p class="text-xs text-gray-500">Petugas</p>
                    </div>
                </div>
                <h3 class="text-sm font-semibold text-gray-900 mb-1">Petugas</h3>
                <div class="flex items-center text-xs text-blue-600">
                    <i class="fas fa-tools mr-1"></i>
                    <span>Staff operasional</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions with Modern Design -->
    <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h3 class="text-lg font-bold text-gray-900">Aksi Cepat</h3>
                <p class="text-sm text-gray-600">Pilih aksi yang ingin Anda lakukan</p>
            </div>
            <div class="w-8 h-8 bg-gradient-to-br from-[#185B3C] to-[#0F3D26] rounded-lg flex items-center justify-center">
                <i class="fas fa-bolt text-white text-sm"></i>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <a href="{{ route('admin.users.create') }}" class="group relative overflow-hidden bg-gradient-to-br from-[#185B3C] to-[#0F3D26] rounded-xl p-4 text-white hover:shadow-lg transition-all duration-300">
                <div class="absolute inset-0 bg-white/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <div class="relative z-10 text-center">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:scale-105 transition-transform">
                        <i class="fas fa-plus text-lg"></i>
                    </div>
                    <h4 class="font-semibold text-sm mb-1">Tambah User</h4>
                    <p class="text-xs text-white/80">Buat user baru</p>
                </div>
            </a>
            
            <button class="group relative overflow-hidden bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-4 text-white hover:shadow-lg transition-all duration-300">
                <div class="absolute inset-0 bg-white/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <div class="relative z-10 text-center">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:scale-105 transition-transform">
                        <i class="fas fa-user-shield text-lg"></i>
                    </div>
                    <h4 class="font-semibold text-sm mb-1">Kelola Role</h4>
                    <p class="text-xs text-white/80">Atur hak akses</p>
                </div>
            </button>
            
            <button class="group relative overflow-hidden bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl p-4 text-white hover:shadow-lg transition-all duration-300">
                <div class="absolute inset-0 bg-white/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <div class="relative z-10 text-center">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:scale-105 transition-transform">
                        <i class="fas fa-key text-lg"></i>
                    </div>
                    <h4 class="font-semibold text-sm mb-1">Reset Password</h4>
                    <p class="text-xs text-white/80">Reset password user</p>
                </div>
            </button>
            
            <button class="group relative overflow-hidden bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl p-4 text-white hover:shadow-lg transition-all duration-300">
                <div class="absolute inset-0 bg-white/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <div class="relative z-10 text-center">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:scale-105 transition-transform">
                        <i class="fas fa-download text-lg"></i>
                    </div>
                    <h4 class="font-semibold text-sm mb-1">Export Data</h4>
                    <p class="text-xs text-white/80">Download laporan</p>
                </div>
            </button>
        </div>
    </div>

    <!-- Modern Data Table -->
    <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg border border-white/20 overflow-hidden">
        <!-- Table Header -->
        <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-gradient-to-br from-[#185B3C] to-[#0F3D26] rounded-lg flex items-center justify-center">
                        <i class="fas fa-users text-white text-sm"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Daftar Users</h3>
                        <p class="text-sm text-gray-600">Kelola semua pengguna sistem</p>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="relative">
                        <input type="text" placeholder="Cari user..." class="pl-8 pr-3 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#185B3C] focus:border-transparent bg-white/80">
                        <i class="fas fa-search absolute left-2.5 top-2.5 text-gray-400 text-xs"></i>
                    </div>
                    <button class="flex items-center px-3 py-2 text-sm text-gray-600 hover:text-gray-900 hover:bg-white/80 rounded-lg transition-colors">
                        <i class="fas fa-filter mr-1 text-xs"></i>
                        Filter
                    </button>
                    <button class="flex items-center px-3 py-2 text-sm text-gray-600 hover:text-gray-900 hover:bg-white/80 rounded-lg transition-colors">
                        <i class="fas fa-sort mr-1 text-xs"></i>
                        Sort
                    </button>
                    <button class="p-2 text-gray-600 hover:text-gray-900 hover:bg-white/80 rounded-lg transition-colors">
                        <i class="fas fa-ellipsis-h text-xs"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Table Content -->
        <div class="overflow-hidden">
            <!-- Table Headers -->
            <div class="px-6 py-3 bg-gray-50/80 border-b border-gray-100">
                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-3">
                        <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">USER</span>
                    </div>
                    <div class="col-span-2">
                        <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">EMAIL</span>
                    </div>
                    <div class="col-span-2">
                        <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">ROLE</span>
                    </div>
                    <div class="col-span-2">
                        <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">STATUS</span>
                    </div>
                    <div class="col-span-1">
                        <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">AKTIF</span>
                    </div>
                    <div class="col-span-2">
                        <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">AKSI</span>
                    </div>
                </div>
            </div>

            <!-- Table Rows -->
            <div class="divide-y divide-gray-100">
                @forelse($users as $index => $user)
                <div class="px-6 py-4 hover:bg-gradient-to-r hover:from-[#185B3C]/5 hover:to-transparent transition-all duration-300 group">
                    <div class="grid grid-cols-12 gap-4 items-center">
                        <div class="col-span-3">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-gradient-to-br from-[#185B3C] to-[#0F3D26] rounded-xl flex items-center justify-center shadow-md group-hover:scale-105 transition-transform">
                                    <span class="text-white font-medium text-sm">{{ substr($user->name, 0, 1) }}</span>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900 text-sm">{{ $user->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $user->username }} • {{ $user->created_at->format('d M Y') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-2">
                            <p class="font-semibold text-gray-900 text-sm">{{ $user->email }}</p>
                            <p class="text-xs text-gray-500">{{ $user->phone ?? 'No phone' }}</p>
                        </div>
                        <div class="col-span-2">
                            <div class="flex flex-wrap gap-1">
                                @forelse($user->roles as $role)
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                        {{ $role->name }}
                                    </span>
                                @empty
                                    <span class="text-xs text-gray-500">No role</span>
                                @endforelse
                            </div>
                        </div>
                        <div class="col-span-2">
                            @if($user->active)
                                <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-gradient-to-r from-green-100 to-green-200 text-green-800 border border-green-300">
                                    <i class="fas fa-check-circle mr-1 text-xs"></i>
                                    Aktif
                                </span>
                            @else
                                <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-gradient-to-r from-red-100 to-red-200 text-red-800 border border-red-300">
                                    <i class="fas fa-times-circle mr-1 text-xs"></i>
                                    Nonaktif
                                </span>
                            @endif
                        </div>
                        <div class="col-span-1">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer" {{ $user->active ? 'checked' : '' }} 
                                       onchange="toggleUserStatus({{ $user->id }}, this.checked)">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                            </label>
                        </div>
                        <div class="col-span-2">
                            <div class="flex items-center space-x-1">
                                <a href="{{ route('admin.users.show', $user) }}" class="p-2 text-gray-400 hover:text-[#185B3C] hover:bg-[#185B3C]/10 rounded-lg transition-all duration-200 hover:scale-105" title="Lihat Detail">
                                    <i class="fas fa-eye text-xs"></i>
                                </a>
                                <a href="{{ route('admin.users.edit', $user) }}" class="p-2 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-200 hover:scale-105" title="Edit">
                                    <i class="fas fa-edit text-xs"></i>
                                </a>
                                <button onclick="resetPassword({{ $user->id }})" class="p-2 text-gray-400 hover:text-yellow-600 hover:bg-yellow-50 rounded-lg transition-all duration-200 hover:scale-105" title="Reset Password">
                                    <i class="fas fa-key text-xs"></i>
                                </button>
                                <button onclick="deleteUser({{ $user->id }})" class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all duration-200 hover:scale-105" title="Hapus">
                                    <i class="fas fa-trash text-xs"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="px-6 py-8 text-center">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-users text-gray-400 text-xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada user</h3>
                    <p class="text-gray-500 mb-4">Belum ada user yang terdaftar dalam sistem.</p>
                    <a href="{{ route('admin.users.create') }}" class="inline-flex items-center px-4 py-2 bg-[#185B3C] hover:bg-[#0F3D26] text-white text-sm font-medium rounded-lg transition-colors">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah User Pertama
                    </a>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Table Footer -->
        <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-gray-100 border-t border-gray-200">
            <div class="flex items-center justify-between">
                <p class="text-sm text-gray-600">Menampilkan <span class="font-semibold text-[#185B3C]">{{ $users->count() }}</span> dari <span class="font-semibold text-[#185B3C]">{{ $users->total() }}</span> users</p>
                <div class="flex items-center space-x-1">
                    {{ $users->links() }}
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
let currentUserId = null;

function resetPassword(id) {
    currentUserId = id;
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
                location.reload();
            }
        });
    }
}

function toggleUserStatus(id, checked) {
    $.ajax({
        url: `/admin/users/${id}/toggle-status`,
        type: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            id: id,
            value: checked ? 1 : 0
        },
        success: function(response) {
            showNotification('success', response.message);
        }
    });
}

$('#resetPasswordForm').on('submit', function(e) {
    e.preventDefault();
    
    $.ajax({
        url: `/admin/users/${currentUserId}/update-password`,
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
    currentUserId = null;
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

// Staggered animation for cards
document.addEventListener('DOMContentLoaded', function() {
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

    // Interactive hover effects for table rows
    const tableRows = document.querySelectorAll('.group');
    tableRows.forEach(row => {
        row.addEventListener('mouseenter', function() {
            this.style.transform = 'translateX(4px)';
        });
        
        row.addEventListener('mouseleave', function() {
            this.style.transform = 'translateX(0)';
        });
    });
});
</script>
@endpush