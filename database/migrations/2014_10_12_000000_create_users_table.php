<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 用户表
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->unsigned()->comment('用户id');            
            $table->string('uid',128)->index()->nullable()->comment('用户uid');     
            $table->string('name',64)->index()->comment('用户姓名可以为昵称');                 
            $table->string('title')->nullable()->comment('用户头衔');                
            $table->string('truename',64)->index()->nullable()->comment('用户真实姓名'); 
            $table->string('email',128)->unique()->comment('用户邮箱');              
            $table->string('mobile',24)->index()->nullable()->comment('登录手机');  
            $table->string('password')->comment('用户密码');   
            $table->unsignedSmallInteger('admin')->default(0)->comment('用户类型: 0:普通员工, 1:admin');
            $table->tinyInteger('status')->default(1)->comment('用户状态:	0-待审核，1已审核'); 
            $table->tinyInteger('lock')->default(0)->comment('是否锁定:	0-否，1-是');
            $table->tinyInteger('gender')->nullable()->comment('性别: 1-男,2-女,0-保密   可以用枚举类型');       
            $table->tinyInteger('affectivestatus')->nullable()->comment('性别: 0-未婚,1-已婚,2-离异');
            $table->string('avator')->nullable()->comment('用户头像');
            $table->string('face50')->nullable()->comment('用户头像50*50');
            $table->string('face80')->nullable()->comment('用户头像80*80');
            $table->string('face180')->nullable()->comment('用户头像180*180');
            $table->string('qq')->nullable()->comment('用户qq');                   
            $table->string('alipay')->nullable()->comment('用户支付宝账户');               
            $table->string('weixin')->nullable()->comment('用户微信账户');              
            $table->string('weibo')->nullable()->comment('用户微博账户');               
            $table->string('taobao')->nullable()->comment('用户阿里旺旺账户');               
            $table->string('github')->nullable()->comment('用户github账户');              
            $table->string('msn')->nullable()->comment('用户msn账户');                  
            $table->string('facebook')->nullable()->comment('用户facebook账户');             
            $table->string('twitter')->nullable()->comment('用户twitter账户');              
            $table->string('constellation')->nullable()->comment('用户星座');        
            $table->string('zodiac')->nullable()->comment('用户生肖');               
            $table->string('nationality')->nullable()->comment('用户国籍');          
            $table->string('idcard')->nullable()->comment('用户证件号码');              
            $table->string('site')->nullable()->comment('用户个人主页');                 
            $table->string('bloodtype')->nullable()->comment('用户血型');            
            $table->string('height')->nullable()->comment('用户身高');               
            $table->string('weight')->nullable()->comment('用户体重');              
            $table->string('revenue')->nullable()->comment('用户年收入');             
            $table->string('position')->nullable()->comment('用户职位');            
            $table->string('occupation')->nullable()->comment('用户职业');          
            $table->string('education')->nullable()->comment('用户学历');            
            $table->string('company')->nullable()->comment('用户所在公司');              
            $table->string('graduateschool')->nullable()->comment('用户所毕业学校');       
            $table->string('studentid')->nullable()->comment('用户学号');           
            $table->string('grade')->nullable()->comment('用户班级');                
            $table->date('birthday')->nullable()->comment('出生日期');               
            $table->text('bio')->nullable()->comment('用户自我介绍');                   
            $table->Integer('province')->nullable()->comment('用户居住省份');       
            $table->Integer('city')->nullable()->comment('用户居住城市');           
            $table->string('resideprovince')->nullable()->comment('用户居住详细地址');       
            $table->string('address')->nullable()->comment('用户寄件地址');             
            $table->string('zipcode')->nullable()->comment('用户寄件地址邮编');              
            $table->string('interest')->nullable()->comment('用户兴趣爱好');            
            $table->string('site_notifications')->nullable()->comment('站内通知');   
            $table->string('email_notifications')->nullable()->comment('邮件通知策略');  
            $table->rememberToken();
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
