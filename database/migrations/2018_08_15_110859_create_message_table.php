<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //私信表
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('from_user_id')->unsigned()->index()->nullable()->comment('发信人');
            $table->bigInteger('to_user_id')->unsigned()->index()->nullable()->comment('收信人');
            $table->text('content')->nullable()->comment('发信内容');
            $table->tinyInteger('is_read')->unsigned()->nullable()->comment('是否已经阅读');
            $table->tinyInteger('from_deleted')->unsigned()->nullable()->comment('发信人删除');
            $table->tinyInteger('to_deleted')->unsigned()->nullable()->comment('收信人删除');
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
        Schema::dropIfExists('messages');
    }
}
