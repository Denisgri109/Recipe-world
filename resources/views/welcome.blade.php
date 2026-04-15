@extends('layouts.app')

@section('content')
{{-- ─── Hero ──────────────────────────────────────────────── --}}
<div class="custom-hero-small">
    <div class="container text-center position-relative" style="z-index: 3;">
        <div class="hero-emoji">🍳</div>
        <h1 class="hero-title mb-2">Recipe World</h1>
        <p class="hero-subtitle mb-3">Your Digital Community Cookbook</p>
        <p class="hero-desc">Create, share, and discover delicious recipes from food enthusiasts around the world. Join our community and start your culinary journey today!</p>
        <div class="hero-buttons mt-4 d-flex justify-content-center gap-3 flex-wrap">
            @guest
                <a href="{{ route('register') }}" class="btn-hero btn-white">
                    <i class="bi bi-rocket-takeoff me-2"></i>Get Started
                </a>
                <a href="{{ route('login') }}" class="btn-hero btn-ghost">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Log In
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
    {{-- Wave divider --}}
    <div class="hero-wave">
        <svg viewBox="0 0 1440 80" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0,40 C360,90 720,0 1080,50 C1260,70 1380,35 1440,40 L1440,80 L0,80 Z" fill="#1E1E2A"/>
        </svg>
    </div>
</div>

{{-- ─── Stats Strip ───────────────────────────────────────── --}}
<div class="stats-section">
    <div class="container">
        <div class="row animate-on-scroll opacity-0 g-3">
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <span class="stat-icon"><i class="bi bi-journal-richtext"></i></span>
                    <div class="stat-number">500+</div>
                    <div class="stat-label">Recipes</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <span class="stat-icon"><i class="bi bi-people"></i></span>
                    <div class="stat-number">200+</div>
                    <div class="stat-label">Cooks</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <span class="stat-icon"><i class="bi bi-grid"></i></span>
                    <div class="stat-number">50+</div>
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

{{-- ─── How It Works ──────────────────────────────────────── --}}
<div class="container py-5 mt-3">
    <div class="section-header text-center">
        <h2>How It Works</h2>
        <p>Get started with Recipe World in three simple steps</p>
        <span class="section-line"></span>
    </div>

    <div class="row animate-on-scroll opacity-0 g-4 g-lg-5">
        <div class="col-md-4">
            <div class="feature-card text-center animate-in animate-delay-1">
                <span class="feature-step">01</span>
                <div class="feature-icon">
                    <i class="bi bi-person-plus"></i>
                </div>
                <h5>Create an Account</h5>
                <p>Sign up for free and join our growing community of food enthusiasts and home cooks.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-card text-center animate-in animate-delay-2">
                <span class="feature-step">02</span>
                <div class="feature-icon">
                    <i class="bi bi-pencil-square"></i>
                </div>
                <h5>Share Your Recipes</h5>
                <p>Add your favourite recipes with ingredients, instructions, images, and cooking details.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-card text-center animate-in animate-delay-3">
                <span class="feature-step">03</span>
                <div class="feature-icon">
                    <i class="bi bi-search-heart"></i>
                </div>
                <h5>Discover & Cook</h5>
                <p>Browse, search, and filter recipes by category or difficulty to find your next meal.</p>
            </div>
        </div>
    </div>
</div>

{{-- ─── Popular Categories ────────────────────────────────── --}}
<div class="container pb-5">
    <div class="section-header text-center">
        <h2>Explore by Category</h2>
        <p>Find exactly what you're craving</p>
        <span class="section-line"></span>
    </div>

    <div class="d-flex flex-wrap justify-content-center gap-3">
        <a href="{{ route('recipes.index') }}?category=" class="category-pill animate-in animate-delay-1">
            <span class="cat-emoji">🥗</span> Salads
        </a>
        <a href="{{ route('recipes.index') }}?category=" class="category-pill animate-in animate-delay-2">
            <span class="cat-emoji">🍝</span> Pasta
        </a>
        <a href="{{ route('recipes.index') }}?category=" class="category-pill animate-in animate-delay-3">
            <span class="cat-emoji">🍰</span> Desserts
        </a>
        <a href="{{ route('recipes.index') }}?category=" class="category-pill animate-in animate-delay-4">
            <span class="cat-emoji">🥩</span> Meat
        </a>
        <a href="{{ route('recipes.index') }}?category=" class="category-pill animate-in animate-delay-5">
            <span class="cat-emoji">🐟</span> Seafood
        </a>
        <a href="{{ route('recipes.index') }}?category=" class="category-pill animate-in animate-delay-6">
            <span class="cat-emoji">🥤</span> Drinks
        </a>
        <a href="{{ route('recipes.index') }}?category=" class="category-pill animate-in animate-delay-7">
            <span class="cat-emoji">🍳</span> Breakfast
        </a>
        <a href="{{ route('recipes.index') }}?category=" class="category-pill animate-in animate-delay-8">
            <span class="cat-emoji">🌮</span> Mexican
        </a>
    </div>
</div>

{{-- ─── CTA Banner ────────────────────────────────────────── --}}
<div class="container pb-5">
    <div class="cta-banner text-center position-relative" style="z-index: 1;">
        <h3 class="mb-2">Ready to Start Cooking?</h3>
        <p class="mb-4">Join thousands of food lovers sharing their best recipes every day.</p>
        @guest
            <a href="{{ route('register') }}" class="btn-cta">
                <i class="bi bi-arrow-right-circle me-2"></i>Join the Community
            </a>
        @else
            <a href="{{ route('recipes.create') }}" class="btn-cta">
                <i class="bi bi-plus-circle me-2"></i>Share Your Recipe
            </a>
        @endguest
    </div>
</div>
@endsection

