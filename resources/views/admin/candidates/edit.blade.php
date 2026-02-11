<x-app-layout>
    <x-slot name="header">
        <h4 class="text-xl font-bold text-white tracking-tight italic">Sunting Profil Kandidat</h4>
    </x-slot>

    <div class="max-w-4xl mx-auto">
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 text-red-400 rounded-2xl text-sm">
                {{ implode('', $errors->all(':message')) }}
            </div>
        @endif

        <div class="bg-[#1e293b]/50 border border-white/5 rounded-3xl p-8 backdrop-blur-sm">
            <form method="POST" action="{{ route('candidates.update', $candidate->id) }}" enctype="multipart/form-data"
                class="space-y-6">
                @csrf @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-4">
                        <label class="block text-sm font-medium text-gray-400 uppercase tracking-widest">Foto
                            Kandidat</label>
                        <div
                            class="relative group w-full aspect-[3/4] rounded-3xl overflow-hidden border-2 border-dashed border-white/10 hover:border-blue-500/50 transition-all bg-[#0f172a]">
                            @if ($candidate->foto)
                                <img src="{{ asset('storage/' . $candidate->foto) }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @endif
                            <input type="file" name="foto" class="absolute inset-0 opacity-0 cursor-pointer z-10">
                            <div
                                class="absolute inset-0 flex flex-col items-center justify-center bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity">
                                <svg class="w-10 h-10 text-white mb-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                    <path d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span class="text-xs text-white font-bold">Ganti Foto</span>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-tighter mb-2">Nama
                                Lengkap</label>
                            <input type="text" name="nama" value="{{ $candidate->nama }}"
                                class="w-full bg-[#0f172a] border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-blue-500/50 outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-tighter mb-2">Nomor
                                Urut</label>
                            <input type="number" name="nomor_urut" value="{{ $candidate->nomor_urut }}"
                                class="w-full bg-[#0f172a] border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-blue-500/50 outline-none">
                        </div>

                        <div>
                            <label
                                class="block text-xs font-bold text-gray-500 uppercase tracking-tighter mb-2">Visi</label>
                            <textarea name="visi" rows="3"
                                class="w-full bg-[#0f172a] border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-blue-500/50 outline-none">{{ $candidate->visi }}</textarea>
                        </div>

                        <div>
                            <label
                                class="block text-xs font-bold text-gray-500 uppercase tracking-tighter mb-2">Misi</label>
                            <textarea name="misi" rows="3"
                                class="w-full bg-[#0f172a] border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-blue-500/50 outline-none">{{ $candidate->misi }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-4 pt-6 border-t border-white/5">
                    <button type="submit"
                        class="flex-1 bg-white text-slate-900 font-bold py-4 rounded-2xl hover:bg-blue-50 transition-all active:scale-[0.98]">Update
                        Data Kandidat</button>
                    <a href="{{ route('candidates.index') }}"
                        class="px-8 py-4 bg-white/5 text-gray-400 font-bold rounded-2xl hover:bg-white/10 transition-all">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
