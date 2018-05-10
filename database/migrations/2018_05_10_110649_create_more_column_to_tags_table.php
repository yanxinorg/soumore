<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoreColumnToTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tags', function (Blueprint $table) {
            $table->integer('looks')->unsigned()->default(0)->comment('该标签查看数');
            $table->integer('likes')->unsigned()->default(0)->comment('点赞该标签数');
            $table->integer('posts')->unsigned()->default(0)->comment('该标签文章总数');
            $table->integer('questions')->unsigned()->default(0)->comment('该标签问答总数');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('more_column_to_tags');
    }
}
