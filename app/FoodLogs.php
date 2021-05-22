<?php

namespace App;
use DB;
use App\Setting;
use App\Food;

use Illuminate\Database\Eloquent\Model;

class FoodLogs extends Model

{   
    protected $fillable = [
        'meal_date', 'food_id', 'meal_code', 'item_position', 'food_type', 'user_id', 'school_id'
    ];
    public function food(){
        return $this->hasOne(Food::class, 'id', 'food_id');
    }
    public function getMealName()
    {
    	return Setting::getMealName($this->meal_code);
    }
    public static function getFoodLogs()
    {
        $logs = FoodLogs::all();
        return $logs;
    }
    public static function getLogsForMaterial($schoolId, $startDate,$endDate)
    {
    	$logs = getLogsByDates($schoolId, $startDate,$endDate, 'all');
        return $logs;
    }
    public static function getLogsByDatesAndAge($schoolId, $startDate,$endDate, $age){
        $logs = getLogsByDates($schoolId, $startDate,$endDate, $age);
        return $logs;
    }

    // public static function getMinMaxAge($food_type)
    // {
    // 	$min_max = ['min'=>6, 'min'=>12];
    // 	return $min_max;
    // }
    public function getFoodTypeAgeThai(){
    	return Setting::getFoodTypeAgeThai($this->food_type);
    }
    public function getFoodTypeName(){
    	return Setting::getFoodTypeName($this->food_type);
    }

}


function getLogsByDates($schoolId, $startDate,$endDate, $age){
    $foodTypeList = range(8,35);
    if($age == 'all'){
        $foodTypeList = range(8,35);
    }elseif ($age == 'small'){
        $foodTypeList = range(8,21);
    }elseif ($age == 'big'){
        $foodTypeList = range(22,35);
    }
	$logs = FoodLogs::leftJoin('foods', function($join) {
	      $join->on('food_logs.food_id', '=', 'foods.id');
	    })
    	->leftJoin('setting_description', function($join) {
	      $join->on('food_logs.food_type', '=', 'setting_description.id');
	    })
		->where('food_logs.school_id', $schoolId)
		->whereBetween('food_logs.meal_date', [$startDate, $endDate])
        ->whereIn('food_logs.food_type', $foodTypeList)
		->orderBy('food_logs.meal_date', 'asc')
		->orderBy('food_logs.meal_code', 'asc')
		->orderBy('food_logs.food_type', 'asc')
		->get();

    return $logs;
}



//LEFT JOIN setting_description on food_logs.food_type = setting_description.id 

