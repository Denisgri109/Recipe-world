@extends('layouts.app')

@section('content')
{{-- ─── Hero ──────────────────────────────────────────────── --}}
<div class="browse-header position-relative" style="background: linear-gradient(rgba(232,87,61,0.8), rgba(209,68,41,0.85)), url('https://images.unsplash.com/photo-1493770348161-369560ae357d?q=80&w=2670&auto=format&fit=crop') center/cover; padding: 4rem 0 6rem; color: #fff;">
    <div class="container hero-content text-center">
        <div class="hero-emoji" style="font-size: 3.5rem;">🧑‍🍳</div>
        <h1 class="mb-2 text-white" style="font-family: 'Playfair Display', serif; font-size: 2.8rem; font-weight: 800;">About Recipe World</h1>
        <p class="mb-0 text-white-50 fs-5">A digital community cookbook built with passion</p>
    </div>
    <div class="browse-wave position-absolute bottom-0 w-100">
        <svg viewBox="0 0 1440 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" style="width:100%; height:60px; display:block;">
            <path d="M0,30 C480,70 960,0 1440,30 L1440,60 L0,60 Z" fill="#FFFCF8"/>
        </svg>
    </div>
</div>

{{-- ─── Our Story ─────────────────────────────────────────── --}}
<div class="container py-5">
    <div class="row align-items-center mb-5 g-5">
        <div class="col-lg-6 animate-in animate-delay-1">
            <div class="about-story-card">
                <div class="d-flex align-items-center mb-3 gap-2">
                    <div class="contact-icon-circle" style="width: 48px; height: 48px; border-radius: 14px; font-size: 1.2rem;">
                        <i class="bi bi-book"></i>
                    </div>
                    <h3 class="mb-0 text-coral">Our Story</h3>
                </div>
                <p>Welcome to <strong>{{ config('app.name', 'Recipe World') }}</strong> — a collaborative, database-driven web application designed as a digital community cookbook. Built as part of our Cloud Application Development module at college, Recipe World allows food enthusiasts to create personal accounts where they can securely manage their own culinary creations.</p>
                <p class="mb-0">Users can perform full CRUD operations — creating, reading, updating, and deleting recipes — complete with ingredient lists, step-by-step instructions, and high-quality image uploads. The application also features a robust search and filtering system, allowing users to discover recipes by category or difficulty level.</p>
            </div>
        </div>
        <div class="col-lg-6 animate-in animate-delay-2">
            <img src="https://images.unsplash.com/photo-1507048331197-7d4ac70811cf?q=80&w=1000&auto=format&fit=crop" class="img-fluid rounded-4 shadow-lg" alt="Community Cooking" style="height: 400px; width: 100%; object-fit: cover;">
        </div>
    </div>

    {{-- ─── Our Mission ───────────────────────────────────── --}}
    <div class="row flex-row-reverse align-items-center mb-5 g-5">
        <div class="col-lg-6 animate-in animate-delay-3">
            <div class="about-story-card">
                <div class="d-flex align-items-center mb-3 gap-2">
                    <div class="contact-icon-circle" style="width: 48px; height: 48px; border-radius: 14px; font-size: 1.2rem; background: linear-gradient(135deg, rgba(245, 166, 35, 0.12), rgba(245, 166, 35, 0.05)); color: #D4942A;">
                        <i class="bi bi-bullseye"></i>
                    </div>
                    <h3 class="mb-0" style="color: #D4942A;">Our Mission</h3>
                </div>
                <p class="mb-0">We believe that cooking brings people together. Our mission is to provide a simple, easy-to-use platform where anyone can share their favourite recipes — complete with ingredients, step-by-step instructions, and beautiful images — and discover new dishes to try at home. Good food should be accessible to everyone, and so should the inspiration to cook it.</p>
            </div>
        </div>
        <div class="col-lg-6 animate-in animate-delay-4">
            <img src="https://images.unsplash.com/photo-1490645935967-10de6ba17061?q=80&w=1000&auto=format&fit=crop" class="img-fluid rounded-4 shadow-lg" alt="Fresh Ingredients" style="height: 350px; width: 100%; object-fit: cover;">
        </div>
    </div>
</div>

{{-- ─── Team & Tech ───────────────────────────────────────── --}}
<div class="about-section alt-bg py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                {{-- Meet the Team --}}
                <div class="section-header text-center">
                    <h2>Meet the Team</h2>
                    <p>Recipe World was built by two passionate developers</p>
                    <span class="section-line"></span>
                </div>

                <div class="row g-4 mb-5 justify-content-center">
                    <div class="col-md-5">
                        <div class="team-member-card animate-in animate-delay-1">
                            <div class="d-flex align-items-center gap-3">
                                <div class="team-avatar">
                                    <i class="bi bi-person-fill"></i>
                                </div>
                                <div>
                                    <h5 class="mb-1 fw-bold">Denis</h5>
                                    <p class="text-muted small mb-0">Full-Stack Developer</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="team-member-card animate-in animate-delay-2">
                            <div class="d-flex align-items-center gap-3">
                                <div class="team-avatar" style="background: linear-gradient(135deg, #F5A623, #D4942A);">
                                    <i class="bi bi-person-fill"></i>
                                </div>
                                <div>
                                    <h5 class="mb-1 fw-bold">Roman</h5>
                                    <p class="text-muted small mb-0">Full-Stack Developer</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Technology Stack --}}
                <div class="section-header text-center">
                    <h2>Technology Stack</h2>
                    <p>Built with modern, industry-standard technologies</p>
                    <span class="section-line"></span>
                </div>

                <div class="row g-4 mb-5">
                    <div class="col-sm-6 col-lg-3">
                        <div class="tech-card text-center p-4 h-100 animate-in animate-delay-1">
                            <div class="tech-icon-wrap mx-auto" style="background: linear-gradient(135deg, rgba(232, 87, 61, 0.12), rgba(232, 87, 61, 0.04));">
                                <i class="bi bi-filetype-php text-coral"></i>
                            </div>
                            <h6 class="fw-bold mb-1">Laravel 10</h6>
                            <small class="text-muted">PHP Framework</small>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="tech-card text-center p-4 h-100 animate-in animate-delay-2">
                            <div class="tech-icon-wrap mx-auto" style="background: linear-gradient(135deg, rgba(99, 102, 241, 0.12), rgba(99, 102, 241, 0.04));">
                                <i class="bi bi-bootstrap" style="color: #6366F1;"></i>
                            </div>
                            <h6 class="fw-bold mb-1">Bootstrap 5</h6>
                            <small class="text-muted">CSS Framework</small>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="tech-card text-center p-4 h-100 animate-in animate-delay-3">
                            <div class="tech-icon-wrap mx-auto" style="background: linear-gradient(135deg, rgba(14, 165, 233, 0.12), rgba(14, 165, 233, 0.04));">
                                <i class="bi bi-cloud" style="color: #0EA5E9;"></i>
                            </div>
                            <h6 class="fw-bold mb-1">Microsoft Azure</h6>
                            <small class="text-muted">Cloud Hosting</small>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="tech-card text-center p-4 h-100 animate-in animate-delay-4">
                            <div class="tech-icon-wrap mx-auto" style="background: linear-gradient(135deg, rgba(245, 166, 35, 0.12), rgba(245, 166, 35, 0.04));">
                                <i class="bi bi-database" style="color: #D4942A;"></i>
                            </div>
                            <h6 class="fw-bold mb-1">MySQL</h6>
                            <small class="text-muted">Database</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ─── CTA ───────────────────────────────────────────────── --}}
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="cta-banner text-center cta-content py-5 rounded-4 shadow-lg text-white" style="background: linear-gradient(rgba(232,87,61,0.7), rgba(209,68,41,0.85)), url('https://images.unsplash.com/photo-1493770348161-369560ae357d?q=80&w=2670&auto=format&fit=crop') center/cover; z-index: 1;">
                <h3 class="mb-2 fw-bold" style="text-shadow: 1px 1px 3px rgba(0,0,0,0.5);">Ready to Start Cooking?</h3>
                <p class="mb-4 lead text-white-50">Join our community and start sharing your favourite recipes today.</p>
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
