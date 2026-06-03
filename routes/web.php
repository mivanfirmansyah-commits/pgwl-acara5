<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PointsController;
use App\Http\Controllers\PolylinesController;
use App\Http\Controllers\PolygonController;

// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

Route::get('/', [PageController::class, 'landingpage'])->name('home');

Route::view('/map', 'map', ['title' => 'Peta Wisata'])
->middleware(['auth', 'verified'])
->name('peta');

Route::get('/table', [PointsController::class, 'index'])->name('table');

Route::view('/tentang', 'tentang', ['title' => 'Tentang'])->name('tentang');

// Points
Route::post('/points', [PointsController::class, 'store'])->name('points.store');

// Route untuk menghapus titik
Route::delete('/delete-points/{id}', [PointsController::class, 'destroy'])->name('points.delete');

// Route untuk mengedit titik berdasarkan ID
Route::get('/edit-points/{id}', [PointsController::class, 'edit'])->name('points.edit');
Route::put('/update-points/{id}', [PointsController::class, 'update'])->name('points.update');

// Route untuk update point berdasarkan ID
Route::patch('/update-points/{id}', [PointsController::class, 'update'])->name('points.update');

// Polyline
Route::post('/polyline', [PolylinesController::class, 'store'])->name('polyline.store');

// Route untuk menghapus garis
Route::delete('/delete-polyline/{id}', [PolylinesController::class, 'destroy'])->name('polyline.delete');

// Route untuk mengedit garis berdasarkan ID
Route::get('/edit-polyline/{id}', [PolylinesController::class, 'edit'])->name('polyline.edit');
Route::put('/update-polyline/{id}', [PolylinesController::class, 'update'])->name('polyline.update');

// Route untuk update garis berdasarkan ID
Route::patch('/update-polyline/{id}', [PolylinesController::class, 'update'])->name('polyline.update');

// Polygon
Route::post('/polygon', [PolygonController::class, 'store'])->name('polygon.store');

// Route untuk menghapus polygon
Route::delete('/delete-polygon/{id}', [PolygonController::class, 'destroy'])->name('polygon.delete');

// Route untuk mengedit garis berdasarkan ID
Route::get('/edit-polygon/{id}', [PolygonController::class, 'edit'])->name('polygon.edit');
Route::put('/update-polygon/{id}', [PolygonController::class, 'update'])->name('polygon.update');

// Route untuk update garis berdasarkan ID
Route::patch('/update-polygon/{id}', [PolygonController::class, 'update'])->name('polygon.update');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


require __DIR__ . '/settings.php';
