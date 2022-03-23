<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Providers;

class FindProviderByLocationController extends Controller
{
    public function store(Request $request){
        $latitude = $request->lat;
        $longitude = $request->lng;
        $radius = 500;

        $doctors = Providers::
        selectRaw("id, latitude, longitude, name, location, avatar,
         ( 6371 * acos( cos( radians(?) ) *
           cos( radians( latitude ) )
           * cos( radians( longitude ) - radians(?)
           ) + sin( radians(?) ) *
           sin( radians( latitude ) ) )
         ) AS distance", [$latitude, $longitude, $latitude])
        ->having("distance", "<", $radius)
        ->orderBy("distance",'asc')
        ->offset(0)
        ->limit(20)
        ->get();

        return $doctors;

    }
}
