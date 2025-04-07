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
                    labels: @json($tasksPerUser->pluck('name')),
                    datasets: [{
                        label: 'Jumlah Tugas Aktif',
                        data: @json($tasksPerUser->pluck('menerimatugas_count')), 
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

<div class="container mx-auto my-8">
    <h1 class="text-2xl font-bold mb-4">Jumlah Tugas yang Diselesaikan oleh Anggota Tim</h1>
    <table class="table-auto w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-300 px-4 py-2">Nama Anggota Tim</th>
                <th class="border border-gray-300 px-4 py-2">Jumlah Tugas Selesai</th>
                <th class="border border-gray-300 px-4 py-2">Jumlah Tugas Terlambat</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasksDonePerUser as $user)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $user->name }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $user->tugas_selesai }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $user->tugas_terlambat }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</x-layout>