<?php

namespace App\Services;

use App\Models\Recipe;
use App\Models\RecipeView;
use Carbon\Carbon;

class CreatorAnalyticsService
{
    public function summaryFor(int $creatorId): array
    {
        $totals = Recipe::query()
            ->ownedBy($creatorId)
            ->selectRaw('COUNT(*) as total_recipes, COALESCE(SUM(views_count), 0) as total_views')
            ->first();

        $totalRecipes = (int) ($totals?->total_recipes ?? 0);
        $totalViews = (int) ($totals?->total_views ?? 0);

        $uniqueAuthenticatedViewers = RecipeView::query()
            ->whereIn('recipe_id', $this->recipeIdSubquery($creatorId))
            ->whereNotNull('viewer_id')
            ->distinct('viewer_id')
            ->count('viewer_id');

        $uniqueGuestViewers = RecipeView::query()
            ->whereIn('recipe_id', $this->recipeIdSubquery($creatorId))
            ->whereNull('viewer_id')
            ->whereNotNull('ip_hash')
            ->distinct('ip_hash')
            ->count('ip_hash');

        $uniqueViewers = (int) ($uniqueAuthenticatedViewers + $uniqueGuestViewers);

        $topRecipe = Recipe::query()
            ->ownedBy($creatorId)
            ->select(['id', 'title', 'slug', 'views_count'])
            ->orderByDesc('views_count')
            ->orderByDesc('id')
            ->first();

        $today = Carbon::now()->endOfDay();
        $currentPeriodStart = $today->copy()->startOfDay()->subDays(6);
        $previousPeriodStart = $currentPeriodStart->copy()->subDays(7);
        $previousPeriodEnd = $currentPeriodStart->copy()->subSecond();

        $viewsLast7Days = RecipeView::query()
            ->whereIn('recipe_id', $this->recipeIdSubquery($creatorId))
            ->whereBetween('viewed_at', [$currentPeriodStart, $today])
            ->count();

        $viewsPrevious7Days = RecipeView::query()
            ->whereIn('recipe_id', $this->recipeIdSubquery($creatorId))
            ->whereBetween('viewed_at', [$previousPeriodStart, $previousPeriodEnd])
            ->count();

        $averageViewsPerRecipe = $totalRecipes > 0
            ? round($totalViews / $totalRecipes, 2)
            : 0.0;

        $growthPercentage = $this->growthPercentage($viewsLast7Days, $viewsPrevious7Days);

        return [
            'total_recipes' => $totalRecipes,
            'total_views' => $totalViews,
            'unique_viewers' => $uniqueViewers,
            'avg_views_per_recipe' => $averageViewsPerRecipe,
            'top_recipe' => $topRecipe ? [
                'id' => $topRecipe->id,
                'title' => $topRecipe->title,
                'slug' => $topRecipe->slug,
                'views_count' => (int) $topRecipe->views_count,
            ] : null,
            'views_last_7_days' => (int) $viewsLast7Days,
            'views_previous_7_days' => (int) $viewsPrevious7Days,
            'growth_percentage' => $growthPercentage,
        ];
    }

    private function recipeIdSubquery(int $creatorId)
    {
        return Recipe::query()
            ->ownedBy($creatorId)
            ->select('id');
    }

    private function growthPercentage(int $current, int $previous): float
    {
        if ($previous === 0) {
            return $current > 0 ? 100.0 : 0.0;
        }

        return round((($current - $previous) / $previous) * 100, 2);
    }
}
