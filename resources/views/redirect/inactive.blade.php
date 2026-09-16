<x-layouts.guest>
    <x-slot:title>Tautan Tidak Aktif</x-slot:title>

    <div class="min-h-screen bg-slate-50 flex flex-col justify-between p-6 sm:p-10 selection:bg-blue-600 selection:text-white">
        
        <!-- Header Brand -->
        <div class="max-w-md mx-auto w-full text-center">
            <div class="inline-flex items-center gap-3 px-4 py-2 rounded-2xl bg-white border border-slate-200/80 shadow-xs">
                <img src="{{ asset('images/logo-pikr.png') }}" alt="Logo PIK-R REQUEST" class="w-8 h-8 object-contain">
                <div class="text-left">
                    <span class="text-xs font-black text-slate-900 tracking-tight block">REQUEST LINK</span>
                    <span class="text-[10px] text-blue-600 font-semibold block">PIK-R REQUEST &bull; SMAN 1 Tasik Putri Puyu</span>
                </div>
            </div>
        </div>

        <!-- Central Card -->
        <div class="max-w-md mx-auto w-full my-8">
            <div class="p-8 sm:p-10 rounded-3xl bg-white border border-slate-200 shadow-xl text-center">
                
                <!-- Icon Amber Warning -->
                <div class="w-16 h-16 rounded-2xl bg-amber-50 text-amber-600 mx-auto flex items-center justify-center mb-6 border border-amber-200/80">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>

                <h1 class="text-2xl font-black text-slate-900">
                    Tautan Tidak Aktif
                </h1>

                <p class="text-xs sm:text-sm text-slate-500 mt-2 leading-relaxed">
                    Tautan <span class="font-mono font-bold text-slate-700">/{{ $shortLink->code }}</span> saat ini sedang ditangguhkan atau telah dinonaktifkan oleh administrator PIK-R REQUEST.
                </p>

                <div class="mt-6 p-4 rounded-xl bg-slate-50 border border-slate-200 text-xs text-slate-600 text-left">
                    <div class="font-bold text-slate-800 mb-1">Nama Kegiatan:</div>
                    <div>{{ $shortLink->name }}</div>
                </div>

                <div class="mt-8">
                    <a
                        href="https://pikrrequestman1tpp.my.id"
                        target="_blank"
                        class="w-full inline-flex items-center justify-center gap-2 py-3 px-4 rounded-xl text-xs font-bold text-white bg-blue-600 hover:bg-blue-700 shadow-md shadow-blue-500/20 transition cursor-pointer"
                    >
                        <span>Kunjungi Website Utama PIK-R REQUEST</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                    </a>
                </div>

            </div>
        </div>

        <!-- Footer -->
        <div class="max-w-md mx-auto w-full text-center text-xs text-slate-400">
            <p>PIK-R REQUEST &bull; SMA Negeri 1 Tasik Putri Puyu</p>
        </div>

    </div>
</x-layouts.guest>
