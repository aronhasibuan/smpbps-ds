<x-layout>

    {{-- judul halaman --}}
    <p class="text-sm text-gray-600 mb-4">Arsip Tugas</p>

    {{-- tabel daftar tugas selesai --}}
    <div class="overflow-auto max-h-screen">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 border bg-white dark:bg-gray-800">
            <thead class="text-xs text-gray-700 uppercase dark:text-gray-400"> 
                <tr>
                    <th scope="col" class="px-4 py-3">Nama Kegiatan</th>
                    <th scope="col" class="px-4 py-3">Volume</th>
                    <th scope="col" class="px-4 py-3">Satuan</th>
                    <th scope="col" class="px-4 py-3">Tenggat</th>
                    <th scope="col" class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="border-t">
                @forelse ($tasks as $task)
                <tr>
                    <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <p class="text-white rounded-md w-36 text-center text-sm">{{ $task->namakegiatan }}</p>
                    </th>
                    <td class="px-4 py-3">{{ $task->volume }}</td>
                    <td class="px-4 py-3">{{ $task->satuan }}</td>
                    <td class="px-4 py-3">{{ $task->tenggat }}</td>
                    <td class="px-4 py-3 flex items-center justify-center hover:cursor-pointer">
                        <a href="/home/{{ $task->slug }}" class="inline-flex items-center p-0.5 rounded-lg focus:outline-none">
                            <img class="w-5 h-5" src="{{ asset('img/info-square-fill.svg') }}" alt="Detail">
                        </a>
                    </td>
                </tr>
                @empty
                <tr class="text-center">
                    <td colspan="5" class="px-4 py-3">Tidak Ada Tugas Yang Diselesaikan</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</x-layout>