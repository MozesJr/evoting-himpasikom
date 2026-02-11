<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h4 class="text-xl font-bold text-white tracking-tight italic">LIVE QUICK COUNT</h4>
            <div class="px-4 py-1 bg-red-500/20 border border-red-500/50 rounded-full">
                <span class="text-[10px] text-red-500 font-black animate-pulse">● LIVE UPDATE</span>
            </div>
        </div>
    </x-slot>

    <div class="max-w-5xl mx-auto">
        <div
            class="bg-[#1e293b]/50 border border-white/5 rounded-[2.5rem] p-8 shadow-2xl backdrop-blur-md relative overflow-hidden">
            {{-- Background Glow --}}
            <div class="absolute top-0 right-0 w-64 h-64 bg-blue-600/10 rounded-full blur-[100px]"></div>

            <div class="relative z-10">
                <div class="mb-8 flex justify-between items-end">
                    <div>
                        <h2 class="text-gray-400 text-xs font-bold uppercase tracking-[0.3em] mb-2">Visualisasi Data
                        </h2>
                        <h3 class="text-white text-2xl font-black">Perolehan Suara Kandidat</h3>
                    </div>
                    <div id="total-badge" class="text-right">
                        <span class="text-blue-400 font-mono text-3xl font-black" id="totalVotesDisplay">...</span>
                        <span class="block text-[10px] text-gray-500 font-bold uppercase tracking-tighter">Total Suara
                            Masuk</span>
                    </div>
                </div>

                <div class="h-[400px]">
                    <canvas id="chartVoting"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        let chart;
        Chart.defaults.color = '#94a3b8';
        Chart.defaults.font.family = 'Plus Jakarta Sans';

        function loadChart() {
            fetch("{{ route('voting.realtime') }}")
                .then(response => response.json())
                .then(data => {
                    let nama = data.map(item => item.nama);
                    let suara = data.map(item => item.votes_count);
                    let total = suara.reduce((a, b) => a + b, 0);
                    document.getElementById('totalVotesDisplay').innerText = total;

                    if (chart) {
                        chart.data.labels = nama;
                        chart.data.datasets[0].data = suara;

                        // Gunakan 'none' agar grafik tidak "melompat" saat update tiap 3 detik
                        chart.update('none');

                        // Update angka total suara di layar
                        let total = suara.reduce((a, b) => a + b, 0);
                        document.getElementById('totalVotesDisplay').innerText = total;
                        return;
                    }

                    const ctx = document.getElementById('chartVoting').getContext('2d');

                    // Create Gradient
                    const gradient = ctx.createLinearGradient(0, 0, 0, 400);
                    gradient.addColorStop(0, '#3b82f6');
                    gradient.addColorStop(1, '#1d4ed800');

                    chart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: nama,
                            datasets: [{
                                label: 'Jumlah Suara',
                                data: suara,
                                backgroundColor: gradient,
                                borderColor: '#3b82f6',
                                borderWidth: 2,
                                borderRadius: 12,
                                borderSkipped: false,
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    grid: {
                                        color: 'rgba(255, 255, 255, 0.05)',
                                        drawBorder: false
                                    },
                                    ticks: {
                                        precision: 0
                                    }
                                },
                                x: {
                                    grid: {
                                        display: false
                                    },
                                    ticks: {
                                        font: {
                                            weight: 'bold'
                                        }
                                    }
                                }
                            }
                        }
                    });
                });
        }

        loadChart();
        setInterval(loadChart, 3000);
    </script>
</x-app-layout>
