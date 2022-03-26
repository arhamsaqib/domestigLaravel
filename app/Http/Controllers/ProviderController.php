<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Providers;
use App\Models\ProviderReviews;

class ProviderController extends Controller
{
    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required',
            'country' => 'required',
            'location' => 'sometimes',
            'avatar' => 'sometimes',
            'longitude' => 'sometimes',
            'latitude' => 'sometimes',
            'fuid' => 'required',
            'status' =>'required'
        ]);
        $collection = collect($data)->filter()->all();
        $new = Providers::create($collection);
        return $new;
    }
    public function update($id,Request $request){
        $data = $request->validate([
            'phone' => 'sometimes',
            'country' => 'sometimes',
            'location' => 'sometimes',
            'avatar' => 'sometimes',
            'longitude' => 'sometimes',
            'latitude' => 'sometimes',
            'working_status' => 'sometimes',
        ]);
        $provider = Providers::whereId($id)->first();
        $collection = collect($data)->filter()->all();
        $new = $provider->update($collection);
        return $new;
    }
    public function show($id){

        //$user = User::find($id);
        $user = Providers::whereFuid($id)->first();
        if(isset($user)){
            return $user;
        }
    
        return response()->json([
            'message' => 'Record not found.'
        ], 404);
    }
    public function index(){
        $user = Providers::all();
        return $user;
    }
    public function destroy($id){
        $user = Providers::where('id', $id)->delete();
        return $user;
    }
    public function getProviderById($id){

        //$user = User::find($id);
        $user = Providers::whereId($id)->first();
        if(isset($user)){
            $rating = ProviderReviews::whereProvider_id($id)->avg('stars');
            $c = collect($user);
            $c->put('rating', $rating);
            return $c->all();
        }
    
        return response()->json([
            'message' => 'Record not found.'
        ], 404);
    }
}
