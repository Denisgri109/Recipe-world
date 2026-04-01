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
