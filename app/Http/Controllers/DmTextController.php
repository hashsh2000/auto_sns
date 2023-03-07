<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DmTexts;
use App\Models\Keywords;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DmTextController extends Controller
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
        $dm_list = DmTexts::join('keyword', 'dm_text.keyword_id', '=', 'keyword.id')
        ->select(DB::raw(
            'keyword.title as keyword_name,
            IFNULL(keyword.deleted_at, 0) as keyword_deleted,
            dm_text.*'
            ))
        ->where('dm_text.user_id', $user_id)
        ->orderBy('dm_text.active_flg', 'desc')
        ->orderBy('dm_text.title', 'asc')
        ->get();

        return view('dm/index',['dm_list' => $dm_list]);
    }

    /**
     * 作成画面
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        // form用データ
        $action = 'create';
        $user_id = Auth::id();
        $keyword_list = Keywords::where('user_id', $user_id)->get();
        return view('dm/form',[
            'action' => $action,
            'keyword_list' => $keyword_list
        ]);
    }

    /**
     * 編集画面
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit($dm_id)
    {
        // form用データ
        $action = 'edit';
        $user_id = Auth::id();
        $keyword_list = Keywords::where('user_id', $user_id)->get();

        $dm_data = DmTexts::where('id', $dm_id)->first();

        if($dm_data['user_id'] != $user_id){
            return redirect(route('dm.index', ['user_id' => $user_id]));
        }
        
        return view('dm/form',[
            'action' => $action,
            'keyword_list' => $keyword_list,
            'dm_data' => $dm_data
        ]);
    }


    /**
     * 作成処理
     * @return redirect
     */
    public function form_create(Request $request)
    {
        $user_id = Auth::id();

        $active_flg = 0;
        if($request->active){
            $active_flg = 1;
            DmTexts::cancel_activate_all();
        }

        DmTexts::create([
            'user_id'       => $user_id,
            'title'         => $request->title,
            'keyword_id'    => $request->keyword,
            'content'       => $request->content,
            'active_flg'    => $active_flg,
        ]);

        return redirect(route('dm.index', ['user_id' => $user_id]));
    }
    /**
     * 編集処理
     * @return redirect
     */
    public function form_edit(Request $request,$dm_id)
    {
        $user_id = Auth::id();

        $dm_data = DmTexts::find($dm_id);

        // 有効化設定
        $active_flg = $request->active_flg;
        if($request->active){
            $active_flg = 1;
            DmTexts::cancel_activate_all();
        }

        if($dm_data){
            // 更新処理
            if($request->save || $request->active){
                $dm_data->title         = $request->title;
                $dm_data->keyword_id    = $request->keyword;
                $dm_data->content       = $request->content;
                $dm_data->active_flg    = $active_flg;
                $dm_data->save();
            }
            // 削除処理
            else if($request->delete){
                $dm_data->delete();
            }
        } 

        return redirect(route('dm.index', ['user_id' => $user_id]));
    }
}
