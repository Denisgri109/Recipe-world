@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="mb-3">
                <a href="{{ route('categories.index') }}" class="btn btn-sm btn-outline-secondary">
                    &larr; Back to Categories
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <h1 class="card-title mb-3">{{ $category->name }}</h1>
                    
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="text-muted">
                            <small>
                                Created {{ $category->created_at->format('F j, Y \a\t g:i a') }}
                                @if($category->created_at != $category->updated_at)
                                    <span class="ms-2">(Updated: {{ $category->updated_at->format('M d, Y') }})</span>
                                @endif
                            </small>
                        </div>
                        @auth
                            <div>
                                <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                                </form>
                            </div>
                        @endauth
                    </div>

                    <div class="card-text">
                        {!! nl2br(e($category->description ?? 'No description provided.')) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
