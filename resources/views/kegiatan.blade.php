<x-layout>
    <div>

        <a href="/monitoringkegiatan" class="font-medium text-base text-blue-600 hover:underline">&laquo; Kembali</a>
        <p class="font-bold mt-5 dark:text-white">{{ $tasks->first()->namakegiatan }}</p>

        {{-- advanced table --}}    
        <div class="overflow-auto max-h-screen">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 border-t"> 
                    <tr>
                        <th scope="col" class="px-4 py-3">Status</th>
                        <th scope="col" class="px-4 py-3">Nama Anggota Tim</th>
                        <th scope="col" class="px-4 py-3">Tugas Selesai</th>
                        <th scope="col" class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white border-t dark:border-gray-700 dark:bg-gray-800">
                    @foreach ($tasks as $task)
                    <tr class="border-t">
                        @php
                            $colorMap = [
                                'Selesai' => 'bg-blue-500',
                                'Terlambat' => 'bg-black',
                                'Progress Lambat' => 'bg-red-500',
                                'Progress On Time' => 'bg-yellow-500',
                                'Progress Cepat' => 'bg-green-500'
                            ];
                            $backgroundColor = $colorMap[$task->kemajuan['status']] ?? 'bg-gray-500';
                        @endphp
                        <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <p class="{{ $backgroundColor }} text-white rounded-md w-36 text-center text-sm">{{ $task->kemajuan['status'] }}</p>
                        </th>
                        <td class="px-4 py-3">{{ $task->penerimatugas->name }}</td>
                        <td class="px-4 py-3">{{ $task->latestprogress }} dari {{ $task->volume }} {{ $task->satuan }}</td>
                        <td class="px-4 py-3 flex items-center justify-center hover:cursor-pointer">
                            <a href="{{ route('dataflow.taskmonitoring', ['kegiatan_slug' => $task->kegiatan->slug, 'slug'=>$task->slug])}}" class="inline-flex items-center p-0.5 rounded-lg focus:outline-none">
                                <img class="w-5 h-5" src="{{ asset('img/info-square-fill.svg') }}" alt="Detail">
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <hr>

        {{-- progress --}}
        <div class="flex justify-between mb-2 mt-20">
            <span class="md:text-base text-sm font-bold text-gray-900 dark:text-white">Total Progress</span>
            <span class="md:text-base text-sm font-bold text-gray-900 dark:text-white">Tenggat Pekerjaan: {{ $tasks->first()->formatted_tenggat; }}</span>
        </div>
        <div class="w-full h-6 bg-gray-200 rounded-full dark:bg-gray-700">
            <div class="h-6 bg-blue-600 rounded-full dark:bg-blue-500 text-sm font-medium text-blue-100 text-center" style="width: {{ $persentaseprogress }}%">{{ $persentaseprogress }}%</div>
        </div>

        {{-- button - tandai kegiatan selesai --}}
        @if ($persentaseprogress == 100 && $kegiatan->active)    
            <div class="flex justify-center gap-4 mt-20">
                <button type="button" onclick="openModal()" class="bg-blue-600 text-white px-6 py-3 rounded-full hover:bg-blue-700 transition duration-200">
                Tandai Kegiatan Selesai
                </button>
            </div>
        @endif

        <div id="confirmationModal" class="fixed inset-0 items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 w-96">
                <h2 class="text-lg font-bold mb-4 dark:text-white">Konfirmasi</h2>
                <p class="text-sm text-gray-700 mb-6 dark:text-gray-300">Apakah anda yakin menandai kegiatan ini selesai? Aksi ini tidak dapat dibatalkan.</p>
                <div class="flex justify-end gap-4">
                    <button type="button" onclick="closeModal()" class="bg-gray-300 text-gray-700 dark:text-black px-4 py-2 rounded hover:bg-gray-400 transition duration-200">
                        Batal
                    </button>
                    <form action="{{ route('kegiatan.markAsDone', ['kegiatan' => $tasks->first()->kegiatan->slug, 'id' => $tasks->first()->kegiatan->id]) }}" method="POST">
                        @csrf
                        @method('POST')
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-200">
                            Ya, Tandai Selesai
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <script>
            function openModal() {
                const modal = document.getElementById('confirmationModal');
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }

            function closeModal() {
                const modal = document.getElementById('confirmationModal');
                modal.classList.remove('flex')
                modal.classList.add('hidden');
            }
        </script>

    </div>
</x-layout> 