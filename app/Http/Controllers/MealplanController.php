<?php
namespace App\Http\Controllers;						// Location of file

use App\Ingredient;
use App\IngredientGroup;										// Import other classes
use App\Http\Controllers\Controller;
use App\Food;
use App\FoodLogs;
use Illuminate\Http\Request;
use Datetime;
use Debugbar;
use DB;
class MealplanController extends Controller				// Define the class name
{
	
	public function showPlan()
	{
		$userId = auth()->user()->id;
		$foodLogs = getLastLogs($userId);
		Debugbar::info($foodLogs);
		return view('mealplan.showplan', ['logs' => $foodLogs]);
	}
	public function editPlan()							// Define the method name
    {
				$userId = auth()->user()->id;
				$in_groups = IngredientGroup::all();        
				$schoolId = auth()->user()->school_id;
				$foods = Food::all();
				$foodLogs = getLastLogs($userId);
        return view('mealplan.editplan', ['in_groups' => $in_groups, 'foodList' => $foods, 'food_logs' => $foodLogs]);	// Return response to client
		}
		public function addFood(Request $request)
	{
		date_default_timezone_set("Asia/Bangkok");
		$userId = auth()->user()->id;
		$schoolId = auth()->user()->school_id;
		$input = $request->all();	
		$mealPlanData = $input['mealPlanData'];

		foreach($mealPlanData as $key => $value){
			//for each property in mealplan data
			Debugbar::info($value);
			if(isset($value['mealDate'])){
				$date = new DateTime($value['mealDate']);
				$mealDate = $date->format('Y-m-d');
				$deletedRows = FoodLogs::where('meal_date', $mealDate)->delete();
				foreach ($value['breakfastSnack'] as $pos_breakfast => $breakfast_food) {
					Debugbar::info($breakfast_food);
					FoodLogs::create(
								[
									'meal_code' => 2,
									'item_position' => $key,
									'food_id' => $breakfast_food,
									'user_id' => $userId,
									'meal_date' => $mealDate,
									"food_type" => 1,
									"school_id" => $schoolId
								]
							);
				
				}

				foreach ($value['lunch'] as $pos_lunch => $lunch_food) {
					Debugbar::info($lunch_food);
					FoodLogs::create(
						[
							'meal_code' => 3,
							'item_position' => $key,
							'food_id' => $lunch_food,
							'user_id' => $userId,
							'meal_date' => $mealDate,
							"food_type" => 1,
							"school_id" => $schoolId
						]
					);
				}
	







			}else{
					return response()->json(['success' => 'error insert food']);
			}
			// Debugbar::info(isset($value['mealDate']));			
			// Debugbar::info(isset($value['breakfast']));			
			// Debugbar::info(isset($value['breakfastSnack']));			
			// Debugbar::info(isset($value['lunch']));			
			// Debugbar::info(isset($value['lunchSnack']));			
		}
		// $date = new DateTime($input['date']);
		// $meal_date = $date->format('Y-m-d');
		// $deletedRows = FoodLogs::where('meal_date', $meal_date)->delete();

	
		
		// foreach ($input['morning'] as $key => $value) {
		// 	FoodLogs::create(
		// 		[
		// 			'meal_code' => 1,
		// 			'item_position' => $key,
		// 			'food_id' => $value,
		// 			'user_id' => $userId,
		// 			'meal_date' => $meal_date,
		// 			"food_type" => 1,
		// 			"school_id" => $schoolId
		// 		]
		// 	);
		// };
		return response()->json(['success' => 'Insert into food log done']);
	}
}


function getLastLogs($userId)
{
	$lastLog = DB::select('SELECT foods.id, foods.food_thai FROM food_logs inner join foods on foods.id = food_logs.food_id where food_logs.created_at = (SELECT max(food_logs.created_at) FROM food_logs) && user_id = ? ORDER BY food_logs.item_position', [$userId]);
	return $lastLog;
}