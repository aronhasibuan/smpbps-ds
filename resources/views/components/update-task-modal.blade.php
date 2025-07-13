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

            <form action="{{ route('update-task', $task->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                <div>
                    <div class="mb-6">
                        <label for="task_volume" class="block text-sm font-medium text-gray-900 dark:text-white">Volume</label>
                        <input  type="number" 
                                name="task_volume" 
                                id="task_volume" 
                                value="{{ $task->task_volume }}"
                                min="{{ $task->task_latest_progress + 1 }}" 
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                required="">
                    </div>
                    
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                        <textarea   name="task_description" 
                                    class="deskripsi bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full h-11 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                    required="" 
                                    autocomplete="off">{{ $task->task_description }}
                        </textarea>
                    </div>
            
                    <div class="mb-6">
                        <label for="task_attachment" class="block text-sm font-medium text-gray-900 dark:text-white">Upload Dokumen</label>
                        <p class="text-xs text-gray-400">Ukuran maksimal file 5mb</p>
                        <input  type="file" 
                                name="task_attachment" 
                                id="task_attachment" 
                                class="">
                    </div>

                    <button type="submit" class="justify-center text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        Perbarui Tugas
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>