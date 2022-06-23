<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CardStatus;

class CardStatusController extends Controller
{
    public function store(Request $request){
        $data = $request->validate([
            'user_type' => 'required',
            'user_id' => 'required',
            'status' => 'required',
        ]);
        
        $new = CardStatus::updateorCreate([
            'user_id' => $data['user_id'],
            'user_type' => $data['user_type'],
        ],[
            'status' => $data['status']
        ]);
        return $new;
     
    }
    public function show($id){

        $user = CardStatus::whereUser_id($id)->first();
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
