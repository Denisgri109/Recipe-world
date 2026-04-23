<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $cart = session()->get('cart', []);
        $total = array_sum(array_column($cart, 'price'));
        
        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request, Recipe $recipe)
    {
        // Don't allow adding free recipes
        if (empty($recipe->price) || $recipe->price <= 0) {
            if ($request->wantsJson()) return response()->json(['error' => 'Free recipes do not need to be purchased.'], 400);
            return redirect()->back()->with('error', 'Free recipes do not need to be purchased.');
        }

        // Don't allow adding own recipes
        if ($recipe->user_id === auth()->id()) {
            if ($request->wantsJson()) return response()->json(['error' => 'You already own this recipe.'], 400);
            return redirect()->back()->with('error', 'You already own this recipe.');
        }

        $cart = session()->get('cart', []);
        
        if (isset($cart[$recipe->id])) {
            if ($request->wantsJson()) return response()->json(['warning' => 'Recipe is already in your cart.', 'cart_count' => count($cart)], 200);
            return redirect()->back()->with('warning', 'Recipe is already in your cart.');
        }

        $cart[$recipe->id] = [
            'id' => $recipe->id,
            'title' => $recipe->title,
            'price' => $recipe->price,
            'image_url' => $recipe->image_url ?? 'https://images.unsplash.com/photo-1495521821757-a1efb6729352?q=80&w=800&auto=format&fit=crop'
        ];

        session()->put('cart', $cart);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => 'Recipe added to cart!',
                'cart_count' => count($cart)
            ], 200);
        }

        return redirect()->back()->with('success', 'Recipe added to cart!');
    }

    public function remove(Request $request, Recipe $recipe)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$recipe->id])) {
            unset($cart[$recipe->id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Recipe removed from cart.');
    }
}
