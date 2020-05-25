<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    //

    public function belongs(){
    	return $this->belongsTo(IngredientGroup::class);
    }
}
