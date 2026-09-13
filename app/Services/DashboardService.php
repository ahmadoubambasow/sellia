<?php

namespace App\Services;

use App\Models\Shop;

class DashboardService
{
    public function __construct(
        private readonly SalesReportService $salesReportService,
        private readonly ProductReportService $productReportService,
        private readonly StockReportService $stockReportService
    ) {
    }

    public function getOverview(Shop $shop): array
    {
        $today = $this->salesReportService->getTodaySummary($shop);
        $yesterday = $this->salesReportService->getYesterdaySummary($shop);
        $dayBeforeYesterday = $this->salesReportService
            ->getDayBeforeYesterdaySummary($shop);

        $currentMonth = $this->salesReportService
            ->getCurrentMonthSummary($shop);

        $previousMonth = $this->salesReportService
            ->getPreviousMonthSummary($shop);

        $currentYear = $this->salesReportService
            ->getCurrentYearSummary($shop);

        return [
            'today' => $today,

            'yesterday' => $yesterday,

            'day_before_yesterday' => $dayBeforeYesterday,

            'current_month' => $currentMonth,

            'previous_month' => $previousMonth,

            'current_year' => $currentYear,

            'sales' => $this->salesReportService
                ->getSummary($shop),

            'evolution' => [
                'today_vs_yesterday' =>
                    $this->salesReportService->getRevenueEvolution(
                        $today,
                        $yesterday
                    ),

                'yesterday_vs_day_before_yesterday' =>
                    $this->salesReportService->getRevenueEvolution(
                        $yesterday,
                        $dayBeforeYesterday
                    ),

                'current_month_vs_previous_month' =>
                    $this->salesReportService->getRevenueEvolution(
                        $currentMonth,
                        $previousMonth
                    ),
            ],

            'revenue_last_seven_days' =>
                $this->salesReportService
                    ->getLastSevenDaysRevenue($shop),

            'top_products' =>
                $this->productReportService
                    ->getTopSellingProducts($shop),

            'low_stock_products' =>
                $this->stockReportService
                    ->getLowStockProducts($shop),

            'out_of_stock_products' =>
                $this->stockReportService
                    ->getOutOfStockProducts($shop),

            'stock' =>
                $this->stockReportService
                    ->getSummary($shop),
        ];
    }

    
}