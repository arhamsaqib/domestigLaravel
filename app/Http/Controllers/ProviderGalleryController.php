<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProviderGallery;

class ProviderGalleryController extends Controller
{
    public function store(Request $request){
        $data = $request->validate([
            'image' => 'required',
            'provider_id' => 'required',
        ]);
        
        $collection = collect($data)->filter()->all();
        $new = ProviderGallery::create($collection);
        return $new;
     
    }
    public function show($id){

        $user = ProviderGallery::whereId($id)->first();
        if(isset($user)){
            return $user;
        }
    
        return response()->json([
            'message' => 'Record not found.'
        ], 404);
    }
    public function index(){
        $user = ProviderGallery::all();
        return $user;
    }
    public function destroy($id){
        $user = ProviderGallery::where('id', $id)->delete();
        return $user;
    }
}
