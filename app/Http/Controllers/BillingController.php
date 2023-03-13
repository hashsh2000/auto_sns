<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Billing;

class BillingController extends Controller
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
     * 作成画面
     * @return mixed
     */
    public function index(Request $request)
    {
        if(Auth::id() != 1){
            return redirect(route('home'));
        }

        $years  = [2023,2024,2025];
        $months = [1,2,3,4,5,6,7,8,9,10,11,12];

        $selected_year   = isset($request->selected_year)  ? $request->selected_year  : date('Y');
        $selected_month  = isset($request->selected_month) ? $request->selected_month : date('m');

        $from = $selected_year.'-'.$selected_month.'-01';
        $to = $selected_year.'-'.$selected_month.'-31';

        $users  = User::all();
        $paid_users = Billing::whereBetween('billing_date', [$from,$to])->get();

        $paid_list = [];

        foreach($paid_users as $paid){
            $paid_list[] = $paid->user_id;
        }

        return view('billing/index',[
            'users'          => $users,
            'paid_list'      => $paid_list,
            'years'          => $years,
            'months'         => $months,
            'selected_year'  => $selected_year,
            'selected_month' => $selected_month,
        ]);
    }

    /**
     * 作成処理
     * @return mixed
     */
    public function form_create(Request $request)
    {
        if(Auth::id() != 1){
            return redirect(route('home'));
        }
        // 日付け管理
        if(date('Y') == $request->year  && date('m') == $request->month){
            $date = date('Y-m-d');
        }else{
            $date = $request->year.'-'.$request->month.'-01';
        }

        Billing::create([
            'user_id'       => $request->user_id,
            'billing_date'  => $date,
            'status'        => 1
        ]);

        return redirect(route('billing.index'));
    }
}
