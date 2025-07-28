<div id="popupModal" class="fixed inset-0 items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg w-full max-w-2xl border">
        <h2 class="text-lg font-semibold mb-4 text-black dark:text-white">Masukkan Progress Terbaru</h2>
        <form action="{{ route('update-progress', [$task->task_slug, $task->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
            <label for="progress_amount">Jumlah Progress Terbaru <span class="text-red-500">*</span></label>
            <input type="number" id="progress_amount" name="progress_amount" min="{{ $task->task_latest_progress + 1}}" value="{{ $task->task_latest_progress + 1 }}" max="{{ $task->task_volume }}" class="text-gray-900 border border-gray-300 bg-gray-50 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 p-3 rounded-md w-full">

            <label for="progress_notes" class="mt-4 block">Catatan/Kendala Pekerjaan <span class="text-red-500">*</span></label>
            <input type="text" id="progress_notes" name="progress_notes" class="text-gray-900 border border-gray-300 bg-gray-50 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 p-3 rounded-md w-full" autocomplete="off">
                                        
            <label class="inline-flex items-center cursor-pointer mt-4">
                <input type="checkbox" id="uploadCheckbox" class="sr-only peer">
                <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 dark:peer-checked:bg-blue-600"></div>
                <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Upload Dokumentasi?</span>
            </label>
            
            <div id="uploadInputContainer" class="hidden mt-4">
                <label for="progress_documentation" class="block text-sm font-medium text-gray-900 dark:text-white">Images (.jpg atau .png)</label>
                <input type="file" id="progress_documentation" name="progress_documentation" accept="image/*" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:text-gray-400 dark:border-gray-600 dark:placeholder-gray-400 dark:bg-gray-700 dark:focus:ring-blue-500 dark:focus:border-blue-500">                            
            </div>

            <div class="flex justify-end mt-4">
                <button id="closeModal" type="button" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition">Batal</button>
                <button id="submitData" class="bg-blue-600 text-white px-4 py-2 rounded-md ml-2 hover:bg-blue-700 transition">Kirim</button>
            </div>

        </form>
    </div>
</div>