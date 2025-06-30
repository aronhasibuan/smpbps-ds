<x-layout>
    <div class="container mx-auto px-4 py-6">
        <!-- Page Header -->
        <header class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Monitoring Pegawai</h1>
            <p class="text-sm text-gray-600 dark:text-gray-400">Distribusi Tugas per Pegawai Berdasarkan Status</p>
        </header>

        <!-- Chart Section -->
        <section aria-labelledby="chart-heading" class="mb-8">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                <h2 id="chart-heading" class="text-xl font-semibold text-gray-800 dark:text-white mb-4">
                    Jumlah Task per User berdasarkan Status
                </h2>
                
                <!-- Chart Container -->
                <div class="chart-container" style="position: relative; height:400px; width:100%">
                    <canvas id="taskChart" aria-label="Grafik distribusi tugas per pegawai"></canvas>
                </div>

                <!-- Chart Legend -->
                <div id="chartLegend" class="mt-4 flex flex-wrap justify-center gap-2"></div>
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
                    'Completed': '#10B981', // green
                    'In Progress': '#3B82F6', // blue
                    'Pending': '#F59E0B', // amber
                    'Overdue': '#EF4444', // red
                    'Not Started': '#6B7280' // gray
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
                                text: 'Distribusi Tugas per Pegawai',
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
                                display: false // We'll use custom legend
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

                // Create custom legend
                const legendContainer = document.getElementById('chartLegend');
                if (legendContainer) {
                    config.data.datasets.forEach(dataset => {
                        const legendItem = document.createElement('div');
                        legendItem.className = 'flex items-center px-3 py-1 rounded-full text-xs';
                        legendItem.style.backgroundColor = dataset.backgroundColor + '20'; // Add opacity
                        legendItem.style.border = `1px solid ${dataset.backgroundColor}`;
                        
                        legendItem.innerHTML = `
                            <span class="w-3 h-3 rounded-full mr-2" style="background-color: ${dataset.backgroundColor}"></span>
                            ${dataset.label}
                        `;
                        legendContainer.appendChild(legendItem);
                    });
                }

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
    </script>

</x-layout>