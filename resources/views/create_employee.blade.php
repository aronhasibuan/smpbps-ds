<x-layout>
    <div class="bg-white dark:bg-gray-800 py-6 px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb Navigation -->
        <nav class="flex mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2">
                <li class="inline-flex items-center">
                    <a href="/kepalabps/daftarpegawai" class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                        <svg class="w-3 h-3 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                        </svg>
                        Kembali ke Daftar Pegawai
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Tambah Pegawai</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Form Header -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Tambah Pegawai Baru</h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Isi form berikut untuk menambahkan pegawai baru ke sistem</p>
        </div>
    
            <form action="{{ route('createemployee') }}" method="POST" enctype="multipart/form-data">
            @csrf

                <div class="mb-3">
                    <label for="team_id" class="block text-sm font-medium text-gray-900 dark:text-white">Tim</label>
                    <select name="team_id" id="team_id" class="w-1/2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"> 
                        <option selected disabled>Pilih Tim</option>
                        @foreach($teams as $team)
                            <option value="{{ $team->id }}">{{ $team->team_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="user_full_name" class="block text-sm font-medium text-gray-900 dark:text-white">Nama Lengkap</label>
                    <input type="text" name="user_full_name" id="user_full_name" class="w-1/2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="" autocomplete="off">
                </div> 

                <div class="mb-3">
                    <label for="user_nickname" class="block text-sm font-medium text-gray-900 dark:text-white">Nama Panggilan</label>
                    <input type="text" name="user_nickname" id="user_nickname" class="w-1/2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="" autocomplete="off">
                </div> 

                <div class="mb-3">
                    <label for="user_role" class="block text-sm font-medium text-gray-900 dark:text-white">Peran</label>
                    <select name="user_role" id="user_role" class="w-1/2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"> 
                        <option selected disabled>Pilih Peran</option>
                        <option value="ketuatim">Ketua Tim</option>
                        <option value="anggotatim">Anggota Tim</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="email" class="block text-sm font-medium text-gray-900 dark:text-white">Email</label>
                    <input type="email" name="email" id="email" class="w-1/2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="" autocomplete="off">
                </div>

                <div class="mb-3">
                    <label for="password" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Kata Sandi</label>
                    <input type="password" name="password" id="password" placeholder="••••••••" class="w-1/2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 required="" autocomplete="off">
                </div>

                <div class="mb-3">
                    <label for="user_whatsapp_number" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Nomor Whatsapp</label>
                    <input type="tel" name="user_whatsapp_number" id="user_whatsapp_number" class="w-1/2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="" autocomplete="off">
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