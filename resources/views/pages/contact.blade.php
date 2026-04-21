@extends('layouts.app')

@section('content')
{{-- ─── Hero ──────────────────────────────────────────────── --}}
<div class="browse-header position-relative" style="background: linear-gradient(rgba(232,87,61,0.8), rgba(209,68,41,0.85)), url('https://images.unsplash.com/photo-1490481651871-ab68de25d43d?q=80&w=2670&auto=format&fit=crop') center/cover; padding: 4rem 0 6rem; color: #fff;">
    <div class="container hero-content text-center">
        <div class="hero-emoji" style="font-size: 3rem;">✉️</div>
        <h1 class="mb-2 text-white" style="font-family: 'Playfair Display', serif; font-size: 2.8rem; font-weight: 800;">Contact Us</h1>
        <p class="mb-0 text-white-50 fs-5">We'd love to hear from you</p>
    </div>
    <div class="browse-wave position-absolute bottom-0 w-100">
        <svg viewBox="0 0 1440 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" style="width:100%; height:60px; display:block;">
            <path d="M0,30 C480,70 960,0 1440,30 L1440,60 L0,60 Z" fill="#FFFCF8"/>
        </svg>
    </div>
</div>

{{-- ─── Contact Info Cards ────────────────────────────────── --}}
<div class="container py-5">
    <div class="row mb-5 g-4 justify-content-center">
        <div class="col-md-4">
            <div class="contact-info-card h-100 animate-in animate-delay-1">
                <div class="contact-icon-circle mx-auto">
                    <i class="bi bi-envelope"></i>
                </div>
                <h5 class="fw-bold mb-2">Email</h5>
                <p class="text-muted mb-0 small">info@recipeworld.com</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="contact-info-card h-100 animate-in animate-delay-2">
                <div class="contact-icon-circle mx-auto" style="background: linear-gradient(135deg, rgba(245, 166, 35, 0.12), rgba(245, 166, 35, 0.05)); color: #D4942A;">
                    <i class="bi bi-geo-alt"></i>
                </div>
                <h5 class="fw-bold mb-2">Location</h5>
                <p class="text-muted mb-0 small">Dublin, Ireland</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="contact-info-card h-100 animate-in animate-delay-3">
                <div class="contact-icon-circle mx-auto" style="background: linear-gradient(135deg, rgba(107, 143, 113, 0.12), rgba(107, 143, 113, 0.05)); color: #6B8F71;">
                    <i class="bi bi-phone"></i>
                </div>
                <h5 class="fw-bold mb-2">Phone</h5>
                <p class="text-muted mb-0 small">+353 1 234 5678</p>
            </div>
        </div>
    </div>

    {{-- ─── Form & Image ──────────────────────────────────── --}}
    <div class="row align-items-center g-5">
        <div class="col-lg-6 d-none d-lg-block animate-in animate-delay-4">
            <img src="https://images.unsplash.com/photo-1577219491135-ce391730fb2c?q=80&w=800&auto=format&fit=crop" class="img-fluid rounded-4 shadow-lg" alt="Contact Us" style="height: 580px; width: 100%; object-fit: cover;">
        </div>
        <div class="col-lg-6">
            <div class="contact-form-card animate-in animate-delay-5">
                <h3 class="mb-1 fw-bold" style="font-family: 'Playfair Display', serif;">Send Us a Message</h3>
                <p class="text-muted mb-4">Fill out the form below and we'll get back to you shortly.</p>
                <form>
                    <div class="row g-3 mb-3">
                        <div class="col-sm-6">
                            <label for="name" class="form-label small fw-bold text-muted text-uppercase" style="letter-spacing: 1px; font-size: 0.75rem;">Your Name</label>
                            <input type="text" class="form-control" id="name" placeholder="John Doe">
                        </div>
                        <div class="col-sm-6">
                            <label for="email" class="form-label small fw-bold text-muted text-uppercase" style="letter-spacing: 1px; font-size: 0.75rem;">Email Address</label>
                            <input type="email" class="form-control" id="email" placeholder="john@example.com">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="subject" class="form-label small fw-bold text-muted text-uppercase" style="letter-spacing: 1px; font-size: 0.75rem;">Subject</label>
                        <input type="text" class="form-control" id="subject" placeholder="What is this about?">
                    </div>
                    <div class="mb-4">
                        <label for="message" class="form-label small fw-bold text-muted text-uppercase" style="letter-spacing: 1px; font-size: 0.75rem;">Message</label>
                        <textarea class="form-control" id="message" rows="5" placeholder="Write your message here..."></textarea>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg rounded-3 fw-bold py-3" style="font-size: 0.95rem;">
                            <i class="bi bi-send me-2"></i>Send Message
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
