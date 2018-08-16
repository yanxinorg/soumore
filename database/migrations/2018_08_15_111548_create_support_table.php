<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //点赞表
        Schema::create('supports', function (Blueprint $table) {
            $table->increments('id')->unsigned()->comment('自增id');
            $table->integer('user_id')->index()->unsigned()->comment('用户id');
            $table->integer('source_id')->index()->unsigned()->comment('资源id');
            $table->tinyInteger('rating')->defalut('0')->comment('点赞数');
            $table->smallInteger('source_type')->unsigned()->comment('资源类型 1,文章  2,问答 3,视频');
            $table->softDeletes();
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
        Schema::dropIfExists('supports');
    }
}
