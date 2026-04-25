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
<style>
/* Premium Category Card Grid styles */
.premium-category-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 2rem;
}

.premium-cat-card {
    background: #fff;
    border-radius: 24px;
    overflow: hidden;
    position: relative;
    box-shadow: 0 10px 40px rgba(0,0,0,0.04);
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    display: flex;
    flex-direction: column;
    border: 1px solid rgba(0,0,0,0.02);
    text-decoration: none;
}

.premium-cat-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 50px rgba(232,87,61,0.15); /* text-coral color glow */
}

.premium-cat-image-wrap {
    height: 240px;
    position: relative;
    overflow: hidden;
    margin: 10px 10px 0 10px;
    border-radius: 18px;
}

.premium-cat-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s ease;
}

.premium-cat-card:hover .premium-cat-img {
    transform: scale(1.05);
}

.premium-icon-badge {
    position: absolute;
    top: 220px;
    right: 28px;
    width: 55px;
    height: 55px;
    border-radius: 18px;
    background: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    z-index: 10;
    transform: rotate(-5deg);
    transition: transform 0.3s ease;
}

.premium-cat-card:hover .premium-icon-badge {
    transform: rotate(0deg) scale(1.1);
    background: #E8573D;
    color: #fff !important;
}

.premium-cat-content {
    padding: 1.5rem 1.5rem 1.25rem 1.5rem;
    display: flex;
    flex-direction: column;
    flex-grow: 1;
}

.premium-cat-title {
    font-size: 1.4rem;
    font-weight: 800;
    color: #2D3748;
    margin-bottom: 0.5rem;
    text-decoration: none;
    transition: color 0.2s ease;
    display: block;
}

.premium-cat-card:hover .premium-cat-title {
    color: #E8573D;
}

.premium-cat-meta {
    font-size: 0.85rem;
    color: #A0AEC0;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 500;
}

.premium-cat-desc {
    color: #4A5568;
    line-height: 1.6;
    font-size: 0.95rem;
    margin-bottom: 1.5rem;
    flex-grow: 1;
}

.premium-cat-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 1rem;
    border-top: 1px solid rgba(0,0,0,0.06);
    margin-top: auto;
}

.premium-view-link {
    color: #E8573D;
    font-weight: 700;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.95rem;
    transition: all 0.2s ease;
}

.premium-view-link i {
    transition: transform 0.2s ease;
}

.premium-cat-card:hover .premium-view-link {
    color: #d14429;
}

.premium-cat-card:hover .premium-view-link i {
    transform: translateX(4px);
}

.premium-admin-actions {
    position: relative;
    z-index: 10; /* Ensure buttons are clickable instead of card */
}

/* Subtle edit/delete buttons inside the card */
.premium-admin-actions .btn-admin {
    width: 32px;
    height: 32px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: #f8f9fa;
    color: #6c757d;
    border: none;
    transition: all 0.2s ease;
    text-decoration: none;
}

.premium-admin-actions .btn-admin:hover {
    background: #e2e8f0;
    color: #1a202c;
    transform: scale(1.1);
}

.premium-admin-actions .btn-admin.btn-delete:hover {
    background: #fed7d7;
    color: #e53e3e;
}
</style>

<div class="container py-5">
    <div class="premium-category-grid">
        @forelse($categories as $category)
            @php
                $colorIndex = ($loop->index % 6) + 1;
                $icons = ['bi-egg-fried', 'bi-cup-hot', 'bi-fire', 'bi-flower1', 'bi-heart', 'bi-star'];
                $icon = $icons[$loop->index % count($icons)];
            @endphp
            
            <div class="premium-cat-card animate-in animate-delay-{{ ($loop->index % 6) + 1 }}">
                @if($category->image)
                    @php
                        $imageUrl = Str::startsWith($category->image, 'http') ? $category->image : asset('storage/' . $category->image);
                    @endphp
                    <div class="premium-cat-image-wrap">
                        <img src="{{ $imageUrl }}" alt="{{ $category->name }}" class="premium-cat-img" loading="lazy">
                    </div>
                @else
                    <div class="premium-cat-image-wrap" style="background: linear-gradient(135deg, #FFFCF8 0%, #FFE9E0 100%); display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-image text-muted" style="font-size: 3rem; opacity: 0.3;"></i>
                    </div>
                @endif
                
                <div class="premium-icon-badge text-coral">
                    <i class="bi {{ $icon }}"></i>
                </div>
                
                <div class="premium-cat-content">
                    <a href="{{ route('categories.show', $category) }}" class="premium-cat-title">
                        {{ $category->name }}
                    </a>
                    
                    <div class="premium-cat-meta">
                        <i class="bi bi-calendar-event"></i>
                        <span>Created {{ $category->created_at->format('M d, Y') }}</span>
                    </div>
                    
                    <p class="premium-cat-desc">
                        {{ \Illuminate\Support\Str::limit($category->description ?? 'No description provided.', 110) }}
                    </p>
                    
                    <div class="premium-cat-actions">
                        <a href="{{ route('categories.show', $category) }}" class="premium-view-link">
                            Explore <i class="bi bi-arrow-right"></i>
                        </a>
                        
                        @if(auth()->check() && auth()->id() === $category->user_id)
                            <div class="premium-admin-actions d-flex gap-2">
                                <a href="{{ route('categories.edit', $category) }}" class="btn-admin shadow-sm" title="Edit Category">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-admin btn-delete shadow-sm delete-btn" data-confirm-message="Are you sure you want to delete the category '{{ $category->name }}'?" title="Delete Category">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12" style="grid-column: 1 / -1;">
                <div class="empty-state mt-4 py-5 bg-white rounded-4 shadow-sm border text-center text-muted">
                    <div class="empty-icon fs-1 mb-3" style="opacity: 0.5;">📂</div>
                    <h3 class="fw-bold text-dark">No Categories Yet</h3>
                    <p class="mb-0">There are no categories found. @auth <br><a href="{{ route('categories.create') }}" class="btn btn-outline-coral rounded-pill mt-3 px-4 fw-bold">Create the first category!</a> @endauth</p>
                </div>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-5">
        {{ $categories->links() }}
    </div>
</div>
@endsection
