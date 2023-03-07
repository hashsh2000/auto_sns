<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class DmTexts extends Model
{
    use HasFactory;
    use SoftDeletes;

    // table名
    protected $table = 'dm_text';
    // 論理削除
    protected $dates = ['deleted_at'];

    // カラム
    protected $fillable = [
        'user_id', 'keyword_id', 'title', 'content','active_flg'
    ];

    public static function cancel_activate_all(){
        $user_id = Auth::id();
        DmTexts::where('user_id', $user_id)->update([
            'active_flg' => 0,
        ]);
    }
}
