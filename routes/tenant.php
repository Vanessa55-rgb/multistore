<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    
    Route::get('/', [CatalogController::class, 'index'])->name('tenant.catalog');

    Route::get('login', [\App\Http\Controllers\Tenant\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [\App\Http\Controllers\Tenant\LoginController::class, 'login'])->name('tenant.login');
    Route::post('logout', [\App\Http\Controllers\Tenant\LoginController::class, 'logout'])->name('tenant.logout');

    Route::prefix('admin')->middleware('auth')->name('tenant.admin.')->group(function () {
        Route::resource('products', ProductController::class);
        Route::get('/', [ProductController::class, 'index'])->name('dashboard'); 
    });
});
