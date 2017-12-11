<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAreas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //省市表
    	Schema::create('areas', function (Blueprint $table) {
    		$table->increments('id')->unsigned();           //地区
    		$table->string('name','64');                    //地区名称
    		$table->smallInteger('parent_id')->default(0);  //父级
    		$table->tinyInteger('grade');                   //当前级别
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
