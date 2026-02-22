@extends('layouts.app')

@section('content')
<div class="custom-hero-small">
    <div class="container text-center">
        <h1 class="display-4 fw-bold">About Us</h1>
        <p class="lead">Learn more about our blogging platform</p>
    </div>
</div>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <h3 class="mb-3">Our Story</h3>
                    <p>Welcome to {{ config('app.name', 'Laravel Blog') }}! We are a community-driven blogging platform built for developers and tech enthusiasts who want to share their knowledge and experiences.</p>
                    <p>Our platform is built using Laravel, one of the most popular PHP frameworks, combined with Bootstrap for a clean and responsive design.</p>
                </div>
            </div>

            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <h3 class="mb-3">Our Mission</h3>
                    <p>We believe that sharing knowledge is the best way to grow as developers. Our mission is to provide a simple, easy-to-use platform where anyone can write and publish blog posts about technology, coding, and software development.</p>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h3 class="mb-3">What We Offer</h3>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Free blog post creation and publishing</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Image upload support for featured images</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Category organization for your content</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> User-friendly interface with responsive design</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Secure authentication and user management</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
