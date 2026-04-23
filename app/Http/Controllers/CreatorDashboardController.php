<?php

namespace App\Http\Controllers;

use App\Services\CreatorAnalyticsService;
use App\Services\MonetizationAggregationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CreatorDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): View
    {
        return view('creator.dashboard');
    }

    public function summary(
        Request $request,
        CreatorAnalyticsService $creatorAnalyticsService,
        MonetizationAggregationService $monetizationAggregationService
    ): JsonResponse {
        $validated = $request->validate([
            'currency' => 'sometimes|string|size:3',
        ]);

        $creatorId = (int) $request->user()->id;
        $currency = strtoupper($validated['currency'] ?? config('app.currency', 'EUR'));

        $analyticsSummary = $creatorAnalyticsService->summaryFor($creatorId);
        $revenueByCurrency = $monetizationAggregationService->totalRevenueByCurrency($creatorId);
        $totalRevenue = $revenueByCurrency[$currency]
            ?? $monetizationAggregationService->totalRevenue($creatorId, $currency);

        return response()->json([
            'data' => [
                'total_recipes' => (int) $analyticsSummary['total_recipes'],
                'total_views' => (int) $analyticsSummary['total_views'],
                'unique_viewers' => (int) $analyticsSummary['unique_viewers'],
                'total_revenue' => $totalRevenue,
                'currency' => $currency,
                'growth_percentage' => (float) $analyticsSummary['growth_percentage'],
                'views_last_7_days' => (int) $analyticsSummary['views_last_7_days'],
                'top_recipe' => $analyticsSummary['top_recipe'],
                'revenue_by_currency' => $revenueByCurrency,
            ],
        ]);
    }
}
