<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admins;

class AdminController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string',
            'country' => 'required|string',
            'user_role' => 'required|string',
            'avatar' => 'sometimes|string',
        ]);

        $new= Admins::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'country' => $request->country,
            'user_role' => $request->user_role,
            'avatar' => $request->avatar,
            'status' => 'active',
        ]);
        return $new;
    }
    public function show($id){

        //$user = User::find($id);
        $user = Admins::whereId($id)->first();
        if(isset($user)){
            return $user;
        }
    
        return response()->json([
            'message' => 'Record not found.'
        ], 404);
    }
    public function index(){
        $user = Admins::all();
        return $user;
    }
    public function destroy($id){
        $user = Admins::where('id', $id)->delete();
        return $user;
    }
}
