<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 10)->create()->each(function($user){
			$user->save();
		});
        // $user = new App\User;
        // $user->name = "ศูนย์อนามัยที่ 5/ วัดเทพประสิทธิ์คณาวาส";
        // $user->email = "test@test.com";
        // $user->email_verified_at = now();
        // $user->password = "test1234"; // password
        // $user->remember_token = Str::random(10);
        // $user->save();

    }
}
