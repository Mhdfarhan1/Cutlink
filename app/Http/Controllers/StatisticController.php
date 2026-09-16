<?php

namespace App\Http\Controllers;

use App\Models\LinkClick;
use App\Models\ShortLink;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StatisticController extends Controller
{
    /**
     * Tampilkan halaman analitik dan statistik lengkap dengan pencarian, filter entri, dan paginasi.
     */
    public function index(Request $request): View
    {
        $selectedLinkId = $request->query('link_id');
        $search = $request->query('search');
        $perPage = (int) $request->query('per_page', 10);
        $perPage = in_array($perPage, [10, 25, 50, 100], true) ? $perPage : 10;

        $linksQuery = ShortLink::orderByDesc('clicks_count');
        $allLinks = $linksQuery->get();

        $selectedLink = null;
        if ($selectedLinkId) {
            $selectedLink = ShortLink::find($selectedLinkId);
        }

        // Query dasar untuk metrik agregat
        $clickQuery = LinkClick::query();
        if ($selectedLink) {
            $clickQuery->where('short_link_id', $selectedLink->id);
        }

        $totalClicks = (clone $clickQuery)->count();
        $clicksToday = (clone $clickQuery)->where('created_at', '>=', Carbon::today())->count();
        $clicks7Days = (clone $clickQuery)->where('created_at', '>=', Carbon::today()->subDays(6))->count();
        $clicks30Days = (clone $clickQuery)->where('created_at', '>=', Carbon::today()->subDays(29))->count();

        // Grafik harian 14 hari terakhir
        $startDate = Carbon::today()->subDays(13);
        $rawClicks = (clone $clickQuery)
            ->where('created_at', '>=', $startDate->startOfDay())
            ->selectRaw('DATE(created_at) as date, count(*) as count')
            ->groupBy('date')
            ->pluck('count', 'date')
            ->toArray();

        $dailyStats = [];
        for ($i = 13; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i)->toDateString();
            $label = Carbon::today()->subDays($i)->locale('id')->isoFormat('D MMM');
            $dailyStats[] = [
                'date' => $date,
                'label' => $label,
                'count' => $rawClicks[$date] ?? 0,
            ];
        }

        $maxClick = max(array_column($dailyStats, 'count'));
        $maxClick = $maxClick > 0 ? $maxClick : 1;

        // Query untuk tabel riwayat klik dengan filter pencarian & paginasi
        $tableQuery = (clone $clickQuery)->with('shortLink')->latest('created_at');

        if (! empty($search)) {
            $tableQuery->where(function ($q) use ($search) {
                $q->where('ip_address', 'like', "%{$search}%")
                    ->orWhere('user_agent', 'like', "%{$search}%")
                    ->orWhere('referer', 'like', "%{$search}%")
                    ->orWhereHas('shortLink', function ($sq) use ($search) {
                        $sq->where('name', 'like', "%{$search}%")
                            ->orWhere('code', 'like', "%{$search}%");
                    });
            });
        }

        $recentClicks = $tableQuery->paginate($perPage)->withQueryString();

        return view('statistics.index', compact(
            'allLinks',
            'selectedLink',
            'totalClicks',
            'clicksToday',
            'clicks7Days',
            'clicks30Days',
            'dailyStats',
            'maxClick',
            'recentClicks',
            'perPage',
            'search'
        ));
    }
}
