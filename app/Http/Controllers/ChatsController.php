<?php

namespace App\Http\Controllers;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Providers;
use App\Models\Customer;

class ChatsController extends Controller
{

    public function __construct()
    {
    //$this->middleware('auth');
    }

    public function index()
    {
        return view('chat');
    }

    public function fetchMessages()
    {
        return Message::with('user')->get();
    }

    public function sendMessage(Request $request)
    {
        $data = $request->validate([
            'message' => 'required',
            'provider_id' => 'required',
            'booking_id' => 'required',
            'customer_id' => 'required',
            'sent_by' => 'required',
        ]);

        $collection = collect($data)->filter()->all();
        $new = Message::create($collection);
        return $new;
        
        //return ['status' => 'Message Sent!'];
    }
}

