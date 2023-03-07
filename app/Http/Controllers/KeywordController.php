<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keywords;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KeywordController extends Controller
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
     * 一覧画面
     * @param  integer $user_id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($user_id)
    {
        $user_id = Auth::id();

        $keyword_list = Keywords::leftJoin('dm_text', 'keyword.id', '=', 'dm_text.keyword_id')
           ->select(DB::raw('MAX(dm_text.active_flg) as active_flg, keyword.*'))
           ->where('keyword.user_id', $user_id)
           ->groupBy('keyword.id')
           ->orderBy('active_flg', 'desc')
           ->orderBy('keyword.title', 'asc')
           ->get();

        return view('keyword/index',['keyword_list' => $keyword_list]);
    }

    /**
     * 作成画面
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        $action = 'create';

        return view('keyword/form',['action' => $action]);
    }

    /**
     * 編集画面
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit($keyword_id)
    {
        $action = 'edit';
        $user_id = Auth::id();

        $keyword_data = Keywords::leftJoin('dm_text', 'keyword.id', '=', 'dm_text.keyword_id')
           ->select(DB::raw('dm_text.active_flg as active_flg, keyword.*'))
           ->where('keyword.id', $keyword_id)
           ->orderBy('dm_text.active_flg', 'desc')
           ->first();

        if($keyword_data['user_id'] != $user_id){
            return redirect(route('keyword.index', ['user_id' => $user_id]));
        }
        
        return view('keyword/form',['keyword_data' => $keyword_data, 'action' => $action]);
    }


    /**
     * 作成処理
     * @return redirect
     */
    public function form_create(Request $request)
    {
        $user_id = Auth::id();

        Keywords::create([
            'user_id'       => $user_id,
            'title'         => $request->title,
            'keyword'    => $request->keyword,
        ]);

        return redirect(route('keyword.index', ['user_id' => $user_id]));
    }
    /**
     * 編集処理
     * @return redirect
     */
    public function form_edit(Request $request,$keyword_id)
    {
        $user_id = Auth::id();

        $keyword_data = Keywords::find($keyword_id);

        if($keyword_data){
            // 更新処理
            if($request->save){
                $keyword_data->title         = $request->title;
                $keyword_data->keyword       = $request->keyword;
                $keyword_data->save();
            }
            // 削除処理
            else if($request->delete){
                $keyword_data->delete();
            }
        } 

        return redirect(route('keyword.index', ['user_id' => $user_id]));
    }
}
