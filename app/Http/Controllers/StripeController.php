<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Order;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class StripeController extends Controller
{
    public function checkout(Recipe $recipe)
    {
        if ($recipe->price <= 0) {
            return redirect()->route('recipes.show', $recipe);
        }

        Stripe::setApiKey(config('services.stripe.secret', 'sk_test_mock'));

        $checkout_session = Session::create([
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $recipe->title,
                    ],
                    'unit_amount' => intval($recipe->price * 100),
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('stripe.success', ['recipe' => $recipe->id]) . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('recipes.show', $recipe),
            'metadata' => [
                'recipe_id' => $recipe->id,
                'buyer_id' => auth()->id(),
            ]
        ]);

        return redirect()->away($checkout_session->url);
    }

    public function checkoutCart(Request $request)
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        Stripe::setApiKey(config('services.stripe.secret', 'sk_test_mock'));

        $line_items = [];
        foreach ($cart as $id => $details) {
            $line_items[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $details['title'],
                    ],
                    'unit_amount' => intval($details['price'] * 100),
                ],
                'quantity' => 1,
            ];
        }

        $checkout_session = Session::create([
            'line_items' => $line_items,
            'mode' => 'payment',
            'success_url' => route('stripe.success.cart') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('cart.index'),
            'metadata' => [
                'buyer_id' => auth()->id(),
                'is_cart' => 'true'
            ]
        ]);

        return redirect()->away($checkout_session->url);
    }

    public function successCart(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret', 'sk_test_mock'));
        $sessionId = $request->get('session_id');

        if (!$sessionId) {
            return redirect()->route('cart.index')->with('error', 'Invalid session ID.');
        }

        try {
            $session = Session::retrieve($sessionId);
            
            if ($session->payment_status === 'paid') {
                $cart = session()->get('cart', []);

                foreach ($cart as $id => $details) {
                    $recipe = Recipe::find($id);
                    if ($recipe) {
                        $orderExists = Order::where('buyer_id', auth()->id())
                                            ->where('recipe_id', $recipe->id)
                                            ->exists();
                        
                        if (!$orderExists) {
                            Order::create([
                                'buyer_id' => auth()->id(),
                                'seller_id' => $recipe->user_id,
                                'recipe_id' => $recipe->id,
                                'amount' => $recipe->price,
                                'status' => 'paid',
                            ]);
                        }
                    }
                }
                
                // Clear the cart
                session()->forget('cart');

                return redirect()->route('orders.my')->with('success', 'Cart items purchased successfully!');
            }
        } catch (\Exception $e) {
            return redirect()->route('cart.index')->with('error', 'Payment verification failed.');
        }

        return redirect()->route('cart.index');
    }

    public function success(Request $request, Recipe $recipe)
    {
        Stripe::setApiKey(config('services.stripe.secret', 'sk_test_mock'));
        $sessionId = $request->get('session_id');

        if (!$sessionId) {
            return redirect()->route('recipes.show', $recipe)->with('error', 'Invalid session ID.');
        }

        try {
            $session = Session::retrieve($sessionId);
            
            if ($session->payment_status === 'paid') {
                $orderExists = Order::where('buyer_id', auth()->id())
                                    ->where('recipe_id', $recipe->id)
                                    ->exists();
                
                if (!$orderExists) {
                    Order::create([
                        'buyer_id' => auth()->id(),
                        'seller_id' => $recipe->user_id,
                        'recipe_id' => $recipe->id,
                        'amount' => $recipe->price,
                        'status' => 'paid',
                    ]);
                }
                return redirect()->route('recipes.show', $recipe)->with('success', 'Recipe unlocked successfully!');
            }
        } catch (\Exception $e) {
            return redirect()->route('recipes.show', $recipe)->with('error', 'Payment verification failed.');
        }

        return redirect()->route('recipes.show', $recipe);
    }
}
