<x-layouts.guest>
    <x-slot:title>Masuk ke Akun</x-slot:title>

    <div class="min-h-screen flex flex-col lg:flex-row bg-slate-50 text-slate-800 selection:bg-blue-600 selection:text-white overflow-hidden">
        
        <!-- ==================== PANEL KIRI (BRANDING BIRU ELEGAN) ==================== -->
        <div class="relative w-full lg:w-7/12 flex flex-col justify-between p-6 sm:p-10 lg:p-14 bg-gradient-to-br from-blue-900 via-blue-800 to-indigo-950 text-white border-b lg:border-b-0 lg:border-r border-blue-700/40 overflow-hidden shadow-2xl">
            
            <!-- Ambient Glow & Pattern -->
            <div class="absolute -top-32 -left-32 w-96 h-96 bg-sky-400/20 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute top-1/2 -right-24 w-80 h-80 bg-blue-400/15 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-24 left-1/3 w-96 h-96 bg-indigo-500/20 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute inset-0 bg-[linear-gradient(to_right,#ffffff0a_1px,transparent_1px),linear-gradient(to_bottom,#ffffff0a_1px,transparent_1px)] bg-[size:36px_36px] pointer-events-none"></div>

            <!-- Top Header & Logo PIK-R REQUEST -->
            <div class="relative z-10">
                <div class="flex items-center gap-4">
                    <!-- Logo Resmi PIK-R REQUEST -->
                    <div class="w-16 h-16 rounded-2xl bg-white/10 p-1 shadow-lg backdrop-blur-md flex items-center justify-center border border-white/20">
                        <div class="w-full h-full bg-white rounded-[12px] flex items-center justify-center p-1 shadow-sm">
                            <img
                                src="{{ asset('images/logo-pikr.png') }}"
                                alt="Logo Resmi PIK-R REQUEST"
                                class="w-full h-full object-contain"
                            />
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center gap-2">
                            <span class="text-xl sm:text-2xl font-black tracking-tight text-white">REQUEST LINK</span>
                            <span class="text-[10px] uppercase font-bold px-2.5 py-0.5 bg-sky-400/20 text-sky-200 border border-sky-300/30 rounded-full tracking-wider">v1.0</span>
                        </div>
                        <p class="text-xs text-blue-200 font-medium tracking-wide">Pusat Informasi &amp; Konseling Remaja (PIK-R)</p>
                        <p class="text-[11px] text-blue-200/80 font-normal">SMA Negeri 1 Tasik Putri Puyu</p>
                    </div>
                </div>

                <!-- Official Platform Badge -->
                <div class="mt-8 inline-flex items-center gap-2.5 px-4 py-1.5 rounded-full bg-white/10 border border-white/20 text-sky-100 text-xs font-semibold backdrop-blur-md shadow-sm">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-sky-300 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-sky-300"></span>
                    </span>
                    <span class="tracking-wide">PLATFORM RESMI PIK-R REQUEST</span>
                </div>

                <!-- Hero Heading & Description -->
                <div class="mt-6 max-w-xl">
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-white tracking-tight leading-[1.15]">
                        Pemendek Tautan Resmi <br class="hidden sm:inline" />
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-sky-200 via-white to-blue-200">
                            PIK-R REQUEST
                        </span>
                    </h1>
                    <p class="mt-4 text-sm sm:text-base text-blue-100 leading-relaxed font-normal">
                        Perpendek dan kelola tautan kegiatan PIK-R REQUEST dengan mudah, aman, dan profesional. Dirancang khusus untuk mempermudah penyebaran informasi kepada seluruh siswa dan masyarakat.
                    </p>
                </div>
            </div>

            <!-- Feature List (5 Fitur Unggulan) -->
            <div class="relative z-10 my-8 lg:my-10 max-w-xl">
                <div class="text-xs font-bold tracking-wider uppercase text-sky-200 mb-4 flex items-center gap-2">
                    <span class="h-px w-6 bg-sky-300/60"></span>
                    Fitur &amp; Keunggulan Layanan
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                    
                    <!-- Fitur 1 -->
                    <div class="p-3.5 rounded-xl bg-white/10 border border-white/15 backdrop-blur-sm flex items-start gap-3 hover:bg-white/15 transition">
                        <div class="p-2 rounded-lg bg-sky-400/20 text-white shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xs font-semibold text-white">Short Link Kustom</h3>
                            <p class="text-[11px] text-blue-100/80 mt-0.5">Nama alias khusus seperti <code class="text-sky-200 font-mono">/daftar</code></p>
                        </div>
                    </div>

                    <!-- Fitur 2 -->
                    <div class="p-3.5 rounded-xl bg-white/10 border border-white/15 backdrop-blur-sm flex items-start gap-3 hover:bg-white/15 transition">
                        <div class="p-2 rounded-lg bg-sky-400/20 text-white shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xs font-semibold text-white">QR Code Otomatis</h3>
                            <p class="text-[11px] text-blue-100/80 mt-0.5">Siap unduh untuk poster, pamflet, &amp; banner</p>
                        </div>
                    </div>

                    <!-- Fitur 3 -->
                    <div class="p-3.5 rounded-xl bg-white/10 border border-white/15 backdrop-blur-sm flex items-start gap-3 hover:bg-white/15 transition">
                        <div class="p-2 rounded-lg bg-sky-400/20 text-white shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xs font-semibold text-white">Statistik Kunjungan</h3>
                            <p class="text-[11px] text-blue-100/80 mt-0.5">Pantau jumlah klik tautan secara real-time</p>
                        </div>
                    </div>

                    <!-- Fitur 4 -->
                    <div class="p-3.5 rounded-xl bg-white/10 border border-white/15 backdrop-blur-sm flex items-start gap-3 hover:bg-white/15 transition">
                        <div class="p-2 rounded-lg bg-sky-400/20 text-white shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xs font-semibold text-white">Bridge Page Interaktif</h3>
                            <p class="text-[11px] text-blue-100/80 mt-0.5">Halaman countdown resmi &amp; elegan</p>
                        </div>
                    </div>

                    <!-- Fitur 5 -->
                    <div class="sm:col-span-2 p-3.5 rounded-xl bg-white/10 border border-white/15 backdrop-blur-sm flex items-start gap-3 hover:bg-white/15 transition">
                        <div class="p-2 rounded-lg bg-sky-400/20 text-white shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xs font-semibold text-white">Pengelolaan Tautan Terpusat</h3>
                            <p class="text-[11px] text-blue-100/80 mt-0.5">Kelola, ubah, aktifkan/nonaktifkan seluruh tautan dari satu dashboard terpadu</p>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Bottom Subdomain & Tagline -->
            <div class="relative z-10 pt-4 border-t border-white/15 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 text-xs text-blue-200">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-sky-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                    </svg>
                    <span>Subdomain Resmi: <span class="text-white font-mono font-medium">link.pikrrequestman1tpp.my.id</span></span>
                </div>
                <div class="italic text-sky-200 font-medium tracking-wide">"Shorten. Share. Connect."</div>
            </div>

        </div>

        <!-- ==================== PANEL KANAN (FORM LOGIN BERSIH PUTIH & BIRU) ==================== -->
        <div class="w-full lg:w-5/12 flex items-center justify-center p-6 sm:p-10 lg:p-12 bg-slate-50 relative">
            
            <div class="w-full max-w-md relative z-10" x-data="{ showPassword: false, isSubmitting: false }">
                
                <!-- Card Login Bersih Putih dengan Border Halus -->
                <div class="rounded-2xl bg-white border border-slate-200/90 p-6 sm:p-8 shadow-xl shadow-blue-500/5">
                    
                    <!-- Card Header -->
                    <div class="text-center sm:text-left mb-6">
                        <div class="inline-flex lg:hidden items-center justify-center w-12 h-12 rounded-xl bg-blue-50 border border-blue-100 p-1.5 mb-3">
                            <img src="{{ asset('images/logo-pikr.png') }}" alt="Logo PIK-R REQUEST" class="w-full h-full object-contain">
                        </div>
                        <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Masuk ke REQUEST LINK</h2>
                        <p class="text-xs text-slate-500 mt-1.5 leading-relaxed">
                            Masukkan kredensial akun Anda untuk mengakses dashboard manajemen tautan resmi.
                        </p>
                    </div>

                    <!-- Status Notification (Success / Logout) -->
                    @if (session('status'))
                        <div class="mb-5 p-3.5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs flex items-center gap-2.5">
                            <svg class="w-4 h-4 shrink-0 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{{ session('status') }}</span>
                        </div>
                    @endif

                    <!-- Error Alert -->
                    @if ($errors->any())
                        <div class="mb-5 p-3.5 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-xs flex items-start gap-2.5">
                            <svg class="w-4 h-4 shrink-0 text-rose-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div class="space-y-0.5">
                                @foreach ($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Login Form -->
                    <form method="POST" action="{{ route('login.post') }}" @submit="isSubmitting = true" class="space-y-4">
                        @csrf

                        <!-- Field Email / Username -->
                        <div>
                            <label for="login" class="block text-xs font-semibold text-slate-700 mb-1.5">
                                Email atau Username
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <input
                                    id="login"
                                    type="text"
                                    name="login"
                                    value="{{ old('login') }}"
                                    required
                                    autofocus
                                    autocomplete="username"
                                    placeholder="admin atau email resmi"
                                    class="w-full pl-10 pr-4 py-2.5 rounded-xl bg-white border {{ $errors->has('login') ? 'border-rose-400 focus:ring-rose-500' : 'border-slate-300 focus:border-blue-600 focus:ring-blue-500/20' }} text-slate-900 text-sm placeholder-slate-400 focus:outline-none focus:ring-4 transition"
                                />
                            </div>
                            @error('login')
                                <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Field Password -->
                        <div>
                            <div class="flex items-center justify-between mb-1.5">
                                <label for="password" class="block text-xs font-semibold text-slate-700">
                                    Kata Sandi
                                </label>
                            </div>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                                <input
                                    id="password"
                                    :type="showPassword ? 'text' : 'password'"
                                    name="password"
                                    required
                                    autocomplete="current-password"
                                    placeholder="••••••••••••"
                                    class="w-full pl-10 pr-11 py-2.5 rounded-xl bg-white border {{ $errors->has('password') ? 'border-rose-400 focus:ring-rose-500' : 'border-slate-300 focus:border-blue-600 focus:ring-blue-500/20' }} text-slate-900 text-sm placeholder-slate-400 focus:outline-none focus:ring-4 transition"
                                />
                                <!-- Toggle Show/Hide Password -->
                                <button
                                    type="button"
                                    @click="showPassword = !showPassword"
                                    class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-blue-600 transition focus:outline-none cursor-pointer"
                                    title="Tampilkan / Sembunyikan Kata Sandi"
                                >
                                    <!-- Eye Icon (when hidden) -->
                                    <svg x-show="!showPassword" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <!-- Eye-Slash Icon (when shown) -->
                                    <svg x-show="showPassword" x-cloak class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                                    </svg>
                                </button>
                            </div>
                            @error('password')
                                <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Remember Me -->
                        <div class="flex items-center justify-between pt-1">
                            <label class="flex items-center gap-2 cursor-pointer select-none">
                                <input
                                    type="checkbox"
                                    name="remember"
                                    class="w-4 h-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500/40 transition"
                                />
                                <span class="text-xs text-slate-600 hover:text-slate-900">Ingat saya di perangkat ini</span>
                            </label>
                        </div>

                        <!-- Submit Button Royal Blue -->
                        <div class="pt-2">
                            <button
                                type="submit"
                                :disabled="isSubmitting"
                                class="w-full relative py-3 px-4 rounded-xl font-bold text-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500/20 shadow-md shadow-blue-500/20 transition duration-200 disabled:opacity-60 disabled:cursor-not-allowed flex items-center justify-center gap-2 cursor-pointer"
                            >
                                <!-- Spinner icon saat submitting -->
                                <svg x-show="isSubmitting" x-cloak class="animate-spin w-4 h-4 text-white" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <span x-show="!isSubmitting">Masuk Sekarang</span>
                                <span x-show="isSubmitting" x-cloak>Memverifikasi...</span>
                                <svg x-show="!isSubmitting" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </button>
                        </div>
                    </form>

                </div>

                <!-- Footer Card -->
                <div class="mt-6 text-center text-xs text-slate-500">
                    <p class="font-semibold text-slate-700">PIK-R REQUEST • SMA Negeri 1 Tasik Putri Puyu</p>
                    <p class="mt-1 text-[11px] text-slate-400">Pusat Informasi &amp; Konseling Remaja &copy; {{ date('Y') }}.</p>
                </div>

            </div>

        </div>

    </div>
</x-layouts.guest>
