<x-layout>
    <div class="text-center">
        <p class="text-black font-bold text-xl mb-3">Halo. Selamat datang {{ $user->user_full_name }}!</p>
    </div>

    <div class="flex w-full gap-6 mt-4">

        <div class="border p-4 rounded-lg flex flex-col items-center flex-1 bg-blue-500 shadow">
            <div class="flex items-center justify-center w-full">
                <img src="{{ asset('img/alarm-clock-plus.svg') }}" alt="Tugas Diterima" class="w-12 h-12 mr-10">
                <span class="text-5xl font-bold text-white">{{ $taskStats['running'] }}</span>
            </div>
            <p class="mt-6 text-center text-white text-xl font-bold">Tugas Aktif</p>
        </div>
        
        <div class="border p-4 rounded-lg flex flex-col items-center flex-1 bg-yellow-500 shadow">
            <div class="flex items-center justify-center w-full">
                <img src="{{ asset('img/alarm-clock.svg') }}" alt="Tugas Berlangsung" class="w-12 h-12 mr-10">
                <span class="text-5xl font-bold text-white">{{ $taskStats['ontime'] }}</span>
            </div>
            <p class="mt-6 text-center text-white text-xl font-semibold">Dalam Progress</p>
        </div>
        
        <div class="border p-4 rounded-lg flex flex-col items-center flex-1 bg-red-500 shadow">
            <div class="flex items-center justify-center w-full">
                <img src="{{ asset('img/alarm-clock-minus.svg') }}" alt="Tugas Terlambat" class="w-12 h-12 mr-10">
                <span class="text-5xl font-bold text-white">{{ $taskStats['late'] }}</span>
            </div>
            <p class="mt-6 text-center text-white text-xl font-semibold">Tugas Terlambat</p>
        </div>
        
        <div class="border p-4 rounded-lg flex flex-col items-center flex-1 bg-green-500 shadow">
            <div class="flex items-center justify-center w-full">
                <img src="{{ asset('img/alarm-clock-check.svg') }}" alt="Tugas Selesai" class="w-12 h-12 mr-12">
                <span class="text-5xl font-bold text-white">{{ $taskStats['completed'] }}</span>
            </div>
            <p class="mt-6 text-center text-white text-xl font-semibold">Tugas Selesai</p>
        </div>
    </div>

    <div class="text-center my-12">
        <p class="text-2xl">Untuk melihat seluruh tugas anda, silahkan klik tombol di bawah ini</p>
        <a href="{{ route('tasklist') }}" class="mt-2 px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition inline-block">
            Lihat Tugas Selengkapnya &gt;
        </a>
    </div>

    <div class="container mx-auto px-4 py-8">
        
        <div class="flex flex-col md:flex-row gap-6">
            <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6 flex-1">
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
                                <a href="#" class="flex justify-between items-center p-3 border border-gray-100 rounded-lg hover:bg-gray-50">
                                    <p class="font-medium text-gray-800">{{ $task->activity->activity_name }} - {{ $task->volumesuggestion }} {{ $task->activity->activity_unit }}</p>
                                </a>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6 mb-6 flex-1 flex flex-col items-center justify-center border">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Distribusi Tugas Aktif Berdasarkan Progress</h3>
                <canvas id="taskPieChart"></canvas>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const ctx = document.getElementById('taskPieChart').getContext('2d');
                const data = {
                    labels: @json($pieData->keys()),
                    datasets: [{
                        data: @json($pieData->values()),
                        backgroundColor: [
                            '#34d399', 
                            '#ef4444', 
                            '#6366f1', 
                            '#fbbf24', 
                        ],
                    }]
                };
                new Chart(ctx, {
                    type: 'pie',
                    data: data,
                    options: {
                        responsive: true,
                        plugins: {
                            legend: { position: 'bottom' },
                            title: { display: false }
                        }
                    }
                });
            });
        </script>

        <div class="flex flex-col md:flex-row gap-6">
        
            <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6 flex-1">
                <div class="bg-blue-600 px-4 py-3 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-white">
                        Aktivitas Terbaru:
                    </h3>
                </div>

                <ul class="list-disc pl-6">
                    @forelse($todayProgress as $progress)
                        <li class="mb-3">
                            <div>
                                <span class="">Kamu memperbarui progress tugas {{ $progress->task->activity->activity_name }} menjadi {{ $progress->task->task_latest_progress }} dari {{ $progress->task->task_volume }} {{ $progress->task->activity->activity_unit }}</span>
                            </div>
                        </li>
                    @empty
                        <li class="text-center text-gray-500">Tidak ada progress hari ini.</li>
                    @endforelse
                </ul>
            </div>

            <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6 flex-1">
                <div class="bg-blue-600 px-4 py-3 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-white">
                        Notifikasi:
                    </h3>
                </div>

                <ul class="list-disc pl-6">
                    @forelse($newtasks as $newtask)
                        <li class="mb-3">
                            <div>
                                <span class="">Kamu memiliki tugas baru - {{ $newtask->activity->activity_name }}</span>
                            </div>
                        </li>
                    @empty
                        <li class="text-center text-gray-500">Tidak ada progress hari ini.</li>
                    @endforelse
                </ul>
                
            </div>
        </div>
    </div>
</x-layout>