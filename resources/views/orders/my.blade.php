@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row mb-4 align-items-center">
        <div class="col-md-8">
            <h2 class="fw-bold mb-0">
                <i class="bi bi-cart-check text-success me-2"></i>My Purchased Recipes
            </h2>
            <p class="text-muted mt-2 mb-0">View all the amazing recipes you've unlocked</p>
        </div>
        <div class="col-md-4 text-md-end mt-3 mt-md-0">
            <a href="{{ route('recipes.browse') }}" class="btn btn-outline-success rounded-pill px-4 shadow-sm">
                <i class="bi bi-compass me-1"></i> Browse More
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0 bg-white rounded-3">
        <div class="card-body p-0">
            @if($orders->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" class="ps-4">Recipe</th>
                                <th scope="col">Seller</th>
                                <th scope="col">Date Purchased</th>
                                <th scope="col" class="text-end pe-4">Action</th>
                            </tr>
                        </thead>
                        <tbody class="border-top-0">
                            @foreach($orders as $order)
                            <tr>
                                <td class="ps-4 py-3">
                                    @if($order->recipe)
                                        <div class="d-flex align-items-center">
                                            @if($order->recipe->image)
                                                <img src="{{ asset('storage/' . $order->recipe->image) }}" class="rounded me-3 object-fit-cover shadow-sm" style="width: 60px; height: 60px;" alt="{{ $order->recipe->title }}">
                                            @else
                                                <div class="bg-light rounded me-3 d-flex align-items-center justify-content-center text-muted shadow-sm" style="width: 60px; height: 60px;">
                                                    <i class="bi bi-egg-fried" style="font-size: 1.8rem;"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <h6 class="mb-1 fw-bold text-dark">{{ $order->recipe->title }}</h6>
                                                <small class="text-muted">{{ Str::limit($order->recipe->description, 50) }}</small>
                                            </div>
                                        </div>
                                    @else
                                        <div class="d-flex align-items-center text-muted">
                                            <div class="bg-light rounded me-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px;">
                                                <i class="bi bi-journal-x" style="font-size: 1.8rem;"></i>
                                            </div>
                                            <span class="fst-italic">Deleted Recipe</span>
                                        </div>
                                    @endif
                                </td>    
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-person-circle text-secondary me-2 fs-5"></i>
                                        <span class="fw-medium text-dark">{{ $order->seller->name ?? 'Unknown' }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border p-2">
                                        <i class="bi bi-calendar3 me-1 text-muted"></i>
                                        {{ $order->created_at->format('M d, Y') }}
                                    </span>
                                </td>
                                <td class="text-end pe-4">
                                    @if($order->recipe)
                                        <a href="{{ route('recipes.show', $order->recipe->id) }}" class="btn btn-primary btn-sm rounded-pill px-3 shadow-sm">
                                            <i class="bi bi-eye me-1"></i> View Recipe
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <div class="mb-3">
                        <i class="bi bi-bag-x text-muted" style="font-size: 3rem; opacity: 0.5;"></i>
                    </div>
                    <h4 class="fw-bold text-dark mb-2">No purchases yet</h4>
                    <p class="text-muted mb-4">You haven't bought any premium recipes yet. Time to unlock some delicious secrets!</p>
                    <a href="{{ route('recipes.browse') }}" class="btn btn-success px-4 py-2 rounded-pill shadow-sm fw-bold">
                        <i class="bi bi-search me-2"></i>Browse Recipes
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
