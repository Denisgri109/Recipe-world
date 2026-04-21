@extends('layouts.app')

@section('content')
{{-- ─── Hero ──────────────────────────────────────────────── --}}
<div class="browse-header position-relative" style="background: linear-gradient(rgba(232,87,61,0.8), rgba(209,68,41,0.85)), url('https://images.unsplash.com/photo-1493770348161-369560ae357d?q=80&w=2670&auto=format&fit=crop') center/cover; padding: 4rem 0 6rem; color: #fff;">
    <div class="container hero-content">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
            <div>
                <div class="hero-emoji" style="font-size: 2.5rem; display: inline-block;">📂</div>
                <h1 class="mb-1 text-white"><i class="bi bi-grid me-2"></i>Recipe Categories</h1>
                <p class="mb-0 text-white-50">Browse and discover recipe categories</p>
            </div>
            @auth
                <a href="{{ route('categories.create') }}" class="btn-hero btn-white btn-hero-sm">
                    <i class="bi bi-plus-circle me-2"></i>Create Category
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

{{-- ─── Category Grid ─────────────────────────────────────── --}}
<div class="container py-4">
    @forelse($categories as $category)
        @php
            $colorIndex = ($loop->index % 6) + 1;
            $icons = ['bi-egg-fried', 'bi-cup-hot', 'bi-fire', 'bi-flower1', 'bi-heart', 'bi-star'];
            $icon = $icons[$loop->index % count($icons)];
        @endphp
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="category-grid-card mb-3 animate-in animate-delay-{{ ($loop->index % 6) + 1 }}">
                    <div class="d-flex gap-3 align-items-start">
                        <div class="category-icon-wrap category-color-{{ $colorIndex }}">
                            <i class="bi {{ $icon }}"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h4 class="mb-1">
                                <a href="{{ route('categories.show', $category) }}" class="text-decoration-none text-coral fw-bold">
                                    {{ $category->name }}
                                </a>
                            </h4>
                            <p class="text-muted small mb-2">
                                <i class="bi bi-calendar3 me-1"></i>Created {{ $category->created_at->format('M d, Y') }}
                            </p>
                            <p class="mb-0" style="color: #6A6A7A; line-height: 1.7;">{{ $category->description ?? 'No description provided.' }}</p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-3 pt-3" style="border-top: 1px solid rgba(0,0,0,0.05);">
                        <a href="{{ route('categories.show', $category) }}" class="btn-view">
                            View <i class="bi bi-arrow-right"></i>
                        </a>
                        @if(auth()->check() && auth()->id() === $category->user_id)
                            <div class="d-flex gap-2">
                                <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                                    <i class="bi bi-pencil me-1"></i>Edit
                                </a>
                                <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3 delete-btn" data-confirm-message="Are you sure you want to delete the category '{{ $category->name }}'?">
                                        <i class="bi bi-trash me-1"></i>Delete
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="empty-state mt-4">
                    <div class="empty-icon">📂</div>
                    <h3>No Categories Yet</h3>
                    <p>No categories found. @auth <a href="{{ route('categories.create') }}" class="text-coral fw-bold">Create the first category!</a> @endauth</p>
                </div>
            </div>
        </div>
    @endforelse

    <div class="d-flex justify-content-center mt-4">
        {{ $categories->links() }}
    </div>
</div>
@endsection
