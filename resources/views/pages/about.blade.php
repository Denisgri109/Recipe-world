@extends('layouts.app')

@section('content')
<div class="custom-hero-small">
    <div class="container text-center">
        <h1 class="display-4 fw-bold">About Us</h1>
        <p class="lead">Learn more about Recipe World</p>
    </div>
</div>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <h3 class="mb-3">Our Story</h3>
                    <p>Welcome to {{ config('app.name', 'Recipe World') }}! We are a collaborative, community-driven platform built for food enthusiasts who want to create, share, and discover delicious recipes from around the world.</p>
                    <p>Our platform is built using Laravel, one of the most popular PHP frameworks, combined with Bootstrap for a clean and responsive design. Deployed on Microsoft Azure, Recipe World ensures your culinary creations are always accessible.</p>
                </div>
            </div>

            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <h3 class="mb-3">Our Mission</h3>
                    <p>We believe that cooking brings people together. Our mission is to provide a simple, easy-to-use platform where anyone can share their favourite recipes - complete with ingredients, step-by-step instructions, and beautiful images - and discover new dishes to try at home.</p>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h3 class="mb-3">What We Offer</h3>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Free recipe creation with ingredients and instructions</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Image upload support for featured recipe photos</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Category organisation for your recipes</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Search and filter recipes by category and difficulty</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> User-friendly interface with responsive design</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Secure authentication and user management</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
