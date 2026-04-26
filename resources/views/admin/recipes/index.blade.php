@extends('layouts.app')

@section('title', 'Manage Recipes')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold"><i class="bi bi-egg-fried text-success me-2"></i>Manage Recipes</h2>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">Back to Dashboard</a>
    </div>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Recipe Name</th>
                        <th>Creator</th>
                        <th>Category</th>
                        <th>Views/Downloads</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recipes as $recipe)
                        <tr>
                            <td>{{ $recipe->id }}</td>
                            <td>
                                <div class="fw-bold">{{ $recipe->title }}</div>
                                <div class="small text-muted">{{ Str::limit($recipe->description, 50) }}</div>
                            </td>
                            <td>{{ $recipe->user->name ?? 'Unknown' }}</td>
                            <td>{{ $recipe->category->name ?? 'None' }}</td>
                            <td>
                                <span class="badge bg-info text-dark me-1"><i class="bi bi-eye"></i> {{ $recipe->views ?? 0 }}</span>
                            </td>
                            <td class="text-end">
                                <div class="btn-group">
                                    <a href="{{ route('recipes.show', $recipe) }}" target="_blank" class="btn btn-sm btn-outline-primary" title="View Recipe">
                                        <i class="bi bi-box-arrow-up-right"></i>
                                    </a>
                                    <form action="{{ route('admin.recipes.destroy', $recipe) }}" method="POST" class="delete-form d-inline" data-confirm-message="Are you sure you want to permanently delete this recipe?">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete Recipe">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if($recipes->hasPages())
            <div class="card-footer bg-white border-0 pt-3">
                {{ $recipes->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
