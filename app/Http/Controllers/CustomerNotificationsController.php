<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerNotifications;

class CustomerNotificationsController extends Controller
{
    public function store(Request $request){
        $data = $request->validate([
            'provider_id' => 'sometimes',
            'customer_id' => 'required',
            'booking_id' => 'sometimes',
            'category' => 'sometimes',
            'description' => 'required',
            'status' => 'sometimes',
        ]);

        $collection = collect($data)->filter()->all();
        $new = CustomerNotifications::create($collection);
        return $new;
        //return $new;
    }
    public function show($id){

        $user = CustomerNotifications::whereCustomer_id($id)->latest()->get();
        if(isset($user)){
            return $user;
        }
    
        return response()->json([
            'message' => 'Record not found.'
        ], 404);
    }
    public function update($id,Request $request){
        $data = $request->validate([
            'provider_id' => 'sometimes',
            'customer_id' => 'sometimes',
            'booking_id' => 'sometimes',
            'category' => 'sometimes',
            'description' => 'sometimes',
            'status' => 'sometimes',
        ]);
        $n = CustomerNotifications::whereId($id)->first();
        $collection = collect($data)->filter()->all();
        $new = $n->update($collection);
        return $new;
        //return $new;
    }
    public function index(){
        $user = CustomerNotifications::all();
        return $user;
    }
    public function destroy($id){
        $user = CustomerNotifications::where('id', $id)->delete();
        return $user;
    }
}
