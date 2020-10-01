<?php
namespace App\Http\Controllers;						// Location of file
use App\Ingredient;
use App\IngredientGroup;										// Import other classes
use App\Http\Controllers\Controller;
use App\Food;
use App\FoodLogs;
use App\Setting;
use Illuminate\Http\Request;
use Datetime;
use Debugbar;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Session;
class MealplanController extends Controller			
{
	public function showPlan($startDate = null, $endDate = null)
	{
		$userId = auth()->user()->id;
		$userSetting = Setting::find($userId);
		$now = Carbon::now();
		$weekStartDate = $now->startOfWeek()->format('Y-m-d');
		$weekEndDate = $now->endOfWeek()->format('Y-m-d');
		if($startDate && $endDate){
			$weekStartDate  = $startDate;
			$weekEndDate = $endDate;
		}
		dateInweek($weekStartDate);
		$userId = auth()->user()->id;
		$foodLogs = getLastLogs($userId, $weekStartDate, $weekEndDate);
		$dayInweek = dateInweek($weekStartDate);
		
		return view('mealplan.showplan', ['logs' => $foodLogs,'dayInweek' => $dayInweek, 'userSetting' => $userSetting]);
	}
	public function editPlan(Request $request)							// Define the method name
    {
				$userId = auth()->user()->id;
				$userSetting = Setting::find($userId);
				$now = Carbon::now();
				$weekStartDate = $request->session()->get('startDateOfWeek');
				$weekEndDate = $request->session()->get('endDateOfWeek');
				$userId = auth()->user()->id;
				$in_groups = IngredientGroup::all();        
				$schoolId = auth()->user()->school_id;
				$foods = Food::all();
				$foodLogs = getLastLogs($userId, $weekStartDate, $weekEndDate);
				$dayInweek = dateInweek($weekStartDate);
        return view('mealplan.editplan', ['in_groups' => $in_groups, 'foodList' => $foods, 'food_logs' => $foodLogs, 'dayInweek'=> $dayInweek, 'userSetting' => $userSetting]);
		}
		public function addFood(Request $request)
	{
		date_default_timezone_set("Asia/Bangkok");
		$userId = auth()->user()->id;
		$schoolId = auth()->user()->school_id;
		$input = $request->all();	
		$mealPlanData = $input['mealPlanData'];
		foreach($mealPlanData as $mealData){
			foreach($mealPlanData as $key => $value){
				$date = new DateTime($value['mealDate']);
				$mealDate = $date->format('Y-m-d');
				$deletedRows = FoodLogs::where('meal_date', $mealDate)->delete();
				if(isset($value['breakfast'])){
					foreach ($value['breakfast'] as $pos_breakfast  => $breakfastFood) {
						FoodLogs::create(
									[
										'meal_code' => 1,
										'item_position' => $pos_breakfast,
										'food_id' => $breakfastFood,
										'user_id' => $userId,
										'meal_date' => $mealDate,
										"food_type" => 1,
										"school_id" => $schoolId
									]
								);
					}
				}

				if(isset($value['breakfastSnack'])){
					foreach ($value['breakfastSnack'] as $pos_breakfastSnack => $breakfastSnackFood) {
						FoodLogs::create(
									[
										'meal_code' => 2,
										'item_position' => $pos_breakfastSnack,
										'food_id' => $breakfastSnackFood,
										'user_id' => $userId,
										'meal_date' => $mealDate,
										"food_type" => 1,
										"school_id" => $schoolId
									]
								);
					}
				}

				if(isset($value['lunch'])){
					foreach ($value['lunch'] as $pos_lunch => $lunchFood) {
						FoodLogs::create(
									[
										'meal_code' => 3,
										'item_position' => $pos_lunch,
										'food_id' => $lunchFood,
										'user_id' => $userId,
										'meal_date' => $mealDate,
										"food_type" => 1,
										"school_id" => $schoolId
									]
								);
					}
				}

				if(isset($value['lunchSnack'])){
					foreach ($value['lunchSnack'] as $pos_lunchSnack => $lunchSnackFood) {
						FoodLogs::create(
									[
										'meal_code' => 4,
										'item_position' => $pos_lunchSnack,
										'food_id' => $lunchSnackFood,
										'user_id' => $userId,
										'meal_date' => $mealDate,
										"food_type" => 1,
										"school_id" => $schoolId
									]
								);
					}
				}
			
			}
		}
		return response()->json(['success' => 'Insert into food log done']);
	}

	public function dateSelect(Request $request)
	{
		$userId = auth()->user()->id;
		$userSetting = Setting::find($userId);
		$now = Carbon::now();
		$input = $request->all();
		$userId = auth()->user()->id;
		$inputStartDate = $input['date']['startDate'];
		$inputEndDate = $input['date']['endDate'];
		$startDate = new DateTime($inputStartDate);
		$endDate = new DateTime($inputEndDate);
		$startDate = $startDate->format('Y-m-d');
		$endDate = $endDate->format('Y-m-d');
		$request->session()->put('startDateOfWeek', $startDate);
		$request->session()->put('endDateOfWeek', $endDate);
		$in_groups = IngredientGroup::all();        
		$schoolId = auth()->user()->school_id;
		$foods = Food::all();
		$foodLogs = getLastLogs($userId, $startDate, $endDate);
		$dayInweek = dateInweek($startDate);
		return view('mealplan.mealpanel', ['logs' => $foodLogs,'dayInweek' => $dayInweek, 'userSetting' => $userSetting]);
	}
}
function getLastLogs($userId,$weekStartDate,$weekEndDate){
		$lastLog = DB::select('SELECT food_id, meal_code, food_thai, meal_date FROM food_logs INNER JOIN foods on food_logs.food_id = foods.id WHERE user_id = ? &&  food_logs.meal_date BETWEEN ? AND ?', [$userId, $weekStartDate, $weekEndDate]);
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


