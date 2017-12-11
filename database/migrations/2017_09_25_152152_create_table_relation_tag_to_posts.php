<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRelationTagToPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //标签文章关系表
        Schema::create('post_tag', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->bigInteger('posts_id')->unsigned()->index()->comment('文章id'); 
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
