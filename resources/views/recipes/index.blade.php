@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
        <h1 class="h3 mb-0">Browse Recipes</h1>

        @auth
            <a href="{{ route('recipes.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i> Create New Recipe
            </a>
        @endauth
    </div>

    <!-- Filter Area -->
    <div class="card mb-4 shadow-sm border-0 bg-light">
        <div class="card-body py-3">
            <form action="{{ route('recipes.index') }}" method="GET" class="row g-2 align-items-center">
                <div class="col-12 col-md-5">
                    <div class="input-group">
                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Search by title or description"
                            value="{{ request('search') }}"
                        >
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-search me-1"></i> Search
                        </button>
                    </div>
                </div>

                <div class="col-auto ms-md-2">
                    <label for="category" class="col-form-label fw-bold">Category:</label>
                </div>
                <div class="col-auto col-md-3">
                    <select name="category" id="category" class="form-select" onchange="this.form.submit()">
                        <option value="">All Categories</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-auto ms-md-2">
                    <label for="difficulty" class="col-form-label fw-bold">Difficulty:</label>
                </div>
                <div class="col-auto col-md-2">
                    <select name="difficulty" id="difficulty" class="form-select" onchange="this.form.submit()">
                        <option value="">All Difficulties</option>
                        <option value="easy" {{ request('difficulty') === 'easy' ? 'selected' : '' }}>Easy</option>
                        <option value="medium" {{ request('difficulty') === 'medium' ? 'selected' : '' }}>Medium</option>
                        <option value="hard" {{ request('difficulty') === 'hard' ? 'selected' : '' }}>Hard</option>
                    </select>
                </div>
            </form>
        </div>
    </div>

    @if(request('search') || request('category') || request('difficulty'))
        <div class="d-flex align-items-center gap-2 mb-4">
            <span class="text-muted small fw-bold">Active Filters:</span>
            
            @if(request('search'))
                <span class="badge bg-secondary px-2 py-1">
                    Search: {{ request('search') }}
                </span>
            @endif
            
            @if(request('category'))
                <span class="badge bg-secondary px-2 py-1">
                    Category: {{ $categories->firstWhere('id', request('category'))->name ?? 'Unknown' }}
                </span>
            @endif
            
            @if(request('difficulty'))
                <span class="badge bg-secondary px-2 py-1">
                    Difficulty: {{ ucfirst(request('difficulty')) }}
                </span>
            @endif
            
            <a href="{{ route('recipes.index') }}" class="btn btn-sm btn-outline-danger ms-auto">
                <i class="bi bi-x-circle me-1"></i> Clear Filters
            </a>
        </div>
    @endif

    @if ($recipes->count())
        <div class="row g-4">
            @foreach ($recipes as $recipe)
                <div class="col-sm-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        @if ($recipe->image_path)
                            <img
                                src="{{ asset('storage/' . $recipe->image_path) }}"
                                class="card-img-top"
                                alt="{{ $recipe->title }}"
                                style="height: 220px; object-fit: cover;"
                            >
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center" style="height: 220px;">
                                <i class="bi bi-image text-muted" style="font-size: 2rem;"></i>
                            </div>
                        @endif

                        <div class="card-body d-flex flex-column">
                            <h2 class="h5 card-title mb-2">{{ $recipe->title }}</h2>

                            <p class="card-text text-muted mb-1">
                                <strong>Category:</strong> {{ optional($recipe->category)->name ?? 'Uncategorized' }}
                            </p>
                            <p class="card-text text-muted mb-3">
                                <strong>Author:</strong> {{ optional($recipe->user)->name ?? 'Unknown' }}
                            </p>

                            <div class="mt-auto">
                                <a href="{{ route('recipes.show', $recipe) }}" class="btn btn-outline-primary btn-sm">View Recipe</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4 d-flex justify-content-center">
            {{ $recipes->links() }}
        </div>
    @else
        <div class="alert alert-info mb-0">
            No recipes have been posted yet.
            @auth
                <a href="{{ route('recipes.create') }}" class="alert-link">Create the first recipe</a>.
            @endauth
        </div>
    @endif
</div>
@endsection
