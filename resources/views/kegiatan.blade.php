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

    </div>
</x-layout> 