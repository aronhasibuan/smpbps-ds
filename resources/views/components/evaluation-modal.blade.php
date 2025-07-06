<div id="evaluationModal" class="fixed inset-0 items-center justify-center bg-black bg-opacity-50 hidden z-50">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 w-96">
        <h2 class="text-lg font-semibold mb-4">Penilaian Tugas</h2>

        <form id="completeTaskForm" action="{{ route('create-evaluation', $progress->id) }}" method="POST">
            @csrf

            <!-- Penilaian Kerapian -->
            <label for="evaluation_tidiness" class="block mb-2">Kerapian:</label>
            <select name="evaluation_tidiness" id="evaluation_tidiness" required
                    class="w-full p-2 border rounded mb-4">
                <option value="" disabled selected>Pilih Kerapian</option>
                <option value="Sangat Tidak Rapi">Sangat Tidak Rapi</option>
                <option value="Tidak Rapi">Tidak Rapi</option>
                <option value="Cukup Rapi">Cukup Rapi</option>
                <option value="Rapi">Rapi</option>
                <option value="Sangat Rapi">Sangat Rapi</option>
            </select>

            <!-- Penilaian Kelengkapan -->
            <label for="evaluation_comprehensiveness" class="block mb-2">Kelengkapan:</label>
            <select name="evaluation_comprehensiveness" id="evaluation_comprehensiveness" required
                    class="w-full p-2 border rounded mb-4">
                <option value="" disabled selected>Pilih Kelengkapan</option>
                <option value="Sangat Tidak Lengkap">Sangat Tidak Lengkap</option>
                <option value="Tidak Lengkap">Tidak Lengkap</option>
                <option value="Cukup Lengkap">Cukup Lengkap</option>
                <option value="Lengkap">Lengkap</option>
                <option value="Sangat Lengkap">Sangat Lengkap</option>
            </select>

            <div class="flex justify-end space-x-2">
                <button type="button" onclick="closeAssessmentModal()" class="px-4 py-2 bg-gray-300 rounded">Batal</button>
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Simpan & Tandai Selesai</button>
            </div>
        </form>
    </div>
</div>


<script>
    function openEvaluationModal() {
        const modal = document.getElementById('evaluationModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeEvaluationModal() {
        const modal = document.getElementById('evaluationModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>