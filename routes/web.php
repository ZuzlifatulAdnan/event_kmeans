<?php

use App\Http\Controllers\BerandaController;
use App\Http\Controllers\KmeansController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UmkmController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/beranda');

Route::middleware(['auth'])->group(function () {
    // beranda
    Route::resource('beranda', BerandaController::class);
    // kmeans
    Route::get('/kmeans/export-keikutsertaan', [KmeansController::class, 'exportKeikutsertaan'])->name('kmeans.export.keikutsertaan');
Route::get('/kmeans/export-clustering', [KmeansController::class, 'exportClustering'])->name('kmeans.export.clustering');
    Route::post('/kmeans/reset-centroid', [KmeansController::class, 'resetCentroid'])->name('kmeans.resetCentroid');
    Route::post('/kmeans/update-centroid', [KMeansController::class, 'updateCentroid'])->name('kmeans.updateCentroid');
    Route::resource('kmeans', KmeansController::class);
    // Umkm
    Route::get('/umkm/export', [UmkmController::class, 'export'])->name('umkm.export');
    Route::post('/umkm/import', [UmkmController::class, 'import'])->name('umkm.import');
    Route::resource('umkm', UmkmController::class);
    // User
    Route::resource('user', UserController::class);
    // Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update/{user}', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('profile/change-password', [ProfileController::class, 'changePasswordForm'])->name('profile.change-password-form');
    Route::post('profile/change-password/{user}', [ProfileController::class, 'changePassword'])->name('profile.change-password');
});