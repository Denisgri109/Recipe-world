@extends('layouts.app')

@section('title', 'My Recipes')

@section('content')
<div class="container py-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
        <div>
            <h1 class="h3 mb-1">My Recipes</h1>
            <p class="text-muted mb-0">Manage your recipes and track performance in one place.</p>
        </div>
        <a href="{{ route('recipes.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i>Create New Recipe
        </a>
    </div>

    <div class="card mb-4 shadow-sm border-0 bg-light">
        <div class="card-body py-3">
            <form action="{{ route('creator.recipes.index') }}" method="GET" class="row g-2 align-items-end">
                <div class="col-12 col-lg-4">
                    <label for="search" class="form-label fw-semibold">Search</label>
                    <input
                        id="search"
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Search title or description"
                        value="{{ $search }}"
                    >
                </div>

                <div class="col-6 col-md-4 col-lg-2">
                    <label for="status" class="form-label fw-semibold">Status</label>
                    <select id="status" name="status" class="form-select">
                        <option value="all" {{ $status === 'all' ? 'selected' : '' }}>All</option>
                        <option value="published" {{ $status === 'published' ? 'selected' : '' }}>Published</option>
                        <option value="draft" {{ $status === 'draft' ? 'selected' : '' }}>Draft</option>
                    </select>
                </div>

                <div class="col-6 col-md-4 col-lg-2">
                    <label for="sort" class="form-label fw-semibold">Sort</label>
                    <select id="sort" name="sort" class="form-select">
                        <option value="updated_desc" {{ $sort === 'updated_desc' ? 'selected' : '' }}>Updated (Newest)</option>
                        <option value="updated_asc" {{ $sort === 'updated_asc' ? 'selected' : '' }}>Updated (Oldest)</option>
                        <option value="views_desc" {{ $sort === 'views_desc' ? 'selected' : '' }}>Views (High to Low)</option>
                        <option value="views_asc" {{ $sort === 'views_asc' ? 'selected' : '' }}>Views (Low to High)</option>
                        <option value="unique_viewers_desc" {{ $sort === 'unique_viewers_desc' ? 'selected' : '' }}>Unique Viewers</option>
                        <option value="revenue_desc" {{ $sort === 'revenue_desc' ? 'selected' : '' }}>Revenue</option>
                        <option value="title_asc" {{ $sort === 'title_asc' ? 'selected' : '' }}>Title (A-Z)</option>
                        <option value="title_desc" {{ $sort === 'title_desc' ? 'selected' : '' }}>Title (Z-A)</option>
                    </select>
                </div>

                <div class="col-6 col-md-4 col-lg-2">
                    <label for="per_page" class="form-label fw-semibold">Rows</label>
                    <select id="per_page" name="per_page" class="form-select">
                        @foreach([10, 20, 30, 50] as $size)
                            <option value="{{ $size }}" {{ $perPage === $size ? 'selected' : '' }}>{{ $size }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-6 col-lg-2 d-flex gap-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-funnel me-1"></i>Apply
                    </button>
                    <a href="{{ route('creator.recipes.index') }}" class="btn btn-outline-secondary">Reset</a>
                </div>
            </form>
        </div>
    </div>

    @if($recipes->count() > 0)
        <div class="card border-0 shadow-sm">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Title</th>
                            <th>Status</th>
                            <th class="text-end">Views</th>
                            <th class="text-end">Unique Viewers</th>
                            <th class="text-end">Revenue</th>
                            <th>Last Updated</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recipes as $recipe)
                            <tr>
                                <td>
                                    <div class="fw-semibold">{{ $recipe->title }}</div>
                                    <div class="text-muted small text-truncate" style="max-width: 320px;">{{ $recipe->description }}</div>
                                </td>
                                <td>
                                    @if($recipe->is_draft)
                                        <span class="badge text-bg-warning">Draft</span>
                                    @else
                                        <span class="badge text-bg-success">Published</span>
                                    @endif
                                </td>
                                <td class="text-end">{{ number_format((int) $recipe->views_count) }}</td>
                                <td class="text-end">{{ number_format((int) $recipe->unique_viewers_count) }}</td>
                                <td class="text-end">{{ $currency }} {{ number_format((float) ($recipe->revenue_total ?? 0), 4, '.', ',') }}</td>
                                <td>{{ optional($recipe->updated_at)->format('d M Y, H:i') }}</td>
                                <td class="text-end">
                                    <div class="d-inline-flex gap-1">
                                        <a href="{{ route('recipes.show', $recipe) }}" class="btn btn-sm btn-outline-primary" title="View">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('recipes.edit', $recipe) }}" class="btn btn-sm btn-outline-secondary" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('recipes.destroy', $recipe) }}" method="POST" onsubmit="return confirm('Delete this recipe?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
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
        </div>

        <div class="mt-4 d-flex justify-content-center">
            {{ $recipes->links() }}
        </div>
    @else
        <div class="alert alert-info mb-0">
            You have no recipes matching these filters.
            <a href="{{ route('recipes.create') }}" class="alert-link">Create your first recipe</a>.
        </div>
    @endif
</div>
@endsection
