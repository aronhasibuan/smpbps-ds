<x-layout>
    <main class="pt-4 pb-16 bg-white dark:bg-gray-800">
        <div class=" justify-between px-4 mx-auto max-w-screen-xl">
            <div class="mx-auto w-full max-w-4xl format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
                <div class="not-format">

                    @if (Auth::check() && Auth::user()->role == 'ketuatim')
                    <a href="javascript:history.back()" class="font-medium text-base text-blue-600 hover:underline">&laquo; Kembali</a>
                    @endif

                    @if (Auth::check() && Auth::user()->role == 'anggotatim')
                    <a href="/home" class="font-medium text-base text-blue-600 hover:underline">&laquo; Kembali</a>
                    @endif

                    <div class="flex justify-between items-center mb-5 text-gray-500 mt-2">
                        @php
                            $color = $task->kemajuan['color'];
                            $backgroundColor = in_array($color, ['red', 'yellow', 'green']) ? "bg-{$color}-500" : 'bg-black'; 
                        @endphp

                        <div class="py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <p class="{{ $backgroundColor }} text-white rounded-md w-36 text-center text-sm">{{ $task->kemajuan['status'] }}</p>
                        </div>
                    </div>

                    <h1 class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl dark:text-white">{{ $task->namakegiatan }}</h1>

                    <div class="block md:flex items-center mb-3 not-italic justify-between">
                        <div class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white">
                            <p class="text-sm md:text-base text-gray-500 dark:text-white">{{ $task->pemberitugas->name }} - {{ $task->formatted_createdat }}</p>
                        </div>
                        <p class="text-sm md:text-base text-black dark:text-white">Tenggat Pekerjaan: {{ $task->formatted_tenggat }}</p>
                    </div>

                </div>

                <div class="border-t border-b border-gray-300 text-black">
                    <p class="dark:text-white">Deskripsi Pekerjaan: <br> {{ $task->deskripsi }}</p>
                    <p class="dark:text-white">Banyak Pekerjaan: {{ $task->volume }} {{ $task->satuan }}</p>
                </div>

                <div class="mb-4">
                    @if ($task->attachment)
                        <div class="cursor-pointer mb-10">
                            <a href="{{ url('/file/' . basename($task->attachment)) }}" target="_blank" class="no-underline bg-[#228be6] text-white text-md p-2 rounded-md">Lihat Lampiran</a>
                        </div>
                    @endif

                    <label class="text-gray-700 font-bold mb-2 block dark:text-white">Progress Pekerjaan:</label>

                    <table class="flex">
                        <tr class="bg-white dark:bg-gray-800 border border-black dark:border-white">
                            <th class="text-left">Tanggal</th>
                            @foreach ($progresses as $progress)
                                <th class="text-center">{{ $progress->formatted_tanggal }}</th>
                            @endforeach
                        </tr>
                        <tr class="bg-white dark:bg-gray-800 border border-black  dark:border-white">
                            <th class="text-left">Progress</th>
                            @foreach ($progresses as $progress)
                                <th class="text-center">{{ $progress->progress }}</th>                        
                            @endforeach
                        </tr>
                    </table>

                    <div class="relative w-full bg-gray-300 rounded-full h-6">
                        <div class="w-full h-6 bg-gray-200 rounded-full dark:bg-gray-700">
                            <div class="h-6 bg-blue-600 rounded-full dark:bg-blue-500 text-sm font-medium text-blue-100 text-center" style="width: {{ $task->percentage_progress }}%">{{ $task->percentage_progress }}%</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Update Progress --}}
            @if (Auth::check() && Auth::user()->role == 'anggotatim' && $task->active)
                <div class="flex justify-center gap-4 mt-20">
                    <button type="submit" id="openModal" class="bg-blue-600 text-white px-6 py-3 rounded-full hover:bg-blue-700 transition duration-200">
                        Perbarui Progress
                    </button>
                </div>
        
                <div id="popupModal" class="fixed inset-0 items-center justify-center bg-opacity-50 hidden">
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-96 border">
                        <h2 class="text-lg font-semibold mb-4 text-black dark:text-white">Masukkan Progress Terbaru</h2>
                        <form action="{{ route('tasks.updateprogress', $task->id) }}" method="POST">
                        @csrf
                            <input type="number" id="quantity" name="quantity" min="{{ $task->latestprogress + 1}}" value="{{ $task->latestprogress + 1 }}" max="{{ $task->volume }}" class="text-gray-900 border border-gray-300 bg-gray-50 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 p-2 rounded-md w-full">
                                <div class="flex justify-end mt-4">
                                    <button id="closeModal" type="button" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition">Batal</button>
                                    <button id="submitData" class="bg-blue-600 text-white px-4 py-2 rounded-md ml-2 hover:bg-blue-700 transition">Kirim</button>
                                </div>
                        </form>
                    </div>
                </div>
            @endif
        
            {{-- update and delete task --}}
            @if (Auth::check() && Auth::user()->role == 'ketuatim')
            <div>
                <div class="flex justify-center gap-4 mt-20">

                    <button class="text-sm md:text-base bg-blue-600 text-white px-6 py-3 rounded-full hover:bg-blue-700 transition duration-200" id="defaultModalButton" data-modal-target="defaultModal" data-modal-toggle="defaultModal" type="button">
                        Perbarui Tugas
                    </button>

                    <form action="/tasks/{{ $task->id }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus tugas ini?');">
                    @csrf
                    @method('DELETE')
                        <button class="text-sm md:text-base bg-red-600 inline-flex text-white px-6 py-3 rounded-full hover:bg-red-700 transition duration-200">
                            <svg class="w-5 h-5 mr-1 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                            Hapus Tugas
                        </button>
                    </form>
                </div>

                <!-- update task modal -->
                <div id="defaultModal" tabindex="-1" aria-hidden="true" class="hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                    <div class="relative w-full max-w-2xl max-h-[90vh] md:h-auto overflow-y-auto overflow-x-hidden">
                        <div class="relative p-4 bg-white shadow dark:bg-gray-800 sm:p-5">

                            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                    Perbarui Tugas
                                </h3>

                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="defaultModal">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>

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
            </div>
            @endif
    
            @if (Auth::check() && Auth::user()->role == 'ketuatim')
                <script>
                    document.addEventListener("DOMContentLoaded", function(event) {
                        document.getElementById('defaultModalButton').click();
                    });
                </script>
            @endif

            @if (Auth::check() && Auth::user()->role == 'anggotatim' && $task->active)
                <script>
                    const modal = document.getElementById('popupModal');
                    const openModal = document.getElementById('openModal');
                    const closeModal = document.getElementById('closeModal');
                    openModal.addEventListener('click', function () {
                        modal.classList.remove('hidden');
                        modal.classList.add('flex');
                    });
                    closeModal.addEventListener('click', function () {
                        modal.classList.add('hidden');
                        modal.classList.remove('flex');
                    });
                </script>
            @endif

            <script>
                @if(session('updated'))
                    toastr.success("{{ session('updated') }}");
                @endif
            </script>
        </div>
    </main>
</x-layout>