<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use App\Http\Controllers\Tenant\CatalogController;
use App\Http\Controllers\Tenant\ProductController;
use App\Http\Controllers\Tenant\LoginController;
use App\Http\Controllers\Tenant\RegisterController;


/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
*/

$currentHost = request()->getHost();
$centralDomains = config('tenancy.central_domains', []);
if (!in_array($currentHost, $centralDomains)) {



    Route::middleware([
        'web',
        InitializeTenancyByDomain::class,
        PreventAccessFromCentralDomains::class,
    ])->group(function () {

        Route::get('/', [CatalogController::class, 'index'])->name('tenant.catalog');
        Route::get('/product/{product}', [CatalogController::class, 'show'])->name('tenant.products.show');
        Route::post('/product/{product}/like', [CatalogController::class, 'like'])->name('tenant.products.like');

        Route::get('login', [LoginController::class, 'showLoginForm'])->name('tenant.login');
        Route::post('login', [LoginController::class, 'login'])->name('tenant.login.post');

        // Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('tenant.register');
        // Route::post('register', [RegisterController::class, 'register'])->name('tenant.register.post');

        Route::post('logout', [LoginController::class, 'logout'])->name('tenant.logout');


        Route::prefix('admin')->middleware('auth')->name('tenant.admin.')->group(function () {
            Route::resource('products', ProductController::class);
            Route::get('settings', [App\Http\Controllers\Tenant\SettingsController::class, 'index'])->name('settings');
            Route::post('settings', [App\Http\Controllers\Tenant\SettingsController::class, 'update'])->name('settings.update');
            Route::get('/', [ProductController::class, 'index'])->name('dashboard');
        });
    });
}



