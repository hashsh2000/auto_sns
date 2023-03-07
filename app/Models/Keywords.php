<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Keywords extends Model
{
    use HasFactory;
    use SoftDeletes;
    // table名
    protected $table = 'keyword';
    // 論理削除
    protected $dates = ['deleted_at'];

    // カラム
    protected $fillable = [
        'user_id', 'title', 'keyword'
    ];
}
