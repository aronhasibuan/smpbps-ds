<x-layout>
    <div class="bg-white dark:bg-gray-900">
        <div class="py-8">

            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Tambah Kegiatan</h2>
    
            <form action="{{ route('home') }}" method="POST" enctype="multipart/form-data">
            @csrf

                <div class="mb-4">
                    <label for="namakegiatan" class="block text-sm font-medium text-gray-900 dark:text-white">Nama Kegiatan</label>
                    <p class="text-xs text-gray-400">Contoh: Susenas Maret 2025</p>
                    <input type="text" name="namakegiatan" id="namakegiatan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="" autocomplete="off">
                </div>

                <div class="mb-4">
                    <label for="tenggat" class="block text-sm font-medium text-gray-900 dark:text-white">Tenggat Pekerjaan</label>
                    <p class="  text-xs text-gray-400">Contoh: 26/09/2025</p>
                    <input type="date" name="tenggat" id="tenggat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="" autocomplete="off">
                </div>

                <div id="taskContainer" class="w-full">
                    <div class="task-item grid w-full grid-cols-5 gap-8 mb-2">

                        <div>
                            <label class="block text-sm font-medium text-gray-900 dark:text-white">Penerima Tugas</label>
                            <p class="text-xs text-gray-400">Pilih anggota tim untuk ditugaskan</p>
                            <select name="penerimatugas_id[]" class="penerimatugas bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option selected disabled>Pilih Anggota Tim</option>
                                @foreach ($anggotatim as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                            
                        <div>
                            <label class="block text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                            <p class="text-xs text-gray-400">Contoh: Listing, Pencacahan, Cleaning</p>
                            <textarea name="deskripsi[]" class="deskripsi bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full h-11 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="" autocomplete="off"></textarea>
                        </div>
                            
                        <div>
                            <label class="block text-sm font-medium text-gray-900 dark:text-white">Volume</label>
                            <p class="text-xs text-gray-400">Contoh: 10</p>
                            <input type="number" name="volume[]" class="volume bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                        </div>

                        <div>
                            <label for="attachment" class="block text-sm font-medium text-gray-900 dark:text-white">Upload Dokumen</label>
                            <p class="text-xs text-gray-400">Ukuran maksimal file 5mb</p>
                            <input type="file" name="attachment[]" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                        </div>

                        <button class="remove-task block text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 invisible" type="button">
                            Hapus Baris
                        </button>

                    </div>                                                    
                </div>
                            
                <div>
                    <button type="button" id="addTask" class="my-4 bg-green-700 text-white p-2 rounded flex mx-auto">Tambah Penerima Tugas</button>
                </div>         
            
                <div>
                    <label for="satuan" class="block text-sm font-medium text-gray-900 dark:text-white">Satuan</label>
                    <p class="text-xs text-gray-400">Contoh: Blok Sensus</p>
                    <input type="text" name="satuan" id="satuan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="" autocomplete="off">
                </div>
                   
                <button type="submit" class="mt-4 text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                    <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                    Simpan
                </button>
            </form>

        </div>
    </div>
    
    <script>        
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

</x-layout> 