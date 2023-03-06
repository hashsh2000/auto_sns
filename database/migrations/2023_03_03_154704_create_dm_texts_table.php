<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDmTextsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dm_text', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->index()->comment('ユーザーID');
            $table->integer('keyword_id')->nullable()->comment('キーワードID');
            $table->string('title')->comment('タイトル');
            $table->text('content')->comment('送信内容');
            $table->tinyInteger('active_flg')->default(0)->comment('有効フラグ');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dm_text');
    }
}
