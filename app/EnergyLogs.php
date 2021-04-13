<?php

namespace App;
use App\Nutrition;

use Illuminate\Database\Eloquent\Model;

class EnergyLogs extends Model
{
    //
    protected $guarded = [];

    public function school(){
        return $this->belongTo(School::class);
    }

    public function getTableColumns() {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }

    public static function getNutritionData($schoolId, $startDate,$endDate, $age){
    	$data = [];
    	$school = School::find($schoolId);
    	$energyLogs = EnergyLogs::getEnergyLogsByDates($schoolId, $startDate,$endDate, $age);
    	$targetNutrition = Nutrition::getDriByAge($school, $age, true);

    	$data["energy_logs"] = $energyLogs;
    	$data["target_nutrition"] = $targetNutrition;

        return $data;
    }

    public static function getEnergyLogsByDates($schoolId, $startDate,$endDate, $age){
    	$foodTypeList = range(8,35);
	    if($age == 'all'){
	        $foodTypeList = range(8,35);
	    }elseif ($age == 'small'){
	        $foodTypeList = range(8,21);
	    }elseif ($age == 'big'){
	        $foodTypeList = range(22,35);
	    }
		$logs = EnergyLogs::where('school_id', $schoolId)
			->whereBetween('meal_date', [$startDate, $endDate])
	        ->whereIn('food_type', $foodTypeList)
			->get();

		$data = [];
		foreach ($logs as $log) {
			$key = $log["food_type"];
			if(array_key_exists($key, $data)){
				$data[$key]["energy"] += $log["energy"];
				$data[$key]["protein"] += $log["protein"];
				$data[$key]["fat"] += $log["fat"];
				$data[$key]["carbohydrate"] += $log["carbohydrate"];
				$data[$key]["vitamin_a"] += $log["vitamin_a"];
				$data[$key]["vitamin_b1"] += $log["vitamin_b1"];
				$data[$key]["vitamin_b2"] += $log["vitamin_b2"];
				$data[$key]["vitamin_c"] += $log["vitamin_c"];
				$data[$key]["iron"] += $log["iron"];
				$data[$key]["calcium"] += $log["calcium"];
				$data[$key]["phosphorus"] += $log["phosphorus"];
				$data[$key]["fiber"] += $log["fiber"];
				$data[$key]["sodium"] += $log["sodium"];
				$data[$key]["sugar"] += $log["sugar"];

			}else{
				$data[$key] = $log;
			}
		}
    	return $data;
    }

    
}


