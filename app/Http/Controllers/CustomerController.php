<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\CustomerReviews;
use App\Models\UserReferrals;

class CustomerController extends Controller
{
    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required',
            'country' => 'sometimes',
            'location' => 'sometimes',
            'avatar' => 'sometimes',
            'longitude' => 'sometimes',
            'latitude' => 'sometimes',
            'fuid' => 'required',
            'status' => 'required',
            'stripeId' => 'sometimes'
        ]);
        $collection = collect($data)->filter()->all();
        $new = Customer::create($collection);

        if(isset($new)){
            $numcode = strval($this->generateRandomNumber());
            $initial="DO";
            $end="C";
            $name = strtoupper(substr($request->name, 0, 2));
            $code = $initial.$name.$numcode.$end;
            $c = UserReferrals::create([
                'uid' => $new['id'],
                'user_type' => 'customer',
                'code' => $code,
                'numcode' => $numcode,
            ]);
        }

        return $new;
        //return $new;
    }
    public function show($id){

        //$user = User::find($id);
        $user = Customer::whereFuid($id)->first();
        if(isset($user)){
            return $user;
        }
    
        return response()->json([
            'message' => 'Record not found.'
        ], 404);
    }
    public function update($id,Request $request){
        $data = $request->validate([
            'phone' => 'sometimes',
            'country' => 'sometimes',
            'location' => 'sometimes',
            'avatar' => 'sometimes',
            'longitude' => 'sometimes',
            'latitude' => 'sometimes',
        ]);
        $customer = Customer::whereId($id)->first();
        $collection = collect($data)->filter()->all();
        $new = $customer->update($collection);
        return $new;
    }
    public function index(){
        $user = Customer::all();
        return $user;
    }
    public function destroy($id){
        $user = Customer::where('id', $id)->delete();
        return $user;
    }

    public function getCustomerById($id){

        //$user = User::find($id);
        $user = Customer::whereId($id)->first();
        if(isset($user)){
            $rating = CustomerReviews::whereCustomer_id($id)->avg('stars');
            $c = collect($user);
            $c->put('rating', $rating);
            return $c->all();
        }
    
        return response()->json([
            'message' => 'Record not found.'
        ], 404);
    }

    // *** ------------ referral section

    function generateRandomNumber() {
        $number = mt_rand(100000, 999999); // better than rand()
    
        // call the same function if the barcode exists already
        if ($this->nameExists($number)) {
            return $this->generateRandomNumber();
        }
    
        // otherwise, it's valid and can be used
        return $number;
    }
    function nameExists($number) {
        // query the database and return a boolean
        // for instance, it might look like this in Laravel
        return UserReferrals::whereNumcode($number)->exists();
    }





    // *** ------------ referral section

}
