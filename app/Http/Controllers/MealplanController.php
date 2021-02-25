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
use App\Propertie;
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
		$schoolId = auth()->user()->school_id;
		$userSetting = Setting::find($schoolId);
		$now = Carbon::now();
		$weekStartDate = $now->startOfWeek()->format('Y-m-d');
		$weekEndDate = $now->endOfWeek()->format('Y-m-d');
		if($startDate && $endDate){
			$weekStartDate  = $startDate;
			$weekEndDate = $endDate;
		}
		dateInweek($weekStartDate);
		// $foodLogs = getLastLogs($userId, $weekStartDate, $weekEndDate);
		$dayInweek = dateInweek($weekStartDate);
		
		return view('mealplan.showplan', ['dayInweek' => $dayInweek, 'userSetting' => $userSetting]);
	}
	public function editPlan(Request $request)							// Define the method name
    {
		$userId = auth()->user()->id;
		$schoolId = auth()->user()->school_id;
		$userSetting = Setting::find($schoolId ); 
		$settingDescription = SettingDescription::all();

		$data = $request->session()->all();
		$now = Carbon::now();
		$weekStartDate =  $request->session()->get('startDateOfWeek');
		$weekEndDate = $request->session()->get('endDateOfWeek');
		$inputFoodType = $request->session()->get('inputFoodType');
		//Debugbar::info("food type".$inputFoodType);
		//$inputFoodType = 8;
		$mealSetting = array(
			array(1, "เช้า", $userSetting->is_breakfast, "breakfast-meal"), 
			array(2, "ว่างเช้า", $userSetting->is_morning_snack, "breakfast-snack-meal"), 
			array(3, "กลางวัน", $userSetting->is_lunch, "lunch-meal"), 
			array(4, "ว่างบ่าย", $userSetting->is_afternoon_snack, "lunch-snack-meal"), 
		);
		$in_groups = IngredientGroup::all();        
		$schoolId = auth()->user()->school_id;
		$foods = Food::orderBy('id', 'asc')->paginate(10);
		foreach($foods as $food)
        {
            $food->init();
        }
		$foodLogs = getLastLogs($userId, $weekStartDate, $weekEndDate, $inputFoodType);
		$dayInweek = dateInweek($weekStartDate);

		$targetNutrition = getTargetNutrition($userSetting);
		
		$userSettingArray = $userSetting->toArray();
		$userSettingArray = array_slice($userSettingArray, 11);
		$settings_enable = array();

	
		foreach($settingDescription as $key => $val){
			//[description id  for foodtype in food log, value]
			if(isset($userSettingArray[$val->setting_description_english])){
				$settings_enable[$val->setting_description_english] = ["food_type" => $key + 1, "value" => $userSettingArray[$val->setting_description_english], "setting_description_thai" => $val->setting_description_thai];
			}
		}
		

		//$selectedAge = "is_for_small"; 
		$settings = array();
		$setting_small_key = array('is_s_muslim', 'is_s_vege', 
		'is_s_vegan', 'is_s_milk', 'is_s_breastmilk', 'is_s_egg', 'is_s_wheat',
		'is_s_shrimp', 'is_s_shell', 'is_s_crab', 'is_s_fish', 'is_s_peanut', 'is_s_soybean');

		$setting_big_key = array('is_b_muslim', 'is_b_vege', 
		'is_b_vegan', 'is_b_milk', 'is_b_breastmilk', 'is_b_egg', 'is_b_wheat',
		'is_b_shrimp', 'is_b_shell', 'is_b_crab', 'is_b_fish', 'is_b_peanut', 'is_b_soybean');


		$setting_for_small = array("is_for_small" => ["food_type" => 8, 'setting_description_thai' => "ต่ำกว่า 1 ปี (ปกติ)"]);
		$setting_for_big = array("is_for_big" => ["food_type" => 22, 'setting_description_thai' => "1-3 ปี (ปกติ)"]);


		if($inputFoodType == 8){
			$settings = $setting_for_small;
			foreach($setting_small_key as $value){
				$setting_value = $settings_enable[$value];
				if($setting_value['value'] == 1){
					$temp = array();
					$temp['food_type'] = $setting_value['food_type'];
					$temp['setting_description_thai'] = 'ต่ำกว่า 1 ปี ('.$setting_value['setting_description_thai'] . ')';
					$settings[$value] = $temp;
					
				}
			}
		}else if($inputFoodType == 22){
			$settings = $setting_for_big;
			foreach($setting_big_key as $value){
				$setting_value = $settings_enable[$value];
				if($setting_value['value'] == 1){
					$temp = array();
					$temp['food_type'] = $setting_value['food_type'];
					$temp['setting_description_thai'] = '1-3 ปี ('.$setting_value['setting_description_thai'] . ')';
					$settings[$value] = $temp;
				}
			}
		}
    return view('mealplan.editplan', ['in_groups' => $in_groups, 'foodList' => $foods, 'food_logs' => $foodLogs, 'dayInweek'=> $dayInweek, 'userSetting' => $userSetting, 'settings' => $settings, 'mealSetting' => $mealSetting,'targetNutrition' => $targetNutrition]);	
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
			//Debugbar::info($mealPlanData);

			foreach($mealPlanData as $key => $value){
				$date = new DateTime($value['mealDate']);
				$mealDate = $date->format('Y-m-d');
				$foodType = $value['food_type'];

				//$deletedRows = FoodLogs::where('meal_date', $mealDate)->delete();
				FoodLogs::where([['meal_date', $mealDate], ['food_type', $foodType]])->delete();
				$dateEnergy = ["mealdate" => $mealDate];
				array_push($energyLog, $dateEnergy);
				$energyLog[$key]["foodtype"] = $foodType;
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
										"food_type" => $foodType,
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
										"food_type" => $foodType,
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
										"food_type" => $foodType,
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
										"food_type" => $foodType,
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
			$foodType = $logPerDate['foodtype'];

			if(isset($logPerDate['breakfast'])){
				$data = $logPerDate['breakfast']; 
				$data['meal_code'] = 1;
				$data['food_type'] = $foodType;
				$data['meal_date'] = $mealDate;
				$data['school_id'] = $schoolId;
				$logExists = EnergyLogs::where('meal_date', $mealDate)->where('meal_code', 1)->where('food_type', $foodType)->exists();
				if($logExists){
					EnergyLogs::where('meal_date', $mealDate)->where('meal_code', 1)->where('food_type', $foodType)->update($data);
				}else{
					EnergyLogs::create(
						$data
					);
				}
			}

			if(isset($logPerDate['breakfastSnack'])){
				$data = $logPerDate['breakfastSnack']; 
				$data['meal_code'] = 2;
				$data['food_type'] = $foodType;
				$data['meal_date'] = $mealDate;
				$data['school_id'] = $schoolId;
				$logExists = EnergyLogs::where('meal_date', $mealDate)->where('meal_code', 2)->where('food_type', $foodType)->exists();
				if($logExists){
					EnergyLogs::where('meal_date', $mealDate)->where('meal_code', 2)->where('food_type', $foodType)->update($data);
				}else{
					EnergyLogs::create(
						$data
					);
				}
			}

			if(isset($logPerDate['lunch'])){
				$data = $logPerDate['lunch']; 
				$data['meal_code'] = 3;
				$data['food_type'] = $foodType;
				$data['meal_date'] = $mealDate;
				$data['school_id'] = $schoolId;
				$logExists = EnergyLogs::where('meal_date', $mealDate)->where('meal_code', 3)->where('food_type', $foodType)->exists();
				if($logExists){
					EnergyLogs::where('meal_date', $mealDate)->where('meal_code', 3)->where('food_type', $foodType)->update($data);
				}else{
					EnergyLogs::create(
						$data
					);
				}
			}

			if(isset($logPerDate['lunchSnack'])){
				$data = $logPerDate['lunchSnack']; 
				$data['meal_code'] = 4;
				$data['food_type'] = $foodType;
				$data['meal_date'] = $mealDate;
				$data['school_id'] = $schoolId;
				$logExists = EnergyLogs::where('meal_date', $mealDate)->where('meal_code', 4)->where('food_type', $foodType)->exists();
				if($logExists){
					EnergyLogs::where('meal_date', $mealDate)->where('meal_code', 4)->where('food_type', $foodType)->update($data);
				}else{
					EnergyLogs::create(
						$data
					);
				}
			}
		}

		return response()->json(['success' => 'บันทึกสำรับอาหารเสร็จเรียบร้อย']);

	}

	public function getNutritionData(Request $request)
	{
		// sleep(1);
		$userId = auth()->user()->id;
		$schoolId = auth()->user()->school_id;
		$userSetting = Setting::find($schoolId);

		$now = Carbon::now();
		$input = $request->all();
		$inputStartDate = $input['date']['startDate'];
		$inputEndDate = $input['date']['endDate'];
		$inputFoodType = $input['foodType'];

		$startDate = (new Datetime($inputStartDate))->format('Y-m-d');
		$endDate = (new Datetime($inputEndDate))->format('Y-m-d');
		Debugbar::info($startDate, $endDate, $inputFoodType);

		$logs = EnergyLogs::where([
			['school_id', "=", $schoolId],
			['food_type', "=", $inputFoodType],
			['meal_date', ">=", $startDate],
			['meal_date', "<=", $endDate]
		])->get();
		$sumEnergy = $logs->sum('energy');
		$sumProtein = $logs->sum('protein');
		$sumFat = $logs->sum('fat');
		$sumCarbohydrate = $logs->sum('carbohydrate');

		// 1g of carbohydrates = 4 kCal · 1 g of protein = 4 kCal · 1 g of fat = 9 kCal ·

		$nutritions = array(
			"energy" => array($sumEnergy, "none"),
			"protein" => array($sumProtein, "none"),
			"fat" => array($sumFat, "none"),
			"carbohydrate" => array($sumCarbohydrate, "none"),
		);

		$multiplier = 5;
		$targetNutrition = getTargetNutrition($userSetting, $multiplier);
		// Debugbar::info("target---");
		// Debugbar::info($targetNutrition);

		
		foreach ($nutritions as $key => $value) {
			$grade = "none";
			$sum = floatval($value[0]);
			$driScale = ($key == "carbohydrate") ? $targetNutrition[$key."_full"] : $targetNutrition[$key];

			// Debugbar::info($key);
			// Debugbar::info($sum);
			// Debugbar::info($driScale);
			// Debugbar::info(floatval($driScale[3]));
			// Debugbar::info($sum > $driScale[3]);

			if ($sum >= floatval($driScale[3])){
				Debugbar::info("in high");
                $grade = "toohigh";
            } else if ($sum >= (float)$driScale[2]) {
                $grade = "high";
            } else if ($sum >= (float)$driScale[1]) {
                $grade = "ok";
            } else if ($sum >= (float)$driScale[0]) {
                $grade = "low";
            } else{
                $grade = "toolow";
            }
            Debugbar::info($grade);
            
            $nutritions[$key][1] = $grade;
		}

		return $nutritions;
		
	}


	public function dateSelect(Request $request)
	{
		// Debugbar::info("dateselect---");
		$userId = auth()->user()->id;
		$schoolId = auth()->user()->school_id;
		$userSetting = Setting::find($schoolId);
		$now = Carbon::now();


		$input = $request->all();
		$inputStartDate = $input['date']['startDate'];
		$inputEndDate = $input['date']['endDate'];
		//$inputFoodType = 8;
		$inputFoodType = $input['foodType'];
		$view = $input['view'];
		// Debugbar::info("dateselect".$inputFoodType);

		$startDate = new DateTime($inputStartDate);
		$endDate = new DateTime($inputEndDate);
		$startDate = $startDate->format('Y-m-d');
		$endDate = $endDate->format('Y-m-d');
		$request->session()->put('startDateOfWeek', $startDate);
		$request->session()->put('endDateOfWeek', $endDate);
		$request->session()->put('inputFoodType', $inputFoodType);

		$in_groups = IngredientGroup::all();        
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

		$returnView = ($view == "meal") ? "mealplan.mealpanel" : "report.mealpanel";
		return view($returnView , ['logs' => $foodLogs, 'mealSetting' => $mealSetting, 'dateData' => $dateData,  'dayInweek' => $dayInweek, 'userSetting' => $userSetting]);
	}

	public function checkFoodType(Request $request){
		$input = $request->all();
		$foodId = $input['foodId'];
		$checkType = $input['checkType'];

		$setting = SettingDescription::select('setting_property_name')->where('setting_id', $checkType)->get();
		$setting_name = $setting[0]->setting_property_name;
		// Debugbar::info("setting". $setting);
		// Debugbar::info("property name".$setting[0]->setting_property_name);
		$safeData = Propertie::select($setting_name)->where('food_id', $foodId)->get();
		$safe = $safeData[0][$setting_name];
	
		
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

function getTargetNutrition($userSetting, $multiplier = 1){

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


	$baseDri = array(
		"energy" => 645 * $percentageOfEnergy * $multiplier, 
		"protein" => 12.55 * $percentageOfEnergy * $multiplier,  
		"fat" => 25.08 * $percentageOfEnergy * $multiplier, 
		"carbohydrate" => 110 * $percentageOfEnergy * $multiplier, 
		"vitamin_a" => 250 * $percentageOfEnergy * $multiplier, 
		"vitamin_b1" => 0.3 * $percentageOfEnergy * $multiplier, 
		"vitamin_b2" => 0.4 * $percentageOfEnergy * $multiplier, 
		"vitamin_c" => 50 * $percentageOfEnergy * $multiplier, 
		"iron" => 9 * $percentageOfEnergy * $multiplier, 
		"calcium" => 260 * $percentageOfEnergy * $multiplier, 
		"phosphorus" => 275 * $percentageOfEnergy * $multiplier, 
		"fiber" => 0 * $percentageOfEnergy * $multiplier, 
		"sodium" => 0 * $percentageOfEnergy * $multiplier, 
		"sugar" => 0 * $percentageOfEnergy * $multiplier, 
	);

	$energyCondition = array(
		number_format($baseDri["energy"] * 0.5, 0, '.',''),
		number_format($baseDri["energy"], 0, '.',','),
		number_format($baseDri["energy"] * 1.5, 0, '.',''),
		number_format($baseDri["energy"] * 2.0, 0, '.','')
	);
	$proteinCondition = array(
		number_format($baseDri["protein"] * 0.5, 1, '.',''),
		number_format($baseDri["protein"], 1, '.',''),
		number_format($baseDri["protein"] * 1.5, 1, '.',''),
		number_format($baseDri["protein"] * 2.0, 1, '.','')
	);
	$fatCondition = array(
		number_format($baseDri["fat"] * 0.5, 1, '.',''),
		number_format($baseDri["fat"], 1, '.',''),
		number_format($baseDri["fat"] * 1.5, 1, '.',''),
		number_format($baseDri["fat"] * 2.0, 1, '.','')
	);
	$carbCondition = array(
		number_format($baseDri["carbohydrate"] * 0.5, 1, '.',''),
		number_format($baseDri["carbohydrate"], 1, '.',''),
		number_format($baseDri["carbohydrate"] * 1.5, 1, '.',''),
		number_format($baseDri["carbohydrate"] * 2.0, 1, '.','')
	);

	$targetNutrition = array(
		'energy' => $energyCondition,
		'protein' => $proteinCondition,
		'fat' => $fatCondition,
		"carbohydrate_full" => $carbCondition, 
		"carbohydrate" => array($baseDri["carbohydrate"] * 0.5, $baseDri["carbohydrate"]*1.5), 
		"vitamin_a" => array($baseDri["vitamin_a"] * 0.5, $baseDri["vitamin_a"]*1.5),
		"vitamin_b1" => array($baseDri["vitamin_b1"] * 0.5, $baseDri["vitamin_b1"]*1.5),
		"vitamin_b2" => array($baseDri["vitamin_b2"] * 0.5, $baseDri["vitamin_b2"]*1.5),
		"vitamin_c" => array($baseDri["vitamin_c"] * 0.5, $baseDri["vitamin_c"]*1.5),
		"iron" => array($baseDri["iron"] * 0.5, $baseDri["iron"]*1.5),
		"calcium" => array($baseDri["calcium"] * 0.5, $baseDri["calcium"]*1.5),
		"phosphorus" => array($baseDri["phosphorus"] * 0.5, $baseDri["phosphorus"]*1.5),
		"fiber" => array($baseDri["fiber"] * 0.5, $baseDri["fiber"]*1.5),
		"sodium" => array($baseDri["sodium"] * 0.5, $baseDri["sodium"]*1.5),
		"sugar" => array($baseDri["sugar"] * 0.5, $baseDri["sugar"]*1.5),
	);

	return $targetNutrition;
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


