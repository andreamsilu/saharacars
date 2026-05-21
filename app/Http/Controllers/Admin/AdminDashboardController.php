<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Inquiry;
use App\Models\SiteVisitor;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;

class AdminDashboardController extends Controller
{
    public function index(): View
    {
        $carsTotal = Car::query()->count();
        $featuredTotal = Car::query()->where('is_featured', true)->count();
        $publishedTotal = Car::query()->where('is_published', true)->count();
        $draftTotal = Car::query()->where('is_published', false)->count();

        $monthlyRevenue = (int) Car::query()
            ->where('is_published', true)
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('price_tzs');
        $totalVisitors = SiteVisitor::query()->count();
        $visitorsToday = SiteVisitor::query()
            ->whereDate('last_seen_at', now()->toDateString())
            ->count();
        $visitors7Days = SiteVisitor::query()
            ->where('last_seen_at', '>=', now()->copy()->subDays(7)->startOfDay())
            ->count();
        $visitorsMonth = SiteVisitor::query()
            ->where('last_seen_at', '>=', now()->copy()->subMonth()->startOfDay())
            ->count();
        $visitors6Months = SiteVisitor::query()
            ->where('last_seen_at', '>=', now()->copy()->subMonths(6)->startOfDay())
            ->count();
        $visitorsYear = SiteVisitor::query()
            ->where('last_seen_at', '>=', now()->copy()->subYear()->startOfDay())
            ->count();
        $countVisitorsBetween = static fn (Carbon $from, Carbon $to): int => SiteVisitor::query()
            ->where('last_seen_at', '>=', $from)
            ->where('last_seen_at', '<', $to)
            ->count();
        $buildTrend = static function (int $current, int $previous): array {
            $delta = $current - $previous;
            $direction = $delta > 0 ? 'up' : ($delta < 0 ? 'down' : 'flat');
            $percent = $previous > 0
                ? round(($delta / $previous) * 100, 1)
                : ($current > 0 ? 100.0 : 0.0);

            return [
                'delta' => $delta,
                'direction' => $direction,
                'percent' => $percent,
            ];
        };

        $startOfToday = now()->copy()->startOfDay();
        $startOfTomorrow = now()->copy()->addDay()->startOfDay();
        $startOfYesterday = now()->copy()->subDay()->startOfDay();

        $start7Days = now()->copy()->subDays(7)->startOfDay();
        $start14Days = now()->copy()->subDays(14)->startOfDay();

        $start1Month = now()->copy()->subMonth()->startOfDay();
        $start2Months = now()->copy()->subMonths(2)->startOfDay();

        $start6Months = now()->copy()->subMonths(6)->startOfDay();
        $start12Months = now()->copy()->subMonths(12)->startOfDay();

        $start1Year = now()->copy()->subYear()->startOfDay();
        $start2Years = now()->copy()->subYears(2)->startOfDay();

        $visitorsTodayTrend = $buildTrend(
            $countVisitorsBetween($startOfToday, $startOfTomorrow),
            $countVisitorsBetween($startOfYesterday, $startOfToday)
        );
        $visitors7DaysTrend = $buildTrend(
            $countVisitorsBetween($start7Days, now()),
            $countVisitorsBetween($start14Days, $start7Days)
        );
        $visitorsMonthTrend = $buildTrend(
            $countVisitorsBetween($start1Month, now()),
            $countVisitorsBetween($start2Months, $start1Month)
        );
        $visitors6MonthsTrend = $buildTrend(
            $countVisitorsBetween($start6Months, now()),
            $countVisitorsBetween($start12Months, $start6Months)
        );
        $visitorsYearTrend = $buildTrend(
            $countVisitorsBetween($start1Year, now()),
            $countVisitorsBetween($start2Years, $start1Year)
        );

        $recentCars = Car::query()->latest()->limit(8)->get();
        $pendingOrderRequestsCount = Inquiry::query()
            ->where('inquiry_type', 'order_request')
            ->where('status', Inquiry::STATUS_PENDING)
            ->count();
        $latestOrderRequests = Inquiry::query()
            ->where('inquiry_type', 'order_request')
            ->latest()
            ->limit(5)
            ->get();

        return view('admin.dashboard', [
            'carsTotal' => $carsTotal,
            'featuredTotal' => $featuredTotal,
            'publishedTotal' => $publishedTotal,
            'draftTotal' => $draftTotal,
            'monthlyRevenue' => $monthlyRevenue,
            'totalVisitors' => $totalVisitors,
            'visitorsToday' => $visitorsToday,
            'visitors7Days' => $visitors7Days,
            'visitorsMonth' => $visitorsMonth,
            'visitors6Months' => $visitors6Months,
            'visitorsYear' => $visitorsYear,
            'visitorsTodayTrend' => $visitorsTodayTrend,
            'visitors7DaysTrend' => $visitors7DaysTrend,
            'visitorsMonthTrend' => $visitorsMonthTrend,
            'visitors6MonthsTrend' => $visitors6MonthsTrend,
            'visitorsYearTrend' => $visitorsYearTrend,
            'recentCars' => $recentCars,
            'pendingOrderRequestsCount' => $pendingOrderRequestsCount,
            'latestOrderRequests' => $latestOrderRequests,
        ]);
    }
}
