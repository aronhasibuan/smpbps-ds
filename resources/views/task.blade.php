<x-layout>
    <main class="pb-16 bg-white dark:bg-gray-800">
        <div class=" justify-between px-4 mx-auto max-w-screen-xl">
            <div class="mx-auto w-full">
                <div class="not-format">

                    @if (Auth::check() && Auth::user()->role == 'ketuatim')
                    <a href="/monitoringkegiatan/{{ $task->kegiatan->slug }}" class="font-medium text-base text-blue-600 hover:underline">&laquo; Kembali</a>
                    @endif

                    @if (Auth::check() && Auth::user()->role == 'anggotatim')
                    <a href="/daftarkegiatan" class="font-medium text-base text-blue-600 hover:underline">&laquo; Kembali</a>
                    @endif

                    <div class="flex justify-between items-center mb-5 text-gray-500 mt-2">
                        @php
                            $colorMap = [
                                'Selesai' => 'bg-blue-500',
                                'Terlambat' => 'bg-black',
                                'Progress Lambat' => 'bg-red-500',
                                'Progress On Time' => 'bg-yellow-500',
                                'Progress Cepat' => 'bg-green-500'
                            ];
                            $backgroundColor = $colorMap[$task->kemajuan['status']] ?? 'bg-gray-500';
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
                        <p class="text-sm md:text-base text-black font-bold dark:text-white">Tenggat Pekerjaan: {{ $task->formatted_tenggat }}</p>
                    </div>

                </div>

                <div class="border-t border-b border-gray-300 text-black">
                    <p class="dark:text-white mb-4">Deskripsi Pekerjaan: {{ $task->deskripsi }}</p>
                    <p class="dark:text-white">Banyak Pekerjaan: {{ $task->volume }} {{ $task->satuan }}</p>
                </div>

                <div>
                    <div class="mt-8">
                        @if ($task->attachment)
                            <div class="cursor-pointer mb-10">
                                <a href="{{ url('/file/' . basename($task->attachment)) }}" target="_blank" class="no-underline bg-[#228be6] text-white text-md p-2 rounded-md">Lihat Lampiran</a>
                            </div>
                        @endif
                    </div>

                    <label class="text-gray-700 font-bold mb-2 block dark:text-white">Progress Pekerjaan:</label>
                    
                    <ul class="relative border-s border-gray-200 dark:border-gray-700 list-none">     
                        @foreach ($progresses as $progress)                                     
                            <li class="mb-10 ms-6">            
                                <span class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -start-3 ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
                                    <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                    </svg>
                                </span>
                                <h3 class="flex items-center mb-1 text-lg font-semibold text-gray-900 dark:text-white">Jumlah Progress: {{ $progress->progress }} {{ $task->satuan }}
                                    @if ($loop->last)    
                                        <span class="bg-blue-100 text-blue-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-blue-900 dark:text-blue-300 ms-3">Progress Terbaru</span>
                                    @endif 
                                </h3>
                                <time class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">Tanggal Progress: {{ $progress->formatted_tanggal }}</time>
                                <p class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400">{{ $progress->catatan }}</p>
                                @if ($progress->dokumentasi)
                                    <div class="cursor-pointer mb-10">
                                        <a href="{{ url('/file/' . basename($progress->dokumentasi)) }}" target="_blank" class="no-underline inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-gray-100 focus:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700">Lihat Dokumentasi</a>
                                    </div>
                                @endif
                            </li>
                        @endforeach
                    </ul>

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
                    <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg w-full max-w-2xl border">
                        <h2 class="text-lg font-semibold mb-4 text-black dark:text-white">Masukkan Progress Terbaru</h2>
                        <form action="{{ route('updateprogress', [$task->slug, $task->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                            <label for="quantity">Jumlah Progress Terbaru <span class="text-red-500">*</span></label>
                            <input type="number" id="quantity" name="quantity" min="{{ $task->latestprogress + 1}}" value="{{ $task->latestprogress + 1 }}" max="{{ $task->volume }}" class="text-gray-900 border border-gray-300 bg-gray-50 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 p-3 rounded-md w-full">

                            <label for="note" class="mt-4 block">Catatan/Kendala Perkerjaan</label>
                            <input type="text" id="catatan" name="catatan" class="text-gray-900 border border-gray-300 bg-gray-50 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 p-3 rounded-md w-full" autocomplete="off">
                                                        
                            <label class="inline-flex items-center cursor-pointer mt-4">
                                <input type="checkbox" id="uploadCheckbox" class="sr-only peer">
                                <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 dark:peer-checked:bg-blue-600"></div>
                                <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Upload Dokumentasi?</span>
                            </label>
                            
                            <div id="uploadInputContainer" class="hidden mt-4">
                                <label for="dokumentasi" class="block text-sm font-medium text-gray-900 dark:text-white">Images (.jpg atau .png)</label>
                                <input type="file" id="dokumentasi" name="dokumentasi" accept="image/*" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:text-gray-400 dark:border-gray-600 dark:placeholder-gray-400 dark:bg-gray-700 dark:focus:ring-blue-500 dark:focus:border-blue-500">                            </div>

                            <div class="flex justify-end mt-4">
                                <button id="closeModal" type="button" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition">Batal</button>
                                <button id="submitData" class="bg-blue-600 text-white px-4 py-2 rounded-md ml-2 hover:bg-blue-700 transition">Kirim</button>
                            </div>

                        </form>
                    </div>
                </div>
            @endif
        
            @if (Auth::check() && Auth::user()->role == 'ketuatim' && $task->active)
            <div>
                <div class="flex justify-center gap-4 mt-20">

                    <button class="text-sm md:text-base bg-blue-600 text-white px-6 py-3 rounded-full hover:bg-blue-700 transition duration-200" id="defaultModalButton" data-modal-target="defaultModal" data-modal-toggle="defaultModal" type="button">
                        Perbarui Tugas
                    </button>

                    <button id="deleteButton" data-modal-target="deleteModal" data-modal-toggle="deleteModal"  class="text-sm md:text-base bg-red-600 inline-flex text-white px-6 py-3 rounded-full hover:bg-red-700 transition duration-200">
                        <svg class="w-5 h-5 mr-1 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                        Hapus Tugas
                    </button>
                    
                </div>

                {{-- delete task modal --}}
                <div id="deleteModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                    <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                        <div class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                            <button type="button" class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="deleteModal">
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                            <svg class="text-gray-400 dark:text-gray-500 w-11 h-11 mb-3.5 mx-auto" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                            <p class="mb-4 text-gray-500 dark:text-gray-300">Apakah anda yakin ingin menghapus tugas ini? Tindakan ini tidak dapat dibatalkan</p>
                            <div class="flex justify-center items-center space-x-4">
                                <button data-modal-toggle="deleteModal" type="button" class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                    Tidak, Batalkan
                                </button>
                                <form action="{{ route('deletetask', $task->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                                        Ya, Saya Yakin
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- update task modal -->
                <div id="defaultModal" tabindex="-1" class="hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                    <div class="relative w-full max-w-2xl max-h-[90vh] md:h-auto overflow-y-auto overflow-x-hidden">
                        <div class="relative p-4 bg-white shadow dark:bg-gray-800 sm:p-5">

                            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                    Perbarui Tugas
                                </h3>

                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="defaultModal">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>

                            <form action="{{ route('updatetask', $task->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                                <div>
                                    <div class="mb-6">
                                        <label for="volume" class="block text-sm font-medium text-gray-900 dark:text-white">Volume</label>
                                        <input type="number" name="volume" id="volume" value="{{ $task->volume }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                                    </div>
                                    
                                    <div class="mb-6">
                                        <label class="block text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                                        <textarea name="deskripsi" class="deskripsi bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full h-11 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="" autocomplete="off">{{ $task->deskripsi }}</textarea>
                                    </div>
                            
                                    <div class="mb-6">
                                        <label for="attachment" class="block text-sm font-medium text-gray-900 dark:text-white">Upload Dokumen</label>
                                        <p class="text-xs text-gray-400">Ukuran maksimal file 5mb</p>
                                        <input type="file" name="attachment" id="attachment" class="">
                                    </div>

                                    <button type="submit" class="justify-center text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                        Perbarui Tugas
                                    </button>
                                </div>
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

                    document.addEventListener("DOMContentLoaded", function () {
                        const uploadCheckbox = document.getElementById("uploadCheckbox");
                        const uploadInputContainer = document.getElementById("uploadInputContainer");

                        uploadCheckbox.addEventListener("change", function () {
                            if (this.checked) {
                                uploadInputContainer.classList.remove("hidden");
                            } else {
                                uploadInputContainer.classList.add("hidden");
                            }
                        });
                    });
                </script>
            @endif

            <script>
                @if(session('updated'))
                    toastr.success("{{ session('updated') }}");
                @endif
                @if(session('error'))
                    toastr.error("{{ session('error') }}");
                @endif

            </script>
        </div>
    </main>
</x-layout>