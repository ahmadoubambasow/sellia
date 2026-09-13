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
        return [
            'today' => $this->salesReportService
                ->getTodaySummary($shop),

            'yesterday' => $this->salesReportService
                ->getYesterdaySummary($shop),

            'day_before_yesterday' => $this->salesReportService
                ->getDayBeforeYesterdaySummary($shop),

            'current_month' => $this->salesReportService
                ->getCurrentMonthSummary($shop),

            'previous_month' => $this->salesReportService
                ->getPreviousMonthSummary($shop),

            'current_year' => $this->salesReportService
                ->getCurrentYearSummary($shop),

            'sales' => $this->salesReportService
                ->getSummary($shop),

            'top_products' => $this->productReportService
                ->getTopSellingProducts($shop),
            
            'low_stock_products' => $this->stockReportService
                ->getLowStockProducts($shop),

            'out_of_stock_products' => $this->stockReportService
                ->getOutOfStockProducts($shop),

            'stock' => $this->stockReportService
                ->getSummary($shop),
        ];
    }

    
}