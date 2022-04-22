<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bookings;
use App\Models\Providers;
use App\Models\Customer;
use App\Events\CustomerBookingUpdate;



class BookingsController extends Controller
{
    public function store(Request $request){
        $data = $request->validate([
            'customer_id' => 'required|max:255',
            'provider_id' => 'sometimes|max:255',
            'schedule' => 'required',
            'date' => 'sometimes',
            'time' => 'sometimes',
            'payment_type' => 'sometimes',
            'services' => 'required',
            'category_name' => 'sometimes',
            'verified' => 'sometimes',
            'verification_code' => 'required',
            'instructions' => 'sometimes',
            'instructions_image' => 'sometimes',
            'latitude' => 'sometimes',
            'longitude' => 'sometimes',
            'services' => 'sometimes',
            'location' => 'sometimes',
            'status' => 'sometimes|string',
            'coupon' => 'sometimes',
            'rate' => 'sometimes|string',
        ]);
        
        $collection = collect($data)->filter()->all();
        $new = Bookings::create($collection);
        return $new;
     
    }
    public function update($bookingId,Request $request){
        $data = $request->validate([
            'provider_id' => 'sometimes',
            'verified' => 'sometimes',
            'instructions' => 'sometimes',
            'instructions_image' => 'sometimes',
            'latitude' => 'sometimes',
            'longitude' => 'sometimes',
            'services' => 'sometimes',
            'location' => 'sometimes',
            'status' => 'sometimes',
        ]);
 
        $booking = Bookings::where(['id'=>$bookingId])->first();
         
         $collection = collect($data)->filter()->all();
 
         $new = $booking->update($collection);
         return $new;
      
     }
    public function show($id){

        $user = Bookings::whereCustomer_id($id)->get();
        if(isset($user)){
            return $user;
        }
    
        return response()->json([
            'message' => 'Record not found.'
        ], 404);
    }
    public function providerBookings($id){

        $user = Bookings::whereProvider_id($id)->get();
        if(isset($user)){
            return $user;
        }
    
        return response()->json([
            'message' => 'Record not found.'
        ], 404);
    }
    public function index(){
        $bkn = Bookings::all();
        $arr = [];
        foreach ($bkn as $b) {
            $p = Providers::whereId($b->provider_id)->first();
            $c = Customer::whereId($b->customer_id)->first();
            $arr[] = [
                'bookingInfo' => $b,
                'providerInfo' => $p,
                'customerInfo' => $c,
            ];
        }
        //  $a= 1;
        // $b = 'as';
        // $c = 'asd'.$b;
        // $c = $a.$b.$c;
        // $data = [
        //     'refresh' => 'true'
        // ];
        // event(new CustomerBookingUpdate($c,$data));
        return $arr;
    }
    public function destroy($id){
        $user = Bookings::where('id', $id)->delete();
        return $user;
    }
}
