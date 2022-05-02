<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserReferrals;

class UserReferralController extends Controller
{
    public function store(Request $request){
        $data = $request->validate([
            'uid' => 'required',
            'user_type' => 'required',
            'name' => 'required'
        ]);
        
        $numcode = strval($this->generateRandomNumber());
        $initial="DO";
        $end= strtoupper(substr($request->user_type, 0, 1));
        $name = strtoupper(substr($request->name, 0, 2));
        $code = $initial.$name.$numcode.$end;
        $c = UserReferrals::create([
            'uid' =>$request->uid,
            'user_type' => $request->user_type,
            'code' => $code,
            'numcode' => $numcode,
        ]);

        return $c;
    }
    public function show($id){
        return 'show';
        $user = UserReferrals::whereCode($id)->first();
        if(isset($user)){
            return $user;
        }
        return response()->json([
            'message' => 'Record not found.'
        ], 404);
    }

    public function findUserReferral(Request $request){
        $data = $request->validate([
            'uid' => 'required',
            'user_type' => 'required',
        ]);
        $res = UserReferrals::where($data)->first();
        if(isset($res)){
            return $res;
        }
        return response()->json([
            'message' => 'Record not found.'
        ], 404);
    }

    public function index(){
        $user = UserReferrals::all();
        return $user;
    }
    public function destroy($id){
        $user = UserReferrals::where('id', $id)->delete();
        return $user;
    }

    function generateRandomNumber() {
        $number = mt_rand(100000, 999999);
        if ($this->nameExists($number)) {
            return $this->generateRandomNumber();
        }
        return $number;
    }
    function nameExists($number) {
        return UserReferrals::whereNumcode($number)->exists();
    }

}
