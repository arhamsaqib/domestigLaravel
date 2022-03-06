<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bookings;
use App\Models\BookingRequests;
use Illuminate\Support\Facades\DB;

class ProviderIncomingRequestsController extends Controller
{
    public function getProviderIncomingRequests($id){
                $all =  DB::table('booking_requests')->where([
                        ['booking_requests.provider_id' , '=' , $id],
                        ['booking_requests.status' , '=' , 'pending']
                        ])
                ->join('bookings','booking_requests.booking_id','=','bookings.id')
                ->select('bookings.id as booking_id','booking_requests.provider_id','bookings.services as bookingServices',
                         'bookings.date','bookings.time', 'bookings.category_name', 'bookings.customer_id', 'bookings.location', 'bookings.verification_code' , 'booking_requests.status as bookingStatus' ,'bookings.instructions as instructions')
                ->get();
        return $all;
    }

    public function onRejectRequest(Request $request){
        $request->validate([
            'provider_id' => 'required',
            'booking_id' => 'required',
        ]);
        $providerId = $request->provider_id;
        $bookingId = $request->booking_id;
        $reject = BookingRequests::where(['provider_id'=>$providerId,'booking_id'=>$bookingId])->update(['status'=>'rejected']);
        return $reject;
    }
    
    public function onAcceptRequest(Request $request){
        $request->validate([
            'provider_id' => 'required',
            'booking_id' => 'required',
        ]);
        $providerId = $request->provider_id;
        $bookingId = $request->booking_id;
        
        $nullOthers = BookingRequests::where(['booking_id'=>$bookingId])->update(['status'=>'closed']);
        $accept = BookingRequests::where(['provider_id'=>$providerId,'booking_id'=>$bookingId])->update(['status'=>'accepted']);
        $acceptBooking = Bookings::where(['id'=>$bookingId])->update(['status'=>'in-progress','provider_id'=>$providerId]);
        return $reject;
    }
}
