<?php

use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
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
            //$user->setting()->save(factory(App\UserSetting::class)->make());
            //$user->setting()->save(factory(App\UserSetting::class)->make());

		});


        // $user = new App\User;
        // $user->name = "ศูนย์อนามัยที่ 5/ วัดเทพประสิทธิ์คณาวาส";
        // $user->email = "t@t.com";
        // $user->email_verified_at = now();
        // $user->password = Hash::make('password'); // password
        // $user->remember_token = Str::random(10);
        // $user->save();
        // $user->setting()->save(factory(App\UserSetting::class)->make());



    }
}
