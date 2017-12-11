<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMoreCloumnToUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	//新增用户属性
    	Schema::table('users', function (Blueprint $table) {
            $table->integer('coins')->unsigned()->default(0)->comment('用户金币数');  
            $table->integer('experience')->unsigned()->default(0)->comment('用户经验值'); 
            $table->timestamp('latest_login_time')->nullable()->comment('用户最近登录时间');  
            $table->timestamp('latest_logout_time')->nullable()->comment('用户最近登出时间');
            $table->string('latest_login_ip')->nullable()->comment('用户最近登录ip地址');
            $table->integer('count_question')->unsigned()->default(0)->comment('用户提问总数');
            $table->integer('count_post')->unsigned()->default(0)->comment('用户文章总数');  
            $table->integer('count_answer')->unsigned()->default(0)->comment('用户回答总数');   
            $table->integer('count_praise')->unsigned()->default(0)->comment('用户或赞总数');   
            $table->integer('count_fans')->unsigned()->default(0)->comment('用户粉丝总数');  
            $table->integer('count_followed')->unsigned()->default(0)->comment('关注该用户的其他人总数');
            $table->integer('count_view_home')->unsigned()->default(0)->comment('访问该用户主页的人数总数');
    		$table->string("qrcode",255)->nullable()->comment('用户二维码');
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
