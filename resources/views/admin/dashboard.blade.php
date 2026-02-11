<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <h4 class="text-xl font-bold text-white tracking-tight">
                Dashboard Admin <span class="text-blue-500">HIMPASIKOM 2026</span>
            </h4>
            <div class="flex items-center gap-2 text-sm">
                <span class="text-gray-400">Status Sistem:</span>
                @if ($setting->voting_open)
                    <span
                        class="flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-500/10 text-emerald-500 border border-emerald-500/20 font-bold text-xs">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        VOTING DIBUKA
                    </span>
                @else
                    <span
                        class="flex items-center gap-1.5 px-3 py-1 rounded-full bg-red-500/10 text-red-500 border border-red-500/20 font-bold text-xs">
                        <span class="w-2 h-2 rounded-full bg-red-500"></span>
                        VOTING DITUTUP
                    </span>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="space-y-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @php
                $stats = [
                    [
                        'label' => 'Total Pemilih',
                        'value' => $totalPemilih,
                        'icon' =>
                            'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z',
                        'color' => 'blue',
                    ],
                    [
                        'label' => 'Sudah Vote',
                        'value' => $sudahVote,
                        'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
                        'color' => 'emerald',
                    ],
                    [
                        'label' => 'Belum Vote',
                        'value' => $belumVote,
                        'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
                        'color' => 'orange',
                    ],
                    [
                        'label' => 'Total Kandidat',
                        'value' => $totalKandidat,
                        'icon' =>
                            'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z',
                        'color' => 'purple',
                    ],
                ];
            @endphp

            @foreach ($stats as $s)
                <div
                    class="bg-[#1e293b]/50 border border-white/5 p-6 rounded-3xl hover:border-{{ $s['color'] }}-500/30 transition-all group">
                    <div class="flex items-center justify-between mb-4">
                        <div
                            class="w-12 h-12 rounded-2xl bg-{{ $s['color'] }}-500/10 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-{{ $s['color'] }}-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="{{ $s['icon'] }}"></path>
                            </svg>
                        </div>
                        <span
                            class="text-xs font-bold text-{{ $s['color'] }}-500 uppercase tracking-widest">Live</span>
                    </div>
                    <h5 class="text-gray-400 text-sm font-medium">{{ $s['label'] }}</h5>
                    <h2 class="text-3xl font-extrabold text-white mt-1">{{ number_format($s['value'], 0, ',', '.') }}
                    </h2>
                </div>
            @endforeach
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-1 space-y-6">
                <div
                    class="bg-gradient-to-br from-blue-600 to-blue-700 p-8 rounded-3xl shadow-xl shadow-blue-500/10 relative overflow-hidden group">
                    <svg class="absolute -right-10 -bottom-10 w-40 h-40 text-white/10 group-hover:scale-125 transition-transform"
                        fill="currentColor" viewBox="0 0 24 24">
                        <path d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    <h5 class="text-blue-100 font-medium mb-1 relative z-10">Total Suara Masuk</h5>
                    <h2 class="text-5xl font-black text-white relative z-10">{{ $totalSuaraMasuk }}</h2>
                    <p class="text-blue-200 text-xs mt-4 relative z-10">Pembaruan otomatis sistem setiap suara masuk.
                    </p>
                </div>

                <div class="bg-[#1e293b]/50 border border-white/5 p-6 rounded-3xl">
                    <h5 class="text-white font-bold mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Informasi Cepat
                    </h5>
                    <ul class="space-y-3 text-sm text-gray-400">
                        <li class="flex justify-between"><span>Partisipasi:</span> <span
                                class="text-white font-mono">{{ $totalPemilih > 0 ? round(($sudahVote / $totalPemilih) * 100, 1) : 0 }}%</span>
                        </li>
                        <li class="flex justify-between"><span>Metode:</span> <span class="text-white font-mono">One Man
                                One Vote</span></li>
                    </ul>
                </div>
            </div>

            <div class="lg:col-span-2">
                <div class="bg-[#1e293b]/50 border border-white/5 rounded-3xl overflow-hidden">
                    <div class="p-6 border-b border-white/5 flex items-center justify-between">
                        <h5 class="text-white font-bold italic uppercase tracking-tighter">Perolehan Suara Sementara
                        </h5>
                        <div class="flex gap-1">
                            <div class="w-2 h-2 rounded-full bg-red-500"></div>
                            <div class="w-2 h-2 rounded-full bg-yellow-500"></div>
                            <div class="w-2 h-2 rounded-full bg-green-500"></div>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="text-gray-500 text-xs uppercase tracking-widest border-b border-white/5">
                                    <th class="px-6 py-4 font-semibold">Rank</th>
                                    <th class="px-6 py-4 font-semibold">Kandidat</th>
                                    <th class="px-6 py-4 font-semibold text-right">Jumlah Suara</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @foreach ($hasilVoting as $k)
                                    <tr class="hover:bg-white/5 transition group">
                                        <td class="px-6 py-4">
                                            @if ($loop->iteration == 1)
                                                <span
                                                    class="w-8 h-8 rounded-lg bg-yellow-500/20 text-yellow-500 flex items-center justify-center font-bold">1</span>
                                            @else
                                                <span class="text-gray-500 font-mono ml-3">{{ $loop->iteration }}</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 font-bold text-white group-hover:text-blue-400 transition">
                                            {{ $k->nama }}</td>
                                        <td class="px-6 py-4 text-right">
                                            <span
                                                class="px-3 py-1 bg-blue-500/10 text-blue-500 rounded-lg font-mono font-bold">
                                                {{ $k->votes_count }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
