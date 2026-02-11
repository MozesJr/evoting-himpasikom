<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-xl text-white leading-tight">
                {{ __('Dashboard Pemilih') }}
            </h2>
            <span class="text-sm text-gray-400 font-medium">Tahun Akademik 2026/2026</span>
        </div>
    </x-slot>

    <div class="space-y-6">
        <div
            class="relative overflow-hidden bg-gradient-to-r from-blue-600 to-indigo-700 rounded-3xl p-8 shadow-xl shadow-blue-500/20">
            <div class="relative z-10 md:flex items-center justify-between">
                <div class="mb-6 md:mb-0">
                    <h1 class="text-3xl font-black text-white mb-2 italic uppercase tracking-tight">Halo,
                        {{ Auth::user()->name }}!</h1>
                    <p class="text-blue-100 max-w-md leading-relaxed">
                        Selamat datang di sistem E-Voting HIMPASIKOM. Gunakan hak suara Anda dengan bijak untuk
                        menentukan masa depan organisasi kita.
                    </p>
                </div>

                <div class="flex shrink-0 gap-4">
                    <div
                        class="bg-white/10 backdrop-blur-md border border-white/20 p-4 rounded-2xl text-center min-w-[100px]">
                        <span class="block text-2xl font-bold text-white">1</span>
                        <span class="text-[10px] text-blue-100 uppercase tracking-widest font-bold">Suara Anda</span>
                    </div>
                </div>
            </div>

            <div class="absolute top-0 right-0 -mt-10 -mr-10 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-[#1e293b]/50 border border-white/5 rounded-3xl p-6">
                    <h3 class="text-lg font-bold text-white mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Status Partisipasi
                    </h3>

                    @php
                        // Logika pengecekan apakah user sudah vote (sesuaikan dengan variabel controller-mu)
                        // $hasVoted = Auth::user()->votes()->exists(); // Contoh pengecekan
                        $hasVoted = 1;
                    @endphp

                    <div
                        class="flex items-center gap-6 p-4 rounded-2xl {{ $hasVoted ? 'bg-emerald-500/5 border border-emerald-500/20' : 'bg-orange-500/5 border border-orange-500/20' }}">
                        <div
                            class="w-16 h-16 rounded-full flex items-center justify-center {{ $hasVoted ? 'bg-emerald-500/20 text-emerald-500' : 'bg-orange-500/20 text-orange-500' }}">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                @if ($hasVoted)
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                @else
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                    </path>
                                @endif
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-white">
                                {{ $hasVoted ? 'Suara Berhasil Terkirim' : 'Belum Melakukan Voting' }}</h4>
                            <p class="text-sm text-gray-400">
                                {{ $hasVoted ? 'Terima kasih telah berpartisipasi dalam pemilihan tahun ini.' : 'Silakan masuk ke halaman voting untuk memilih kandidat jagoan Anda.' }}
                            </p>
                        </div>
                    </div>

                    @if (!$hasVoted)
                        <div class="mt-6">
                            <a href="{{ route('voting.index') }}"
                                class="inline-flex items-center justify-center w-full px-6 py-4 bg-white text-slate-900 font-bold rounded-xl hover:bg-blue-50 transition transform active:scale-95 shadow-xl">
                                Pergi ke Bilik Suara
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-[#1e293b]/50 border border-white/5 rounded-3xl p-6">
                    <h3 class="text-white font-bold mb-4 uppercase text-xs tracking-widest text-gray-500">Jadwal
                        Pemilihan</h3>
                    <div class="space-y-4">
                        <div class="flex items-start gap-3">
                            <div class="w-2 h-2 rounded-full bg-blue-500 mt-1.5"></div>
                            <div>
                                <p class="text-sm text-white font-medium">Mulai</p>
                                <p class="text-xs text-gray-500">10 Februari 2026, 08:00 WIB</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-2 h-2 rounded-full bg-red-500 mt-1.5"></div>
                            <div>
                                <p class="text-sm text-white font-medium">Berakhir</p>
                                <p class="text-xs text-gray-500">12 Februari 2026, 16:00 WIB</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="glass p-6 rounded-3xl border-dashed border-white/10 text-center">
                    <p class="text-xs text-gray-400 italic">"Suaramu adalah masa depan prodi kita."</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
