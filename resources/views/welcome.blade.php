@extends('layouts.app')

@section('content')
<div class="custom-hero-small">
    <div class="container text-center">
        <h1 class="display-3 fw-bold">🍳 Recipe World</h1>
        <p class="lead fs-4">Your Digital Community Cookbook</p>
        <p class="mt-3">Create, share, and discover delicious recipes from food enthusiasts around the world. Join our community and start your culinary journey today!</p>
        <div class="mt-4">
            @guest
                <a href="{{ route('register') }}" class="btn btn-primary btn-lg px-4 me-2">Get Started</a>
                <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-lg px-4">Log In</a>
            @else
                <a href="{{ route('blog.index') }}" class="btn btn-primary btn-lg px-4 me-2">Browse Recipes</a>
                <a href="{{ route('posts.create') }}" class="btn btn-outline-secondary btn-lg px-4">Create Recipe</a>
            @endguest
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold">How It Works</h2>
        <p class="text-muted">Get started with Recipe World in three simple steps</p>
    </div>
    <div class="row text-center">
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <i class="bi bi-person-plus fs-1 text-primary mb-3 d-block"></i>
                    <h5 class="fw-bold">1. Create an Account</h5>
                    <p class="text-muted">Sign up for free and join our growing community of food enthusiasts and home cooks.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <i class="bi bi-pencil-square fs-1 text-primary mb-3 d-block"></i>
                    <h5 class="fw-bold">2. Share Your Recipes</h5>
                    <p class="text-muted">Add your favourite recipes with ingredients, instructions, images, and cooking details.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <i class="bi bi-search fs-1 text-primary mb-3 d-block"></i>
                    <h5 class="fw-bold">3. Discover & Cook</h5>
                    <p class="text-muted">Browse, search, and filter recipes by category or difficulty to find your next meal.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
