<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServicesController extends Controller
{
    public function store(Request $request){      
   
        return response()->json([
            'message' => 'METHOD NOT ALLOWED.'
        ], 403);
     
    }
    public function show($id){

        $user = DB::table('category_services')->whereId($id)->first();
        if(isset($user)){
            return $user;
        }
    
        return response()->json([
            'message' => 'Record not found.'
        ], 404);
    }
    public function index(){
        $user = DB::table('category_services')->get();
        return $user;
    }
    public function destroy($id){
        $user = DB::table('category_services')->whereId($id)->delete();
        return $user;
    }
}
