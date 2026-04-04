<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class RecipeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index(Request $request): View
    {
        $recipes = Recipe::with(['user', 'category'])
            ->latest()
            ->paginate(12)
            ->appends($request->query());

        return view('recipes.index', compact('recipes'));
    }

    public function create(): View
    {
        $categories = Category::orderBy('name')->get();

        return view('recipes.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'instructions' => 'required|string',
            'prep_time' => 'nullable|integer|min:0',
            'cook_time' => 'nullable|integer|min:0',
            'servings' => 'nullable|integer|min:1',
            'difficulty' => 'required|in:easy,medium,hard',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'nullable|exists:categories,id',
            'ingredients' => 'nullable|array',
            'ingredients.*.name' => 'required_with:ingredients|string|max:255',
            'ingredients.*.quantity' => 'nullable|string|max:100',
        ]);

        $validated['user_id'] = auth()->id();

        if ($request->hasFile('image_path')) {
            $validated['image_path'] = $request->file('image_path')->store('recipes', 'public');
        }

        $recipe = Recipe::create($validated);

        if ($request->has('ingredients')) {
            foreach ($request->input('ingredients') as $index => $ingredientData) {
                if (!empty($ingredientData['name'])) {
                    $recipe->ingredients()->create([
                        'name' => $ingredientData['name'],
                        'quantity' => $ingredientData['quantity'] ?? null,
                        'order' => $index,
                    ]);
                }
            }
        }

        return redirect()->route('recipes.show', $recipe)->with('success', 'Recipe created successfully!');
    }

    public function show(Recipe $recipe): View
    {
        $recipe->load(['ingredients' => function ($query) {
            $query->orderBy('order');
        }, 'user', 'category']);

        return view('recipes.show', compact('recipe'));
    }

    public function edit(Recipe $recipe): View
    {
        $this->authorize('update', $recipe);

        $categories = Category::orderBy('name')->get();
        $recipe->load(['ingredients' => function ($query) {
            $query->orderBy('order');
        }]);

        return view('recipes.edit', compact('recipe', 'categories'));
    }

    public function update(Request $request, Recipe $recipe): RedirectResponse
    {
        $this->authorize('update', $recipe);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'instructions' => 'required|string',
            'prep_time' => 'nullable|integer|min:0',
            'cook_time' => 'nullable|integer|min:0',
            'servings' => 'nullable|integer|min:1',
            'difficulty' => 'required|in:easy,medium,hard',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'nullable|exists:categories,id',
            'ingredients' => 'nullable|array',
            'ingredients.*.name' => 'required_with:ingredients|string|max:255',
            'ingredients.*.quantity' => 'nullable|string|max:100',
        ]);

        if ($request->hasFile('image_path')) {
            if ($recipe->image_path) {
                Storage::disk('public')->delete($recipe->image_path);
            }
            $validated['image_path'] = $request->file('image_path')->store('recipes', 'public');
        }

        $recipe->update($validated);

        $recipe->ingredients()->delete();
        if ($request->has('ingredients')) {
            foreach ($request->input('ingredients') as $index => $ingredientData) {
                if (!empty($ingredientData['name'])) {
                    $recipe->ingredients()->create([
                        'name' => $ingredientData['name'],
                        'quantity' => $ingredientData['quantity'] ?? null,
                        'order' => $index,
                    ]);
                }
            }
        }

        return redirect()->route('recipes.show', $recipe)->with('success', 'Recipe updated successfully!');
    }

    public function destroy(Recipe $recipe): RedirectResponse
    {
        $this->authorize('delete', $recipe);

        if ($recipe->image_path) {
            Storage::disk('public')->delete($recipe->image_path);
        }

        $recipe->delete();

        return redirect()->route('recipes.index')->with('success', 'Recipe deleted successfully!');
    }
}
