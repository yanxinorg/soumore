<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRelationTagToQuestions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //标签问答关系表
        Schema::create('question_tag', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->bigInteger('questions_id')->unsigned()->index()->comment('问答id'); 
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
