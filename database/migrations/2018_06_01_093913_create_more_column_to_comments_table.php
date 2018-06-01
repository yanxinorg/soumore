<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoreColumnToCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //新增用户属性
        Schema::table('comments', function (Blueprint $table) {
            $table->bigInteger('source_id')->index()->unsigned()->comment('资源id');
            $table->smallInteger('source_type')->index()->unsigned()->comment('资源类型 1,文章 2,问答 3,视频');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
