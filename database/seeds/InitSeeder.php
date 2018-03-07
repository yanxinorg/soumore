<?php

use Illuminate\Database\Seeder;
use App\User;

class InitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //初始化默认管理员
    	User::updateOrCreate(array('name' => 'admin'), array('name' => 'admin','email'=>'001@chenframe.com','password'=>bcrypt('123456')));
    }
}
