@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="mb-3">
                <a href="{{ route('recipes.index') }}" class="btn btn-outline-secondary">&larr; Back to Recipes</a>
            </div>

            <div class="recipe-detail-card">
                @if($recipe->image_path)
                    <img src="{{ $recipe->image_url }}" class="recipe-detail-img" alt="{{ $recipe->title }}">
                @endif

                <div class="recipe-detail-body">
                    <div class="d-flex justify-content-between align-items-start mb-3 flex-wrap gap-2">
                        <div>
                            <h2 class="recipe-detail-title">{{ $recipe->title }}</h2>
                            <p class="text-muted mb-0">By {{ $recipe->user->name ?? 'Unknown Author' }}</p>
                        </div>
                        <div class="d-flex gap-2">
                              @if(auth()->check() && $recipe->user_id !== auth()->id() && !\App\Models\Order::where('buyer_id', auth()->id())->where('recipe_id', $recipe->id)->exists())
                                  <form action="{{ route('orders.purchase', $recipe) }}" method="POST" class="m-0 p-0">
                                      @csrf
                                      <button type="submit" class="btn btn-success">Buy Recipe</button>
                                  </form>
                              @elseif(auth()->check() && \App\Models\Order::where('buyer_id', auth()->id())->where('recipe_id', $recipe->id)->exists())
                                  <button class="btn btn-secondary" disabled>Purchased</button>
                            @endif
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

                    {{-- Meta Info --}}
                    <div class="recipe-detail-meta">
                        @if($recipe->prep_time)
                            <div class="d-flex align-items-center">
                                <span class="fs-4 me-2">🕒</span>
                                <div>
                                    <small class="meta-label">Prep Time</small>
                                    <span class="fw-medium">{{ $recipe->prep_time }} mins</span>
                                </div>
                            </div>
                        @endif

                        @if($recipe->cook_time)
                            <div class="d-flex align-items-center">
                                <span class="fs-4 me-2">🔥</span>
                                <div>
                                    <small class="meta-label">Cook Time</small>
                                    <span class="fw-medium">{{ $recipe->cook_time }} mins</span>
                                </div>
                            </div>
                        @endif

                        @if($recipe->prep_time || $recipe->cook_time)
                            <div class="d-flex align-items-center">
                                <span class="fs-4 me-2">⏳</span>
                                <div>
                                    <small class="meta-label">Total Time</small>
                                    <span class="fw-medium">{{ ($recipe->prep_time ?? 0) + ($recipe->cook_time ?? 0) }} mins</span>
                                </div>
                            </div>
                        @endif

                        @if($recipe->servings)
                            <div class="d-flex align-items-center">
                                <span class="fs-4 me-2">🍽️</span>
                                <div>
                                    <small class="meta-label">Servings</small>
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
