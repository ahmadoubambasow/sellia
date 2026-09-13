<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(
        private readonly DashboardService $dashboardService
    ) {
    }

    public function index(): View
    {
        $shop = auth()->user()->shop;

        $overview = $this->dashboardService
            ->getOverview($shop);

        return view('dashboard', compact('overview'));
    }
}