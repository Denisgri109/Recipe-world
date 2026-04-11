@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <!-- Back Link -->
            <div class="mb-3">
                <a href="{{ route('recipes.index') }}" class="btn btn-outline-secondary">&larr; Back to Recipes</a>
            </div>

            <div class="card shadow-sm">
                @if($recipe->image_path)
                    <img src="{{ asset('storage/' . $recipe->image_path) }}" class="card-img-top" alt="{{ $recipe->title }}" style="max-height: 500px; object-fit: cover;">
                @endif
                
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h2 class="card-title fw-bold">{{ $recipe->title }}</h2>
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <p class="text-muted mb-0">By {{ $recipe->user->name ?? 'Unknown Author' }}</p>
                                <x-difficulty-badge :difficulty="$recipe->difficulty" />
                            </div>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="d-flex gap-2">
                            @can('update', $recipe)
                                <a href="{{ route('recipes.edit', $recipe) }}" class="btn btn-primary">Edit</a>
                            @endcan
                            
                            @can('delete', $recipe)
                                <form action="{{ route('recipes.destroy', $recipe) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this recipe?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            @endcan
                        </div>
                    </div>

                    <div class="mb-4">
                        <p class="card-text lead">{{ $recipe->description }}</p>
                    </div>

                    <!-- Meta Info Section -->
                    <div class="d-flex flex-wrap gap-4 py-3 px-4 mb-4 bg-light rounded shadow-sm border">
                        @if($recipe->prep_time)
                            <div class="d-flex align-items-center">
                                <span class="fs-4 me-2">🕒</span>
                                <div>
                                    <small class="text-muted d-block text-uppercase fw-bold" style="font-size: 0.75rem;">Prep Time</small>
                                    <span class="fw-medium">{{ $recipe->prep_time }} mins</span>
                                </div>
                            </div>
                        @endif

                        @if($recipe->cook_time)
                            <div class="d-flex align-items-center">
                                <span class="fs-4 me-2">🔥</span>
                                <div>
                                    <small class="text-muted d-block text-uppercase fw-bold" style="font-size: 0.75rem;">Cook Time</small>
                                    <span class="fw-medium">{{ $recipe->cook_time }} mins</span>
                                </div>
                            </div>
                        @endif

                        @if($recipe->prep_time || $recipe->cook_time)
                            <div class="d-flex align-items-center">
                                <span class="fs-4 me-2">⏳</span>
                                <div>
                                    <small class="text-muted d-block text-uppercase fw-bold" style="font-size: 0.75rem;">Total Time</small>
                                    <span class="fw-medium">{{ ($recipe->prep_time ?? 0) + ($recipe->cook_time ?? 0) }} mins</span>
                                </div>
                            </div>
                        @endif

                        @if($recipe->servings)
                            <div class="d-flex align-items-center">
                                <span class="fs-4 me-2">🍽️</span>
                                <div>
                                    <small class="text-muted d-block text-uppercase fw-bold" style="font-size: 0.75rem;">Servings</small>
                                    <span class="fw-medium">{{ $recipe->servings }}</span>
                                </div>
                            </div>
                        @endif
                    </div>

                    <hr>

                    <div class="row mt-4">
                        <div class="col-md-4 mb-4">
                            <h4 class="fw-bold mb-3">Ingredients</h4>
                            <ul class="list-group list-group-flush">
                                @forelse($recipe->ingredients->sortBy('order') as $ingredient)
                                    <li class="list-group-item px-0">
                                        {{ $ingredient->quantity }} {{ $ingredient->name }}
                                    </li>
                                @empty
                                    <li class="list-group-item px-0 text-muted">No ingredients listed.</li>
                                @endforelse
                            </ul>
                        </div>
                        
                        <div class="col-md-8 mb-4">
                            <h4 class="fw-bold mb-3">Instructions</h4>
                            <div class="recipe-instructions">
                                {!! nl2br(e($recipe->instructions)) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
