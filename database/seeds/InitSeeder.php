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
        //初始化角色
        $roleId = \App\Role::updateOrCreate(array('name' => 'administrators'), array('name' => 'administrators','display_name'=>'超管组','description'=>'超管组权限大于管理员组'));
        //初始化超管root
    	$userId = User::updateOrCreate(array('name' => 'root'), array('name' => 'root','email'=>'001@chenframe.com','password'=>bcrypt('root@123.')));
        //关联角色
        \App\RoleUser::updateOrCreate(array('user_id' => $userId,'role_id'=>$roleId), array('user_id' => $userId,'role_id'=>$roleId));
        //初始化权限  (待完成)

        //关联角色权限    (待完成)

        //初始化一般管理员
        User::updateOrCreate(array('name' => 'admin'), array('name' => 'admin','email'=>'002@chenframe.com','password'=>bcrypt('admin.123')));
    }
}
