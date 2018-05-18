<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSoftdeletedToAllTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function ($table) {
            $table->softDeletes();
        });

        Schema::table('posts', function ($table) {
            $table->softDeletes();
        });

        Schema::table('category', function ($table) {
            $table->softDeletes();
        });

        Schema::table('comments', function ($table) {
            $table->softDeletes();
        });

        Schema::table('questions', function ($table) {
            $table->softDeletes();
        });

        Schema::table('answers', function ($table) {
            $table->softDeletes();
        });

        Schema::table('tags', function ($table) {
            $table->softDeletes();
        });

        Schema::table('notice', function ($table) {
            $table->softDeletes();
        });

        Schema::table('areas', function ($table) {
            $table->softDeletes();
        });

        Schema::table('collections', function ($table) {
            $table->softDeletes();
        });

        Schema::table('attentions', function ($table) {
            $table->softDeletes();
        });

        Schema::table('messages', function ($table) {
            $table->softDeletes();
        });

        Schema::table('visitors', function ($table) {
            $table->softDeletes();
        });

        Schema::table('links', function ($table) {
            $table->softDeletes();
        });

        Schema::table('videos', function ($table) {
            $table->softDeletes();
        });

        Schema::table('captchas', function ($table) {
            $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('softdeleted_to_all');
    }
}
