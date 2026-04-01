@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h4 class="mb-0">Create New Recipe</h4>
                </div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger mb-4">
                            <strong>Please fix the following errors:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('recipes.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-3 mb-3">
                            <div class="col-md-8">
                                <label for="title" class="form-label">Title</label>
                                <input
                                    type="text"
                                    class="form-control @error('title') is-invalid @enderror"
                                    id="title"
                                    name="title"
                                    value="{{ old('title') }}"
                                    required
                                >
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="category_id" class="form-label">Category</label>
                                <select
                                    class="form-select @error('category_id') is-invalid @enderror"
                                    id="category_id"
                                    name="category_id"
                                >
                                    <option value="">Select a category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea
                                class="form-control @error('description') is-invalid @enderror"
                                id="description"
                                name="description"
                                rows="4"
                                required
                            >{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="instructions" class="form-label">Instructions</label>
                            <textarea
                                class="form-control @error('instructions') is-invalid @enderror"
                                id="instructions"
                                name="instructions"
                                rows="8"
                                required
                            >{{ old('instructions') }}</textarea>
                            @error('instructions')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-sm-4 col-md-3">
                                <label for="prep_time" class="form-label">Prep Time (minutes)</label>
                                <input
                                    type="number"
                                    class="form-control @error('prep_time') is-invalid @enderror"
                                    id="prep_time"
                                    name="prep_time"
                                    value="{{ old('prep_time') }}"
                                    min="0"
                                >
                                @error('prep_time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-4 col-md-3">
                                <label for="cook_time" class="form-label">Cook Time (minutes)</label>
                                <input
                                    type="number"
                                    class="form-control @error('cook_time') is-invalid @enderror"
                                    id="cook_time"
                                    name="cook_time"
                                    value="{{ old('cook_time') }}"
                                    min="0"
                                >
                                @error('cook_time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-4 col-md-2">
                                <label for="servings" class="form-label">Servings</label>
                                <input
                                    type="number"
                                    class="form-control @error('servings') is-invalid @enderror"
                                    id="servings"
                                    name="servings"
                                    value="{{ old('servings') }}"
                                    min="1"
                                >
                                @error('servings')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="difficulty" class="form-label">Difficulty</label>
                                <select
                                    class="form-select @error('difficulty') is-invalid @enderror"
                                    id="difficulty"
                                    name="difficulty"
                                    required
                                >
                                    <option value="">Select difficulty</option>
                                    <option value="easy" {{ old('difficulty') === 'easy' ? 'selected' : '' }}>Easy</option>
                                    <option value="medium" {{ old('difficulty') === 'medium' ? 'selected' : '' }}>Medium</option>
                                    <option value="hard" {{ old('difficulty') === 'hard' ? 'selected' : '' }}>Hard</option>
                                </select>
                                @error('difficulty')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="image_path" class="form-label">Featured Image</label>
                            <input
                                type="file"
                                class="form-control @error('image_path') is-invalid @enderror"
                                id="image_path"
                                name="image_path"
                                accept="image/*"
                            >
                            <div class="form-text">Upload a clear image of the finished recipe.</div>
                            @error('image_path')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('recipes.index') }}" class="btn btn-outline-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Create Recipe</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection