<!-- Delete Confirmation Modal -->
<div id="deleteTeamModal" class="fixed inset-0 z-50 items-center justify-center bg-black/50 backdrop-blur-sm hidden transition-opacity duration-300 ease-in-out">
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl w-full max-w-md max-h-[80vh] overflow-y-auto mx-4 transform transition-all duration-300 ease-out scale-95 opacity-0" id="deleteTeamContent">
        <div class="p-6">
            <!-- Modal Header -->
            <div class="flex items-start justify-between mb-4">
                <div class="flex items-center gap-3">
                    <div class="p-2 rounded-full bg-red-100 dark:bg-red-900/30">
                        <svg class="w-6 h-6 text-red-500 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Konfirmasi Penghapusan</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Tindakan ini bersifat permanen</p>
                    </div>
                </div>
                <button onclick="closeDeleteTeamModal()" class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300 p-1 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="mb-6">
                <p class="text-gray-700 dark:text-gray-300 break-words whitespace-normal overflow-hidden">
                    Anda akan menghapus tim <span class="font-semibold text-gray-900 dark:text-white break-words whitespace-normal">{{ $team->team_name }}</span> beserta data yang terkait.
                </p>
                <p class="text-red-500 dark:text-red-400 font-medium mt-2 break-words">
                    Data yang dihapus tidak dapat dikembalikan.
                </p>
            </div>

            <!-- Modal Footer -->
            <form id="deleteTeamForm" method="POST" action="">
                @csrf
                @method('DELETE')
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeDeleteTeamModal()" 
                            class="px-5 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-lg transition-colors duration-200">
                        Batalkan
                    </button>
                    <button type="submit" 
                            class="px-5 py-2.5 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-lg transition-colors duration-200 flex items-center gap-2 shadow-sm hover:shadow-md">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Ya, Hapus Tim
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openDeleteTeamModal(actionUrl) {
        const modal = document.getElementById('deleteTeamModal');
        const content = document.getElementById('deleteTeamContent'); 
        const form = document.getElementById('deleteTeamForm');
        form.action = actionUrl;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        setTimeout(() => {
            content.classList.remove('scale-95', 'opacity-0');
            content.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closeDeleteTeamModal() {
        const modal = document.getElementById('deleteTeamModal');
        const content = document.getElementById('deleteTeamContent');
        content.classList.remove('scale-100', 'opacity-100');
        content.classList.add('scale-95', 'opacity-0');
        
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }
</script>