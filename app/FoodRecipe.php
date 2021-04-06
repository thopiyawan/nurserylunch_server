<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Composition;

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
    
}
