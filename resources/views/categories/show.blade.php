@extends('layouts.app')

@section('content')
{{-- ─── Hero ──────────────────────────────────────────────── --}}
@php
    $imageUrl = $category->image ? (Str::startsWith($category->image, 'http') ? $category->image : asset('storage/' . $category->image)) : 'https://images.unsplash.com/photo-1493770348161-369560ae357d?q=80&w=2670&auto=format&fit=crop';
@endphp
<div class="browse-header position-relative" style="background: linear-gradient(rgba(232,87,61,0.8), rgba(209,68,41,0.85)), url('{{ $imageUrl }}') center/cover; padding: 4rem 0 6rem; color: #fff;">
    <div class="container hero-content">
        <h1 class="mb-1 text-white"><i class="bi bi-tag me-2"></i>{{ $category->name }}</h1>
        <p class="mb-0 text-white-50">Created {{ $category->created_at->format('F j, Y') }}
            @if($category->created_at != $category->updated_at)
                · Updated {{ $category->updated_at->format('M d, Y') }}
            @endif
        </p>
    </div>
    <div class="browse-wave position-absolute bottom-0 w-100">
        <svg viewBox="0 0 1440 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0,30 C480,70 960,0 1440,30 L1440,60 L0,60 Z" fill="#FFFCF8"/>
        </svg>
    </div>
</div>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="mb-3">
                <a href="{{ route('categories.index') }}" class="btn btn-sm btn-outline-secondary">
                    &larr; Back to Categories
                </a>
            </div>

            <div class="feature-card mb-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <p class="mb-0">{{ $category->description ?? 'No description provided.' }}</p>
                    @if(auth()->check() && auth()->id() === $category->user_id)
                        <div class="d-flex gap-2 ms-3 flex-shrink-0">
                            <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger delete-btn" data-confirm-message="Are you sure you want to delete the category '{{ $category->name }}'?">Delete</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>

            <div class="section-header text-center">
                <h2>Recipes in {{ $category->name }}</h2>
                <span class="section-line"></span>
            </div>

            @if ($recipes->count())
                <div class="row g-4 mb-4">
                    @foreach ($recipes as $index => $recipe)
                        <div class="col-sm-6 col-lg-4">
                            <div class="recipe-card animate-in animate-delay-{{ ($index % 6) + 1 }}">
                                <div class="recipe-card-img">
                                    @if ($recipe->image_path)
                                        <img src="{{ $recipe->image_url }}" alt="{{ $recipe->title }}">
                                    @else
                                        <div class="recipe-card-placeholder">🍽️</div>
                                    @endif
                                    <div class="recipe-card-overlay"></div>
                                </div>

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
                                    </div>
                                    <div class="recipe-card-footer">
                                        <span class="recipe-author">
                                            <i class="bi bi-person-circle"></i>
                                            {{ optional($recipe->user)->name ?? 'Unknown' }}
                                        </span>
                                        <a href="{{ route('recipes.show', $recipe) }}" class="btn-view">
                                            View <i class="bi bi-arrow-right"></i>
                                        </a>
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
                <div class="empty-state mt-4">
                    <div class="empty-icon">🍽️</div>
                    <h3>No Recipes Yet</h3>
                    <p>No recipes have been posted in this category yet.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
