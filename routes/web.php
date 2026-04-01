<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PartnersController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/about', [AboutController::class, 'index'])->name('about');

Route::prefix('services')->name('services.')->group(function () {
    Route::get('/',        [ServiceController::class, 'index'])->name('index');
    Route::get('/{slug}',  [ServiceController::class, 'show'])->name('show');
});

Route::prefix('products')->name('products.')->group(function () {
    Route::get('/',        [ProductController::class, 'index'])->name('index');
    Route::get('/{slug}',  [ProductController::class, 'show'])->name('show');
});

Route::get('/partners', [PartnersController::class, 'index'])->name('partners');

Route::get('/contact',  [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Static pages: /terms, /privacy
Route::get('/{slug}', [PageController::class, 'show'])
    ->where('slug', 'terms|privacy')
    ->name('static.page');