<?php

namespace App\Services;

use App\Models\Recipe;
use App\Models\RecipeView;
use App\Models\User;
use Carbon\Carbon;

class RecipeViewTrackingService
{
    public function track(Recipe $recipe, ?User $viewer, ?string $ipAddress, ?string $userAgent): array
    {
        $now = Carbon::now();
        $viewedOn = $now->toDateString();

        $viewQuery = RecipeView::query()
            ->where('recipe_id', $recipe->id)
            ->where('viewed_on', $viewedOn);

        $attributes = [
            'recipe_id' => $recipe->id,
            'user_agent' => $this->limitUserAgent($userAgent),
            'viewed_at' => $now,
            'viewed_on' => $viewedOn,
        ];

        if ($viewer) {
            $viewQuery->where('viewer_id', $viewer->id);
            $attributes['viewer_id'] = $viewer->id;
            $attributes['ip_hash'] = null;
        } else {
            $ipHash = $this->hashIp($ipAddress);

            if ($ipHash === null) {
                return [
                    'counted' => false,
                    'views_count' => (int) $recipe->views_count,
                    'unique_today' => $this->uniqueDailyCount($recipe, $viewedOn),
                ];
            }

            $viewQuery->where('ip_hash', $ipHash)->whereNull('viewer_id');
            $attributes['viewer_id'] = null;
            $attributes['ip_hash'] = $ipHash;
        }

        $view = $viewQuery->first();

        if ($view !== null) {
            $view->user_agent = $this->limitUserAgent($userAgent) ?? $view->user_agent;
            $view->viewed_at = $now;
            $view->save();

            return [
                'counted' => false,
                'views_count' => (int) $recipe->views_count,
                'unique_today' => $this->uniqueDailyCount($recipe, $viewedOn),
            ];
        }

        RecipeView::query()->create($attributes);

        $recipe->increment('views_count');
        $recipe->refresh();

        return [
            'counted' => true,
            'views_count' => (int) $recipe->views_count,
            'unique_today' => $this->uniqueDailyCount($recipe, $viewedOn),
        ];
    }

    public function uniqueDailyCount(Recipe $recipe, ?string $date = null): int
    {
        $viewedOn = $date ?? Carbon::now()->toDateString();

        return RecipeView::query()
            ->where('recipe_id', $recipe->id)
            ->where('viewed_on', $viewedOn)
            ->count();
    }

    private function hashIp(?string $ipAddress): ?string
    {
        if ($ipAddress === null || trim($ipAddress) === '') {
            return null;
        }

        return hash('sha256', trim($ipAddress));
    }

    private function limitUserAgent(?string $userAgent): ?string
    {
        if ($userAgent === null || trim($userAgent) === '') {
            return null;
        }

        return mb_substr(trim($userAgent), 0, 1024);
    }
}
