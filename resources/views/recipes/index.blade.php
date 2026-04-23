@extends('layouts.app')

@section('content')
{{-- ─── Browse Header ─────────────────────────────────────── --}}
<div class="browse-header position-relative" style="background: linear-gradient(rgba(232,87,61,0.8), rgba(209,68,41,0.85)), url('https://images.unsplash.com/photo-1542010589005-d1eabd39f864?q=80&w=2670&auto=format&fit=crop') center/cover; padding: 4rem 0 6rem; color: #fff;">
    <div class="container hero-content">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
            <div>
                <div class="hero-emoji" style="font-size: 2.5rem; display: inline-block;">🍽️</div>
                <h1 class="mb-1 text-white"><i class="bi bi-book me-2"></i>Browse Recipes</h1>
                <p class="mb-0 text-white-50">Discover delicious recipes from our community</p>
            </div>
            @auth
                <a href="{{ route('recipes.create') }}" class="btn-hero btn-white btn-hero-sm">
                    <i class="bi bi-plus-circle me-2"></i>Create New Recipe
                </a>
            @endauth
        </div>
    </div>
    <div class="browse-wave position-absolute bottom-0 w-100">
        <svg viewBox="0 0 1440 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" style="width:100%; height:60px; display:block;">
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
                        <div class="recipe-card-img" style="min-height: 200px; background-color: #f8f9fa; position: relative;">
                            @if ($recipe->image_path)
                                <img src="{{ $recipe->image_url }}" alt="{{ $recipe->title }}" style="width: 100%; height: 200px; object-fit: cover;">
                            @else
                                <img src="https://images.unsplash.com/photo-1495521821757-a1efb6729352?q=80&w=800&auto=format&fit=crop" alt="Default Recipe Image" style="width: 100%; height: 200px; object-fit: cover;">
                            @endif
                            <div class="recipe-card-overlay"></div>

                            @if(optional($recipe->category)->name)
                                <div class="recipe-card-badge">
                                    <span class="badge">{{ $recipe->category->name }}</span>
                                </div>
                            @endif

                            @php
                                $isFree = empty($recipe->price) || $recipe->price <= 0;
                            @endphp

                            @if(!$isFree)
                                <div class="position-absolute top-0 end-0 m-3 py-1 px-3 bg-white text-dark fw-bold rounded-pill shadow-sm" style="font-size: 0.9rem; z-index: 10;">
                                    €{{ number_format($recipe->price, 2) }}
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
                                      @php
                                          $isFree = empty($recipe->price) || $recipe->price <= 0;
                                      @endphp
                                      @if(auth()->check() && $recipe->user_id !== auth()->id() && !$isFree && !\App\Models\Order::where('buyer_id', auth()->id())->where('recipe_id', $recipe->id)->exists())
                                          @if(session()->has("cart.{$recipe->id}"))
                                              <span class="badge bg-secondary rounded-pill px-3 py-2"><i class="bi bi-cart-check"></i> In Cart</span>
                                          @else
                                              <form action="{{ route('cart.add', $recipe) }}" method="POST" class="m-0 p-0 add-to-cart-form">
                                                  @csrf
                                                  <button type="submit" class="btn btn-sm btn-success rounded-pill px-3 shadow-sm fw-bold">
                                                      <i class="bi bi-cart-plus"></i> Add
                                                  </button>
                                              </form>
                                          @endif
                                      @elseif(auth()->check() && \App\Models\Order::where('buyer_id', auth()->id())->where('recipe_id', $recipe->id)->exists() && !$isFree)
                                          <span class="badge bg-success rounded-pill"><i class="bi bi-check-circle"></i> Purchased</span>
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
                <a href="{{ route('recipes.create') }}" class="btn btn-primary mt-3 rounded-pill px-4">
                    <i class="bi bi-plus-circle me-1"></i> Create First Recipe
                </a>
            @endauth
        </div>
    @endif
</div>
@endsection
