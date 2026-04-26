@extends('layouts.app')

@section('content')
{{-- ─── Hero ──────────────────────────────────────────────── --}}
<div class="browse-header position-relative" style="background: linear-gradient(rgba(232,87,61,0.8), rgba(209,68,41,0.85)), url('https://images.unsplash.com/photo-1466637574441-749b8f19452f?q=80&w=2670&auto=format&fit=crop') center/cover; padding: 4rem 0 6rem; color: #fff;">
    <div class="container hero-content">
        <h1 class="mb-1 text-white"><i class="bi bi-pencil-square me-2"></i>Edit Recipe</h1>
        <p class="mb-0 text-white-50">{{ $recipe->title }}</p>
    </div>
    <div class="browse-wave position-absolute bottom-0 w-100">
        <svg viewBox="0 0 1440 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" style="width:100%; height:60px; display:block;">
            <path d="M0,30 C480,70 960,0 1440,30 L1440,60 L0,60 Z" fill="#FFFCF8"/>
        </svg>
    </div>
</div>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="feature-card">
                @if ($errors->any())
                    <div class="alert alert-danger mb-4">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('recipes.update', $recipe) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $recipe->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
                                <option value="">Select a Category...</option>
                                @isset($categories)
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $recipe->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                @endisset
                            </select>
                            <div class="mt-2">
                                <input type="text" class="form-control form-control-sm @error('new_category') is-invalid @enderror" id="new_category" name="new_category" value="{{ old('new_category') }}" placeholder="Or create new category...">
                                @error('new_category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="price" class="form-label">Price ($)</label>
                            <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', $recipe->price ?? 0) }}" min="0">
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" required>{{ old('description', $recipe->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="instructions" class="form-label">Instructions</label>
                        <textarea class="form-control @error('instructions') is-invalid @enderror" id="instructions" name="instructions" rows="6" required>{{ old('instructions', $recipe->instructions) }}</textarea>
                        @error('instructions')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="prep_time" class="form-label">Prep Time (minutes)</label>
                            <input type="number" class="form-control @error('prep_time') is-invalid @enderror" id="prep_time" name="prep_time" value="{{ old('prep_time', $recipe->prep_time) }}" min="0">
                            @error('prep_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="cook_time" class="form-label">Cook Time (minutes)</label>
                            <input type="number" class="form-control @error('cook_time') is-invalid @enderror" id="cook_time" name="cook_time" value="{{ old('cook_time', $recipe->cook_time) }}" min="0">
                            @error('cook_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-2">
                            <label for="servings" class="form-label">Servings</label>
                            <input type="number" class="form-control @error('servings') is-invalid @enderror" id="servings" name="servings" value="{{ old('servings', $recipe->servings) }}" min="1">
                            @error('servings')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-2">
                            <label for="difficulty" class="form-label">Difficulty</label>
                            <select class="form-select @error('difficulty') is-invalid @enderror" id="difficulty" name="difficulty">
                                <option value="easy" {{ old('difficulty', $recipe->difficulty) == 'easy' ? 'selected' : '' }}>Easy</option>
                                <option value="medium" {{ old('difficulty', $recipe->difficulty) == 'medium' ? 'selected' : '' }}>Medium</option>
                                <option value="hard" {{ old('difficulty', $recipe->difficulty) == 'hard' ? 'selected' : '' }}>Hard</option>
                            </select>
                            @error('difficulty')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4" data-ingredient-form>
                        <label class="form-label">Ingredients</label>
                        <div id="ingredients-container" class="vstack gap-2" data-ingredient-rows>
                            @php
                                $oldIngredients = old('ingredients', $recipe->ingredients ? $recipe->ingredients->toArray() : []);
                            @endphp
                            @foreach($oldIngredients as $index => $ingredient)
                                <div class="row g-2 align-items-start ingredient-row" data-ingredient-row>
                                    <div class="col-md-5">
                                        <input type="text" class="form-control @error('ingredients.'.$index.'.name') is-invalid @enderror" name="ingredients[{{ $index }}][name]" value="{{ is_array($ingredient) ? ($ingredient['name'] ?? '') : ($ingredient->name ?? '') }}" placeholder="Ingredient Name">
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" class="form-control @error('ingredients.'.$index.'.quantity') is-invalid @enderror" name="ingredients[{{ $index }}][quantity]" value="{{ is_array($ingredient) ? ($ingredient['quantity'] ?? '') : ($ingredient->quantity ?? '') }}" placeholder="Quantity (e.g., 2 cups)">
                                    </div>
                                    <div class="col-md-2 d-grid">
                                        <button type="button" class="btn btn-outline-danger js-remove-ingredient">Remove</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-outline-primary btn-sm mt-3 js-add-ingredient">Add Ingredient</button>
                    </div>

                    @if($recipe->image_path)
                        <div class="mb-3">
                            <label class="form-label d-block">Current Image</label>
                            <img src="{{ $recipe->image_url }}" alt="{{ $recipe->title }}" class="img-thumbnail mb-2 edit-preview-img">
                        </div>
                    @endif

                    <div class="mb-4">
                        <label for="image_path" class="form-label">{{ $recipe->image_path ? 'Replace Image (optional)' : 'Featured Image (optional)' }}</label>
                        <input type="file" class="form-control @error('image_path') is-invalid @enderror" id="image_path" name="image_path" accept="image/*">
                        @error('image_path')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('recipes.show', $recipe) }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Update Recipe</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@include('partials._recipe-validation')
@endsection
