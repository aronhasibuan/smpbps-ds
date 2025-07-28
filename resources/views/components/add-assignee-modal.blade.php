<div id="addTaskModal" tabindex="-1" aria-hidden="true" 
     class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-black bg-opacity-50">
    <div class="relative p-4 w-full max-w-4xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Tambah Penerima Tugas Baru
                </h3>
                <button type="button" 
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" 
                        onclick="closeaddassigneemodal()">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            
            <!-- Modal body -->
            <form action="{{ route('add-assignee', ['id' => $activity->id]) }}" method="POST" enctype="multipart/form-data" class="p-4 md:p-5">
                @csrf
                <input type="hidden" name="activity_id" value="{{ $activity->id }}">
                
                <div class="task-container">
                    <!-- Task item template -->
                    <div class="task-item grid w-full md:grid-cols-5 grid-cols-1 gap-4 mb-6 md:border-none border md:p-0 p-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-900 dark:text-white">Penerima Tugas</label>
                            <p class="text-xs text-gray-400">Pilih Penerima Tugas</p>
                            <select name="user_member_id" 
                                    required
                                    class="user_member_id bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="" selected disabled>Pilih Anggota Tim</option>
                                @foreach($teams as $team)
                                    <optgroup label="{{ $team->team_name }}" class="text-gray-900 dark:text-gray-300">
                                        @foreach($team->users as $user)
                                            <option value="{{ $user->id }}" 
                                                    class="@if($team->id != auth()->user()->team_id) text-blue-600 dark:text-blue-400 @endif">
                                                {{ $user->user_full_name }}
                                            </option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                        </div>
                            
                        <div>
                            <label class="block text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                            <p class="text-xs text-gray-400">Deskripsi Pekerjaan</p>
                            <textarea   name="task_description" 
                                        required
                                        class="task_description bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full h-11 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" autocomplete="off"></textarea>
                        </div>
                            
                        <div>
                            <label class="block text-sm font-medium text-gray-900 dark:text-white">Volume</label>
                            <p class="text-xs text-gray-400">Contoh: 10</p>
                            <input  type="number" 
                                    name="task_volume" 
                                    required 
                                    min="1"
                                    class="task_volume bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-900 dark:text-white">Upload Dokumen</label>
                            <p class="text-xs text-gray-400">Maximum size 5 mb</p>
                            <input  type="file" 
                                    name="task_attachment" 
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                    accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png">
                        </div>
                    </div>
                </div>        

                <!-- Modal footer -->
                <div class="flex justify-end pt-4">
                    <button type="button" 
                            onclick="closeaddassigneemodal()"
                            class="mr-2 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                        Batal
                    </button>
                    <button type="submit" 
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Tambah Penerima Tugas
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openaddassigneemodal(){
        const modal = document.getElementById("addTaskModal");
        modal.classList.remove("hidden");
        modal.classList.add("flex");
    }

    function closeaddassigneemodal(){
        const modal = document.getElementById("addTaskModal");
        modal.classList.add("hidden");
        modal.classList.remove("flex");
    }
</script>