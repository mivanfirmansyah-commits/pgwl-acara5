<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PolygonModel extends Model
{
    protected $table = 'polygon';
    protected $guarded = ['id'];

    public function geojson_polygon()
    {
        $polygon = $this->select(DB::raw('id, ST_AsGeoJSON(geom) as
        geojson, name, description, image, created_at, updated_at'))->get();

        $geojson = [
            'type' => 'FeatureCollection',
            'features' => []
        ];

        // Perulangan setiap garis untuk membuat fitur GeoJSON
        foreach ($polygon as $gon) {
            $feature = [
                'type' => 'Feature',
                'geometry' => json_decode($gon->geojson),
                'properties' => [
                    'id' => $gon->id,
                    'name' => $gon->name,
                    'description' => $gon->description,
                    'image' => $gon->image,
                    'created_at' => $gon->created_at,
                    'updated_at' => $gon->updated_at
                ]
            ];

            array_push($geojson['features'], $feature);
        }

        return $geojson;
    }
}
