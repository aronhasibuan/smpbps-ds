<header>
    <nav class="bg-white border-gray-200 px-4 lg:px-6 py-2.5 dark:bg-gray-800" x-data="{profilemenu: false}">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">

            {{-- logo bps --}}
            <a href="#" class="flex items-center">
                <img src="{{ asset('img/Logo SM Raja.png') }}" class="mr-3 h-6 sm:h-9" alt="Logo BPS" />
            </a>

            <div class="flex items-center lg:order-2">
                
                {{-- menu profile & logout --}}
                <div class="md:block">
                    <div class="ml-4 flex items-center md:ml-6">
                        <div class="relative ml-3">
                          
                            <div class="relative">
                                <button type="button" @click="profilemenu = !profilemenu" class="relative flex max-w-xs items-center rounded-full bg-white dark:bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                    <span class="absolute -inset-1.5"></span>
                                    <span class="sr-only">Open user menu</span>
                                    <img class="size-8 rounded-full" x-data="{ darkMode: window.matchMedia('(prefers-color-scheme: dark)').matches }" x-init="window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', event => darkMode = event.matches)" :src="darkMode ? '{{ asset('img/profile-white.svg') }}' : '{{ asset('img/profile-black.svg') }}'" alt="Profile">
                                </button>
                            </div>
    
                            <div x-show="profilemenu"
                                x-transition:enter="transition ease-out duration-100 transform"
                                x-transition:enter-start="opacity-0 scale-95"
                                x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75 transform"
                                x-transition:leave-start="opacity-100 scale-100"
                                x-transition:leave-end="opacity-0 scale-95"
                                class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white dark:bg-gray-800 py-1 shadow-lg ring-1 ring-black/5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                                <a href="/profil" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-400" role="menuitem" tabindex="-1" id="user-menu-item-0">Profil</a>
                                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                                @csrf
                                    <button type="submit" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-400" style="background: none; border: none; cursor: pointer;">
                                        Keluar
                                    </button>
                                </form>
                            </div>
    
                        </div>
                    </div>
                </div>

                {{-- tombol buka menu mobile --}}
                <button id="menu-toggle" type="button" class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                    <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>

            {{-- nav link --}}
            <div class="hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1" id="mobile-menu">
                <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">

                    @if (Auth::check() && (Auth::user()->user_role == 'kepalabps'))
                        <li>
                            <x-nav-link href="{{ route('head-bps-home-page') }}" :active="request()->is('beranda-kepala-bps')">Beranda</x-nav-link>
                        </li>
                        <li>
                            <x-nav-link href="{{ route('team-list-page') }}" :active="request()->is('daftar-tim')">Daftar Tim</x-nav-link>
                        </li>
                        <li>
                            <x-nav-link href="{{ route('employee-list-page') }}" :active="request()->is('daftar-pegawai')">Daftar Pegawai</x-nav-link>
                        </li>
                        <li>
                            <x-nav-link href="{{ route('activities-monitoring-page') }}" :active="request()->is('monitoring-kegiatan')">Monitoring Kegiatan</x-nav-link>
                        </li>
                        <li>
                            <x-nav-link href="{{ route('employee-monitoring-page') }}" :active="request()->is('monitoring-pegawai')">Monitoring Pegawai</x-nav-link>
                        </li>
                        <li>
                            <x-nav-link href="{{ route('activities-archive-page') }}" :active="request()->is('arsip-kegiatan')">Arsip Kegiatan</x-nav-link>
                        </li>                            
                    @endif

                    @if (Auth::check() && (Auth::user()->user_role == 'ketuatim' ))
                        <li>
                            <x-nav-link href="{{ route('team-leader-home-page') }}" :active="request()->is('beranda-ketua-tim')">Beranda</x-nav-link>
                        </li>
                        <li>
                            <x-nav-link href="{{ route('activities-monitoring-page') }}" :active="request()->is('monitoring-kegiatan')">Monitoring Kegiatan</x-nav-link>
                        </li>
                        <li>
                            <x-nav-link href="{{ route('employee-monitoring-page') }}" :active="request()->is('monitoring-pegawai')">Monitoring Pegawai</x-nav-link>
                        </li>
                        <li>
                            <x-nav-link href="{{ route('activities-archive-page') }}" :active="request()->is('arsip-kegiatan')">Arsip Kegiatan</x-nav-link>
                        </li>
                        <li>
                            <x-nav-link href="{{ route('verification-page') }}" :active="request()->is('verifikasi')">Verifikasi</x-nav-link>
                        </li>              
                    @endif

                    @if (Auth::check() && Auth::user()->user_role == 'anggotatim')
                        <li>
                            <x-nav-link href="{{ route('team-member-home-page') }}" :active="request()->is('beranda-anggota-tim')">Beranda</x-nav-link>
                        </li>
                        <li>
                            <x-nav-link href="{{ route('task-list-page') }}" :active="request()->is('daftar-tugas')">Daftar Tugas</x-nav-link>
                        </li>
                        <li>
                            <x-nav-link href="{{ route('task-archive-page') }}" :active="request()->is('arsip-tugas')">Arsip Tugas</x-nav-link>
                        </li>
                        <li>
                            <x-nav-link href="{{ route('objection-list-page') }}" :active="request()->is('daftar-sanggahan')">Daftar Sanggahan</x-nav-link>
                        </li>                                          
                    @endif

                </ul>
            </div>
                  
        </div>
    </nav>
</header>
<hr>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleButton = document.getElementById('menu-toggle');
        const menu = document.getElementById('mobile-menu');

        toggleButton.addEventListener('click', function () {
            menu.classList.toggle('hidden');
        });
    });
</script>