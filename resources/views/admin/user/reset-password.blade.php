@extends('layouts.app')

@section('title', 'Reset Password')
@section('subtitle', 'Ubah password pengguna')

@section('content')
<div class="max-w-md mx-auto">
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Reset Password</h3>
            <p class="text-sm text-gray-500">Ubah password untuk {{ $user->name }}</p>
        </div>
        
        <div class="p-6">
            <form id="resetPasswordForm" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
                    <input type="password" name="password" id="password" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                
                <div class="flex justify-end space-x-3 pt-4">
                    <a href="{{ route('admin.users.show', $user) }}" 
                       class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 hover:bg-gray-300 rounded-md transition-colors">
                        Batal
                    </a>
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
$('#resetPasswordForm').on('submit', function(e) {
    e.preventDefault();
    
    $.ajax({
        url: "{{ route('admin.users.update-password', $user) }}",
        type: 'PATCH',
        data: $(this).serialize(),
        success: function(response) {
            showNotification('success', response.message);
            setTimeout(() => {
                window.location.href = "{{ route('admin.users.show', $user) }}";
            }, 1500);
        },
        error: function(xhr) {
            const errors = xhr.responseJSON.errors;
            showNotification('error', Object.values(errors).flat().join(', '));
        }
    });
});

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
