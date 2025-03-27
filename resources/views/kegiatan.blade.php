<x-layout>
    <div class="min-h-screen overflow-y-visible">

        {{-- Judul Halaman --}}
        <a href="javascript:history.back()" class="font-medium text-base text-blue-600 hover:underline">&laquo; Kembali</a>

        <p class="font-bold mt-5">{{ $tasks->first()->namakegiatan }}</p>

        {{-- Daftar Tugas --}}
    
        <div class="py-8">

            @forelse ($tasks as $task) 
            <div class="m-1 border-t border-collapse p-3 hover:bg-gray-100">
                <p class="mb-4 font-semibold">{{ $task->penerimatugas->name }}</p>

                <div class="flex justify-between items-center mb-2">
                    
                    <div class="flex items-center">
                        @php
                            $color = $task->kemajuan['color'];
                            $backgroundColor = in_array($color, ['red', 'yellow', 'green']) ? "bg-{$color}-500" : 'bg-black'; 
                        @endphp
    
                        <p class="mr-5 p-2 {{ $backgroundColor }} text-white rounded-2xl w-36 text-center text-sm">{{ $task->kemajuan['status'] }}</p>
                    </div>

                    <div class="relative w-8/12 bg-gray-300 rounded-full h-8">
                        <div class="bg-blue-600 h-8 rounded-full" style="width: {{ $task->percentage_progress }}%;"></div>
                        <span class="absolute left-1/2 transform -translate-x-1/2 font-bold">{{ $task->percentage_progress }}%</span>
                    </div>

                    <div class="flex items-center">
                        <p class="text-sm text-gray-500">Tenggat: {{ $task->formattedd_m }}</p>
                        <p class="text-center ml-3">
                            <a href="{{ route('dataflow.taskmonitoring', ['grouptask_slug' => $task->grouptask_slug, 'slug'=>$task->slug])}}" @click.stop>
                                <img class="w-6 h-6 mx-auto" src="{{ asset('img/info-square-fill.svg') }}" alt="Detail">
                            </a>
                        </p>
                    </div>
    
                </div>
                
                <p class="text-gray-600">Tugas Selesai: {{$task->latestprogress}} dari {{ $task->volume }}</p>

            </div>

            @empty
                <p class="bg-white">
                    <td class="p-2" colspan="6">Tidak ada tugas</td>
                </p>
            @endforelse    

        </div>

        <hr>

        <div class="text-center p-5">
            <p class="font-semibold mb-2">Total Progress:</p>
            <div>
                @php
                    $totalProgress = $tasks->count() > 0 
                        ? round($tasks->sum('percentage_progress') / $tasks->count(), 2) 
                        : 0;
                @endphp
                <div class="relative w-full bg-gray-300 rounded-full h-6">
                    <div class="bg-blue-600 h-6 rounded-full" style="width: {{ $totalProgress }}%;"></div>
                    <span class="absolute left-1/2 transform -translate-x-1/2 font-bold">{{ $totalProgress }}%</span>
                </div>
            </div>
        </div>
        

    </div>
    
</x-layout> 