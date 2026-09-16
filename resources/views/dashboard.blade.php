<x-layouts.app>
    <x-slot:title>Dashboard</x-slot:title>

    <!-- Header Page -->
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Dashboard Ringkasan</h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">
                Selamat datang kembali, <span class="font-bold text-slate-800">{{ auth()->user()->name }}</span>! Pantau seluruh kinerja short link kegiatan PIK-R REQUEST.
            </p>
        </div>
        <div class="flex items-center gap-2">
            <a
                href="{{ route('links.create') }}"
                class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 shadow-md shadow-blue-500/20 transition cursor-pointer"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                </svg>
                <span>Buat Link Baru</span>
            </a>
        </div>
    </div>

    <!-- 4 KARTU STATISTIK RINGKASAN (PUTIH & BIRU) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-8">
        
        <!-- Total Link -->
        <div class="p-5 rounded-2xl bg-white border border-slate-200 shadow-xs hover:border-blue-300 transition">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Total Short Link</span>
                <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                    </svg>
                </div>
            </div>
            <div class="mt-4">
                <div class="text-3xl font-black text-slate-900">{{ number_format($totalLinks) }}</div>
                <div class="text-xs text-slate-500 mt-1">Tautan terdaftar di sistem</div>
            </div>
        </div>

        <!-- Total Klik -->
        <div class="p-5 rounded-2xl bg-white border border-slate-200 shadow-xs hover:border-sky-300 transition">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Total Klik Akumulasi</span>
                <div class="w-10 h-10 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"/>
                    </svg>
                </div>
            </div>
            <div class="mt-4">
                <div class="text-3xl font-black text-slate-900">{{ number_format($totalClicks) }}</div>
                <div class="text-xs text-slate-500 mt-1">Interaksi pengunjung terverifikasi</div>
            </div>
        </div>

        <!-- Link Aktif -->
        <div class="p-5 rounded-2xl bg-white border border-slate-200 shadow-xs hover:border-emerald-300 transition">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Tautan Aktif</span>
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <div class="mt-4">
                <div class="text-3xl font-black text-emerald-600">{{ number_format($activeLinks) }}</div>
                <div class="text-xs text-slate-500 mt-1">Dapat diakses publik secara instan</div>
            </div>
        </div>

        <!-- Link Nonaktif -->
        <div class="p-5 rounded-2xl bg-white border border-slate-200 shadow-xs hover:border-amber-300 transition">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Tautan Nonaktif</span>
                <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                    </svg>
                </div>
            </div>
            <div class="mt-4">
                <div class="text-3xl font-black text-amber-600">{{ number_format($inactiveLinks) }}</div>
                <div class="text-xs text-slate-500 mt-1">Ditangguhkan / kedaluwarsa</div>
            </div>
        </div>

    </div>

    <!-- GRAFIK KLIK 7 HARI TERAKHIR (BATANG BERSIH) -->
    <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-xs mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between pb-6 border-b border-slate-100 gap-2">
            <div>
                <h3 class="text-base font-bold text-slate-900">Grafik Aktivitas Klik (7 Hari Terakhir)</h3>
                <p class="text-xs text-slate-500">Visualisasi kunjungan tautan harian.</p>
            </div>
            <span class="px-3 py-1 rounded-full bg-blue-50 text-blue-700 text-xs font-semibold">Real-Time Data</span>
        </div>

        <div class="pt-6">
            <div class="grid grid-cols-7 gap-2 sm:gap-4 items-end h-44 sm:h-52">
                @foreach ($dailyClicks as $day)
                    @php
                        $percentage = ($day['count'] / $maxClick) * 100;
                        $percentage = max($percentage, 5); // Minimal 5% agar selalu ada indikator bar
                    @endphp
                    <div class="flex flex-col items-center justify-end h-full group">
                        <span class="text-[11px] font-bold text-slate-700 mb-1 opacity-80 group-hover:text-blue-600 transition">
                            {{ $day['count'] }}
                        </span>
                        <div class="w-full max-w-[48px] bg-slate-100 rounded-t-lg overflow-hidden flex items-end h-full">
                            <div
                                style="height: {{ $percentage }}%;"
                                class="w-full bg-gradient-to-t from-blue-700 to-sky-400 rounded-t-lg group-hover:from-blue-600 group-hover:to-sky-300 transition-all duration-300"
                            ></div>
                        </div>
                        <span class="text-[10px] sm:text-xs text-slate-500 font-medium mt-2 whitespace-nowrap">
                            {{ $day['label'] }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- DUA KOLOM: TAUTAN TERBARU & TAUTAN TERPOPULER -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        
        <!-- KOLOM KIRI: TAUTAN TERBARU -->
        <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-xs">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-4">
                <div class="flex items-center gap-2">
                    <div class="w-2.5 h-2.5 rounded-full bg-blue-600"></div>
                    <h3 class="text-base font-bold text-slate-900">Tautan Terbaru</h3>
                </div>
                <a href="{{ route('links.index') }}" class="text-xs font-semibold text-blue-600 hover:text-blue-800">
                    Lihat Semua &rarr;
                </a>
            </div>

            @if ($recentLinks->isEmpty())
                <div class="py-12 text-center text-slate-400">
                    <svg class="w-12 h-12 mx-auto text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                    </svg>
                    <p class="text-sm">Belum ada short link yang dibuat.</p>
                    <a href="{{ route('links.create') }}" class="mt-3 inline-block text-xs font-bold text-blue-600 hover:underline">
                        + Buat link pertama sekarang
                    </a>
                </div>
            @else
                <div class="space-y-3.5" x-data="{ copiedCode: null }">
                    @foreach ($recentLinks as $link)
                        <div class="p-3.5 rounded-xl border border-slate-100 bg-slate-50/50 hover:bg-slate-50 hover:border-slate-200 transition">
                            <div class="flex items-start justify-between gap-3">
                                <div class="min-w-0">
                                    <div class="flex items-center gap-2">
                                        <h4 class="text-xs font-bold text-slate-900 truncate">{{ $link->name }}</h4>
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold {{ $link->is_active ? 'bg-emerald-50 text-emerald-700' : 'bg-amber-50 text-amber-700' }}">
                                            {{ $link->is_active ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </div>
                                    <div class="mt-1 flex items-center gap-2 text-xs">
                                        <a href="{{ $link->short_url }}" target="_blank" class="font-mono text-blue-600 hover:underline">
                                            {{ $link->short_url }}
                                        </a>
                                        <button
                                            @click="navigator.clipboard.writeText('{{ $link->short_url }}'); copiedCode = '{{ $link->code }}'; setTimeout(() => copiedCode = null, 2000)"
                                            class="text-slate-400 hover:text-blue-600 transition"
                                            title="Salin Tautan"
                                        >
                                            <span x-show="copiedCode !== '{{ $link->code }}'" class="text-[11px] font-medium">📋 Salin</span>
                                            <span x-show="copiedCode === '{{ $link->code }}'" x-cloak class="text-[11px] font-bold text-emerald-600">✓ Tersalin!</span>
                                        </button>
                                    </div>
                                    <div class="text-[11px] text-slate-400 truncate mt-1">
                                        Tujuan: {{ $link->destination_url }}
                                    </div>
                                </div>
                                <div class="text-right shrink-0">
                                    <div class="text-xs font-bold text-slate-800">{{ number_format($link->clicks_count) }} klik</div>
                                    <a href="{{ route('links.qr', $link) }}" class="text-[11px] text-blue-600 hover:underline mt-1 inline-block">
                                        Lihat QR
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- KOLOM KANAN: TAUTAN TERPOPULER -->
        <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-xs">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-4">
                <div class="flex items-center gap-2">
                    <div class="w-2.5 h-2.5 rounded-full bg-amber-500"></div>
                    <h3 class="text-base font-bold text-slate-900">Tautan Terpopuler</h3>
                </div>
                <span class="text-xs text-slate-500">Paling Banyak Diklik</span>
            </div>

            @if ($popularLinks->isEmpty())
                <div class="py-12 text-center text-slate-400">
                    <svg class="w-12 h-12 mx-auto text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    <p class="text-sm">Belum ada statistik klik yang tercatat.</p>
                </div>
            @else
                <div class="space-y-3.5">
                    @foreach ($popularLinks as $index => $link)
                        <div class="p-3.5 rounded-xl border border-slate-100 bg-slate-50/50 hover:bg-slate-50 hover:border-slate-200 transition">
                            <div class="flex items-center justify-between gap-3">
                                <div class="flex items-center gap-3 min-w-0">
                                    <div class="w-7 h-7 rounded-lg {{ $index === 0 ? 'bg-amber-100 text-amber-800 font-bold' : ($index === 1 ? 'bg-slate-200 text-slate-700' : ($index === 2 ? 'bg-orange-100 text-orange-800' : 'bg-slate-100 text-slate-500')) }} flex items-center justify-center text-xs shrink-0">
                                        #{{ $index + 1 }}
                                    </div>
                                    <div class="truncate">
                                        <h4 class="text-xs font-bold text-slate-900 truncate">{{ $link->name }}</h4>
                                        <div class="text-[11px] font-mono text-blue-600 mt-0.5">{{ $link->short_url }}</div>
                                    </div>
                                </div>
                                <div class="text-right shrink-0">
                                    <div class="text-sm font-black text-slate-900">{{ number_format($link->clicks_count) }}</div>
                                    <div class="text-[10px] text-slate-400">Total Klik</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>
</x-layouts.app>
