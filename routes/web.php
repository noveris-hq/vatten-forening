<?php

use App\Http\Controllers\Admin\FileController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Member\DashboardController;
use App\Http\Controllers\Member\DocumentController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\StatusController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

// Member portal
Route::prefix('medlemsportal')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('member.dashboard');
    Route::get('/dokument', [DocumentController::class, 'index'])->name('member.documents');
    Route::get('/betalningar', [PaymentController::class, 'index'])->name('member.payments');
});

// Admin portal
Route::prefix('adminportal')->middleware('auth')->group(function () {
    Route::resource('admin/news', NewsController::class);
    Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/status', [StatusController::class, 'index'])->name('status.index');
    Route::put('/status', [StatusController::class, 'update'])->name('status.update');
    Route::get('/upload', [FileController::class, 'index'])->name('admin.upload.index');
    Route::get('/upload/download/{document}', [FileController::class, 'download'])->name('admin.upload.download');
    Route::delete('/upload/{document}', [FileController::class, 'destroy'])->name('admin.upload.destroy');
    Route::post('/upload', [FileController::class, 'store'])->name('admin.upload.store');
});
