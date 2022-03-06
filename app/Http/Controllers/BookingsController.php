<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bookings;



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
            'instructions' => 'sometimes',
            'instructions_image' => 'sometimes',
            'latitude' => 'sometimes',
            'longitude' => 'sometimes',
            'location' => 'sometimes',
            'status' => 'sometimes|string',
        ]);
        
        $collection = collect($data)->filter()->all();
        $new = Bookings::create($collection);
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
