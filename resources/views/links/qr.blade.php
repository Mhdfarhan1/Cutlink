<x-layouts.app>
    <x-slot:title>QR Code — {{ $shortLink->name }}</x-slot:title>

    <!-- Header Page -->
    <div class="mb-8">
        <div class="flex items-center gap-2 text-xs font-semibold text-blue-600 mb-1">
            <a href="{{ route('links.index') }}" class="hover:underline">Semua Link</a>
            <span>/</span>
            <span class="text-slate-400">QR Code</span>
        </div>
        <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">QR Code Resmi</h1>
        <p class="text-xs sm:text-sm text-slate-500 mt-1">
            Unduh atau cetak QR Code untuk keperluan publikasi fisik, poster, brosur, atau banner kegiatan PIK-R REQUEST.
        </p>
    </div>

    <!-- Container QR Code -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 max-w-5xl" x-data="{ copied: false }">
        
        <!-- Kartu Visual QR Code -->
        <div class="lg:col-span-5 flex flex-col items-center">
            <div class="p-6 rounded-3xl bg-white border border-slate-200 shadow-md w-full max-w-sm flex flex-col items-center text-center">
                
                <!-- Logo & Heading QR Card -->
                <div class="flex items-center gap-2 mb-4">
                    <img src="{{ asset('images/logo-pikr.png') }}" alt="Logo PIK-R REQUEST" class="w-8 h-8 object-contain">
                    <span class="text-xs font-black text-slate-900 tracking-tight">PIK-R REQUEST</span>
                </div>

                <!-- SVG QR Code Render -->
                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 mb-4 w-full flex items-center justify-center">
                    <div class="w-56 h-56 flex items-center justify-center [&>svg]:w-full [&>svg]:h-full">
                        {!! $svgQr !!}
                    </div>
                </div>

                <!-- Nama Link -->
                <h3 class="text-sm font-bold text-slate-900 leading-snug">{{ $shortLink->name }}</h3>
                <p class="text-xs font-mono text-blue-600 mt-1 select-all font-semibold">{{ $shortLink->short_url }}</p>

                <!-- Tagline Badge -->
                <div class="mt-4 pt-4 border-t border-slate-100 w-full text-[11px] text-slate-400">
                    SMA Negeri 1 Tasik Putri Puyu
                </div>

            </div>
        </div>

        <!-- Detail Informasi & Tombol Download -->
        <div class="lg:col-span-7 space-y-6">
            
            <!-- Detail Card -->
            <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-xs space-y-4">
                <h3 class="text-base font-bold text-slate-900">Informasi Tautan QR</h3>
                
                <div class="space-y-3 text-xs">
                    <div>
                        <span class="text-slate-400 block mb-0.5">Nama Kegiatan / Formulir:</span>
                        <span class="font-bold text-slate-800 text-sm">{{ $shortLink->name }}</span>
                    </div>

                    <div>
                        <span class="text-slate-400 block mb-0.5">Short URL Resmi:</span>
                        <div class="flex items-center gap-2 mt-1">
                            <span class="font-mono font-bold text-blue-700 bg-blue-50 px-3 py-1.5 rounded-lg border border-blue-200/80">
                                {{ $shortLink->short_url }}
                            </span>
                            <button
                                @click="navigator.clipboard.writeText('{{ $shortLink->short_url }}'); copied = true; setTimeout(() => copied = false, 2000)"
                                class="px-3 py-1.5 rounded-lg text-xs font-bold transition cursor-pointer"
                                :class="copied ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-100 hover:bg-slate-200 text-slate-700'"
                            >
                                <span x-show="!copied">📋 Salin URL</span>
                                <span x-show="copied" x-cloak>✓ Tersalin!</span>
                            </button>
                        </div>
                    </div>

                    <div>
                        <span class="text-slate-400 block mb-0.5">URL Tujuan Pengalihan:</span>
                        <a href="{{ $shortLink->destination_url }}" target="_blank" class="text-slate-600 hover:text-blue-600 hover:underline break-all block">
                            {{ $shortLink->destination_url }}
                        </a>
                    </div>

                    <div class="flex items-center gap-6 pt-2">
                        <div>
                            <span class="text-slate-400 block">Total Pindaian / Klik:</span>
                            <span class="font-black text-slate-900 text-lg">{{ number_format($shortLink->clicks_count) }} kali</span>
                        </div>
                        <div>
                            <span class="text-slate-400 block">Status:</span>
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $shortLink->is_active ? 'bg-emerald-50 text-emerald-700' : 'bg-amber-50 text-amber-700' }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $shortLink->is_active ? 'bg-emerald-500' : 'bg-amber-500' }}"></span>
                                {{ $shortLink->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Download Options Card -->
            <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-xs">
                <h3 class="text-base font-bold text-slate-900 mb-2">Opsi Unduh QR Code</h3>
                <p class="text-xs text-slate-500 mb-5">Pilih format unduhan sesuai dengan media publikasi yang Anda gunakan.</p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    
                    <!-- Download PNG -->
                    <a
                        href="{{ route('links.qr.download', [$shortLink, 'png']) }}"
                        class="p-4 rounded-xl border border-blue-200 bg-blue-50/50 hover:bg-blue-50 transition flex items-center gap-3 cursor-pointer group"
                    >
                        <div class="w-10 h-10 rounded-lg bg-blue-600 text-white flex items-center justify-center shrink-0 shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                            </svg>
                        </div>
                        <div>
                            <div class="text-xs font-bold text-slate-900 group-hover:text-blue-700">Unduh Format PNG</div>
                            <div class="text-[11px] text-slate-500">Resolusi tinggi (cocok untuk sosmed & web)</div>
                        </div>
                    </a>

                    <!-- Download SVG -->
                    <a
                        href="{{ route('links.qr.download', [$shortLink, 'svg']) }}"
                        class="p-4 rounded-xl border border-slate-200 bg-slate-50 hover:bg-slate-100 transition flex items-center gap-3 cursor-pointer group"
                    >
                        <div class="w-10 h-10 rounded-lg bg-slate-800 text-white flex items-center justify-center shrink-0 shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                            </svg>
                        </div>
                        <div>
                            <div class="text-xs font-bold text-slate-900 group-hover:text-blue-700">Unduh Format SVG</div>
                            <div class="text-[11px] text-slate-500">Vektor tajam tak terbatas (spanduk & cetak)</div>
                        </div>
                    </a>

                </div>
            </div>

        </div>

    </div>
</x-layouts.app>
