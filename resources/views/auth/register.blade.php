@extends('layouts.app')

@section('content')
<div class="auth-full-bg position-relative" style="min-height: calc(100vh - 76px); background: url('https://images.unsplash.com/photo-1551218808-94e220e084d2?q=80&w=2670&auto=format&fit=crop') center/cover; display: flex; align-items: center; justify-content: center; padding: 3rem 1rem;">
    <div class="position-absolute top-0 start-0 w-100 h-100" style="backdrop-filter: blur(10px); background: rgba(232, 87, 61, 0.4);"></div>
    
    <div class="container position-relative" style="z-index: 2; max-width: 1000px;">
        <div class="row g-0 bg-white rounded-4 shadow-lg overflow-hidden flex-row-reverse auth-shell auth-shell-register">
            <!-- Image Side with Text Overlay -->
            <div class="col-md-5 d-none d-lg-flex position-relative text-white p-5 flex-column justify-content-end auth-media auth-media-register" style="background: url('https://images.unsplash.com/photo-1551218808-94e220e084d2?q=80&w=800&auto=format&fit=crop') center/cover; min-height: 550px;">
                <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(to bottom, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0.85) 100%); z-index: 1;"></div>
                <div class="position-relative auth-media-content" style="z-index: 2;">
                    <div class="fs-1 mb-3"></div>
                    <h2 class="fw-bold mb-2 text-white">Join Recipe World</h2>
                    <p class="lead mb-0 text-white-50" style="color: rgba(255,255,255,0.85) !important;">Create an account to start sharing your favorite culinary creations.</p>
                </div>
            </div>
            
            <!-- Form Side -->
            <div class="col-md-12 col-lg-7 p-4 p-md-5 bg-white auth-panel">
                <h3 class="mb-4 text-center fw-bold">{{ __('Register') }}</h3>

                <form method="POST" action="{{ route('register') }}" class="auth-form">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label text-muted">{{ __('Name') }}</label>
                        <input id="name" type="text" class="form-control form-control-lg bg-light border-0 auth-input @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label text-muted">{{ __('Email Address') }}</label>
                        <input id="email" type="email" class="form-control form-control-lg bg-light border-0 auth-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label text-muted">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-control form-control-lg bg-light border-0 auth-input @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password-confirm" class="form-label text-muted">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" class="form-control form-control-lg bg-light border-0 auth-input" name="password_confirmation" required autocomplete="new-password">
                    </div>

                    <div class="d-grid mb-4">
                        <button type="submit" class="btn btn-primary btn-lg rounded-3 fw-bold auth-submit-btn">{{ __('Register') }}</button>
                    </div>

                    <p class="text-center text-muted mb-0">
                        Already have an account? <a href="{{ route('login') }}" class="text-coral fw-bold text-decoration-none auth-link">Log in here</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
