<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //分类表
        Schema::create('category', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("pid")->default(0)->comment('父级分类');
            $table->string("name")->comment('分类名称');
            $table->integer("grade")->nullable()->default(1)->comment('分类深度');
            $table->string("thumb")->nullable()->comment('缩略图');
            $table->mediumText("desc")->nullable()->comment('分类描述');
            $table->integer("order")->default(0)->comment('优先级，越大，同级显示的时候越靠前');
            $table->unsignedSmallInteger('status')->default(1)->comment('分类状态: 1,启用 0,禁用');
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
