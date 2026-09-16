<?php

namespace App\Http\Controllers;

use App\Models\LinkClick;
use App\Models\ShortLink;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class RedirectController extends Controller
{
    /**
     * Tangani pengalihan short URL ke tautan tujuan atau halaman bridge.
     */
    public function handle(Request $request, string $code): View|RedirectResponse
    {
        $shortLink = ShortLink::where('code', $code)->first();

        // Jika tautan tidak ditemukan
        if (! $shortLink) {
            abort(404, 'Tautan yang Anda cari tidak ditemukan.');
        }

        // Jika tautan nonaktif
        if (! $shortLink->is_active) {
            return view('redirect.inactive', compact('shortLink'));
        }

        // Catat klik secara atomic & simpan data statistik dengan privasi aman
        $shortLink->increment('clicks_count');

        LinkClick::create([
            'short_link_id' => $shortLink->id,
            'ip_address' => $request->ip(),
            'user_agent' => Str::limit($request->userAgent() ?? '', 500),
            'referer' => Str::limit($request->header('referer') ?? '', 500),
            'created_at' => now(),
        ]);

        // Jika Bridge Page diaktifkan, tampilkan halaman perantara
        if ($shortLink->bridge_enabled) {
            return view('redirect.bridge', compact('shortLink'));
        }

        // Pengalihan langsung ke URL tujuan
        return redirect()->away($shortLink->destination_url, 302);
    }
}
