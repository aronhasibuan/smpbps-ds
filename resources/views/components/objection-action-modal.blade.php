<div id="approveObjectionModal-{{ $objection->id }}" class="fixed inset-0 hidden items-center justify-center bg-black bg-opacity-50 z-50 backdrop-blur-sm transition-opacity duration-300">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl p-6 w-96 relative transform transition-all duration-300 scale-95 opacity-0 modal-content">
        <!-- Close Button (X) -->
        <button 
            type="button" 
            onclick="closeObjectionModal({{ $objection->id }})"
            class="absolute top-4 right-4 text-gray-400 hover:text-red-500 text-2xl font-bold transition-colors duration-200"
        >
            &times;
        </button>

        <!-- Header -->
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-2">Sanggahan Tugas</h2>
            <div class="w-12 h-1 bg-blue-500 rounded-full"></div>
        </div>

        <!-- Task Details -->
        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 mb-6 space-y-3">
            <p class="flex items-center text-sm text-gray-700 dark:text-gray-300">
                <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
                <span class="font-medium">Kegiatan: </span> {{ $objection->task->activity->activity_name }}
            </p>
            <p class="flex items-center text-sm text-gray-700 dark:text-gray-300">
                <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                <span class="font-medium">Anggota Tim: </span> {{ $objection->task->user->user_full_name }}
            </p>
            <p class="flex items-center text-sm text-gray-700 dark:text-gray-300">
                <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                <span class="font-medium">Progress Saat Ini: </span> {{ $objection->task->task_latest_progress }} dari {{ $objection->task->task_volume }}
            </p>
        </div>
        
        <!-- Volume Update Form -->
        <form action="{{ route('update-task-volume-from-objection', $objection->id) }}" method="POST" class="mb-6">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="newVolume-{{ $objection->task->id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Ubah Volume Pekerjaan
                </label>
                <div class="relative">
                    <input 
                        type="number" 
                        id="newVolume-{{ $objection->task->id }}" 
                        name="new_volume" 
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white transition duration-200" 
                        min="{{ $objection->task->task_latest_progress + 1 }}" 
                        max="{{ $objection->task->task_volume - 1 }}" 
                        value="{{ $objection->task->task_volume - 1}}"
                        required
                    >
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <span class="text-gray-500 dark:text-gray-400 text-sm">{{ $objection->task->activity->activity_unit }}</span>
                    </div>
                </div>
            </div>
        
            <button 
                type="submit" 
                class="w-full px-4 py-2 text-white rounded-lg transition-colors duration-200 bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 shadow-md hover:shadow-lg"
                onclick="return confirm('Yakin ingin menyimpan perubahan volume pekerjaan?')">
                Simpan Perubahan
            </button>
        </form>

        <!-- Action Buttons -->
        <div class="space-y-3">
            @if ($objection->task->task_latest_progress != 0)
                <x-objection-evaluation-modal :objection="$objection" />
                <button 
                    type="submit" 
                    class="w-full px-4 py-2 text-white rounded-lg transition-colors duration-200 bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50 shadow-md hover:shadow-lg flex items-center justify-center"
                    onclick="openAssessmentModal()">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Tandai Tugas Selesai
                </button>
            @else
                <form action="{{ route('delete-task-from-objection', $objection->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button 
                        type="submit" 
                        class="w-full px-4 py-2 text-white rounded-lg transition-colors duration-200 bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50 shadow-md hover:shadow-lg flex items-center justify-center"
                        onclick="return confirm('Yakin ingin menghapus tugas ini?')">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Hapus Tugas
                    </button>
                </form>
            @endif

            <form action="{{ route('reject-objection', $objection->id) }}" method="POST">
                @csrf
                <button
                    type="submit"
                    class="w-full px-4 py-2 text-white rounded-lg transition-colors duration-200 bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50 shadow-md hover:shadow-lg flex items-center justify-center"
                    onclick="return confirm('Yakin ingin menolak sanggahan ini?')">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    Tolak Sanggahan
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    function openObjectionModal(objectionId) {
        const modal = document.getElementById('approveObjectionModal-' + objectionId);
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        
        // Trigger animation
        setTimeout(() => {
            const content = modal.querySelector('.modal-content');
            content.classList.remove('scale-95', 'opacity-0');
            content.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closeObjectionModal(objectionId) {
        const modal = document.getElementById('approveObjectionModal-' + objectionId);
        const content = modal.querySelector('.modal-content');
        
        // Start closing animation
        content.classList.remove('scale-100', 'opacity-100');
        content.classList.add('scale-95', 'opacity-0');
        
        // Wait for animation to finish before hiding
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }, 300);
    }
</script>