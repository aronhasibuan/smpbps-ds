<div id="assessmentModal" class="fixed inset-0 items-center justify-center bg-black bg-opacity-50 hidden z-50 transition-opacity duration-300">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl p-6 w-full max-w-md transform transition-all duration-300 scale-95 opacity-0" id="modalContent">
        <!-- Modal Header -->
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Penilaian Tugas
            </h2>
            <button onclick="closeAssessmentModal()" class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form id="completeTaskForm" action="{{ route('mark-done', $objection->id) }}" method="POST">
            @csrf

            <!-- Penilaian Kerapian -->
            <div class="mb-6">
                <label for="evaluation_tidiness" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Kerapian:</label>
                <div class="relative">
                    <select name="evaluation_tidiness" id="evaluation_tidiness" required
                            class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 appearance-none">
                        <option value="" disabled selected class="text-gray-400">Pilih Kerapian</option>
                        <option value="Sangat Tidak Rapi">Sangat Tidak Rapi</option>
                        <option value="Tidak Rapi">Tidak Rapi</option>
                        <option value="Cukup Rapi">Cukup Rapi</option>
                        <option value="Rapi">Rapi</option>
                        <option value="Sangat Rapi">Sangat Rapi</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Penilaian Kelengkapan -->
            <div class="mb-6">
                <label for="evaluation_comprehensiveness" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Kelengkapan:</label>
                <div class="relative">
                    <select name="evaluation_comprehensiveness" id="evaluation_comprehensiveness" required
                            class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 appearance-none">
                        <option value="" disabled selected class="text-gray-400">Pilih Kelengkapan</option>
                        <option value="Sangat Tidak Lengkap">Sangat Tidak Lengkap</option>
                        <option value="Tidak Lengkap">Tidak Lengkap</option>
                        <option value="Cukup Lengkap">Cukup Lengkap</option>
                        <option value="Lengkap">Lengkap</option>
                        <option value="Sangat Lengkap">Sangat Lengkap</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="flex justify-end space-x-3">
                <button type="button" onclick="closeAssessmentModal()" 
                        class="px-4 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-600 hover:bg-gray-200 dark:hover:bg-gray-500 rounded-lg transition-colors">
                    Batal
                </button>
                <button type="submit" 
                        class="px-4 py-2.5 text-sm font-medium text-white bg-green-600 hover:bg-green-700 rounded-lg transition-colors flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Simpan & Tandai Selesai
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openAssessmentModal() {
        const modal = document.getElementById('assessmentModal');
        const content = document.getElementById('modalContent');
        
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        
        setTimeout(() => {
            modal.classList.remove('bg-opacity-0');
            content.classList.remove('scale-95', 'opacity-0');
            content.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closeAssessmentModal() {
        const modal = document.getElementById('assessmentModal');
        const content = document.getElementById('modalContent');
        
        content.classList.remove('scale-100', 'opacity-100');
        content.classList.add('scale-95', 'opacity-0');
        
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }, 300);
    }
</script>