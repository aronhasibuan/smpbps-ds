<x-layout>
    <!-- Welcome Section -->
    <section aria-labelledby="welcome-heading" class="text-center mb-8">
        <h1 id="welcome-heading" class="text-2xl font-bold text-gray-800 dark:text-white">
            Halo, Selamat datang {{ $user->user_full_name }}!
        </h1>
    </section>

    <!-- Stats Cards -->
    <section aria-labelledby="stats-heading" class="mb-8">
        <h2 id="stats-heading" class="sr-only">Statistik Kegiatan</h2>
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
            <!-- Kegiatan Berjalan -->
            <a href="{{ route('activities-monitoring-page') }}" 
            class="border p-4 sm:p-6 rounded-lg flex flex-col items-center bg-blue-500 shadow-md transition-all hover:shadow-lg hover:bg-blue-600 hover:transform hover:-translate-y-1"
            aria-label="{{ $activityStats['running'] }} Kegiatan Berjalan">
                <div class="flex items-center justify-between w-full">
                    <img src="{{ asset('img/alarm-clock-plus.svg') }}" 
                        alt="" 
                        class="w-8 h-8 sm:w-10 sm:h-10"
                        aria-hidden="true" 
                        loading="lazy">
                    <span class="text-2xl sm:text-4xl font-bold text-white">{{ $activityStats['running'] }}</span>
                </div>
                <p class="mt-2 sm:mt-4 text-center text-white text-sm sm:text-lg font-semibold">Kegiatan Berjalan</p>
            </a>
            
            <!-- Kegiatan Terlambat -->
            <a href="{{ route('activities-monitoring-page', ['filter' => 'Terlambat', 'page' => 1]) }}" 
            class="border p-4 sm:p-6 rounded-lg flex flex-col items-center bg-red-500 shadow-md transition-all hover:shadow-lg hover:bg-red-600 hover:transform hover:-translate-y-1"
            aria-label="{{ $activityStats['late'] }} Kegiatan Terlambat">
                <div class="flex items-center justify-between w-full">
                    <img src="{{ asset('img/alarm-clock-minus.svg') }}" 
                        alt="" 
                        class="w-8 h-8 sm:w-10 sm:h-10"
                        aria-hidden="true"
                        loading="lazy">
                    <span class="text-2xl sm:text-4xl font-bold text-white">{{ $activityStats['late'] }}</span>
                </div>
                <p class="mt-2 sm:mt-4 text-center text-white text-sm sm:text-lg font-semibold">Kegiatan Terlambat</p>
            </a>
            
            <!-- Kegiatan Selesai -->
            <a href="{{ route('activities-archive-page') }}" 
            class="border p-4 sm:p-6 rounded-lg flex flex-col items-center bg-green-500 shadow-md transition-all hover:shadow-lg hover:bg-green-600 hover:transform hover:-translate-y-1"
            aria-label="{{ $activityStats['completed'] }} Kegiatan Selesai">
                <div class="flex items-center justify-between w-full">
                    <img src="{{ asset('img/alarm-clock-check.svg') }}" 
                        alt="" 
                        class="w-8 h-8 sm:w-10 sm:h-10"
                        aria-hidden="true"
                        loading="lazy">
                    <span class="text-2xl sm:text-4xl font-bold text-white">{{ $activityStats['completed'] }}</span>
                </div>
                <p class="mt-2 sm:mt-4 text-center text-white text-sm sm:text-lg font-semibold">Kegiatan Selesai</p>
            </a>

            <!-- Verifikasi Tugas -->
            <a href="{{ route('verification-page') }}" 
            class="border p-4 sm:p-6 rounded-lg flex flex-col items-center bg-yellow-500 shadow-md transition-all hover:shadow-lg hover:bg-yellow-600 hover:transform hover:-translate-y-1"
            aria-label="{{ $activityStats['verify'] }} Tugas Perlu Verifikasi">
                <div class="flex items-center justify-between w-full">
                    <img src="{{ asset('img/alarm-clock.svg') }}" 
                        alt="" 
                        class="w-8 h-8 sm:w-10 sm:h-10"
                        aria-hidden="true"
                        loading="lazy">
                    <span class="text-2xl sm:text-4xl font-bold text-white">{{ $activityStats['verify'] }}</span>
                </div>
                <p class="mt-2 sm:mt-4 text-center text-white text-sm sm:text-lg font-semibold">Verifikasi Tugas</p>
            </a>
        </div>
    </section>

    <!-- CTA Section -->
    <section aria-labelledby="cta-heading" class="mb-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- View All Activities -->
            <div class="border-2 border-gray-200 rounded-lg p-6 bg-white shadow-sm flex flex-col items-center">
                <h2 id="cta-heading" class="text-xl lg:text-2xl mb-6 text-center font-medium text-gray-800">
                    Untuk melihat seluruh kegiatan anda, silahkan klik tombol di bawah ini
                </h2>
                <a href="{{ route('activities-monitoring-page') }}" 
                   class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-lg font-medium"
                   aria-label="Lihat semua kegiatan">
                    Lihat Kegiatan Selengkapnya
                </a>
            </div>

            <!-- Verification CTA -->
            <div class="border-2 border-gray-200 rounded-lg p-6 bg-white shadow-sm flex flex-col items-center">
                @if ($activityStats['verify'] == 0)
                    <p class="text-xl lg:text-2xl text-center text-gray-600">
                        Saat ini anda tidak memiliki tugas yang harus diverifikasi!
                    </p>
                @else
                    <h2 class="text-xl lg:text-2xl mb-6 text-center font-medium text-gray-800">
                        Anda memiliki <span class="text-red-600 font-bold">{{ $activityStats['verify'] }}</span> tugas yang harus segera diverifikasi!
                    </h2>
                    <a href="{{ route('verification-page') }}" 
                       class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-lg font-medium"
                       aria-label="Verifikasi tugas sekarang">
                        Verifikasi Sekarang
                    </a>
                @endif
            </div>
        </div>
    </section>

    <!-- Dashboard Sections -->
    <section class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Activity -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden border-2 border-gray-200">
            <div class="bg-blue-600 px-4 py-3">
                <h3 class="text-lg font-semibold text-white">
                    Aktivitas Terbaru
                </h3>
            </div>
            <div class="p-4">
                @forelse($memberProgress as $progress)
                    <article class="mb-4 pb-4 border-b border-gray-100 last:border-0 last:mb-0">
                        <a href="{{ route('task-page', $progress->task->task_slug) }}" 
                           class="block hover:bg-gray-50 p-2 rounded transition-colors"
                           aria-label="Lihat detail progress {{ $progress->task->activity->activity_name }}">
                            <p class="text-blue-600 hover:underline">
                                <strong>{{ $progress->task->user->user_full_name }}</strong> memperbarui progress tugas 
                                <strong>{{ $progress->task->activity->activity_name }}</strong> menjadi 
                                {{ $progress->task->task_latest_progress }} dari {{ $progress->task->task_volume }} {{ $progress->task->activity->activity_unit }}
                            </p>
                            <time class="text-sm text-gray-500">
                                {{ $progress->created_at->diffForHumans() }}
                            </time>
                        </a>
                    </article>
                @empty
                    <p class="text-center text-gray-500 py-4">Tidak ada aktivitas terbaru</p>
                @endforelse
            </div>
        </div>
        
        <!-- Progress Chart -->
        <div class="bg-white rounded-lg shadow-md p-6 border-2 border-gray-200 flex flex-col">
            <h3 class="text-lg font-semibold text-gray-800 mb-4 text-center">
                Distribusi Kegiatan Aktif Berdasarkan Progress
            </h3>
            <div class="flex-1 flex items-center justify-center min-h-[300px]">
                <canvas id="taskPieChart" aria-label="Diagram distribusi kegiatan"></canvas>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @php
    $statusColors = [
        'Selesai' => '#3b82f6',
        'Terlambat' => '#000000',
        'Progress Lambat' => '#ef4444',
        'Progress On Time' => '#fbbf24',
        'Progress Cepat' => '#34d399',
    ];
    $pieColors = $pieData->keys()->map(fn($status) => $statusColors[$status]);
@endphp
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('taskPieChart').getContext('2d');
            const data = {
                labels: @json($pieData->keys()),
                datasets: [{
                    data: @json($pieData->values()),
                    backgroundColor: @json($pieColors->values()),
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