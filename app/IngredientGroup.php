<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IngredientGroup extends Model
{
    //

    public function contains(){
    	
    	return $this->hasMany(Ingredient::class)->get();
    }
}
