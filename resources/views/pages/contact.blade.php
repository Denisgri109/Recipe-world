@extends('layouts.app')

@section('content')
<div class="browse-header position-relative" style="background: linear-gradient(rgba(232,87,61,0.8), rgba(209,68,41,0.85)), url('https://images.unsplash.com/photo-1490481651871-ab68de25d43d?q=80&w=2670&auto=format&fit=crop') center/cover; padding: 4rem 0 6rem; color: #fff;">
    <div class="container hero-content text-center">
        <h1 class="mb-1 text-white"><i class="bi bi-envelope me-2"></i>Contact Us</h1>
        <p class="mb-0 text-white-50">We'd love to hear from you</p>
    </div>
    <div class="browse-wave position-absolute bottom-0 w-100">
        <svg viewBox="0 0 1440 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" style="width:100%; height:60px; display:block;">
            <path d="M0,30 C480,70 960,0 1440,30 L1440,60 L0,60 Z" fill="#FFFCF8"/>
        </svg>
    </div>
</div>

<div class="container py-5">
    <div class="row mb-5 g-4 justify-content-center">
        <div class="col-md-4">
            <div class="feature-card text-center h-100 animate-in animate-delay-1 border-0 shadow-sm rounded-4">
                <div class="feature-icon mb-3 text-coral fs-1"><i class="bi bi-envelope"></i></div>
                <h5 class="fw-bold">Email</h5>
                <p class="text-muted mb-0">info@recipeworld.com</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-card text-center h-100 animate-in animate-delay-2 border-0 shadow-sm rounded-4">
                <div class="feature-icon mb-3 text-coral fs-1"><i class="bi bi-geo-alt"></i></div>
                <h5 class="fw-bold">Location</h5>
                <p class="text-muted mb-0">Dublin, Ireland</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-card text-center h-100 animate-in animate-delay-3 border-0 shadow-sm rounded-4">
                <div class="feature-icon mb-3 text-coral fs-1"><i class="bi bi-phone"></i></div>
                <h5 class="fw-bold">Phone</h5>
                <p class="text-muted mb-0">+353 1 234 5678</p>
            </div>
        </div>
    </div>

    <div class="row align-items-center g-5">
        <div class="col-lg-6 d-none d-lg-block animate-in animate-delay-4">
            <img src="https://images.unsplash.com/photo-1577219491135-ce391730fb2c?q=80&w=800&auto=format&fit=crop" class="img-fluid rounded-4 shadow-lg" alt="Contact Us" style="height: 600px; width: 100%; object-fit: cover;">
        </div>
        <div class="col-lg-6">
            <div class="feature-card animate-in animate-delay-5 border-0 shadow bg-white p-4 p-md-5 rounded-4">
                <h3 class="mb-4 fw-bold">Send Us a Message</h3>
                <form>
                    <div class="mb-4">
                        <label for="name" class="form-label text-muted">Your Name</label>
                        <input type="text" class="form-control form-control-lg bg-light border-0" id="name" placeholder="Enter your name">
                    </div>
                    <div class="mb-4">
                        <label for="email" class="form-label text-muted">Email Address</label>
                        <input type="email" class="form-control form-control-lg bg-light border-0" id="email" placeholder="Enter your email">
                    </div>
                    <div class="mb-4">
                        <label for="subject" class="form-label text-muted">Subject</label>
                        <input type="text" class="form-control form-control-lg bg-light border-0" id="subject" placeholder="What is this about?">
                    </div>
                    <div class="mb-4">
                        <label for="message" class="form-label text-muted">Message</label>
                        <textarea class="form-control form-control-lg bg-light border-0" id="message" rows="6" placeholder="Write your message here..."></textarea>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg rounded-3 fw-bold" style="background-color: #E8573D; border-color: #E8573D;">Send Message</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
