<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryServices;

class CategoryServiceController extends Controller
{
    public function store(Request $request){
        $data = $request->validate([
            'category_id' => 'required',
            'name' => 'sometimes',
            'status' => 'sometimes',
        ]);
        
        $collection = collect($data)->filter()->all();
        $new = CategoryServices::create($collection);
        return $new;
     
    }
    public function show($id){

        $user = CategoryServices::whereId($id)->first()
                ->join('categories','category_services.category_id','=','categories.id')
                ->where('category_services.id',$id)
                ->select('categories.name as categoryName','category_services.name as serviceName','category_services.id as serviceId','categories.id as categoryId')
                ->get();
        if(isset($user)){
            return $user;
        }
    
        return response()->json([
            'message' => 'Record not found.'
        ], 404);
    }
    public function index(){
        $user = CategoryServices::all();
        return $user;
    }
    public function destroy($id){
        $user = CategoryServices::where('id', $id)->delete();
        return $user;
    }
}
