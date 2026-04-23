<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Recipe;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreatorRecipeController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $this->authorize('viewAny', Recipe::class);

        $validated = $request->validate([
            'sort' => 'sometimes|in:newest,most_viewed',
            'per_page' => 'sometimes|integer|min:1|max:100',
        ]);

        $sort = $validated['sort'] ?? 'newest';
        $perPage = $validated['per_page'] ?? 10;

        $recipes = Recipe::query()
            ->ownedBy((int) $request->user()->id)
            ->with('category')
            ->sortForCreator($sort)
            ->paginate($perPage)
            ->appends($request->query());

        return response()->json([
            'data' => $recipes->getCollection()->map(function (Recipe $recipe): array {
                return [
                    'id' => $recipe->id,
                    'title' => $recipe->title,
                    'slug' => $recipe->slug,
                    'description' => $recipe->description,
                    'difficulty' => $recipe->difficulty,
                    'is_draft' => (bool) $recipe->is_draft,
                    'views_count' => (int) $recipe->views_count,
                    'category' => $recipe->category ? [
                        'id' => $recipe->category->id,
                        'name' => $recipe->category->name,
                    ] : null,
                    'created_at' => optional($recipe->created_at)->toISOString(),
                    'updated_at' => optional($recipe->updated_at)->toISOString(),
                ];
            })->values(),
            'meta' => [
                'current_page' => $recipes->currentPage(),
                'from' => $recipes->firstItem(),
                'last_page' => $recipes->lastPage(),
                'path' => $recipes->path(),
                'per_page' => $recipes->perPage(),
                'to' => $recipes->lastItem(),
                'total' => $recipes->total(),
                'sort' => $sort,
            ],
            'links' => [
                'first' => $recipes->url(1),
                'last' => $recipes->url($recipes->lastPage()),
                'prev' => $recipes->previousPageUrl(),
                'next' => $recipes->nextPageUrl(),
            ],
        ]);
    }
}
