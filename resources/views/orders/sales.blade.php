@extends('layouts.app')

@section('content')
{{-- ─── Hero ──────────────────────────────────────────────── --}}
<div class="orders-hero position-relative">
    <div class="container hero-content">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
            <div>
                <h1 class="mb-1"><i class="bi bi-cash-stack me-2"></i>My Sales</h1>
                <p class="mb-0">Track your recipe sales and earnings</p>
            </div>
        </div>
    </div>
    <div class="browse-wave position-absolute bottom-0 w-100">
        <svg viewBox="0 0 1440 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" style="width:100%; height:60px; display:block;">
            <path d="M0,30 C480,70 960,0 1440,30 L1440,60 L0,60 Z" fill="#FFFCF8"/>
        </svg>
    </div>
</div>

<div class="container py-4">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 rounded-3" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($orders->count() > 0)
        <div class="orders-table-card">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th scope="col" class="ps-4">Recipe</th>
                            <th scope="col">Buyer</th>
                            <th scope="col">Date Sold</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td class="ps-4 py-3">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-3 me-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; background: linear-gradient(135deg, rgba(232,87,61,0.08), rgba(245,166,35,0.08));">
                                        <i class="bi bi-journal-richtext text-coral" style="font-size: 1.2rem;"></i>
                                    </div>
                                    <span class="fw-bold text-dark">{{ $order->recipe->title ?? 'Deleted Recipe' }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-person-circle text-coral me-2 fs-5"></i>
                                    <span class="fw-medium text-dark">{{ $order->buyer->name ?? 'Unknown' }}</span>
                                </div>
                            </td>
                            <td>
                                <span class="badge rounded-pill px-3 py-2" style="background: rgba(107,143,113,0.1); color: #6B8F71; font-weight: 600;">
                                    <i class="bi bi-calendar3 me-1"></i>{{ $order->created_at->format('M d, Y') }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="empty-state mt-4">
            <div class="empty-icon">💰</div>
            <h3>No Sales Yet</h3>
            <p>You haven't sold any recipes yet. Create premium recipes to start earning!</p>
            <a href="{{ route('recipes.create') }}" class="btn btn-primary mt-3 rounded-pill px-4 fw-bold">
                <i class="bi bi-plus-circle me-2"></i>Create Recipe
            </a>
        </div>
    @endif
</div>
@endsection
