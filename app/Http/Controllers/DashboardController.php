<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryServices;
use App\Models\Bookings;
use App\Models\Providers;
use App\Models\Customer;


class DashboardController extends Controller
{
    public function index(){
        $services= CategoryServices::count();
        $providers = Providers::count();
        $customers = Customer::count();
        $cancelled = Bookings::whereStatus('cancelled')->count();
        $completed = Bookings::whereStatus('completed')->count();
        $totalEarnings = 0;
        $payable = 0;
        $profile = 0;
        $cashEarning = 0;
        $onlineEarning = 0;

        $ret = [
            'totalServices' => $services,
            'workers' => $providers,
            'customers' => $customers,
            'totalServices' => $services,
            'cancelledServices' => $cancelled,
            'completedServices' => $completed,
            'totalEarnings' => $totalEarnings,
            'payable' => $payable,
            'profile' => $profile,
            'cashEarning' => $cashEarning,
            'onlineEarning' => $onlineEarning,
        ];

        return $ret;
    }
}
