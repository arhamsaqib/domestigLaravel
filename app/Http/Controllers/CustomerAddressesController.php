<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerAddresses;

class CustomerAddressesController extends Controller
{
    public function store(Request $request){
        $data = $request->validate([
            'customer_id' => 'required',
            'name' => 'required',
            'location' => 'required',
            'longitude' => 'sometimes',
            'latitude' => 'sometimes',
        ]);
        $collection = collect($data)->filter()->all();
        $new = CustomerAddresses::create($collection);
        return $new;
    }
    public function update($id,Request $request){
        $data = $request->validate([
            'name' => 'required',
            'location' => 'required',
            'longitude' => 'sometimes',
            'latitude' => 'sometimes',
        ]);
        $provider = CustomerAddresses::whereId($id)->first();
        $collection = collect($data)->filter()->all();
        $new = $provider->update($collection);
        return $new;
    }
    public function show($id){

        //$user = User::find($id);
        $user = CustomerAddresses::whereCustomer_id($id)->get();
        if(isset($user)){
            return $user;
        }
    
        return response()->json([
            'message' => 'Record not found.'
        ], 404);
    }
    public function index(){
        $user = CustomerAddresses::all();
        return $user;
    }
    public function destroy($id){
        $user = CustomerAddresses::where('id', $id)->delete();
        return $user;
    }
}
