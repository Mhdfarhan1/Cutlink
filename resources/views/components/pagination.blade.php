@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex flex-col sm:flex-row items-center justify-between gap-4">
        
        <!-- Informasi Jumlah Data -->
        <div class="text-xs text-slate-500">
            Menampilkan
            <span class="font-bold text-slate-800">{{ $paginator->firstItem() ?? 0 }}</span>
            sampai
            <span class="font-bold text-slate-800">{{ $paginator->lastItem() ?? 0 }}</span>
            dari
            <span class="font-bold text-slate-800">{{ $paginator->total() }}</span>
            entri
        </div>

        <!-- Tombol Halaman (Previous, 1, 2, 3, Next) -->
        <div class="inline-flex items-center gap-1">
            
            {{-- Tombol Sebelumnya (Previous) --}}
            @if ($paginator->onFirstPage())
                <span class="px-3 py-1.5 rounded-lg border border-slate-200 bg-slate-50 text-slate-400 text-xs font-semibold cursor-not-allowed select-none">
                    &larr; Kembali
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="px-3 py-1.5 rounded-lg border border-slate-300 bg-white hover:bg-slate-50 text-slate-700 text-xs font-semibold shadow-2xs transition">
                    &larr; Kembali
                </a>
            @endif

            {{-- Elemen Nomor Halaman (1, 2, 3...) --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="px-2.5 py-1 text-slate-400 text-xs font-semibold select-none">{{ $element }}</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="w-8 h-8 rounded-lg bg-blue-600 text-white text-xs font-bold flex items-center justify-center shadow-xs shadow-blue-500/20 select-none">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" class="w-8 h-8 rounded-lg border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 text-xs font-semibold flex items-center justify-center transition">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Tombol Selanjutnya (Next) --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="px-3 py-1.5 rounded-lg border border-slate-300 bg-white hover:bg-slate-50 text-slate-700 text-xs font-semibold shadow-2xs transition">
                    Lanjut &rarr;
                </a>
            @else
                <span class="px-3 py-1.5 rounded-lg border border-slate-200 bg-slate-50 text-slate-400 text-xs font-semibold cursor-not-allowed select-none">
                    Lanjut &rarr;
                </span>
            @endif

        </div>

    </nav>
@else
    <div class="text-xs text-slate-500">
        Menampilkan
        <span class="font-bold text-slate-800">{{ $paginator->firstItem() ?? 0 }}</span>
        sampai
        <span class="font-bold text-slate-800">{{ $paginator->lastItem() ?? 0 }}</span>
        dari
        <span class="font-bold text-slate-800">{{ $paginator->total() }}</span>
        entri
    </div>
@endif
