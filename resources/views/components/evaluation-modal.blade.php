<div id="evaluationModal" class="fixed inset-0 items-center justify-center bg-black/50 backdrop-blur-sm hidden z-50 transition-opacity duration-300 ease-in-out">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl p-6 w-full max-w-md mx-4 transform transition-all duration-300 ease-out scale-95 opacity-0" id="evaluationModalContent">
        <!-- Modal Header -->
        <div class="flex items-start justify-between mb-5">
            <div>
                <h2 class="text-xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                    Penilaian Tugas
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Berikan penilaian untuk penyelesaian tugas</p>
            </div>
            <button onclick="closeEvaluationModal()" class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300 transition-colors p-1 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form id="completeTaskForm" action="{{ route('create-evaluation', $progress->id) }}" method="POST">
            @csrf

            <!-- Penilaian Kerapian -->
            <div class="mb-6">
                <label for="evaluation_tidiness" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                    Kerapian
                    <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <select name="evaluation_tidiness" id="evaluation_tidiness" required
                            class="appearance-none w-full px-4 py-3 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 pr-10">
                        <option value="" disabled selected class="text-gray-400">Pilih tingkat kerapian</option>
                        <option value="Sangat Tidak Rapi">Sangat Tidak Rapi</option>
                        <option value="Tidak Rapi">Tidak Rapi</option>
                        <option value="Cukup Rapi">Cukup Rapi</option>
                        <option value="Rapi">Rapi</option>
                        <option value="Sangat Rapi">Sangat Rapi</option>
                    </select>
                </div>
            </div>

            <!-- Penilaian Kelengkapan -->
            <div class="mb-8">
                <label for="evaluation_comprehensiveness" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                    Kelengkapan
                    <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <select name="evaluation_comprehensiveness" id="evaluation_comprehensiveness" required
                            class="appearance-none w-full px-4 py-3 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 pr-10">
                        <option value="" disabled selected class="text-gray-400">Pilih tingkat kelengkapan</option>
                        <option value="Sangat Tidak Lengkap">Sangat Tidak Lengkap</option>
                        <option value="Tidak Lengkap">Tidak Lengkap</option>
                        <option value="Cukup Lengkap">Cukup Lengkap</option>
                        <option value="Lengkap">Lengkap</option>
                        <option value="Sangat Lengkap">Sangat Lengkap</option>
                    </select>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="flex justify-end space-x-3">
                <button type="button" onclick="closeEvaluationModal()" 
                        class="px-5 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-lg transition-colors duration-200">
                    Batal
                </button>
                <button type="submit" 
                        class="px-5 py-2.5 text-sm font-medium text-white bg-green-600 hover:bg-green-700 rounded-lg transition-colors duration-200 flex items-center gap-2 shadow-sm hover:shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Simpan Penilaian
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openEvaluationModal() {
        const modal = document.getElementById('evaluationModal');
        const content = document.getElementById('evaluationModalContent');
        
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        
        setTimeout(() => {
            content.classList.remove('scale-95', 'opacity-0');
            content.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closeEvaluationModal() {
        const modal = document.getElementById('evaluationModal');
        const content = document.getElementById('evaluationModalContent');
        
        content.classList.remove('scale-100', 'opacity-100');
        content.classList.add('scale-95', 'opacity-0');
        
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }, 300);
    }

    // Auto-open if there are validation errors
    @if($errors->any())
    document.addEventListener('DOMContentLoaded', function() {
        openEvaluationModal();
    });
    @endif
</script>