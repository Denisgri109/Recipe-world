@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Edit Recipe: {{ $recipe->title }}</h4>
                </div>
                <div class="card-body">
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
                            <div class="col-md-8">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" 
                                       class="form-control @error('title') is-invalid @enderror" 
                                       id="title" 
                                       name="title" 
                                       value="{{ old('title', $recipe->title) }}" 
                                       required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
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
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" 
                                      name="description" 
                                      rows="3" 
                                      required>{{ old('description', $recipe->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="instructions" class="form-label">Instructions</label>
                            <textarea class="form-control @error('instructions') is-invalid @enderror" 
                                      id="instructions" 
                                      name="instructions" 
                                      rows="6" 
                                      required>{{ old('instructions', $recipe->instructions) }}</textarea>
                            @error('instructions')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="prep_time" class="form-label">Prep Time (minutes)</label>
                                <input type="number" 
                                       class="form-control @error('prep_time') is-invalid @enderror" 
                                       id="prep_time" 
                                       name="prep_time" 
                                       value="{{ old('prep_time', $recipe->prep_time) }}"
                                       min="0">
                                @error('prep_time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="cook_time" class="form-label">Cook Time (minutes)</label>
                                <input type="number" 
                                       class="form-control @error('cook_time') is-invalid @enderror" 
                                       id="cook_time" 
                                       name="cook_time" 
                                       value="{{ old('cook_time', $recipe->cook_time) }}"
                                       min="0">
                                @error('cook_time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <label for="servings" class="form-label">Servings</label>
                                <input type="number" 
                                       class="form-control @error('servings') is-invalid @enderror" 
                                       id="servings" 
                                       name="servings" 
                                       value="{{ old('servings', $recipe->servings) }}"
                                       min="1">
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
                                            <input type="text" 
                                                   class="form-control @error('ingredients.'.$index.'.name') is-invalid @enderror" 
                                                   name="ingredients[{{ $index }}][name]" 
                                                   value="{{ is_array($ingredient) ? ($ingredient['name'] ?? '') : ($ingredient->name ?? '') }}" 
                                                   placeholder="Ingredient Name">
                                        </div>
                                        <div class="col-md-5">
                                            <input type="text" 
                                                   class="form-control @error('ingredients.'.$index.'.quantity') is-invalid @enderror" 
                                                   name="ingredients[{{ $index }}][quantity]" 
                                                   value="{{ is_array($ingredient) ? ($ingredient['quantity'] ?? '') : ($ingredient->quantity ?? '') }}" 
                                                   placeholder="Quantity (e.g., 2 cups)">
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
                                <img src="{{ asset('storage/' . $recipe->image_path) }}" alt="{{ $recipe->title }}" class="img-thumbnail mb-2" style="max-width: 300px;">
                            </div>
                        @endif

                        <div class="mb-4">
                            <label for="image_path" class="form-label">{{ $recipe->image_path ? 'Replace Image (optional)' : 'Featured Image (optional)' }}</label>
                            <input type="file" 
                                   class="form-control @error('image_path') is-invalid @enderror" 
                                   id="image_path" 
                                   name="image_path"
                                   accept="image/*">
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
</div>

@include('partials._recipe-validation')
@endsection
