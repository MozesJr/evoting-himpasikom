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
                <span class="text-xs font-bold text-emerald-500 uppercase tracking-widest text-[10px] md:text-xs">Sistem
                    Aktif</span>
            </div>
        </div>
    </x-slot>

    <div class="space-y-8">
        {{-- Status Info --}}
        @if ($user->sudah_vote)
            <div class="max-w-4xl mx-auto">
                <div
                    class="p-6 bg-blue-500/10 border border-blue-500/20 text-blue-400 rounded-[2rem] text-center shadow-xl backdrop-blur-sm">
                    <div class="flex flex-col items-center gap-2">
                        <svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h3 class="text-xl font-black uppercase italic">Hak Suara Terpakai</h3>
                        <p class="text-sm opacity-80 font-medium">Terima kasih, Anda telah berpartisipasi dalam
                            menentukan masa depan Himpasikom.</p>
                    </div>
                </div>
            </div>
        @endif

        {{-- GRID KANDIDAT --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 pb-10">
            @foreach ($candidates as $candidate)
                <div
                    class="group relative bg-[#1e293b]/50 border border-white/5 rounded-[2.5rem] overflow-hidden transition-all duration-500 hover:border-blue-500/50 hover:-translate-y-2 shadow-2xl">

                    {{-- NOMOR URUT --}}
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
                                class="w-full h-full object-cover {{ $user->sudah_vote ? 'grayscale' : 'grayscale group-hover:grayscale-0' }} transition-all duration-700 scale-110 group-hover:scale-100">
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
                        <h5 class="text-2xl font-black text-white mb-6 tracking-tight leading-none italic">
                            {{ $candidate->nama }}</h5>

                        <div class="space-y-4 mb-8 text-sm">
                            <div
                                class="bg-[#0f172a]/50 p-4 rounded-2xl border border-white/5 hover:border-white/10 transition-colors">
                                <strong
                                    class="text-blue-400 uppercase text-[10px] tracking-[0.2em] block mb-1">Visi</strong>
                                <p class="text-gray-300 leading-relaxed line-clamp-3 italic">"{{ $candidate->visi }}"
                                </p>
                            </div>
                            <div
                                class="bg-[#0f172a]/50 p-4 rounded-2xl border border-white/5 hover:border-white/10 transition-colors">
                                <strong
                                    class="text-blue-400 uppercase text-[10px] tracking-[0.2em] block mb-1">Misi</strong>
                                <p class="text-gray-300 leading-relaxed line-clamp-3">{{ $candidate->misi }}</p>
                            </div>
                        </div>

                        {{-- ACTION --}}
                        @if (!$user->sudah_vote)
                            <form action="{{ route('voting.vote') }}" method="POST" class="form-vote">
                                @csrf
                                <input type="hidden" name="candidate_id" value="{{ $candidate->id }}">
                                <button type="button" data-nama="{{ $candidate->nama }}"
                                    data-nomor="{{ $candidate->nomor_urut }}"
                                    class="btn-vote w-full bg-white text-slate-900 font-black py-4 rounded-2xl hover:bg-blue-600 hover:text-white transition-all duration-300 shadow-xl flex items-center justify-center gap-2 uppercase tracking-widest text-xs active:scale-95">
                                    Pilih Kandidat
                                </button>
                            </form>
                        @else
                            <div
                                class="w-full bg-white/5 border border-white/10 text-gray-500 font-bold py-4 rounded-2xl text-center text-[10px] uppercase tracking-[0.2em] flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Pilihan Terkunci
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- SCRIPT AREA --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Handle Tombol Vote
        document.querySelectorAll('.btn-vote').forEach(button => {
            button.addEventListener('click', function(e) {
                const form = this.closest('.form-vote');
                const nama = this.getAttribute('data-nama');
                const nomor = this.getAttribute('data-nomor');

                Swal.fire({
                    title: `<span class="text-white font-black italic uppercase italic">Konfirmasi Suara</span>`,
                    html: `<p class="text-gray-400 text-sm leading-relaxed">Anda akan memberikan suara kepada <br> <b class="text-blue-500 text-lg uppercase">[ ${nomor} ] ${nama}</b>. <br><br> Apakah Anda yakin? Tindakan ini tidak dapat dibatalkan.</p>`,
                    icon: 'question',
                    iconColor: '#3b82f6',
                    showCancelButton: true,
                    confirmButtonColor: '#3b82f6',
                    cancelButtonColor: '#0f172a',
                    confirmButtonText: 'YA, SAYA YAKIN',
                    cancelButtonText: 'KEMBALI',
                    background: '#1e293b',
                    color: '#ffffff',
                    reverseButtons: true,
                    customClass: {
                        popup: 'rounded-[2.5rem] border border-white/10 shadow-2xl p-8',
                        confirmButton: 'rounded-xl font-black px-8 py-4 uppercase tracking-widest text-xs',
                        cancelButton: 'rounded-xl font-black px-8 py-4 uppercase tracking-widest text-xs border border-white/5'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Tampilkan Loading Saat Submit
                        Swal.fire({
                            title: 'Mencatat Suara...',
                            html: 'Harap jangan menutup halaman ini.',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            },
                            background: '#1e293b',
                            color: '#ffffff'
                        });
                        form.submit();
                    }
                });
            });
        });

        // Handle Success Session
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'BERHASIL!',
                text: "{{ session('success') }}",
                background: '#1e293b',
                color: '#ffffff',
                confirmButtonColor: '#3b82f6',
                customClass: {
                    popup: 'rounded-[2.5rem] border border-white/10 shadow-2xl',
                    confirmButton: 'rounded-xl font-black px-8 py-3'
                }
            });
        @endif

        // Handle Error Session
        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'GAGAL!',
                text: "{{ session('error') }}",
                background: '#1e293b',
                color: '#ffffff',
                confirmButtonColor: '#ef4444',
                customClass: {
                    popup: 'rounded-[2.5rem] border border-white/10 shadow-2xl',
                    confirmButton: 'rounded-xl font-black px-8 py-3'
                }
            });
        @endif
    </script>
</x-app-layout>
