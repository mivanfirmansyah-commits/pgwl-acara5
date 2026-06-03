<?php

namespace App\Http\Controllers;
use App\Models\PointsModel;
use App\Models\PolygonModel;
use App\Models\PolylinesModel;
use App\Models\User;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function __construct()
    {
        $this->points = new PointsModel();
        $this->polylines = new PolylinesModel();
        $this->polygon = new PolygonModel();
        $this->user = new User();
    }

    public function landingpage()
    {
        $data = [
            'title' => 'PGWL',
            'points_count' => $this->points->count(),
            'polylines_count' => $this->polylines->count(),
            'polygon_count' => $this->polygon->count(),
            'user_count' => $this->user->count(),
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
        $data = [
            'title' => 'Tabel',
            'points' => $this->points->all(),
            'polylines' => $this->polylines->all(),
            'polygon' => $this->polygon->all(),
        ];
        return view('table', $data);
    }
}
