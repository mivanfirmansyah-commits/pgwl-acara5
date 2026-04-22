<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PolylinesModel extends Model
{
    protected $table = 'polyline';
    protected $guarded = ['id'];

    public function geojson_polyline()
    {
        $polyline = $this->select(DB::raw('id, ST_AsGeoJSON(geom) as
        geojson, name, description, image, created_at, updated_at'))->get();

        $geojson = [
            'type' => 'FeatureCollection',
            'features' => []
        ];

        // Perulangan setiap garis untuk membuat fitur GeoJSON
        foreach ($polyline as $poly) {
            $feature = [
                'type' => 'Feature',
                'geometry' => json_decode($poly->geojson),
                'properties' => [
                    'id' => $poly->id,
                    'name' => $poly->name,
                    'description' => $poly->description,
                    'image' => $poly->image,
                    'created_at' => $poly->created_at,
                    'updated_at' => $poly->updated_at
                ]
            ];

            array_push($geojson['features'], $feature);
        }

        return $geojson;
    }
}
