<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Providers;
use App\Models\ProviderReviews;
use App\Models\ProviderServices;

class FindProviderByLocationController extends Controller
{
    public function store(Request $request){
        $latitude = $request->lat;
        $longitude = $request->lng;
        $services  = $request->services;
        $category  = $request->category;
        $radius = 500;
        //return $request;
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

        //added latest (find by services). Comment the code below to troubleshoot
        $fin = [];
        foreach ($arr as $p) {
          $ser = ProviderServices::where(['category_name'=>$category,'provider_id'=>$p['id']])->first();
          if(isset($ser)){
              $containsAllValues = !array_diff($services, $ser->services);

              if($containsAllValues==true){
                $c = collect($p);
                $c->put('rate',$ser->rate);
                $fin[] = $c->all();
              }
          }
        }

        return $fin;

    }
}
