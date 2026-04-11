@extends('layouts.app')

@section('content')
<div class="browse-header">
    <div class="container hero-content text-center">
        <div class="hero-emoji">🔑</div>
        <h1 class="hero-title mb-2">Welcome Back</h1>
        <p class="hero-subtitle">Log in to your Recipe World account</p>
    </div>
    <div class="browse-wave">
        <svg viewBox="0 0 1440 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0,30 C480,70 960,0 1440,30 L1440,60 L0,60 Z" fill="#FFFCF8"/>
        </svg>
    </div>
</div>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="feature-card">
                <h3 class="mb-4 text-center">{{ __('Login') }}</h3>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Email Address') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
                        </div>
                    </div>

                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary btn-lg">{{ __('Login') }}</button>
                    </div>

                    <div class="text-center">
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                        @endif
                    </div>

                    <hr>
                    <p class="text-center text-muted mb-0">
                        Don't have an account? <a href="{{ route('register') }}" class="text-coral fw-bold">Register here</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
