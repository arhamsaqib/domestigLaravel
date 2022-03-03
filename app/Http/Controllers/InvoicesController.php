<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoices;

class InvoicesController extends Controller
{
    public function store(Request $request){
        $data = $request->validate([
            'booking_id' => 'required',
            'provider_id' => 'required',
            'customer_id' => 'required',
            'extra_work' => 'sometimes',
            'extra_work_charges' => 'sometimes',
            'amount' => 'required',
            'total_amount' => 'sometimes',
        ]);
        
        $collection = collect($data)->filter()->all();
        $new = Invoices::create($collection);
        return $new;
     
    }
    public function show($id){

        $user = Invoices::whereId($id)->first();
        if(isset($user)){
            return $user;
        }
    
        return response()->json([
            'message' => 'Record not found.'
        ], 404);
    }
    public function index(){
        $user = Invoices::all();
        return $user;
    }
    public function destroy($id){
        $user = Invoices::where('id', $id)->delete();
        return $user;
    }
}
