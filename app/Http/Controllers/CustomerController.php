<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required',
            'country' => 'sometimes',
            'location' => 'sometimes',
            'avatar' => 'sometimes',
            'longitude' => 'sometimes',
            'latitude' => 'sometimes',
            'fuid' => 'required',
            'status' => 'required'
        ]);

        // $new= Customer::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'phone' => $request->phone,
        //     'country' => $request->country,
        //     'location' => $request->location,
        //     'avatar' => $request->avatar,
        //     'longitude' => $request->longitude,
        //     'latitude' => $request->latitude,
        //     'fuid' => $request->fuid,
        //     'status' => 'active',
        // ]);
        $collection = collect($data)->filter()->all();
        $new = Customer::create($collection);
        return $new;
        //return $new;
    }
    public function show($id){

        //$user = User::find($id);
        $user = Customer::whereFuid($id)->first();
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

    public function getCustomerById($id){

        //$user = User::find($id);
        $user = Customer::whereId($id)->first();
        if(isset($user)){
            return $user;
        }
    
        return response()->json([
            'message' => 'Record not found.'
        ], 404);
    }
}
