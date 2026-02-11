<x-app-layout>
    <x-slot name="header">
        <div>
            <h4 class="text-xl font-bold text-white tracking-tight">Konfigurasi Sistem</h4>
            <p class="text-sm text-gray-400">Atur periode pemilihan dan kontrol akses suara mahasiswa.</p>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto">
        @if (session('success'))
            <div
                class="mb-6 flex items-center gap-3 p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-500 rounded-2xl animate-fade-in">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-[#1e293b]/50 border border-white/5 rounded-3xl overflow-hidden shadow-2xl backdrop-blur-sm">
            <div class="p-8">
                <form method="POST" action="{{ route('admin.settings.update') }}" class="space-y-8">
                    @csrf

                    <div class="bg-[#0f172a]/50 p-6 rounded-2xl border border-white/5">
                        <label class="block text-sm font-bold text-gray-400 uppercase tracking-widest mb-4">Master
                            Switch</label>
                        <div class="relative">
                            <select name="voting_open"
                                class="w-full bg-[#1e293b] border border-white/10 rounded-xl px-4 py-4 text-white font-bold focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 outline-none appearance-none transition duration-200">
                                <option value="1" {{ $setting->voting_open ? 'selected' : '' }}>🟢 DIBUKA
                                    (Mahasiswa Bisa Vote)</option>
                                <option value="0" {{ !$setting->voting_open ? 'selected' : '' }}>🔴 DITUTUP (Akses
                                    Terkunci)</option>
                            </select>
                            <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none text-gray-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                        <p class="mt-3 text-xs text-gray-500 leading-relaxed">
                            *Jika status ditutup, mahasiswa tidak akan bisa mengakses halaman pemilihan meskipun sudah
                            dalam jadwal.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-300">Waktu Mulai</label>
                            <div class="relative">
                                <input type="datetime-local" name="voting_start"
                                    class="w-full bg-[#0f172a] border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 outline-none transition duration-200"
                                    value="{{ $setting->voting_start }}">
                                <style>
                                    input[type="datetime-local"]::-webkit-calendar-picker-indicator {
                                        filter: invert(1);
                                    }
                                </style>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-300">Waktu Berakhir</label>
                            <div class="relative">
                                <input type="datetime-local" name="voting_end"
                                    class="w-full bg-[#0f172a] border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 outline-none transition duration-200"
                                    value="{{ $setting->voting_end }}">
                            </div>
                        </div>
                    </div>

                    <div class="p-4 bg-blue-500/5 border border-blue-500/10 rounded-2xl flex gap-4">
                        <div class="shrink-0 text-blue-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="text-sm text-gray-400">
                            Pastikan pengaturan waktu sesuai dengan zona waktu server Anda. Sistem akan menutup
                            pemilihan secara otomatis setelah waktu berakhir terlampaui.
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit"
                            class="w-full bg-white text-slate-900 font-bold py-4 rounded-xl hover:bg-blue-50 transform transition active:scale-[0.98] shadow-xl shadow-white/5 flex items-center justify-center gap-2 tracking-wide uppercase text-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4">
                                </path>
                            </svg>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
