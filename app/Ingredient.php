<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    //

    public function ingredientGroup(){
    	return $this->belongsTo(IngredientGroup::class);
    }
}
