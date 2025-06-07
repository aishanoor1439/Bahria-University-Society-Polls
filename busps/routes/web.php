<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminForgotPasswordController;
use App\Http\Controllers\AdminResetPasswordController;
use App\Http\Controllers\AdminSocietyController;
use App\Http\Controllers\AdminPositionController;
use App\Http\Controllers\SocietyMemberController;
use App\Http\Controllers\AdminElectionController;

// Testing routes
Route::get('/admin/admin-reset', function () {
     return view('admin/admin-reset');
});
Route::get('/admin/panel', function () {
     return view('layouts/panel');
});


// Authentication routes for admin
Route::get('admin/register', [AdminController::class, 'showRegister'])->name('admin.register');
Route::post('admin/register', [AdminController::class, 'register'])->name('admin.register.submit');

Route::get('/admin/login', [AdminController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');

Route::get('/admin/dashboard', [AdminController::class, 'showDashboard'])->name('admin.dashboard');

// Password reset routes for admin
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

//Society management routes for admin
Route::resource('societies', AdminSocietyController::class);

Route::prefix('societies/{society}')->group(function () {
     // Positions routes
     Route::prefix('positions')->group(function () {
          Route::get('create', [AdminPositionController::class, 'create'])->name('positions.create');
          Route::post('/', [AdminPositionController::class, 'store'])->name('positions.store');
          Route::get('{position}/edit', [AdminPositionController::class, 'edit'])->name('positions.edit');
          Route::put('{position}', [AdminPositionController::class, 'update'])->name('positions.update');
          Route::delete('{position}', [AdminPositionController::class, 'destroy'])->name('positions.destroy');
     });
     // Members routes
     Route::get('members', [SocietyMemberController::class, 'index'])->name('societies.members.index');
     Route::post('members', [SocietyMemberController::class, 'store'])->name('societies.members.store');
     Route::put('members/{student}', [SocietyMemberController::class, 'update'])->name('societies.members.update');
     Route::delete('members/{student}', [SocietyMemberController::class, 'destroy'])->name('societies.members.destroy');
});

// Election management routes for admin
// Route::prefix('admin')->group(function () {
//      Route::resource('elections', AdminElectionController::class);
//      Route::post('elections/{election}/toggle-active', [AdminElectionController::class, 'toggleActive'])
//           ->name('admin.elections.toggle-active');
// });
// routes/web.php
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('elections', AdminElectionController::class);
    Route::post('elections/{election}/toggle-active', [AdminElectionController::class, 'toggleActive'])
         ->name('elections.toggle-active');
});
