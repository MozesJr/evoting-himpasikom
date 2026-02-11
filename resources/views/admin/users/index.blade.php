<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h4 class="text-xl font-bold text-white tracking-tight italic">Manajemen User Pemilih</h4>
                <p class="text-sm text-gray-400">Verifikasi akun mahasiswa secara realtime.</p>
            </div>

            <div class="flex gap-4">
                <div class="bg-white/5 border border-white/10 rounded-2xl px-5 py-2 text-center backdrop-blur-md">
                    <span class="block text-[10px] text-gray-500 uppercase font-black tracking-widest">Live Users</span>
                    <span class="text-xl font-black text-blue-500" id="total-user-count">...</span>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="space-y-6">
        <div id="alert-container">
            @if (session('success'))
                <div
                    class="flex items-center gap-3 p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-500 rounded-2xl animate-fade-in mb-6">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="text-sm font-medium">{{ session('success') }}</span>
                </div>
            @endif
        </div>

        <div class="bg-[#1e293b]/50 border border-white/5 rounded-[2rem] overflow-hidden shadow-2xl backdrop-blur-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-white/5 text-gray-400 text-[10px] uppercase tracking-[0.2em] font-bold">
                            <th class="px-6 py-5">Identitas Mahasiswa</th>
                            <th class="px-6 py-5">Status Akun</th>
                            <th class="px-6 py-5 text-center">Otorisasi</th>
                        </tr>
                    </thead>
                    <tbody id="user-table-body" class="divide-y divide-white/5 text-sm">
                        <tr id="loading-row">
                            <td colspan="3" class="px-6 py-20 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <div
                                        class="w-8 h-8 border-4 border-blue-500/20 border-t-blue-500 rounded-full animate-spin">
                                    </div>
                                    <span class="text-gray-500 font-medium tracking-widest text-xs">MENGHUBUNGKAN KE
                                        SERVER...</span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div id="empty-state" class="hidden py-20 text-center">
                <svg class="w-16 h-16 text-gray-700 mx-auto mb-4" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                    </path>
                </svg>
                <p class="text-gray-500 font-medium italic">Belum ada mahasiswa yang mendaftar.</p>
            </div>
        </div>
    </div>

    <script>
        let lastDataHash = "";

        function fetchUsers() {
            // Pastikan URL route ini sesuai dengan route JSON di web.php Anda
            fetch("{{ route('admin.users.json') }}")
                .then(response => response.json())
                .then(users => {
                    const tbody = document.getElementById('user-table-body');
                    const emptyState = document.getElementById('empty-state');
                    const totalCount = document.getElementById('total-user-count');

                    // Update total count
                    totalCount.innerText = users.length;

                    if (users.length === 0) {
                        tbody.innerHTML = '';
                        emptyState.classList.remove('hidden');
                        return;
                    }

                    emptyState.classList.add('hidden');

                    // Bangun HTML untuk baris tabel
                    let html = '';
                    users.forEach(user => {
                        const firstLetter = user.name ? user.name.charAt(0).toUpperCase() : '?';

                        const statusBadge = user.verified ?
                            `<span class="inline-flex items-center px-3 py-1 rounded-full bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 text-[10px] font-black tracking-tighter">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-2 shadow-[0_0_8px_rgba(16,185,129,0.5)]"></span>
                                VERIFIED
                               </span>` :
                            `<span class="inline-flex items-center px-3 py-1 rounded-full bg-orange-500/10 text-orange-400 border border-orange-500/20 text-[10px] font-black tracking-tighter">
                                <span class="w-1.5 h-1.5 rounded-full bg-orange-500 animate-pulse mr-2 shadow-[0_0_8px_rgba(245,158,11,0.5)]"></span>
                                PENDING
                               </span>`;

                        const actionButton = !user.verified ?
                            `<form method="POST" action="/admin/users/approve/${user.id}">
                                @csrf
                                <button type="submit" class="group flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-500 text-white text-[11px] font-bold rounded-xl transition-all shadow-lg shadow-blue-600/20 active:scale-95">
                                    <svg class="w-3 h-3 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    Approve
                                </button>
                               </form>` :
                            `<div class="flex items-center text-gray-600 gap-1.5">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                <span class="text-[10px] italic uppercase tracking-[0.2em] font-black">Done</span>
                               </div>`;

                        html += `
                            <tr class="hover:bg-white/[0.02] transition-colors group">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-slate-700 to-slate-800 flex items-center justify-center font-black text-white border border-white/10 shadow-inner">
                                            ${firstLetter}
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="text-white font-bold tracking-tight">${user.name}</span>
                                            <span class="text-[11px] text-gray-500 font-mono tracking-tighter">${user.email}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">${statusBadge}</td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-center italic">
                                        ${actionButton}
                                    </div>
                                </td>
                            </tr>
                        `;
                    });

                    // Hanya update DOM jika konten HTML berubah (untuk efisiensi)
                    const currentHash = btoa(unescape(encodeURIComponent(html)));
                    if (lastDataHash !== currentHash) {
                        tbody.innerHTML = html;
                        lastDataHash = currentHash;
                    }
                })
                .catch(error => console.error('Error fetching users:', error));
        }

        // Jalankan fetch pertama kali
        fetchUsers();

        // Cek data baru setiap 4 detik
        setInterval(fetchUsers, 4000);
    </script>
</x-app-layout>
