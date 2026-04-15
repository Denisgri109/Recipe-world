@extends('layouts.app')

@section('content')
{{-- ─── Browse Header ─────────────────────────────────────── --}}
<div class="browse-header">
    <div class="container hero-content">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
            <div>
                <h1 class="mb-1"><i class="bi bi-book me-2"></i>Browse Recipes</h1>
                <p class="mb-0">Discover delicious recipes from our community</p>
            </div>
            @auth
                <a href="{{ route('recipes.create') }}" class="btn-hero btn-white btn-hero-sm">
                    <i class="bi bi-plus-circle me-2"></i>Create New Recipe
                </a>
            @endauth
        </div>
    </div>
    <div class="browse-wave">
        <svg viewBox="0 0 1440 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0,30 C480,70 960,0 1440,30 L1440,60 L0,60 Z" fill="#FFFCF8"/>
        </svg>
    </div>
</div>

{{-- ─── Filter Bar ────────────────────────────────────────── --}}
<div class="container">
    <div class="filter-bar">
        <form action="{{ route('recipes.index') }}" method="GET">
            <div class="row g-3 align-items-end">
                <div class="col-12 col-md-5">
                    <label class="filter-label">Search</label>
                    <div class="input-group">
                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Search by title or description..."
                            value="{{ request('search') }}"
                        >
                        <button type="submit" class="btn btn-search">
                            <i class="bi bi-search me-1"></i> Search
                        </button>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <label class="filter-label" for="category">Category</label>
                    <select name="category" id="category" class="form-select" onchange="this.form.submit()">
                        <option value="">All Categories</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-6 col-md-3">
                    <label class="filter-label" for="difficulty">Difficulty</label>
                    <select name="difficulty" id="difficulty" class="form-select" onchange="this.form.submit()">
                        <option value="">All Difficulties</option>
                        <option value="easy" {{ request('difficulty') === 'easy' ? 'selected' : '' }}>Easy</option>
                        <option value="medium" {{ request('difficulty') === 'medium' ? 'selected' : '' }}>Medium</option>
                        <option value="hard" {{ request('difficulty') === 'hard' ? 'selected' : '' }}>Hard</option>
                    </select>
                </div>
            </div>
        </form>
    </div>

    {{-- ─── Active Filters ────────────────────────────────── --}}
    @if(request('search') || request('category') || request('difficulty'))
        <div class="active-filters mt-3">
            <span class="text-muted small fw-bold me-1">Active Filters:</span>

            @if(request('search'))
                <span class="filter-badge">
                    <i class="bi bi-search"></i> {{ request('search') }}
                </span>
            @endif

            @if(request('category'))
                <span class="filter-badge">
                    <i class="bi bi-tag"></i> {{ $categories->firstWhere('id', request('category'))->name ?? 'Unknown' }}
                </span>
            @endif

            @if(request('difficulty'))
                <span class="filter-badge">
                    <i class="bi bi-speedometer2"></i> {{ ucfirst(request('difficulty')) }}
                </span>
            @endif

            <a href="{{ route('recipes.index') }}" class="btn btn-sm btn-outline-danger ms-auto btn-clear">
                <i class="bi bi-x-circle me-1"></i> Clear
            </a>
        </div>
    @endif

    {{-- ─── Result Count ──────────────────────────────────── --}}
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <p class="result-count mb-0">
            Showing <span>{{ $recipes->count() }}</span> recipe{{ $recipes->count() !== 1 ? 's' : '' }}
        </p>
    </div>

    {{-- ─── Recipe Grid ───────────────────────────────────── --}}
    @if ($recipes->count())
        <div class="row g-4">
            @foreach ($recipes as $index => $recipe)
                <div class="col-sm-6 col-lg-4">
                    <div class="recipe-card animate-in animate-delay-{{ ($index % 6) + 1 }}">
                        {{-- Image --}}
                        <div class="recipe-card-img">
                            @if ($recipe->image_path)
                                <img src="{{ $recipe->image_url }}" alt="{{ $recipe->title }}">
                            @else
                                <div class="recipe-card-placeholder">🍽️</div>
                            @endif
                            <div class="recipe-card-overlay"></div>

                            @if(optional($recipe->category)->name)
                                <div class="recipe-card-badge">
                                    <span class="badge">{{ $recipe->category->name }}</span>
                                </div>
                            @endif
                        </div>

                        {{-- Body --}}
                        <div class="recipe-card-body">
                            <h2>{{ $recipe->title }}</h2>

                            <div class="recipe-meta">
                                @if($recipe->difficulty)
                                    <span class="meta-item">
                                        <i class="bi bi-speedometer2"></i>
                                        {{ ucfirst($recipe->difficulty) }}
                                    </span>
                                @endif
                                @if($recipe->prep_time)
                                    <span class="meta-item">
                                        <i class="bi bi-clock"></i>
                                        {{ $recipe->prep_time }} min
                                    </span>
                                @endif
                                @if($recipe->servings)
                                    <span class="meta-item">
                                        <i class="bi bi-people"></i>
                                        {{ $recipe->servings }} servings
                                    </span>
                                @endif
                            </div>

                            <div class="recipe-card-footer d-flex align-items-center justify-content-between w-100">
                                <span class="recipe-author">
                                    <i class="bi bi-person-circle"></i>
                                    {{ optional($recipe->user)->name ?? 'Unknown' }}
                                </span>
                                <div class="d-flex align-items-center gap-2">
                                      @if(auth()->check() && $recipe->user_id !== auth()->id() && !\App\Models\Order::where('buyer_id', auth()->id())->where('recipe_id', $recipe->id)->exists())
                                          <form action="{{ route('orders.purchase', $recipe) }}" method="POST" class="m-0 p-0">
                                              @csrf
                                              <button type="submit" class="btn btn-sm btn-success">
                                                  <i class="bi bi-cart"></i> Buy
                                              </button>
                                          </form>
                                      @elseif(auth()->check() && \App\Models\Order::where('buyer_id', auth()->id())->where('recipe_id', $recipe->id)->exists())
                                          <span class="badge bg-success"><i class="bi bi-check-circle"></i> Purchased</span>
                                    @endif
                                    <a href="{{ route('recipes.show', $recipe) }}" class="btn-view">
                                        View <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-5 d-flex justify-content-center pb-4">
            {{ $recipes->links() }}
        </div>
    @else
        <div class="empty-state mt-4">
            <div class="empty-icon">🍽️</div>
            <h3>No Recipes Yet</h3>
            <p>No recipes have been posted yet. Be the first to share something delicious!</p>
            @auth
                <a href="{{ route('recipes.create') }}" class="btn btn-primary mt-3">
                    <i class="bi bi-plus-circle me-1"></i> Create First Recipe
                </a>
            @endauth
        </div>
    @endif
</div>
@endsection

