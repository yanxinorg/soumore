<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;
class ResetPassEmailSend implements ShouldQueue
{
	protected $email;
	protected $captcha;
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email,$captcha)
    {
        $this->email = $email;
        $this->captcha = $captcha;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
    	$email = $this->email;
    	$captcha = $this->captcha;
    	Mail::send('ask.email.send_resetpasswd_email_captcha',['captcha'=>$captcha],function($message) use($email){
    		$message->to($email)->subject('搜more密码重置验证码');
    	});
    }
}
