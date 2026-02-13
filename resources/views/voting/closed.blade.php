<x-app-layout>
    <x-slot name="header">
        <h4 class="text-white font-bold tracking-tight">Status Pemilihan</h4>
    </x-slot>

    <div class="min-h-[60vh] flex flex-col items-center justify-center text-center p-6">

        @if ($status === 'belum_mulai')
            <div
                class="w-24 h-24 bg-amber-500/10 rounded-full flex items-center justify-center mb-6 border border-amber-500/20 shadow-[0_0_20px_rgba(245,158,11,0.2)]">
                <svg class="w-12 h-12 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>

            <h3 class="text-3xl font-black text-white mb-2 italic uppercase tracking-tighter">Voting Belum Dibuka</h3>

            <div class="flex gap-4 mb-8 mt-4 justify-center" id="countdown-container">
                <div class="bg-white/5 border border-white/10 p-3 rounded-2xl min-w-[70px]">
                    <span id="days" class="block text-2xl font-black text-blue-500 leading-none">00</span>
                    <span class="text-[10px] text-gray-500 uppercase font-bold">Hari</span>
                </div>
                <div class="bg-white/5 border border-white/10 p-3 rounded-2xl min-w-[70px]">
                    <span id="hours" class="block text-2xl font-black text-blue-500 leading-none">00</span>
                    <span class="text-[10px] text-gray-500 uppercase font-bold">Jam</span>
                </div>
                <div class="bg-white/5 border border-white/10 p-3 rounded-2xl min-w-[70px]">
                    <span id="minutes" class="block text-2xl font-black text-blue-500 leading-none">00</span>
                    <span class="text-[10px] text-gray-500 uppercase font-bold">Menit</span>
                </div>
                <div class="bg-white/5 border border-white/10 p-3 rounded-2xl min-w-[70px]">
                    <span id="seconds"
                        class="block text-2xl font-black text-amber-500 leading-none animate-pulse">00</span>
                    <span class="text-[10px] text-gray-500 uppercase font-bold">Detik</span>
                </div>
            </div>

            <p class="text-gray-400 max-w-md mx-auto leading-relaxed mb-6">
                Sistem sedang dipersiapkan. Bilik suara akan otomatis terbuka setelah waktu tunggu berakhir.
            </p>
        @else
            <div
                class="w-24 h-24 bg-red-500/10 rounded-full flex items-center justify-center mb-6 border border-red-500/20 shadow-[0_0_20px_rgba(239,68,68,0.2)]">
                <svg class="w-12 h-12 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                    </path>
                </svg>
            </div>
            <h3 class="text-3xl font-black text-white mb-2 italic uppercase">Voting Telah Berakhir</h3>
            <p class="text-gray-400 max-w-md mx-auto leading-relaxed mb-4">
                Masa pemilihan resmi ditutup. Terima kasih atas partisipasi Anda dalam e-voting Himpasikom.
            </p>
            <div class="bg-white/5 px-6 py-3 rounded-2xl border border-white/10">
                <span class="text-xs text-gray-500 uppercase block mb-1">Berakhir Pada:</span>
                <span
                    class="text-red-400 font-bold font-mono">{{ \Carbon\Carbon::parse($setting->voting_end)->format('d M Y, H:i') }}
                    WIB</span>
            </div>
        @endif

        <div class="mt-10 flex gap-4">
            <a href="{{ route('dashboard') }}"
                class="px-8 py-3 bg-white/5 border border-white/10 text-white rounded-xl hover:bg-white/10 transition font-bold text-sm">
                Kembali ke Dashboard
            </a>
            @if ($status === 'belum_mulai')
                <button onclick="window.location.reload()"
                    class="px-8 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-500 transition font-bold text-sm shadow-lg shadow-blue-600/20">
                    Refresh
                </button>
            @endif
        </div>
    </div>
</x-app-layout>
@if ($status === 'belum_mulai')
    <script>
        function startCountdown() {
            // Ambil waktu mulai dari database (Pastikan formatnya ISO)
            const startTime = new Date("{{ $setting->voting_start }}").getTime();

            const timer = setInterval(function() {
                const now = new Date().getTime();
                const distance = startTime - now;

                // Kalkulasi Hari, Jam, Menit, Detik
                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Tampilkan ke elemen HTML
                document.getElementById("days").innerText = days.toString().padStart(2, '0');
                document.getElementById("hours").innerText = hours.toString().padStart(2, '0');
                document.getElementById("minutes").innerText = minutes.toString().padStart(2, '0');
                document.getElementById("seconds").innerText = seconds.toString().padStart(2, '0');

                // Jika waktu sudah habis (jarak < 0)
                if (distance < 0) {
                    clearInterval(timer);
                    // Reload halaman otomatis agar bilik suara terbuka
                    window.location.reload();
                }
            }, 1000);
        }

        // Jalankan fungsi
        startCountdown();
    </script>
@endif
