<?php
namespace App\Http\Controllers;						// Location of file

use App\User;
use App\School;
use App\Setting;										// Import other classes
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller				// Define the class name
{
    public function index()							// Define the method name
    {
        $users = User::all();
        return view('users.list', ['users' => $users]);	// Return response to client
    }

    public function setting()							// Define the method name
    {
        //$users = User::all();
        $user = auth()->user();
        $school = School::find($user->school_id);
        return view('users.setting', ['school' => $school, 'user' => $user, 'setting' => $school->setting]);	// Return response to client
    }
    
    public function updateSetting(Request $request)
    {

        // $affected = DB::table('user_settings')
        //       ->where('id', $user->id)
        //       ->update(['is_weekday' => 1]);
        $user = auth()->user();
        //$school = School::find($user->school_id);
        //$setting = Setting::find($user->school_id);
        $school = School::where('id', $user->school_id)->first();
        $setting = Setting::where('school_id', $user->school_id)->first();



        switch ($request->input('update')) {

            case 'system':
                $setting->is_weekday = $request->has("is_weekday");
                $setting->is_saturday = $request->has("is_saturday");
                $setting->is_sunday = $request->has("is_sunday");

                //meal
                $setting->is_breakfast = $request->has("is_breakfast");
                $setting->is_morning_snack = $request->has("is_morning_snack");
                $setting->is_lunch = $request->has("is_lunch");
                $setting->is_afternoon_snack = $request->has("is_afternoon_snack");

                //smallkids
                $setting->is_for_small = $request->has("is_for_small");
                $setting->is_s_muslim = $request->has("is_s_muslim");
                $setting->is_s_vege = $request->has("is_s_vege");
                $setting->is_s_vegan = $request->has("is_s_vegan");
                $setting->is_s_milk = $request->has("is_s_milk");
                $setting->is_s_breastmilk = $request->has("is_s_breastmilk");
                $setting->is_s_egg = $request->has("is_s_egg");
                $setting->is_s_wheat = $request->has("is_s_wheat");
                $setting->is_s_shrimp = $request->has("is_s_shrimp");
                $setting->is_s_shell = $request->has("is_s_shell");
                $setting->is_s_crab = $request->has("is_s_crab");
                $setting->is_s_fish = $request->has("is_s_fish");
                $setting->is_s_peanut = $request->has("is_s_peanut");
                $setting->is_s_soybean = $request->has("is_s_soybean");

                // bigkids
                $setting->is_for_big = $request->has("is_for_big");
                $setting->is_b_muslim = $request->has("is_b_muslim");
                $setting->is_b_vege = $request->has("is_b_vege");
                $setting->is_b_vegan = $request->has("is_b_vegan");
                $setting->is_b_milk = $request->has("is_b_milk");
                $setting->is_b_breastmilk = $request->has("is_b_breastmilk");
                $setting->is_b_egg = $request->has("is_b_egg");
                $setting->is_b_wheat = $request->has("is_b_wheat");
                $setting->is_b_shrimp = $request->has("is_b_shrimp");
                $setting->is_b_shell = $request->has("is_b_shell");
                $setting->is_b_crab = $request->has("is_b_crab");
                $setting->is_b_fish = $request->has("is_b_fish");
                $setting->is_b_peanut = $request->has("is_b_peanut");
                $setting->is_b_soybean = $request->has("is_b_soybean");
                //save
                $setting->save();
                break;

            case 'school':
                $school->address = $request->input("address");
                $school->tumbol = $request->input("tumbol");
                $school->amper = $request->input("amper");
                $school->province = $request->input("province");
                $school->post_number = $request->input("post_number");
                $school->save();

                break;

            case 'info':
                $user->firstname = $request->input("firstname");
                $user->lastname = $request->input("lastname");
                $user->email = $request->input("email");
                $user->save();

                break;
        }

        return view('users.setting', ['school' => $school, 'user' => $user, 'setting' => $setting]);

    }

}

