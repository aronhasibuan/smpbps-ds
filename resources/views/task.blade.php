<x-layout>
  
    <main class="pt-4 pb-16 bg-white dark:bg-gray-900 antialiased">

      <div class="flex justify-between px-4 mx-auto max-w-screen-xl">
          <article class="mx-auto w-full max-w-4xl format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
              <header class="mb-4 lg:mb-6 not-format">
                @if (Auth::check() && Auth::user()->role == 'anggotatim')
                    <a href="javascript:history.back()" class="font-medium text-base text-blue-600 hover:underline">&laquo; Kembali</a>
                @endif
                @if (Auth::check() && Auth::user()->role == 'ketuatim')
                    <a href="/home" class="font-medium text-base text-blue-600 hover:underline">&laquo; Back to Monitoring</a>
                @endif
                <div class="flex justify-between items-center mb-5 text-gray-500 mt-2">
                  <span class="bg-{{ $task->kemajuan['color'] }}-500 text-white text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-primary-200 dark:text-primary-800">
                      Tingkat Kemajuan: {{ $task->kemajuan['status'] }}
                  </span>
                </div>
                <h1 class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl dark:text-white">{{ $task->namakegiatan }}</h1>
                <address class="flex items-center my-6 not-italic justify-between">
                    <div class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white">
                        <img class="mr-4 w-16 h-16 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-2.jpg" alt="{{ $task->pemberitugas->name }}">
                        <div>
                              <a href="#" rel="author" class="text-xl font-bold text-gray-900 dark:text-white">{{ $task->pemberitugas->name }}</a>
                              <p class="text-base text-gray-500 dark:text-gray-400">{{ $task->created_at->format('F d') }}</p>
                        </div>
                    </div>
                    <p class="text-base text-black">Tenggat: {{ $task->formatted_tenggat }}</p>
                </address>
              </header>
              <div class="border-t border-b border-gray-300">
                  <p>{{ $task->deskripsi }}</p>
              </div>
              <p>{{ $task->volume }} {{ $task->satuan }}</p>
              <div class="mb-4">
                <label class="text-gray-700 font-bold mb-2 block">Progress:</label>
                <div class="relative w-full bg-gray-300 rounded-full h-6">
                    <div class="bg-blue-600 h-6 rounded-full" style="width: {{ $task->percentage_progress }}%;"></div>
                    <span class="absolute left-1/2 transform -translate-x-1/2 font-bold">{{ $task->percentage_progress }}%</span>
                </div>
              </div>
          </article>
      </div>

      @if (Auth::check() && Auth::user()->role == 'anggotatim' && $task->active)
        <div class="flex justify-center gap-4 mt-20">
            <form action="{{ route('tasks.complete', $task->id) }}" method="POST">
                @csrf
                <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-full hover:bg-blue-700 transition duration-200">
                    Tandai Selesai
                </button>
            </form>            
        </div>          
      @endif

      @if (Auth::check() && Auth::user()->role == 'ketuatim')
        <div class="flex justify-center gap-4 mt-20">
          <button class="bg-blue-600 text-white px-6 py-3 rounded-full hover:bg-blue-700 transition duration-200" id="defaultModalButton" data-modal-target="defaultModal" data-modal-toggle="defaultModal" type="button">
            Perbarui Tugas
          </button>
          <form action="/tasks/{{ $task->id }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus tugas ini?');">
            @csrf
            @method('DELETE')
              <button class="bg-red-600 inline-flex text-white px-6 py-3 rounded-full hover:bg-red-700 transition duration-200">
                <svg class="w-5 h-5 mr-1 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                Hapus Tugas
              </button>
          </form>
        </div>
      @endif


    <!-- Main modal -->
    <div id="defaultModal" tabindex="-1" aria-hidden="true" class="hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
        <div class="relative w-full max-w-2xl max-h-[90vh] md:h-auto overflow-y-auto overflow-x-hidden">
            <!-- Modal content -->
            <div class="relative p-4 bg-white shadow dark:bg-gray-800 sm:p-5">
                <!-- Modal header -->
                <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Perbarui Tugas
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="defaultModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>

                <!-- Modal body -->
                <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-8 sm:grid-cols-2">
                        <div class="mb-4">
                            <label for="namakegiatan" class="block text-sm font-medium text-gray-900 dark:text-white">Nama Kegiatan</label>
                            <input type="text" name="namakegiatan" id="namakegiatan" value="{{ $task->namakegiatan }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                        </div>
                        <div class="sm:col-span-2 mb-4">
                            <label for="deskripsi" class="block text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                            <textarea id="deskripsi" name="deskripsi" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">{{ $task->deskripsi }}</textarea>                    
                        </div>
                        <div class="flex mb-4">
                            <div class="mr-4">
                                <label for="volume" class="block text-sm font-medium text-gray-900 dark:text-white">Volume</label>
                                <input type="number" name="volume" id="volume" value="{{ $task->volume }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                            </div>
                            <div class="">
                                <label for="satuan" class="block text-sm font-medium text-gray-900 dark:text-white">Satuan</label>
                                <input type="text" name="satuan" id="satuan" value="{{ $task->satuan }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="tenggat" class="block text-sm font-medium text-gray-900 dark:text-white">Tenggat</label>
                            <input type="date" name="tenggat" id="tenggat" value="{{ $task->tenggat }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="attachment" class="block text-sm font-medium text-gray-900 dark:text-white">Upload Dokumen</label>
                        <p class="  text-xs text-gray-400">Ukuran maksimal file 5mb</p>
                        <input type="file" name="attachment" id="attachment" class="">
                    </div>

                    <button type="submit" class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        Perbarui Tugas
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

        <script>
            @if(session('updated'))
                toastr.success("{{ session('updated') }}");
            @endif
        </script>
    </main>

</x-layout>
