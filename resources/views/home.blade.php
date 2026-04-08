@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="bg-primary text-white py-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-3 fw-bold mb-4">Welcome to Recipe World</h1>
                <p class="lead mb-4">Create, Share, and Discover Delicious Recipes</p>
                <p class="fs-5 mb-4">A collaborative community cookbook built with Laravel. Share your favourite recipes, discover new dishes, and connect with food enthusiasts everywhere.</p>
                <div class="d-flex gap-3 justify-content-center">
                    <a href="{{ route('recipes.index') }}" class="btn btn-light btn-lg px-4">Browse Recipes</a>
                    @guest
                        <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg px-4">Get Started</a>
                    @else
                        <a href="{{ route('recipes.create') }}" class="btn btn-outline-light btn-lg px-4">Create a Recipe</a>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Three Column Feature Section -->
<div class="container py-5 my-5">
    <div class="row text-center mb-5">
        <div class="col-lg-8 mx-auto">
            <h2 class="display-5 fw-bold mb-3">Why Choose Recipe World?</h2>
            <p class="lead text-muted">Everything you need to share your culinary creations with the world</p>
        </div>
    </div>
    
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <img src="https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=800&h=500&fit=crop" 
                     class="card-img-top" 
                     alt="Fresh Ingredients"
                     style="height: 250px; object-fit: cover;">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <i class="bi bi-egg-fried fs-1 text-primary"></i>
                    </div>
                    <h3 class="h4 mb-3">Share Your Recipes</h3>
                    <p class="text-muted">Create detailed recipes with ingredients, step-by-step instructions, cooking times, and beautiful photos to share with the community.</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <img src="https://images.unsplash.com/photo-1556910103-1c02745aae4d?w=800&h=500&fit=crop" 
                     class="card-img-top" 
                     alt="Community Cooking"
                     style="height: 250px; object-fit: cover;">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <i class="bi bi-people fs-1 text-primary"></i>
                    </div>
                    <h3 class="h4 mb-3">Community Driven</h3>
                    <p class="text-muted">Connect with fellow food enthusiasts, discover new cuisines, and grow your culinary skills in a supportive community of home cooks.</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <img src="https://images.unsplash.com/photo-1466637574441-749b8f19452f?w=800&h=500&fit=crop" 
                     class="card-img-top" 
                     alt="Easy to Use"
                     style="height: 250px; object-fit: cover;">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <i class="bi bi-lightning-charge fs-1 text-primary"></i>
                    </div>
                    <h3 class="h4 mb-3">Easy to Use</h3>
                    <p class="text-muted">Intuitive interface with powerful features. Start creating and sharing your recipes in minutes, not hours.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="bg-light py-5">
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h2 class="display-6 fw-bold mb-4">Powerful Features for Recipe Sharing</h2>
                <p class="lead text-muted mb-4">Everything you need to create, manage, and share your recipes effectively.</p>
                <ul class="list-unstyled">
                    <li class="mb-3">
                        <i class="bi bi-check-circle-fill text-success me-2"></i>
                        <strong>Detailed Instructions</strong> - Write step-by-step cooking instructions with ease
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-check-circle-fill text-success me-2"></i>
                        <strong>Image Uploads</strong> - Add beautiful photos of your finished dishes
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-check-circle-fill text-success me-2"></i>
                        <strong>Search & Filter</strong> - Find recipes by category, difficulty, or keyword
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-check-circle-fill text-success me-2"></i>
                        <strong>User Authentication</strong> - Secure login and registration system
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-check-circle-fill text-success me-2"></i>
                        <strong>Recipe Management</strong> - Full CRUD operations for your recipes
                    </li>
                </ul>
            </div>
            <div class="col-lg-6">
                <img src="https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=800&h=600&fit=crop" 
                     class="img-fluid rounded shadow" 
                     alt="Kitchen workspace">
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="container py-5 my-5">
    <div class="row">
        <div class="col-lg-8 mx-auto text-center">
            <h2 class="display-5 fw-bold mb-4">Ready to Start Your Culinary Journey?</h2>
            <p class="lead text-muted mb-4">Join our community of food enthusiasts and start sharing your recipes today.</p>
            @guest
                <a href="{{ route('register') }}" class="btn btn-primary btn-lg px-5 me-3">Sign Up Free</a>
                <a href="{{ route('recipes.index') }}" class="btn btn-outline-primary btn-lg px-5">Browse Recipes</a>
            @else
                <a href="{{ route('recipes.create') }}" class="btn btn-primary btn-lg px-5 me-3">Create Your First Recipe</a>
                <a href="{{ route('recipes.index') }}" class="btn btn-outline-primary btn-lg px-5">View All Recipes</a>
            @endguest
        </div>
    </div>
</div>

<!-- Statistics Section -->
<div class="bg-dark text-white py-5">
    <div class="container py-4">
        <div class="row text-center">
            <div class="col-md-3 mb-4 mb-md-0">
                <div class="display-4 fw-bold text-primary">{{ \App\Models\Recipe::count() }}+</div>
                <p class="lead mb-0">Recipes</p>
            </div>
            <div class="col-md-3 mb-4 mb-md-0">
                <div class="display-4 fw-bold text-primary">{{ \App\Models\User::count() }}+</div>
                <p class="lead mb-0">Active Users</p>
            </div>
            <div class="col-md-3 mb-4 mb-md-0">
                <div class="display-4 fw-bold text-primary">100%</div>
                <p class="lead mb-0">Free & Open</p>
            </div>
            <div class="col-md-3 mb-4 mb-md-0">
                <div class="display-4 fw-bold text-primary">24/7</div>
                <p class="lead mb-0">Available</p>
            </div>
        </div>
    </div>
</div>
@endsection

