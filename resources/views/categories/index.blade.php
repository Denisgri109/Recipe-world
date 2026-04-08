@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="mb-1">Recipe Categories</h2>
                    <p class="text-muted mb-0">Browse all recipe categories</p>
                </div>
                @auth
                    <a href="{{ route('categories.create') }}" class="btn btn-primary">Create New Recipe Category</a>
                @endauth
            </div>

            @forelse($categories as $category)
                <div class="card mb-3">
                    <div class="card-body">
                        <h4 class="card-title">
                            <a href="{{ route('categories.show', $category) }}" class="text-decoration-none">
                                {{ $category->name }}
                            </a>
                        </h4>
                        <p class="text-muted small">Created {{ $category->created_at->format('M d, Y') }}</p>
                        <p class="card-text">{{ $category->description ?? 'No description provided.' }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('categories.show', $category) }}" class="btn btn-sm btn-outline-primary">View</a>
                            @auth
                                <div>
                                    <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                    <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                                    </form>
                                </div>
                            @endauth
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-info">
                    <p class="mb-0">No categories found. @auth <a href="{{ route('categories.create') }}">Create the first category!</a> @endauth</p>
                </div>
            @endforelse

            <div class="d-flex justify-content-center">
                {{ $categories->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
