<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRelationTagToOthers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('other_tag', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->bigInteger('posts_id')->unsigned()->index()->nullable()->comment('文章id');
            $table->bigInteger('questions_id')->unsigned()->index()->nullable()->comment('问答id');
            $table->bigInteger('videos_id')->unsigned()->index()->nullable()->comment('视频id');
            $table->bigInteger('tags_id')->unsigned()->index()->comment('标签id');
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
