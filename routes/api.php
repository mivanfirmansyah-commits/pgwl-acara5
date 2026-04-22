<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/points', [ApiController::class, 'geojson_points'])->name('geojson_points');

Route::get('/polyline', [ApiController::class, 'geojson_polyline'])->name('geojson_polyline');

Route::get('/polygon', [ApiController::class, 'geojson_polygon'])->name('geojson_polygon');
