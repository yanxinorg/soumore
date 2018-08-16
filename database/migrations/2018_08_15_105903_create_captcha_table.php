<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaptchaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //验证码表
        Schema::create('captchas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('mobile')->nullable()->index()->comment('手机号');
            $table->string('email')->nullable()->index()->comment('邮箱');
            $table->string('mobile_code')->nullable()->index()->comment('手机号验证码');
            $table->string('email_code')->nullable()->index()->comment('邮箱验证码');
            $table->timestamp('valid_time')->nullable()->comment('验证码有效期');
            $table->unsignedInteger('type')->default(0)->comment('验证码类型: 0:一般验证码  1:注册验证码 2:密码找回验证码');
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
        Schema::dropIfExists('captchas');
    }
}
