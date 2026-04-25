@extends('layouts.app')

@section('title', 'View Complaint')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold"><i class="bi bi-envelope-open text-primary me-2"></i>Complaint Details</h2>
                <a href="{{ route('admin.complaints') }}" class="btn btn-outline-secondary rounded-pill px-4"><i class="bi bi-arrow-left me-1"></i> Back</a>
            </div>

            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4 p-lg-5">
                    <div class="d-flex justify-content-between align-items-start mb-4 pb-3 border-bottom">
                        <div>
                            <h4 class="fw-bold mb-1">{{ $complaint->subject }}</h4>
                            <p class="text-muted mb-0">From: <strong>{{ $complaint->name }}</strong> (<a href="mailto:{{ $complaint->email }}">{{ $complaint->email }}</a>)</p>
                        </div>
                        <div>
                            @if($complaint->status == 'pending')
                                <span class="badge bg-warning text-dark rounded-pill px-3 py-2">Pending</span>
                            @else
                                <span class="badge bg-success rounded-pill px-3 py-2">Resolved</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="mb-5">
                        <p class="text-muted small mb-2 text-uppercase fw-bold" style="letter-spacing: 1px;">Message</p>
                        <div class="p-4 bg-light rounded-4">
                            <p class="mb-0" style="white-space: pre-wrap;">{{ $complaint->message }}</p>
                        </div>
                        <p class="text-muted small mt-2 d-flex justify-content-end">Sent on {{ $complaint->created_at->format('F d, Y h:i A') }}</p>
                    </div>

                    @if($complaint->status == 'pending')
                        <form action="{{ route('admin.complaints.reply', $complaint) }}" method="POST">
                            @csrf
                            <h5 class="fw-bold mb-3"><i class="bi bi-reply text-primary me-2"></i>Reply</h5>
                            <div class="mb-3">
                                <textarea name="reply" class="form-control rounded-4 shadow-sm" rows="5" placeholder="Write your response here..." required></textarea>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm fw-bold">
                                    <i class="bi bi-send-check me-2"></i>Send Reply & Resolve
                                </button>
                            </div>
                        </form>
                    @else
                        <div class="alert alert-success d-flex align-items-center rounded-4 border-0 shadow-sm mt-4 p-4" role="alert">
                            <i class="bi bi-check-circle-fill fs-3 me-3"></i>
                            <div>
                                <h5 class="alert-heading fw-bold mb-1">Resolved</h5>
                                <p class="mb-0">This complaint has been addressed and a reply has been sent.</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
