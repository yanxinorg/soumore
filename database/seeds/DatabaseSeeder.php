<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //初始化城市数据
        $this->call(AreaSeeder::class);
    	//初始化权限
        $this->call(RbacSeeder::class);
    }
}
