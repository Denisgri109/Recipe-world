<?php

use App\Http\Controllers\Api\CreatorAnalyticsController;
use App\Http\Controllers\Api\CreatorRecipeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/creator/recipes', [CreatorRecipeController::class, 'index'])
        ->name('api.creator.recipes.index');

    Route::get('/creator/analytics/summary', [CreatorAnalyticsController::class, 'summary'])
        ->name('api.creator.analytics.summary');
});
