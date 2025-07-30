<x-layout>
    <div class="overflow-x-hidden max-w-full px-4 sm:px-6 lg:px-8">
        <header class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Monitoring Kegiatan</h1>
            <p class="text-sm text-gray-600 dark:text-gray-400">Kelola dan pantau kegiatan tim Anda</p>
        </header>
        <div class="border shadow-lg sm:rounded-t-lg mt-3 w-full overflow-hidden">
            <!-- Search and Filter Section -->
            <section aria-labelledby="filter-heading">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-4 w-full">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <!-- Search Form -->
                        <div class="w-full md:w-1/2">
                            <form class="flex items-center gap-2" action="{{ route('activities-monitoring-page') }}" method="GET">
                                <label for="search" class="sr-only">Cari Kegiatan</label>
                                <div class="relative flex-grow">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input type="text" 
                                        id="search" 
                                        name="search" 
                                        value="{{ request('search') }}"
                                        class="w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                        placeholder="Cari Kegiatan..." 
                                        autocomplete="off"
                                        aria-label="Cari kegiatan">
                                </div>
                                <button type="submit" 
                                        class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors"
                                        aria-label="Submit pencarian">
                                    Cari
                                </button>
                            </form>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-2 w-full md:w-auto">
                            <div class="relative">
                                <label for="sort" class="sr-only">Urutkan berdasarkan</label>
                                <select id="sort" name="sort" 
                                        class="w-full px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 focus:ring-2 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700 transition-colors"
                                        aria-label="Urutkan Kegiatan">
                                    <option value="priority" {{ request('sort') == 'priority' ? 'selected' : '' }}>Status Progress</option>
                                    <option value="id" {{ request('sort') == 'id' ? 'selected' : '' }}>Kegiatan Diberikan</option>
                                    <option value="tenggat" {{ request('sort') == 'tenggat' ? 'selected' : '' }}>Tenggat Kegiatan</option>
                                    <option value="progress" {{ request('sort') == 'progress' ? 'selected' : '' }}>Persentase Progress</option>
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
                                    <option value="Selesai" {{ request('filter') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                </select>
                            </div>
                        </div>

                        <!-- Add Activity Button -->
                        @if(Auth::check() && Auth::user()->user_role == 'ketuatim')
                            <div class="flex justify-end">
                                <a href="{{ route('create-task-page') }}" 
                                class="flex items-center px-2 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors"
                                aria-label="Tambah kegiatan baru">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                    </svg>
                                    Tambah Kegiatan
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- Clear Search Button -->
                    @if(request()->has('search') && request('search') != '')
                        <div class="mt-4">
                            <a href="{{ route('activities-monitoring-page') }}" 
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-100 hover:text-blue-700 transition-colors"
                            aria-label="Reset pencarian">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                </svg>
                                Reset Pencarian
                            </a>
                        </div>
                    @endif
                </div>
            </section>

            <!-- Activities Table -->
            <section aria-labelledby="activities-heading" class="w-full">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                    <!-- Responsive Table Container -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider w-24">Status</th>
                                    <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider min-w-[150px]">Nama Kegiatan</th>
                                    <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider w-28">Tenggat</th>
                                    <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider w-32">Progress</th>
                                    <th scope="col" class="px-3 py-3 text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider w-16 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($activities as $activity)
                                <tr>
                                    @php
                                        $color = $activity->spi_data['color'];
                                        $backgroundColor = in_array($color, ['red', 'yellow', 'green', 'blue']) ? "bg-{$color}-500" : 'bg-black'; 
                                    @endphp

                                    <!-- Kolom Status -->
                                    <td class="px-3 py-4 whitespace-nowrap">
                                        <p class="{{ $backgroundColor }} text-white rounded-md w-36 text-center text-sm">{{ $activity->spi_data['status'] }}</p>
                                    </td>
        
                                    <!-- Kolom Nama Kegiatan -->
                                    <td class="px-3 py-4">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white truncate">
                                            {{ $activity->activity_name }}
                                        </div>
                                    </td>
        
                                    <!-- Kolom Tenggat -->
                                    <td class="px-3 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            {{ $activity->id_format_deadline }}
                                        </div>
                                    </td>
        
                                    <!-- Kolom Progress -->
                                    <td class="px-3 py-4">
                                        <div class="flex items-center">
                                            <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700 mr-2">
                                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $activity->total_progress }}%"></div>
                                            </div>
                                            <span class="text-xs text-gray-500 dark:text-gray-400">{{ $activity->total_progress }}%</span>
                                        </div>
                                    </td>
                                    
                                    <!-- Kolom Aksi -->
                                    <td class="px-3 py-4 whitespace-nowrap text-center">
                                        <a href="{{ route('activity-page', $activity->activity_slug) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">
                                            <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Pagination and Items Per Page -->
                    <div class="bg-white p-4 dark:bg-gray-800 bottom-0 border-t">
                        {{ $activities->links() }}
                        <div class="flex items-center w-full space-x-3 md:w-auto">
                            <p class="text-sm text-gray-500">Data per halaman</p>
                            <select id="perPage" name="perPage" class="flex items-center justify-center w-full px-4 py-2 text-xs font-medium text-gray-900 bg-white border border-gray-200 rounded-lg md:w-auto focus:outline-none hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                <option value="5" {{ request('perPage') == 5 ? 'selected' : ''}}>5</option>
                                <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                                <option value="15" {{ request('perPage') == 15 ? 'selected' : '' }}>15</option>
                                <option value="20" {{ request('perPage') == 20 ? 'selected' : '' }}>20</option>
                            </select>
                        </div>
                    </div>
                </div>
            </section>
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