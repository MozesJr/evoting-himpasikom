<nav x-data="{ open: false }" class="glass-nav sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                        <div class="p-1.5 bg-blue-600 rounded-lg shadow-lg shadow-blue-500/20">
                            <x-application-logo class="block h-7 w-auto fill-current text-white" />
                        </div>
                        <span class="font-bold text-white tracking-wider hidden md:block">E-VOTING</span>
                    </a>
                </div>

                <div class="hidden space-x-4 sm:-my-px sm:ml-10 sm:flex">
                    @php
                        $isAdmin = Auth::user()->role === 'admin';

                        $navLinks = [
                            [
                                'name' => 'Dashboard',
                                'route' => $isAdmin ? 'admin.dashboard' : 'dashboard',
                                'show' => true,
                            ],
                            [
                                'name' => 'Voting',
                                'route' => 'voting.index',
                                'show' => true,
                            ],
                            [
                                'name' => 'Hasil Voting',
                                'route' => 'voting.hasil',
                                'show' => $isAdmin,
                            ],
                            // [
                            //     'name' => 'Realtime',
                            //     'route' => 'voting.realtime',
                            //     'show' => $isAdmin,
                            // ],
                            [
                                'name' => 'Kandidat',
                                'route' => 'candidates.index',
                                'show' => $isAdmin,
                            ],
                            [
                                'name' => 'Verifikasi User',
                                'route' => 'admin.users',
                                'show' => $isAdmin,
                            ],
                            [
                                'name' => 'Votes',
                                'route' => 'admin.votes',
                                'show' => $isAdmin,
                            ],
                            [
                                'name' => 'Settings',
                                'route' => 'admin.settings',
                                'show' => $isAdmin,
                            ],
                            // [
                            //     'name' => 'Ketua',
                            //     'route' => 'ketua.index',
                            //     'show' => $isAdmin,
                            // ],
                        ];
                    @endphp

                    @foreach ($navLinks as $link)
                        @if ($link['show'])
                            <x-nav-link :href="Route::has($link['route']) ? route($link['route']) : '#'" :active="request()->routeIs($link['route'])"
                                class="text-gray-400 hover:text-white transition-colors duration-200">
                                {{ $link['name'] }}
                            </x-nav-link>
                        @endif
                    @endforeach
                </div>

            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="flex items-center gap-2 px-3 py-2 rounded-xl bg-white/5 border border-white/5 hover:bg-white/10 transition duration-150">
                            <div class="text-sm font-medium text-gray-300">{{ Auth::user()->name }}</div>
                            <span
                                class="text-[10px] px-2 py-0.5 bg-blue-500/20 text-blue-400 rounded-md border border-blue-500/20 uppercase font-bold">
                                {{ Auth::user()->role }}
                            </span>
                            <svg class="h-4 w-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                                class="text-red-400 hover:bg-red-500/10">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="p-2 rounded-xl text-gray-400 hover:bg-white/5 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>
