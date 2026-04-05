@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="mb-3">
                <a href="{{ route('categories.index') }}" class="btn btn-sm btn-outline-secondary">
                    &larr; Back to Categories
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <h1 class="card-title mb-3">{{ $category->name }}</h1>
                    
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="text-muted">
                            <small>
                                Created {{ $category->created_at->format('F j, Y \a\t g:i a') }}
                                @if($category->created_at != $category->updated_at)
                                    <span class="ms-2">(Updated: {{ $category->updated_at->format('M d, Y') }})</span>
                                @endif
                            </small>
                        </div>
                        @auth
                            <div>
                                <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                                </form>
                            </div>
                        @endauth
                    </div>

                    <div class="card-text">
                        {!! nl2br(e($category->description ?? 'No description provided.')) !!}
                    </div>
                </div>
            </div>

            <h3 class="mt-5 mb-4">Recipes in {{ $category->name }}</h3>

            @if ($recipes->count())
                <div class="row g-4 mb-4">
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
                                    <h4 class="h5 card-title mb-2">{{ $recipe->title }}</h4>

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
                    No recipes have been posted in this category yet.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
