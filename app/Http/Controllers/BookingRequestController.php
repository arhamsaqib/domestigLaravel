<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookingRequests;

class BookingRequestController extends Controller
{
    public function store(Request $request){
        $data = $request->validate([
            'booking_id' => 'required',
            'provider_id' => 'required',
            'status' => 'required',
        ]);
        
        $collection = collect($data)->filter()->all();
        $new = BookingRequests::create($collection);
        return $new;
     
    }
    public function show($id){

        $user = BookingRequests::whereId($id)->first();
        if(isset($user)){
            return $user;
        }
    
        return response()->json([
            'message' => 'Record not found.'
        ], 404);
    }
    public function index(){
        $user = BookingRequests::all();
        return $user;
    }
    public function destroy($id){
        $user = BookingRequests::where('id', $id)->delete();
        return $user;
    }
}
