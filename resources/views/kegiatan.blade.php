<x-layout>
    <div class="min-h-screen overflow-y-visible">

        {{-- Judul Halaman --}}
        <p class="font-bold">{{ $tasks->first()->namakegiatan }}</p>

        {{-- Daftar Tugas --}}
        <div x-data="{ openTask: null }">  
    
            <div class="py-8">
    
                @forelse ($tasks as $task) 
                <div @click="openTask = openTask === {{ $task->id }} ? null : {{ $task->id }}" class="m-1 transition-all duration-300 ease-in-out" :class="{'shadow-lg': openTask === {{ $task->id }}}">
                
                    <div tabindex="0" class="bg-white border-t border-collapse p-3 flex justify-between items-center hover:bg-gray-100 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:rounded-lg transition-all duration-300 ease-in-out" :class="{'border-x rounded-t-md': openTask === {{ $task->id }}}">
            
                        <div class="flex items-center">
                            @php
                                $color = $task->kemajuan['color'];
                                $backgroundColor = in_array($color, ['red', 'yellow', 'green']) ? "bg-{$color}-500" : 'bg-black'; 
                            @endphp
        
                            <p class="mr-5 p-2 {{ $backgroundColor }} text-white rounded-2xl w-36 text-center text-sm">{{ $task->kemajuan['status'] }}</p>
                            <p>{{ $task->namakegiatan}}</p>
                        </div>
    
                        <div class="flex items-center">
                            <p class="text-sm text-gray-500">Tenggat: {{ $task->formattedd_m }}</p>
                            <p class="text-center ml-3">
                                <a href="/home/{{ $task->slug }}" @click.stop>
                                    <img class="w-6 h-6 mx-auto" src="{{ asset('img/info-square-fill.svg') }}" alt="Detail">
                                </a>
                            </p>
                        </div>
        
                    </div>
            
                    <div x-show="openTask === {{ $task->id }}" 
                        class="border p-8 rounded-b-md shadow-md mb-5 overflow-hidden origin-top"
                        x-data x-effect="if (openTask === {{ $task->id }}) { console.log(
                        ' Kode Kategori: {{ $task->kodekategori }}\n', 
                        'Progress Tercapai: {{ $task->progress }}\n', 
                        'Volume: {{ $task->volume }}\n\n',

                        'Hari Berlalu (PHP): {{ $task->kemajuan['hariberlalu'] }}\n', 
                        'Hari Berlalu (MySQL): {{ $task->hariberlalu_MySQL }}\n\n',

                        'Jumlah Hari Tugas (PHP): {{ $task->kemajuan['selangharitugas_PHP'] }}\n',
                        'Jumlah Hari Tugas (MySQL): {{ $task->selangharitugas_MySQL }}\n\n',

                        'Target Perhari (PHP): {{ $task->kemajuan['targetperhari_PHP'] }} \n',
                        'Target Perhari (MySQL): {{ $task->targetperhari_MySQL }} \n\n', 

                        'Target Harus Tercapai (PHP): {{ $task->kemajuan['tht'] }}\n',
                        'Target Harus Tercapai (MySQL): {{ $task->targetharustercapai_MySQL }}',
                        );}">
                        
                        <p class="text-sm text-gray-400 mb-3">Posted {{ $task->created_at->format('F d') }}</p>
                        <p>Deskripsi Pekerjaan:</p>
                        <p>{{ $task->deskripsi }}</p>
                    </div>
            
                </div>
    
                @empty
                    <p class="bg-white">
                        <td class="p-2" colspan="6">Tidak ada tugas</td>
                    </p>
                @endforelse    
    
            </div>
        
        </div>

    </div>
    
</x-layout> 