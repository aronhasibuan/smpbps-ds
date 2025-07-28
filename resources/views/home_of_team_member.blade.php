<x-layout>
    <div class="container mx-auto px-4 py-8">
        <!-- Welcome Section -->
        <section aria-labelledby="welcome-heading" class="text-center mb-8">
            <h1 id="welcome-heading" class="text-2xl md:text-3xl font-bold text-gray-800 mb-4">
                Halo, Selamat datang {{ $user->user_full_name }}!
            </h1>
        </section>

        <!-- Stats Cards -->
        <section aria-labelledby="stats-heading" class="mb-12">
            <h2 id="stats-heading" class="sr-only">Statistik Tugas</h2>
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
                <!-- Tugas Aktif -->
                <a href="{{ route('task-list-page') }}" 
                class="border p-4 sm:p-6 rounded-lg flex flex-col items-center bg-blue-500 shadow-md transition-all hover:shadow-lg hover:bg-blue-600 hover:transform hover:-translate-y-1"
                aria-label="{{ $taskStats['running'] }} Tugas Aktif">
                    <div class="flex items-center justify-between w-full">
                        <img src="{{ asset('img/alarm-clock-plus.svg') }}" 
                            alt="" 
                            class="w-8 h-8 sm:w-10 sm:h-10"
                            aria-hidden="true"
                            loading="lazy">
                        <span class="text-2xl sm:text-4xl font-bold text-white">{{ $taskStats['running'] }}</span>
                    </div>
                    <p class="mt-2 sm:mt-4 text-center text-white text-sm sm:text-lg font-semibold">Tugas Aktif</p>
                </a>
                
                <!-- Dalam Progress -->
                <a href="{{ route('task-list-page') }}" 
                class="border p-4 sm:p-6 rounded-lg flex flex-col items-center bg-yellow-500 shadow-md transition-all hover:shadow-lg hover:bg-yellow-600 hover:transform hover:-translate-y-1"
                aria-label="{{ $taskStats['ontime'] }} Tugas Dalam Progress">
                    <div class="flex items-center justify-between w-full">
                        <img src="{{ asset('img/alarm-clock.svg') }}" 
                            alt="" 
                            class="w-8 h-8 sm:w-10 sm:h-10"
                            aria-hidden="true"
                            loading="lazy">
                        <span class="text-2xl sm:text-4xl font-bold text-white">{{ $taskStats['ontime'] }}</span>
                    </div>
                    <p class="mt-2 sm:mt-4 text-center text-white text-sm sm:text-lg font-semibold">Dalam Progress</p>
                </a>
                
                <!-- Tugas Terlambat -->
                <a href="{{ route('task-list-page', ['filter' => 'Terlambat', 'page' => 1]) }}"
                class="border p-4 sm:p-6 rounded-lg flex flex-col items-center bg-red-500 shadow-md transition-all hover:shadow-lg hover:bg-red-600 hover:transform hover:-translate-y-1"
                aria-label="{{ $taskStats['late'] }} Tugas Terlambat">
                    <div class="flex items-center justify-between w-full">
                        <img src="{{ asset('img/alarm-clock-minus.svg') }}" 
                            alt="" 
                            class="w-8 h-8 sm:w-10 sm:h-10"
                            aria-hidden="true"
                            loading="lazy">
                        <span class="text-2xl sm:text-4xl font-bold text-white">{{ $taskStats['late'] }}</span>
                    </div>
                    <p class="mt-2 sm:mt-4 text-center text-white text-sm sm:text-lg font-semibold">Tugas Terlambat</p>
                </a>
                
                <!-- Tugas Selesai -->
                <a href="{{ route('task-archive-page') }}" 
                class="border p-4 sm:p-6 rounded-lg flex flex-col items-center bg-green-500 shadow-md transition-all hover:shadow-lg hover:bg-green-600 hover:transform hover:-translate-y-1"
                aria-label="{{ $taskStats['completed'] }} Tugas Selesai">
                    <div class="flex items-center justify-between w-full">
                        <img src="{{ asset('img/alarm-clock-check.svg') }}" 
                            alt="" 
                            class="w-8 h-8 sm:w-10 sm:h-10"
                            aria-hidden="true"
                            loading="lazy">
                        <span class="text-2xl sm:text-4xl font-bold text-white">{{ $taskStats['completed'] }}</span>
                    </div>
                    <p class="mt-2 sm:mt-4 text-center text-white text-sm sm:text-lg font-semibold">Tugas Selesai</p>
                </a>
            </div>
        </section>

        <!-- CTA Section -->
        <section aria-labelledby="cta-heading" class="text-center my-12">
            <h2 id="cta-heading" class="text-xl md:text-2xl text-gray-800 mb-4">
                Untuk melihat seluruh tugas anda, silahkan klik tombol di bawah ini
            </h2>
            <a href="{{ route('task-list-page') }}" 
               class="mt-4 px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors inline-flex items-center gap-2"
               aria-label="Lihat tugas selengkapnya">
                Lihat Tugas Selengkapnya 
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </a>
        </section>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Suggested Tasks -->
            <section aria-labelledby="suggested-tasks-heading" class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="bg-blue-600 px-4 py-3">
                    <h3 id="suggested-tasks-heading" class="text-lg font-semibold text-white">
                        Saran Tugas Untuk dikerjakan Hari Ini
                    </h3>
                </div>
                <div class="p-4">
                    @if($suggestions->isEmpty())
                        <p class="text-gray-500 italic py-4 text-center">Tidak ada tugas untuk hari ini.</p>
                    @else
                        <ul class="divide-y divide-gray-100">
                            @foreach($suggestions as $task)
                                <li class="py-3">
                                    <a href="{{ route('task-page', $task->task_slug) }}" 
                                       class="block p-3 rounded-lg hover:bg-gray-50 transition-colors"
                                       aria-label="Tugas {{ $task->activity->activity_name }}">
                                        <p class="font-medium text-gray-800">
                                            {{ $task->activity->activity_name }} - 
                                            <span class="text-blue-600">{{ $task->volumesuggestion }} {{ $task->activity->activity_unit }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </section>

            <!-- Task Distribution Chart -->
            <section aria-labelledby="chart-heading" class="bg-white rounded-lg shadow-md p-6 flex flex-col">
                <h3 id="chart-heading" class="text-lg font-semibold text-gray-800 mb-4 text-center">
                    Distribusi Tugas Aktif Berdasarkan Progress
                </h3>
                <div class="flex-1 flex items-center justify-center min-h-[300px]">
                    <div id="chart-loader" class="text-center py-8">
                        <svg class="animate-spin h-8 w-8 text-blue-500 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <p class="mt-2 text-gray-600">Memuat data...</p>
                    </div>
                    <canvas id="taskPieChart" class="w-full h-auto" style="display: none;"></canvas>
                </div>
            </section>
        </div>

        <!-- Activity and Notifications -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Recent Activity -->
            <section aria-labelledby="activity-heading" class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="bg-blue-600 px-4 py-3">
                    <h3 id="activity-heading" class="text-lg font-semibold text-white">
                        Aktivitas Terbaru
                    </h3>
                </div>
                <div class="p-4">
                    @forelse($todayProgress as $progress)
                        <div class="mb-3 last:mb-0">
                            <a href="{{ route('task-page', $progress->task->task_slug) }}" 
                               class="block p-3 text-blue-600 hover:underline font-medium rounded-lg hover:bg-gray-50 transition-colors"
                               aria-label="Progress tugas {{ $progress->task->activity->activity_name }}">
                                Kamu memperbarui progress tugas {{ $progress->task->activity->activity_name }} 
                                menjadi {{ $progress->task->task_latest_progress }} dari {{ $progress->task->task_volume }} {{ $progress->task->activity->activity_unit }}
                            </a>
                        </div>
                    @empty
                        <p class="text-center text-gray-500 py-4">Tidak ada progress hari ini.</p>
                    @endforelse
                </div>
            </section>

            <!-- Notifications -->
            <section aria-labelledby="notifications-heading" class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="bg-blue-600 px-4 py-3">
                    <h3 id="notifications-heading" class="text-lg font-semibold text-white">
                        Notifikasi
                    </h3>
                </div>
                <div class="p-4">
                    @forelse($newtasks as $newtask)
                        <div class="mb-3 last:mb-0">
                            <a href="{{ route('task-page', $newtask->task_slug) }}" 
                               class="block p-3 text-blue-600 hover:underline font-medium rounded-lg hover:bg-gray-50 transition-colors"
                               aria-label="Tugas baru {{ $newtask->activity->activity_name }}">
                                Kamu memiliki tugas baru - {{ $newtask->activity->activity_name }}
                            </a>
                        </div>
                    @empty
                        <p class="text-center text-gray-500 py-4">Tidak ada notifikasi baru.</p>
                    @endforelse
                </div>
            </section>
        </div>
    </div>

    <!-- Chart.js with Lazy Loading -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Load Chart.js dynamically
            const script = document.createElement('script');
            script.src = 'https://cdn.jsdelivr.net/npm/chart.js';
            script.onload = initializeChart;
            document.head.appendChild(script);

            function initializeChart() {
                const ctx = document.getElementById('taskPieChart');
                if (!ctx) return;

                const loader = document.getElementById('chart-loader');
                const chartCanvas = document.getElementById('taskPieChart');
                
                try {
                    const data = {
                        labels: @json($pieData->keys()),
                        datasets: [{
                            data: @json($pieData->values()),
                            backgroundColor: [
                                '#34d399', // green
                                '#fbbf24', // amber
                                '#6366f1', // indigo
                                '#ef4444', // red
                            ],
                            borderWidth: 1,
                        }]
                    };
                    
                    new Chart(ctx, {
                        type: 'pie',
                        data: data,
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: { 
                                    position: 'bottom',
                                    labels: {
                                        padding: 20,
                                        usePointStyle: true,
                                        pointStyle: 'circle'
                                    }
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            const label = context.label || '';
                                            const value = context.raw || 0;
                                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                            const percentage = Math.round((value / total) * 100);
                                            return `${label}: ${value} (${percentage}%)`;
                                        }
                                    }
                                }
                            }
                        }
                    });

                    // Hide loader and show chart
                    if (loader) loader.style.display = 'none';
                    chartCanvas.style.display = 'block';
                } catch (error) {
                    console.error('Error initializing chart:', error);
                    if (loader) {
                        loader.innerHTML = '<p class="text-red-500">Gagal memuat data chart</p>';
                    }
                }
            }
        });
    </script>
</x-layout>