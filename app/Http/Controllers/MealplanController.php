<?php
namespace App\Http\Controllers;						// Location of file
use App\Ingredient;
use App\IngredientGroup;										// Import other classes
use App\Http\Controllers\Controller;
use App\Food;
use App\FoodIngredient;
use App\FoodLogs;
use App\Setting;
use App\EnergyLogs;
use App\Nutrition;
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
		$weekStartDate = $now->startOfWeek()->format('Y-m-d');
		$weekEndDate = $now->endOfWeek()->format('Y-m-d');
		$in_groups = IngredientGroup::all();        
		$schoolId = auth()->user()->school_id;
		$foods = Food::all();
		foreach($foods as $food)
        {
            $food->init();
        }
		$foodLogs = getLastLogs($userId, $weekStartDate, $weekEndDate);
		$dayInweek = dateInweek($weekStartDate);

		$targetNutrition = array(
			'energy' => array(322.5, 645, 967.5, 1290),
			'protein' => array(21.45, 25.05, 28.65, 32.35),
			'fat' => array(6.275, 12.55, 18.825, 25.1),
		);
		
    	return view('mealplan.editplan', ['in_groups' => $in_groups, 'foodList' => $foods, 'food_logs' => $foodLogs, 'dayInweek'=> $dayInweek, 'userSetting' => $userSetting, 'targetNutrition' =>$targetNutrition]);	// Return response to client
	}
	public function addFood(Request $request)
	{
		//set time zone
			date_default_timezone_set("Asia/Bangkok");
			$userId = auth()->user()->id;
			$schoolId = auth()->user()->school_id;
			$input = $request->all();	
			$mealPlanData = $input['mealPlanData'];
			$energyLogsTable = new EnergyLogs;
			$nutritionColumns = $energyLogsTable->getTableColumns();
			$nutritionColumns = array_diff($nutritionColumns, ['id', 'meal_code', 'food_type', 'meal_date', 'school_id', 'created_at', 	'updated_at']);
			$energyLog = [];
			//loop for each date meal plan
			foreach($mealPlanData as $key => $value){
				$date = new DateTime($value['mealDate']);
				$mealDate = $date->format('Y-m-d');
				$deletedRows = FoodLogs::where('meal_date', $mealDate)->delete();
				$dateEnergy = ["mealdate" => $mealDate];
				array_push($energyLog, $dateEnergy);
				if(isset($value['breakfast'])){
					$nutritionMealSum = [];
					foreach($nutritionColumns as $columnName){
						$nutritionMealSum[$columnName] = 0;
					};
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
						$food_nutrition = Food::find($breakfastFood);
						foreach($nutritionColumns as $nutritionName){
							$nutritionMealSum[$nutritionName] = $nutritionMealSum[$nutritionName] + $food_nutrition->nutritions->$nutritionName;
						}
					}
					$energyLog[$key]["breakfast"]  = $nutritionMealSum;
				}
				if(isset($value['breakfastSnack'])){
					$nutritionMealSum = [];
					foreach($nutritionColumns as $columnName){
						$nutritionMealSum[$columnName] = 0;
					};
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
						$food_nutrition = Food::find($breakfastSnackFood);
						foreach($nutritionColumns as $nutritionName){
							$nutritionMealSum[$nutritionName] = $nutritionMealSum[$nutritionName] + $food_nutrition->nutritions->$nutritionName;
						}
					}
					$energyLog[$key]["breakfastSnack"]  = $nutritionMealSum;
				}

				if(isset($value['lunch'])){
					$nutritionMealSum = [];
					foreach($nutritionColumns as $columnName){
						$nutritionMealSum[$columnName] = 0;
					};
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
						$food_nutrition = Food::find($lunchFood);
						foreach($nutritionColumns as $nutritionName){
							$nutritionMealSum[$nutritionName] = $nutritionMealSum[$nutritionName] + $food_nutrition->nutritions->$nutritionName;
						}
					}
					$energyLog[$key]["lunch"]  = $nutritionMealSum;
				}

				if(isset($value['lunchSnack'])){
					$nutritionMealSum = [];
					foreach($nutritionColumns as $columnName){
						$nutritionMealSum[$columnName] = 0;
					};
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
						$food_nutrition = Food::find($lunchSnackFood);
						foreach($nutritionColumns as $nutritionName){
							$nutritionMealSum[$nutritionName] = $nutritionMealSum[$nutritionName] + $food_nutrition->nutritions->$nutritionName;
						}
					}
					$energyLog[$key]["lunchSnack"]  = $nutritionMealSum;
				}
			}


		foreach($energyLog as $logPerDate){
			$mealDate = $logPerDate['mealdate'];

			if(isset($logPerDate['breakfast'])){
				$data = $logPerDate['breakfast']; 
				$data['meal_code'] = 1;
				$data['food_type'] = 1;
				$data['meal_date'] = $mealDate;
				$data['school_id'] = $schoolId;
				$logExists = EnergyLogs::where('meal_date', $mealDate)->where('meal_code', 1)->exists();
				if($logExists){
					EnergyLogs::where('meal_date', $mealDate)->where('meal_code', 1)->update($data);
				}else{
					EnergyLogs::create(
						$data
					);
				}
			}

			if(isset($logPerDate['breakfastSnack'])){
				$data = $logPerDate['breakfastSnack']; 
				$data['meal_code'] = 2;
				$data['food_type'] = 1;
				$data['meal_date'] = $mealDate;
				$data['school_id'] = $schoolId;
				$logExists = EnergyLogs::where('meal_date', $mealDate)->where('meal_code', 2)->exists();
				if($logExists){
					EnergyLogs::where('meal_date', $mealDate)->where('meal_code', 2)->update($data);
				}else{
					EnergyLogs::create(
						$data
					);
				}
			}

			if(isset($logPerDate['lunch'])){
				$data = $logPerDate['lunch']; 
				$data['meal_code'] = 3;
				$data['food_type'] = 1;
				$data['meal_date'] = $mealDate;
				$data['school_id'] = $schoolId;
				$logExists = EnergyLogs::where('meal_date', $mealDate)->where('meal_code', 3)->exists();
				if($logExists){
					EnergyLogs::where('meal_date', $mealDate)->where('meal_code', 3)->update($data);
				}else{
					EnergyLogs::create(
						$data
					);
				}
			}

			if(isset($logPerDate['lunchSnack'])){
				$data = $logPerDate['lunchSnack']; 
				$data['meal_code'] = 4;
				$data['food_type'] = 1;
				$data['meal_date'] = $mealDate;
				$data['school_id'] = $schoolId;
				$logExists = EnergyLogs::where('meal_date', $mealDate)->where('meal_code', 4)->exists();
				if($logExists){
					EnergyLogs::where('meal_date', $mealDate)->where('meal_code', 4)->update($data);
				}else{
					EnergyLogs::create(
						$data
					);
				}
			}
		}

		return response()->json(['success' => 'บันทึกสำรับอาหารเสร็จเรียบร้อย']);
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

	public function filterIngredient(Request $request){
		

		$input= $request -> all();
		Debugbar::info($input);
		$foodFilter = [];
		$filterInput = [];
		$allFilter = array();		
		
		//check if have filterSelected from user  
		if(isset($input['filterSelected'])){
			$filterInput = $input['filterSelected'];
		}
		
		//check if have filter by meat from user
		if(isset($filterInput['meat'])){
			foreach($filterInput['meat'] as $meatFilter){
				array_push($allFilter, intval($meatFilter));
			}
		}

		//check if have filter by vegetabel from user
		
		if(isset($filterInput['vegetable'])){
			foreach($filterInput['vegetable'] as $vegetableFilter){
				array_push($allFilter, intval($vegetableFilter));
			}
		}

		//check if have filter by protein from user

		if(isset($filterInput['protein'])){
			foreach($filterInput['protein'] as $proteinFilter){
				array_push($allFilter, intval($proteinFilter));
			}
		}

		if(isset($filterInput['fruit'])){
			foreach($filterInput['fruit'] as $proteinFilter){
				array_push($allFilter, intval($proteinFilter));
			}
		}


		

		//get food_id that filter 
		$filter = FoodIngredient::whereIn('ingredient_id', $allFilter)->get();	
		$foodId = array();


		foreach(	$filter as $food){
			array_push($foodId, $food->food_id);
		}

		//checke if have filter return food that filtered 
		//in case of not have any filted will return all food --> set by default 
		if(isset($input['filterSelected'])){
			$foodFilter = Food::whereIn('id', $foodId)->get();	
		}else{
			$foodFilter = Food::all();
		}
		foreach($foodFilter as $food)
        {
            $food->init();
				}
				
		return view('mealplan.filterresult', ['foodList' => $foodFilter]);	
	}

}
function getLastLogs($userId,$weekStartDate,$weekEndDate){
		$lastLog = DB::select('
			SELECT food_logs.food_id, food_logs.meal_code, foods.food_thai, food_logs.meal_date, 
			nutritions.energy, nutritions.protein, nutritions.fat
			FROM food_logs 
			LEFT JOIN foods on food_logs.food_id = foods.id 
			LEFT JOIN nutritions on food_logs.food_id = nutritions.food_id 
			WHERE user_id = ? &&  food_logs.meal_date BETWEEN ? AND ?', 
			[$userId, $weekStartDate, $weekEndDate]);
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


