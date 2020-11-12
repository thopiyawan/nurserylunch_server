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
use App\Properties;
use App\SettingDescription;
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
		
		$madeupAge = "small"; // ต้องแก้ให้ถูก


		$userId = auth()->user()->id;
		$schoolId = auth()->user()->school_id;
		$userSetting = Setting::find($schoolId ); // ทำไมหาด้วย userId?
		$settingDescription = SettingDescription::all();

	

		
		$data = $request->session()->all();
		$now = Carbon::now();
		// $weekStartDate = $now->startOfWeek()->format('Y-m-d');
		// $weekEndDate = $now->endOfWeek()->format('Y-m-d');
		$weekStartDate =  $request->session()->get('startDateOfWeek');
		$weekEndDate = $request->session()->get('endDateOfWeek');

		$in_groups = IngredientGroup::all();        
		$schoolId = auth()->user()->school_id;
		$foods = Food::orderBy('id', 'asc')->paginate(10);
		foreach($foods as $food)
        {
            $food->init();
        }
		$foodLogs = getLastLogs($userId, $weekStartDate, $weekEndDate);
		$dayInweek = dateInweek($weekStartDate);

		#ratio of energy in each meal 
		$condition_nutrition_calulation = array("breakfast" => 0.2, "morningSnack" => 0.1, "lunch" => 0.3, "lunchSnack" => 0.1);
		$percentageOfEnergy = 0;
		#check condition for calulation energy each day from user setting 
		if($userSetting->is_breakfast == 1){
			$percentageOfEnergy += $condition_nutrition_calulation['breakfast'];
		}
		if($userSetting->is_morning_snack == 1){
			$percentageOfEnergy += $condition_nutrition_calulation['morningSnack'];
		}
		if($userSetting->is_lunch == 1){
			$percentageOfEnergy += $condition_nutrition_calulation['lunch'];
		}
		if($userSetting->is_afternoon_snack == 1){
			$percentageOfEnergy += $condition_nutrition_calulation['lunchSnack'];
		}


		$baseLineCondition = array(
			"energy" => 645 * $percentageOfEnergy, 
			"fat" => 25.08 * $percentageOfEnergy , 
			"protein" => 12.55 * $percentageOfEnergy);

		$energyCondition = array(
			$baseLineCondition["energy"] * 0.5,  
			$baseLineCondition["energy"],
			$baseLineCondition["energy"] * 1.5,
			$baseLineCondition['energy'] * 2.0
		);
		$proteinCondition = array(
			$baseLineCondition["protein"] * 0.5,  
			$baseLineCondition["protein"],
			$baseLineCondition["protein"] * 1.5,
			$baseLineCondition['protein'] * 2.0
		);
		$fatCondition = array(
			$baseLineCondition["fat"] * 0.5,  
			$baseLineCondition["fat"],
			$baseLineCondition["fat"] * 1.5,
			$baseLineCondition['fat'] * 2.0
		);

		$targetNutrition = array(
			'energy' => $energyCondition,
			'protein' => $proteinCondition,
			'fat' => $fatCondition,
		);


		$userSettingArray = $userSetting->toArray();
		$userSettingArray = array_slice($userSettingArray, 11);
		$settings_enable = array();

	

		foreach($settingDescription as $key => $val){
			//[description id  for foodtype in food log, value]
			if(isset($userSettingArray[$val->setting_description_english])){
				$settings_enable[$val->setting_description_english] = ["food_type" => $key + 1, "value" => $userSettingArray[$val->setting_description_english], "setting_description_thai" => $val->setting_description_thai];
			}
		}
		



		//define setting for less 1 year 
		$setting_small_key = array('is_s_muslim', 'is_s_vege', 
		'is_s_vegan', 'is_s_milk', 'is_s_breastmilk', 'is_s_egg', 'is_s_wheat',
		'is_s_shrimp', 'is_s_shell', 'is_s_crab', 'is_s_fish', 'is_s_peanut', 'is_s_soybean');

		$setting_big_key = array('is_b_muslim', 'is_b_vege', 
		'is_b_vegan', 'is_b_milk', 'is_b_breastmilk', 'is_b_egg', 'is_b_wheat',
		'is_b_shrimp', 'is_b_shell', 'is_b_crab', 'is_b_fish', 'is_b_peanut', 'is_b_soybean');


		$setting_for_small = array("is_for_small" => ["food_type" => 8, 'setting_description_thai' => "ต่ำกว่า 1 ปี (ปกติ)"]);
		$setting_for_big = array("is_for_big" => ["food_type" => 22, 'setting_description_thai' => "1-3 ปี (ปกติ)"]);




		if($settings_enable['is_for_small']['value'] == 1){
			foreach($setting_small_key as $value){
				$setting_value = $settings_enable[$value];
				if($setting_value['value'] == 1){
					$temp = array();
					$temp['food_type'] = $setting_value['food_type'];
					$temp['setting_description_thai'] = 'ต่ำกว่า 1 ปี ('.$setting_value['setting_description_thai'] . ')';
					$setting_for_small[$value] = $temp;
					
				}
			}
		}

		if($settings_enable['is_for_big']['value'] == 1){
			foreach($setting_big_key as $value){
				$setting_value = $settings_enable[$value];
				if($setting_value['value'] == 1){
					$temp = array();
					$temp['food_type'] = $setting_value['food_type'];
					$temp['setting_description_thai'] = '1-3 ปี ('.$setting_value['setting_description_thai'] . ')';
					$setting_for_big[$value] = $temp;
				}
			}
		}
		
	
		$settings2 = array_merge($setting_for_small, $setting_for_big);
		$settings = array(
			"is_for_small" => "ต่ำกว่า 1 ปี (ปกติ)", 
			"is_s_muslim" => "ต่ำกว่า 1 ปี (มุสลิม)",
			"is_s_shrimp" => "ต่ำกว่า 1 ปี (แพ้กุ้ง)",
		); // ต้องแก้ให้ถูก
		// Debugbar::info($settings);



    return view('mealplan.editplan', ['in_groups' => $in_groups, 'foodList' => $foods, 'food_logs' => $foodLogs, 'dayInweek'=> $dayInweek, 'userSetting' => $userSetting, 'settings' => $settings, 'settings2' => $settings2,'targetNutrition' => $targetNutrition]);	
    	// Return response to client
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
		$foodLogs = getLastLogs($userId, $startDate, $endDate);
		$dayInweek = dateInweek($startDate);
		return view('mealplan.mealpanel', ['logs' => $foodLogs,'dayInweek' => $dayInweek, 'userSetting' => $userSetting]);
	}

	public function checkFoodType(Request $request){
		$input = $request->all();
		$foodId = $input['foodId'];
		$checkType = $input['checkType'];

		$foodItem = Propertie::where('food_id', $foodId)->first();
		$safe = true;
		$allRules = array(
			"is_s_muslim" => "has_pork", 
			"is_s_shrimp" => "has_shirmp"
		);
		$rule = $allRules[$checkType];

		if($foodItem[$rule] == 1){
			$safe = false;
		}


		//$safe = (bool)rand(0,1);
		//$safe = true;

		return $safe;

	}

	public function filterIngredient(Request $request){

		$input= $request -> all();
		$foodFilter = [];
		$filterInput = [];
		$allFilter = array();		
		$foodIdArray = array(); //food array forboth  query
		
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
		$query = $request->get('query');
		$filter = FoodIngredient::whereIn('ingredient_id', $allFilter)->get();	
		$search = Food::where('food_thai', 'like','%'.$query.'%')->get();

		$searchId = array();
		$filterId = array();

		foreach($filter as $food){
			array_push($filterId, $food->food_id);
		}

		foreach($search as $foodQuery){
			array_push($searchId, $foodQuery->id);
		}

		if(isset($input['filterSelected']) && isset($input['query'])){
			$foodIdArray = array_intersect($filterId, $searchId);
		}
		if(isset($input['query']) && !isset($input['filterSelected']) && !is_null($input['query'])){
			$foodIdArray = $searchId;
		}

		if(isset($input['filterSelected']) && is_null($input['query'])){
			$foodIdArray = array_intersect($filterId, $searchId);
			$foodIdArray = $filterId;
		}
		
		//checke if have filter return food that filtered 
		//in case of not have any filted will return all food --> set by default 
		if(count($foodIdArray) > 0){
			$foodFilter = Food::whereIn('id', $foodIdArray)->get();	
			foreach($foodFilter as $food)
			{
					$food->init();
			}
			
		}
		else{
			if(!isset($input['filterSelected']) && !isset($input['query'])){
				$foodFilter = Food::orderBy('id', 'asc')->paginate(10);
			}else{
				$foodFilter = 'ไม่พบอาหารดังกล่าว';
			}
		
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


