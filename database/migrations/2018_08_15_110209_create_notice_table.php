<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //公告栏
        Schema::create('notice', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable()->comment('公告标题');
            $table->string('author',45)->nullable()->comment('公告作者');
            $table->longText('content')->nullable()->comment('公告内容');
            $table->string('url')->nullable()->comment('公告链接');
            $table->unsignedTinyInteger('status')->default(1)->comment('公告状态 1:发布，2:不发布');
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
        Schema::dropIfExists('notice');
    }
}
