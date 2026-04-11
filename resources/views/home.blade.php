@extends('layouts.app')

@section('content')
{{-- ─── Hero ──────────────────────────────────────────────── --}}
<div class="custom-hero-small">
    <div class="container text-center hero-content">
        <div class="hero-emoji">🍳</div>
        <h1 class="hero-title mb-2">Recipe World</h1>
        <p class="hero-subtitle mb-3">Your Digital Community Cookbook</p>
        <p class="hero-desc">Create, share, and discover delicious recipes from food enthusiasts around the world. Join our community and start your culinary journey today!</p>
        <div class="hero-buttons mt-4 d-flex justify-content-center gap-3 flex-wrap">
            @guest
                <a href="{{ route('recipes.index') }}" class="btn-hero btn-white">
                    <i class="bi bi-book me-2"></i>Browse Recipes
                </a>
                <a href="{{ route('register') }}" class="btn-hero btn-ghost">
                    <i class="bi bi-rocket-takeoff me-2"></i>Get Started
                </a>
            @else
                <a href="{{ route('recipes.index') }}" class="btn-hero btn-white">
                    <i class="bi bi-book me-2"></i>Browse Recipes
                </a>
                <a href="{{ route('recipes.create') }}" class="btn-hero btn-ghost">
                    <i class="bi bi-plus-circle me-2"></i>Create Recipe
                </a>
            @endguest
        </div>
    </div>
    <div class="hero-wave">
        <svg viewBox="0 0 1440 80" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0,40 C360,90 720,0 1080,50 C1260,70 1380,35 1440,40 L1440,80 L0,80 Z" fill="#1E1E2A"/>
        </svg>
    </div>
</div>

{{-- ─── Stats Strip ───────────────────────────────────────── --}}
<div class="stats-section">
    <div class="container">
        <div class="row g-3">
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <span class="stat-icon"><i class="bi bi-journal-richtext"></i></span>
                    <div class="stat-number">{{ \App\Models\Recipe::count() }}+</div>
                    <div class="stat-label">Recipes</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <span class="stat-icon"><i class="bi bi-people"></i></span>
                    <div class="stat-number">{{ \App\Models\User::count() }}+</div>
                    <div class="stat-label">Cooks</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <span class="stat-icon"><i class="bi bi-grid"></i></span>
                    <div class="stat-number">{{ \App\Models\Category::count() }}+</div>
                    <div class="stat-label">Categories</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <span class="stat-icon"><i class="bi bi-star"></i></span>
                    <div class="stat-number">∞</div>
                    <div class="stat-label">Inspiration</div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ─── Why Choose Us ─────────────────────────────────────── --}}
<div class="container py-5 mt-3">
    <div class="section-header text-center">
        <h2>Why Choose Recipe World?</h2>
        <p>Everything you need to share your culinary creations</p>
        <span class="section-line"></span>
    </div>

    <div class="row g-4 g-lg-5">
        <div class="col-md-4">
            <div class="feature-card text-center animate-in animate-delay-1">
                <span class="feature-step">01</span>
                <div class="feature-icon">
                    <i class="bi bi-egg-fried"></i>
                </div>
                <h5>Share Your Recipes</h5>
                <p>Create detailed recipes with ingredients, step-by-step instructions, cooking times, and beautiful photos.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-card text-center animate-in animate-delay-2">
                <span class="feature-step">02</span>
                <div class="feature-icon">
                    <i class="bi bi-people"></i>
                </div>
                <h5>Community Driven</h5>
                <p>Connect with fellow food enthusiasts, discover new cuisines, and grow your culinary skills together.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-card text-center animate-in animate-delay-3">
                <span class="feature-step">03</span>
                <div class="feature-icon">
                    <i class="bi bi-lightning-charge"></i>
                </div>
                <h5>Easy to Use</h5>
                <p>Intuitive interface with powerful search, filtering, and category features. Start creating in minutes.</p>
            </div>
        </div>
    </div>
</div>

{{-- ─── Features Showcase ─────────────────────────────────── --}}
<div class="features-showcase py-5">
    <div class="container py-4">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <span class="features-badge">FEATURES</span>
                <h2 class="features-title mb-4">Powerful Features for Recipe Sharing</h2>
                <p class="features-desc mb-4">Everything you need to create, manage, and share your recipes effectively.</p>
                <ul class="list-unstyled">
                    <li class="mb-3 d-flex align-items-start">
                        <span class="feature-check me-3 mt-1"><i class="bi bi-check-lg"></i></span>
                        <span><strong>Detailed Instructions</strong> — Write step-by-step cooking guides with ease</span>
                    </li>
                    <li class="mb-3 d-flex align-items-start">
                        <span class="feature-check me-3 mt-1"><i class="bi bi-check-lg"></i></span>
                        <span><strong>Image Uploads</strong> — Add beautiful photos of your finished dishes</span>
                    </li>
                    <li class="mb-3 d-flex align-items-start">
                        <span class="feature-check me-3 mt-1"><i class="bi bi-check-lg"></i></span>
                        <span><strong>Search & Filter</strong> — Find recipes by category, difficulty, or keyword</span>
                    </li>
                    <li class="mb-3 d-flex align-items-start">
                        <span class="feature-check me-3 mt-1"><i class="bi bi-check-lg"></i></span>
                        <span><strong>User Authentication</strong> — Secure login and registration system</span>
                    </li>
                    <li class="mb-3 d-flex align-items-start">
                        <span class="feature-check me-3 mt-1"><i class="bi bi-check-lg"></i></span>
                        <span><strong>Recipe Management</strong> — Full CRUD operations for your recipes</span>
                    </li>
                </ul>
            </div>
            <div class="col-lg-6">
                <img src="https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=800&h=600&fit=crop"
                     class="img-fluid shadow features-img"
                     alt="Kitchen workspace">
            </div>
        </div>
    </div>
</div>

{{-- ─── Explore Categories ────────────────────────────────── --}}
<div class="container py-5">
    <div class="section-header text-center">
        <h2>Explore by Category</h2>
        <p>Find exactly what you're craving</p>
        <span class="section-line"></span>
    </div>

    <div class="d-flex flex-wrap justify-content-center gap-3">
        <a href="{{ route('recipes.index') }}" class="category-pill animate-in animate-delay-1">
            <span class="cat-emoji">🥗</span> Salads
        </a>
        <a href="{{ route('recipes.index') }}" class="category-pill animate-in animate-delay-2">
            <span class="cat-emoji">🍝</span> Pasta
        </a>
        <a href="{{ route('recipes.index') }}" class="category-pill animate-in animate-delay-3">
            <span class="cat-emoji">🍰</span> Desserts
        </a>
        <a href="{{ route('recipes.index') }}" class="category-pill animate-in animate-delay-4">
            <span class="cat-emoji">🥩</span> Meat
        </a>
        <a href="{{ route('recipes.index') }}" class="category-pill animate-in animate-delay-5">
            <span class="cat-emoji">🐟</span> Seafood
        </a>
        <a href="{{ route('recipes.index') }}" class="category-pill animate-in animate-delay-6">
            <span class="cat-emoji">🥤</span> Drinks
        </a>
        <a href="{{ route('recipes.index') }}" class="category-pill animate-in animate-delay-7">
            <span class="cat-emoji">🍳</span> Breakfast
        </a>
        <a href="{{ route('recipes.index') }}" class="category-pill animate-in animate-delay-8">
            <span class="cat-emoji">🌮</span> Mexican
        </a>
    </div>
</div>

{{-- ─── CTA Banner ────────────────────────────────────────── --}}
<div class="container pb-5">
    <div class="cta-banner text-center cta-content">
        <h3 class="mb-2">Ready to Start Cooking?</h3>
        <p class="mb-4">Join our community of food lovers sharing their best recipes every day.</p>
        @guest
            <a href="{{ route('register') }}" class="btn-cta">
                <i class="bi bi-arrow-right-circle me-2"></i>Sign Up Free
            </a>
        @else
            <a href="{{ route('recipes.create') }}" class="btn-cta">
                <i class="bi bi-plus-circle me-2"></i>Share Your Recipe
            </a>
        @endguest
    </div>
</div>
@endsection
