<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PageAdminController;
use App\Http\Controllers\Admin\ServiceAdminController;
use App\Http\Controllers\Admin\ProductAdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\SettingController;

/*
|--------------------------------------------------------------------------
| Admin Auth Routes (no middleware)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::post('/logout',[AuthController::class, 'logout'])->name('logout');

    /*
    |--------------------------------------------------------------------------
    | Protected Admin Routes
    |--------------------------------------------------------------------------
    */
    Route::middleware('admin')->group(function () {

        // Dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // ── Pages ─────────────────────────────────────────────
        Route::prefix('pages')->name('pages.')->group(function () {
            Route::get('/',                    [PageAdminController::class, 'index'])->name('index');
            Route::get('/{slug}/edit',         [PageAdminController::class, 'edit'])->name('edit');
            Route::put('/{slug}',              [PageAdminController::class, 'update'])->name('update');
            Route::delete('/{slug}/hero-image',[PageAdminController::class, 'removeHeroImage'])->name('remove-hero');
        });

        // ── Services ──────────────────────────────────────────
        Route::prefix('services')->name('services.')->group(function () {
            Route::get('/',              [ServiceAdminController::class, 'index'])->name('index');
            Route::get('/create',        [ServiceAdminController::class, 'create'])->name('create');
            Route::post('/',             [ServiceAdminController::class, 'store'])->name('store');
            Route::get('/{service}/edit',[ServiceAdminController::class, 'edit'])->name('edit');
            Route::put('/{service}',     [ServiceAdminController::class, 'update'])->name('update');
            Route::delete('/{service}',  [ServiceAdminController::class, 'destroy'])->name('destroy');
            Route::patch('/reorder',     [ServiceAdminController::class, 'reorder'])->name('reorder');
        });

        // ── Products ──────────────────────────────────────────
        Route::prefix('products')->name('products.')->group(function () {
            Route::get('/',                          [ProductAdminController::class, 'index'])->name('index');
            Route::get('/create',                    [ProductAdminController::class, 'create'])->name('create');
            Route::post('/',                         [ProductAdminController::class, 'store'])->name('store');
            Route::get('/{product}/edit',            [ProductAdminController::class, 'edit'])->name('edit');
            Route::put('/{product}',                 [ProductAdminController::class, 'update'])->name('update');
            Route::delete('/{product}',              [ProductAdminController::class, 'destroy'])->name('destroy');
            Route::patch('/{product}/remove-image',  [ProductAdminController::class, 'removeImage'])->name('remove-image');
            Route::patch('/reorder',                 [ProductAdminController::class, 'reorder'])->name('reorder');
        });

        // ── Categories ────────────────────────────────────────
        Route::prefix('categories')->name('categories.')->group(function () {
            Route::get('/',                   [CategoryController::class, 'index'])->name('index');
            Route::post('/',                  [CategoryController::class, 'store'])->name('store');
            Route::put('/{category}',         [CategoryController::class, 'update'])->name('update');
            Route::delete('/{category}',      [CategoryController::class, 'destroy'])->name('destroy');
            Route::patch('/reorder',          [CategoryController::class, 'reorder'])->name('reorder');
        });

        // ── Inquiries ─────────────────────────────────────────
        Route::prefix('inquiries')->name('inquiries.')->group(function () {
            Route::get('/',                [InquiryController::class, 'index'])->name('index');
            Route::get('/{contact}',       [InquiryController::class, 'show'])->name('show');
            Route::delete('/{contact}',    [InquiryController::class, 'destroy'])->name('destroy');
        });

        // ── Settings ──────────────────────────────────────────
        Route::prefix('settings')->name('settings.')->group(function () {
            Route::get('/',  [SettingController::class, 'index'])->name('index');
            Route::post('/', [SettingController::class, 'update'])->name('update');
        });
    });
});