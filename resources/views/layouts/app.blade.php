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
                                    <a class="dropdown-item" href="{{ route('orders.my') }}">
                                        {{ __('My Orders') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('orders.sales') }}">
                                        {{ __('My Sales') }}
                                    </a>
                                    <hr class="dropdown-divider">
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
    </div>
<script>
document.addEventListener('DOMContentLoaded',()=>{
    // Existing intersection observer code
    const observer=new IntersectionObserver((entries)=>{entries.forEach(entry=>{if(entry.isIntersecting){entry.target.classList.add('is-visible');observer.unobserve(entry.target);}});},{threshold:0.1});
    document.querySelectorAll('.animate-on-scroll').forEach(el=>observer.observe(el));

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
            const skipConfirm = localStorage.getItem('skipDeleteConfirm');
            if (skipConfirm === 'true') {
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
        confirmBtn.addEventListener('click', function() {
            const dontShowAgain = document.getElementById('dontShowDeleteConfirmAgain').checked;
            if (dontShowAgain) {
                localStorage.setItem('skipDeleteConfirm', 'true');
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
                    alert(data.error || data.warning || 'Failed to add to cart.');
                    btn.disabled = false;
                    btn.innerHTML = originalHtml;
                }
            } catch (err) {
                alert('A network error occurred.');
                btn.disabled = false;
                btn.innerHTML = originalHtml;
            }
        });
    });
});
</script>
</body>
</html>

