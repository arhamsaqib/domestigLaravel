<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProviderServices;

class ProviderServicesController extends Controller
{
    public function store(Request $request){
        $data = $request->validate([
            'provider_id' => 'required',
            'category_name' => 'sometimes',
            'services' => 'required',
            'status' => 'sometimes',
            'rate' => 'sometimes',
    
        ]);
        $collection = collect($data)->filter()->all();
        $new = ProviderServices::create($collection);
        return $new;
    }
    public function update($id,Request $request){
        // $data = $request->validate([
        //     'phone' => 'sometimes',
        //     'country' => 'sometimes',
        //     'location' => 'sometimes',
        //     'avatar' => 'sometimes',
        //     'longitude' => 'sometimes',
        //     'latitude' => 'sometimes',
        //     'working_status' => 'sometimes',
        // ]);
        // $provider = Providers::whereId($id)->first();
        // $collection = collect($data)->filter()->all();
        // $new = $provider->update($collection);
        // return $new;
    }
    public function show($id){

        //$user = User::find($id);
        $user = ProviderServices::whereProvider_id($id)->first();
        if(isset($user)){
            return $user;
        }
    
        return response()->json([
            'message' => 'Record not found.'
        ], 404);
    }
    public function showProviderServicesByCategory(Request $request){

        $data = $request->validate([
            'provider_id' => 'required',
            'category_name' => 'sometimes',
        ]);

        $user = ProviderServices::where(['provider_id'=>$request->provider_id,'category_name'=>$request->category_name])->first();
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
}
