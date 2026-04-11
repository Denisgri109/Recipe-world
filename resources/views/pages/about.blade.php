@extends('layouts.app')

@section('content')
{{-- ─── Hero ──────────────────────────────────────────────── --}}
<div class="browse-header">
    <div class="container hero-content">
        <h1 class="mb-1"><i class="bi bi-info-circle me-2"></i>About Recipe World</h1>
        <p class="mb-0">A digital community cookbook built with passion</p>
    </div>
    <div class="browse-wave">
        <svg viewBox="0 0 1440 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0,30 C480,70 960,0 1440,30 L1440,60 L0,60 Z" fill="#FFFCF8"/>
        </svg>
    </div>
</div>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            {{-- Our Story --}}
            <div class="feature-card mb-4 animate-in animate-delay-1">
                <h3 class="mb-3"><i class="bi bi-book me-2 text-coral"></i>Our Story</h3>
                <p>Welcome to <strong>{{ config('app.name', 'Recipe World') }}</strong> — a collaborative, database-driven web application designed as a digital community cookbook. Built as part of our Cloud Application Development module at college, Recipe World allows food enthusiasts to create personal accounts where they can securely manage their own culinary creations.</p>
                <p class="mb-0">Users can perform full CRUD operations — creating, reading, updating, and deleting recipes — complete with ingredient lists, step-by-step instructions, and high-quality image uploads. The application also features a robust search and filtering system, allowing users to discover recipes by category or difficulty level.</p>
            </div>

            {{-- Our Mission --}}
            <div class="feature-card mb-4 animate-in animate-delay-2">
                <h3 class="mb-3"><i class="bi bi-bullseye me-2 text-coral"></i>Our Mission</h3>
                <p class="mb-0">We believe that cooking brings people together. Our mission is to provide a simple, easy-to-use platform where anyone can share their favourite recipes — complete with ingredients, step-by-step instructions, and beautiful images — and discover new dishes to try at home.</p>
            </div>

            {{-- Meet the Team --}}
            <div class="feature-card mb-4 animate-in animate-delay-3">
                <h3 class="mb-3"><i class="bi bi-people-fill me-2 text-coral"></i>Meet the Team</h3>
                <p>Recipe World was built by two passionate developers as part of our Cloud Application Development module:</p>
                <div class="row g-3 mt-2">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center p-3 rounded team-member-card">
                            <div class="team-avatar me-3">
                                <i class="bi bi-person-fill fs-4"></i>
                            </div>
                            <div>
                                <h5 class="mb-0">Denis</h5>
                                <small class="text-muted">Full-Stack Developer</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center p-3 rounded team-member-card">
                            <div class="team-avatar me-3">
                                <i class="bi bi-person-fill fs-4"></i>
                            </div>
                            <div>
                                <h5 class="mb-0">Roman</h5>
                                <small class="text-muted">Full-Stack Developer</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Technology Stack --}}
            <div class="feature-card mb-4 animate-in animate-delay-4">
                <h3 class="mb-3"><i class="bi bi-code-slash me-2 text-coral"></i>Technology Stack</h3>
                <p>Recipe World is built with modern, industry-standard technologies:</p>
                <div class="row g-3 mt-2">
                    <div class="col-sm-6 col-lg-3">
                        <div class="text-center p-3 rounded tech-card h-100">
                            <i class="bi bi-filetype-php fs-1 text-coral d-block mb-2"></i>
                            <h6 class="fw-bold mb-1">Laravel 10</h6>
                            <small class="text-muted">PHP Framework</small>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="text-center p-3 rounded tech-card h-100">
                            <i class="bi bi-bootstrap fs-1 text-coral d-block mb-2"></i>
                            <h6 class="fw-bold mb-1">Bootstrap 5</h6>
                            <small class="text-muted">CSS Framework</small>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="text-center p-3 rounded tech-card h-100">
                            <i class="bi bi-cloud fs-1 text-coral d-block mb-2"></i>
                            <h6 class="fw-bold mb-1">Microsoft Azure</h6>
                            <small class="text-muted">Cloud Hosting</small>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="text-center p-3 rounded tech-card h-100">
                            <i class="bi bi-database fs-1 text-coral d-block mb-2"></i>
                            <h6 class="fw-bold mb-1">MySQL</h6>
                            <small class="text-muted">Database</small>
                        </div>
                    </div>
                </div>
            </div>

            {{-- What We Offer --}}
            <div class="feature-card mb-4 animate-in animate-delay-5">
                <h3 class="mb-3"><i class="bi bi-star-fill me-2 text-coral"></i>What We Offer</h3>
                <div class="row">
                    <div class="col-md-6">
                        <ul class="list-unstyled">
                            <li class="mb-3 d-flex align-items-start">
                                <span class="feature-check me-2 mt-1"><i class="bi bi-check-lg"></i></span>
                                Free recipe creation with ingredients & instructions
                            </li>
                            <li class="mb-3 d-flex align-items-start">
                                <span class="feature-check me-2 mt-1"><i class="bi bi-check-lg"></i></span>
                                Image upload support for featured recipe photos
                            </li>
                            <li class="mb-3 d-flex align-items-start">
                                <span class="feature-check me-2 mt-1"><i class="bi bi-check-lg"></i></span>
                                Category organisation for your recipes
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-unstyled">
                            <li class="mb-3 d-flex align-items-start">
                                <span class="feature-check me-2 mt-1"><i class="bi bi-check-lg"></i></span>
                                Search and filter by category & difficulty
                            </li>
                            <li class="mb-3 d-flex align-items-start">
                                <span class="feature-check me-2 mt-1"><i class="bi bi-check-lg"></i></span>
                                Responsive design across all devices
                            </li>
                            <li class="mb-3 d-flex align-items-start">
                                <span class="feature-check me-2 mt-1"><i class="bi bi-check-lg"></i></span>
                                Secure authentication & user management
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- CTA --}}
            <div class="cta-banner text-center cta-content">
                <h3 class="mb-2">Ready to Start Cooking?</h3>
                <p class="mb-4">Join our community and start sharing your favourite recipes today.</p>
                @guest
                    <a href="{{ route('register') }}" class="btn-cta me-2">Sign Up Free</a>
                    <a href="{{ route('recipes.index') }}" class="btn-hero btn-ghost">Browse Recipes</a>
                @else
                    <a href="{{ route('recipes.create') }}" class="btn-cta me-2">Create a Recipe</a>
                    <a href="{{ route('recipes.index') }}" class="btn-hero btn-ghost">Browse Recipes</a>
                @endguest
            </div>

        </div>
    </div>
</div>
@endsection
