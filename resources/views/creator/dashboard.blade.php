@extends('layouts.app')

@section('title', 'Creator Dashboard')

@section('content')
<div class="orders-hero position-relative">
    <div class="container hero-content">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
            <div>
                <h1 class="mb-1"><i class="bi bi-speedometer2 me-2"></i>Creator Dashboard</h1>
                <p class="mb-0">Track your recipe performance, audience, and earnings.</p>
            </div>
        </div>
    </div>
    <div class="browse-wave position-absolute bottom-0 w-100">
        <svg viewBox="0 0 1440 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" style="width:100%; height:60px; display:block;">
            <path d="M0,30 C480,70 960,0 1440,30 L1440,60 L0,60 Z" fill="#FFFCF8"/>
        </svg>
    </div>
</div>

<div class="container py-4 py-md-5">    <div id="dashboard-error" class="alert alert-danger d-none border-0 shadow-sm rounded-4" role="alert"></div>

    <div id="dashboard-loading" class="row g-4" aria-live="polite">
        @for ($i = 0; $i < 4; $i++)
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-4">
                        <div class="placeholder-glow">
                            <span class="placeholder col-7 mb-3 rounded"></span>
                            <span class="placeholder placeholder-lg col-5 mb-3 rounded"></span>
                            <span class="placeholder col-9 rounded"></span>
                        </div>
                    </div>
                </div>
            </div>
        @endfor
    </div>

    <div id="dashboard-empty" class="alert alert-info d-none mb-5 border-0 shadow-sm rounded-4 p-4 d-flex align-items-center gap-3" role="alert">
        <i class="bi bi-info-circle-fill fs-3 text-info"></i>
        <div>
            <h5 class="mb-1 fw-bold text-dark">No creator stats yet</h5>
            <p class="mb-0 text-secondary">Publish a recipe and share it to start seeing dashboard insights.</p>
        </div>
    </div>

    <div id="dashboard-content" class="d-none">
        <div class="row g-4 mb-5">
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card border-0 shadow-sm rounded-4 h-100 position-relative overflow-hidden bg-white">
                    <div class="position-absolute top-0 start-0 w-100 h-100 opacity-10" style="background: linear-gradient(135deg, var(--bs-primary) 0%, transparent 100%);"></div>
                    <div class="card-body p-4 position-relative z-1">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <p class="text-secondary fw-semibold mb-0 text-uppercase tracking-wide" style="font-size: 0.8rem; letter-spacing: 1px;">Recipes Created</p>
                            <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                <i class="bi bi-journal-text fs-4"></i>
                            </div>
                        </div>
                        <p id="kpi-total-recipes" class="display-5 fw-bold text-dark mb-0">0</p>
                    </div>
                </div>
            </div>
            
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card border-0 shadow-sm rounded-4 h-100 position-relative overflow-hidden bg-white">
                    <div class="position-absolute top-0 start-0 w-100 h-100 opacity-10" style="background: linear-gradient(135deg, var(--bs-success) 0%, transparent 100%);"></div>
                    <div class="card-body p-4 position-relative z-1">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <p class="text-secondary fw-semibold mb-0 text-uppercase tracking-wide" style="font-size: 0.8rem; letter-spacing: 1px;">Total Views</p>
                            <div class="bg-success bg-opacity-10 text-success rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                <i class="bi bi-eye fs-4"></i>
                            </div>
                        </div>
                        <p id="kpi-total-views" class="display-5 fw-bold text-dark mb-0">0</p>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card border-0 shadow-sm rounded-4 h-100 position-relative overflow-hidden bg-white">
                    <div class="position-absolute top-0 start-0 w-100 h-100 opacity-10" style="background: linear-gradient(135deg, var(--bs-info) 0%, transparent 100%);"></div>
                    <div class="card-body p-4 position-relative z-1">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <p class="text-secondary fw-semibold mb-0 text-uppercase tracking-wide" style="font-size: 0.8rem; letter-spacing: 1px;">Unique Viewers</p>
                            <div class="bg-info bg-opacity-10 text-info rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                <i class="bi bi-people fs-4"></i>
                            </div>
                        </div>
                        <p id="kpi-unique-viewers" class="display-5 fw-bold text-dark mb-0">0</p>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card border-0 shadow-sm rounded-4 h-100 position-relative overflow-hidden bg-white">
                    <div class="position-absolute top-0 start-0 w-100 h-100 opacity-10" style="background: linear-gradient(135deg, var(--bs-warning) 0%, transparent 100%);"></div>
                    <div class="card-body p-4 position-relative z-1">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <p class="text-secondary fw-semibold mb-0 text-uppercase tracking-wide" style="font-size: 0.8rem; letter-spacing: 1px;">Total Revenue</p>
                            <div class="bg-warning bg-opacity-10 text-warning rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                <i class="bi bi-currency-dollar fs-4"></i>
                            </div>
                        </div>
                        <p id="kpi-total-revenue" class="display-5 fw-bold text-dark mb-0">0.0000</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-12 col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">
                    <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                        <h2 class="h5 fw-bold text-dark mb-0 d-flex align-items-center gap-2">
                            <i class="bi bi-graph-up-arrow text-primary"></i> 7-Day Growth
                        </h2>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <p id="kpi-growth" class="display-6 fw-bold mb-0">0%</p>
                            <div class="bg-light rounded-pill px-3 py-1">
                                <span class="fw-medium text-secondary" style="font-size: 0.85rem">Trend</span>
                            </div>
                        </div>
                        <p class="text-secondary mb-0">
                            Views in last 7 days: <span id="kpi-last-7-views" class="fw-bold text-dark">0</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">
                    <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                        <h2 class="h5 fw-bold text-dark mb-0 d-flex align-items-center gap-2">
                            <i class="bi bi-trophy text-warning"></i> Top Performing Recipe
                        </h2>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center text-primary fw-bold" style="width: 56px; height: 56px; font-size: 1.5rem;">
                                1
                            </div>
                            <div>
                                <p id="kpi-top-recipe-title" class="fw-bold text-dark fs-5 mb-0 text-truncate" style="max-width: 300px;">No recipe data yet</p>
                                <p class="text-secondary mb-0">Overall highest views</p>
                            </div>
                        </div>
                        <div class="bg-light rounded-3 p-3 d-flex justify-content-between align-items-center mt-auto">
                            <span class="text-secondary fw-medium">Total Views</span>
                            <span id="kpi-top-recipe-views" class="fw-bold text-dark fs-5">0</span>
                        </div>
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
