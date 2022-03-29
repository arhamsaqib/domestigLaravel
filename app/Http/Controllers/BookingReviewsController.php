<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerReviews;
use App\Models\ProviderReviews;
use App\Models\Bookings;

class BookingReviewsController extends Controller
{
    public function show($id){

        $booking = Bookings::whereId($id)->first();
        if(isset($booking)){
            $pid = $booking->provider_id;
            $cid = $booking->customer_id;

            $cust = CustomerReviews::where(['customer_id'=>$cid,'booking_id'=>$id])
            ->join('providers','providers.id','=','customer_reviews.provider_id')
            ->select('providers.name as provider_name','providers.avatar as provider_avatar','customer_reviews.provider_id','customer_reviews.customer_id',
                        'customer_reviews.review','customer_reviews.stars','customer_reviews.booking_id','customer_reviews.created_at')
            ->first();

            $prov = ProviderReviews::where(['provider_id'=>$pid,'booking_id'=>$id])
            ->join('customers','customers.id','=','provider_reviews.customer_id')
            ->select('customers.name as customer_name','customers.avatar as customer_avatar','provider_reviews.customer_id','provider_reviews.provider_id',
                        'provider_reviews.review','provider_reviews.stars','provider_reviews.booking_id','provider_reviews.created_at')
            ->first();

            if(!isset($prov) && !isset($cust)){
                return response()->json([
                    'message' => 'Record not found.'
                ], 404);
            }
            if(isset($prov) && !isset($cust)){
                $r=[
                    'customer_avatar'    => $prov->customer_avatar,
                    'customer_name'      => $prov->customer_name,
                    'customer_id'        => $booking->customer_id,
                    'provider_id'        => $booking->provider_id,
                    'booking_id'         => $booking->id,
                    'review_to_provider' => $prov->review,
                    'provider_stars'     => $prov->stars,
                ];
                return $r;
            }
            if(!isset($prov) && isset($cust)){
                $r=[
            
                    'customer_id'        => $booking->customer_id,
                    'provider_id'        => $booking->provider_id,
                    'booking_id'         => $booking->id,
                    'provider_avatar'    => $cust->provider_avatar,
                    'review_to_customer' => $cust->review,
                    'provider_name'      => $cust->provider_name,
                    'customer_stars'     => $cust->stars,
                ];
                return $r;
            }
           
            $rev = [
                'review_to_customer' => $cust->review,
                'review_to_provider' => $prov->review,
                'provider_avatar'    => $cust->provider_avatar,
                'customer_avatar'    => $prov->customer_avatar,
                'customer_name'      => $prov->customer_name,
                'provider_name'      => $cust->provider_name,
                'customer_id'        => $booking->customer_id,
                'provider_id'        => $booking->provider_id,
                'booking_id'         => $booking->id,
                'customer_stars'     => $cust->stars,
                'provider_stars'     => $prov->stars,
            ];

            return $rev;
        }
       
        return response()->json([
            'message' => 'Record not found.'
        ], 404);
    }
    public function index(){
        $user = CustomerReviews::all();
        return $user;
    }
    public function destroy($id){
        $user = CustomerReviews::where('id', $id)->delete();
        return $user;
    }
}
