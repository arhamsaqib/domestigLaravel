<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use Illuminate\Support\Facades\DB;
use App\Models\CategoryServices;

class NewCategoryController extends Controller
{
    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required',
            'status' => 'required',
            'avatar' => 'sometimes',
            'admin_id' => 'sometimes',
            //"services" => 'sometimes'
        ]);
        $services = $request->services;
        $collection = collect($data)->filter()->all();
        $new = Categories::create($collection);
        foreach ($services as $ser) {   
            $added = CategoryServices::create([
                "name" => $ser["name"],
                "category_id" => $new->id,
                "status" => 'active',
            ]);
        }
        return $new;
     
    }
    public function show($id){

        $user = Categories::whereId($id)->first();
        if(isset($user)){
            return $user;
        }
    
        return response()->json([
            'message' => 'Record not found.'
        ], 404);
    }
    public function index(){
        //https://laravel.com/docs/5.1/eloquent-relationships#eager-loading refer to this
        // $cat = DB::table('categories')
        // ->leftJoin('category_services', 'categories.id', '=', 'category_services.category_id')
        // ->select('categories.id as categoryId','category_services.id as categoryServiceId','categories.name as categoryName','category_services.name as serviceName')
        // ->distinct('categories.name')
        // ->get();
        //return $cat;

        $cat = Categories::get();
        $arr = [];
        foreach ($cat as $c) {
            # code...
            $ser = DB::table('category_services')->whereCategory_id($c->id)->get();
            $arr[] = [
                'categoryName' => $c->name,
                'services' => $ser
            ];
        }
        return $arr;
    }
    public function destroy($id){
        $user = Categories::where('id', $id)->delete();
        $user1 = DB::table('category_services')->where('category_id', $id)->delete();
        return $user;
    }
}
