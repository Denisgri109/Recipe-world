@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold"><i class="bi bi-shield-lock text-primary me-2"></i>Admin Dashboard</h2>
        <div>
            <a href="{{ route('admin.users') }}" class="btn btn-outline-primary me-2">Manage Users</a>
            <a href="{{ route('admin.recipes') }}" class="btn btn-outline-success me-2">Manage Recipes</a>
            <a href="{{ route('admin.messages') }}" class="btn btn-outline-danger">Messages</a>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body text-center p-4">
                    <div class="display-4 text-primary mb-2"><i class="bi bi-people"></i></div>
                    <h2 class="fw-bold">{{ $stats['total_users'] }}</h2>
                    <p class="text-muted mb-0">Total Users</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body text-center p-4">
                    <div class="display-4 text-success mb-2"><i class="bi bi-egg-fried"></i></div>
                    <h2 class="fw-bold">{{ $stats['total_recipes'] }}</h2>
                    <p class="text-muted mb-0">Total Recipes</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body text-center p-4">
                    <div class="display-4 text-warning mb-2"><i class="bi bi-tags"></i></div>
                    <h2 class="fw-bold">{{ $stats['total_categories'] }}</h2>
                    <p class="text-muted mb-0">Categories</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body text-center p-4">
                    <div class="display-4 text-danger mb-2"><i class="bi bi-envelope-paper"></i></div>
                    <h2 class="fw-bold">{{ $stats['pending_messages'] }}</h2>
                    <p class="text-muted mb-0">Pending Messages</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
