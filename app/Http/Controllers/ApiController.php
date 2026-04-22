<?php

namespace App\Http\Controllers;

use App\Models\PointsModel;
use App\Models\PolygonModel;
use App\Models\PolylinesModel;


class ApiController extends Controller
{
    public function __construct()
    {
        $this->points = new PointsModel();
        $this->polyline = new PolylinesModel();
        $this->polygon = new PolygonModel();
    }

    public function geojson_points()
    {
        $this->points = $this->points->geojson_points();

        return response()->json($this->points, 200, [], JSON_NUMERIC_CHECK);
    }

    public function geojson_polyline()
    {
        $this->polyline = $this->polyline->geojson_polyline();

        return response()->json($this->polyline, 200, [], JSON_NUMERIC_CHECK);
    }

    public function geojson_polygon()
    {
        $this->polygon = $this->polygon->geojson_polygon();

        return response()->json($this->polygon, 200, [], JSON_NUMERIC_CHECK);
    }
}
