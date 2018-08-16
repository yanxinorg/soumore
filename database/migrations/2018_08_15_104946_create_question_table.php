<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //问答表
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index()->comment('问答所属用户id');
            $table->unsignedInteger('cate_id')->index()->nullable()->default(0)->comment('问答所属分类id');
            $table->string('title')->comment('问答标题');
            $table->string('keywords')->nullable()->comment('关键词');
            $table->mediumText('excerpt')->nullable()->comment('问答摘要');
            $table->longText('content')->comment('问答内容');
            $table->longText('content_filtered')->nullable()->comment('问答过滤后内容');
            $table->string('thumb')->nullable()->comment('问答缩略图');
            $table->unsignedInteger('answers')->default(0)->comment('问答回答数');
            $table->unsignedInteger('likes')->default(0)->comment('问答点赞数');
            $table->unsignedInteger('views')->default(0)->comment('问答查看数');
            $table->tinyInteger('anonymous')->default(0)->comment('是否匿名提问');
            $table->unsignedInteger('collections')->default(0)->comment('问答收藏数');
            $table->unsignedInteger('comments')->default(0)->comment('问答评论总数');
            $table->unsignedTinyInteger('status')->default(0)->comment('是否发布(后台管理员操作)  1:已审核 0:未审核');
            $table->unsignedInteger('followers')->default(0)->comment('问答关注数');
            $table->unsignedTinyInteger('istop')->default(0)->comment('是否置顶(后台管理员操作)  1:置顶 0:不置顶');
            $table->unsignedTinyInteger('isrecommond')->default(0)->comment('是否推荐(后台管理员操作)  1:推荐 0:不推荐');
            $table->timestamp('publish_time')->nullable()->comment('问答预约发布时间');
            $table->softDeletes();
            $table->timestamps();
            $table->index('created_at');
            $table->index('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
