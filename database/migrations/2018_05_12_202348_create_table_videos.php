<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableVideos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //视频表
        Schema::create('videos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index()->comment('视频所属用户id');
            $table->unsignedInteger('cate_id')->index()->nullable()->default(0)->comment('视频所属分类id');
            $table->string('title')->comment('视频标题');
            $table->string('thumb')->nullable()->comment('视频缩略图');
            $table->mediumText('excerpt')->nullable()->comment('视频摘要');
            $table->string('url')->nullable()->comment('视频地址');
            $table->string('online_url')->nullable()->comment('第三方视频地址');
            $table->string('download_url')->nullable()->comment('视频下载地址');
            $table->unsignedTinyInteger('comment_status')->default(1)->comment('视频是否允许评论 1:允许，2:不允许');
            $table->unsignedInteger('hits')->default(0)->comment('视频点击数');
            $table->unsignedInteger('likes')->default(0)->comment('视频点赞数');
            $table->unsignedInteger('collections')->default(0)->comment('视频收藏数');
            $table->unsignedInteger('comments')->default(0)->comment('视频评论总数');
            $table->unsignedInteger('supports')->default(0)->comment('视频推荐数');
            $table->unsignedTinyInteger('istop')->default(0)->comment('是否置顶(后台管理员操作)  1:置顶 0:不置顶');
            $table->unsignedTinyInteger('isrecommond')->default(0)->comment('是否推荐(后台管理员操作)  1:推荐 0:不推荐');
            $table->unsignedTinyInteger('status')->default(1)->comment('是否发布(后台管理员操作)  1:已审核 0:未审核');
            $table->unsignedInteger('order')->default(0)->comment('视频排序');
            $table->timestamp('publish_time')->nullable()->comment('视频预约发布时间');
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
        //
    }
}
