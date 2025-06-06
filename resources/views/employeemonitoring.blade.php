<x-layout>
    <p class="text-sm text-gray-600 mb-4">Monitoring Pegawai</p>

    <div class="container mx-auto my-8">
        <h1 class="text-2xl font-bold mb-4">Jumlah Tugas Aktif pada Setiap Anggota Tim</h1>
        <canvas id="tasksChart" width="400" height="200"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('tasksChart').getContext('2d');
            const tasksChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($tasksPerUser->pluck('user_full_name')),
                    datasets: [{
                        label: 'Jumlah Tugas Aktif',
                        data: @json($tasksPerUser->pluck('tasks_count')), 
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
</x-layout>