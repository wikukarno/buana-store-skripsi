<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Models\User;
use App\Models\UserDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardCustomerController extends Controller
{
    public function index()
    {
        // $detail = UserDetails::where('status', 'PENDING', Auth::user()->users_id)->find();
        $item = User::all();
        $customer = User::where('status', 'PENDING', Auth::user()->id)->get()->take(1);
        return view('pages.member.dashboard', [
            'customers' => $customer,
            'item' => $item
            // 'detail' => UserDetails::where('status', 'PENDING', Auth::user()->users_id)->get()
        ]);
    }
}
