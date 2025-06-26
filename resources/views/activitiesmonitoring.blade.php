<x-layout>
    <div>

        <p class="text-sm text-gray-600">Monitoring Kegiatan</p>
        
        <div class="border shadow-lg sm:rounded-t-lg mt-3">
            {{-- table headers --}}
            <div class="relative bg-white dark:bg-gray-800 sm:rounded-t-lg">
                <div class="flex flex-col items-center justify-between p-4 space-y-3 md:flex-row md:space-y-0 md:space-x-4">
                    
                    <div class="w-full md:w-1/2">
                        <form class="flex items-center" action="{{ $actionUrl }}" method="GET">
                            <label for="search" class="sr-only"></label>
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="text" id="search" name="search" class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Cari Tugas..." autocomplete="off">
                            </div>
                        </form>
                    </div>

                    <div class="flex flex-col items-stretch justify-end flex-shrink-0 w-full space-y-2 md:w-auto md:flex-row md:space-y-0 md:items-center md:space-x-3">
                        <div class="flex items-center w-full space-x-3 md:w-auto">
                            
                            {{-- button --}}
                            @if (Auth::check() && Auth::user()->user_role == 'ketuatim')
                                <div class="flex">
                                    <a href="/ketuatim/tambahkegiatan" class="block text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                        + Tambah Kegiatan
                                    </a>
                                </div>
                            @endif    
                      
                        </div>
                    </div>

                </div>
            </div>
            {{-- advanced tables --}}
            <div class="overflow-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 border-t"> 
                        <tr>
                            <th scope="col" class="px-4 py-3">Status Kegiatan</th>
                            <th scope="col" class="px-4 py-3">Nama Kegiatan</th>
                            <th scope="col" class="px-4 py-3">Tenggat Waktu</th>
                            <th scope="col" class="px-4 py-3">Total Persentase Progress</th>
                            <th scope="col" class="px-4 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white border-t dark:border-gray-700 dark:bg-gray-800">
                        @forelse ($activities as $activity)
                            <tr class="border-t">
                                @php
                                    $color = $activity->spi_data['color'];
                                    $backgroundColor = in_array($color, ['red', 'yellow', 'green', 'blue']) ? "bg-{$color}-500" : 'bg-black'; 
                                @endphp
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <p class=" {{ $backgroundColor }} text-white rounded-md w-36 text-center text-sm">{{ $activity->spi_data['status'] }}</p>
                                </th>
                                <td class="px-4 py-3">{{ $activity->activity_name }}</td>
                                <td class="px-4 py-3">{{ $activity->id_format_deadline }}</td>
                                <td class="px-4 py-3">{{ $activity->total_progress }}%</td>
                                <td class="px-4 py-3 flex items-center justify-center hover:cursor-pointer">
                                    <a href="{{ $actionUrl }}{{ $activity->activity_slug }}" class="inline-flex items-center p-0.5 rounded-lg focus:outline-none">
                                        <img class="w-5 h-5" src="{{ asset('img/info-square-fill.svg') }}" alt="Detail">
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr class="text-center">
                                <td colspan="5" class="px-4 py-3">Tidak Ada Tugas Ditemukan</td>
                            </tr>
                            @if(request()->has('search'))
                                <tr class="text-center">
                                    <td colspan="5">
                                        <a href="{{ $actionUrl }}" class="font-medium text-base text-blue-600 hover:underline">&laquo; Kembali</a>
                                    </td>
                                </tr>
                            @endif
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="bg-white p-4 dark:bg-gray-800 bottom-0 border-t">
                {{ $activities->links() }}
                <div class="flex items-center w-full space-x-3 md:w-auto">
                    <p class="text-sm text-gray-500">Data per halaman</p>
                    <select id="perPage" class="flex items-center justify-center w-full px-4 py-2 text-xs font-medium text-gray-900 bg-white border border-gray-200 rounded-lg md:w-auto focus:outline-none hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                        <option value="15" {{ request('perPage') == 15 ? 'selected' : '' }}>15</option>
                        <option value="20" {{ request('perPage') == 20 ? 'selected' : '' }}>20</option>
                    </select>
                </div>
            </div>
        </div>

        <script>
            flatpickr("#tenggat", {
            dateFormat: "Y-m-d",  
            minDate: "today",      
            disableMobile: true 
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