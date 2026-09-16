<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Dashboard Manajemen REQUEST LINK - PIK-R REQUEST, SMA Negeri 1 Tasik Putri Puyu.">
    
    <title>{{ $title ?? 'Dashboard' }} — REQUEST LINK | PIK-R REQUEST</title>

    <!-- Favicon Logo Resmi -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo-pikr.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full font-sans antialiased text-slate-800 bg-slate-50 selection:bg-blue-600 selection:text-white" x-data="{ mobileSidebarOpen: false }">

    <!-- Mobile Sidebar Backdrop -->
    <div
        x-show="mobileSidebarOpen"
        x-cloak
        @click="mobileSidebarOpen = false"
        class="fixed inset-0 z-40 bg-slate-900/50 backdrop-blur-sm lg:hidden transition-opacity"
    ></div>

    <div class="min-h-screen flex">

        <!-- ==================== SIDEBAR (PUTIH & BIRU BERSIH) ==================== -->
        <aside
            :class="mobileSidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
            class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-slate-200 flex flex-col justify-between transition-transform duration-300 ease-in-out lg:static lg:translate-x-0 shrink-0"
        >
            <div>
                <!-- Sidebar Brand Header -->
                <div class="h-18 px-5 flex items-center justify-between border-b border-slate-100">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-blue-50 border border-blue-100 p-1 flex items-center justify-center shrink-0">
                            <img src="{{ asset('images/logo-pikr.png') }}" alt="Logo PIK-R REQUEST" class="w-full h-full object-contain">
                        </div>
                        <div>
                            <div class="text-base font-black text-slate-900 tracking-tight leading-tight">REQUEST LINK</div>
                            <div class="text-[10px] font-semibold text-blue-600 uppercase tracking-wider">PIK-R REQUEST</div>
                        </div>
                    </a>

                    <!-- Close Button on Mobile -->
                    <button @click="mobileSidebarOpen = false" class="lg:hidden text-slate-400 hover:text-slate-600 p-1.5 rounded-lg hover:bg-slate-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Navigation Links -->
                <nav class="p-4 space-y-1.5">
                    <div class="px-3 pb-2 text-[10px] font-bold uppercase tracking-wider text-slate-400">Menu Utama</div>

                    <!-- Dashboard -->
                    <a
                        href="{{ route('dashboard') }}"
                        class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-semibold transition {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-700 border border-blue-200/80 shadow-xs' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}"
                    >
                        <svg class="w-5 h-5 {{ request()->routeIs('dashboard') ? 'text-blue-600' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                        <span>Dashboard</span>
                    </a>

                    <!-- Buat Link -->
                    <a
                        href="{{ route('links.create') }}"
                        class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-semibold transition {{ request()->routeIs('links.create') ? 'bg-blue-50 text-blue-700 border border-blue-200/80 shadow-xs' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}"
                    >
                        <svg class="w-5 h-5 {{ request()->routeIs('links.create') ? 'text-blue-600' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        <span>Buat Link Baru</span>
                    </a>

                    <!-- Semua Link -->
                    <a
                        href="{{ route('links.index') }}"
                        class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-semibold transition {{ request()->routeIs('links.index') || request()->routeIs('links.edit') ? 'bg-blue-50 text-blue-700 border border-blue-200/80 shadow-xs' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}"
                    >
                        <svg class="w-5 h-5 {{ request()->routeIs('links.index') || request()->routeIs('links.edit') ? 'text-blue-600' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                        </svg>
                        <span>Semua Link</span>
                    </a>

                    <!-- Statistik -->
                    <a
                        href="{{ route('statistics.index') }}"
                        class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-semibold transition {{ request()->routeIs('statistics.index') ? 'bg-blue-50 text-blue-700 border border-blue-200/80 shadow-xs' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}"
                    >
                        <svg class="w-5 h-5 {{ request()->routeIs('statistics.index') ? 'text-blue-600' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        <span>Statistik Klik</span>
                    </a>

                    <!-- QR Code Manager -->
                    <a
                        href="{{ route('links.index') }}#qr-section"
                        class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-semibold transition text-slate-600 hover:bg-slate-100 hover:text-slate-900"
                    >
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                        </svg>
                        <span>Kelola QR Code</span>
                    </a>

                    <!-- Profil Saya -->
                    <a
                        href="{{ route('profile.edit') }}"
                        class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-semibold transition {{ request()->routeIs('profile.edit') ? 'bg-blue-50 text-blue-700 border border-blue-200/80 shadow-xs' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}"
                    >
                        <svg class="w-5 h-5 {{ request()->routeIs('profile.edit') ? 'text-blue-600' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span>Profil Saya</span>
                    </a>
                </nav>
            </div>

            <!-- Bottom User Card & Logout -->
            <div class="p-4 border-t border-slate-100">
                <div class="p-3 rounded-xl bg-slate-50 border border-slate-200/80 mb-3 flex items-center justify-between">
                    <div class="truncate">
                        <div class="text-xs font-bold text-slate-900 truncate">{{ auth()->user()->name }}</div>
                        <div class="text-[11px] text-slate-500 truncate">{{ auth()->user()->email }}</div>
                    </div>
                    <span class="px-2 py-0.5 rounded-full bg-blue-100 text-blue-700 text-[10px] font-semibold">Admin</span>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 px-3 py-2 rounded-xl text-xs font-semibold text-rose-600 hover:bg-rose-50 border border-rose-100 transition cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        <span>Keluar Akun</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- ==================== MAIN WRAPPER ==================== -->
        <div class="flex-1 flex flex-col min-w-0">
            
            <!-- TOPBAR (PUTIH BERSIH) -->
            <header class="h-18 bg-white border-b border-slate-200/80 sticky top-0 z-30 flex items-center justify-between px-4 sm:px-6 lg:px-8">
                <!-- Hamburger for mobile -->
                <div class="flex items-center gap-3">
                    <button @click="mobileSidebarOpen = true" class="lg:hidden text-slate-600 hover:text-slate-900 p-2 rounded-lg hover:bg-slate-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>

                    <div class="hidden sm:flex items-center gap-2 text-xs text-slate-500 font-medium">
                        <span>Platform Pemendek Tautan Resmi</span>
                        <span>•</span>
                        <span class="text-blue-600 font-mono font-semibold">link.pikrrequestman1tpp.my.id</span>
                    </div>
                </div>

                <!-- User Profile Dropdown di Topbar (Pengganti tombol Buat Link sesuai permintaan) -->
                <div class="relative" x-data="{ profileDropdownOpen: false }">
                    <button
                        @click="profileDropdownOpen = !profileDropdownOpen"
                        class="flex items-center gap-2.5 p-1.5 sm:px-3 sm:py-1.5 rounded-xl border border-slate-200 hover:border-blue-300 hover:bg-slate-50 transition cursor-pointer"
                    >
                        <div class="w-8 h-8 rounded-lg bg-blue-600 text-white font-bold text-xs flex items-center justify-center shadow-xs">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <div class="text-left hidden sm:block">
                            <div class="text-xs font-bold text-slate-800 leading-tight">{{ auth()->user()->name }}</div>
                            <div class="text-[10px] text-blue-600 font-semibold font-mono leading-none mt-0.5">@<span>{{ auth()->user()->username }}</span></div>
                        </div>
                        <svg class="w-4 h-4 text-slate-400 hidden sm:block transition-transform duration-200" :class="profileDropdownOpen ? 'rotate-180 text-blue-600' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <div
                        x-show="profileDropdownOpen"
                        x-cloak
                        @click.outside="profileDropdownOpen = false"
                        x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
                        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                        x-transition:leave-end="opacity-0 scale-95 -translate-y-1"
                        class="absolute right-0 mt-2 w-60 rounded-2xl bg-white border border-slate-200 shadow-xl py-2 z-50 divide-y divide-slate-100"
                    >
                        <!-- Info Ringkas -->
                        <div class="px-4 py-3">
                            <p class="text-xs font-bold text-slate-900 truncate">{{ auth()->user()->name }}</p>
                            <p class="text-[11px] text-slate-500 font-mono truncate">{{ auth()->user()->email }}</p>
                            <span class="inline-block mt-1.5 px-2 py-0.5 rounded-full bg-blue-50 text-blue-700 text-[10px] font-bold">
                                Administrator Resmi
                            </span>
                        </div>

                        <!-- Menu Links -->
                        <div class="py-1.5">
                            <a
                                href="{{ route('profile.edit') }}"
                                class="flex items-center gap-2.5 px-4 py-2 text-xs font-semibold text-slate-700 hover:bg-blue-50 hover:text-blue-700 transition"
                            >
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <span>Profil &amp; Keamanan Akun</span>
                            </a>

                            <a
                                href="{{ route('links.create') }}"
                                class="flex items-center gap-2.5 px-4 py-2 text-xs font-semibold text-slate-700 hover:bg-blue-50 hover:text-blue-700 transition"
                            >
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                <span>Buat Link Baru</span>
                            </a>
                        </div>

                        <!-- Logout Button -->
                        <div class="py-1.5">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button
                                    type="submit"
                                    class="w-full flex items-center gap-2.5 px-4 py-2 text-xs font-semibold text-rose-600 hover:bg-rose-50 transition text-left cursor-pointer"
                                >
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    <span>Keluar Akun</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- FLASH STATUS NOTIFICATION -->
            @if (session('status'))
                <div class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 pt-4">
                    <div class="p-3.5 rounded-xl bg-blue-50 border border-blue-200 text-blue-900 text-xs font-medium flex items-center justify-between shadow-xs">
                        <div class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-blue-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{{ session('status') }}</span>
                        </div>
                    </div>
                </div>
            @endif

            <!-- MAIN VIEW CONTENT -->
            <main class="flex-1 max-w-7xl w-full mx-auto p-4 sm:p-6 lg:p-8">
                {{ $slot }}
            </main>

            <!-- FOOTER -->
            <footer class="bg-white border-t border-slate-200/80 py-4 px-4 sm:px-6 lg:px-8 text-center text-xs text-slate-500">
                <span class="font-semibold text-slate-700">REQUEST LINK</span> &bull; PIK-R REQUEST SMA Negeri 1 Tasik Putri Puyu &bull; &copy; {{ date('Y') }}
            </footer>

        </div>

    </div>

</body>
</html>
