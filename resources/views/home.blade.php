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
                @endif
            </div>
        </div>

        <h2 class="text-2xl font-bold text-gray-800 mb-6">Daftar Tugas Yang Diselesaikan Hari Ini:</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-6">
            @forelse($todayProgress as $progress)
                <div class="bg-white shadow rounded-lg p-4 border">
                    <h3 class="font-semibold text-lg mb-2">{{ $progress->task->activity->activity_name ?? '-' }}</h3>
                    <p class="text-gray-600 mb-1">Tanggal: {{ $progress->progress_date }}</p>
                    <p class="text-gray-600 mb-1">Progress: {{ $progress->progress_amount }}</p>
                </div>
            @empty
                <div class="col-span-3 text-center text-gray-500">
                    Tidak ada progress hari ini.
                </div>
            @endforelse
        </div>

    </div>
</x-layout>