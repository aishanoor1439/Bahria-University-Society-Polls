<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminForgotPasswordController;
use App\Http\Controllers\AdminResetPasswordController;
use App\Http\Controllers\AdminSocietyController;
use App\Http\Controllers\AdminPositionController;
use App\Http\Controllers\SocietyMemberController;
use App\Http\Controllers\AdminElectionController;
use App\Http\Controllers\ElectionCandidateController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserForgotPasswordController;
use App\Http\Controllers\UserResetPasswordController;
use App\Http\Controllers\StudentSocietyController;
use App\Http\Controllers\StudentElectionController;
use Illuminate\Support\Facades\DB;
use App\Models\Election;

// Welcome route
Route::get('/', function () {
     return view('welcome');
})->name('welcome');

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
Route::prefix('admin')->name('admin.')->group(function () {
     // Main elections resource
     Route::resource('elections', AdminElectionController::class);

     // Toggle active status
     Route::post('elections/{election}/toggle-active', [AdminElectionController::class, 'toggleActive'])
          ->name('elections.toggle-active');

     // Candidate management routes
     Route::prefix('elections/{election}/candidates')->name('elections.candidates.')->group(function () {
          Route::get('/', [ElectionCandidateController::class, 'index'])->name('index');
          Route::put('{application}/approve', [ElectionCandidateController::class, 'approve'])->name('approve');
          Route::put('{application}/reject', [ElectionCandidateController::class, 'reject'])->name('reject');
          Route::delete('{candidate}', [ElectionCandidateController::class, 'remove'])->name('remove');
          Route::post('{application}/reconsider', [ElectionCandidateController::class, 'reconsider'])->name('reconsider');
     });
});

// Logout route for admin
Route::post('/admin/logout', [AdminController::class, 'logout'])
     ->name('admin.logout');

// Authentication routes for student
Route::get('user/register', [UserController::class, 'showRegister'])->name('user.register');
Route::post('user/register', [UserController::class, 'register'])->name('user.register.submit');

Route::get('/user/login', [UserController::class, 'showLogin'])->name('user.login');
Route::post('/user/login', [UserController::class, 'login'])->name('user.login.submit');

Route::get('/user/dashboard', [UserController::class, 'showDashboard'])->name('user.dashboard');

// Logout route for student
Route::post('/user/logout', [UserController::class, 'logout'])
     ->name('user.logout');

// Password reset routes for student
Route::prefix('student')->group(function () {
     Route::get('/forgot-password', [UserForgotPasswordController::class, 'showLinkRequestForm'])
          ->name('user.password.request');

     Route::post('/forgot-password', [UserForgotPasswordController::class, 'sendResetLinkEmail'])
          ->name('user.password.email');

     Route::get('/reset-password/{token}', [UserResetPasswordController::class, 'showResetForm'])
          ->name('user.password.reset');

     Route::post('/reset-password', [UserResetPasswordController::class, 'reset'])
          ->name('user.password.update');
});

// Student Society Routes
Route::prefix('student')->name('student.')->group(function () {
     Route::get('/societies', [StudentSocietyController::class, 'index'])->name('societies.index');
     Route::get('/societies/{society}', [StudentSocietyController::class, 'show'])->name('societies.show');
     
     // Election Routes
     Route::prefix('elections')->name('elections.')->group(function () {
          Route::get('/societies', [StudentElectionController::class, 'index'])
               ->name('societies.index');
          Route::get('/societies/{society}/elections', [StudentElectionController::class, 'showElections'])
               ->name('societies.elections');
          Route::get('/elections/{election}/vote', [StudentElectionController::class, 'showVoteForm'])
               ->name('vote');
          Route::post('/elections/{election}/vote', [StudentElectionController::class, 'submitVote'])
               ->name('vote.submit');
          Route::get('/elections/{election}/apply', [StudentElectionController::class, 'showApplicationForm'])
               ->name('apply');
          Route::post('/elections/{election}/apply', [StudentElectionController::class, 'submitApplication'])
               ->name('apply.submit');
          Route::get('/elections/{election}/results', [StudentElectionController::class, 'showResults'])
               ->name('results');
     });
});
