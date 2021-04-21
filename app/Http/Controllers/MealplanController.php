<?php
namespace App\Http\Controllers;						// Location of file
use App\Ingredient;
use App\IngredientGroup;										// Import other classes
use App\Http\Controllers\Controller;
use App\Food;
use App\FoodIngredient;
use App\FoodLogs;
use App\Setting;
use App\School;
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
		$school = School::find(auth()->user()->school_id);
		return view('mealplan.showplan', ['school' => $school]);
	}

	public function editPlan(Request $request)					
    {
		$schoolId = auth()->user()->school_id;
		$school = School::find($schoolId);
		
		$startDate =  $request->session()->get('startDateOfWeek');
		$endDate = $request->session()->get('endDateOfWeek');
		$inputFoodType = $request->session()->get('inputFoodType');

		$in_groups = IngredientGroup::all();        
		$foods = Food::orderBy('id', 'asc')->paginate(10);
		foreach($foods as $food){
            $food->init();
        }
		
		$selectedAge = $inputFoodType == 8 ? 'small' : 'big';
		$targetNutrition = getTargetNutrition($school, $selectedAge);
		$selectedFoodTypes = $school->getSelectedFoodTypesByAge($selectedAge);
		$foodLogs = FoodLogs::getLogsByDatesAndAge($schoolId, $startDate,$endDate, $selectedAge);

		$selectedDates = $school->getSelectedDates($startDate);


    return view('mealplan.editplan', ['in_groups' => $in_groups, 'foodList' => $foods, 'food_logs' => $foodLogs, 'selectedDates'=> $selectedDates,  'selectedFoodTypes' => $selectedFoodTypes, 'school' => $school,'targetNutrition' => $targetNutrition]);	
	}


	public function dateSelect(Request $request)
	{
		$schoolId = auth()->user()->school_id;
		$school = School::find($schoolId);
		$userSetting = $school->setting;

		$input = $request->all();
		$view = $input['view'];
		$startDate = (new DateTime($input['date']['startDate']))->format('Y-m-d');
		$endDate = (new DateTime($input['date']['endDate']))->format('Y-m-d');
		$inputFoodType = isset($input['foodType'])? $input['foodType'] : 0;
		$request->session()->put('startDateOfWeek', $startDate);
		$request->session()->put('endDateOfWeek', $endDate);
		$request->session()->put('inputFoodType', $inputFoodType);

		$selectedAge = $inputFoodType == 8? 'small' : 'big'; 
		$foodLogs = FoodLogs::getLogsByDatesAndAge($schoolId, $startDate,$endDate, $selectedAge);
		$selectedDates = $school->getSelectedDates($startDate);
		$selectedFoodTypes = $school->getSelectedFoodTypesByAge($selectedAge);
		
		$returnView = $view == "nutritionreport" ? "report.nutritionData" : "mealplan.mealpanel";

		return view($returnView , ['logs'=>$foodLogs, 'school'=>$school, 'selectedDates'=>$selectedDates, 'selectedFoodTypes' => $selectedFoodTypes]);
	}

	

	public function addFood(Request $request)
	{
			date_default_timezone_set("Asia/Bangkok");
			$userId = auth()->user()->id;
			$schoolId = auth()->user()->school_id;
			$input = $request->all();	
			$mealPlanData = $input['mealPlanData'];
			$nutritionColumns = (new EnergyLogs)->getTableColumns();
			$nutritionColumns = array_diff($nutritionColumns, ['id', 'meal_code', 'food_type', 'meal_date', 'school_id', 'created_at', 	'updated_at']);
			$energyLog = [];


			foreach($mealPlanData as $key => $value){
				//$date = new DateTime($value['mealDate']);
				$mealDate = (new DateTime($value['mealDate']))->format('Y-m-d');
				$foodType = $value['food_type'];

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

			EnergyLogs::where([['meal_date', $mealDate], ['food_type', $foodType]])->delete();

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


	public function checkFoodType(Request $request){
		$input = $request->all();
		$foodId = $input['foodId'];
		$checkType = $input['checkType'];

		$setting = SettingDescription::select('setting_property_name')->where('setting_id', $checkType)->get();
		$setting_name = $setting[0]->setting_property_name;

		$safeData = Propertie::select($setting_name)->where('food_id', $foodId)->get();
		$safe = $safeData[0][$setting_name];
		
		return $safe;
	}

	public function filterIngredient(Request $request)
	{
		$input= $request -> all();
		$query = $request->get('query');
		$filters = $request->get('filters');
		
		$results = Food::leftJoin('food_ingredient', function($join) {
				      $join->on('foods.id', '=', 'food_ingredient.food_id');
				    })->where('foods.food_thai', 'like','%'.$query.'%');
		if(isset($filters)){
			$results = $results->whereIn('food_ingredient.ingredient_id', $filters);
		}

		$results = $results->paginate(10);
					
		foreach($results as $food){
			$food->init();
		}

		if($results->isEmpty()){
			$results = "ไม่พบรายการอาหารที่ค้นหา";
		}
		return view('mealplan.filterresult', ['foodList' => $results]);	
	}
}

function getTargetNutrition($school, $age, $isForFullWeek = false){

	$targetNutrition = Nutrition::getDriByAge($school, $age, $isForFullWeek);
	return $targetNutrition;
}