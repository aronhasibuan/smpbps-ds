<x-layout>
    <div class="bg-white dark:bg-gray-900">
        <div class="py-4 px-4 mx-auto">

            <a href="/ketuatim/monitoringkegiatan" class="font-medium text-base text-blue-600 hover:underline">&laquo; Kembali</a>

            <h2 class="mb-4 mt-4 text-xl font-bold text-gray-900 dark:text-white">Tambah Kegiatan</h2>
    
            <form id="createTaskForm" action="{{ route('task.create') }}" method="POST" enctype="multipart/form-data">
            @csrf
                @if($errors->any())
                    <div class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 text-red-700">
                        <ul class="list-disc pl-5">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="mb-4">
                    <label for="activity_name" class="block text-sm font-medium text-gray-900 dark:text-white">Nama Kegiatan</label>
                    <p class="text-xs text-gray-400">Contoh: Susenas Maret 2025</p>
                    <input type="text" name="activity_name" id="activity_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="" autocomplete="off">
                </div>

                <div class="md:mb-4 mb-10">
                    <label for="activity_start" class="block text-sm font-medium text-gray-900 dark:text-white">Mulai Pekerjaan</label>
                    <p class="  text-xs text-gray-400">Contoh: 19/09/2025</p>
                    <input type="date" name="activity_start" id="activity_start" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="" autocomplete="off">
                </div>

                <div class="md:mb-4 mb-10">
                    <label for="activity_end" class="block text-sm font-medium text-gray-900 dark:text-white">Tenggat Pekerjaan</label>
                    <p class="  text-xs text-gray-400">Contoh: 19/10/2025</p>
                    <input type="date" name="activity_end" id="activity_end" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="" autocomplete="off">
                </div>

                <div id="taskContainer" class="w-full">
                    <div class="task-item grid w-full md:grid-cols-5 grid-cols-1 gap-4 mb-6 md:border-none border md:p-0 p-4">

                        <div>
                            <label class="block text-sm font-medium text-gray-900 dark:text-white">Penerima Tugas</label>
                            <p class="text-xs text-gray-400">Pilih Penerima Tugas</p>
                            <select name="user_member_id[]" class="user_member_id bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option selected disabled>Pilih Anggota Tim</option>
                                @foreach ($anggotatim as $user)
                                    <option value="{{ $user->id }}" data-lintas-tim="{{ $user->team_id != auth()->user()->team_id ? '1' : '0' }}">
                                        {{ $user->user_full_name }}@if ($user->team_id != auth()->user()->team_id) - (Lintas Tim)@endif
                                    </option>
                                @endforeach
                            </select>
                        </div>
                            
                        <div>
                            <label class="block text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                            <p class="text-xs text-gray-400">Deskripsi Pekerjaan</p>
                            <textarea name="task_description[]" class="task_description bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full h-11 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="" autocomplete="off"></textarea>
                        </div>
                            
                        <div>
                            <label class="block text-sm font-medium text-gray-900 dark:text-white">Volume</label>
                            <p class="text-xs text-gray-400">Contoh: 10</p>
                            <input type="number" name="task_volume[]" class="task_volume bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-900 dark:text-white">Upload Dokumen</label>
                            <p class="text-xs text-gray-400">Maximum size 5 mb</p>
                            <input type="file" name="task_attachment[]" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                        </div>

                        <button class="remove-task md:mt-0 mt-2 block text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 invisible" type="button">
                            Hapus Baris
                        </button>

                    </div>                                                    
                </div>
                            
                <div>
                    <button type="button" id="addTask" class="my-4 bg-green-700 text-white p-2 rounded flex mx-auto" aria-label="Tambah penerima tugas baru">
                        Tambah Penerima Tugas
                    </button>
                </div>         
            
                <div>
                    <label for="activity_unit" class="block text-sm font-medium text-gray-900 dark:text-white">Satuan</label>
                    <p class="text-xs text-gray-400">Contoh: Blok Sensus, Publikasi</p>
                    <input type="text" name="activity_unit" id="activity_unit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="" autocomplete="off">
                </div>
                   
                <button type="submit" id="submitForm" class="mt-4 text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                    <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                    Simpan
                </button>
            </form>

            <div id="confirmationModal" class="hidden fixed inset-0 bg-black bg-opacity-50 justify-center items-center z-50">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg max-w-md text-center">
                    <p class="mb-4 text-gray-800 dark:text-gray-100">Penerima tugas {{ $busiestUser->user_full_name }} memiliki jumlah tugas aktif terbanyak ( {{ $maxTasks }} tugas ). Apakah Anda ingin melanjutkan?</p>
                    <div class="flex justify-center gap-4">
                        <button id="confirmSubmit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Lanjut</button>
                        <button id="cancelSubmit" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded">Batal</button>
                    </div>
                </div>
            </div>
            
            <div id = "teamConfirmationModal" class="hidden fixed inset-0 bg-black bg-opacity-50 justify-center items-center z-50">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg max-w-md text-center">
                    <p class="mb-4 text-gray-800 dark:text-gray-100">Terdapat penerima tugas yang berasal dari tim yang lain. Apakah Anda ingin melanjutkan?</p>
                    <div class="flex justify-center gap-4">
                        <button id="teamConfirmSubmit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Lanjut</button>
                        <button id="teamCancelSubmit" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded">Batal</button>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const startDate = document.getElementById('activity_start');
            const endDate = document.getElementById('activity_end');
            
            startDate.addEventListener('change', function() {
                endDate.min = this.value;
            });
            
            endDate.addEventListener('change', function() {
                if (startDate.value && this.value < startDate.value) {
                    alert('Tanggal akhir tidak boleh sebelum tanggal mulai');
                    this.value = '';
                }
            });
        });
    </script>

    <script>
        document.querySelectorAll('input[type="file"]').forEach(input => {
            input.addEventListener('change', function() {
                const fileSize = this.files[0]?.size / 1024 / 1024; // in MB
                if (fileSize > 5) {
                    alert('Ukuran file melebihi 5MB');
                    this.value = '';
                }
            });
        });
    </script>
    
    <script>        
        document.getElementById("addTask").addEventListener("click", function () {
            let taskContainer = document.getElementById("taskContainer");
            let firstTask = taskContainer.querySelector(".task-item");

            if (firstTask) {
                let newTask = firstTask.cloneNode(true);

                newTask.querySelectorAll("input, textarea").forEach(element => {
                    element.value = "";
                });

                newTask.querySelectorAll("select").forEach(select => {
                    select.selectedIndex = 0; 
                });

                newTask.querySelectorAll("p").forEach(element => element.remove());

                if (!window.matchMedia("(max-width: 639px)").matches) { 
                    newTask.querySelectorAll("label").forEach(element => element.remove());
                }

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

        flatpickr("#tenggat", {
        dateFormat: "Y-m-d",  
        minDate: "today",      
        disableMobile: true 
        });

        const busiestUserId = "{{ $busiestUser->id ?? '' }}";

        document.getElementById("submitForm").addEventListener("click", function () {
            event.preventDefault();

            const selectedUsers = Array.from(document.querySelectorAll('.user_member_id')).map(select => select.value);

            if (selectedUsers.includes(busiestUserId)) {
                document.getElementById('confirmationModal').classList.remove('hidden');
                document.getElementById('confirmationModal').classList.add('flex');
            } else {
                document.getElementById('createTaskForm').submit();
            }
        });

        document.getElementById('confirmSubmit').addEventListener('click', function () {
            document.getElementById('createTaskForm').submit();
        });

        document.getElementById('cancelSubmit').addEventListener('click', function () {
            document.getElementById('confirmationModal').classList.add('hidden');
        });
    </script>

    <script>
        // Validasi lintas tim
        document.getElementById('createTaskForm').addEventListener('submit', function(e) {
            const crossTeamUsers = Array.from(document.querySelectorAll('.user_member_id option:checked[data-lintas-tim="1"]'));
            
            if (crossTeamUsers.length > 0) {
                e.preventDefault();
                document.getElementById('teamConfirmationModal').classList.remove('hidden');
            }
        });

        // Handler untuk modal lintas tim
        document.getElementById('teamConfirmSubmit').addEventListener('click', function() {
            document.getElementById('createTaskForm').submit();
        });

        document.getElementById('teamCancelSubmit').addEventListener('click', function() {
            document.getElementById('teamConfirmationModal').classList.add('hidden');
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
        if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

</x-layout> 