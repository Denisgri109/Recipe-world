<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Recipe;
use App\Services\CreatorAnalyticsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreatorAnalyticsController extends Controller
{
    public function summary(Request $request, CreatorAnalyticsService $creatorAnalyticsService): JsonResponse
    {
        $this->authorize('viewAny', Recipe::class);

        $summary = $creatorAnalyticsService->summaryFor((int) $request->user()->id);

        return response()->json([
            'data' => $summary,
        ]);
    }
}
