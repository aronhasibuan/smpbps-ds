<div id="deleteUserModal" class="fixed inset-0 z-50 items-center justify-center bg-black/50 backdrop-blur-sm hidden transition-opacity duration-300">
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl transform transition-all duration-300 w-full max-w-md mx-4 overflow-hidden">
        <div class="p-6">
            <!-- Header -->
            <div class="flex items-center justify-between mb-5">
                <div class="flex items-center space-x-3">
                    <div class="p-2 rounded-full bg-red-100 dark:bg-red-900/30">
                        <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Hapus Pengguna</h3>
                </div>
                <button onclick="closeDeleteModal()" class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Content -->
            <div class="mb-6 pl-11">
                <p class="text-gray-600 dark:text-gray-400">Anda akan menghapus akun 
                    <span class="font-medium text-gray-900 dark:text-white" id="userNameToDelete"></span>. 
                    Data yang dihapus tidak dapat dikembalikan.</p>
            </div>

            <!-- Form -->
            <form id="deleteUserForm" method="POST" action="">
                @csrf
                @method('DELETE')
                <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                    <button type="button" onclick="closeDeleteModal()" class="px-5 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600/50 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 dark:focus:ring-offset-gray-900">
                        Batalkan
                    </button>
                    <button type="submit" class="px-5 py-2.5 rounded-lg text-sm font-medium text-white bg-gradient-to-br from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900 transition-all duration-200 shadow-sm hover:shadow-md">
                        Ya, Hapus
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openDeleteModal(actionUrl, userName) {
        const modal = document.getElementById('deleteUserModal');
        const form = document.getElementById('deleteUserForm');
        
        form.action = actionUrl;
        document.getElementById('userNameToDelete').textContent = userName;
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.classList.add('flex');
        }, 10);
    }

    function closeDeleteModal() {
        const modal = document.getElementById('deleteUserModal');
        modal.classList.add('hidden');
        setTimeout(() => {
            modal.classList.remove('flex');
        }, 300);
    }
</script>