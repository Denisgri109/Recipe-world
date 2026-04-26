<?php

use App\Http\Controllers\RecipeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CreatorDashboardController;
use App\Http\Controllers\CreatorRecipeManagementController;
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

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

Route::post('/contact', function (Request $request) {
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'subject' => 'required|string|max:255',
        'message' => 'required|string',
    ]);

    // Save to local database
    $messageRecord = Message::create($data);

    // Send notification to admin via Resend
    try {
        \Illuminate\Support\Facades\Mail::to(env('ADMIN_EMAIL', env('MAIL_FROM_ADDRESS'))) // Send to your personal email
            ->send(new \App\Mail\ContactAdminMail($data));
        
        \Illuminate\Support\Facades\Log::info('Resend Email Submitted Successfully');
    } catch (\Exception $e) {
        \Illuminate\Support\Facades\Log::error('Resend Submission Failed: ' . $e->getMessage());
    }

    return redirect()->back()->with('success', 'Your message has been sent successfully. We will deal with it shortly!');
})->name('contact.submit');

// Google OAuth routes
use App\Http\Controllers\Auth\GoogleController;

Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Auth::routes();

use App\Http\Controllers\ProfileController;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    Route::post('/profile/preference', [ProfileController::class, 'updatePreference'])->name('profile.preference');
});

// Use CreatorDashboardController instead of HomeController for /home if it's the new standard
Route::get('/home', [CreatorDashboardController::class, 'index'])->name('dashboard');

use App\Http\Controllers\OrderController;
use App\Http\Controllers\StripeController;

Route::middleware(['auth'])->prefix('orders')->name('orders.')->group(function () {
    Route::get('my-purchases', [OrderController::class, 'myOrders'])->name('my');
    Route::get('sales', [OrderController::class, 'sales'])->name('sales');
    Route::post('{recipe}/purchase', [OrderController::class, 'purchase'])->name('purchase');
});

Route::middleware('auth')->group(function () {
    // Creator Dashboard Routes
    Route::get('/creator/dashboard', [CreatorDashboardController::class, 'index'])->name('creator.dashboard');
    Route::get('/creator/dashboard/summary', [CreatorDashboardController::class, 'summary'])->name('creator.dashboard.summary');
    Route::get('/creator/my-recipes', [CreatorRecipeManagementController::class, 'index'])->name('creator.recipes.index');

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

// Admin Routes
use App\Http\Controllers\AdminController;

Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('users.edit');
    Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('users.update');
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('users.destroy');
    Route::post('/users/{user}/ban', [AdminController::class, 'banUser'])->name('users.ban');
    Route::post('/users/{user}/unban', [AdminController::class, 'unbanUser'])->name('users.unban');
    
    Route::get('/recipes', [AdminController::class, 'recipes'])->name('recipes');
    Route::delete('/recipes/{recipe}', [AdminController::class, 'deleteRecipe'])->name('recipes.destroy');
    
    Route::get('/messages', [AdminController::class, 'messages'])->name('messages');
    Route::get('/messages/{message}', [AdminController::class, 'showMessage'])->name('messages.show');
    Route::post('/messages/{message}/reply', [AdminController::class, 'replyMessage'])->name('messages.reply');
    Route::post('/messages/{message}/resolve', [AdminController::class, 'resolveMessage'])->name('messages.resolve');
});
