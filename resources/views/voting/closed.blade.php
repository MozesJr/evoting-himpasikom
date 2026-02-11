<x-app-layout>
    <x-slot name="header">
        <h4 class="text-white font-bold tracking-tight">Status Pemilihan</h4>
    </x-slot>

    <div class="min-h-[60vh] flex flex-col items-center justify-center text-center">
        <div class="w-24 h-24 bg-red-500/10 rounded-full flex items-center justify-center mb-6 border border-red-500/20">
            <svg class="w-12 h-12 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                </path>
            </svg>
        </div>
        <h3 class="text-3xl font-black text-white mb-2 italic">VOTING TELAH BERAKHIR</h3>
        <p class="text-gray-400 max-w-md mx-auto leading-relaxed px-6">
            Masa pemilihan telah resmi ditutup oleh admin. Hasil akhir akan diumumkan melalui kanal resmi Himpasikom.
            Terima kasih atas partisipasi Anda!
        </p>
        <a href="{{ route('dashboard') }}"
            class="mt-8 px-8 py-3 bg-white/5 border border-white/10 text-white rounded-xl hover:bg-white/10 transition font-bold text-sm">
            Kembali ke Dashboard </a>
    </div>
</x-app-layout>
