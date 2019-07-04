<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {	
    	for($i=1;$i<=20;$i++){
         
	         DB::table('users')->insert([	
			'name' => str_random(10),
			'password' => bcrypt('secret'),
			'email' => str_random(10),
			'phone' => str_random(11),
			'status' => 1 
			]); 
	 }
	 }


}
