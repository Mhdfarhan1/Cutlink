<x-layouts.app>
    <x-slot:title>Profil Administrator</x-slot:title>

    <!-- Header Page -->
    <div class="mb-8">
        <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Profil Administrator</h1>
        <p class="text-xs sm:text-sm text-slate-500 mt-1">
            Kelola identitas akun dan keamanan kata sandi administrator PIK-R REQUEST.
        </p>
    </div>

    <div class="max-w-4xl space-y-8">
        
        <!-- ==================== FORM 1: INFORMASI PROFIL ==================== -->
        <div class="p-6 sm:p-8 rounded-2xl bg-white border border-slate-200 shadow-xs">
            <div class="mb-6 pb-4 border-b border-slate-100 flex items-center justify-between">
                <div>
                    <h2 class="text-base font-bold text-slate-900">Informasi Akun</h2>
                    <p class="text-xs text-slate-500 mt-0.5">Perbarui nama pengguna dan alamat email resmi Anda.</p>
                </div>
                <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
            </div>

            <form method="POST" action="{{ route('profile.update') }}" class="space-y-4 max-w-xl">
                @csrf
                @method('PATCH')

                <!-- Nama -->
                <div>
                    <label for="name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Nama Lengkap / Instansi
                    </label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name', $user->name) }}"
                        required
                        class="w-full px-4 py-2.5 rounded-xl bg-white border {{ $errors->has('name') ? 'border-rose-400' : 'border-slate-300 focus:border-blue-600' }} text-slate-900 text-sm focus:outline-none focus:ring-4 focus:ring-blue-500/10 transition"
                    />
                    @error('name')
                        <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Username -->
                <div>
                    <label for="username" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Username
                    </label>
                    <div class="flex rounded-xl shadow-xs">
                        <span class="inline-flex items-center px-3.5 rounded-l-xl border border-r-0 border-slate-300 bg-slate-50 text-slate-500 text-xs font-mono select-none">
                            @
                        </span>
                        <input
                            type="text"
                            id="username"
                            name="username"
                            value="{{ old('username', $user->username) }}"
                            required
                            class="flex-1 min-w-0 px-4 py-2.5 rounded-r-xl bg-white border {{ $errors->has('username') ? 'border-rose-400' : 'border-slate-300 focus:border-blue-600' }} text-slate-900 text-sm font-mono focus:outline-none focus:ring-4 focus:ring-blue-500/10 transition"
                        />
                    </div>
                    @error('username')
                        <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Alamat Email
                    </label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email', $user->email) }}"
                        required
                        class="w-full px-4 py-2.5 rounded-xl bg-white border {{ $errors->has('email') ? 'border-rose-400' : 'border-slate-300 focus:border-blue-600' }} text-slate-900 text-sm focus:outline-none focus:ring-4 focus:ring-blue-500/10 transition"
                    />
                    @error('email')
                        <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-2">
                    <button
                        type="submit"
                        class="px-5 py-2.5 rounded-xl text-xs font-bold text-white bg-blue-600 hover:bg-blue-700 shadow-md shadow-blue-500/20 transition cursor-pointer"
                    >
                        Simpan Perubahan Profil
                    </button>
                </div>
            </form>
        </div>

        <!-- ==================== FORM 2: GANTI KATA SANDI ==================== -->
        <div class="p-6 sm:p-8 rounded-2xl bg-white border border-slate-200 shadow-xs">
            <div class="mb-6 pb-4 border-b border-slate-100 flex items-center justify-between">
                <div>
                    <h2 class="text-base font-bold text-slate-900">Keamanan &amp; Kata Sandi</h2>
                    <p class="text-xs text-slate-500 mt-0.5">Pastikan akun Anda menggunakan kata sandi yang panjang dan aman.</p>
                </div>
                <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
            </div>

            <form method="POST" action="{{ route('profile.password') }}" class="space-y-4 max-w-xl">
                @csrf
                @method('PUT')

                <!-- Kata Sandi Saat Ini -->
                <div>
                    <label for="current_password" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Kata Sandi Saat Ini
                    </label>
                    <input
                        type="password"
                        id="current_password"
                        name="current_password"
                        required
                        class="w-full px-4 py-2.5 rounded-xl bg-white border {{ $errors->has('current_password') ? 'border-rose-400' : 'border-slate-300 focus:border-blue-600' }} text-slate-900 text-sm focus:outline-none focus:ring-4 focus:ring-blue-500/10 transition"
                    />
                    @error('current_password')
                        <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Kata Sandi Baru -->
                <div>
                    <label for="password" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Kata Sandi Baru
                    </label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        required
                        class="w-full px-4 py-2.5 rounded-xl bg-white border {{ $errors->has('password') ? 'border-rose-400' : 'border-slate-300 focus:border-blue-600' }} text-slate-900 text-sm focus:outline-none focus:ring-4 focus:ring-blue-500/10 transition"
                    />
                    @error('password')
                        <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Konfirmasi Kata Sandi Baru -->
                <div>
                    <label for="password_confirmation" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Konfirmasi Kata Sandi Baru
                    </label>
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        required
                        class="w-full px-4 py-2.5 rounded-xl bg-white border border-slate-300 focus:border-blue-600 text-slate-900 text-sm focus:outline-none focus:ring-4 focus:ring-blue-500/10 transition"
                    />
                </div>

                <div class="pt-2">
                    <button
                        type="submit"
                        class="px-5 py-2.5 rounded-xl text-xs font-bold text-white bg-slate-900 hover:bg-slate-800 shadow-md transition cursor-pointer"
                    >
                        Perbarui Kata Sandi
                    </button>
                </div>
            </form>
        </div>

    </div>
</x-layouts.app>
