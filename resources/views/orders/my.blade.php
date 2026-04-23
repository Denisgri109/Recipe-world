@extends('layouts.app')

@section('content')
<div class="orders-hero position-relative">
    <div class="container hero-content">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
            <div>
                <h1 class="mb-1"><i class="bi bi-cart-check me-2"></i>My Purchased Recipes</h1>
                <p class="mb-0">View all the amazing recipes you've unlocked</p>
            </div>
            <a href="{{ route('recipes.browse') }}" class="btn-hero btn-white btn-hero-sm">
                <i class="bi bi-compass me-2"></i>Browse More
            </a>
        </div>
    </div>
    <div class="browse-wave position-absolute bottom-0 w-100">
        <svg viewBox="0 0 1440 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" style="width:100%; height:60px; display:block;">
            <path d="M0,30 C480,70 960,0 1440,30 L1440,60 L0,60 Z" fill="#FFFCF8"/>
        </svg>
    </div>
</div>

<div class="container py-4">


    @if($orders->count() > 0)
        <div class="orders-table-card">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th scope="col" class="ps-4">Recipe</th>
                            <th scope="col">Seller</th>
                            <th scope="col">Date Purchased</th>
                            <th scope="col" class="text-end pe-4">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td class="ps-4 py-3">
                                @if($order->recipe)
                                    <div class="d-flex align-items-center">
                                        @if($order->recipe->image)
                                            <img src="{{ asset('storage/' . $order->recipe->image) }}" class="rounded-3 me-3 object-fit-cover shadow-sm" style="width: 60px; height: 60px;" alt="{{ $order->recipe->title }}">
                                        @else
                                            <div class="rounded-3 me-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background: linear-gradient(135deg, rgba(232,87,61,0.08), rgba(245,166,35,0.08));">
                                                <i class="bi bi-egg-fried text-coral" style="font-size: 1.5rem;"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <h6 class="mb-1 fw-bold text-dark">{{ $order->recipe->title }}</h6>
                                            <small class="text-muted">{{ Str::limit($order->recipe->description, 50) }}</small>
                                        </div>
                                    </div>
                                @else
                                    <div class="d-flex align-items-center text-muted">
                                        <div class="rounded-3 me-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background: rgba(0,0,0,0.04);">
                                            <i class="bi bi-journal-x" style="font-size: 1.5rem;"></i>
                                        </div>
                                        <span class="fst-italic">Deleted Recipe</span>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-person-circle text-coral me-2 fs-5"></i>
                                    <span class="fw-medium text-dark">{{ $order->seller->name ?? 'Unknown' }}</span>
                                </div>
                            </td>
                            <td>
                                <span class="badge rounded-pill px-3 py-2" style="background: rgba(232,87,61,0.08); color: #E8573D; font-weight: 600;">
                                    <i class="bi bi-calendar3 me-1"></i>{{ $order->created_at->format('M d, Y') }}
                                </span>
                            </td>
                            <td class="text-end pe-4">
                                @if($order->recipe)
                                    <a href="{{ route('recipes.show', $order->recipe->id) }}" class="btn-view">
                                        <i class="bi bi-eye me-1"></i>View
                                    </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="empty-state mt-4">
            <div class="empty-icon">🛍️</div>
            <h3>No Purchases Yet</h3>
            <p>You haven't bought any premium recipes yet. Time to unlock some delicious secrets!</p>
            <a href="{{ route('recipes.browse') }}" class="btn btn-primary mt-3 rounded-pill px-4 fw-bold">
                <i class="bi bi-search me-2"></i>Browse Recipes
            </a>
        </div>
    @endif
</div>
@endsection
