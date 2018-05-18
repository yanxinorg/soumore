<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('links', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url')->nullable()->comment('链接地址');
            $table->string('name')->nullable()->comment('链接名称');
            $table->string('thumb')->nullable()->comment('链接图片');
            $table->mediumText('desc')->nullable()->comment('链接描述');
            $table->unsignedTinyInteger('status')->default('1')->comment('链接状态 1:启用 0:禁用');
            $table->unsignedInteger('order')->nullable()->comment('链接排序');
            $table->integer('cate_id')->unsigned()->index()->nullable()->comment('链接所属分类id');
            $table->integer('tag_id')->unsigned()->index()->nullable()->comment('链接所属标签id');
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
        Schema::dropIfExists('links');
    }
}
