<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Providers;
use App\Models\ProviderReviews;

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
        
        $arr = [];
        foreach ($doctors as $p) {
          $rating = ProviderReviews::whereProvider_id($p->id)->avg('stars');
          $c = collect($p);
          $c->put('rating', $rating);
          $arr[] = $c->all();
        }

        return $arr;

    }
}
