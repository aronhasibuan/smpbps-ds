<div id="info-popup" 
        tabindex="-1" 
        class="hidden fixed inset-0 items-center justify-center z-50 bg-black bg-opacity-40 p-4">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 max-w-md w-full">
        <div class="flex items-center gap-3 mb-4">
            <img src="{{ asset('img/information.svg') }}" 
                    alt="" 
                    class="w-6 h-6"
                    aria-hidden="true">
            <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                Informasi
            </h3>
        </div>
        <p class="mb-6 text-gray-600 dark:text-gray-300">
            Apabila Bapak/Ibu pegawai belum memiliki akun atau lupa password, dimohon untuk menghubungi
            <span class="font-semibold text-blue-600 dark:text-blue-400">Ketua Tim</span> atau
            <span class="font-semibold text-blue-600 dark:text-blue-400">Kepala BPS</span> guna proses pembuatan akun atau reset password.
        </p>
        <div class="flex justify-center">
            <button id="close-modal" 
                    type="button" 
                    class="flex items-center gap-2 px-6 py-2 font-semibold text-white bg-blue-600 rounded-lg shadow hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 transition-colors">
                <img src="{{ asset('img/cross.svg') }}" 
                        alt="" 
                        class="w-5 h-5"
                        aria-hidden="true">
                Tutup
            </button>
        </div>
    </div>
</div>