<?php

use App\Http\Controllers\RecipeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/browse', [RecipeController::class, 'index'])->name('recipes.browse');

// Recipe routes
Route::resource('recipes', RecipeController::class);

// Category routes
Route::resource('categories', CategoryController::class);

// Extra pages
Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

// Google OAuth routes
use App\Http\Controllers\Auth\GoogleController;

Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Auth::routes();

use App\Http\Controllers\ProfileController;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::get('/home', [HomeController::class, 'index'])->name('dashboard');

use App\Http\Controllers\OrderController;

use App\Http\Controllers\StripeController;

Route::middleware(['auth'])->prefix('orders')->name('orders.')->group(function () {
    Route::get('my-purchases', [OrderController::class, 'myOrders'])->name('my');
    Route::get('sales', [OrderController::class, 'sales'])->name('sales');
    Route::post('{recipe}/purchase', [OrderController::class, 'purchase'])->name('purchase');
});

Route::middleware('auth')->group(function () {
    // Cart Routes
    Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{recipe}/add', [App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/{recipe}/remove', [App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');

    // Stripe Routes
    Route::post('/stripe/checkout/cart', [App\Http\Controllers\StripeController::class, 'checkoutCart'])->name('stripe.checkout.cart');
    Route::post('/stripe/checkout/{recipe}', [App\Http\Controllers\StripeController::class, 'checkout'])->name('stripe.checkout');
    Route::get('/stripe/success/cart', [App\Http\Controllers\StripeController::class, 'successCart'])->name('stripe.success.cart');
    Route::get('/stripe/success/{recipe}', [App\Http\Controllers\StripeController::class, 'success'])->name('stripe.success');
});

Route::middleware('auth')->group(function () {
    Route::post('/recipes/{recipe}/checkout', [StripeController::class, 'checkout'])->name('stripe.checkout');
    Route::get('/recipes/{recipe}/checkout/success', [StripeController::class, 'success'])->name('stripe.success');
});
