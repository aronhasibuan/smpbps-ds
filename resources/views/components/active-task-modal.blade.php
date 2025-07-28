<button class="font-medium text-sm sm:text-base text-blue-600 hover:underline cursor-pointer transition-colors duration-200 w-full sm:w-auto text-center sm:text-right"
    onclick="toggleActiveTaskModal()">
    Tampilkan Tugas Aktif Pegawai Saat Ini &raquo;
</button>

<div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 hidden fixed inset-0 z-50 overflow-y-auto" id="active-task-modal">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true" onclick="toggleActiveTaskModal()">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <!-- Modal content -->
        <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
            <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100 mb-4">
                            Distribusi Tugas Aktif Pegawai
                        </h3>
                        
                        <!-- Chart Container -->
                        <div class="chart-container" style="position: relative; height:400px; width:100%">
                            <canvas id="progressChart" aria-label="Grafik distribusi tugas per pegawai"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" onclick="toggleActiveTaskModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm dark:bg-gray-600 dark:text-gray-200 dark:border-gray-500">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Chart initialization code remains the same as your original
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

    // Improved modal toggle function
    function toggleActiveTaskModal() {
        const modal = document.getElementById('active-task-modal');
        const body = document.body;
        
        if (modal.classList.contains('hidden')) {
            // Show modal
            modal.classList.remove('hidden');
            body.classList.add('overflow-hidden');
            
            // Focus the close button for accessibility
            setTimeout(() => {
                const closeBtn = modal.querySelector('button');
                if (closeBtn) closeBtn.focus();
            }, 100);
        } else {
            // Hide modal
            modal.classList.add('hidden');
            body.classList.remove('overflow-hidden');
        }
    }

    // Close modal with ESC key
    document.addEventListener('keydown', function(event) {
        const modal = document.getElementById('active-task-modal');
        if (event.key === 'Escape' && !modal.classList.contains('hidden')) {
            toggleActiveTaskModal();
        }
    });
</script>