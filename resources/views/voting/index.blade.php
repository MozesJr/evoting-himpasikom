<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h4 class="text-xl font-bold text-white tracking-tight italic uppercase">Bilik Suara Digital</h4>
            <div class="flex items-center gap-2">
                <span class="relative flex h-3 w-3">
                    <span
                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
                </span>
                <span class="text-xs font-bold text-emerald-500 uppercase tracking-widest">Sistem Aktif</span>
            </div>
        </div>
    </x-slot>

    <div class="space-y-8">
        {{-- ALERT STATUS --}}
        @if (session('success') || session('error') || $user->sudah_vote)
            <div class="max-w-4xl mx-auto">
                @if (session('success'))
                    <div
                        class="p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-500 rounded-2xl text-center font-bold animate-bounce">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div
                        class="p-4 bg-red-500/10 border border-red-500/20 text-red-500 rounded-2xl text-center font-bold">
                        {{ session('error') }}
                    </div>
                @endif
                @if ($user->sudah_vote && !session('success'))
                    <div class="p-4 bg-blue-500/10 border border-blue-500/20 text-blue-400 rounded-2xl text-center">
                        <span class="font-bold">✓ Anda telah memberikan hak suara.</span> Terima kasih atas
                        partisipasinya!
                    </div>
                @endif
            </div>
        @endif

        {{-- GRID KANDIDAT --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($candidates as $candidate)
                <div
                    class="group relative bg-[#1e293b]/50 border border-white/5 rounded-[2.5rem] overflow-hidden transition-all duration-500 hover:border-blue-500/50 hover:-translate-y-2 shadow-2xl">

                    {{-- NOMOR URUT FLOATING --}}
                    <div class="absolute top-5 left-5 z-20">
                        <div
                            class="bg-blue-600 text-white w-12 h-12 rounded-2xl flex items-center justify-center font-black text-xl shadow-lg shadow-blue-600/40 border border-white/20">
                            {{ $candidate->nomor_urut }}
                        </div>
                    </div>

                    {{-- FOTO KANDIDAT --}}
                    <div class="relative h-80 overflow-hidden">
                        @if ($candidate->foto)
                            <img src="{{ asset('storage/' . $candidate->foto) }}"
                                class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700 scale-110 group-hover:scale-100">
                        @else
                            <div class="w-full h-full bg-slate-800 flex items-center justify-center">
                                <svg class="w-20 h-20 text-slate-700" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                                </svg>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-[#1e293b] via-transparent to-transparent">
                        </div>
                    </div>

                    {{-- DETAIL --}}
                    <div class="p-8 -mt-12 relative z-10">
                        <h5 class="text-2xl font-black text-white mb-6 tracking-tight">{{ $candidate->nama }}</h5>

                        <div class="space-y-4 mb-8 text-sm">
                            <div class="bg-[#0f172a]/50 p-4 rounded-2xl border border-white/5">
                                <strong
                                    class="text-blue-400 uppercase text-[10px] tracking-[0.2em] block mb-1">Visi</strong>
                                <p class="text-gray-300 leading-relaxed line-clamp-3">{{ $candidate->visi }}</p>
                            </div>
                            <div class="bg-[#0f172a]/50 p-4 rounded-2xl border border-white/5">
                                <strong
                                    class="text-blue-400 uppercase text-[10px] tracking-[0.2em] block mb-1">Misi</strong>
                                <p class="text-gray-300 leading-relaxed line-clamp-3">{{ $candidate->misi }}</p>
                            </div>
                        </div>

                        {{-- ACTION --}}
                        @if (!$user->sudah_vote)
                            <form action="{{ route('voting.vote') }}" method="POST">
                                @csrf
                                <input type="hidden" name="candidate_id" value="{{ $candidate->id }}">
                                <button type="submit"
                                    onclick="return confirm('Yakin memilih {{ $candidate->nama }}? Pilihan tidak dapat diubah.')"
                                    class="w-full bg-white text-slate-900 font-black py-4 rounded-2xl hover:bg-blue-500 hover:text-white transition-all duration-300 shadow-xl flex items-center justify-center gap-2 uppercase tracking-widest text-xs">
                                    Berikan Suara
                                </button>
                            </form>
                        @else
                            <div
                                class="w-full bg-white/5 border border-white/10 text-gray-500 font-bold py-4 rounded-2xl text-center text-xs uppercase tracking-widest flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                                    <path fill-rule="evenodd"
                                        d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Akses Terkunci
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
