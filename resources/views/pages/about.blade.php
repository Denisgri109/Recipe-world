@extends('layouts.app')

@section('content')
<div class="browse-header position-relative" style="background: linear-gradient(rgba(232,87,61,0.8), rgba(209,68,41,0.85)), url('https://images.unsplash.com/photo-1556910103-1c02745aae4d?q=80&w=2670&auto=format&fit=crop') center/cover; padding: 4rem 0 6rem; color: #fff;">
    <div class="container hero-content text-center">
        <h1 class="mb-1 text-white"><i class="bi bi-info-circle me-2"></i>About Recipe World</h1>
        <p class="mb-0 text-white-50">A digital community cookbook built with passion</p>
    </div>
    <div class="browse-wave position-absolute bottom-0 w-100">
        <svg viewBox="0 0 1440 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" style="width:100%; height:60px; display:block;">
            <path d="M0,30 C480,70 960,0 1440,30 L1440,60 L0,60 Z" fill="#FFFCF8"/>
        </svg>
    </div>
</div>

<div class="container py-5">
    <div class="row align-items-center mb-5">
        <div class="col-lg-6 mb-4 mb-lg-0 pe-lg-5">
            <div class="feature-card h-100 animate-in animate-delay-1">
                <h3 class="mb-3"><i class="bi bi-book me-2 text-coral"></i>Our Story</h3>
                <p>Welcome to <strong>{{ config('app.name', 'Recipe World') }}</strong>  a collaborative, database-driven web application designed as a digital community cookbook. Built as part of our Cloud Application Development module at college, Recipe World allows food enthusiasts to create personal accounts where they can securely manage their own culinary creations.</p>
                <p class="mb-0">Users can perform full CRUD operations  creating, reading, updating, and deleting recipes  complete with ingredient lists, step-by-step instructions, and high-quality image uploads. The application also features a robust search and filtering system, allowing users to discover recipes by category or difficulty level.</p>
            </div>
        </div>
        <div class="col-lg-6 animate-in animate-delay-2">
            <img src="https://images.unsplash.com/photo-1507048331197-7d4ac70811cf?q=80&w=1000&auto=format&fit=crop" class="img-fluid rounded-4 shadow-lg" alt="Community Cooking" style="height: 400px; width: 100%; object-fit: cover;">
        </div>
    </div>

    <div class="row flex-row-reverse align-items-center mb-5">
        <div class="col-lg-6 mb-4 mb-lg-0 ps-lg-5">
            <div class="feature-card h-100 animate-in animate-delay-3">
                <h3 class="mb-3"><i class="bi bi-bullseye me-2 text-coral"></i>Our Mission</h3>
                <p class="mb-0">We believe that cooking brings people together. Our mission is to provide a simple, easy-to-use platform where anyone can share their favourite recipes  complete with ingredients, step-by-step instructions, and beautiful images  and discover new dishes to try at home. Good food should be accessible to everyone, and so should the inspiration to cook it.</p>
            </div>
        </div>
        <div class="col-lg-6 animate-in animate-delay-4">
            <img src="https://images.unsplash.com/photo-1490645935967-10de6ba17061?q=80&w=1000&auto=format&fit=crop" class="img-fluid rounded-4 shadow-lg" alt="Fresh Ingredients" style="height: 300px; width: 100%; object-fit: cover;">
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            {{-- Meet the Team --}}
            <div class="feature-card mb-5 animate-in animate-delay-2">
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
            <div class="feature-card mb-5 animate-in animate-delay-3">
                <h3 class="mb-3"><i class="bi bi-code-slash me-2 text-coral"></i>Technology Stack</h3>
                <p>Recipe World is built with modern, industry-standard technologies:</p>
                <div class="row g-3 mt-2">
                    <div class="col-sm-6 col-lg-3">
                        <div class="text-center p-3 rounded tech-card h-100 shadow-sm border">
                            <i class="bi bi-filetype-php fs-1 text-coral d-block mb-2"></i>
                            <h6 class="fw-bold mb-1">Laravel 10</h6>
                            <small class="text-muted">PHP Framework</small>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="text-center p-3 rounded tech-card h-100 shadow-sm border">
                            <i class="bi bi-bootstrap fs-1 text-coral d-block mb-2"></i>
                            <h6 class="fw-bold mb-1">Bootstrap 5</h6>
                            <small class="text-muted">CSS Framework</small>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="text-center p-3 rounded tech-card h-100 shadow-sm border">
                            <i class="bi bi-cloud fs-1 text-coral d-block mb-2"></i>
                            <h6 class="fw-bold mb-1">Microsoft Azure</h6>
                            <small class="text-muted">Cloud Hosting</small>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="text-center p-3 rounded tech-card h-100 shadow-sm border">
                            <i class="bi bi-database fs-1 text-coral d-block mb-2"></i>
                            <h6 class="fw-bold mb-1">MySQL</h6>
                            <small class="text-muted">Database</small>
                        </div>
                    </div>
                </div>
            </div>

            {{-- CTA --}}
            <div class="cta-banner text-center cta-content py-5 rounded-4 shadow-lg text-white" style="background: linear-gradient(rgba(232,87,61,0.7), rgba(209,68,41,0.85)), url('https://images.unsplash.com/photo-1542010589005-d1eabd39f864?q=80&w=2670&auto=format&fit=crop') center/cover; z-index: 1;">
                <h3 class="mb-2 fw-bold" style="text-shadow: 1px 1px 3px rgba(0,0,0,0.5);">Ready to Start Cooking?</h3>
                <p class="mb-4 lead text-white-50">Join our community and start sharing your favourite recipes today.</p>
                @guest
                    <a href="{{ route('register') }}" class="btn btn-light btn-lg me-2 text-coral fw-bold">Sign Up Free</a>
                    <a href="{{ route('recipes.index') }}" class="btn btn-outline-light btn-lg">Browse Recipes</a>
                @else
                    <a href="{{ route('recipes.create') }}" class="btn btn-light btn-lg me-2 text-coral fw-bold">Create a Recipe</a>
                    <a href="{{ route('recipes.index') }}" class="btn btn-outline-light btn-lg">Browse Recipes</a>
                @endguest
            </div>

        </div>
    </div>
</div>
@endsection
