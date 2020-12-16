<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use Carbon\Carbon;

class ReportController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($startDate = null, $endDate = null)
    {
        $userId = auth()->user()->id;
        $userSetting = Setting::find($userId);
        $now = Carbon::now();


        $mealSetting = array(
            array(1, "เช้า", $userSetting->is_breakfast, "breakfast-meal"), 
            array(2, "ว่างเช้า", $userSetting->is_morning_snack, "breakfast-snack-meal"), 
            array(3, "กลางวัน", $userSetting->is_lunch, "lunch-meal"), 
            array(4, "ว่างบ่าย", $userSetting->is_afternoon_snack, "lunch-snack-meal"), 
        );


        // $weekStartDate = $now->startOfWeek()->format('Y-m-d');
        // $weekEndDate = $now->endOfWeek()->format('Y-m-d');
        // if($startDate && $endDate){
        //     $weekStartDate  = $startDate;
        //     $weekEndDate = $endDate;
        // }
        // dateInweek($weekStartDate);
        // $userId = auth()->user()->id;
        // $foodLogs = getLastLogs($userId, $weekStartDate, $weekEndDate);
        // $dayInweek = dateInweek($weekStartDate);
        
        return view('report.report', ['userSetting' => $userSetting]);
        
    }

    public function getLogsFromDate (Request $request)
    {
        Debugbar::info("getLogsFromDate---");
        $userId = auth()->user()->id;
        $userSetting = Setting::find($userId);
        $now = Carbon::now();


        $input = $request->all();
        $userId = auth()->user()->id;
        $inputStartDate = $input['date']['startDate'];
        $inputEndDate = $input['date']['endDate'];
        //$inputFoodType = 8;
        $inputFoodType = $input['foodType'];
        Debugbar::info("dateselect".$inputFoodType);

        $startDate = new DateTime($inputStartDate);
        $endDate = new DateTime($inputEndDate);
        $startDate = $startDate->format('Y-m-d');
        $endDate = $endDate->format('Y-m-d');
        $request->session()->put('startDateOfWeek', $startDate);
        $request->session()->put('endDateOfWeek', $endDate);
        $request->session()->put('inputFoodType', $inputFoodType);

        // $in_groups = IngredientGroup::all();        
        $schoolId = auth()->user()->school_id;
        $foodLogs = getLastLogs($userId, $startDate, $endDate, $inputFoodType);
        $dayInweek = dateInweek($startDate);
        $dateData = array(
            array("monday", "จันทร์", $dayInweek[0]),
            array("tuesday", "อังคาร", $dayInweek[1]),
            array("wednesday", "พุธ", $dayInweek[2]),
            array("thursday", "พฤหัสบดี", $dayInweek[3]),
            array("friday", "ศุกร์", $dayInweek[4]),
        );
        $mealSetting = array(
            array(1, "เช้า", $userSetting->is_breakfast), 
            array(2, "ว่างเช้า", $userSetting->is_morning_snack), 
            array(3, "กลางวัน", $userSetting->is_lunch), 
            array(4, "ว่างบ่าย", $userSetting->is_afternoon_snack), 
        );
        return view('report.report', ['logs' => $foodLogs, 'mealSetting' => $mealSetting, 'dateData' => $dateData,  'dayInweek' => $dayInweek, 'userSetting' => $userSetting]);
    }

    function dateInweek($weekStartDate){
        $monday = new Carbon($weekStartDate);
        $tuesday = $monday->copy()->addDays();
        $wednesday = $tuesday->copy()->addDays();
        $thursday = $wednesday->copy()->addDays();
        $friday = $thursday->copy()->addDays();
        $dayInweek = array($monday->format('Y-m-d'), $tuesday->format('Y-m-d'), $wednesday->format('Y-m-d'), $thursday->format('Y-m-d'), $friday->format('Y-m-d'));
        return $dayInweek;
    }

}

