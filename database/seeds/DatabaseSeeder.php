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
        //填充城市数据
        $this->call(AreaSeeder::class);
    	//先调用一些初始化数据
    	$this->call(Rbac::class);
    }
}
