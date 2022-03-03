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
            'time_taken' => 'required',
            'before_work_image' => 'required',
            'after_work_image' => 'required',
        ]);
        
        $collection = collect($data)->filter()->all();
        $new = BookingSubmission::create($collection);
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
    public function index(){
        $user = BookingSubmission::all();
        return $user;
    }
    public function destroy($id){
        $user = BookingSubmission::where('id', $id)->delete();
        return $user;
    }
}
