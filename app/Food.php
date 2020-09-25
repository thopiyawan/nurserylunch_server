<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Food extends Model
{
    protected $table = 'foods';
    //

    public function food_logs(){
        return $this->hasMany(FoodLogs::class);
    }
}
