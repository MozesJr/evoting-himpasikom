<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('candidates.index') }}" class="p-2 bg-white/5 hover:bg-white/10 rounded-xl transition">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <h4 class="text-xl font-bold text-white tracking-tight">Tambah Kandidat Baru</h4>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto">
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 text-red-400 rounded-2xl text-sm">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-[#1e293b]/50 border border-white/5 rounded-3xl p-8 backdrop-blur-sm shadow-2xl">
            <form method="POST" action="{{ route('candidates.store') }}" enctype="multipart/form-data"
                class="space-y-8">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-4">
                        <label class="block text-sm font-bold text-gray-400 uppercase tracking-widest">Foto
                            Resmi</label>
                        <div
                            class="relative group w-full aspect-[3/4] rounded-3xl overflow-hidden border-2 border-dashed border-white/10 hover:border-blue-500/50 transition-all bg-[#0f172a] flex flex-col items-center justify-center text-center p-6">

                            <div id="preview-container" class="hidden absolute inset-0">
                                <img id="image-preview" class="w-full h-full object-cover">
                            </div>

                            <div id="upload-placeholder" class="space-y-4">
                                <div class="w-16 h-16 bg-white/5 rounded-2xl flex items-center justify-center mx-auto">
                                    <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <span class="block text-sm text-white font-bold">Pilih Foto</span>
                                    <span class="text-xs text-gray-500">Format: JPG, PNG (Max. 2MB)</span>
                                </div>
                            </div>

                            <input type="file" name="foto" id="foto-input" accept="image/*" required
                                class="absolute inset-0 opacity-0 cursor-pointer z-10">
                        </div>
                    </div>

                    <div class="space-y-5">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-tighter mb-2">Nama
                                Lengkap Kandidat</label>
                            <input type="text" name="nama" value="{{ old('nama') }}" required
                                class="w-full bg-[#0f172a] border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 outline-none transition-all"
                                placeholder="Masukkan nama lengkap...">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-tighter mb-2">Nomor
                                Urut</label>
                            <input type="number" name="nomor_urut" value="{{ old('nomor_urut') }}" required
                                class="w-full bg-[#0f172a] border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 outline-none transition-all"
                                placeholder="Contoh: 1">
                        </div>

                        <div>
                            <label
                                class="block text-xs font-bold text-gray-500 uppercase tracking-tighter mb-2">Visi</label>
                            <textarea name="visi" rows="3" required
                                class="w-full bg-[#0f172a] border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 outline-none transition-all"
                                placeholder="Apa visi utama kandidat?">{{ old('visi') }}</textarea>
                        </div>

                        <div>
                            <label
                                class="block text-xs font-bold text-gray-500 uppercase tracking-tighter mb-2">Misi</label>
                            <textarea name="misi" rows="4" required
                                class="w-full bg-[#0f172a] border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 outline-none transition-all"
                                placeholder="Gunakan poin-poin untuk misi...">{{ old('misi') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-4 pt-6 border-t border-white/5">
                    <button type="submit"
                        class="flex-1 bg-white text-slate-900 font-bold py-4 rounded-2xl hover:bg-blue-50 transition-all shadow-xl active:scale-[0.98] uppercase tracking-wider text-sm">
                        Simpan Kandidat
                    </button>
                    <a href="{{ route('candidates.index') }}"
                        class="px-8 py-4 bg-white/5 text-gray-400 font-bold rounded-2xl hover:bg-white/10 transition-all text-sm">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        const fotoInput = document.getElementById('foto-input');
        const previewContainer = document.getElementById('preview-container');
        const previewImage = document.getElementById('image-preview');
        const placeholder = document.getElementById('upload-placeholder');

        fotoInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</x-app-layout>
