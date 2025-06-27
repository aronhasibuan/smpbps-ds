<x-layout>
    <div class="text-center">
        <p class="text-black font-bold text-xl mb-3">Halo. Selamat datang {{ $user->user_full_name }}!</p>
    </div>

    <div class="flex w-full gap-6 mt-4">

        <div class="border p-4 rounded-lg flex flex-col items-center flex-1 bg-blue-500 shadow">
            <div class="flex items-center justify-center w-full">
                <img src="{{ asset('img/alarm-clock-plus.svg') }}" alt="" class="w-12 h-12 mr-10">
                <span class="text-5xl font-bold text-white">{{ $activityStats['running'] }}</span>
            </div>
            <p class="mt-6 text-center text-white text-xl font-bold">Kegiatan Berjalan</p>
        </div>
        
        <div class="border p-4 rounded-lg flex flex-col items-center flex-1 bg-red-500 shadow">
            <div class="flex items-center justify-center w-full">
                <img src="{{ asset('img/alarm-clock-minus.svg') }}" alt="" class="w-12 h-12 mr-10">
                <span class="text-5xl font-bold text-white">{{ $activityStats['late'] }}</span>
            </div>
            <p class="mt-6 text-center text-white text-xl font-semibold">Kegiatan Terlambat</p>
        </div>
        
        <div class="border p-4 rounded-lg flex flex-col items-center flex-1 bg-green-500 shadow">
            <div class="flex items-center justify-center w-full">
                <img src="{{ asset('img/alarm-clock-check.svg') }}" alt="Tugas Selesai" class="w-12 h-12 mr-12">
                <span class="text-5xl font-bold text-white">{{ $activityStats['completed'] }}</span>
            </div>
            <p class="mt-6 text-center text-white text-xl font-semibold">Kegiatan Selesai</p>
        </div>

        <div class="border p-4 rounded-lg flex flex-col items-center flex-1 bg-yellow-500 shadow">
            <div class="flex items-center justify-center w-full">
                <img src="{{ asset('img/alarm-clock.svg') }}" alt="" class="w-12 h-12 mr-10">
                <span class="text-5xl font-bold text-white">{{ $activityStats['verify'] }}</span>
            </div>
            <p class="mt-6 text-center text-white text-xl font-semibold">Verifikasi Tugas</p>
        </div>
    </div>

    <div class="flex gap-4 my-6">
        <div class="flex-1 border-2 border-black rounded-lg p-8 mx-2 bg-white flex flex-col items-center">
            <p class="text-3xl mb-8 text-left">Untuk melihat seluruh kegiatan anda, silahkan klik tombol di bawah ini</p>
            <a href="" class="text-white bg-blue-600 p-4 rounded-2xl">Lihat Kegiatan Selengkapnya</a>
        </div>

        <div class="flex-1 border-2 border-black rounded-lg p-8 mx-2 bg-white flex flex-col items-center">
            @if ($activityStats['verify'] == 0)
                <p class="text-3xl">Saat ini anda tidak memiliki tugas yang harus diverifikasi!</p>
            @else
                <p class="text-3xl mb-8">Anda memiliki beberapa tugas yang harus segera diverifikasi!</p>
                <a href="" class="text-white bg-blue-600 p-4 rounded-2xl">Lihat Verifikasi Tugas</a>
            @endif
        </div>
    </div>

    <div class="flex flex-col md:flex-row gap-6">

        <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6 flex-1 border-2 border-black">
            <div class="bg-blue-600 px-4 py-3 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-white">
                    Aktivitas Terbaru:
                </h3>
            </div>

            <ul class="list-disc pl-6">
                @forelse($memberProgress as $progress)
                    <li class="mb-3">
                        <div>
                            <span class="">{{ $progress->task->user->user_full_name }} memperbarui progress tugas {{ $progress->task->activity->activity_name }} menjadi {{ $progress->task->task_latest_progress }} dari {{ $progress->task->task_volume }} {{ $progress->task->activity->activity_unit }}</span>
                        </div>
                    </li>
                @empty
                    <li class="text-center text-gray-500">Tidak ada progress hari ini.</li>
                @endforelse
            </ul>
        </div>
        
        <div class="bg-white rounded-lg shadow-md p-6 mb-6 flex-1 flex flex-col items-center justify-center border-2 border-black">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Distribusi Kegiatan Aktif Berdasarkan Progress</h3>
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
    
</x-layout>