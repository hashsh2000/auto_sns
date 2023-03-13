<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Billing;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = Auth::id();


        $payment_notice = '';
        $from = date('Y-m-01');
        $to   = date('Y-m-t');

        $is_paid_user = Billing::where('user_id',$user_id)
        ->where('status',1)
        ->whereBetween('billing_date', [$from, $to])
        ->first();

        if(!$is_paid_user){
            $payment_notice = "・今月分の支払いがされておりません。\n 月末時点で未払いの場合はシステムが停止します。";
        }

        // var_dump($payment_notice);
        return view('home', [
            'payment_notice' => $payment_notice,
        ]);
    }
}
