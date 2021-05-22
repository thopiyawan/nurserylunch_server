<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Composition;
use App\PurUnit;

class FoodRecipe extends Model
{
    //
    public function composition(){
        return $this->hasOne(Composition::class);
    }

    public function getCompositionName(){
    	//return "kelly";
    	$composition = Composition::where('id', $this->composition_id)->first();
    	return $composition->composition_name;
    }

    public static function getRecipes($food_id){
    	$recipes = FoodRecipe::where('food_id', $food_id)->get();
        return $recipes;
    }

    public function getUnit(){
        return PurUnit::getUnitByID($this->pur_unit_id);

    }
    public function getCookUnit(){
        return PurUnit::getUnitByID($this->cook_unit_id);

    }
    
}
