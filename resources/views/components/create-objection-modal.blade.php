<div id="objectionModal" class="fixed inset-0 items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg w-full max-w-2xl border">
        <h2 class="text-lg font-semibold mb-4 text-black dark:text-white">Ajukan Keberatan</h2>
        <form action="{{ route('create-objection', [$task->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
            <label for="task_progress">Jumlah Progress yang Ditugaskan </label>
            <input type="number" id="task_progress" name="taks_progress" value="{{ $task->task_volume}}" class="text-gray-900 border border-gray-300 bg-gray-50 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 p-3 rounded-md w-full" readonly>

            <label for="objection_reason" class="mt-4 block">Alasan Keberatan<span class="text-red-500">*</span></label>
            <textarea type="text" id="objection_reason" name="objection reason" class="text-gray-900 border border-gray-300 bg-gray-50 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 p-3 rounded-md w-full" autocomplete="off" cols="30" rows="10"></textarea>

            <div class="flex justify-end mt-4">
                <button id="closeObjection" type="button" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition">Batal</button>
                <button id="submitObjection" class="bg-blue-600 text-white px-4 py-2 rounded-md ml-2 hover:bg-blue-700 transition">Kirim</button>
            </div>

        </form>
    </div>
</div>