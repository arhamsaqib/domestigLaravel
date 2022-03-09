<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookingSubmission;


class BookingSubmissionController extends Controller
{
    public function store(Request $request){
        $data = $request->validate([
            'booking_id' => 'required',
            'provider_id' => 'required',
            'time_taken' => 'sometimes',
            'before_work_image' => 'sometimes',
            'after_work_image' => 'sometimes',
        ]);
        
        $collection = collect($data)->filter()->all();
        $new = BookingSubmission::create($collection);
        return $new;
     
    }
    public function update($bookingId,Request $request){
       // return 'update time';
        $data = $request->validate([
            'booking_id' => 'required',
            'provider_id' => 'required',
            'time_taken' => 'sometimes',
            'before_work_image' => 'sometimes',
            'after_work_image' => 'sometimes',
        ]);

        $booking = BookingSubmission::where(['booking_id'=>$bookingId,'provider_id'=>$request->provider_id])->first();
        
        $collection = collect($data)->filter()->all();

        $new = $booking->update($collection);
        return $new;
     
    }
    public function show($id){

        $user = BookingSubmission::whereId($id)->first();
        if(isset($user)){
            return $user;
        }
    
        return response()->json([
            'message' => 'Record not found.'
        ], 404);
    }
    public function showSubmission(Request $request){
        $providerId = $request->provider_id;
        $bookingId = $request->booking_id;
        $user = BookingSubmission::where(['provider_id'=>$providerId,'booking_id'=>$bookingId])->first();
        if(isset($user)){
            return $user;
        }
    
        return response()->json([
            'message' => 'Record not found.'
        ], 404);
    }
    public function index(){
        $user = BookingSubmission::all();
        return $user;
    }
    public function destroy($id){
        $user = BookingSubmission::where('id', $id)->delete();
        return $user;
    }
}
