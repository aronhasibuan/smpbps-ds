<x-layout>
    <!-- Judul yang lebih deskriptif -->
    <h1 class="text-center text-2xl font-bold mb-8">Verifikasi Penyelesaian Tugas</h1>

    @if($completed_task->isEmpty())
        <div class="text-center py-8 bg-gray-100 rounded-lg">
            <p class="text-gray-600">Tidak ada tugas yang perlu diverifikasi saat ini</p>
        </div>
    @else
        <div class="space-y-4">
            @foreach ($completed_task as $task)
            <div class="border border-gray-300 p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h2 class="text-lg font-semibold">
                            {{ $task->user->user_full_name ?? 'N/A' }}
                            <span class="font-normal">telah menyelesaikan</span>
                            {{ $task->activity->activity_name ?? 'aktivitas' }}
                        </h2>
                        <p class="text-gray-600 mt-1">
                            Diselesaikan pada: 
                            @if($task->updated_at)
                                {{ \Carbon\Carbon::parse($task->updated_at)->format('d M Y H:i') }}
                            @else
                                Waktu tidak tersedia
                            @endif
                        </p>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row gap-3">
                        <button 
                            onclick="verifyTask({{ $task->id }}, 'approved')"
                            class="bg-green-600 hover:bg-green-700 text-white py-2 px-6 rounded-lg transition-colors">
                            Setuju
                        </button>
                        <button 
                            onclick="verifyTask({{ $task->id }}, 'rejected')"
                            class="bg-red-600 hover:bg-red-700 text-white py-2 px-6 rounded-lg transition-colors">
                            Tolak
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</x-layout>

<script>
    function verifyTask(taskId, action) {
        // Tambahkan logika AJAX atau form submission
        console.log(`Verifikasi task ${taskId} dengan aksi ${action}`);
        // Contoh fetch API:
        fetch(`/tasks/${taskId}/verify`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ action: action })
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            window.location.reload();
        })
        .catch(error => console.error('Error:', error));
    }
</script>