@extends('layouts.app')

@section('content')
<section class="py-5 text-white" style="background: linear-gradient(140deg, #0d3b66 0%, #145da0 55%, #1f7a8c 100%);">
    <div class="container py-4 py-md-5">
        <div class="row align-items-center g-4">
            <div class="col-lg-7">
                <span class="badge bg-light text-dark rounded-pill px-3 py-2 mb-3">Recipe World</span>
                <h1 class="display-4 fw-bold mb-3">Cook Better Together</h1>
                <p class="lead mb-4">Your digital community cookbook where home chefs create, share, and discover unforgettable meals.</p>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('recipes.browse') }}" class="btn btn-warning btn-lg px-4">Browse Recipes</a>
                    @auth
                        <a href="{{ route('recipes.create') }}" class="btn btn-outline-light btn-lg px-4">Create Recipe</a>
                    @else
                        <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg px-4">Join Free</a>
                    @endauth
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card border-0 shadow-lg">
                    <div class="card-body p-4">
                        <h2 class="h5 text-dark mb-3">What you can do</h2>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item px-0">Save complete recipes with ingredients and instructions</li>
                            <li class="list-group-item px-0">Show off dishes with category and difficulty details</li>
                            <li class="list-group-item px-0">Find your next meal in one click</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
            <div>
                <h2 class="fw-bold mb-1">Featured Recipes</h2>
                <p class="text-muted mb-0">Fresh picks from the latest community posts</p>
            </div>
            <a href="{{ route('recipes.browse') }}" class="btn btn-outline-primary">View All Recipes</a>
        </div>

        <div class="row g-4">
            @forelse($featuredRecipes as $recipe)
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card h-100 border-0 shadow-sm">
                        @if($recipe->image_path)
                            <img src="{{ asset('storage/' . $recipe->image_path) }}" class="card-img-top" alt="{{ $recipe->title }}" style="height: 220px; object-fit: cover;">
                        @else
                            <div class="card-img-top d-flex align-items-center justify-content-center bg-secondary-subtle" style="height: 220px;">
                                <span class="text-secondary fw-semibold">No image yet</span>
                            </div>
                        @endif
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex justify-content-between align-items-start gap-2 mb-2">
                                <h3 class="h5 mb-0">{{ $recipe->title }}</h3>
                                <span class="badge text-bg-primary text-capitalize">{{ $recipe->difficulty }}</span>
                            </div>
                            <p class="text-muted small mb-2">
                                By {{ $recipe->user->name ?? 'Recipe World User' }}
                                @if($recipe->category)
                                    | {{ $recipe->category->name }}
                                @endif
                            </p>
                            <p class="text-muted mb-3">{{ \Illuminate\Support\Str::limit($recipe->description, 100) }}</p>
                            <a href="{{ route('recipes.show', $recipe) }}" class="btn btn-sm btn-primary mt-auto">View Recipe</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info mb-0">No featured recipes yet. Be the first to add one.</div>
                </div>
            @endforelse
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="fw-bold mb-2">How It Works</h2>
            <p class="text-muted mb-0">Three simple steps to become part of Recipe World</p>
        </div>
        <div class="row g-4">
            <div class="col-12 col-md-4">
                <div class="card border-0 shadow-sm h-100 text-center">
                    <div class="card-body p-4">
                        <div class="display-6 fw-bold text-primary mb-2">1</div>
                        <h3 class="h5 mb-2">Create</h3>
                        <p class="text-muted mb-0">Sign up and add your signature dishes with clear steps and ingredients.</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card border-0 shadow-sm h-100 text-center">
                    <div class="card-body p-4">
                        <div class="display-6 fw-bold text-primary mb-2">2</div>
                        <h3 class="h5 mb-2">Share</h3>
                        <p class="text-muted mb-0">Publish recipes for classmates and food lovers to try and enjoy.</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card border-0 shadow-sm h-100 text-center">
                    <div class="card-body p-4">
                        <div class="display-6 fw-bold text-primary mb-2">3</div>
                        <h3 class="h5 mb-2">Discover</h3>
                        <p class="text-muted mb-0">Browse the latest recipes, save ideas, and cook something new every week.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

