<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="d-flex flex-column min-vh-100">
    <div id="app" class="d-flex flex-column flex-grow-1">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('recipes.*') ? 'active' : '' }}" href="{{ route('recipes.index') }}">Browse Recipes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}" href="{{ route('categories.index') }}">Categories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('recipes.create') ? 'active' : '' }}" href="{{ route('recipes.create') }}">
                                    <i class="bi bi-plus-circle me-1"></i>Create Recipe
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="bi bi-person-circle me-1"></i>{{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="flex-grow-1">
            <div class="container mt-3">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('warning'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ session('warning') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>

            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="mt-auto" style="background: #1a1a2e;">
            <div style="height: 4px; background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);"></div>
            <div class="container py-5">
                <div class="row">
                    <div class="col-md-4 mb-4 mb-md-0">
                        <h5 class="fw-bold mb-3 text-white"><i class="bi bi-egg-fried me-2" style="color: #667eea;"></i>{{ config('app.name', 'Recipe World') }}</h5>
                        <p style="color: rgba(255,255,255,.65); line-height: 1.7;">A collaborative, database-driven web application designed as a digital community cookbook. Create, share, and discover delicious recipes with food enthusiasts everywhere.</p>
                    </div>
                    <div class="col-md-2 mb-4 mb-md-0">
                        <h6 class="fw-bold mb-3 text-white">Quick Links</h6>
                        <ul class="list-unstyled footer-links">
                            <li class="mb-2"><a href="{{ route('home') }}">Home</a></li>
                            <li class="mb-2"><a href="{{ route('recipes.index') }}">Browse Recipes</a></li>
                            <li class="mb-2"><a href="{{ route('categories.index') }}">Categories</a></li>
                            <li class="mb-2"><a href="{{ route('about') }}">About</a></li>
                            <li class="mb-2"><a href="{{ route('contact') }}">Contact</a></li>
                            @auth
                                <li class="mb-2"><a href="{{ route('recipes.create') }}">Create Recipe</a></li>
                            @endauth
                        </ul>
                    </div>
                    <div class="col-md-3 mb-4 mb-md-0">
                        <h6 class="fw-bold mb-3 text-white">Resources</h6>
                        <ul class="list-unstyled footer-links">
                            <li class="mb-2"><a href="https://laravel.com/docs" target="_blank">Laravel Docs</a></li>
                            <li class="mb-2"><a href="https://github.com" target="_blank">GitHub</a></li>
                            <li class="mb-2"><a href="https://laracasts.com" target="_blank">Laracasts</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <h6 class="fw-bold mb-3 text-white">Connect With Us</h6>
                        <div class="d-flex gap-3 mb-3">
                            <a href="#" class="footer-social"><i class="bi bi-twitter fs-4"></i></a>
                            <a href="#" class="footer-social"><i class="bi bi-github fs-4"></i></a>
                            <a href="#" class="footer-social"><i class="bi bi-linkedin fs-4"></i></a>
                            <a href="#" class="footer-social"><i class="bi bi-envelope fs-4"></i></a>
                        </div>
                        <p class="small" style="color: rgba(255,255,255,.5);">Follow us for updates, new recipes, and cooking tips.</p>
                    </div>
                </div>
                <hr style="border-color: rgba(255,255,255,.1);" class="my-4">
                <div class="row align-items-center">
                    <div class="col-md-6 text-center text-md-start mb-2 mb-md-0">
                        <p class="mb-0" style="color: rgba(255,255,255,.5);">&copy; {{ date('Y') }} {{ config('app.name', 'Recipe World') }}. All rights reserved.</p>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <p class="mb-0" style="color: rgba(255,255,255,.5);">Built with <i class="bi bi-heart-fill text-danger"></i> using Laravel &amp; Bootstrap</p>
                    </div>
                </div>
            </div>
        </footer>

        <style>
            .footer-links a {
                color: rgba(255,255,255,.65);
                text-decoration: none;
                transition: color .2s ease, padding-left .2s ease;
            }
            .footer-links a:hover {
                color: #667eea;
                padding-left: 4px;
            }
            .footer-social {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 40px;
                height: 40px;
                border-radius: 50%;
                background: rgba(255,255,255,.08);
                color: rgba(255,255,255,.65);
                text-decoration: none;
                transition: all .2s ease;
            }
            .footer-social:hover {
                background: #667eea;
                color: #fff;
                transform: translateY(-2px);
            }
        </style>
    </div>
</body>
</html>
