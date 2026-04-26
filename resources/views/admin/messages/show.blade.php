@extends('layouts.app')

@section('title', 'View Message')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold text-dark"><i class="bi bi-envelope-open text-primary me-2"></i>Contact Message</h2>
                <a href="{{ route('admin.messages') }}" class="btn btn-light rounded-pill px-4 shadow-sm border"><i class="bi bi-arrow-left me-1"></i> Back</a>
            </div>

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden mb-4" style="background: linear-gradient(145deg, #ffffff, #fdfdfd);">
                <div class="card-body p-4 p-lg-5">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 pb-4 border-bottom border-light">
                        <div class="d-flex align-items-center mb-3 mb-md-0">
                            <div class="avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3 shadow-sm" style="width: 50px; height: 50px; font-size: 1.25rem;">
                                {{ strtoupper(substr($message->name, 0, 1)) }}
                            </div>
                            <div>
                                <h4 class="fw-bold mb-1">{{ $message->subject }}</h4>
                                <p class="text-muted mb-0 small">From: <strong class="text-dark">{{ $message->name }}</strong> (<a href="mailto:{{ $message->email }}" class="text-decoration-none">{{ $message->email }}</a>)</p>
                            </div>
                        </div>
                        <div class="text-md-end d-flex flex-column align-items-md-end">
                            @if($message->status == 'pending')
                                <div class="d-flex align-items-center mb-2">
                                    <span class="badge bg-warning text-dark rounded-pill px-4 py-2 shadow-sm me-2"><i class="bi bi-hourglass-split me-1"></i>Pending</span>
                                    <form action="{{ route('admin.messages.resolve', $message) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-success rounded-pill px-3 shadow-sm border" title="Mark as resolved">
                                            <i class="bi bi-check-lg me-1"></i>Resolve manually
                                        </button>
                                    </form>
                                </div>
                            @else
                                <span class="badge bg-success rounded-pill px-4 py-2 shadow-sm mb-2"><i class="bi bi-check2-all me-1"></i>Resolved</span>
                            @endif
                            <div class="small text-muted"><i class="bi bi-clock me-1"></i>{{ $message->created_at->format('F d, Y h:i A') }}</div>
                        </div>
                    </div>
                    
                    <div class="mb-5 position-relative">
                        <div class="position-absolute top-0 start-0 text-light opacity-25" style="font-size: 4rem; margin-top: -20px; margin-left: -5px;"><i class="bi bi-quote"></i></div>
                        <p class="text-muted small mb-3 text-uppercase fw-bold" style="letter-spacing: 1.5px;"><i class="bi bi-body-text me-2"></i>Original Message</p>
                        <div class="p-4 bg-light rounded-4 border" style="position: relative; z-index: 1;">
                            <p class="mb-0 fs-5 text-secondary" style="white-space: pre-wrap; line-height: 1.6;">{{ $message->message }}</p>
                        </div>
                    </div>

                    @if($message->status == 'pending')
                        <div class="mt-4 pt-4 border-top">
                            <form action="{{ route('admin.messages.reply', $message) }}" method="POST">
                                @csrf
                                <h5 class="fw-bold mb-3 d-flex align-items-center"><i class="bi bi-reply-fill text-primary fs-4 me-2"></i>Reply to Customer</h5>
                                <div class="mb-4">
                                    <textarea name="reply" class="form-control rounded-4 shadow-sm border border-secondary border-opacity-25 bg-light p-3" rows="6" placeholder="Write your professional response here..." required></textarea>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5 shadow fw-bold">
                                        <i class="bi bi-send-fill me-2"></i>Send Reply via Email
                                    </button>
                                </div>
                            </form>
                        </div>
                    @else
                        <div class="alert alert-success d-flex align-items-center rounded-4 border-0 shadow-sm mt-4 p-4" style="background: linear-gradient(145deg, #d4edda, #c3e6cb);" role="alert">
                            <i class="bi bi-check-circle-fill fs-2 text-success me-4"></i>
                            <div>
                                <h5 class="alert-heading fw-bold text-success border-0 mb-1">Issue Resolved</h5>
                                <p class="mb-0 text-success opacity-75">This message has been successfully addressed and a response was sent to the user.</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
