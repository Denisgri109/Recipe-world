@extends('layouts.app')

@section('content')
<div class="custom-hero-small">
    <div class="container text-center">
        <h1 class="display-4 fw-bold">Contact Us</h1>
        <p class="lead">We'd love to hear from you</p>
    </div>
</div>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row mb-4">
                <div class="col-md-4 mb-3">
                    <div class="card border-0 shadow-sm text-center h-100">
                        <div class="card-body p-4">
                            <i class="bi bi-envelope fs-1 text-primary mb-3 d-block"></i>
                            <h5>Email</h5>
                            <p class="text-muted mb-0">info@recipeworld.com</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card border-0 shadow-sm text-center h-100">
                        <div class="card-body p-4">
                            <i class="bi bi-geo-alt fs-1 text-primary mb-3 d-block"></i>
                            <h5>Location</h5>
                            <p class="text-muted mb-0">Dublin, Ireland</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card border-0 shadow-sm text-center h-100">
                        <div class="card-body p-4">
                            <i class="bi bi-phone fs-1 text-primary mb-3 d-block"></i>
                            <h5>Phone</h5>
                            <p class="text-muted mb-0">+353 1 234 5678</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
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
</div>
@endsection
