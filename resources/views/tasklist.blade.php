<x-layout>
    <div class="container mx-auto px-4 py-6">
    
        <header class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Daftar Tugas Aktif</h1>
            <p class="text-sm text-gray-600 dark:text-gray-400">Kelola dan pantau tugas yang sedang berjalan</p>
        </header>

        <div class="border shadow-lg sm:rounded-t-lg">

            <section aria-labelledby="filter-heading">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-4">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <!-- Search Form -->
                        <div class="w-full md:w-1/2">
                            <form id="search-form" class="flex items-center gap-2">
                                <label for="search" class="sr-only">Cari Tugas</label>
                                <div class="relative flex-grow">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input type="text" id="search" name="search" 
                                        value="{{ request('search') }}"
                                        class="w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                        placeholder="Cari Tugas..." 
                                        autocomplete="off"
                                        aria-label="Cari tugas">
                                </div>
                                <button type="submit" 
                                        class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors"
                                        aria-label="Submit pencarian">
                                    Cari
                                </button>
                            </form>
                        </div>

                        <!-- Sort and Filter Controls -->
                        <div class="flex flex-col sm:flex-row gap-2 w-full md:w-auto">
                            <div class="relative">
                                <label for="sort" class="sr-only">Urutkan berdasarkan</label>
                                <select id="sort" name="sort" 
                                        class="w-full px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 focus:ring-2 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700 transition-colors"
                                        aria-label="Urutkan tugas">
                                    <option value="priority" {{ request('sort') == 'priority' ? 'selected' : '' }}>Tingkat Prioritas</option>
                                    <option value="id" {{ request('sort') == 'id' ? 'selected' : '' }}>Tugas Diberikan</option>
                                    <option value="tenggat" {{ request('sort') == 'tenggat' ? 'selected' : '' }}>Tenggat Terdekat</option>
                                </select>
                            </div>

                            <div class="relative">
                                <label for="filter" class="sr-only">Filter status</label>
                                <select id="filter" name="filter" 
                                        class="w-full px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 focus:ring-2 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700 transition-colors"
                                        aria-label="Filter tugas">
                                    <option value="" {{ request('filter') == '' ? 'selected' : '' }}>Semua Status</option>
                                    <option value="Terlambat" {{ request('filter') == 'Terlambat' ? 'selected' : '' }}>Terlambat</option>
                                    <option value="Progress Lambat" {{ request('filter') == 'Progress Lambat' ? 'selected' : '' }}>Progress Lambat</option>
                                    <option value="Progress On Time" {{ request('filter') == 'Progress On Time' ? 'selected' : '' }}>Progress On Time</option>
                                    <option value="Progress Cepat" {{ request('filter') == 'Progress Cepat' ? 'selected' : '' }}>Progress Cepat</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Clear Search Button -->
                    @if(request()->has('search') && request('search') != '')
                        <div class="mt-4">
                            <a href="{{ route('tasklist') }}" 
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-100 hover:text-blue-700 transition-colors"
                            aria-label="Kembali ke semua tugas">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Kembali ke semua tugas
                            </a>
                        </div>
                    @endif
                </div>
            </section>

            {{-- advanced tables --}}
            <div class="overflow-auto max-h-screen">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 border-t"> 
                        <tr>
                            <th scope="col" class="px-4 py-3">Status</th>
                            <th scope="col" class="px-4 py-3">Nama Kegiatan</th>
                            <th scope="col" class="px-4 py-3">Volume/Satuan</th>
                            <th scope="col" class="px-4 py-3">Tenggat</th>
                            <th scope="col" class="px-4 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white border-t dark:border-gray-700 dark:bg-gray-800">
                        @forelse ($tasks as $task)
                            <tr class="border-t hover:bg-gray-50 dark:hover:bg-gray-700">
                                @php
                                    $color = $task->spi_data['color'];
                                    $backgroundColor = in_array($color, ['red', 'yellow', 'green', 'blue']) ? "bg-{$color}-500" : 'bg-black'; 
                                @endphp
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <p class="{{ $backgroundColor }} text-white rounded-md w-36 text-center text-sm">{{ $task->spi_data['status'] }}</p>
                                </th>
                                <td class="px-4 py-3">{{ $task->activity->activity_name }}</td>
                                <td class="px-4 py-3">{{ $task->task_volume }} {{ $task->activity->activity_unit }}</td>
                                <td class="px-4 py-3">{{ $task->formatted_tenggat }}</td>
                                <td class="px-4 py-3 flex items-center justify-center hover:cursor-pointer">
                                    <a href="/anggotatim/daftartugas/{{ $task->task_slug }}" class="inline-flex items-center p-0.5 rounded-lg focus:outline-none" aria-label="Detail tugas {{ $task->activity->activity_name }}">
                                        <img class="w-5 h-5" src="{{ asset('img/info-square-fill.svg') }}" alt="Detail">
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr class="text-center">
                                <td colspan="5" class="px-4 py-3">Tidak Ada Tugas Ditemukan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="bg-white p-4 dark:bg-gray-800 bottom-0 border-t">
                {{ $tasks->links() }}
                <div class="flex items-center w-full space-x-3 md:w-auto">
                    <p class="text-sm text-gray-500">Data per halaman</p>
                    <select id="perPage" class="flex items-center justify-center w-full px-4 py-2 text-xs font-medium text-gray-900 bg-white border border-gray-200 rounded-lg md:w-auto focus:outline-none hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        <option value="5" {{ request('perPage') == 5 ? 'selected' : '' }}>5</option>
                        <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                        <option value="15" {{ request('perPage') == 15 ? 'selected' : '' }}>15</option>
                        <option value="20" {{ request('perPage') == 20 ? 'selected' : '' }}>20</option>
                    </select>
                </div>
            </div>
        </div>

        <script>
            document.getElementById('sort').addEventListener('change', function() {
                const urlParams = new URLSearchParams(window.location.search);
                urlParams.set('sort', this.value);
                window.location.href = window.location.pathname + '?' + urlParams.toString();
            });

            document.getElementById('filter').addEventListener('change', function() {
                const urlParams = new URLSearchParams(window.location.search);
                urlParams.set('filter', this.value);
                urlParams.set('page', 1);
                window.location.href = window.location.pathname + '?' + urlParams.toString();
            });

            document.getElementById('perPage').addEventListener('change', function() {
                const urlParams = new URLSearchParams(window.location.search);
                urlParams.set('perPage', this.value);
                urlParams.set('page', 1); 
                window.location.href = window.location.pathname + '?' + urlParams.toString();
            });
        </script>

    </div>
</x-layout> 