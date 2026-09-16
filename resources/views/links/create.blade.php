<x-layouts.app>
    <x-slot:title>Buat Link Baru</x-slot:title>

    <!-- Header Page -->
    <div class="mb-8">
        <div class="flex items-center gap-2 text-xs font-semibold text-blue-600 mb-1">
            <a href="{{ route('links.index') }}" class="hover:underline">Semua Link</a>
            <span>/</span>
            <span class="text-slate-400">Buat Baru</span>
        </div>
        <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Buat Short Link Baru</h1>
        <p class="text-xs sm:text-sm text-slate-500 mt-1">
            Perpendek URL panjang Google Drive, Formulir, Instagram, atau dokumen kegiatan PIK-R REQUEST.
        </p>
    </div>

    <!-- Container Form -->
    <div class="max-w-3xl" x-data="{
        alias: '{{ old('code') }}',
        baseUrl: '{{ url('/') }}/',
        bridgeEnabled: {{ old('bridge_enabled', '0') === '1' ? 'true' : 'false' }},
        qrEnabled: {{ old('qr_enabled', '1') === '1' ? 'true' : 'true' }},
        isActive: {{ old('is_active', '1') === '1' ? 'true' : 'true' }}
    }">
        <div class="p-6 sm:p-8 rounded-2xl bg-white border border-slate-200 shadow-xs">
            
            <form method="POST" action="{{ route('links.store') }}" class="space-y-6">
                @csrf

                <!-- Nama Link -->
                <div>
                    <label for="name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Nama / Judul Tautan <span class="text-rose-500">*</span>
                    </label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        placeholder="Contoh: Pendaftaran Duta Genre PIK-R REQUEST 2026"
                        class="w-full px-4 py-2.5 rounded-xl bg-white border {{ $errors->has('name') ? 'border-rose-400' : 'border-slate-300 focus:border-blue-600' }} text-slate-900 text-sm placeholder-slate-400 focus:outline-none focus:ring-4 focus:ring-blue-500/10 transition"
                    />
                    <p class="text-[11px] text-slate-400 mt-1.5">Nama pengenal kegiatan agar mudah dicari di dashboard.</p>
                    @error('name')
                        <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- URL Tujuan -->
                <div>
                    <label for="destination_url" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        URL Tujuan Asli <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                            </svg>
                        </div>
                        <input
                            type="url"
                            id="destination_url"
                            name="destination_url"
                            value="{{ old('destination_url') }}"
                            required
                            placeholder="https://docs.google.com/forms/d/e/.../viewform"
                            class="w-full pl-10 pr-4 py-2.5 rounded-xl bg-white border {{ $errors->has('destination_url') ? 'border-rose-400' : 'border-slate-300 focus:border-blue-600' }} text-slate-900 text-sm placeholder-slate-400 focus:outline-none focus:ring-4 focus:ring-blue-500/10 transition"
                        />
                    </div>
                    <p class="text-[11px] text-slate-400 mt-1.5">Harus diawali dengan <code class="text-blue-600 font-mono">http://</code> atau <code class="text-blue-600 font-mono">https://</code></p>
                    @error('destination_url')
                        <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Custom Alias -->
                <div>
                    <label for="code" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Custom Alias (Opsional)
                    </label>
                    <div class="flex rounded-xl shadow-xs">
                        <span class="inline-flex items-center px-4 rounded-l-xl border border-r-0 border-slate-300 bg-slate-50 text-slate-500 text-xs font-mono font-medium select-none">
                            {{ url('/') }}/
                        </span>
                        <input
                            type="text"
                            id="code"
                            name="code"
                            x-model="alias"
                            placeholder="duta-genre (kosongkan untuk kode acak)"
                            class="flex-1 min-w-0 px-4 py-2.5 rounded-r-xl bg-white border {{ $errors->has('code') ? 'border-rose-400' : 'border-slate-300 focus:border-blue-600' }} text-slate-900 text-sm font-mono placeholder-slate-400 focus:outline-none focus:ring-4 focus:ring-blue-500/10 transition"
                        />
                    </div>
                    <p class="text-[11px] text-slate-400 mt-1.5">Hanya huruf, angka, tanda hubung (-), dan garis bawah (_). Jika dikosongkan, sistem akan membuat 6 karakter acak unik.</p>
                    @error('code')
                        <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p>
                    @enderror

                    <!-- Live Preview Tautan -->
                    <div class="mt-3 p-3 rounded-xl bg-blue-50 border border-blue-100 flex items-center justify-between text-xs">
                        <span class="text-slate-600 font-medium">Pratinjau Short URL:</span>
                        <span class="font-mono font-bold text-blue-700" x-text="baseUrl + (alias.trim() ? alias.trim() : 'xxxxxx')"></span>
                    </div>
                </div>

                <!-- PENGATURAN TAMBAHAN (SWITCH TOGGLES) -->
                <div class="pt-4 border-t border-slate-100 space-y-4">
                    <div class="text-xs font-bold uppercase tracking-wider text-slate-400">Pengaturan Tautan</div>

                    <!-- Switch 1: Status Aktif -->
                    <label class="flex items-center justify-between p-3.5 rounded-xl border border-slate-200 hover:bg-slate-50 cursor-pointer transition">
                        <div>
                            <div class="text-xs font-bold text-slate-900">Tautan Aktif</div>
                            <div class="text-[11px] text-slate-500">Tautan dapat langsung diakses publik setelah dibuat.</div>
                        </div>
                        <input type="hidden" name="is_active" value="0">
                        <input
                            type="checkbox"
                            name="is_active"
                            value="1"
                            x-model="isActive"
                            class="w-5 h-5 rounded border-slate-300 text-blue-600 focus:ring-blue-500 transition cursor-pointer"
                        />
                    </label>

                    <!-- Switch 2: Bridge Page -->
                    <label class="flex items-center justify-between p-3.5 rounded-xl border border-slate-200 hover:bg-slate-50 cursor-pointer transition">
                        <div>
                            <div class="text-xs font-bold text-slate-900">Gunakan Bridge Page (Halaman Perantara)</div>
                            <div class="text-[11px] text-slate-500">Tampilkan halaman perantara resmi PIK-R REQUEST dengan countdown 5 detik sebelum dialihkan.</div>
                        </div>
                        <input type="hidden" name="bridge_enabled" value="0">
                        <input
                            type="checkbox"
                            name="bridge_enabled"
                            value="1"
                            x-model="bridgeEnabled"
                            class="w-5 h-5 rounded border-slate-300 text-blue-600 focus:ring-blue-500 transition cursor-pointer"
                        />
                    </label>

                    <!-- Switch 3: QR Code -->
                    <label class="flex items-center justify-between p-3.5 rounded-xl border border-slate-200 hover:bg-slate-50 cursor-pointer transition">
                        <div>
                            <div class="text-xs font-bold text-slate-900">Generate QR Code</div>
                            <div class="text-[11px] text-slate-500">Buat QR Code otomatis untuk keperluan poster, spanduk, atau media cetak.</div>
                        </div>
                        <input type="hidden" name="qr_enabled" value="0">
                        <input
                            type="checkbox"
                            name="qr_enabled"
                            value="1"
                            x-model="qrEnabled"
                            class="w-5 h-5 rounded border-slate-300 text-blue-600 focus:ring-blue-500 transition cursor-pointer"
                        />
                    </label>
                </div>

                <!-- Action Buttons -->
                <div class="pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
                    <a
                        href="{{ route('links.index') }}"
                        class="px-4 py-2.5 rounded-xl text-xs font-semibold text-slate-600 hover:bg-slate-100 transition"
                    >
                        Batal
                    </a>
                    <button
                        type="submit"
                        class="px-5 py-2.5 rounded-xl text-xs font-bold text-white bg-blue-600 hover:bg-blue-700 shadow-md shadow-blue-500/20 transition cursor-pointer flex items-center gap-2"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                        </svg>
                        <span>Buat Short Link</span>
                    </button>
                </div>

            </form>

        </div>
    </div>
</x-layouts.app>
