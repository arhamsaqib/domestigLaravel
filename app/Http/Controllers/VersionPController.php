<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProviderVersion;

class VersionPController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'version' => 'required|string',
            'force' => 'required|string',
        ]);
        $new= ProviderVersion::create(
            [
            'version' => $request->version,
            'force' => $request->force,
        ]);
        return $new;
    }
    public function show($id){
        $user = ProviderVersion::all();
        return $user;
    }
    public function index(){
        $user = ProviderVersion::latest()->first();
        if(isset($user)){
            return $user;
        }
    
        return response()->json([
            'message' => 'Version history not found.'
        ], 404);
    }
    public function destroy($id){
        return response()->json([
            'message' => 'Method not allowed.'
        ], 403);
    }
}
