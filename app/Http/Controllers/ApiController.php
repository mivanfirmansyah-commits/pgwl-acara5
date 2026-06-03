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
        $points = $this->points->geojson_points();
        return response()->json($points, 200, [], JSON_NUMERIC_CHECK);
    }

    public function geojson_point($id)
    {
        $point = $this->points->geojson_point($id);
        return response()->json($point, 200, [], JSON_NUMERIC_CHECK);
    }

    public function geojson_polylines()
    {
        $this->polylines = $this->polyline->geojson_polylines();
        return response()->json($this->polylines, 200, [], JSON_NUMERIC_CHECK);
    }

    public function geojson_polyline($id)
    {
        $this->polyline = $this->polyline->geojson_polyline($id);
        return response()->json($this->polyline, 200, [], JSON_NUMERIC_CHECK);
    }

    public function geojson_polygons()
    {
        $this->polygons = $this->polygon->geojson_polygons();
        return response()->json($this->polygons, 200, [], JSON_NUMERIC_CHECK);
    }

    public function geojson_polygon($id)
    {
        $this->polygon = $this->polygon->geojson_polygon($id);
        return response()->json($this->polygon, 200, [], JSON_NUMERIC_CHECK);
    }
}
