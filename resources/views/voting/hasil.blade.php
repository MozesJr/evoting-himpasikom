<x-app-layout>

    <x-slot name="header">
        <h4>Hasil Voting Realtime</h4>
    </x-slot>

    <div class="container mt-4">

        <div class="card shadow">
            <div class="card-body">
                <canvas id="chartVoting"></canvas>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        let chart;

        function loadChart() {

            fetch("{{ route('voting.realtime') }}")
                .then(response => response.json())
                .then(data => {

                    let nama = data.map(item => item.nama);
                    let suara = data.map(item => item.votes_count);

                    if (chart) {
                        chart.data.labels = nama;
                        chart.data.datasets[0].data = suara;
                        chart.update();
                        return;
                    }

                    const ctx = document.getElementById('chartVoting');

                    chart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: nama,
                            datasets: [{
                                label: 'Jumlah Suara',
                                data: suara,
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        precision: 0
                                    }
                                }
                            }
                        }
                    });
                });
        }

        // load pertama
        loadChart();

        // refresh tiap 3 detik
        setInterval(loadChart, 3000);
    </script>

</x-app-layout>
