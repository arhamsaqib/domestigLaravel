<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string',
            'country' => 'required|string',
            'location' => 'sometimes|string',
            'avatar' => 'sometimes|string',
            'longitude' => 'sometimes|string',
            'latitude' => 'sometimes|string',
            'fuid' => 'required|string',
        ]);

        $new= Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'country' => $request->country,
            'location' => $request->location,
            'avatar' => $request->avatar,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
            'fuid' => $request->fuid,
            'status' => 'active',
        ]);
        return $new;
    }
    public function show($id){

        //$user = User::find($id);
        $user = Customer::whereId($id)->first();
        if(isset($user)){
            return $user;
        }
    
        return response()->json([
            'message' => 'Record not found.'
        ], 404);
    }
    public function index(){
        $user = Customer::all();
        return $user;
    }
    public function destroy($id){
        $user = Customer::where('id', $id)->delete();
        return $user;
    }
}
