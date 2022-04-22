<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bookings;
use App\Events\CustomerBookingUpdate;

class CustomerActiveBookingController extends Controller
{
    
    public function store(Request $request){
        $data = $request->validate([
            'customer_id' => 'required|max:255',
            'status' => 'sometimes|string',
        ]);
        
        $collection = collect($data)->filter()->all();
        $new = Bookings::where($collection)->first();

        if(isset($new))
        {
            return $new;
        }

        return response()->json([
            'message' => 'No active bookings found.'
        ], 404);
        
    }
    public function update($bookingId,Request $request){
        $data = $request->validate([
            'status' => 'sometimes',
        ]);
 
        $booking = Bookings::where(['id'=>$bookingId])->first();
         
         $collection = collect($data)->filter()->all();
 
         $new = $booking->update($collection);
         return $new;
      
     }
    public function show($id){

        $user = Bookings::where(['cutomer_id'=>$id,'status'=>'pending'])->get();
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

        return $arr;
    }
    public function destroy($id){
        $user = Bookings::where('id', $id)->delete();
        return $user;
    }
}
