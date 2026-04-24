@extends('layouts.app')

@section('content')
{{-- ─── Hero ──────────────────────────────────────────────── --}}
<div class="custom-hero-small" style="background: linear-gradient(rgba(232,87,61,0.8), rgba(209,68,41,0.9)), url('https://images.unsplash.com/photo-1493770348161-369560ae357d?q=80&w=2670&auto=format&fit=crop') no-repeat center center; background-size: cover; padding-top: 5rem; padding-bottom: 5rem; color: #fff;">
    {{-- Decorative particles --}}
    <div class="hero-particles">
        <div class="particle" style="width: 8px; height: 8px; top: 20%; left: 15%; --duration: 7s; --delay: 0s;"></div>
        <div class="particle" style="width: 12px; height: 12px; top: 60%; left: 75%; --duration: 5s; --delay: 1s;"></div>
        <div class="particle" style="width: 6px; height: 6px; top: 35%; left: 55%; --duration: 8s; --delay: 2s;"></div>
        <div class="particle" style="width: 10px; height: 10px; top: 75%; left: 25%; --duration: 6s; --delay: 0.5s;"></div>
        <div class="particle" style="width: 14px; height: 14px; top: 15%; left: 85%; --duration: 9s; --delay: 1.5s;"></div>
    </div>
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
                <div class="stat-item animate-in animate-delay-1">
                    <span class="stat-icon"><i class="bi bi-journal-richtext"></i></span>
                    <div class="stat-number">{{ \App\Models\Recipe::count() }}+</div>
                    <div class="stat-label">Recipes</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item animate-in animate-delay-2">
                    <span class="stat-icon"><i class="bi bi-people"></i></span>
                    <div class="stat-number">{{ \App\Models\User::count() }}+</div>
                    <div class="stat-label">Cooks</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item animate-in animate-delay-3">
                    <span class="stat-icon"><i class="bi bi-grid"></i></span>
                    <div class="stat-number">{{ \App\Models\Category::count() }}+</div>
                    <div class="stat-label">Categories</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item animate-in animate-delay-4">
                    <span class="stat-icon"><i class="bi bi-star"></i></span>
                    <div class="stat-number">∞</div>
                    <div class="stat-label">Inspiration</div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ─── Why Choose Us ─────────────────────────────────────── --}}
<div class="container py-5 mt-4">
    <div class="section-header text-center">
        <h2>Why Choose Recipe World?</h2>
        <p>Everything you need to share your culinary creations</p>
        <span class="section-line"></span>
    </div>

    <div class="row g-4 g-lg-5">
        <div class="col-md-4">
            <div class="feature-card animate-in animate-delay-1" style="padding:0; overflow:hidden;">
                <div style="height:150px; background: url('https://images.unsplash.com/photo-1466637574441-749b8f19452f?auto=format&fit=crop&w=800') center/cover;"></div>
                <div class="text-center p-4">
                    <span class="feature-step" style="top: 140px;">01</span>
                    <div class="feature-icon mt-2">
                        <i class="bi bi-egg-fried"></i>
                    </div>
                    <h5>Share Your Recipes</h5>
                    <p>Create detailed recipes with ingredients, step-by-step instructions, cooking times, and beautiful photos.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-card animate-in animate-delay-2" style="padding:0; overflow:hidden;">
                <div style="height:150px; background: url('https://images.unsplash.com/photo-1528605248644-14dd04022da1?auto=format&fit=crop&w=800') center/cover;"></div>
                <div class="text-center p-4">
                    <span class="feature-step" style="top: 140px;">02</span>
                    <div class="feature-icon mt-2">
                        <i class="bi bi-people"></i>
                    </div>
                    <h5>Community Driven</h5>
                    <p>Connect with fellow food enthusiasts, discover new cuisines, and grow your culinary skills together.</p>
                <div class="col-12">
                    <div class="alert alert-info mb-0">No featured recipes yet. Be the first to add one.</div>
                </div>
            @endforelse
        </div>
        <div class="col-md-4">
            <div class="feature-card animate-in animate-delay-3" style="padding:0; overflow:hidden;">
                <div style="height:150px; background: url('https://images.unsplash.com/photo-1507048331197-7d4ac70811cf?auto=format&fit=crop&w=800') center/cover;"></div>
                <div class="text-center p-4">
                    <span class="feature-step" style="top: 140px;">03</span>
                    <div class="feature-icon mt-2">
                        <i class="bi bi-lightning-charge"></i>
                    </div>
                    <h5>Easy to Use</h5>
                    <p>Intuitive interface with powerful search, filtering, and category features. Start creating in minutes.</p>
                </div>
            </div>
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
    <div class="cta-banner text-center cta-content py-5 rounded-4 shadow-lg text-white" style="background: linear-gradient(rgba(232,87,61,0.7), rgba(209,68,41,0.85)), url('https://images.unsplash.com/photo-1504674900247-0877df9cc836?q=80&w=2670&auto=format&fit=crop') center/cover; z-index: 1;">
        <h3 class="mb-2 fw-bold" style="text-shadow: 1px 1px 3px rgba(0,0,0,0.5);">Ready to Start Cooking?</h3>
        <p class="mb-4 lead text-white-50">Join our community of food lovers sharing their best recipes every day.</p>
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
    </div>
</div>
@endsection
