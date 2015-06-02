<?php
class UserSeeder extends DatabaseSeeder{
	public function run(){
		$user = [[
				"username" => "kishore",
		        "password" =>Hash::make("123"),
				"type" => "user",
				"remember_token" =>"okay"
				  
		],
		[
				"username" => "puneet",
		        "password" =>Hash::make("1234"),
				"type" => "user",
				"remember_token" =>"okay"
				
		],
				[
				"username" => "namita",
				"password" =>Hash::make("123"),
				"type" => "user",
				"remember_token" =>"okay"
				
						]
		];
		foreach ($user as $usr){
			User::create($usr);
		}
	}
}