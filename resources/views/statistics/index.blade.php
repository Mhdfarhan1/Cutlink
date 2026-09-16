<x-layouts.app>
    <x-slot:title>Statistik & Analitik</x-slot:title>

    <!-- Header Page -->
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Statistik &amp; Analitik Klik</h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">
                Laporan real-time kunjungan tautan kegiatan resmi PIK-R REQUEST.
            </p>
        </div>

        <!-- Filter Dropdown Tautan Tertentu -->
        <form method="GET" action="{{ route('statistics.index') }}" class="flex items-center gap-2">
            @if(request('search'))
                <input type="hidden" name="search" value="{{ request('search') }}">
            @endif
            @if(request('per_page'))
                <input type="hidden" name="per_page" value="{{ request('per_page') }}">
            @endif

            <select
                name="link_id"
                onchange="this.form.submit()"
                class="px-3.5 py-2 rounded-xl bg-white border border-slate-300 text-xs font-semibold text-slate-800 shadow-xs focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 transition cursor-pointer"
            >
                <option value="">Semua Tautan (Akumulasi)</option>
                @foreach ($allLinks as $l)
                    <option value="{{ $l->id }}" {{ request('link_id') == $l->id ? 'selected' : '' }}>
                        {{ $l->name }} (/{{ $l->code }})
                    </option>
                @endforeach
            </select>
            @if (request('link_id'))
                <a href="{{ route('statistics.index', array_filter(['search' => request('search'), 'per_page' => request('per_page')])) }}" class="text-xs text-rose-600 hover:underline px-2">Reset</a>
            @endif
        </form>
    </div>

    <!-- 4 KARTU METRIK STATISTIK -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-8">
        
        <!-- Total Klik -->
        <div class="p-5 rounded-2xl bg-white border border-slate-200 shadow-xs">
            <span class="text-xs font-bold uppercase tracking-wider text-slate-400 block mb-1">Total Klik</span>
            <div class="text-3xl font-black text-blue-600">{{ number_format($totalClicks) }}</div>
            <p class="text-[11px] text-slate-400 mt-1">Akumulasi keseluruhan kunjungan</p>
        </div>

        <!-- Hari Ini -->
        <div class="p-5 rounded-2xl bg-white border border-slate-200 shadow-xs">
            <span class="text-xs font-bold uppercase tracking-wider text-slate-400 block mb-1">Hari Ini</span>
            <div class="text-3xl font-black text-slate-900">{{ number_format($clicksToday) }}</div>
            <p class="text-[11px] text-slate-400 mt-1">Kunjungan sejak 00:00 WIB</p>
        </div>

        <!-- 7 Hari Terakhir -->
        <div class="p-5 rounded-2xl bg-white border border-slate-200 shadow-xs">
            <span class="text-xs font-bold uppercase tracking-wider text-slate-400 block mb-1">7 Hari Terakhir</span>
            <div class="text-3xl font-black text-slate-900">{{ number_format($clicks7Days) }}</div>
            <p class="text-[11px] text-slate-400 mt-1">Tren sepekan terakhir</p>
        </div>

        <!-- 30 Hari Terakhir -->
        <div class="p-5 rounded-2xl bg-white border border-slate-200 shadow-xs">
            <span class="text-xs font-bold uppercase tracking-wider text-slate-400 block mb-1">30 Hari Terakhir</span>
            <div class="text-3xl font-black text-slate-900">{{ number_format($clicks30Days) }}</div>
            <p class="text-[11px] text-slate-400 mt-1">Performa bulanan</p>
        </div>

    </div>

    <!-- GRAFIK 14 HARI TERAKHIR -->
    <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-xs mb-8">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-6">
            <div>
                <h3 class="text-base font-bold text-slate-900">Grafik Kunjungan Harian (14 Hari)</h3>
                <p class="text-xs text-slate-500">
                    {{ $selectedLink ? "Menampilkan data untuk: {$selectedLink->name}" : "Menampilkan data akumulasi seluruh short link" }}
                </p>
            </div>
            <span class="px-3 py-1 rounded-full bg-blue-50 text-blue-700 text-xs font-semibold">14 Hari</span>
        </div>

        <div class="grid grid-cols-7 sm:grid-cols-14 gap-2 items-end h-44 sm:h-52">
            @foreach ($dailyStats as $stat)
                @php
                    $percent = ($stat['count'] / $maxClick) * 100;
                    $percent = max($percent, 4);
                @endphp
                <div class="flex flex-col items-center justify-end h-full group">
                    <span class="text-[10px] font-bold text-slate-700 mb-1 group-hover:text-blue-600 transition">
                        {{ $stat['count'] }}
                    </span>
                    <div class="w-full max-w-[32px] bg-slate-100 rounded-t-md overflow-hidden flex items-end h-full">
                        <div
                            style="height: {{ $percent }}%;"
                            class="w-full bg-gradient-to-t from-blue-700 to-sky-400 rounded-t-md group-hover:from-blue-600 group-hover:to-sky-300 transition-all duration-300"
                        ></div>
                    </div>
                    <span class="text-[9px] text-slate-400 font-medium mt-1 truncate max-w-[40px] text-center">
                        {{ $stat['label'] }}
                    </span>
                </div>
            @endforeach
        </div>
    </div>

    <!-- RIWAYAT KLIK DENGAN SEARCH, ENTRIES, & PAGINATION -->
    <div class="rounded-2xl bg-white border border-slate-200 shadow-xs overflow-hidden">
        
        <!-- Header Tabel & Toolbar Filter (Search & Entries) -->
        <div class="p-5 border-b border-slate-100 flex flex-col lg:flex-row items-start lg:items-center justify-between gap-4">
            <div>
                <h3 class="text-base font-bold text-slate-900">Riwayat Kunjungan Pengunjung</h3>
                <p class="text-xs text-slate-500">Log transaksi klik yang tercatat pada sistem.</p>
            </div>

            <!-- Form Pencarian & Entri Data -->
            <form method="GET" action="{{ route('statistics.index') }}" class="w-full lg:w-auto flex flex-col sm:flex-row items-center gap-3">
                @if(request('link_id'))
                    <input type="hidden" name="link_id" value="{{ request('link_id') }}">
                @endif

                <!-- Pilihan Entries (10, 25, 50, 100) -->
                <div class="flex items-center gap-2 text-xs text-slate-600 w-full sm:w-auto">
                    <span class="whitespace-nowrap font-medium">Tampilkan:</span>
                    <select
                        name="per_page"
                        onchange="this.form.submit()"
                        class="px-2.5 py-1.5 rounded-lg border border-slate-200 bg-slate-50 text-xs font-bold text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 transition cursor-pointer"
                    >
                        <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10 entri</option>
                        <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25 entri</option>
                        <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50 entri</option>
                        <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100 entri</option>
                    </select>
                </div>

                <!-- Input Pencarian -->
                <div class="relative w-full sm:w-64">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari tautan, IP, peramban..."
                        class="w-full pl-9 pr-8 py-1.5 rounded-lg border border-slate-200 bg-slate-50 text-xs text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 transition"
                    />
                    @if(request('search'))
                        <a
                            href="{{ route('statistics.index', array_filter(['link_id' => request('link_id'), 'per_page' => request('per_page')])) }}"
                            class="absolute inset-y-0 right-0 pr-2.5 flex items-center text-slate-400 hover:text-slate-600"
                            title="Hapus pencarian"
                        >
                            &times;
                        </a>
                    @endif
                </div>

                <button
                    type="submit"
                    class="w-full sm:w-auto px-3 py-1.5 rounded-lg bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold transition cursor-pointer"
                >
                    Cari
                </button>
            </form>
        </div>

        @if ($recentClicks->isEmpty())
            <div class="py-16 text-center text-slate-400">
                <svg class="w-12 h-12 mx-auto text-slate-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
                <p class="text-sm font-semibold text-slate-600">Tidak ada riwayat klik yang cocok</p>
                <p class="text-xs text-slate-400 mt-0.5">Coba gunakan kata kunci pencarian yang lain atau reset filter.</p>
            </div>
        @else
            <!-- Tabel Riwayat Data -->
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-slate-50 border-b border-slate-200 text-slate-500 font-bold uppercase tracking-wider">
                        <tr>
                            <th class="px-5 py-3">Waktu Kunjungan</th>
                            <th class="px-5 py-3">Tautan Singkat</th>
                            <th class="px-5 py-3">Alamat IP</th>
                            <th class="px-5 py-3">Perangkat / User Agent</th>
                            <th class="px-5 py-3">Sumber Rujukan (Referer)</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach ($recentClicks as $click)
                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="px-5 py-3.5 whitespace-nowrap text-slate-600">
                                    <div class="font-bold text-slate-800">{{ $click->created_at->locale('id')->isoFormat('D MMMM Y') }}</div>
                                    <div class="text-[11px] text-slate-400 font-mono">{{ $click->created_at->format('H:i:s') }} WIB</div>
                                </td>
                                <td class="px-5 py-3.5 whitespace-nowrap font-medium text-slate-900">
                                    @if ($click->shortLink)
                                        <a href="{{ route('links.edit', $click->shortLink) }}" class="text-blue-600 hover:underline font-bold">
                                            {{ $click->shortLink->name }}
                                        </a>
                                        <span class="text-slate-400 text-[11px] block font-mono">/{{ $click->shortLink->code }}</span>
                                    @else
                                        <span class="text-slate-400 italic">Tautan telah dihapus</span>
                                    @endif
                                </td>
                                <td class="px-5 py-3.5 whitespace-nowrap font-mono text-slate-600">
                                    <span class="px-2 py-0.5 rounded-md bg-slate-100 text-slate-700 text-[11px]">
                                        {{ $click->ip_address ?? '127.0.0.1' }}
                                    </span>
                                </td>
                                <td class="px-5 py-3.5 max-w-xs truncate text-slate-600" title="{{ $click->user_agent }}">
                                    {{ $click->user_agent ? Str::limit($click->user_agent, 45) : '—' }}
                                </td>
                                <td class="px-5 py-3.5 max-w-xs truncate text-slate-500">
                                    @if($click->referer)
                                        <a href="{{ $click->referer }}" target="_blank" class="hover:underline text-blue-600 truncate block">
                                            {{ Str::limit($click->referer, 35) }}
                                        </a>
                                    @else
                                        <span class="text-slate-400 italic">Langsung (Direct)</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- FOOTER PAGINASI NUMERIK (1, 2, 3, KEMBALI, LANJUT, ENTRIES) -->
            <div class="p-4 sm:p-5 border-t border-slate-200 bg-slate-50/70">
                {{ $recentClicks->links('components.pagination') }}
            </div>
        @endif

    </div>
</x-layouts.app>
