<?php

namespace App;
use Debugbar;
use Datetime;
use Carbon\Carbon;
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
    public function isForSmall(){
         return $this->setting->is_for_small ==1;
    }
    public function isForBig(){
         return $this->setting->is_for_big ==1;
    }
    public function getNumOfMealsPerDay(){
        $multiplier = 0;
        $multiplier += ($this->setting->is_breakfast)? 0.2:0;
        $multiplier += ($this->setting->is_morning_snack)? 0.1:0;
        $multiplier += ($this->setting->is_lunch)? 0.3:0;
        $multiplier += ($this->setting->is_afternoon_snack)? 0.1:0;
        return $multiplier;
    }
    public function getNumOfDaysPerWeek(){
        $multiplier = 0;
        $multiplier += ($this->setting->is_weekday)? 5:0;
        $multiplier += ($this->setting->is_saturday)? 1:0;
        $multiplier += ($this->setting->is_sunday)? 1:0;
        return $multiplier;
    }
    public function getSelectedDates($startDate){
        $selectedDates = [];
        foreach (range(0,4) as $i) {
            $selectedDates = addDatesToLists($startDate, $selectedDates, $i);
        }
        if($this->setting->is_saturday){
            $selectedDates = addDatesToLists($startDate, $selectedDates, 5);
        }
        if($this->setting->is_sunday){
            $selectedDates = addDatesToLists($startDate, $selectedDates, 6);
        }

        return $selectedDates;
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
        //$setting = Setting::where('school_id', $this->id)->first();
        $setting = $this->setting;
        $selectedTypes = [];
        foreach (Setting::$foodtypes as $key => $type) {
            $key = $type['key'];
            if ($setting->$key == true){
                 $selectedTypes[] = $type['id'];
            }
        }
        return $selectedTypes;
    }

    public function getSelectedFoodTypesByAge($age){
        $setting = $this->setting;

        $selectedTypes = [];
        foreach (Setting::$foodtypes as $key => $type) {
            $key = $type['key'];
            if ($setting->$key == true && $type['age'] == $age){
                 $selectedTypes[$key] = $type;
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

function addDatesToLists($startDate, $selectedDates, $number){
    // $returnDates = $selectedDates;
    $date = new Carbon($startDate);
    $d = $date->addDays($number);
    $selectedDates[] = array(
        'engDay'=>strtolower($d->isoFormat('dddd')), 
        'thDay'=>$d->locale('th')->getTranslatedDayName('dddd'), 
        'date'=>$d->format('Y-m-d'),
        'dateText'=>$d->locale('th')->translatedFormat('d M y')
    );
    return $selectedDates;
}

