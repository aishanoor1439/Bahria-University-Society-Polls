<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminForgotPasswordController;
use App\Http\Controllers\AdminResetPasswordController;
use App\Http\Controllers\AdminSocietyController;
use App\Http\Controllers\AdminPositionController;
use App\Http\Controllers\SocietyMemberController;

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
Route::resource('societies', AdminSocietyController::class);

Route::prefix('societies/{society}')->group(function () {
    // Positions routes
    Route::resource('positions', AdminPositionController::class)->except(['index', 'show']);
    
    // Members routes - Corrected (no nested prefix)
    Route::get('members', [SocietyMemberController::class, 'index'])->name('societies.members.index');
    Route::post('members', [SocietyMemberController::class, 'store'])->name('societies.members.store');
    Route::put('members/{student}', [SocietyMemberController::class, 'update'])->name('societies.members.update');
    Route::delete('members/{student}', [SocietyMemberController::class, 'destroy'])->name('societies.members.destroy');
});

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
