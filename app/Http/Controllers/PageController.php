<?php

namespace App\Http\Controllers;

// Import Model Anda
use App\Models\PointsModel;
use App\Models\PolygonModel;
use App\Models\PolylinesModel;
use App\Models\User;
use Illuminate\Http\Request;

class PageController extends Controller
{
    // Kita tidak perlu menggunakan __construct dan 'new Model' lagi agar kode lebih bersih & aman

    public function landingpage()
    {
        $data = [
            'title' => 'PGWL',
            'points_count' => PointsModel::count(),
            'polylines_count' => PolylinesModel::count(),
            'polygon_count' => PolygonModel::count(),
            'user_count' => User::count(),
        ];
        return view('home', $data);
    }

    public function map()
    {
        $data = [
            'title' => 'Peta',
        ];
        return view('map', $data);
    }

    public function tabel()
    {
        // Mengambil data langsung menggunakan Method Static ::all() bawaan Laravel
        $data = [
            'title' => 'Tabel',
            'points' => PointsModel::all(),
            'polylines' => PolylinesModel::all(),
            'polygons' => PolygonModel::all(), // DIUBAH menjadi 'polygons' agar sesuai dengan @foreach ($polygons ...) di Blade
        ];
        return view('table', $data);
    }
}
