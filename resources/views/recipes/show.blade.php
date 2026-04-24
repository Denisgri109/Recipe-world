@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="mb-3">
                <a href="{{ route('recipes.index') }}" class="btn btn-outline-secondary">&larr; Back to Recipes</a>
            </div>

            <div class="recipe-detail-card" style="overflow: hidden; border-radius: 15px; background: #fff;">
                @if($recipe->image_path)
                    <img src="{{ $recipe->image_url }}" class="recipe-detail-img w-100" style="object-fit: cover; max-height: 450px;" alt="{{ $recipe->title }}">
                @else
                    <img src="https://images.unsplash.com/photo-1495521821757-a1efb6729352?q=80&w=1200&auto=format&fit=crop" class="recipe-detail-img w-100" style="object-fit: cover; max-height: 450px;" alt="Default Recipe Image">
                @endif

                <div class="recipe-detail-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3 flex-wrap gap-2">
                        <div>
                            <h2 class="recipe-detail-title">{{ $recipe->title }}</h2>
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <p class="text-muted mb-0">By {{ $recipe->user->name ?? 'Unknown Author' }}</p>
                                <x-difficulty-badge :difficulty="$recipe->difficulty" />
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                              @php
                                  $isFree = empty($recipe->price) || $recipe->price <= 0;
                              @endphp
                              @if(auth()->check() && $recipe->user_id !== auth()->id() && !$isFree && !\App\Models\Order::where('buyer_id', auth()->id())->where('recipe_id', $recipe->id)->exists())
                                  @if(session()->has("cart.{$recipe->id}"))
                                      <a href="{{ route('cart.index') }}" class="btn btn-secondary"><i class="bi bi-cart-check"></i> In Cart</a>
                                  @else
                                      <form action="{{ route('cart.add', $recipe) }}" method="POST" class="m-0 p-0 add-to-cart-form">
                                          @csrf
                                          <button type="submit" class="btn btn-success"><i class="bi bi-cart-plus me-1"></i>Add to Cart for €{{ number_format($recipe->price, 2) }}</button>
                                      </form>
                                  @endif
                              @elseif(auth()->check() && !\App\Models\Order::where('buyer_id', auth()->id())->where('recipe_id', $recipe->id)->exists() && !$isFree)
                                  <!-- Not purchased, just handled above or locked -->
                              @elseif(auth()->check() && \App\Models\Order::where('buyer_id', auth()->id())->where('recipe_id', $recipe->id)->exists() && !$isFree)
                                  <button class="btn btn-secondary" disabled>Purchased</button>
                              @endif
                            @can('update', $recipe)
                                <a href="{{ route('recipes.edit', $recipe) }}" class="btn btn-primary">Edit</a>
                            @endcan
                            @can('delete', $recipe)
                                <form action="{{ route('recipes.destroy', $recipe) }}" method="POST" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger delete-btn" data-confirm-message="Are you sure you want to delete the recipe '{{ $recipe->title }}'?">Delete</button>
                                </form>
                            @endcan
                        </div>
                    </div>

                    <div class="mb-4">
                        <p class="card-text lead">{{ $recipe->description }}</p>
                    </div>

                    {{-- Meta Info (visible to everyone as preview) --}}
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

                    {{-- ─── Purchase Gate: Only show full recipe to owner or purchaser ─── --}}
                    @php
                        $isOwner = auth()->check() && $recipe->user_id === auth()->id();
                        $hasPurchased = auth()->check() && \App\Models\Order::where('buyer_id', auth()->id())->where('recipe_id', $recipe->id)->exists();
                        $isFree = empty($recipe->price) || $recipe->price <= 0;
                        $canViewFull = $isOwner || $hasPurchased || $isFree;
                    @endphp

                    @if($canViewFull)
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
                    @else
                        {{-- Locked content for non-purchasers --}}
                        <div class="text-center py-5">
                            <div class="mb-3">
                                <span style="font-size: 3rem;">🔒</span>
                            </div>
                            <h4 class="fw-bold mb-2">Full Recipe Locked</h4>
                            <p class="text-muted mb-4">
                                Purchase this recipe to view the full ingredients list and step-by-step instructions.
                            </p>
                            @auth
                                @if(session()->has("cart.{$recipe->id}"))
                                    <a href="{{ route('cart.index') }}" class="btn btn-secondary btn-lg">
                                        <i class="bi bi-cart-check me-1"></i> In Your Cart
                                    </a>
                                @else
                                    <form action="{{ route('cart.add', $recipe) }}" method="POST" class="d-inline add-to-cart-form">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-lg">
                                            <i class="bi bi-cart-plus me-1"></i> Add to Cart (Total: €{{ number_format($recipe->price, 2) }})
                                        </button>
                                    </form>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                                    <i class="bi bi-box-arrow-in-right me-1"></i> Log In to Purchase
                                </a>
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

