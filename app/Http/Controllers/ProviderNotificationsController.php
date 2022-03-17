<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProviderNotifications;

class ProviderNotificationsController extends Controller
{
    public function store(Request $request){
        $data = $request->validate([
            'provider_id' => 'required',
            'customer_id' => 'sometimes',
            'booking_id' => 'sometimes',
            'category' => 'sometimes',
            'description' => 'required',
            'status' => 'sometimes',
        ]);

        $collection = collect($data)->filter()->all();
        $new = ProviderNotifications::create($collection);
        return $new;
        //return $new;
    }
    public function show($id){

        $user = ProviderNotifications::whereProvider_id($id)->latest()->get();
        if(isset($user)){
            return $user;
        }
    
        return response()->json([
            'message' => 'Record not found.'
        ], 404);
    }
    public function index(){
        $user = ProviderNotifications::all();
        return $user;
    }
    public function destroy($id){
        $user = ProviderNotifications::where('id', $id)->delete();
        return $user;
    }
}
