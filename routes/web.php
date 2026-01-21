<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Central\TenantController;

use App\Http\Controllers\Central\LoginController;

Route::get('/', function () {
    return view('welcome');
});

// Central Login Routes
Route::get('central/login', [LoginController::class, 'showLoginForm'])->name('login');

Route::post('central/login', [LoginController::class, 'login']);
Route::post('central/logout', [LoginController::class, 'logout'])->name('central.logout');

Route::middleware([
    'web',
    'auth' // Protegemos las rutas centrales
])->prefix('central')->group(function () {
    Route::resource('tenants', TenantController::class)->names('central.tenants');
    Route::resource('admins', \App\Http\Controllers\Central\AdminController::class)->names('central.admins');

    Route::resource('tenants.admins', \App\Http\Controllers\Central\TenantAdminController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy'])->names('central.tenants.admins');
});

