<x-layout>
    <div class="text-center">
        <p class="text-[#002d57] font-bold text-xl mb-3">Halo. Selamat datang, {{ $user->user_full_name }}!</p>
    </div>

    <div class="flex w-full gap-6">

        <div class="border p-8 rounded-lg flex flex-col items-center flex-1 bg-white shadow">
            <div class="flex items-center justify-between w-full">
                <img src="{{ asset('img/alarm-clock-plus.svg') }}" alt="Tugas Diterima" class="w-12 h-12">
                <span class="text-4xl font-bold text-blue-600">12</span>
            </div>
            <p class="mt-6 text-center text-gray-700 text-lg font-semibold">Tugas Diterima</p>
        </div>
        
        <div class="border p-8 rounded-lg flex flex-col items-center flex-1 bg-white shadow">
            <div class="flex items-center justify-between w-full">
                <img src="{{ asset('img/alarm-clock.svg') }}" alt="Tugas Berlangsung" class="w-12 h-12">
                <span class="text-4xl font-bold text-yellow-500">8</span>
            </div>
            <p class="mt-6 text-center text-gray-700 text-lg font-semibold">Tugas Berlangsung</p>
        </div>
        
        <div class="border p-8 rounded-lg flex flex-col items-center flex-1 bg-white shadow">
            <div class="flex items-center justify-between w-full">
                <img src="{{ asset('img/alarm-clock-minus.svg') }}" alt="Tugas Terlambat" class="w-12 h-12">
                <span class="text-4xl font-bold text-red-500">3</span>
            </div>
            <p class="mt-6 text-center text-gray-700 text-lg font-semibold">Tugas Terlambat</p>
        </div>
        
        <div class="border p-8 rounded-lg flex flex-col items-center flex-1 bg-white shadow">
            <div class="flex items-center justify-between w-full">
                <img src="{{ asset('img/alarm-clock-check.svg') }}" alt="Tugas Selesai" class="w-12 h-12">
                <span class="text-4xl font-bold text-green-500">20</span>
            </div>
            <p class="mt-6 text-center text-gray-700 text-lg font-semibold">Tugas Selesai</p>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8">
        
        <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
            <div class="bg-blue-600 px-4 py-3 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-white">
                    Saran Tugas Untuk dikerjakan Hari Ini:
                </h3>
            </div>
            <div class="p-4">
                @if($suggestions->isEmpty())
                    <p class="text-gray-500 italic">Tidak ada tugas untuk hari ini.</p>
                @else
                    <ul class="space-y-2">
                        @foreach($suggestions as $task)
                            <li class="flex justify-between items-center p-3 border border-gray-100 rounded-lg hover:bg-gray-50">
                                <p class="font-medium text-gray-800">{{ $task->activity->activity_name }} - {{ $task->volumesuggestion }} {{ $task->activity->activity_unit }}</p>
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