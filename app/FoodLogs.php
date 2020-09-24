<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FoodLogs extends Model

{
    protected $table = 'food_logs';
    //
    
    protected $fillable = [
        'meal_date', 'food_id', 'meal_code', 'item_position', 'food_type', 'user_id', 'school_id'
    ];
}
