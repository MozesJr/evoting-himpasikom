<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Voting HIMPASIKOM 2026</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #0f172a;
        }

        .glass {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .hero-gradient {
            background: radial-gradient(circle at 50% 50%, rgba(59, 130, 246, 0.15) 0%, rgba(15, 23, 42, 0) 70%);
        }
    </style>
</head>

<body class="antialiased text-white selection:bg-blue-500 selection:text-white overflow-x-hidden">

    <div class="fixed inset-0 hero-gradient -z-10"></div>

    <div class="relative min-h-screen flex flex-col items-center justify-between px-4 sm:px-6">

        @if (Route::has('login'))
            <nav class="w-full max-w-7xl mx-auto flex justify-between md:justify-end items-center py-6 md:py-8 z-20">
                <div class="md:hidden font-bold text-blue-500 tracking-tight">HIMPASIKOM</div>

                <div class="flex items-center space-x-4 md:space-x-8">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="text-xs md:text-sm font-medium hover:text-blue-400 transition">Dashboard</a>
                    @else
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 rounded-full text-[10px] md:text-sm font-bold transition shadow-lg shadow-blue-500/20 active:scale-95">
                                Daftar Sekarang
                            </a>
                        @endif
                    @endauth
                </div>
            </nav>
        @endif

        <main class="flex-grow flex flex-col items-center justify-center w-full max-w-5xl py-12 md:py-20">
            <div class="text-center">
                <span
                    class="inline-block px-4 py-1.5 mb-6 text-[10px] md:text-xs font-bold tracking-[0.2em] text-blue-400 uppercase bg-blue-400/10 border border-blue-400/20 rounded-full">
                    Pemilihan Umum Mahasiswa
                </span>

                <h1 class="text-4xl sm:text-5xl md:text-7xl font-extrabold tracking-tight mb-6 px-2 leading-[1.1]">
                    <span class="bg-clip-text text-transparent bg-gradient-to-b from-white to-gray-400">Aplikasi
                        E-Voting</span><br>
                    <span class="text-blue-500 inline-block mt-2">HIMPASIKOM 2026</span>
                </h1>

                <p class="text-sm md:text-xl text-gray-400 mb-10 max-w-2xl mx-auto leading-relaxed px-4">
                    Suara Anda menentukan masa depan HIMPASIKOM. Sistem pemilihan yang transparan, aman, dan mudah
                    digunakan untuk seluruh civitas akademika.
                </p>

                <div class="flex flex-col sm:flex-row items-center justify-center gap-4 px-6">
                    <a href="{{ route('login') }}"
                        class="w-full sm:w-auto px-10 py-4 bg-white text-slate-900 font-bold rounded-xl hover:bg-blue-50 transition transform hover:-translate-y-1 active:scale-95 text-center shadow-xl">
                        Mulai Voting
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 md:gap-6 mt-16 md:mt-24 w-full text-left">
                <div class="glass p-6 md:p-8 rounded-2xl group hover:border-blue-500/50 transition">
                    <div
                        class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center mb-5 group-hover:scale-110 transition">
                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-lg mb-2">Aman & Terenkripsi</h3>
                    <p class="text-sm text-gray-400 leading-relaxed">Data pemilih dijamin kerahasiaannya dengan sistem
                        keamanan enkripsi terkini.</p>
                </div>

                <div class="glass p-6 md:p-8 rounded-2xl group hover:border-purple-500/50 transition">
                    <div
                        class="w-12 h-12 bg-purple-500/20 rounded-xl flex items-center justify-center mb-5 group-hover:scale-110 transition">
                        <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-lg mb-2">Real-Time Count</h3>
                    <p class="text-sm text-gray-400 leading-relaxed">Hasil perhitungan suara dapat dipantau secara
                        langsung setelah periode voting selesai.</p>
                </div>

                <div
                    class="glass p-6 md:p-8 rounded-2xl group hover:border-emerald-500/50 transition sm:col-span-2 md:col-span-1">
                    <div
                        class="w-12 h-12 bg-emerald-500/20 rounded-xl flex items-center justify-center mb-5 group-hover:scale-110 transition">
                        <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-lg mb-2">Akses Cepat</h3>
                    <p class="text-sm text-gray-400 leading-relaxed">Optimalkan pengalaman memilih melalui perangkat
                        mobile dengan antarmuka yang ringan.</p>
                </div>
            </div>
        </main>

        <footer class="w-full text-center py-8 border-t border-white/5 mt-10">
            <p class="text-gray-500 text-xs md:text-sm tracking-wide">
                &copy; 2026 <span class="text-gray-400 font-semibold">HIMPASIKOM</span>. All rights reserved.
            </p>
        </footer>
    </div>
</body>

</html>
