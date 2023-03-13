<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillingHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billing_history', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->index()->comment('ユーザーID');
            $table->date('billing_date')->comment('支払日');
            $table->tinyInteger('status')->comment('ステータス 0:確認前 1:確認済み');
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
        Schema::dropIfExists('billing_history');
    }
}
