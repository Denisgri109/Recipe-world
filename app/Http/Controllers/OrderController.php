<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Order;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function purchase(Request $request, Recipe $recipe)
    {
        if ($recipe->user_id === auth()->id()) {
            return back()->with('error', 'You cannot buy your own recipe.');
        }
        if (Order::where('buyer_id', auth()->id())->where('recipe_id', $recipe->id)->exists()) {
            return back()->with('error', 'You have already purchased this recipe.');
        }
        Order::create([
            'buyer_id'  => auth()->id(),
            'seller_id' => $recipe->user_id,
            'recipe_id' => $recipe->id,
            'amount'    => $recipe->price ?? 0,
            'status'    => 'completed'
        ]);

        return redirect()->route('orders.my')->with('success', 'Recipe purchased successfully!');
    }

    public function myOrders()
    {
        $orders = Order::with(['recipe', 'seller'])->where('buyer_id', auth()->id())->latest()->get();
        return view('orders.my', compact('orders'));
    }

    public function sales()
    {
        $orders = Order::with(['recipe', 'buyer'])->where('seller_id', auth()->id())->latest()->get();
        return view('orders.sales', compact('orders'));
    }
}
