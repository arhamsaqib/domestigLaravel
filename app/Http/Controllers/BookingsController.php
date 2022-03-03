<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bookings;



class BookingsController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'customer_id' => 'required|string|max:255',
            'provider_id' => 'required|string|max:255',
            'schedule' => 'required|string',
            'date' => 'sometimes|string',
            'time' => 'sometimes|string',
            'payment_type' => 'sometimes|string',
            'instructions' => 'sometimes|string',
            'instructions_image' => 'sometimes|string',
            'latitude' => 'sometimes|string',
            'longitude' => 'sometimes|string',
            'location' => 'sometimes|string',
            'status' => 'sometimes|string',
        ]);

        $new= Bookings::create([
            'customer_id' => $request->customer_id,
            'provider_id' => $request->provider_id,
            'schedule' => $request->schedule,
            'date' => $request->date,
            'time' => $request->time,
            'payment_type' => $request->payment_type,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
            'location' => $request->location,
            'instructions' => $request->instructions,
            'instructions_image' => $request->instructions_image,
            //'status' => 'active',
        ]);
        return $new;
    }
    public function show($id){

        $user = Bookings::whereId($id)->first();
        if(isset($user)){
            return $user;
        }
    
        return response()->json([
            'message' => 'Record not found.'
        ], 404);
    }
    public function index(){
        $user = Bookings::all();
        return $user;
    }
    public function destroy($id){
        $user = Bookings::where('id', $id)->delete();
        return $user;
    }
}
