<x-layouts.guest>
    <x-slot:title>Menuju Tautan Tujuan — {{ $shortLink->name }}</x-slot:title>

    <div
        class="min-h-screen bg-[#f8fafc] flex flex-col justify-between items-center py-8 px-4 sm:px-6 selection:bg-blue-600 selection:text-white"
        x-data="{
            totalMs: 3500,
            elapsedMs: 0,
            progress: 0,
            destination: '{{ $shortLink->destination_url }}',
            redirectNow() {
                window.location.href = this.destination;
            },
            init() {
                const step = 50;
                const interval = setInterval(() => {
                    this.elapsedMs += step;
                    this.progress = Math.min(100, (this.elapsedMs / this.totalMs) * 100);
                    if (this.elapsedMs >= this.totalMs) {
                        clearInterval(interval);
                        this.redirectNow();
                    }
                }, step);
            }
        }"
    >
        <!-- Top Spacer untuk menjaga centering vertikal sempurna -->
        <div></div>

        <!-- ==================== KARTU UTAMA MODAL PENGALIHAN ==================== -->
        <div class="w-full max-w-[420px] bg-white rounded-3xl border border-slate-200/80 shadow-xl shadow-slate-200/50 p-6 sm:p-8 my-auto">
            
            <!-- Header Kartu: Logo & Pill MENGALIHKAN -->
            <div class="flex items-center justify-between gap-3 mb-6">
                <!-- Logo & Identitas Organisasi -->
                <div class="flex items-center gap-2.5">
                    <img
                        src="{{ asset('images/logo-pikr.png') }}"
                        alt="Logo PIK-R REQUEST"
                        class="w-10 h-10 object-contain drop-shadow-xs"
                    />
                    <div class="text-left leading-tight">
                        <div class="text-xs font-black text-slate-900 tracking-tight">PIK-R REQUEST</div>
                        <div class="text-[10px] font-semibold text-blue-600">SMAN 1 Tasik Putri Puyu</div>
                    </div>
                </div>

                <!-- Pill Badge MENGALIHKAN dengan Animasi Spinner Titik -->
                <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-blue-50/80 border border-blue-200/80 text-blue-600 text-[11px] font-bold uppercase tracking-wider">
                    <svg class="w-3.5 h-3.5 animate-spin" viewBox="0 0 24 24" fill="currentColor">
                        <circle cx="12" cy="2.5" r="1.5" opacity="0.2"/>
                        <circle cx="18.7" cy="5.3" r="1.5" opacity="0.3"/>
                        <circle cx="21.5" cy="12" r="1.5" opacity="0.4"/>
                        <circle cx="18.7" cy="18.7" r="1.5" opacity="0.6"/>
                        <circle cx="12" cy="21.5" r="1.5" opacity="0.8"/>
                        <circle cx="5.3" cy="18.7" r="1.5" opacity="1"/>
                        <circle cx="2.5" cy="12" r="1.5" opacity="0.4"/>
                        <circle cx="5.3" cy="5.3" r="1.5" opacity="0.2"/>
                    </svg>
                    <span>MENGALIHKAN</span>
                </div>
            </div>

            <!-- Judul & Keterangan Pengalihan -->
            <div class="text-center mb-6">
                <h1 class="text-2xl sm:text-[26px] font-black text-[#0f172a] tracking-tight">
                    Menuju Tautan Tujuan
                </h1>
                <p class="text-xs sm:text-sm text-slate-500 mt-2 leading-relaxed">
                    Anda sedang dialihkan ke tautan resmi<br>
                    <span class="font-bold text-slate-700">PIK-R REQUEST SMA Negeri 1 Tasik Putri Puyu</span>
                    @if($shortLink->name)
                        <span class="block text-xs font-semibold text-blue-600 mt-0.5">({{ $shortLink->name }})</span>
                    @endif
                </p>
            </div>

            <!-- Kotak URL Tujuan (Bersih & Elegan) -->
            <div class="rounded-2xl bg-[#f1f5f9] p-4 sm:p-5 text-left mb-6">
                <div class="text-[11px] font-bold tracking-wider text-slate-400 uppercase mb-2">
                    URL TUJUAN:
                </div>
                <div class="font-sans font-semibold text-slate-800 text-xs sm:text-sm leading-relaxed break-all select-all">
                    {{ $shortLink->destination_url }}
                </div>
            </div>

            <!-- Smooth Progress Bar (Bilah Biru Berjalan Halus) -->
            <div class="w-full h-1.5 bg-slate-200/70 rounded-full overflow-hidden mb-6">
                <div
                    class="h-full bg-blue-600 rounded-full transition-all duration-75 ease-linear"
                    :style="'width: ' + progress + '%'"
                ></div>
            </div>

            <!-- Tombol Buka Tautan Langsung -->
            <div>
                <button
                    type="button"
                    @click="redirectNow()"
                    class="inline-flex items-center justify-center gap-2.5 w-full py-3.5 px-6 rounded-2xl bg-[#1d64f2] hover:bg-blue-700 active:scale-[0.98] text-white font-bold text-sm sm:text-base shadow-sm transition cursor-pointer"
                >
                    <span>Buka Tautan Langsung</span>
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </button>
            </div>

        </div>

        <!-- ==================== FOOTER ==================== -->
        <footer class="text-center text-xs text-slate-400 py-4">
            &copy; {{ date('Y') }} PIK-R REQUEST SMA Negeri 1 Tasik Putri Puyu &bull; <span class="text-slate-500">link.pikrrequestman1tpp.my.id</span>
        </footer>

    </div>
</x-layouts.guest>
