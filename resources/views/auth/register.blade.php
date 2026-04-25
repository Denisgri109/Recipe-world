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

                    <div class="position-relative my-4">
                        <hr class="text-muted">
                        <span class="position-absolute top-50 start-50 translate-middle bg-white px-3 text-muted small">or continue with</span>
                    </div>

                    <div class="d-grid mb-4">
                        <a href="{{ route('auth.google') }}" class="btn btn-light border btn-lg d-flex align-items-center justify-content-center gap-2 rounded-3 text-dark fw-medium auth-google-btn">
                            <svg width="20" height="20" viewBox="0 0 48 48">
                                <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"/>
                                <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"/>
                                <path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"/>
                                <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"/>
                            </svg>
                            Sign up with Google
                        </a>
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
