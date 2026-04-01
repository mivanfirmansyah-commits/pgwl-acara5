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

// Polyline
Route::post('/polyline', [PolylinesController::class, 'store'])->name('polyline.store');

// Polygon
Route::post('/polygon', [PolygonController::class, 'store'])->name('polygon.store');

// require __DIR__ . '/settings.php';
