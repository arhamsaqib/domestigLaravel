<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bookings;
use App\Models\Providers;
use App\Models\ProviderReviews;
use App\Models\ProviderServices;

class RecommendedServicesController extends Controller
{
    public function store(Request $request){
        $latitude = $request->lat;
        $longitude = $request->lng;
        $radius = 500;
        //return $request;
        $bookings = Bookings::
        selectRaw("id, latitude, longitude, services, category_name, location, provider_id,
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
        foreach ($bookings as $b) {
          $provider = Providers::whereId($b->provider_id)->first();
          $review = ProviderReviews::whereBooking_id($b->id)->first();
          $ser = ProviderServices::whereCategory_name($b->category_name)->first();
          if(isset($review) && isset($provider) && isset($ser)){
                $arr[] = [
                    'booking' => $b,
                    'review' => $review,
                    'provider' => $provider,
                    'services' => $ser
                ];
             }
        }
        return $arr;
        // //added latest (find by services). Comment the code below to troubleshoot
        // $fin = [];
        // foreach ($arr as $p) {
        //   $ser = ProviderServices::where(['category_name'=>$category,'provider_id'=>$p['id']])->first();
        //   if(isset($ser)){
        //       $containsAllValues = !array_diff($services, $ser->services);

        //       if($containsAllValues==true){
        //         $c = collect($p);
        //         $c->put('rate',$ser->rate);
        //         $fin[] = $c->all();
        //       }
        //   }
        // }

        // return $fin;

    }
}
