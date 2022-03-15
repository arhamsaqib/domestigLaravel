<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerReviews;

class CustomerReviewsController extends Controller
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
        $new = CustomerReviews::create($collection);
        return $new;
        //return $new;
    }
    public function show($id){

        //$user = User::find($id);
        $user = CustomerReviews::whereCustomer_id($id)
                ->join('providers','providers.id','=','customer_reviews.provider_id')
                ->select('providers.name as provider_name','providers.avatar as provider_avatar','customer_reviews.provider_id','customer_reviews.customer_id',
                            'customer_reviews.review','customer_reviews.stars','customer_reviews.booking_id','customer_reviews.created_at')
                ->get();
        if(isset($user)){
            return $user;
        }
    
        return response()->json([
            'message' => 'Record not found.'
        ], 404);
    }
    public function index(){
        $user = CustomerReviews::all();
        return $user;
    }
    public function destroy($id){
        $user = CustomerReviews::where('id', $id)->delete();
        return $user;
    }
}
