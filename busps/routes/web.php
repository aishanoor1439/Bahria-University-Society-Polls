<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminForgotPasswordController;
use App\Http\Controllers\AdminResetPasswordController;

// Testing routes
Route::get('/admin/admin-reset', function () {
    return view('admin/admin-reset');
});
Route::get('/admin/panel', function () {
    return view('layouts/panel');
});

Route::get('admin/register', [AdminController::class, 'showRegister'])->name('admin.register');
Route::post('admin/register', [AdminController::class, 'register'])->name('admin.register.submit');

Route::get('/admin/login', [AdminController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');

Route::get('/admin/dashboard', [AdminController::class, 'showDashboard'])->name('admin.dashboard');

// Password reset routes for admins
Route::prefix('admin')->group(function () {
    Route::get('/forgot-password', [AdminForgotPasswordController::class, 'showLinkRequestForm'])
         ->name('admin.password.request');
    
    Route::post('/forgot-password', [AdminForgotPasswordController::class, 'sendResetLinkEmail'])
         ->name('admin.password.email');
    
    Route::get('/reset-password/{token}', [AdminResetPasswordController::class, 'showResetForm'])
         ->name('admin.password.reset');
    
    Route::post('/reset-password', [AdminResetPasswordController::class, 'reset'])
         ->name('admin.password.update');
});