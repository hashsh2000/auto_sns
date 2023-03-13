<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Billing extends Model
{
    use HasFactory;
    use SoftDeletes;

    // table名
    protected $table = 'billing_history';
    // 論理削除
    protected $dates = ['deleted_at'];

    // カラム
    protected $fillable = [
        'user_id', 'billing_date','status'
    ];
}
