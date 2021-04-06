<?php

namespace App;
use Debugbar;
use Illuminate\Support\Arr;

use Illuminate\Database\Eloquent\Model;
use LaravelPropertyBag\Settings\HasSettings;
class School extends Model
{
    //
    use HasSettings;
    public function setting(){
        return $this->hasOne(Setting::class);
    }

    public function users(){
        return $this->hasMany(User::class);
    }

    public function classrooms(){
        return $this->hasMany(Classroom::class);
    }

    public function kids(){
        return $this->hasMany(Kid::class);
    }

    public function foodLogห(){
        return $this->hasMany(FoodLogs::class);
    }

    public function energyLog(){
        return $this->hasMany(EnergyLogs::class);
    }
    public function getServings(){
        $selectedTypes = $this->getSelectedFoodTypes();
        $kids = $this->kids()->get();
        $smallCount = 0;
        $bigCount = 0;
        $kelly = 0;
        $servings = [];
        foreach ($selectedTypes as $key) {
            $servings[$key] = 0;
        }
        foreach ($kids as $k) {
            if($k->isSmall()){
                // $smallCount++;
                $servings[8] += 1;
                $restrictions = $k->getRestrictionList();
                foreach ($restrictions as $rest) {
                    $food_type = Setting::getFoodTypeID($rest->detail, "small");
                    if(in_array($food_type, $selectedTypes)){
                       $servings[8] -= 1;
                       $servings[$food_type] += 1;
                    }
                }
            }else{
                $servings[22] += 1;
                $restrictions = $k->getRestrictionList();
                foreach ($restrictions as $rest) {
                    $food_type = Setting::getFoodTypeID($rest->detail, "big");
                    if(in_array($food_type, $selectedTypes)){
                       $servings[22] -= 1;
                       $servings[$food_type] += 1;
                    }
                }
            }
        }
        return $servings;
    }
    public function getSelectedFoodTypes(){
        $setting = Setting::where('school_id', $this->id)->first();
        $selectedTypes = [];
        foreach (Setting::$foodtypes as $key => $type) {
            $key = $type['key'];
            if ($setting->$key == true){
                 $selectedTypes[] = $type['id'];
            }
        }
        return $selectedTypes;
    }

    public function getNumOfSmallKids(){
        $smallCount = 0;
        $bigCount = 0;
        $kids = $this->kids()->get();
        foreach ($kids as $k) {
            if($k->isSmall()){
                $smallCount++;
            }
        }
        return  $smallCount;
    }
}

