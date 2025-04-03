<x-layout>
    <div>

        <p class="text-sm text-gray-600">Monitoring Kegiatan</p>

        {{-- button --}}
        @if (Auth::check() && Auth::user()->role == 'ketuatim')
            <div class="flex mt-7">
                <a href="/tambahkegiatan" class="block text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                    + Tambah Kegiatan
                </a>
            </div>
        @endif

        {{ $kegiatan->links() }}

        <div>
            @forelse ($kegiatan as $giat)
                <div class="items-center py-5 justify-between">
                    <div class="w-full border-b">

                        {{-- progress --}}
                        <div class="flex justify-between mb-2">
                            <span class="text-base font-bold text-gray-900 dark:text-white">{{ $giat->namakegiatan }}</span>
                            <span class="text-sm font-bold text-gray-900 dark:text-white">{{ \Carbon\Carbon::parse($giat->tenggat)->translatedFormat('d F Y') }}</span>
                        </div>
                        <div class="w-full h-6 bg-gray-200 rounded-full dark:bg-gray-700">
                            <div class="h-6 bg-blue-600 rounded-full dark:bg-blue-500 text-sm font-medium text-blue-100 text-center" style="width: {{ $giat->progressPercentage }}%">{{ $giat->progressPercentage }}%</div>
                        </div>
                    
                        <div class="mb-5 mt-4">
                            <p>
                                <a href="/monitoringkegiatan/{{ $giat->slug }}" class="font-medium text-primary-600 hover:text-primary-800 dark:text-primary-500 dark:hover:text-primary-700">
                                    Lihat Detail >
                                </a>
                            </p>
                        </div>
                </div>
            @empty
                <div>
                    <p class="text-center m-5">Tidak Kegiatan Ditemukan</p>
                </div>
            @endforelse
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

        <script>
            flatpickr("#tenggat", {
            dateFormat: "Y-m-d",  
            minDate: "today",      
            disableMobile: true 
            });
        </script>

    </div>
    
</x-layout> 