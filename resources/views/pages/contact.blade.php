@extends('layouts.app')

@section('content')
{{-- ─── Hero ──────────────────────────────────────────────── --}}
<div class="browse-header">
    <div class="container hero-content">
        <h1 class="mb-1"><i class="bi bi-envelope me-2"></i>Contact Us</h1>
        <p class="mb-0">We'd love to hear from you</p>
    </div>
    <div class="browse-wave">
        <svg viewBox="0 0 1440 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0,30 C480,70 960,0 1440,30 L1440,60 L0,60 Z" fill="#FFFCF8"/>
        </svg>
    </div>
</div>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row mb-4">
                <div class="col-md-4 mb-3">
                    <div class="feature-card text-center h-100 animate-in animate-delay-1">
                        <div class="feature-icon"><i class="bi bi-envelope"></i></div>
                        <h5>Email</h5>
                        <p class="text-muted mb-0">info@recipeworld.com</p>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="feature-card text-center h-100 animate-in animate-delay-2">
                        <div class="feature-icon"><i class="bi bi-geo-alt"></i></div>
                        <h5>Location</h5>
                        <p class="text-muted mb-0">Dublin, Ireland</p>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="feature-card text-center h-100 animate-in animate-delay-3">
                        <div class="feature-icon"><i class="bi bi-phone"></i></div>
                        <h5>Phone</h5>
                        <p class="text-muted mb-0">+353 1 234 5678</p>
                    </div>
                </div>
            </div>

            <div class="feature-card animate-in animate-delay-4">
                <h3 class="mb-4">Send Us a Message</h3>
                <form>
                    <div class="mb-3">
                        <label for="name" class="form-label">Your Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter your name">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter your email">
                    </div>
                    <div class="mb-3">
                        <label for="subject" class="form-label">Subject</label>
                        <input type="text" class="form-control" id="subject" placeholder="What is this about?">
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" rows="5" placeholder="Write your message here..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary px-4">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
