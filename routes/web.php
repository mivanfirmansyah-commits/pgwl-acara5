<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PointsController;
use App\Http\Controllers\PolylinesController;
use App\Http\Controllers\PolygonController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('/map', 'map', ['title' => 'Peta Wisata'])->name('peta');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('/table', 'table', ['title' => 'Tabel Data'])->name('table');

Route::view('/tentang', 'tentang', ['title' => 'Tentang'])->name('tentang');

// Points
Route::post('/points', [PointsController::class, 'store'])->name('points.store');

// Route untuk menghapus titik
Route::delete('/delete-points/{id}', [PointsController::class, 'destroy'])->name('points.delete');

// Route untuk mengedit titik
Route::get('/edit-points/{id}', [PointsController::class, 'edit'])->name('points.edit');
Route::put('/update-points/{id}', [PointsController::class, 'update'])->name('points.update');

// Polyline
Route::post('/polyline', [PolylinesController::class, 'store'])->name('polyline.store');

// Route untuk menghapus garis
Route::delete('/delete-polyline/{id}', [PolylinesController::class, 'destroy'])->name('polyline.delete');

// Polygon
Route::post('/polygon', [PolygonController::class, 'store'])->name('polygon.store');

// Route untuk menghapus polygon
Route::delete('/delete-polygon/{id}', [PolygonController::class, 'destroy'])->name('polygon.delete');

// require __DIR__ . '/settings.php';
