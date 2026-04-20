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

Route::get('/home', [HomeController::class, 'index'])->name('dashboard');

use App\Http\Controllers\OrderController;

Route::middleware(['auth'])->prefix('orders')->name('orders.')->group(function () {
    Route::get('my-purchases', [OrderController::class, 'myOrders'])->name('my');
    Route::get('sales', [OrderController::class, 'sales'])->name('sales');
    Route::post('{recipe}/purchase', [OrderController::class, 'purchase'])->name('purchase');
});
