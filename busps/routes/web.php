<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin/register', [AdminController::class, 'showRegister'])->name('admin.register');
Route::post('admin/register', [AdminController::class, 'register'])->name('admin.register.submit');