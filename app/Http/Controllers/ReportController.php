<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Setting;
use Carbon\Carbon;
use PDF;
use DB;
use Debugbar;
use Datetime;

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
        $mealSetting = array(
            array(1, "เช้า", $userSetting->is_breakfast, "breakfast-meal"), 
            array(2, "ว่างเช้า", $userSetting->is_morning_snack, "breakfast-snack-meal"), 
            array(3, "กลางวัน", $userSetting->is_lunch, "lunch-meal"), 
            array(4, "ว่างบ่าย", $userSetting->is_afternoon_snack, "lunch-snack-meal"), 
        );
        return view('report.report', ['userSetting' => $userSetting]);
    }

    public function pdf(Request $request)
    {
        $userId = auth()->user()->id;
        $schoolId = auth()->user()->school_id;
        $userSetting = Setting::find($schoolId);

        $input = $request->all();
        $inputStartDate = $input['startDate'];
        $inputEndDate = $input['endDate'];
        $inputFoodType = $input['foodType'];
        // $view = $input['view'];
        // Debugbar::info("dateselect".$inputFoodType);

        $startDate = new DateTime(strstr($inputStartDate, " (", true));
        $endDate = new DateTime(strstr($inputEndDate, " (", true));
        $startDate = $startDate->format('Y-m-d');
        $endDate = $endDate->format('Y-m-d');
        $request->session()->put('startDateOfWeek', $startDate);
        $request->session()->put('endDateOfWeek', $endDate);
        $request->session()->put('inputFoodType', $inputFoodType);

        // $in_groups = IngredientGroup::all();        
        $foodLogs = getLastLogs($userId, $startDate, $endDate, $inputFoodType);
        Debugbar::info($foodLogs);
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


        // $pdf = App::make('dompdf.wrapper');
        // $html = view('report.pdf', ['logs' => $foodLogs, 'mealSetting' => $mealSetting, 'dateData' => $dateData,  'dayInweek' => $dayInweek, 'userSetting' => $userSetting])->render();
        // $pdf->loadHTML($html);
        // return $pdf->stream();
        $test = "test";

        $pdf = PDF::loadView('report.pdf', ['test'=> $test, 'logs' => $foodLogs, 'mealSetting' => $mealSetting, 'dateData' => $dateData, 'dayInweek' => $dayInweek, 'userSetting' => $userSetting]);
        return @$pdf->stream();
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
}

function getLastLogs($userId,$weekStartDate,$weekEndDate, $inputFoodType){
    $foodTypeList = $inputFoodType == 8 ? range(8,21) : range(22,35);
    //$foodTypeListQ = '('.implode(",", $foodTypeList).')';
    $foodTypeListQ = implode(",", $foodTypeList);
    //Debugbar::info("foodTypeListQ". $foodTypeListQ);
    $lastLog = DB::select('
        SELECT food_logs.food_id, food_logs.meal_code, food_logs.food_type, setting_description.setting_description_thai, foods.food_thai, food_logs.meal_date, 
        nutritions.energy, nutritions.protein, nutritions.fat, nutritions.carbohydrate, nutritions.vitamin_a, nutritions.vitamin_b1, nutritions.vitamin_b2,nutritions.vitamin_c, nutritions.iron, nutritions.calcium, nutritions.phosphorus, nutritions.fiber, nutritions.sodium, nutritions.sugar 
        FROM food_logs 
        LEFT JOIN foods on food_logs.food_id = foods.id 
        LEFT JOIN nutritions on food_logs.food_id = nutritions.food_id 
        LEFT JOIN setting_description on food_logs.food_type = setting_description.id 
        WHERE user_id = ? &&  food_logs.meal_date BETWEEN ? AND ? && food_logs.food_type IN ('.$foodTypeListQ.')', 
        [$userId, $weekStartDate, $weekEndDate, $foodTypeListQ]);
    return $lastLog;
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

