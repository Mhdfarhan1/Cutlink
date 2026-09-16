<?php

namespace App\Http\Controllers;

use App\Models\LinkClick;
use App\Models\ShortLink;
use Carbon\Carbon;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Tampilkan ringkasan metrik dashboard utama.
     */
    public function index(): View
    {
        $totalLinks = ShortLink::count();
        $totalClicks = (int) ShortLink::sum('clicks_count');
        $activeLinks = ShortLink::where('is_active', true)->count();
        $inactiveLinks = ShortLink::where('is_active', false)->count();

        // 5 Tautan terbaru
        $recentLinks = ShortLink::latest()->take(5)->get();

        // 5 Tautan terpopuler berdasarkan jumlah klik
        $popularLinks = ShortLink::orderByDesc('clicks_count')->take(5)->get();

        // Grafik klik 7 hari terakhir
        $startDate = Carbon::today()->subDays(6);
        $rawClicks = LinkClick::where('created_at', '>=', $startDate->startOfDay())
            ->selectRaw('DATE(created_at) as date, count(*) as count')
            ->groupBy('date')
            ->pluck('count', 'date')
            ->toArray();

        $dailyClicks = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i)->toDateString();
            $label = Carbon::today()->subDays($i)->locale('id')->isoFormat('D MMM');
            $dailyClicks[] = [
                'date' => $date,
                'label' => $label,
                'count' => $rawClicks[$date] ?? 0,
            ];
        }

        $maxClick = max(array_column($dailyClicks, 'count'));
        $maxClick = $maxClick > 0 ? $maxClick : 1;

        return view('dashboard', compact(
            'totalLinks',
            'totalClicks',
            'activeLinks',
            'inactiveLinks',
            'recentLinks',
            'popularLinks',
            'dailyClicks',
            'maxClick'
        ));
    }
}
