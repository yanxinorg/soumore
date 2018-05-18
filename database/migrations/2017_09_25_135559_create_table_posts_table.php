<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //文章表
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id'); 
            $table->integer('user_id')->unsigned()->index()->comment('文章所属用户id');                  
            $table->unsignedInteger('cate_id')->index()->nullable()->default(0)->comment('文章所属分类id');
            $table->string('title')->comment('文章标题');
            $table->string('keywords')->nullable()->comment('关键词');
            $table->string('source')->nullable()->comment('文章来源');
            $table->string('author',45)->nullable()->comment('文章作者');
            $table->mediumText('excerpt')->nullable()->comment('文章摘要');
            $table->longText('content')->comment('文章内容');
            $table->longText('content_filtered')->nullable()->comment('文章过滤后内容');
            $table->unsignedTinyInteger('comment_status')->default(1)->comment('文章是否允许评论 1:允许，2:不允许');
            $table->string('thumb')->nullable()->comment('文章缩略图');
            $table->string('thumb_small')->nullable()->comment('列表文章缩略图');
            $table->string('mime')->nullable()->comment('缩略图类型');
            $table->unsignedInteger('hits')->default(0)->comment('文章点击数');
            $table->unsignedInteger('likes')->default(0)->comment('文章点赞数');
            $table->unsignedInteger('collections')->default(0)->comment('文章收藏数');
            $table->unsignedInteger('comments')->default(0)->comment('文章评论总数');
            $table->unsignedInteger('supports')->default(0)->comment('文章推荐数');
            $table->unsignedTinyInteger('istop')->default(0)->comment('是否置顶(后台管理员操作)  1:置顶 0:不置顶');
            $table->unsignedTinyInteger('isrecommond')->default(0)->comment('是否推荐(后台管理员操作)  1:推荐 0:不推荐');
            $table->unsignedTinyInteger('status')->default(1)->comment('是否发布(后台管理员操作)  1:已审核 0:未审核');
            $table->unsignedInteger('order')->default(0)->comment('文章排序');
            $table->timestamp('publish_time')->nullable()->comment('文章预约发布时间');
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
        Schema::dropIfExists('table_posts');
    }
}
