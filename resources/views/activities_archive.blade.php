<x-layout>
    <div class="container mx-auto px-4 py-6">
        <!-- Page Header -->
        <header class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Arsip Kegiatan</h1>
            <p class="text-sm text-gray-600 dark:text-gray-400">Daftar kegiatan yang telah selesai</p>
        </header>

        <!-- Search and Filter Section -->
        <section aria-labelledby="filter-heading" class="">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border p-4">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <!-- Search Form -->
                    <form class="flex-1 flex items-center gap-2" action="{{ route('activities-archive-page') }}" method="GET">
                        <label for="search" class="sr-only">Cari kegiatan</label>
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
                                   class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
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

                    <!-- Month/Year Filter -->
                    <form method="GET" class="w-full md:w-auto">
                        <label for="month_year" class="sr-only">Filter Bulan/Tahun</label>
                        <select name="month_year" id="month_year" 
                                class="w-full px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 focus:ring-2 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700 transition-colors"
                                aria-label="Filter berdasarkan bulan dan tahun">
                            <option value="">Semua Periode</option>
                            @foreach($activityDates as $date)
                                <option value="{{ $date }}" {{ request('month_year') == $date ? 'selected' : '' }}>
                                    {{ \Carbon\Carbon::createFromFormat('Y-m', $date)->translatedFormat('F Y') }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </div>

                @if(request()->has('search'))
                    <div class="mt-4">
                        <a href="{{ route('activities-archive-page') }}" 
                           class="inline-flex items-center px-4 py-2 text-sm font-medium text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-100 hover:text-blue-700 transition-colors"
                           aria-label="Reset pencarian">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Reset Pencarian
                        </a>
                    </div>
                @endif
            </div>
        </section>

        <!-- Activities Table -->
        <section aria-labelledby="activities-heading">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm overflow-hidden border">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Nama Kegiatan</th>
                                <th scope="col" class="px-6 py-3">Total Volume</th>
                                <th scope="col" class="px-6 py-3">Satuan</th>
                                <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($activities as $activity)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        {{ $activity->activity_name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ number_format($activity->total_volume, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $activity->activity_unit }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <a href="{{ route('activity-page',$activity->activity_slug) }}" 
                                           class="inline-flex items-center justify-center p-1.5 rounded-lg text-blue-600 hover:text-blue-800 hover:bg-blue-50 dark:hover:bg-gray-700 transition-colors"
                                           aria-label="Detail kegiatan {{ $activity->activity_name }}"
                                           title="Lihat detail">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                        <div class="flex flex-col items-center justify-center py-8">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <p class="mt-2 text-lg font-medium text-gray-600 dark:text-gray-300">
                                                Tidak ada kegiatan yang ditemukan
                                            </p>
                                            @if(request()->has('search') || request()->has('month_year'))
                                                <a href="{{ route('activities-archive-page') }}" class="mt-2 text-sm text-blue-600 hover:underline">
                                                    Tampilkan semua kegiatan
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="bg-white p-4 dark:bg-gray-800 bottom-0 border-t">
                    {{ $activities->links() }}
                    <div class="flex items-center w-full space-x-3 md:w-auto">
                        <p class="text-sm text-gray-500">Data per halaman</p>
                        <select id="perPage" class="flex items-center justify-center w-full px-4 py-2 text-xs font-medium text-gray-900 bg-white border border-gray-200 rounded-lg md:w-auto focus:outline-none hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
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
        document.addEventListener('DOMContentLoaded', function() {
            // Handle per page change
            document.getElementById('perPage')?.addEventListener('change', function() {
                updateUrlParams('perPage', this.value);
            });

            // Handle month/year filter change
            document.getElementById('month_year')?.addEventListener('change', function() {
                updateUrlParams('month_year', this.value);
            });

            // Submit search form on Enter key
            document.getElementById('search')?.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    this.form.submit();
                }
            });

            function updateUrlParams(key, value) {
                const urlParams = new URLSearchParams(window.location.search);
                urlParams.set(key, value);
                urlParams.set('page', 1); 
                window.location.href = window.location.pathname + '?' + urlParams.toString();
            }
        });
    </script>

</x-layout>