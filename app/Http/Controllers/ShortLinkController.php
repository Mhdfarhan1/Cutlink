<?php

namespace App\Http\Controllers;

use App\Http\Requests\Link\StoreShortLinkRequest;
use App\Http\Requests\Link\UpdateShortLinkRequest;
use App\Models\ShortLink;
use App\Services\QrCodeService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ShortLinkController extends Controller
{
    /**
     * Tampilkan daftar seluruh short link dengan filter dan pencarian.
     */
    public function index(Request $request): View
    {
        $query = ShortLink::query()->latest();

        // Filter status
        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        // Pencarian nama, kode alias, atau URL tujuan
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%")
                    ->orWhere('destination_url', 'like', "%{$search}%");
            });
        }

        $perPage = (int) $request->query('per_page', 10);
        $perPage = in_array($perPage, [10, 25, 50, 100], true) ? $perPage : 10;

        $links = $query->paginate($perPage)->withQueryString();

        return view('links.index', compact('links', 'perPage'));
    }

    /**
     * Tampilkan form pembuatan short link baru.
     */
    public function create(): View
    {
        return view('links.create');
    }

    /**
     * Simpan short link baru ke database.
     */
    public function store(StoreShortLinkRequest $request): RedirectResponse
    {
        $code = $request->input('code');

        // Jika alias kosong, generate kode random unik 6 karakter
        if (empty($code)) {
            do {
                $code = Str::lower(Str::random(6));
            } while (ShortLink::where('code', $code)->exists() || in_array($code, StoreShortLinkRequest::RESERVED_WORDS, true));
        }

        ShortLink::create([
            'user_id' => auth()->id(),
            'name' => $request->input('name'),
            'code' => $code,
            'destination_url' => $request->input('destination_url'),
            'bridge_enabled' => $request->boolean('bridge_enabled', false),
            'qr_enabled' => $request->boolean('qr_enabled', true),
            'is_active' => $request->boolean('is_active', true),
            'clicks_count' => 0,
        ]);

        return redirect()->route('links.index')->with('status', 'Short link berhasil dibuat!');
    }

    /**
     * Tampilkan form edit short link.
     */
    public function edit(ShortLink $shortLink): View
    {
        return view('links.edit', compact('shortLink'));
    }

    /**
     * Perbarui data short link yang ada.
     */
    public function update(UpdateShortLinkRequest $request, ShortLink $shortLink): RedirectResponse
    {
        $shortLink->update([
            'name' => $request->input('name'),
            'code' => $request->input('code'),
            'destination_url' => $request->input('destination_url'),
            'bridge_enabled' => $request->boolean('bridge_enabled', false),
            'qr_enabled' => $request->boolean('qr_enabled', true),
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('links.index')->with('status', 'Tautan berhasil diperbarui!');
    }

    /**
     * Hapus short link dari database.
     */
    public function destroy(ShortLink $shortLink): RedirectResponse
    {
        $shortLink->delete();

        return redirect()->route('links.index')->with('status', 'Tautan berhasil dihapus!');
    }

    /**
     * Toggle status aktif / nonaktif secara instan.
     */
    public function toggleStatus(ShortLink $shortLink): RedirectResponse
    {
        $shortLink->update([
            'is_active' => ! $shortLink->is_active,
        ]);

        $stateText = $shortLink->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return back()->with('status', "Tautan berhasil {$stateText}.");
    }

    /**
     * Tampilkan halaman detail QR Code untuk tautan tertentu.
     */
    public function qr(ShortLink $shortLink, QrCodeService $qrService): View
    {
        $svgQr = $qrService->svg($shortLink->short_url, 8);
        $pngQrBase64 = $qrService->png($shortLink->short_url, 10);

        return view('links.qr', compact('shortLink', 'svgQr', 'pngQrBase64'));
    }

    /**
     * Download file QR Code (SVG atau PNG).
     */
    public function downloadQr(ShortLink $shortLink, string $format, QrCodeService $qrService): Response
    {
        $filename = 'qrcode-' . Str::slug($shortLink->code);

        if ($format === 'svg') {
            $svgContent = $qrService->svg($shortLink->short_url, 10);

            return response($svgContent, 200, [
                'Content-Type' => 'image/svg+xml',
                'Content-Disposition' => "attachment; filename=\"{$filename}.svg\"",
            ]);
        }

        $rawPng = $qrService->rawPng($shortLink->short_url, 12);

        return response($rawPng, 200, [
            'Content-Type' => 'image/png',
            'Content-Disposition' => "attachment; filename=\"{$filename}.png\"",
        ]);
    }
}
