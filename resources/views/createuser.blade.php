<x-layout>
    <div class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto lg:py-16">

            <a href="/administrator" class="font-medium text-base text-blue-600 hover:underline">&laquo; Kembali</a>

            <h2 class="mb-4 mt-4 text-xl font-bold text-gray-900 dark:text-white">Tambah Pengguna</h2>
    
            <form action="" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="mb-4">
                    <label for="namakegiatan" class="block text-sm font-medium text-gray-900 dark:text-white">Nama Pengguna</label>
                    <p class="text-xs text-gray-400">Contoh: Susenas Maret 2025</p>
                    <input type="text" name="namakegiatan" id="namakegiatan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="" autocomplete="off">
                </div>

                <div class="md:mb-4 mb-10">
                    <label for="tenggat" class="block text-sm font-medium text-gray-900 dark:text-white">Tenggat Pekerjaan</label>
                    <p class="  text-xs text-gray-400">Contoh: 26/09/2025</p>
                    <input type="date" name="tenggat" id="tenggat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="" autocomplete="off">
                </div>

                <div>
                    <label for="satuan" class="block text-sm font-medium text-gray-900 dark:text-white">Satuan</label>
                    <p class="text-xs text-gray-400">Contoh: Blok Sensus, Publikasi</p>
                    <input type="text" name="satuan" id="satuan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="" autocomplete="off">
                </div>
                   
                <button type="submit" class="mt-4 text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                    <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                    Simpan
                </button>
            </form>

        </div>
    </div>


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
        if (window.location.pathname === "/tambahkegiatan") {
            const isDarkMode = window.matchMedia("(prefers-color-scheme: dark)").matches;
            if (isDarkMode) {
                document.documentElement.style.backgroundColor = "#111827"; // bg-gray-900
            } else {
                document.documentElement.style.backgroundColor = "#f9fafb"; // bg-gray-50
            }
        }
    </script>

</x-layout> 