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
                            <p class="text-muted mb-0">By {{ $recipe->user->name ?? 'Unknown Author' }}</p>
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
