<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @php
        $appName = config('app.name', 'Recipe World');
        $routeName = \Illuminate\Support\Facades\Route::currentRouteName();

        $defaultPageTitle = match ($routeName) {
            'home' => 'Home',
            'dashboard' => 'Dashboard',
            'recipes.index', 'recipes.browse' => 'Browse Recipes',
            'recipes.create' => 'Create Recipe',
            'recipes.show' => 'Recipe Details',
            'recipes.edit' => 'Edit Recipe',
            'categories.index' => 'Recipe Categories',
            'categories.create' => 'Create Category',
            'categories.show' => 'Category Recipes',
            'categories.edit' => 'Edit Category',
            'about' => 'About',
            'contact' => 'Contact',
            'login' => 'Login',
            'register' => 'Register',
            'password.request' => 'Forgot Password',
            'password.reset' => 'Reset Password',
            'password.confirm' => 'Confirm Password',
            'verification.notice' => 'Verify Email',
            default => $appName,
        };

        $pageTitle = trim($__env->yieldContent('title', $defaultPageTitle));
        $fullTitle = $pageTitle === $appName ? $appName : $pageTitle . ' | ' . $appName;

        $defaultMetaDescription = 'Recipe World is a collaborative community cookbook where users can create, share, and discover recipes by category and difficulty.';
        $defaultMetaKeywords = 'Recipe World, recipes, cooking, community cookbook, Laravel, food, categories, difficulty';
    @endphp

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('meta_description', $defaultMetaDescription)">
    <meta name="keywords" content="@yield('meta_keywords', $defaultMetaKeywords)">

    <title>{{ $fullTitle }}</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

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
                        <li class="nav-item me-3 d-flex align-items-center">
                            <a id="navbar-cart-icon" class="nav-link position-relative {{ request()->routeIs('cart.index') ? 'text-primary' : '' }}" href="{{ route('cart.index') }}" title="Shopping Cart">
                                <i class="bi bi-cart3 fs-5"></i>
                                @if(session()->has('cart') && count(session('cart')) > 0)
                                    <span id="cart-badge-count" class="position-absolute top-10 start-100 translate-middle badge rounded-pill bg-danger border border-white" style="font-size: 0.65rem; transform: translate(-30%, -20%) !important;">
                                        {{ count(session('cart')) }}
                                    </span>
                                @endif
                            </a>
                        </li>
                        
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
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="bi bi-person-circle fs-5"></i>
                                    <span class="fw-medium">{{ Auth::user()->name }}</span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end shadow border-0 mt-2" aria-labelledby="navbarDropdown">
                                    @if(Auth::user()->is_admin)
                                        <a class="dropdown-item py-2 text-primary fw-bold {{ request()->routeIs('admin.*') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                                            <i class="bi bi-shield-lock me-2"></i>Admin Dashboard
                                        </a>
                                        <div class="dropdown-divider"></div>
                                    @endif
                                    <a class="dropdown-item py-2 {{ request()->routeIs('dashboard') || request()->routeIs('creator.dashboard*') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                                        <i class="bi bi-speedometer2 me-2 text-muted"></i>{{ __('Dashboard') }}
                                    </a>
                                    <a class="dropdown-item py-2 {{ request()->routeIs('creator.recipes.*') ? 'active' : '' }}" href="{{ route('creator.recipes.index') }}">
                                        <i class="bi bi-collection me-2 text-muted"></i>{{ __('My Recipes') }}
                                    </a>
                                    <a class="dropdown-item py-2 {{ request()->routeIs('profile.edit') ? 'active' : '' }}" href="{{ route('profile.edit') }}">
                                        <i class="bi bi-person-gear me-2 text-muted"></i>{{ __('Profile Settings') }}
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item py-2" href="{{ route('orders.my') }}">
                                        <i class="bi bi-bag-check me-2 text-muted"></i>{{ __('My Orders') }}
                                    </a>
                                    <a class="dropdown-item py-2" href="{{ route('orders.sales') }}">
                                        <i class="bi bi-graph-up me-2 text-muted"></i>{{ __('My Sales') }}
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item py-2 text-danger" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="bi bi-box-arrow-right me-2"></i>{{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            <li class="nav-item ms-md-2 d-flex align-items-center mt-2 mt-md-0">
                                <a class="btn btn-primary rounded-pill px-3 shadow-sm {{ request()->routeIs('recipes.create') ? 'disabled' : '' }}" href="{{ route('recipes.create') }}">
                                    <i class="bi bi-plus-circle me-1"></i> Create Recipe
                                </a>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="flex-grow-1">
            @if(session('success') || session('error') || session('warning'))
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
            @endif

            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="mt-auto">
            <div class="footer-accent-bar"></div>
            <div class="container py-5">
                <div class="row">
                    <div class="col-md-4 mb-4 mb-md-0">
                        <h5 class="fw-bold mb-3 text-white"><i class="bi bi-egg-fried me-2 footer-brand-icon"></i>{{ config('app.name', 'Recipe World') }}</h5>
                        <p class="footer-text">A collaborative, database-driven web application designed as a digital community cookbook. Create, share, and discover delicious recipes with food enthusiasts everywhere.</p>
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
                        <p class="small footer-text-muted">Follow us for updates, new recipes, and cooking tips.</p>
                    </div>
                </div>
                <hr class="my-4 footer-hr">
                <div class="row align-items-center">
                    <div class="col-md-6 text-center text-md-start mb-2 mb-md-0">
                        <p class="mb-0 footer-text-muted">&copy; {{ date('Y') }} {{ config('app.name', 'Recipe World') }}. All rights reserved.</p>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <p class="mb-0 footer-text-muted">Built with <i class="bi bi-heart-fill text-danger"></i> using Laravel &amp; Bootstrap</p>
                    </div>
                </div>
            </div>
        </footer>
        
        <!-- Global Delete Confirmation Modal -->
        <div class="modal fade" id="globalDeleteModal" tabindex="-1" aria-labelledby="globalDeleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="globalDeleteModalLabel">Confirm Deletion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p id="globalDeleteModalMessage">Are you sure you want to delete this item? This action cannot be undone.</p>
                        <div class="form-check mt-3">
                            <input class="form-check-input" type="checkbox" id="dontShowDeleteConfirmAgain">
                            <label class="form-check-label" for="dontShowDeleteConfirmAgain">
                                Don't show this confirmation again
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" id="globalDeleteModalConfirmBtn">Delete</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Global Alert Modal -->
        <div class="modal fade" id="globalAlertModal" tabindex="-1" aria-labelledby="globalAlertModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="modal-header bg-white border-bottom-0 pb-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center pt-0 pb-4 px-4">
                        <i class="bi bi-info-circle text-primary mb-3" style="font-size: 3rem;"></i>
                        <h4 class="mb-3 fw-bold" id="globalAlertModalMessage">Alert message goes here.</h4>
                        <button type="button" class="btn btn-primary px-4 rounded-pill fw-bold" data-bs-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
document.addEventListener('DOMContentLoaded',()=>{
    // Existing intersection observer code
    const observer=new IntersectionObserver((entries)=>{entries.forEach(entry=>{if(entry.isIntersecting){entry.target.classList.add('is-visible');observer.unobserve(entry.target);}});},{threshold:0.1});
    document.querySelectorAll('.animate-on-scroll').forEach(el=>observer.observe(el));

    // Global Modals and JS Config
    window.USER_PREFERENCES = {
        skipDeleteConfirm: {{ auth()->check() && auth()->user()->skip_delete_confirm ? 'true' : 'false' }}
    };

    window.showAlert = function(message) {
        document.getElementById('globalAlertModalMessage').textContent = message;
        new bootstrap.Modal(document.getElementById('globalAlertModal')).show();
    };

    // Global Delete Modal Logic
    const deleteForms = document.querySelectorAll('.delete-form');
    let currentFormToSubmit = null;
    let globalDeleteModal = null;
    const deleteModalEl = document.getElementById('globalDeleteModal');
    
    if (deleteModalEl) {
        globalDeleteModal = new bootstrap.Modal(deleteModalEl);
    }

    deleteForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            if (window.USER_PREFERENCES.skipDeleteConfirm) {
                return; // Let the form submit naturally
            }

            e.preventDefault();
            const btn = form.querySelector('.delete-btn');
            const message = btn ? (btn.getAttribute('data-confirm-message') || 'Are you sure you want to delete this item? This action cannot be undone.') : 'Are you sure you want to delete this item? This action cannot be undone.';
            document.getElementById('globalDeleteModalMessage').textContent = message;
            
            currentFormToSubmit = form;
            globalDeleteModal.show();
        });
    });

    const confirmBtn = document.getElementById('globalDeleteModalConfirmBtn');
    if (confirmBtn) {
        confirmBtn.addEventListener('click', async function() {
            const dontShowAgain = document.getElementById('dontShowDeleteConfirmAgain').checked;
            
            if (dontShowAgain) {
                // Save locally first for instant effect
                window.USER_PREFERENCES.skipDeleteConfirm = true;
                
                // Save to server
                try {
                    await fetch('{{ route('profile.preference', [], false) }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ skip_delete_confirm: true })
                    });
                } catch(e) { }
            }
            
            if (currentFormToSubmit) {
                currentFormToSubmit.submit();
            }
            globalDeleteModal.hide();
        });
    }

    // AJAX Cart Add Logic
    document.querySelectorAll('.add-to-cart-form').forEach(form => {
        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            const btn = form.querySelector('button[type="submit"]');
            const originalHtml = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '<i class="bi bi-hourglass-split"></i> ...';

            try {
                const fetchResponse = await fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    body: new FormData(form)
                });
                
                const data = await fetchResponse.json();

                if (fetchResponse.ok) {
                    btn.innerHTML = '<i class="bi bi-cart-check"></i> In Cart';
                    btn.classList.replace('btn-success', 'btn-secondary');
                    
                    const cartBadge = document.getElementById('cart-badge-count');
                    const cartNavIcon = document.getElementById('navbar-cart-icon');
                    
                    if (cartBadge) {
                        cartBadge.textContent = data.cart_count;
                    } else if (cartNavIcon && data.cart_count > 0) {
                        cartNavIcon.innerHTML += '<span id="cart-badge-count" class="position-absolute top-10 start-100 translate-middle badge rounded-pill bg-danger border border-white" style="font-size: 0.65rem; transform: translate(-30%, -20%) !important;">' + data.cart_count + '</span>';
                    }
                } else {
                    window.showAlert(data.error || data.warning || 'Failed to add to cart.');
                    btn.disabled = false;
                    btn.innerHTML = originalHtml;
                }
            } catch (err) {
                window.showAlert('A network error occurred.');
                btn.disabled = false;
                btn.innerHTML = originalHtml;
            }
        });
    });
});
</script>
</body>
</html>

