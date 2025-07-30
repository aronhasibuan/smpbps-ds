<x-layout>
    <div class="container mx-auto px-4 py-6">
        <!-- Page Header -->
        <header class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Monitoring Pegawai</h1>
            <p class="text-sm text-gray-600 dark:text-gray-400">Distribusi Tugas per Pegawai</p>
        </header>

        <!-- Chart Section -->
        <section aria-labelledby="chart-heading" class="mb-8">

            @if ($auth->user_role === 'ketuatim')    
                <form method="GET" class="w-full md:w-auto mb-4">
                    <label for="month_year" class="sr-only">Filter Bulan/Tahun</label>
                    <select name="month_year" id="month_year"
                        class="w-full px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 focus:ring-2 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700 transition-colors"
                        aria-label="Filter berdasarkan bulan dan tahun">
                        <option value="">Semua Periode</option>
                        @foreach($activityDates as $date)
                            <option value="{{ $date }}" {{ request('month_year') == $date ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::createFromFormat('Y-m', $date)->translatedFormat('F Y') }}
                            </option>
                        @endforeach
                    </select>
                </form>
            @endif

            @if ($auth->user_role === 'kepalabps')                
                <form method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                    <div>
                        <label for="team_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Filter Tim</label>
                        <select name="team_id" id="team_id"
                            class="w-full px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 focus:ring-2 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700 transition-colors">
                            @foreach($teams as $team)
                                <option value="{{ $team->id }}" {{ request('team_id') == $team->id ? 'selected' : '' }}>
                                    {{ $team->team_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="month_year" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Filter Bulan/Tahun</label>
                        <select name="month_year" id="month_year"
                            class="w-full px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 focus:ring-2 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700 transition-colors">
                            <option value="">Semua Periode</option>
                            @foreach($activityDates as $date)
                                <option value="{{ $date }}" {{ request('month_year') == $date ? 'selected' : '' }}>
                                    {{ \Carbon\Carbon::createFromFormat('Y-m', $date)->translatedFormat('F Y') }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </form>
            @endif

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-5">
                <!-- Chart Container -->
                <div class="chart-container" style="position: relative; height:400px; width:100%">
                    <canvas id="taskChart" aria-label="Grafik distribusi tugas per pegawai"></canvas>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                <!-- Chart Container -->
                <div class="chart-container" style="position: relative; height:400px; width:100%">
                    <canvas id="progressChart" aria-label="Grafik distribusi tugas per pegawai"></canvas>
                </div>
            </div>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            try {
                const ctx = document.getElementById('taskChart');
                if (!ctx) {
                    throw new Error('Chart canvas element not found');
                }

                // Generate consistent colors
                const statusColors = {
                    'Tugas Selesai': '#3B82F6', 
                    'Tugas Aktif': '#10B981', 
                    'Tugas Menunggu Persetujuan Dari Ketua Tim Lain': '#FBBF24',
                };

                // Prepare datasets with consistent colors
                const datasets = @json($statusDescriptions).map(desc => ({
                    label: desc,
                    data: @json($chartData)[desc] || [],
                    backgroundColor: statusColors[desc] || `#${Math.floor(Math.random()*16777215).toString(16)}`,
                    borderColor: '#ffffff',
                    borderWidth: 1
                }));

                // Check if data is empty
                const totalTasks = datasets.reduce((sum, dataset) => 
                    sum + dataset.data.reduce((a, b) => a + b, 0), 0);
                
                if (totalTasks === 0) {
                    ctx.parentElement.innerHTML = `
                        <div class="text-center py-8 text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <p class="mt-2 text-lg">Tidak ada data tugas yang tersedia</p>
                        </div>
                    `;
                    return;
                }

                const config = {
                    type: 'bar',
                    data: {
                        labels: @json($userNames),
                        datasets: datasets
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            title: {
                                display: true,
                                text: 'Berdasarkan Status Tugas',
                                font: {
                                    size: 16
                                }
                            },
                            tooltip: {
                                callbacks: {
                                    afterLabel: function(context) {
                                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                        const percentage = Math.round((context.raw / total) * 100);
                                        return `Persentase: ${percentage}%`;
                                    }
                                }
                            },
                            legend: {
                                display: true
                            }
                        },
                        scales: {
                            x: {
                                stacked: true,
                                grid: {
                                    display: false
                                },
                                title: {
                                    display: true,
                                    text: 'Nama Pegawai'
                                }
                            },
                            y: {
                                stacked: true,
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Jumlah Tugas'
                                },
                                ticks: {
                                    stepSize: 1
                                }
                            }
                        },
                        animation: {
                            duration: 1000
                        }
                    }
                };

                const chart = new Chart(ctx, config);
            } catch (error) {
                console.error('Error initializing chart:', error);
                const container = ctx?.parentElement;
                if (container) {
                    container.innerHTML = `
                        <div class="bg-red-50 text-red-600 p-4 rounded">
                            <p class="font-medium">Gagal memuat grafik:</p>
                            <p>${error.message}</p>
                        </div>
                    `;
                }
            }
        });

        document.getElementById('month_year')?.addEventListener('change', function() {
                updateUrlParams('month_year', this.value);
        });

        function updateUrlParams(key, value) {
            const urlParams = new URLSearchParams(window.location.search);
            urlParams.set(key, value);
            urlParams.set('page', 1); 
            window.location.href = window.location.pathname + '?' + urlParams.toString();
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            try {
                const ctx = document.getElementById('progressChart');
                if (!ctx) {
                    throw new Error('Chart canvas element not found');
                }

                const statusColors = {
                    'Terlambat': '#000000',
                    'Progress Lambat': '#ef4444',
                    'Progress On Time': '#fbbf24',
                    'Progress Cepat': '#10b981',
                    'Selesai': '#3b82f6'
                };

                // Siapkan datasets untuk chart
                const datasets = @json($spiStatuses).map(status => ({
                    label: status,
                    data: @json($chartDataProgress)[status] || [],
                    backgroundColor: statusColors[status] || '#888888',
                    borderColor: '#ffffff',
                    borderWidth: 1
                }));

                // Cek jika data kosong
                const totalTasks = datasets.reduce((sum, dataset) =>
                    sum + dataset.data.reduce((a, b) => a + b, 0), 0);

                if (totalTasks === 0) {
                    ctx.parentElement.innerHTML = `
                        <div class="text-center py-8 text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <p class="mt-2 text-lg">Tidak ada data tugas yang tersedia</p>
                        </div>
                    `;
                    return;
                }

                const config = {
                    type: 'bar',
                    data: {
                        labels: @json($userNames),
                        datasets: datasets
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            title: {
                                display: true,
                                text: 'Berdasarkan Progress Tugas (Tugas Aktif)',
                                font: {
                                    size: 16
                                }
                            },
                            tooltip: {
                                callbacks: {
                                    afterLabel: function(context) {
                                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                        const percentage = Math.round((context.raw / total) * 100);
                                        return `Persentase: ${percentage}%`;
                                    }
                                }
                            },
                            legend: {
                                display: true
                            }
                        },
                        scales: {
                            x: {
                                stacked: true,
                                grid: {
                                    display: false
                                },
                                title: {
                                    display: true,
                                    text: 'Nama Pegawai'
                                }
                            },
                            y: {
                                stacked: true,
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Jumlah Tugas'
                                },
                                ticks: {
                                    stepSize: 1
                                }
                            }
                        },
                        animation: {
                            duration: 1000
                        }
                    }
                };

                const chart = new Chart(ctx, config);
            } catch (error) {
                console.error('Error initializing chart:', error);
                const container = ctx?.parentElement;
                if (container) {
                    container.innerHTML = `
                        <div class="bg-red-50 text-red-600 p-4 rounded">
                            <p class="font-medium">Gagal memuat grafik:</p>
                            <p>${error.message}</p>
                        </div>
                    `;
                }
            }
        });

        document.getElementById('month_year')?.addEventListener('change', function() {
            this.form.submit();
        });

        document.getElementById('team_id')?.addEventListener('change', function() {
            updateUrlParams('team_id', this.value);
        });

        document.getElementById('month_year')?.addEventListener('change', function() {
            updateUrlParams('month_year', this.value);
        });

        function updateUrlParams(key, value) {
            const urlParams = new URLSearchParams(window.location.search);
            urlParams.set(key, value);
            urlParams.set('page', 1); 
            window.location.href = window.location.pathname + '?' + urlParams.toString();
        }
    </script>

</x-layout>