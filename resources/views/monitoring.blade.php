<x-layout>
    <x-slot:headercontent>Selamat datang di {{ $headercontent }}, {{ auth()->user()->name }}</x-slot:headercontent>

    <section>
        {{-- High Priority Task --}}
        <div class="mb-10">
            <h3 class="bg-red-500 text-white font-medium p-1 w-fit rounded-md mb-1">Tingkat Prioritas Tinggi</h3>
            <table class="w-full text-left">
                <thead>
                    <tr>
                        <th class="p-2">Nama Kegiatan</th>
                        <th>Satuan</th>
                        <th>Volume</th>
                        <th>Tenggat</th>
                        <th>Penerima Tugas</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody class="">
                    @forelse ($HPTs as $hpt)
                        <tr class="bg-white border-b">
                            <td class="p-2">{{ $hpt->namakegiatan }}</td>
                            <td>{{ $hpt->satuan }}</td>
                            <td>{{ $hpt->volume }}</td>
                            <td>{{ $hpt->tenggat }}</td>
                            <td>{{ $hpt->penerimatugas->name }}</td>
                            <td>{{ $hpt->status }}</td>
                        </tr>
                        @empty
                        <tr class="bg-white">
                            <td class="p-2" colspan="6">Tidak ada tugas</td>
                        </tr>                        
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Medium Priority Task --}}
        <div class="mb-10">
            <h3 class="bg-yellow-500 text-white font-medium p-1 w-fit rounded-md mb-1">Tingkat Prioritas Sedang</h3>
            <table class="w-full text-left">
                <thead>
                    <tr>
                        <th class="p-2">Nama Kegiatan</th>
                        <th>Satuan</th>
                        <th>Volume</th>
                        <th>Tenggat</th>
                        <th>Penerima Tugas</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody class="">
                    @forelse ($MPTs as $mpt)
                        <tr class="bg-white border-b">
                            <td class="p-2">{{ $mpt->namakegiatan }}</td>
                            <td>{{ $mpt->satuan }}</td>
                            <td>{{ $mpt->volume }}</td>
                            <td>{{ $mpt->tenggat }}</td>
                            <td>{{ $mpt->penerimatugas->name }}</td>
                            <td>{{ $mpt->status }}</td>
                        </tr>
                        @empty
                        <tr class="bg-white">
                            <td class="p-2" colspan="6">Tidak ada tugas</td>
                        </tr>                        
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Low Priority Task --}}
        <div class="mb-10">
            <h3 class="bg-green-500 text-white font-medium p-1 w-fit rounded-md mb-1">Tingkat Prioritas Rendah</h3>
            <table class="w-full text-left">
                <thead>
                    <tr>
                        <th class="p-2">Nama Kegiatan</th>
                        <th>Satuan</th>
                        <th>Volume</th>
                        <th>Tenggat</th>
                        <th>Penerima Tugas</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody class="">
                    @forelse ($LPTs as $lpt)
                        <tr class="bg-white border-b">
                            <td class="p-2">{{ $lpt->namakegiatan }}</td>
                            <td>{{ $lpt->satuan }}</td>
                            <td>{{ $lpt->volume }}</td>
                            <td>{{ $lpt->tenggat }}</td>
                            <td>{{ $lpt->penerimatugas->name }}</td>
                            <td>{{ $lpt->status }}</td>
                        </tr>
                        @empty
                        <tr class="bg-white">
                            <td class="p-2" colspan="6">Tidak ada tugas</td>
                        </tr>                        
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    <!-- Modal toggle -->
    <div class="flex justify-center fixed bottom-4 right-4">
        <button id="defaultModalButton" data-modal-target="defaultModal" data-modal-toggle="defaultModal" class="block text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800" type="button">
        Tambah Tugas
        </button>
    </div>

    <!-- Main modal -->
    <div id="defaultModal" tabindex="-1" aria-hidden="true" class="hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
        <div class="relative w-full max-w-2xl max-h-[90vh] md:h-auto overflow-y-auto overflow-x-hidden">
            <!-- Modal content -->
            <div class="relative p-4 bg-white shadow dark:bg-gray-800 sm:p-5">
                <!-- Modal header -->
                <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Tambah Tugas
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="defaultModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form action="{{ route('monitoring') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-8 sm:grid-cols-2">
                        <div class="mb-4">
                            <label for="namakegiatan" class="block text-sm font-medium text-gray-900 dark:text-white">Nama Kegiatan</label>
                            <p class="  text-xs text-gray-400">Contoh: Susenas Maret 2025</p>
                            <input type="text" name="namakegiatan" id="namakegiatan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                        </div>
                        <div class="sm:col-span-2 mb-4">
                            <label for="deskripsi" class="block text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                            <p class="mb-1 text-xs text-gray-400">Contoh: Lakukan Pencacahan Pada Blok Sensus Terpilih</p>
                            <textarea id="deskripsi" name="deskripsi" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"></textarea>                    
                        </div>
                        <div class="flex mb-4">
                            <div class="mr-4">
                                <label for="volume" class="block text-sm font-medium text-gray-900 dark:text-white">Volume</label>
                                <p class="text-xs text-gray-400">Contoh: 10</p>
                                <input type="number" name="volume" id="volume" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                            </div>
                            <div class="">
                                <label for="satuan" class="block text-sm font-medium text-gray-900 dark:text-white">Satuan</label>
                                <p class="text-xs text-gray-400">Contoh: Blok Sensus</p>
                                <input type="text" name="satuan" id="satuan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="tenggat" class="block text-sm font-medium text-gray-900 dark:text-white">Tenggat</label>
                            <p class="  text-xs text-gray-400">Contoh: 30/04/2025</p>
                            <input type="date" name="tenggat" id="tenggat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                        </div>
                        <div class="mb-4">
                            <label for="penerimatugas_id" class="block text-sm font-medium text-gray-900 dark:text-white">Penerima Tugas</label>
                            <select id="penerimatugas_id" name="penerimatugas_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option selected="" disabled>Pilih Anggota Tim</option>
                                @foreach ($anggotatim as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="attachment" class="block text-sm font-medium text-gray-900 dark:text-white">Upload Dokumen</label>
                        <p class="  text-xs text-gray-400">Ukuran maksimal file 5mb</p>
                        <input type="file" name="attachment" id="attachment" class="">
                    </div>

                    <button type="submit" class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                        Simpan
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            document.getElementById('defaultModalButton').click();
        });
    </script>
    
</x-layout>