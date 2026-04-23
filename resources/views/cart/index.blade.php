@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="fw-bold mb-0"><i class="bi bi-cart3 me-2 text-primary"></i>Shopping Cart</h1>
            <p class="text-muted">Review your selected premium recipes before checking out.</p>
        </div>
    </div>

    @if(empty($cart))
        <div class="text-center py-5 bg-white rounded shadow-sm border p-4">
            <div class="mb-3">
                <i class="bi bi-cart-x text-muted" style="font-size: 4rem;"></i>
            </div>
            <h4 class="fw-bold">Your cart is empty</h4>
            <p class="text-muted">Looks like you haven't added any premium recipes to your cart yet.</p>
            <a href="{{ route('recipes.index') }}" class="btn btn-primary mt-2 px-4 rounded-pill">
                <i class="bi bi-search me-1"></i> Browse Recipes
            </a>
        </div>
    @else
        <div class="row g-4">
            <!-- Cart Items -->
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 mb-4 h-100">
                    <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                        <h5 class="fw-bold mb-0">Items in Cart ({{ count($cart) }})</h5>
                    </div>
                    <div class="card-body p-4">
                        <ul class="list-group list-group-flush">
                            @foreach($cart as $id => $details)
                                <li class="list-group-item px-0 py-3 d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3">
                                        <img src="{{ Str::startsWith($details['image_url'], 'http') ? $details['image_url'] : asset('storage/' . $details['image_url']) }}" alt="{{ $details['title'] }}" class="rounded shadow-sm" style="width: 80px; height: 80px; object-fit: cover;">
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="fw-bold mb-1"><a href="{{ route('recipes.show', $id) }}" class="text-decoration-none text-dark">{{ $details['title'] }}</a></h6>
                                        <p class="text-muted mb-0 small"><i class="bi bi-file-earmark-text"></i> Digital Recipe Access</p>
                                    </div>
                                    <div class="text-end ms-3">
                                        <p class="fw-bold mb-2 fs-5 text-primary">€{{ number_format($details['price'], 2) }}</p>
                                        <form action="{{ route('cart.remove', $id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-danger shadow-sm rounded-pill px-3">
                                                <i class="bi bi-trash"></i> Remove
                                            </button>
                                        </form>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="col-lg-4">
                <div class="card shadow-sm border-0 sticky-top" style="top: 2rem;">
                    <div class="card-header bg-light border-bottom-0 pt-4 pb-3 px-4 rounded-top">
                        <h5 class="fw-bold mb-0">Order Summary</h5>
                    </div>
                    <div class="card-body p-4 bg-light rounded-bottom">
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Subtotal</span>
                            <span class="fw-semibold">€{{ number_format($total, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Taxes & Fees</span>
                            <span class="fw-semibold text-success">Included</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-4 mt-2">
                            <span class="fw-bold fs-5">Total</span>
                            <span class="fw-bold fs-5 text-primary">€{{ number_format($total, 2) }}</span>
                        </div>
                        
                        <form action="{{ route('stripe.checkout.cart') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success w-100 py-3 rounded-pill shadow-sm fw-bold">
                                <i class="bi bi-shield-lock me-1"></i> Checkout with Stripe
                            </button>
                        </form>
                        
                        <div class="text-center mt-3">
                            <small class="text-muted"><i class="bi bi-stripe text-primary"></i> <br> Payments are secure and encrypted.</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
