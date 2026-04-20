@extends('layouts.app')

@section('content')
{{-- ─── Hero ──────────────────────────────────────────────── --}}
<div class="browse-header position-relative" style="background: linear-gradient(rgba(232,87,61,0.8), rgba(209,68,41,0.85)), url('https://images.unsplash.com/photo-1493770348161-369560ae357d?q=80&w=2670&auto=format&fit=crop') center/cover; padding: 4rem 0 6rem; color: #fff;">
    <div class="container hero-content">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
            <div>
                <h1 class="mb-1 text-white"><i class="bi bi-grid me-2"></i>Recipe Categories</h1>
                <p class="mb-0 text-white-50">Browse all recipe categories</p>
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

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @forelse($categories as $category)
                <div class="feature-card mb-3 animate-in animate-delay-{{ ($loop->index % 6) + 1 }}">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h4 class="mb-1">
                                <a href="{{ route('categories.show', $category) }}" class="text-decoration-none text-coral">
                                    {{ $category->name }}
                                </a>
                            </h4>
                            <p class="text-muted small mb-2">Created {{ $category->created_at->format('M d, Y') }}</p>
                            <p class="mb-0">{{ $category->description ?? 'No description provided.' }}</p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <a href="{{ route('categories.show', $category) }}" class="btn-view">
                            View <i class="bi bi-arrow-right"></i>
                        </a>
                        @if(auth()->check() && auth()->id() === $category->user_id)
                            <div class="d-flex gap-2">
                                <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger delete-btn" data-confirm-message="Are you sure you want to delete the category '{{ $category->name }}'?">Delete</button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="empty-state mt-4">
                    <div class="empty-icon">📂</div>
                    <h3>No Categories Yet</h3>
                    <p>No categories found. @auth <a href="{{ route('categories.create') }}">Create the first category!</a> @endauth</p>
                </div>
            @endforelse

            <div class="d-flex justify-content-center mt-4">
                {{ $categories->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
