<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //评论表
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned()->index()->comment('评论人id');
            $table->text('content')->comment('评论内容');
            $table->integer('to_user_id')->unsigned()->nullable()->comment('回复评论人id');
            $table->tinyInteger('status')->unsigned()->default(1)->comment('1,启用 2,不启用');
            $table->bigInteger('source_id')->index()->unsigned()->comment('资源id');
            $table->smallInteger('source_type')->index()->unsigned()->comment('资源类型 1,文章 2,问答 3,视频');
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
        Schema::dropIfExists('comments');
    }
}
