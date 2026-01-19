<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Central\TenantController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'web',
])->group(function () {
    Route::resource('tenants', TenantController::class)->names('central.tenants');
    
    Route::resource('admins', \App\Http\Controllers\Central\AdminController::class)->names('central.admins');

    Route::get('tenants/{tenant}/admins', [\App\Http\Controllers\Central\TenantAdminController::class, 'index'])->name('central.tenants.admins.index');
    Route::get('tenants/{tenant}/admins/create', [\App\Http\Controllers\Central\TenantAdminController::class, 'create'])->name('central.tenants.admins.create');
    Route::post('tenants/{tenant}/admins', [\App\Http\Controllers\Central\TenantAdminController::class, 'store'])->name('central.tenants.admins.store');
    Route::delete('tenants/{tenant}/admins/{user}', [\App\Http\Controllers\Central\TenantAdminController::class, 'destroy'])->name('central.tenants.admins.destroy');
});
