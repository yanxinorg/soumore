<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOtherTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //标签关联表
        Schema::create('other_tag', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->bigInteger('post_id')->unsigned()->index()->nullable()->comment('文章id');
            $table->bigInteger('question_id')->unsigned()->index()->nullable()->comment('问答id');
            $table->bigInteger('video_id')->unsigned()->index()->nullable()->comment('视频id');
            $table->bigInteger('tag_id')->unsigned()->index()->comment('标签id');
            $table->bigInteger('source_id')->index()->unsigned()->comment('资源id');
            $table->smallInteger('source_type')->index()->unsigned()->comment('资源类型 1,文章 2,问答 3,视频');
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
        Schema::dropIfExists('other_tag');
    }
}
