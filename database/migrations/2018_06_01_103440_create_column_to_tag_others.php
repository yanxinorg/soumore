<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColumnToTagOthers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('other_tag', function (Blueprint $table) {
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
        //
    }
}
