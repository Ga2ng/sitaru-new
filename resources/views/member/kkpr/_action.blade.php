<div class="flex items-center space-x-1">
    <a href="{{ route('member.kkpr.show', $model->id) }}" 
       class="p-2 text-gray-400 hover:text-[#185B3C] hover:bg-[#185B3C]/10 rounded-lg transition-all duration-200 hover:scale-105" 
       title="Lihat Detail">
        <i class="fas fa-eye text-xs"></i>
    </a>
    
    <a href="{{ route('member.kkpr.cetak.detail', $model->id) }}" 
       target="_blank"
       class="p-2 text-gray-400 hover:text-green-600 hover:bg-green-50 rounded-lg transition-all duration-200 hover:scale-105" 
       title="Cetak PDF">
        <i class="fas fa-file-pdf text-xs"></i>
    </a>
    
    <a href="{{ route('member.kkpr.edit', $model->id) }}" 
       class="p-2 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-200 hover:scale-105" 
       title="Edit">
        <i class="fas fa-edit text-xs"></i>
    </a>
    
    <button onclick="deleteData({{ $model->id }})" 
            class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all duration-200 hover:scale-105" 
            title="Hapus">
        <i class="fas fa-trash text-xs"></i>
    </button>
</div>

<script>
function deleteData(id) {
    if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
        $.ajax({
            url: '{{ route("member.kkpr.destroy", ":id") }}'.replace(':id', id),
            type: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.status === 'success') {
                    $('#datatable').DataTable().draw();
                    // Show success message
                    showNotification('Data berhasil dihapus', 'success');
                } else {
                    showNotification('Gagal menghapus data', 'error');
                }
            },
            error: function() {
                showNotification('Terjadi kesalahan', 'error');
            }
        });
    }
}

function showNotification(message, type) {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg transition-all duration-300 ${
        type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
    }`;
    notification.textContent = message;
    
    document.body.appendChild(notification);
    
    // Remove notification after 3 seconds
    setTimeout(() => {
        notification.remove();
    }, 3000);
}
</script>
