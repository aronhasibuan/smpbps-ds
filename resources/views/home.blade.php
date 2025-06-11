<x-layout>
    <div class="text-center">
        <p class="text-[#002d57] font-bold text-3xl mb-3">Selamat datang, {{ $user->user_full_name }}!</p>
        <p class="text-xl">Saran tugas untuk dikerjakan hari ini:</p>
    </div>

    <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Saran Tugas Harian</h2>

        <!-- Today's Tasks -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
            <div class="bg-blue-600 px-4 py-3 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-white">
                    Hari Ini 
                </h3>
            </div>
            <div class="p-4">
                @if($suggestions->isEmpty())
                    <p class="text-gray-500 italic">Tidak ada tugas untuk hari ini.</p>
                @else
                    <ul class="space-y-2">
                        @foreach($suggestions as $task)
                            <li class="flex justify-between items-center p-3 border border-gray-100 rounded-lg hover:bg-gray-50">
                                <div>
                                    <p class="font-medium text-gray-800">{{ $task->activity->activity_name }}</p>
                                    <p class="text-xs text-gray-500 mt-1">
                                        Progress: {{ $task->task_latest_progress }}/{{ $task->task_volume }}
                                    </p>
                                </div>
                                <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">
                                    Saran Penyelesaian: {{ $task->volumesuggestion }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                    <!-- Capacity Progress Bar -->
                    {{-- <div class="mt-4">
                        <div class="flex justify-between text-sm text-gray-600 mb-1">
                            <span>Kapasitas Terpakai</span>
                            <span>{{ $suggestions['capacity_status']['today']['remaining'] }} tersisa</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="bg-blue-600 h-2.5 rounded-full" 
                                style="width: {{ $suggestions['capacity_status']['today']['used'] * 10 }}%"></div>
                        </div>
                    </div> --}}
                @endif
            </div>
        </div>

        <!-- Tomorrow's Tasks -->
        {{-- <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-gray-700 px-4 py-3 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-white">
                    Besok (Kapasitas: {{ $suggestions['capacity_status']['tomorrow']['used'] }}/10)
                </h3>
                <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $suggestions['capacity_status']['tomorrow']['status'] == 'FULL' ? 'bg-red-500' : 'bg-green-500' }}">
                    {{ $suggestions['capacity_status']['tomorrow']['status'] }}
                </span>
            </div>
            <div class="p-4">
                @if($suggestions['tomorrow']->isEmpty())
                    <p class="text-gray-500 italic">Tidak ada tugas untuk besok.</p>
                @else
                    <ul class="space-y-2">
                        @foreach($suggestions['tomorrow'] as $task)
                            <li class="flex justify-between items-center p-3 border border-gray-100 rounded-lg hover:bg-gray-50">
                                <div>
                                    <p class="font-medium text-gray-800">{{ $task->task_description }}</p>
                                    <p class="text-xs text-gray-500 mt-1">
                                        Deadline: {{ $task->activity->activity_end->format('d M Y') }}
                                    </p>
                                </div>
                                <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded-full">
                                    Sisa: {{ $task->task_volume - $task->task_latest_progress }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                    <!-- Capacity Progress Bar -->
                    <div class="mt-4">
                        <div class="flex justify-between text-sm text-gray-600 mb-1">
                            <span>Kapasitas Terpakai</span>
                            <span>{{ $suggestions['capacity_status']['tomorrow']['remaining'] }} tersisa</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="bg-gray-600 h-2.5 rounded-full" 
                                style="width: {{ $suggestions['capacity_status']['tomorrow']['used'] * 10 }}%"></div>
                        </div>
                    </div>
                @endif
            </div>
        </div> --}}
    </div>
</x-layout>