<x-layout>
    <p class="text-sm text-gray-600 mb-4">Monitoring Pegawai</p>
    
    <div>
        <h3 class="text-center">Frekuensi Pekerjaan Aktif Masing-Masing Pegawai</h3>

        <div style="width: 100%; overflow-x: auto;">
            <canvas id="taskChart" style="min-width: 600px;"></canvas>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                fetch("{{ route('tasks.active') }}")
                .then(response => response.json())
                .then(data => {
                    let labels = data.map(item => item.nama);
                    let jumlahTugas = data.map(item => item.jumlah_tugas);

                    new Chart(document.getElementById('taskChart'), {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Jumlah Tugas',
                                data: jumlahTugas,
                                backgroundColor: 'rgba(54, 162, 235, 0.6)',
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
                })
                .catch(error => console.error("Error fetching data:", error));
            });
        </script>

    </div>

</x-layout>