<x-layout>
    <div class="min-h-screen overflow-y-visible">

        {{-- Judul Halaman --}}
        <p class="text-sm text-gray-600">Tugas Saya</p>

        {{-- Kotak Pencarian --}}
        <div class="py-4 px-4 mx-auto max-w-screen-xl lg:px-6">
            <div class="mx-auto max-w-screen-md sm:text-center">
                <form action="/home" method="GET">
                    <div class="items-center mx-auto mb-3 space-y-4 max-w-screen-sm sm:flex sm:space-y-0">

                        <div class="relative w-full">
                            <label for="search" class="hidden mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Search</label>

                            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
                                </svg>
                            </div>

                            <input class="block p-3 pl-10 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:rounded-none sm:rounded-l-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Search for Task" type="search" id="search" name="search" autocomplete="off">
                        </div>

                        <div>
                            <button type="submit" class="py-3 px-5 w-full text-sm font-medium text-center text-white rounded-lg border cursor-pointer bg-primary-700 border-primary-600 sm:rounded-none sm:rounded-r-lg hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Search</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>  

        <div class="flex justify-end">

            {{-- Tombol Mengurutkan --}}
            <div class="mb-4 ">

                <select id="filter" class="hover:cursor-pointer focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5">
                    <option value="" {{ request('filter') == '' ? 'selected' : '' }}>Semua</option>
                    <option value="terlambat" {{ request('filter') == 'terlambat' ? 'selected' : '' }}>Terlambat</option>
                    <option value="progress_lambat" {{ request('filter') == 'progress_lambat' ? 'selected' : '' }}>Progress Lambat</option>
                    <option value="progress_ontime" {{ request('filter') == 'progress_ontime' ? 'selected' : '' }}>Progress On Time</option>
                    <option value="progress_cepat" {{ request('filter') == 'progress_cepat' ? 'selected' : '' }}>Progress Cepat</option>
                </select>
                
                <script>
                    document.getElementById('filter').addEventListener('change', function() {
                        const urlParams = new URLSearchParams(window.location.search);
                        urlParams.set('filter', this.value);
                        urlParams.set('page', 1);
                        window.location.href = window.location.pathname + '?' + urlParams.toString();
                    });
                </script>
                
                <select id="sort" class="hover:cursor-pointer focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5">
                    <option value="priority" {{ request('sort') == 'priority' ? 'selected' : '' }}>Tingkat Prioritas</option>
                    <option value="id" {{ request('sort') == 'id' ? 'selected' : '' }}>Tugas Diberikan</option>
                    <option value="tenggat" {{ request('sort') == 'tenggat' ? 'selected' : '' }}>Tenggat Terdekat</option>
                </select>
                
                <script>
                    document.getElementById('sort').addEventListener('change', function() {
                        const urlParams = new URLSearchParams(window.location.search);
                        urlParams.set('sort', this.value);
                        window.location.href = window.location.pathname + '?' + urlParams.toString();
                    });
                </script>
                
            </div>

        </div>

        {{-- Daftar Tugas --}}
        <div x-data="{ openTask: null }">  

            {{ $tasks->links() }}
    
            <div class="py-8">
    
                @forelse ($tasks as $task) 
                <div @click="openTask = openTask === {{ $task->id }} ? null : {{ $task->id }}" class="m-1 transition-all duration-300 ease-in-out" :class="{'shadow-lg': openTask === {{ $task->id }}}">
                
                    <div tabindex="0" class="bg-white border-t border-collapse p-3 flex justify-between items-center hover:bg-gray-100 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:rounded-lg transition-all duration-300 ease-in-out" :class="{'border-x rounded-t-md': openTask === {{ $task->id }}}">
            
                        <div class="flex items-center">
                            @php
                                $color = $task->kemajuan['color'];
                                $backgroundColor = in_array($color, ['red', 'yellow', 'green']) ? "bg-{$color}-500" : 'bg-black'; 
                            @endphp
        
                            <p class="mr-5 p-2 {{ $backgroundColor }} text-white rounded-2xl w-36 text-center text-sm">{{ $task->kemajuan['status'] }}</p>
                            <p>{{ $task->namakegiatan}}</p>
                        </div>
    
                        <div class="flex items-center">
                            <p class="text-sm text-gray-500">Tenggat: {{ $task->formattedd_m }}</p>
                            <p class="text-center ml-3">
                                <a href="/home/{{ $task->slug }}" @click.stop>
                                    <img class="w-6 h-6 mx-auto" src="{{ asset('img/info-square-fill.svg') }}" alt="Detail">
                                </a>
                            </p>
                        </div>
        
                    </div>
            
                    <div x-show="openTask === {{ $task->id }}" 
                        class="border p-8 rounded-b-md shadow-md mb-5 overflow-hidden origin-top"
                        x-data x-effect="if (openTask === {{ $task->id }}) { console.log(
                        ' Kode Kategori: {{ $task->kodekategori }}\n', 
                        'Progress Tercapai: {{ $task->progress }}\n', 
                        'Volume: {{ $task->volume }}\n\n',

                        'Hari Berlalu (PHP): {{ $task->kemajuan['hariberlalu'] }}\n', 
                        'Hari Berlalu (MySQL): {{ $task->hariberlalu_MySQL }}\n\n',

                        'Jumlah Hari Tugas (PHP): {{ $task->kemajuan['selangharitugas_PHP'] }}\n',
                        'Jumlah Hari Tugas (MySQL): {{ $task->selangharitugas_MySQL }}\n\n',

                        'Target Perhari (PHP): {{ $task->kemajuan['targetperhari_PHP'] }} \n',
                        'Target Perhari (MySQL): {{ $task->targetperhari_MySQL }} \n\n', 

                        'Target Harus Tercapai (PHP): {{ $task->kemajuan['tht'] }}\n',
                        'Target Harus Tercapai (MySQL): {{ $task->targetharustercapai_MySQL }}',
                        );}">
                        
                        <p class="text-sm text-gray-400 mb-3">Posted {{ $task->created_at->format('F d') }}</p>
                        <p>Deskripsi Pekerjaan:</p>
                        <p>{{ $task->deskripsi }}</p>
                    </div>
            
                </div>
    
                @empty
                    <p class="bg-white">
                        <td class="p-2" colspan="6">Tidak ada tugas</td>
                    </p>
                @endforelse    
    
            </div>
    
            {{ $tasks->links() }}
    
        </div>

        <script type="text/javascript">
            @if(session('success'))
                toastr.success("{{ session('success') }}");
            @endif
            @if(session('error'))
                toastr.error("{{ session('error') }}");
            @endif
            @if(session('deleted'))
                toastr.info("{{ session('deleted') }}");
            @endif
        </script>

    </div>
    
</x-layout> 