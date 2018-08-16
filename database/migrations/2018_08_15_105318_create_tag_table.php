<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //标签表
        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id')->unsigned()->comment('标签id');
            $table->string('name',128)->unique()->comment('标签名称');
            $table->string('thumb')->nullable()->comment('标签图标');
            $table->string('mime')->nullable()->comment('缩略图类型');
            $table->text('desc')->nullable()->comment('标签描述');
            $table->integer('cate_id')->unsigned()->index()->default(0)->comment('标签默认分类');
            $table->integer('watchs')->unsigned()->index()->default(0)->comment('该标签关注数');
            $table->unsignedSmallInteger('status')->default(1)->comment('话题状态: 1,已审核 0,未审核');
            $table->integer('posts')->unsigned()->default(0)->comment('该标签文章总数');
            $table->integer('questions')->unsigned()->default(0)->comment('该标签问答总数');
            $table->integer('videos')->unsigned()->default(0)->comment('该标签视频总数');
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
        Schema::dropIfExists('tags');
    }
}
