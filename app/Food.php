<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Food extends Model
{
    protected $table = 'foods';
    //

    protected $energy;
    protected $protein;
    protected $fat;


     public function init()
    {
    	$nutrition = $this->nutritions;
    	$this->energy = $nutrition->energy;
    	$this->protein = $nutrition->protein;
    	$this->fat = $nutrition->fat;
    }

    public function food_logs(){
        return $this->hasMany(FoodLogs::class);
    }

    public function nutritions(){
        return $this->hasOne(Nutrition::class);
    }

    public function getEnergy()
    {
		return $this->energy;
    }
    public function getProtein()
    {
		return $this->protein;
    }
    public function getFat()
    {
		return $this->fat;
    }
}
