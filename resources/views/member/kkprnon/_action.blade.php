<div class="flex items-center space-x-1">
    <a href="{{ route('member.kkprnon.show', $model->id) }}" 
       class="p-2 text-gray-400 hover:text-[#185B3C] hover:bg-[#185B3C]/10 rounded-lg transition-all duration-200 hover:scale-105" 
       title="Lihat Detail">
        <i class="fas fa-eye text-xs"></i>
    </a>
    
    <a href="{{ route('member.kkprnon.cetak.detail', $model->id) }}" 
       target="_blank"
       class="p-2 text-gray-400 hover:text-green-600 hover:bg-green-50 rounded-lg transition-all duration-200 hover:scale-105" 
       title="Cetak PDF">
        <i class="fas fa-file-pdf text-xs"></i>
    </a>
    
    <a href="{{ route('member.kkprnon.edit', $model->id) }}" 
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
        fetch(`/member/kkprnon/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Gagal menghapus data: ' + data.error);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menghapus data');
        });
    }
}
</script>
