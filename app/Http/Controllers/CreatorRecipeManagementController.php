<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CreatorRecipeManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request): View
    {
        $validated = $request->validate([
            'search' => 'sometimes|string|max:255',
            'status' => 'sometimes|in:all,published,draft',
            'sort' => 'sometimes|in:updated_desc,updated_asc,views_desc,views_asc,unique_viewers_desc,revenue_desc,title_asc,title_desc',
            'per_page' => 'sometimes|integer|min:5|max:50',
        ]);

        $status = $validated['status'] ?? 'all';
        $sort = $validated['sort'] ?? 'updated_desc';
        $perPage = (int) ($validated['per_page'] ?? 10);
        $currency = strtoupper((string) config('app.currency', 'EUR'));

        $query = Recipe::query()
            ->ownedBy((int) $request->user()->id)
            ->withCount('views as unique_viewers_count')
            ->withSum([
                'monetizationEvents as revenue_total' => function ($sumQuery) use ($currency) {
                    $sumQuery->where('currency', $currency);
                },
            ], 'amount');

        if (!empty($validated['search'])) {
            $search = trim((string) $validated['search']);
            $query->where(function ($subQuery) use ($search) {
                $subQuery->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        if ($status === 'published') {
            $query->where('is_draft', false);
        }

        if ($status === 'draft') {
            $query->where('is_draft', true);
        }

        $query = match ($sort) {
            'updated_asc' => $query->orderBy('updated_at'),
            'views_desc' => $query->orderByDesc('views_count')->orderByDesc('id'),
            'views_asc' => $query->orderBy('views_count')->orderBy('id'),
            'unique_viewers_desc' => $query->orderByDesc('unique_viewers_count')->orderByDesc('id'),
            'revenue_desc' => $query->orderByDesc('revenue_total')->orderByDesc('id'),
            'title_asc' => $query->orderBy('title'),
            'title_desc' => $query->orderByDesc('title'),
            default => $query->orderByDesc('updated_at'),
        };

        $recipes = $query->paginate($perPage)->appends($request->query());

        return view('creator.recipes.index', [
            'recipes' => $recipes,
            'status' => $status,
            'sort' => $sort,
            'perPage' => $perPage,
            'currency' => $currency,
            'search' => $validated['search'] ?? '',
        ]);
    }
}
