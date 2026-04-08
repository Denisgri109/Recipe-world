@extends('layouts.app')

@section('content')
<!-- Hero Section (consistent with home page) -->
<div class="bg-primary text-white py-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-3 fw-bold mb-4">About Recipe World</h1>
                <p class="lead mb-3">A digital community cookbook built with passion</p>
                <p class="fs-5 mb-0">Created by food lovers, for food lovers — discover the story behind the platform.</p>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            {{-- Our Story --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <h3 class="mb-3"><i class="bi bi-book me-2 text-primary"></i>Our Story</h3>
                    <p>Welcome to <strong>{{ config('app.name', 'Recipe World') }}</strong> — a collaborative, database-driven web application designed as a digital community cookbook. Built as part of our Cloud Application Development module at college, Recipe World allows food enthusiasts to create personal accounts where they can securely manage their own culinary creations.</p>
                    <p class="mb-0">Users can perform full CRUD operations — creating, reading, updating, and deleting recipes — complete with ingredient lists, step-by-step instructions, and high-quality image uploads. The application also features a robust search and filtering system, allowing users to discover recipes by category or difficulty level.</p>
                </div>
            </div>

            {{-- Our Mission --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <h3 class="mb-3"><i class="bi bi-bullseye me-2 text-primary"></i>Our Mission</h3>
                    <p class="mb-0">We believe that cooking brings people together. Our mission is to provide a simple, easy-to-use platform where anyone can share their favourite recipes — complete with ingredients, step-by-step instructions, and beautiful images — and discover new dishes to try at home.</p>
                </div>
            </div>

            {{-- Meet the Team --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <h3 class="mb-3"><i class="bi bi-people-fill me-2 text-primary"></i>Meet the Team</h3>
                    <p>Recipe World was built by two passionate developers as part of our Cloud Application Development module:</p>
                    <div class="row g-3 mt-2">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center p-3 rounded" style="background: linear-gradient(135deg, #667eea22 0%, #764ba222 100%);">
                                <div class="text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px; min-width: 50px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                    <i class="bi bi-person-fill fs-4"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0">Denis</h5>
                                    <small class="text-muted">Full-Stack Developer</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center p-3 rounded" style="background: linear-gradient(135deg, #667eea22 0%, #764ba222 100%);">
                                <div class="text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px; min-width: 50px; background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);">
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
            </div>

            {{-- Technology Stack --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <h3 class="mb-3"><i class="bi bi-code-slash me-2 text-primary"></i>Technology Stack</h3>
                    <p>Recipe World is built with modern, industry-standard technologies:</p>
                    <div class="row g-3 mt-2">
                        <div class="col-sm-6 col-lg-3">
                            <div class="text-center p-3 bg-light rounded h-100">
                                <i class="bi bi-filetype-php fs-1 text-primary d-block mb-2"></i>
                                <h6 class="fw-bold mb-1">Laravel 10</h6>
                                <small class="text-muted">PHP Framework</small>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="text-center p-3 bg-light rounded h-100">
                                <i class="bi bi-bootstrap fs-1 text-primary d-block mb-2"></i>
                                <h6 class="fw-bold mb-1">Bootstrap 5</h6>
                                <small class="text-muted">CSS Framework</small>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="text-center p-3 bg-light rounded h-100">
                                <i class="bi bi-cloud fs-1 text-primary d-block mb-2"></i>
                                <h6 class="fw-bold mb-1">Microsoft Azure</h6>
                                <small class="text-muted">Cloud Hosting</small>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="text-center p-3 bg-light rounded h-100">
                                <i class="bi bi-database fs-1 text-primary d-block mb-2"></i>
                                <h6 class="fw-bold mb-1">MySQL</h6>
                                <small class="text-muted">Database</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- What We Offer --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <h3 class="mb-3"><i class="bi bi-star-fill me-2 text-primary"></i>What We Offer</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Free recipe creation with ingredients & instructions</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Image upload support for featured recipe photos</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Category organisation for your recipes</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Search and filter by category & difficulty</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Responsive design across all devices</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Secure authentication & user management</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            {{-- CTA --}}
            <div class="text-center py-4">
                <h4 class="fw-bold mb-3">Ready to Start Cooking?</h4>
                <p class="text-muted mb-4">Join our community and start sharing your favourite recipes today.</p>
                @guest
                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg px-5 me-2">Sign Up Free</a>
                    <a href="{{ route('recipes.index') }}" class="btn btn-outline-primary btn-lg px-5">Browse Recipes</a>
                @else
                    <a href="{{ route('recipes.create') }}" class="btn btn-primary btn-lg px-5 me-2">Create a Recipe</a>
                    <a href="{{ route('recipes.index') }}" class="btn btn-outline-primary btn-lg px-5">Browse Recipes</a>
                @endguest
            </div>

        </div>
    </div>
</div>
@endsection
