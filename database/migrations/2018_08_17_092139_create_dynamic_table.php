<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDynamicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //用户动态表
        Schema::create('dynamic', function (Blueprint $table) {
            $table->increments('id')->unsigned()->comment('自增id');
            $table->integer('uid')->index()->unsigned()->comment('用户id');
            $table->unsignedInteger('source_id')->index()->comment('资源id');
            $table->string('source_action',64)->comment('资源类型：1，发布文章 2，发布问答 3，发布视频 4，评论文章 5，回答问答 6，评论视频');
            $table->string('subject',128)->nullable()->comment('资源标题');
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
        Schema::dropIfExists('dynamic');
    }
}
