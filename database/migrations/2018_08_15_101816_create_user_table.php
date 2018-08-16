<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->unsigned()->comment('用户id');
            $table->string('uid',128)->index()->nullable()->comment('用户uid');
            $table->string('name',64)->index()->comment('用户昵称');
            $table->string('title')->nullable()->comment('用户头衔');
            $table->string('truename',64)->index()->nullable()->comment('用户真实姓名');
            $table->string('email',128)->unique()->comment('用户邮箱');
            $table->string('mobile',24)->unique()->index()->nullable()->comment('登录手机');
            $table->string('password')->comment('用户密码');
            $table->unsignedSmallInteger('admin')->default(0)->comment('用户类型: 0:普通员工, 1:admin');
            $table->tinyInteger('status')->default(1)->comment('用户状态:	0-待审核，1已审核');
            $table->tinyInteger('lock')->default(0)->comment('是否锁定:	0-否，1-是');
            $table->tinyInteger('gender')->nullable()->comment('性别: 1-男,2-女,0-保密   可以用枚举类型');
            $table->string('avator')->nullable()->comment('用户头像');
            $table->string('qq')->nullable()->comment('用户qq');
            $table->string('alipay')->nullable()->comment('用户支付宝账户');
            $table->string('weixin')->nullable()->comment('用户微信账户');
            $table->string('weibo')->nullable()->comment('用户微博账户');
            $table->string('taobao')->nullable()->comment('用户阿里旺旺账户');
            $table->string('github')->nullable()->comment('用户github账户');
            $table->string('facebook')->nullable()->comment('用户facebook账户');
            $table->string('twitter')->nullable()->comment('用户twitter账户');
            $table->string('constellation')->nullable()->comment('用户星座');
            $table->string('zodiac')->nullable()->comment('用户生肖');
            $table->string('nationality')->nullable()->comment('用户国籍');
            $table->string('idcard')->nullable()->comment('用户证件号码');
            $table->string('site')->nullable()->comment('用户个人主页');
            $table->string('occupation')->nullable()->comment('用户职业');
            $table->string('education')->nullable()->comment('用户学历');
            $table->string('company')->nullable()->comment('用户所在公司');
            $table->string('graduateschool')->nullable()->comment('用户所毕业学校');
            $table->date('birthday')->nullable()->comment('出生日期');
            $table->text('bio')->nullable()->comment('用户自我介绍');
            $table->integer('province')->nullable()->comment('用户居住省份');
            $table->integer('city')->nullable()->comment('用户居住城市');
            $table->string('interest')->nullable()->comment('用户兴趣爱好');
            $table->integer('coins')->unsigned()->default(0)->comment('用户金币数');
            $table->integer('experience')->unsigned()->default(0)->comment('用户经验值');
            $table->timestamp('latest_login_time')->nullable()->comment('用户最近登录时间');
            $table->timestamp('latest_logout_time')->nullable()->comment('用户最近登出时间');
            $table->string('latest_login_ip')->nullable()->comment('用户最近登录ip');
            $table->integer('count_question')->unsigned()->default(0)->comment('用户提问总数');
            $table->integer('count_post')->unsigned()->default(0)->comment('用户文章总数');
            $table->integer('count_video')->unsigned()->default(0)->comment('用户视频总数');
            $table->integer('count_answer')->unsigned()->default(0)->comment('用户回答总数');
            $table->integer('count_praise')->unsigned()->default(0)->comment('用户获赞总数');
            $table->integer('count_fans')->unsigned()->default(0)->comment('用户粉丝总数');
            $table->integer('count_followed')->unsigned()->default(0)->comment('关注该用户的其他人总数');
            $table->integer('count_view_home')->unsigned()->default(0)->comment('访问该用户主页的人数总数');
            $table->string("qrcode",255)->nullable()->comment('用户二维码');
            $table->rememberToken();
            $table->softDeletes();
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
        Schema::dropIfExists('users');
    }
}
