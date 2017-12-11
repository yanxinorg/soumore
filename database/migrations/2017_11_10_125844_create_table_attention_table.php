<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAttentionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //关注表
         Schema::create('attentions', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned()->comment('自增id');
            $table->bigInteger('user_id')->index()->unsigned()->comment('用户id'); 
            $table->bigInteger('source_id')->index()->unsigned()->comment('资源id');
            $table->smallInteger('source_type')->unsigned()->comment('资源类型 1,用户  2,分类 3,标签');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attentions');
    }
}
