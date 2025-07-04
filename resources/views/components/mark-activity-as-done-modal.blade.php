<div id="confirmationModal" class="fixed inset-0 items-center justify-center bg-black bg-opacity-50 hidden z-50">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 w-96">
        <h2 class="text-lg font-bold mb-4 dark:text-white">Konfirmasi</h2>
        <p class="text-sm text-gray-700 mb-6 dark:text-gray-300">
            Apakah anda yakin menandai kegiatan ini selesai? Aksi ini tidak dapat dibatalkan.
        </p>
        <div class="flex justify-end gap-4">
            <button type="button" onclick="closeModal()" class="bg-gray-300 text-gray-700 dark:text-black px-4 py-2 rounded hover:bg-gray-400 transition duration-200">
                Batal
            </button>
            <form action="{{ route('mark-activity-as-done', ['activity' => $activity->activity_slug, 'id' => $activity->id]) }}" method="POST">
                @csrf
                @method('POST')
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-200">
                    Ya, Tandai Selesai
                </button>
            </form>
        </div>
    </div>
</div>
