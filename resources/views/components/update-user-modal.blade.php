<!-- Update Team Modal -->
    <div id="updateUserModal" class="fixed inset-0 z-50 items-center justify-center bg-black bg-opacity-50 hidden transition-opacity duration-300">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl transform transition-all duration-300 max-w-lg w-full mx-4">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">Update Pengguna</h3>
                    <button onclick="closeUpdateModal()" class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                <form id="updateUserForm" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <div class="space-y-4">
                        <div>
                            <label for="user_full_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Lengkap</label>
                            <input type="text" id="user_full_name" name="user_full_name" value="{{ $user->user_full_name }}" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                        </div>
                        <div>
                            <label for="team_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tim</label>
                            <select name="team_id" id="team_id" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                                <option selected disabled>Pilih Tim</option>
                                @foreach($teams as $team)
                                    <option value="{{ $team->id }}">{{ $team->team_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                            <input type="email" id="email" name="email" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                        </div>
                        <div>
                            <label for="user_role" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Role</label>
                            <select id="user_role" name="user_role" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                                <option value="ketuatim">Ketua Tim</option>
                                <option value="anggotatim">Anggota Tim</option>
                            </select>
                        </div>
                        <div>
                            <label for="user_whatsapp_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nomor WhatsApp</label>
                            <input type="text" id="user_whatsapp_number" name="user_whatsapp_number" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end space-x-3">
                        <button type="button" onclick="closeUpdateModal()" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openUpdateModal(actionUrl, name, email, role, no_hp) {
            const modal = document.getElementById('updateUserModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            const form = document.getElementById('updateUserForm');
            form.action = actionUrl;
            form.querySelector('#name').value = name;
            form.querySelector('#email').value = email;
            form.querySelector('#role').value = role;
            form.querySelector('#no_hp').value = no_hp;
        }

        function closeUpdateModal() {
            const modal = document.getElementById('updateUserModal');
            modal.classList.add('hidden');
        }
    </script>