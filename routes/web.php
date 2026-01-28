<?php

use App\Http\Controllers\Admin\AdminMapController;
use App\Http\Controllers\Admin\AdminNewsController;
use App\Http\Controllers\Admin\FileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Member\DashboardController;
use App\Http\Controllers\Member\DocumentController;
use App\Http\Controllers\Member\MemberMapController;
use App\Http\Controllers\Member\NewsController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\WaterValveController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

// Water valve routes
Route::prefix('adminportal')
    ->middleware('auth')
    ->group(function () {
        Route::get('/vattenventiler/skapa', [WaterValveController::class, 'create'])->name('water-valves.create');
        Route::post('/vattenventiler', [WaterValveController::class, 'store'])->name('water-valves.store');
        Route::get('/vattenventiler/{waterValve}/redigera', [WaterValveController::class, 'edit'])->name(
            'water-valves.edit',
        );
        Route::put('/vattenventiler/{waterValve}', [WaterValveController::class, 'update'])->name(
            'water-valves.update',
        );
        Route::delete('/vattenventiler/{waterValve}', [WaterValveController::class, 'destroy'])->name(
            'water-valves.destroy',
        );
    });

// Member portal
Route::prefix('medlemsportal')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('member.dashboard');
        Route::get('/dokument', [DocumentController::class, 'index'])->name('member.documents');
        Route::get('/karta', [MemberMapController::class, 'index'])->name('member.map');
        Route::get('/betalningar', [PaymentController::class, 'index'])->name('member.payments');
        Route::get('/nyheter/{news}', [NewsController::class, 'show'])->name('member.news.show');
    });

// Admin portal
Route::prefix('adminportal')
    ->middleware('auth')
    ->group(function () {
        Route::resource('nyheter', AdminNewsController::class);
        /* Route::resource('fastighet', UserController::class); */
        Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/karta', [AdminMapController::class, 'index'])->name('admin.map.index');
        Route::post('/karta', [AdminMapController::class, 'store'])->name('admin.map.store');
        /* Route::get('/medlemmar', [UserController::class, 'index'])->name('admin.index'); */
        Route::resource('medlemmar', UserController::class)->parameters([
            'medlemmar' => 'user',
        ]);
        Route::get('/status', [StatusController::class, 'index'])->name('status.index');
        Route::put('/status', [StatusController::class, 'update'])->name('status.update');
        Route::get('/dokument', [FileController::class, 'index'])->name('admin.document.index');
        Route::get('/dokument/download/{document}', [FileController::class, 'download'])->name(
            'admin.document.download',
        );
        Route::delete('/dokument/{document}', [FileController::class, 'destroy'])->name('admin.document.destroy');
        Route::post('/dokument', [FileController::class, 'store'])->name('admin.document.store');
    });
