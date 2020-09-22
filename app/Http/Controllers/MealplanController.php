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
				$in_groups = IngredientGroup::all();        
				$schoolId = auth()->user()->school_id;
				$foods = Food::all();
        return view('mealplan.editplan', ['in_groups' => $in_groups, 'foodList' => $foods]);	// Return response to client
		}
		public function addFood(Request $request)
	{
		date_default_timezone_set("Asia/Bangkok");
		$input = $request->all();	
		$date = new DateTime($input['date']);
		$meal_date = $date->format('Y-m-d');
		$userId = auth()->user()->id;
		foreach ($input['morning'] as $key => $value) {
			FoodLogs::create(
				[
					'meal_code' => 1,
					'item_position' => $key,
					'food_id' => $value,
					'user_id' => $userId,
					'meal_date' => $meal_date,
					"food_type" => 1
				]
			);
		};
		return response()->json(['success' => 'Insert into food log done']);
	}
}


function getLastLogs($userId)
{
	$lastLog = DB::select('SELECT foods.id, foods.food_thai FROM food_logs inner join foods on foods.id = food_logs.food_id where food_logs.created_at = (SELECT max(food_logs.created_at) FROM food_logs) && user_id = ? ORDER BY food_logs.item_position', [$userId]);
	return $lastLog;
}