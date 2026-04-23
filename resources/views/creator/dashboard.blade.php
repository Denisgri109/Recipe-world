@extends('layouts.app')

@section('title', 'Creator Dashboard')

@section('content')
<div class="container py-4 py-md-5">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h1 class="h2 fw-bold mb-1">Creator Dashboard</h1>
            <p class="text-muted mb-0">Track your recipe performance, audience, and earnings.</p>
        </div>
        <a href="{{ route('recipes.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i>Create Recipe
        </a>
    </div>

    <div id="dashboard-error" class="alert alert-danger d-none" role="alert"></div>

    <div id="dashboard-loading" class="row g-3 g-md-4" aria-live="polite">
        @for ($i = 0; $i < 4; $i++)
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="placeholder-glow">
                            <span class="placeholder col-7 mb-3"></span>
                            <span class="placeholder placeholder-lg col-5 mb-3"></span>
                            <span class="placeholder col-9"></span>
                        </div>
                    </div>
                </div>
            </div>
        @endfor
    </div>

    <div id="dashboard-empty" class="alert alert-info d-none mb-4" role="alert">
        No creator stats yet. Publish a recipe and share it to start seeing dashboard insights.
    </div>

    <div id="dashboard-content" class="d-none">
        <div class="row g-3 g-md-4 mb-4">
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <p class="text-muted mb-2">Recipes Created</p>
                        <p id="kpi-total-recipes" class="display-6 fw-bold mb-0">0</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <p class="text-muted mb-2">Total Views</p>
                        <p id="kpi-total-views" class="display-6 fw-bold mb-0">0</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <p class="text-muted mb-2">Unique Viewers</p>
                        <p id="kpi-unique-viewers" class="display-6 fw-bold mb-0">0</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <p class="text-muted mb-2">Total Revenue</p>
                        <p id="kpi-total-revenue" class="display-6 fw-bold mb-0">0.0000</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-3 g-md-4">
            <div class="col-12 col-lg-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <h2 class="h5 mb-3">7-Day Growth</h2>
                        <p id="kpi-growth" class="h3 mb-1 fw-bold">0%</p>
                        <p class="text-muted mb-0">
                            Views in last 7 days: <span id="kpi-last-7-views" class="fw-semibold">0</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <h2 class="h5 mb-3">Top Performing Recipe</h2>
                        <p id="kpi-top-recipe-title" class="fw-semibold mb-1">No recipe data yet</p>
                        <p class="text-muted mb-0">
                            Views: <span id="kpi-top-recipe-views" class="fw-semibold">0</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', async () => {
        const loadingEl = document.getElementById('dashboard-loading');
        const contentEl = document.getElementById('dashboard-content');
        const emptyEl = document.getElementById('dashboard-empty');
        const errorEl = document.getElementById('dashboard-error');

        try {
            const response = await fetch("{{ route('creator.dashboard.summary') }}", {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
                credentials: 'same-origin',
            });

            if (!response.ok) {
                throw new Error('Unable to load creator dashboard data.');
            }

            const payload = await response.json();
            const data = payload.data ?? {};

            const totalRecipes = Number(data.total_recipes ?? 0);
            const totalViews = Number(data.total_views ?? 0);
            const uniqueViewers = Number(data.unique_viewers ?? 0);
            const growthPercentage = Number(data.growth_percentage ?? 0);
            const last7Views = Number(data.views_last_7_days ?? 0);
            const topRecipe = data.top_recipe ?? null;
            const currency = (data.currency ?? 'EUR').toUpperCase();
            const totalRevenue = String(data.total_revenue ?? '0.0000');

            const isEmpty = totalRecipes === 0 && totalViews === 0 && uniqueViewers === 0;

            document.getElementById('kpi-total-recipes').textContent = totalRecipes.toLocaleString();
            document.getElementById('kpi-total-views').textContent = totalViews.toLocaleString();
            document.getElementById('kpi-unique-viewers').textContent = uniqueViewers.toLocaleString();
            document.getElementById('kpi-total-revenue').textContent = `${currency} ${totalRevenue}`;
            document.getElementById('kpi-last-7-views').textContent = last7Views.toLocaleString();

            const growthEl = document.getElementById('kpi-growth');
            growthEl.textContent = `${growthPercentage.toFixed(2)}%`;
            growthEl.classList.remove('text-success', 'text-danger', 'text-muted');
            if (growthPercentage > 0) {
                growthEl.classList.add('text-success');
            } else if (growthPercentage < 0) {
                growthEl.classList.add('text-danger');
            } else {
                growthEl.classList.add('text-muted');
            }

            const topTitleEl = document.getElementById('kpi-top-recipe-title');
            const topViewsEl = document.getElementById('kpi-top-recipe-views');
            if (topRecipe && topRecipe.title) {
                topTitleEl.textContent = topRecipe.title;
                topViewsEl.textContent = Number(topRecipe.views_count ?? 0).toLocaleString();
            } else {
                topTitleEl.textContent = 'No recipe data yet';
                topViewsEl.textContent = '0';
            }

            loadingEl.classList.add('d-none');
            if (isEmpty) {
                emptyEl.classList.remove('d-none');
            } else {
                contentEl.classList.remove('d-none');
            }
        } catch (error) {
            loadingEl.classList.add('d-none');
            errorEl.textContent = error.message || 'Failed to load dashboard.';
            errorEl.classList.remove('d-none');
        }
    });
</script>
@endsection
