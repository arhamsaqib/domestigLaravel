<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProviderReviews;

class ProviderReviewsController extends Controller
{
    public function store(Request $request){
        $data = $request->validate([
            'provider_id' => 'required',
            'customer_id' => 'required',
            'booking_id' => 'required',
            'review' => 'sometimes',
            'stars' => 'sometimes',
        ]);
        $collection = collect($data)->filter()->all();
        $new = ProviderReviews::create($collection);
        return $new;
        //return $new;
    }
    public function show($id){

        //$user = User::find($id);
        $user = ProviderReviews::whereProvider_id($id)->get();
        if(isset($user)){
            return $user;
        }
    
        return response()->json([
            'message' => 'Record not found.'
        ], 404);
    }
    public function index(){
        $user = ProviderReviews::all();
        return $user;
    }
    public function destroy($id){
        $user = ProviderReviews::where('id', $id)->delete();
        return $user;
    }
}
