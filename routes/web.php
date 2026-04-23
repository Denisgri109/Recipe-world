<?php

use App\Http\Controllers\RecipeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CreatorDashboardController;
use App\Models\Recipe;
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
    $featuredRecipes = Recipe::with(['user', 'category'])
        ->latest()
        ->take(6)
        ->get();

    return view('home', compact('featuredRecipes'));
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

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/home', [CreatorDashboardController::class, 'index'])->name('dashboard');
    Route::get('/creator/dashboard', [CreatorDashboardController::class, 'index'])->name('creator.dashboard');
    Route::get('/creator/dashboard/summary', [CreatorDashboardController::class, 'summary'])->name('creator.dashboard.summary');
});
