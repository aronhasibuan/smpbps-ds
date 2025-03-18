<x-layout>
    <div class="min-h-screen">

        {{-- Judul Halaman --}}
        <p class="text-sm text-gray-600">Monitoring Kegiatan</p>

        {{-- Button Menambah Tugas --}}
        <div class="flex justify-between py-4">
            @if (Auth::check() && Auth::user()->role == 'ketuatim')
                <div class="flex mb-10">
                    <button id="defaultModalButton" data-modal-target="defaultModal" data-modal-toggle="defaultModal" class="block text-white bg-[#37b5fd] hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800" type="button">
                    + Tambah Kegiatan
                    </button>
                </div>  
            @endif
        </div>
    
        @if (Auth::check() && Auth::user()->role == 'ketuatim')
        <!-- Form Tambah Tugas -->
        <div id="defaultModal" tabindex="-1" aria-hidden="true" class="hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full h-modal">
            <div class="relative w-full max-w-7xl h-[90vh] overflow-y-scroll">
                <div class="relative p-4 bg-white shadow">

                    <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5">
                        <h3 class="text-lg font-semibold text-gray-900">Tambah Kegiatan</h3>

                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="defaultModal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>

                    <form action="{{ route('home') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                        <div class="mb-8">
                            <div class="mb-4">
                                <label for="namakegiatan" class="block text-sm font-medium text-gray-900 dark:text-white">Nama Kegiatan</label>
                                <p class="text-xs text-gray-400">Contoh: Susenas Maret 2025</p>
                                <input type="text" name="namakegiatan" id="namakegiatan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-80 p-2.5" required="" autocomplete="off">
                            </div>

                            <div class="flex mb-4">
                                <div id="taskContainer" class="w-full">
                                    <div class="flex task-item w-full space-x-4 mb-2">

                                        <div class="mr-4">
                                            <label class="block text-sm font-medium text-gray-900">Penerima Tugas</label>
                                            <p class="text-xs text-gray-400">Pilih anggota tim untuk ditugaskan</p>
                                            <select name="penerimatugas_id[]" class="penerimatugas bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-80 p-2.5">
                                                <option selected disabled>Pilih Anggota Tim</option>
                                                @foreach ($anggotatim as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                
                                        <div class="mr-4 flex-1">
                                            <label class="block text-sm font-medium text-gray-900">Deskripsi</label>
                                            <p class="text-xs text-gray-400">Contoh: Lakukan Pencacahan Pada Blok Sensus Terpilih</p>
                                            <input name="deskripsi[]" class="deskripsi block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500">
                                        </div>
                                
                                        <div>
                                            <label class="block text-sm font-medium text-gray-900">Volume</label>
                                            <p class="text-xs text-gray-400">Contoh: 10</p>
                                            <input type="number" name="volume[]" class="volume bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
                                        </div>
                                        
                                        <button type="button" class="remove-task bg-red-500 text-white p-1.5 h-5 rounded-full text-sm ml-4 inline-flex items-center invisible">
                                            <svg aria-hidden="true" class="w-2 h-2.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                            </svg>
                                        </button>
                                        
                                    </div>
                                </div>
                            </div>
                            
                            <button type="button" id="addTask" class="my-4 bg-green-500 text-white p-2 rounded flex mx-auto">Tambah Penerima Tugas</button>
                            
                            <div class="mb-4">
                                <label for="satuan" class="block text-sm font-medium text-gray-900">Satuan</label>
                                <p class="text-xs text-gray-400">Contoh: Blok Sensus</p>
                                <input type="text" name="satuan" id="satuan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-80 p-2.5" required="" autocomplete="off">
                            </div>

                            <div class="mb-4">
                                <label for="tenggat" class="block text-sm font-medium text-gray-900 dark:text-white">Tenggat</label>
                                <p class="  text-xs text-gray-400">Contoh: 30/04/2025</p>
                                <input type="date" name="tenggat" id="tenggat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-80 p-2.5" required="" autocomplete="off">
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
        
            document.getElementById("addTask").addEventListener("click", function () {
                let taskContainer = document.getElementById("taskContainer");
                let firstTask = taskContainer.querySelector(".task-item");

                if (firstTask) {
                    let newTask = firstTask.cloneNode(true);

                    newTask.querySelectorAll("input").forEach(input => {
                        input.value = "";
                    });

                    newTask.querySelectorAll("select").forEach(select => {
                        select.selectedIndex = 0; 
                    });

                    newTask.querySelectorAll("label, p").forEach(element => element.remove());

                    let removeButton = newTask.querySelector(".remove-task");
                    removeButton.classList.remove("invisible");

                    removeButton.addEventListener("click", function () {
                        if (taskContainer.children.length > 1) {
                            newTask.remove();
                        } else {
                            alert("Minimal harus ada satu tugas!");
                        }
                    });

                    taskContainer.appendChild(newTask);
                }
            });
        </script>   

        @endif

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