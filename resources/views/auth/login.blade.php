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

    <x-guest-layout>
        <div
            class="min-h-screen flex flex-col items-center justify-center bg-[#0f172a] px-4 py-8 relative overflow-hidden">

            <div class="fixed inset-0"
                style="background: radial-gradient(circle at 50% 50%, rgba(59, 130, 246, 0.1), transparent 70%);"></div>

            <div class="w-full max-w-md relative z-10">
                <div class="text-center mb-8">
                    <a href="/" class="inline-block group">
                        <div
                            class="w-16 h-16 bg-blue-600 rounded-2xl flex items-center justify-center shadow-lg shadow-blue-500/20 group-hover:scale-110 transition-transform duration-300 mx-auto">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                </path>
                            </svg>
                        </div>
                    </a>
                    <h2 class="mt-6 text-3xl font-extrabold text-white tracking-tight">Selamat Datang</h2>
                    <p class="mt-2 text-sm text-gray-400">Silakan login untuk memberikan suara Anda</p>
                </div>

                <div class="bg-[#1e293b] border border-white/10 p-8 rounded-3xl shadow-2xl">

                    @if (session('status'))
                        <div
                            class="mb-4 font-medium text-sm text-green-400 bg-green-500/10 p-3 rounded-xl border border-green-500/20">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-4 text-sm text-red-400 bg-red-500/10 p-3 rounded-xl border border-red-500/20">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Email
                                Mahasiswa</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                autofocus
                                class="w-full bg-[#0f172a] border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition duration-200"
                                placeholder="nama@mhs.ac.id">
                        </div>

                        <div class="mt-6">
                            <div class="flex justify-between mb-1">
                                <label for="password" class="text-sm font-medium text-gray-300">Password</label>
                                {{-- @if (Route::has('password.request'))
                                    <a class="text-xs text-blue-400 hover:text-blue-300 transition"
                                        href="{{ route('password.request') }}">
                                        Lupa Password?
                                    </a>
                                @endif --}}
                            </div>
                            <input id="password" type="password" name="password" required
                                autocomplete="current-password"
                                class="w-full bg-[#0f172a] border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition duration-200"
                                placeholder="••••••••">
                        </div>

                        <div class="block mt-4">
                            <label for="remember_me" class="inline-flex items-center group cursor-pointer">
                                <input id="remember_me" type="checkbox"
                                    class="rounded bg-[#0f172a] border-white/20 text-blue-600 shadow-sm focus:ring-blue-500/50 focus:ring-offset-0 transition"
                                    name="remember">
                                <span class="ml-2 text-sm text-gray-400 group-hover:text-gray-300 transition">Ingat
                                    saya</span>
                            </label>
                        </div>

                        <div class="mt-8">
                            <button type="submit"
                                class="w-full bg-white text-slate-900 font-bold py-3 px-4 rounded-xl hover:bg-blue-50 transform transition active:scale-[0.98] shadow-lg text-sm">
                                Masuk Ke Sistem
                            </button>
                        </div>
                    </form>
                </div>

                <p class="mt-8 text-center text-sm text-gray-500">
                    Belum punya akun?
                    <a href="{{ route('register') }}"
                        class="font-semibold text-blue-400 hover:text-blue-300 transition">Daftar sekarang</a>
                </p>
            </div>
        </div>
    </x-guest-layout>
</body>

</html>
