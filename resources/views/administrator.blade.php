<x-layout>

    {{-- button --}}
    @if (Auth::check() && Auth::user()->role == 'administrator')
        <div class="flex mt-2">
            <a href="/administrator/createuser" class="block text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                + Tambah Pengguna
            </a>
        </div>
    @endif

    <p class="text-sm text-gray-600 mt-3 mb-5">Pengguna Terdaftar Pada SMPBPS-DS</p>

    <div class="border shadow-lg sm:rounded-t-lg">
        {{-- table headers --}}
        <div class="relative bg-white dark:bg-gray-800 sm:rounded-t-lg">
            <div class="flex flex-col items-center justify-between p-4 space-y-3 md:flex-row md:space-y-0 md:space-x-4">
                
                <div class="w-full md:w-1/2">
                    <form class="flex items-center" action="/administrator" method="GET">
                        <label for="search" class="sr-only"></label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" id="search" name="search" class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Cari Pengguna..." autocomplete="off">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- advanced tables --}}
        <div class="overflow-auto max-h-screen">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 border-t"> 
                    <tr>
                        <th scope="col" class="px-4 py-3">Nama Lengkap</th>
                        <th scope="col" class="px-4 py-3">Email </th>
                        <th scope="col" class="px-4 py-3">Role/Peran</th>
                        <th scope="col" class="px-4 py-3">Nomor Whatsapp</th>
                        <th scope="col" class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white border-t dark:border-gray-700 dark:bg-gray-800">
                    @forelse ($users as $user)
                        <tr class="border-t">
                            <td class="px-4 py-3">{{ $user->name }}</td>
                            <td class="px-4 py-3">{{ $user->email }}</td>
                            <td class="px-4 py-3">{{ $user->role }}</td>
                            <td class="px-4 py-3">{{ $user->no_hp }}</td>
                            <td class="px-4 py-3 flex items-center justify-between hover:cursor-pointer">
                                @if ($user->role !== 'kepalakantor' && $user->role !== 'administrator')
                                <img class="w-5 h-5" src="{{ asset('img/user-update.svg') }}" alt="Update Pengguna" onclick="openUpdateModal('{{ route('updateuser', $user->id) }}', '{{ $user->name }}', '{{ $user->email }}', '{{ $user->role }}', '{{ $user->no_hp }}')">                                    
                                <img class="w-5 h-5" src="{{ asset('img/user-delete.svg') }}" alt="Hapus Pengguna" onclick="openDeleteModal('{{ route('deleteuser', $user->id) }}')">
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="5" class="px-4 py-3">Tidak Ada Pengguna Ditemukan</td>
                        </tr>
                        @if(request()->has('search'))
                            <tr class="text-center">
                                <td colspan="5">
                                    <a href="{{ route('administrator') }}" class="font-medium text-base text-blue-600 hover:underline">&laquo; Kembali</a>
                                </td>
                            </tr>
                        @endif
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="bg-white p-4 dark:bg-gray-800 bottom-0 border">
            {{ $users->links() }}
            <div class="flex items-center w-full space-x-3 md:w-auto">
                <p class="text-sm text-gray-500">Data per halaman</p>
                <select id="perPage" class="flex items-center justify-center w-full px-4 py-2 text-xs font-medium text-gray-900 bg-white border border-gray-200 rounded-lg md:w-auto focus:outline-none hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                    <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                    <option value="15" {{ request('perPage') == 15 ? 'selected' : '' }}>15</option>
                    <option value="20" {{ request('perPage') == 20 ? 'selected' : '' }}>20</option>
                </select>
            </div>
        </div>

        {{-- Modal Update User --}}
        <div id="updateUserModal" class="hidden fixed inset-0 z-50 items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white rounded-lg shadow-lg p-6 w-1/3">
                <h2 class="text-lg font-bold mb-4">Update Pengguna</h2>
                <form id="updateUserForm" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text" id="name" name="name" class="block w-full p-2 border rounded-lg" required>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="email" name="email" class="block w-full p-2 border rounded-lg" required>
                    </div>
                    <div class="mb-4">
                        <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                        <select id="role" name="role" class="block w-full p-2 border rounded-lg">
                            <option value="ketuatim">Ketua Tim</option>
                            <option value="anggotatim">Anggota Tim</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="no_hp" class="block text-sm font-medium text-gray-700">Nomor WhatsApp</label>
                        <input type="text" id="no_hp" name="no_hp" class="block w-full p-2 border rounded-lg" required>
                    </div>
                    <div class="flex justify-end">
                        <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded-lg mr-2" onclick="closeUpdateModal()">Batal</button>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div id="deleteUserModal" class="hidden fixed inset-0 z-50 items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-lg shadow-lg p-6 w-1/3">
            <h2 class="text-lg font-bold mb-4">Hapus Pengguna</h2>
            <p>Apakah Anda yakin ingin menghapus pengguna ini?</p>
            <form id="deleteUserForm" method="POST" action="">
                @csrf
                @method('DELETE')
                <div class="flex justify-end mt-4">
                    <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded-lg mr-2" onclick="closeDeleteModal()">Batal</button>
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg">Hapus</button>
                </div>
            </form>
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

        function openDeleteModal(actionUrl) {
            const modal = document.getElementById('deleteUserModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            const form = document.getElementById('deleteUserForm');
            form.action = actionUrl;
            modal.classList.remove('hidden');
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteUserModal');
            modal.classList.add('hidden');
        }

        document.getElementById('perPage').addEventListener('change', function() {
            const urlParams = new URLSearchParams(window.location.search);
            urlParams.set('perPage', this.value);
            urlParams.set('page', 1); 
            window.location.href = window.location.pathname + '?' + urlParams.toString();
        });
    </script>

</x-layout> 