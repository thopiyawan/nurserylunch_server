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

}

