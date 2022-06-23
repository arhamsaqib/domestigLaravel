<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentHistory;

class PaymentHistoryController extends Controller
{
    public function store(Request $request){
        $data = $request->validate([
            'customer_id' => 'required',
            'provider_id' => 'required',
            'booking_id' => 'required',
            'invoice_id' => 'sometimes',
            'amount' => 'sometimes',
            'status' => 'sometimes',
        ]);
        
        $collection = collect($data)->filter()->all();
        $new = PaymentHistory::create($collection);
        return $new;
     
    }
    public function update($bookingId, Request $request){
        $data = $request->validate([
            'customer_id' => 'sometimes',
            'provider_id' => 'sometimes',
            'booking_id' => 'sometimes',
            'invoice_id' => 'sometimes',
            'amount' => 'sometimes',
            'status' => 'sometimes',
        ]);
        
        $booking = PaymentHistory::where(['booking_id'=>$bookingId])->first();
         
         $collection = collect($data)->filter()->all();
 
         $new = $booking->update($collection);
         return $new;
     
    }
    public function show($id){

        //$user = PaymentHistory::whereBooking_id($id)->first();
        $user = PaymentHistory::where(['customer_id'=>$id,'status'=>'pending'])->first();
        if(isset($user)){
            return $user;
        }
    
        return response()->json([
            'message' => 'Record not found.'
        ], 404);
    }
    public function index(){
        return response()->json([
            'message' => 'Method not allowed.'
        ], 403);
    }
    public function destroy($id){
        return response()->json([
            'message' => 'Method not allowed.'
        ], 403);
    }
}
