<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTorrentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //种子表
        Schema::create('torrent', function (Blueprint $table) {
            $table->increments('id');
            $table->string('info_hash')->nullable()->comment('种子信息');
            $table->string('category')->nullable()->comment('种子分类');
            $table->string('data_hash')->nullable()->comment('数据信息');
            $table->string('name')->nullable()->index()->comment('资源名称');
            $table->string('extension')->nullable()->comment('资源扩展名');
            $table->string('classified')->nullable()->comment('');
            $table->string('source_ip')->nullable()->comment('');
            $table->string('tagged')->nullable()->comment('');
            $table->string('length')->nullable()->comment('');
            $table->string('create_time')->nullable()->comment('种子创建时间');
            $table->string('last_seen')->nullable()->comment('');
            $table->string('requests')->nullable()->comment('');
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
        Schema::dropIfExists('torrent');
    }
}
