<x-layout>

    {{-- button --}}
    @if (Auth::check() && Auth::user()->role == 'administrator')
        <div class="flex mt-2">
            <a href="/tambahpengguna" class="block text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
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
                    <form class="flex items-center" action="/home" method="GET">
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
                        <th scope="col" class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white border-t dark:border-gray-700 dark:bg-gray-800">
                    @forelse ($users as $user)
                        <tr class="border-t">
                            <td class="px-4 py-3">{{ $user->name }}</td>
                            <td class="px-4 py-3">{{ $user->email }}</td>
                            <td class="px-4 py-3">{{ $user->role }}</td>
                            <td class="px-4 py-3">{{ $user->no_hp }}</td>
                            <td class="px-4 py-3 flex items-center justify-center hover:cursor-pointer">
                                <a href="/administrator/{{ $user->username }}" class="inline-flex items-center p-0.5 rounded-lg focus:outline-none">
                                    <img class="w-5 h-5" src="{{ asset('img/info-square-fill.svg') }}" alt="Detail">
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="5" class="px-4 py-3">Tidak Ada Pengguna Ditemukan</td>
                        </tr>
                        @if(request()->has('search'))
                            <tr class="text-center">
                                <td colspan="5">
                                    <a href="{{ route('home') }}" class="font-medium text-base text-blue-600 hover:underline">&laquo; Kembali</a>
                                </td>
                            </tr>
                        @endif
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="bg-white p-4 dark:bg-gray-800 sticky bottom-0 border">
            {{ $users->links() }}
        </div>
    </div>
    
    <script type="text/javascript">
        @if(session('success'))
            toastr.success("{{ session('success') }}");
        @endif
    </script>

</x-layout> 