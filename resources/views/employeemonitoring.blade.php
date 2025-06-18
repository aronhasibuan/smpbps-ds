<x-layout>
    <p class="text-sm text-gray-600 mb-4">Monitoring Pegawai</p>

    <h2>Jumlah Task per User berdasarkan Status</h2>
    <canvas id="taskChart"></canvas>

    <script>
        const ctx = document.getElementById('taskChart').getContext('2d');

        const data = {
            labels: @json($userNames),
            datasets: [
                @foreach ($statusDescriptions as $desc)
    {
        label: '{{ $desc }}',
        data: @json($chartData[$desc]),
        backgroundColor: '{{ sprintf('#%06X', mt_rand(0, 0xFFFFFF)) }}'
    },
@endforeach

            ]
        };

        const config = {
            type: 'bar',
            data: data,
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Stacked Bar Chart: Task per User berdasarkan Status'
                    },
                },
                scales: {
                    x: {
                        stacked: true,
                    },
                    y: {
                        stacked: true,
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jumlah Tugas'
                        }
                    }
                }
            }
        };

        new Chart(ctx, config);
    </script>
</x-layout>