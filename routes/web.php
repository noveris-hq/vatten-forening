<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Member\DashboardController;
use App\Http\Controllers\Member\DocumentController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

// Route::statamic('example', 'example-view', [
//    'title' => 'Example'
// ]);

// Public routes (Statamic)
/* Route::statamic('/', 'home'); */

Route::get('/', [HomeController::class, 'index']);

// Member portal (using Fortify for auth)
Route::prefix('medlemsportal')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('member.dashboard');
    Route::get('/dokument', [DocumentController::class, 'index'])->name('member.documents');
    Route::get('/betalningar', [PaymentController::class, 'index'])->name('member.payments');
});

Route::prefix('adminportal')->middleware('auth')->group(function () {
    Route::resource('admin/news', NewsController::class);
    Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
});

Route::prefix('adminportal')->middleware('admin')->get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

// Fortify handles these automatically:
// /login (GET/POST)
// /register (GET/POST)
// /logout (POST)
// /forgot-password (GET/POST)
// /reset-password (GET/POST)

// Contact form
/* Route::post('/kontakt', [App\Http\Controllers\ContactController::class, 'submit']) */
/*     ->name('contact.submit'); */
