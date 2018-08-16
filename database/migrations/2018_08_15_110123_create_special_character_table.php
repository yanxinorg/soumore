<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecialCharacterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //特殊字符
        Schema::create('special_character', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username')->nullable()->index()->comment('特殊姓名');
            $table->string('password')->nullable()->index()->comment('弱密码口令');
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
        Schema::dropIfExists('special_character');
    }
}
