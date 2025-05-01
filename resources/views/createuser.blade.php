<x-layout>
    <div class="bg-white dark:bg-gray-800">
        <div class="py-4 px-4 mx-auto">

            <a href="/administrator" class="font-medium text-base text-blue-600 hover:underline">&laquo; Kembali</a>

            <h2 class="mb-4 mt-4 text-xl font-bold text-gray-900 dark:text-white">Tambah Pengguna</h2>
    
            <form action="{{ route('createuser') }}" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="mb-3">
                    <label for="name" class="block text-sm font-medium text-gray-900 dark:text-white">Nama Lengkap</label>
                    <input type="text" name="name" id="name" class="w-1/2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="" autocomplete="off">
                </div> 

                <div class="mb-3">
                    <label for="username" class="block text-sm font-medium text-gray-900 dark:text-white">Nama Panggilan</label>
                    <input type="text" name="username" id="username" class="w-1/2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="" autocomplete="off">
                </div> 

                <div class="mb-3">
                    <label for="email" class="block text-sm font-medium text-gray-900 dark:text-white">Email</label>
                    <input type="email" name="email" id="email" class="w-1/2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="" autocomplete="off">
                </div>

                <div class="mb-3">
                    <label for="role" class="block text-sm font-medium text-gray-900 dark:text-white">Peran</label>
                    <select type="role" name="role" id="role" class="w-1/2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"> 
                        <option selected disabled>Pilih Peran</option>
                        <option value="ketuatim">Ketua Tim</option>
                        <option value="anggotatim">Anggota Tim</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="password" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Kata Sandi</label>
                    <input type="password" name="password" id="password" placeholder="••••••••" class="w-1/2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 required="" autocomplete="off">
                </div>

                <div class="mb-3">
                    <label for="no_hp" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Nomor Whatsapp</label>
                    <input type="tel" name="no_hp" id="no_hp" class="w-1/2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="" autocomplete="off">
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