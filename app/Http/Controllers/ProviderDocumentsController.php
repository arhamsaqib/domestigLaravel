<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProviderDocuments;

class ProviderDocumentsController extends Controller
{
    public function store(Request $request){
        $data = $request->validate([
            'image' => 'required',
            'provider_id' => 'required',
            'idName' => 'required',
            'name' => 'required',
        ]);
        
        $collection = collect($data)->filter()->all();
        $new = ProviderDocuments::create($collection);
        return $new;
     
    }
    public function show($id){

        $user = ProviderDocuments::whereProvider_id($id)->get();
        if(isset($user)){
            return $user;
        }
    
        return response()->json([
            'message' => 'Record not found.'
        ], 404);
    }
    public function index(){
        $user = ProviderDocuments::all();
        return $user;
    }
    public function destroy($id){
        $user = ProviderDocuments::where('id', $id)->delete();
        return $user;
    }
}
