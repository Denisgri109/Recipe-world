@extends('layouts.app')

@section('content')
<div class="py-5 text-white" style="background: linear-gradient(135deg, #0d3b66 0%, #145da0 55%, #1f7a8c 100%);">
    <div class="container text-center py-4">
        <h1 class="display-5 fw-bold">Contact Recipe World</h1>
        <p class="lead mb-0">Questions, feedback, or collaboration ideas? Send us a message.</p>
    </div>
</div>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="row mb-4">
                <div class="col-md-4 mb-3">
                    <div class="card border-0 shadow-sm text-center h-100">
                        <div class="card-body p-4">
                            <i class="bi bi-envelope fs-1 text-primary mb-3 d-block"></i>
                            <h5 class="fw-semibold">Project Email</h5>
                            <p class="text-muted mb-0">recipeworld.team@dit.ie</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card border-0 shadow-sm text-center h-100">
                        <div class="card-body p-4">
                            <i class="bi bi-geo-alt fs-1 text-primary mb-3 d-block"></i>
                            <h5 class="fw-semibold">Location</h5>
                            <p class="text-muted mb-0">Dundalk Institute of Technology, Ireland</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card border-0 shadow-sm text-center h-100">
                        <div class="card-body p-4">
                            <i class="bi bi-people fs-1 text-primary mb-3 d-block"></i>
                            <h5 class="fw-semibold">Team</h5>
                            <p class="text-muted mb-0">Denis and Roman</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="row g-4">
                        <div class="col-lg-5">
                            <h2 class="h4 fw-bold mb-3">Send a Message</h2>
                            <p class="text-muted mb-3">Use this form to ask about Recipe World features, report issues, or share ideas for improvements.</p>
                            <p class="text-muted mb-0 small">This is a project contact form layout for CA 3 demonstration.</p>
                        </div>
                        <div class="col-lg-7">
                            <form action="#" method="post">
                                <div class="mb-3">
                                    <label for="contact_name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="contact_name" name="name" placeholder="Enter your full name">
                                </div>
                                <div class="mb-3">
                                    <label for="contact_email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="contact_email" name="email" placeholder="name@example.com">
                                </div>
                                <div class="mb-3">
                                    <label for="contact_message" class="form-label">Message</label>
                                    <textarea class="form-control" id="contact_message" name="message" rows="5" placeholder="Write your message"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary px-4">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
