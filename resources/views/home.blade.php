<x-layout>

    {{-- Judul Halaman --}}
    @if (Auth::check() && Auth::user()->role == 'ketuatim')
        <p class="text-sm text-gray-600">Monitoring Tugas Pegawai</p>
    @endif
    @if (Auth::check() && Auth::user()->role == 'anggotatim')
        <p class="text-sm text-gray-600">Tugas Saya</p>
    @endif

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

    <div class="flex justify-between">

        <div>
            {{-- Button Menambah Tugas --}}
            @if (Auth::check() && Auth::user()->role == 'ketuatim')
              <div class="flex mb-10">
                  <button id="defaultModalButton" data-modal-target="defaultModal" data-modal-toggle="defaultModal" class="block text-white bg-[#37b5fd] hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800" type="button">
                  + Buat Tugas
                  </button>
              </div>  
            @endif
        </div>

        {{-- Tombol Mengurutkan --}}
        <div class="mb-4 ">

            <select id="sort" class="hover:cursor-pointer focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5">
                <option value="id" {{ request('sort') == 'id' ? 'selected' : '' }}>Tugas Diberikan</option>
                <option value="tenggat" {{ request('sort') == 'tenggat' ? 'selected' : '' }}>Tenggat Terdekat</option>
                <option value="priority" {{ request('sort') == 'priority' ? 'selected' : '' }}>Tingkat Prioritas</option>
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
  {{ $tasks->links() }}

  <div class="py-8">
    @forelse ($tasks as $task)    
        <div class="bg-white border-b p-3 flex justify-between items-center hover:bg-gray-100">

            <div class="flex items-center">
                <p class="mr-5 p-2 bg-{{ $task->kemajuan['color'] }}-500 text-white rounded-2xl w-36 text-center">{{ $task->kemajuan['status'] }}</p>
                <p>{{ $task->namakegiatan}}</p>
            </div>

            <div class="flex items-center">
                <p class="text-sm text-gray-500">Tenggat: {{ $task->formattedd_m }}</p>
                <p class="text-center ml-3">
                    <a href="/home/{{ $task->slug }}">
                        <img class="w-6 h-6 mx-auto" src="{{ asset('img/info-square-fill.svg') }}" alt="Detail">
                    </a>
                </p>
            </div>

        </div>
        @empty
        <p class="bg-white">
            <td class="p-2" colspan="6">Tidak ada tugas</td>
        </p>
        @endforelse    
    </div>

    {{ $tasks->links() }}

    <!-- Form Tambah Tugas -->
    <div id="defaultModal" tabindex="-1" aria-hidden="true" class="hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
      <div class="relative w-full max-w-2xl max-h-[90vh] md:h-auto overflow-y-auto overflow-x-hidden">
          <div class="relative p-4 bg-white shadow dark:bg-gray-800 sm:p-5">
              <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                  <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                      Tambah Tugas
                  </h3>
                  <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="defaultModal">
                      <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                      <span class="sr-only">Close modal</span>
                  </button>
              </div>
              <form action="{{ route('home') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="mb-8 sm:grid-cols-2">
                      <div class="mb-4">
                          <label for="namakegiatan" class="block text-sm font-medium text-gray-900 dark:text-white">Nama Kegiatan</label>
                          <p class="  text-xs text-gray-400">Contoh: Susenas Maret 2025</p>
                          <input type="text" name="namakegiatan" id="namakegiatan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="" autocomplete="off">
                      </div>
                      <div class="sm:col-span-2 mb-4">
                          <label for="deskripsi" class="block text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                          <p class="mb-1 text-xs text-gray-400">Contoh: Lakukan Pencacahan Pada Blok Sensus Terpilih</p>
                          <textarea id="deskripsi" name="deskripsi" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"></textarea>                    
                      </div>
                      <div class="flex mb-4">
                          <div class="mr-4">
                              <label for="volume" class="block text-sm font-medium text-gray-900 dark:text-white">Volume</label>
                              <p class="text-xs text-gray-400">Contoh: 10</p>
                              <input type="number" name="volume" id="volume" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="" autocomplete="off">
                          </div>
                          <div class="">
                              <label for="satuan" class="block text-sm font-medium text-gray-900 dark:text-white">Satuan</label>
                              <p class="text-xs text-gray-400">Contoh: Blok Sensus</p>
                              <input type="text" name="satuan" id="satuan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="" autocomplete="off">
                          </div>
                      </div>
                      <div class="mb-4">
                          <label for="tenggat" class="block text-sm font-medium text-gray-900 dark:text-white">Tenggat</label>
                          <p class="  text-xs text-gray-400">Contoh: 30/04/2025</p>
                          <input type="date" name="tenggat" id="tenggat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="" autocomplete="off">
                      </div>
                      <div class="mb-4">
                          <label for="penerimatugas_id" class="block text-sm font-medium text-gray-900 dark:text-white">Penerima Tugas</label>
                          <select id="penerimatugas_id" name="penerimatugas_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                              <option selected="" disabled>Pilih Anggota Tim</option>
                              @foreach ($anggotatim as $user)
                                  <option value="{{ $user->id }}">{{ $user->name }}</option>
                              @endforeach
                          </select>
                      </div>
                  </div>
                  
                  <div class="mb-4">
                      <label for="attachment" class="block text-sm font-medium text-gray-900 dark:text-white">Upload Dokumen</label>
                      <p class="  text-xs text-gray-400">Ukuran maksimal file 5mb</p>
                      <input type="file" name="attachment" id="attachment" class="">
                  </div>

                  <button type="submit" class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                      <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                      Simpan
                  </button>
              </form>
          </div>
      </div>
  </div>

  <script>
      document.addEventListener("DOMContentLoaded", function(event) {
          document.getElementById('defaultModalButton').click();
      });
  </script>

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

</x-layout> 