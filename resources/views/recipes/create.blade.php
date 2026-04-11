@extends('layouts.app')

@section('content')
{{-- ─── Hero ──────────────────────────────────────────────── --}}
<div class="browse-header">
    <div class="container hero-content">
        <h1 class="mb-1"><i class="bi bi-plus-circle me-2"></i>Create New Recipe</h1>
        <p class="mb-0">Share your culinary creation with the community</p>
    </div>
    <div class="browse-wave">
        <svg viewBox="0 0 1440 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0,30 C480,70 960,0 1440,30 L1440,60 L0,60 Z" fill="#FFFCF8"/>
        </svg>
    </div>
</div>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="feature-card">
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
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="category_id" class="form-label">Category</label>
                            <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
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
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="instructions" class="form-label">Instructions</label>
                        <textarea class="form-control @error('instructions') is-invalid @enderror" id="instructions" name="instructions" rows="8" required>{{ old('instructions') }}</textarea>
                        @error('instructions')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-sm-4 col-md-3">
                            <label for="prep_time" class="form-label">Prep Time (minutes)</label>
                            <input type="number" class="form-control @error('prep_time') is-invalid @enderror" id="prep_time" name="prep_time" value="{{ old('prep_time') }}" min="0">
                            @error('prep_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-sm-4 col-md-3">
                            <label for="cook_time" class="form-label">Cook Time (minutes)</label>
                            <input type="number" class="form-control @error('cook_time') is-invalid @enderror" id="cook_time" name="cook_time" value="{{ old('cook_time') }}" min="0">
                            @error('cook_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-sm-4 col-md-2">
                            <label for="servings" class="form-label">Servings</label>
                            <input type="number" class="form-control @error('servings') is-invalid @enderror" id="servings" name="servings" value="{{ old('servings') }}" min="1">
                            @error('servings')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="difficulty" class="form-label">Difficulty</label>
                            <select class="form-select @error('difficulty') is-invalid @enderror" id="difficulty" name="difficulty" required>
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
                        <input type="file" class="form-control @error('image_path') is-invalid @enderror" id="image_path" name="image_path" accept="image/*">
                        <div class="form-text">Upload a clear image of the finished recipe.</div>
                        @error('image_path')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4" data-ingredient-form>
                        <label class="form-label">Ingredients</label>

                        @php
                            $oldIngredients = old('ingredients', [['name' => '', 'quantity' => '']]);
                        @endphp

                        <div class="vstack gap-2" data-ingredient-rows>
                            @foreach($oldIngredients as $index => $ingredient)
                                <div class="row g-2 align-items-start ingredient-row" data-ingredient-row>
                                    <div class="col-md-5">
                                        <input type="text" class="form-control @error('ingredients.'.$index.'.name') is-invalid @enderror" name="ingredients[{{ $index }}][name]" value="{{ is_array($ingredient) ? ($ingredient['name'] ?? '') : '' }}" placeholder="Ingredient name">
                                        @error('ingredients.'.$index.'.name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-5">
                                        <input type="text" class="form-control @error('ingredients.'.$index.'.quantity') is-invalid @enderror" name="ingredients[{{ $index }}][quantity]" value="{{ is_array($ingredient) ? ($ingredient['quantity'] ?? '') : '' }}" placeholder="Quantity (e.g., 2 cups)">
                                        @error('ingredients.'.$index.'.quantity')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-2 d-grid">
                                        <button type="button" class="btn btn-outline-danger js-remove-ingredient">Remove</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <button type="button" class="btn btn-outline-primary btn-sm mt-3 js-add-ingredient">Add Ingredient</button>
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

@include('partials._recipe-validation')
@endsection