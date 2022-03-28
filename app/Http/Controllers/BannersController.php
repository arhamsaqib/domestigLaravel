<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banners;

class BannersController extends Controller
{
    public function store(Request $request){
        $data = $request->validate([
            'expiry' => 'sometimes',
            'description' => 'required',
            'avatar' => 'sometimes',
            'code' => 'required',
        ]);
        
        $collection = collect($data)->filter()->all();
        $new = Banners::create($collection);
        return $new;
     
    }
    public function show($id){

        $user = Banners::whereCode($id)->first();
        if(isset($user)){
            return $user;
        }
    
        return response()->json([
            'message' => 'Record not found.'
        ], 404);
    }
    public function index(){
        $user = Banners::all();
        return $user;
    }
    public function destroy($id){
        $user = Banners::where('id', $id)->delete();
        return $user;
    }
}
