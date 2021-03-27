<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Setting;
use App\FoodLogs;
use Carbon\Carbon;
use App\SettingDescription;
use PDF;
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


    public function index()
    {

    }

    public function nutritionReport($startDate = null, $endDate = null)
    {
        $schoolId = auth()->user()->school_id;
        $userSetting = Setting::where('school_id', $schoolId)->first();
        return view('report.nutritionReport', ['userSetting' => $userSetting]);
    }

    public function materialReport(){
        $schoolId = auth()->user()->school_id;
        $userSetting = Setting::where('school_id', $schoolId)->first();
        return view('report.materialReport', ['userSetting' => $userSetting]);
    }


    public function getMaterial(Request $request){
        $schoolId = auth()->user()->school_id;
        $inputs = $request->all();
        $startDate = (new DateTime($inputs['date']['startDate']))->format('Y-m-d');
        $endDate = (new DateTime($inputs['date']['endDate']))->format('Y-m-d');
        $foodLogs = getMaterialLogs($schoolId, $startDate, $endDate);
        $allServings = getServingsBySchool($schoolId);
        foreach($foodLogs as $log){
            $serving = $allServings[$log->food_type];
            $log->serving = $serving;
        }

        return view('report.materialData' , ['logs' => $foodLogs]);
    }

}

function getServingsBySchool($schoolId){
    $servings = FoodLogs::getServingsBySchool($schoolId);
    return $servings;
}

function getMaterialLogs($schoolId, $startDate,$endDate){
    $foodLogs = FoodLogs::getLogsForMaterial($schoolId, $startDate,$endDate);
    return $foodLogs;
}