<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUserGroup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //用户组表
        Schema::create('user_group', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name")->comment('组名称');
            $table->unsignedInteger("uid")->index()->comment('所属该组的用户id');
            $table->unsignedSmallInteger('status')->default(1)->comment('用户组状态: 1,启用 0,禁用');
            $table->softDeletes()->comment('软删除');
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
        Schema::dropIfExists('user_group');
    }
}
