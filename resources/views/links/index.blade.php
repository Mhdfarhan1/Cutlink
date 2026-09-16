<x-layouts.app>
    <x-slot:title>Semua Link</x-slot:title>

    <!-- Header Page -->
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Manajemen Short Link</h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">
                Kelola, ubah, salin, pantau klik, dan unduh QR Code tautan kegiatan resmi PIK-R REQUEST.
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

    <!-- FILTER & SEARCH BAR -->
    <div class="p-4 sm:p-5 rounded-2xl bg-white border border-slate-200 shadow-xs mb-6" x-data="{ copiedUrl: null }">
        <form method="GET" action="{{ route('links.index') }}" class="flex flex-col sm:flex-row gap-3 items-center justify-between">
            
            <!-- Input Search -->
            <div class="relative w-full sm:w-72">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari nama, alias, atau tujuan..."
                    class="w-full pl-10 pr-4 py-2 rounded-xl bg-slate-50 border border-slate-200 text-xs sm:text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 transition"
                />
            </div>

            <!-- Group Filter & Entri -->
            <div class="flex flex-wrap items-center gap-2.5 w-full sm:w-auto justify-start sm:justify-end">
                <!-- Pilihan Jumlah Entri -->
                <div class="flex items-center gap-1.5 text-xs text-slate-600">
                    <span class="font-medium whitespace-nowrap">Tampilkan:</span>
                    <select
                        name="per_page"
                        onchange="this.form.submit()"
                        class="px-2.5 py-1.5 rounded-xl bg-slate-50 border border-slate-200 text-xs font-bold text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 transition cursor-pointer"
                    >
                        <option value="10" {{ ($perPage ?? 10) == 10 ? 'selected' : '' }}>10 entri</option>
                        <option value="25" {{ ($perPage ?? 10) == 25 ? 'selected' : '' }}>25 entri</option>
                        <option value="50" {{ ($perPage ?? 10) == 50 ? 'selected' : '' }}>50 entri</option>
                        <option value="100" {{ ($perPage ?? 10) == 100 ? 'selected' : '' }}>100 entri</option>
                    </select>
                </div>

                <select
                    name="status"
                    onchange="this.form.submit()"
                    class="px-3 py-1.5 rounded-xl bg-slate-50 border border-slate-200 text-xs font-semibold text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 transition cursor-pointer"
                >
                    <option value="" {{ request('status') === null || request('status') === '' ? 'selected' : '' }}>Semua Status</option>
                    <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Hanya Aktif</option>
                    <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Hanya Nonaktif</option>
                </select>

                <button
                    type="submit"
                    class="px-3.5 py-1.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition cursor-pointer"
                >
                    Filter
                </button>

                @if (request()->hasAny(['search', 'status']))
                    <a
                        href="{{ route('links.index') }}"
                        class="px-3 py-1.5 rounded-xl text-xs font-medium text-rose-600 hover:bg-rose-50 transition"
                    >
                        Reset
                    </a>
                @endif
            </div>

        </form>
    </div>

    <!-- TABEL SEMUA LINK (DESKTOP) & LIST CARDS (MOBILE) -->
    <div class="rounded-2xl bg-white border border-slate-200 shadow-xs overflow-hidden" x-data="{ copiedCode: null }">
        
        @if ($links->isEmpty())
            <div class="py-16 text-center text-slate-400">
                <svg class="w-14 h-14 mx-auto text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                </svg>
                <h3 class="text-base font-bold text-slate-700">Tidak ada tautan ditemukan</h3>
                <p class="text-xs text-slate-400 mt-1 max-w-sm mx-auto">
                    {{ request()->filled('search') ? 'Tidak ada hasil yang sesuai dengan kata kunci pencarian Anda.' : 'Belum ada short link kegiatan yang dibuat. Klik tombol di bawah untuk membuat tautan baru.' }}
                </p>
                <div class="mt-4">
                    <a
                        href="{{ route('links.create') }}"
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-bold text-white bg-blue-600 hover:bg-blue-700 transition"
                    >
                        + Buat Link Sekarang
                    </a>
                </div>
            </div>
        @else
            <!-- Desktop Table View (Hidden on mobile) -->
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-slate-50 border-b border-slate-200 text-slate-500 font-bold uppercase tracking-wider">
                        <tr>
                            <th class="px-6 py-3.5">Nama Tautan</th>
                            <th class="px-6 py-3.5">Short URL</th>
                            <th class="px-6 py-3.5">URL Tujuan</th>
                            <th class="px-6 py-3.5 text-center">Klik</th>
                            <th class="px-6 py-3.5 text-center">Status</th>
                            <th class="px-6 py-3.5 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach ($links as $link)
                            <tr class="hover:bg-slate-50/70 transition">
                                <!-- Nama Tautan -->
                                <td class="px-6 py-4">
                                    <div class="font-bold text-slate-900">{{ $link->name }}</div>
                                    <div class="text-[11px] text-slate-400 mt-0.5 flex items-center gap-2">
                                        <span>Dibuat: {{ $link->created_at->format('d M Y') }}</span>
                                        @if ($link->bridge_enabled)
                                            <span class="px-1.5 py-0.2 rounded bg-blue-100 text-blue-700 font-medium text-[10px]">Bridge ON</span>
                                        @endif
                                    </div>
                                </td>

                                <!-- Short URL -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ $link->short_url }}" target="_blank" class="font-mono font-semibold text-blue-600 hover:underline">
                                            {{ $link->short_url }}
                                        </a>
                                        <button
                                            @click="navigator.clipboard.writeText('{{ $link->short_url }}'); copiedCode = '{{ $link->code }}'; setTimeout(() => copiedCode = null, 2000)"
                                            class="p-1 rounded-md text-slate-400 hover:text-blue-600 hover:bg-blue-50 transition cursor-pointer"
                                            title="Salin Tautan"
                                        >
                                            <svg x-show="copiedCode !== '{{ $link->code }}'" class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                            </svg>
                                            <svg x-show="copiedCode === '{{ $link->code }}'" x-cloak class="w-3.5 h-3.5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                            </svg>
                                        </button>
                                    </div>
                                </td>

                                <!-- URL Tujuan -->
                                <td class="px-6 py-4 max-w-xs truncate text-slate-500">
                                    <a href="{{ $link->destination_url }}" target="_blank" class="hover:text-blue-600 hover:underline truncate block" title="{{ $link->destination_url }}">
                                        {{ $link->destination_url }}
                                    </a>
                                </td>

                                <!-- Total Klik -->
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-black bg-blue-50 text-blue-700">
                                        {{ number_format($link->clicks_count) }}
                                    </span>
                                </td>

                                <!-- Status Toggle Button -->
                                <td class="px-6 py-4 text-center">
                                    <form method="POST" action="{{ route('links.toggle', $link) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button
                                            type="submit"
                                            class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold transition cursor-pointer {{ $link->is_active ? 'bg-emerald-50 text-emerald-700 hover:bg-emerald-100' : 'bg-amber-50 text-amber-700 hover:bg-amber-100' }}"
                                            title="Klik untuk mengubah status"
                                        >
                                            <span class="w-1.5 h-1.5 rounded-full {{ $link->is_active ? 'bg-emerald-500' : 'bg-amber-500' }}"></span>
                                            <span>{{ $link->is_active ? 'Aktif' : 'Nonaktif' }}</span>
                                        </button>
                                    </form>
                                </td>

                                <!-- Aksi -->
                                <td class="px-6 py-4 text-right whitespace-nowrap">
                                    <div class="flex items-center justify-end gap-1.5">
                                        <!-- Lihat / Download QR Code -->
                                        <a
                                            href="{{ route('links.qr', $link) }}"
                                            class="p-1.5 rounded-lg text-slate-500 hover:text-blue-600 hover:bg-blue-50 transition"
                                            title="Kelola QR Code"
                                        >
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                                            </svg>
                                        </a>

                                        <!-- Edit -->
                                        <a
                                            href="{{ route('links.edit', $link) }}"
                                            class="p-1.5 rounded-lg text-slate-500 hover:text-blue-600 hover:bg-blue-50 transition"
                                            title="Ubah Tautan"
                                        >
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>

                                        <!-- Hapus -->
                                        <form method="POST" action="{{ route('links.destroy', $link) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus short link ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                type="submit"
                                                class="p-1.5 rounded-lg text-slate-400 hover:text-rose-600 hover:bg-rose-50 transition cursor-pointer"
                                                title="Hapus Tautan"
                                            >
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Mobile Card View (Shown on screens < md) -->
            <div class="md:hidden divide-y divide-slate-100 p-4 space-y-4">
                @foreach ($links as $link)
                    <div class="pt-4 first:pt-0">
                        <div class="flex items-start justify-between gap-2">
                            <div>
                                <h4 class="text-sm font-bold text-slate-900">{{ $link->name }}</h4>
                                <div class="mt-1 flex items-center gap-2">
                                    <a href="{{ $link->short_url }}" target="_blank" class="font-mono text-xs font-semibold text-blue-600 hover:underline">
                                        {{ $link->short_url }}
                                    </a>
                                    <button
                                        @click="navigator.clipboard.writeText('{{ $link->short_url }}'); copiedCode = '{{ $link->code }}'; setTimeout(() => copiedCode = null, 2000)"
                                        class="text-slate-400 hover:text-blue-600 text-xs font-medium"
                                    >
                                        <span x-show="copiedCode !== '{{ $link->code }}'">📋</span>
                                        <span x-show="copiedCode === '{{ $link->code }}'" x-cloak class="text-emerald-600 font-bold">✓</span>
                                    </button>
                                </div>
                            </div>

                            <!-- Toggle Status Badge -->
                            <form method="POST" action="{{ route('links.toggle', $link) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="px-2 py-0.5 rounded-full text-[10px] font-bold {{ $link->is_active ? 'bg-emerald-50 text-emerald-700' : 'bg-amber-50 text-amber-700' }}">
                                    {{ $link->is_active ? 'Aktif' : 'Nonaktif' }}
                                </button>
                            </form>
                        </div>

                        <div class="text-[11px] text-slate-400 truncate mt-1">
                            Tujuan: {{ $link->destination_url }}
                        </div>

                        <div class="mt-3 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                            <span class="font-bold text-slate-700">{{ number_format($link->clicks_count) }} Klik</span>
                            <div class="flex items-center gap-3">
                                <a href="{{ route('links.qr', $link) }}" class="text-blue-600 font-semibold">QR Code</a>
                                <a href="{{ route('links.edit', $link) }}" class="text-slate-600 font-semibold">Edit</a>
                                <form method="POST" action="{{ route('links.destroy', $link) }}" onsubmit="return confirm('Hapus tautan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-rose-600 font-semibold">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination Numerik (1, 2, 3, Kembali, Lanjut, Info) -->
            <div class="p-4 sm:p-5 border-t border-slate-200 bg-slate-50/70">
                {{ $links->links('components.pagination') }}
            </div>

        @endif

    </div>
</x-layouts.app>
