<?php

namespace App\Services;

use App\Models\Shop;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class SalesReportService
{
    /**
     * Résumé global des ventes.
     */
    public function getSummary(Shop $shop): array
    {
        $baseQuery = $shop->sales()
            ->where('status', 'completed');

        $totalSales = (clone $baseQuery)->count();

        $totalRevenue = (clone $baseQuery)->sum('total');

        $totalPaid = (clone $baseQuery)->sum('amount_paid');

        $totalRemaining = max(
            0,
            (float) $totalRevenue - (float) $totalPaid
        );

        return [
            'total_sales' => $totalSales,

            'total_revenue' => (float) $totalRevenue,

            'total_paid' => (float) $totalPaid,

            'total_remaining' => $totalRemaining,

            'paid_sales' => (clone $baseQuery)
                ->where('payment_status', 'paid')
                ->count(),

            'partial_sales' => (clone $baseQuery)
                ->where('payment_status', 'partial')
                ->count(),

            'unpaid_sales' => (clone $baseQuery)
                ->where('payment_status', 'unpaid')
                ->count(),

            'cancelled_sales' => $shop->sales()
                ->where('status', 'cancelled')
                ->count(),
        ];
    }

    /**
     * Résumé des ventes pour une période donnée.
     */
    public function getPeriodSummary(
        Shop $shop,
        $from,
        $to
    ): array {
        $query = $shop->sales()
            ->where('status', 'completed')
            ->whereBetween('sold_at', [$from, $to]);

        return [
            'sales_count' => (clone $query)->count(),

            'revenue' => (float) (clone $query)
                ->sum('total'),

            'amount_paid' => (float) (clone $query)
                ->sum('amount_paid'),

            'remaining' => (float) (
                (clone $query)->sum('total')
                - (clone $query)->sum('amount_paid')
            ),
        ];
    }

    public function getTodaySummary(Shop $shop): array
    {
        return $this->getPeriodSummary(
            $shop,
            Carbon::today()->startOfDay(),
            Carbon::today()->endOfDay()
        );
    }

    public function getYesterdaySummary(Shop $shop): array
    {
        $yesterday = Carbon::yesterday();

        return $this->getPeriodSummary(
            $shop,
            $yesterday->copy()->startOfDay(),
            $yesterday->copy()->endOfDay()
        );
    }

    public function getDayBeforeYesterdaySummary(Shop $shop): array
    {
        $day = Carbon::today()->subDays(2);

        return $this->getPeriodSummary(
            $shop,
            $day->copy()->startOfDay(),
            $day->copy()->endOfDay()
        );
    }

    public function getCurrentMonthSummary(Shop $shop): array
    {
        $month = Carbon::today();

        return $this->getPeriodSummary(
            $shop,
            $month->copy()->startOfMonth(),
            $month->copy()->endOfMonth()
        );
    }

    public function getPreviousMonthSummary(Shop $shop): array
    {
        $month = Carbon::today()->subMonth();

        return $this->getPeriodSummary(
            $shop,
            $month->copy()->startOfMonth(),
            $month->copy()->endOfMonth()
        );
    }

    public function getCurrentYearSummary(Shop $shop): array
    {
        $year = Carbon::today();

        return $this->getPeriodSummary(
            $shop,
            $year->copy()->startOfYear(),
            $year->copy()->endOfYear()
        );
    }

    public function getLastSevenDaysRevenue(Shop $shop): Collection
    {
        $startDate = Carbon::today()->subDays(6)->startOfDay();
        $endDate = Carbon::today()->endOfDay();

        $sales = $shop->sales()
            ->where('status', 'completed')
            ->whereBetween('sold_at', [$startDate, $endDate])
            ->selectRaw('DATE(sold_at) as sale_date, SUM(total) as revenue')
            ->groupBy('sale_date')
            ->orderBy('sale_date')
            ->get()
            ->keyBy('sale_date');

        return collect(range(6, 0))
            ->map(function (int $daysAgo) use ($sales) {
                $date = Carbon::today()->subDays($daysAgo);
                $key = $date->toDateString();

                return [
                    'date' => $key,
                    'label' => $date->translatedFormat('D d'),
                    'revenue' => (float) ($sales->get($key)?->revenue ?? 0),
            ];
        });
    }

    public function getRevenueEvolution(
        array $currentPeriod,
        array $previousPeriod
    ): ?float {
        return $this->calculateEvolution(
            (float) $currentPeriod['revenue'],
            (float) $previousPeriod['revenue']
        );
    }

    private function calculateEvolution(
        float $current,
        float $previous
    ): ?float {
        if ($previous === 0.0) {
            return $current > 0 ? null : 0.0;
        }

        return round(
            (($current - $previous) / $previous) * 100,
            1
        );
    }
}