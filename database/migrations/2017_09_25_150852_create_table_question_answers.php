<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableQuestionAnswers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //问答回答表
         Schema::create('answers', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('question_id')->unsigned()->index()->comment('问答id'); 
            $table->integer('user_id')->unsigned()->index()->comment('回答人id');
            $table->integer('to_user_id')->unsigned()->index()->nullable()->comment('回复回答人id');     
            $table->text('content')->comment('回答内容');
            $table->integer('supports')->unsigned()->default(0)->comment('该回答支持数');
            $table->integer('oppositions')->unsigned()->default(0)->comment('该问答反对数');  
            $table->integer('comments')->unsigned()->default(0)->comment('该问答评论数');              
            $table->tinyInteger('status')->unsigned()->default(0)->comment('0,待审核 1,已审核');
             $table->softDeletes();
            $table->timestamps();
            $table->index('created_at');
            $table->index('updated_at');
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
