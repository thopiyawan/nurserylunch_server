<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Food extends Model
{
    protected $table = 'foods';
    //

    public $energy;
    public $protein;
    public $fat;
    public $carbohydrate;
    public $vitamin_a;
    public $vitamin_b1;
    public $vitamin_b2;
    public $vitamin_c;
    public $iron;
    public $calcium;
    public $phosphorus;
    public $fiber;
    public $sodium;
    public $sugar;
    public function init()
    {
    	$nutrition = $this->nutritions;
    	$this->energy = $nutrition->energy;
    	$this->protein = $nutrition->protein;
        $this->fat = $nutrition->fat;
    	$this->carbohydrate = $nutrition->carbohydrate;
        $this->vitamin_a = $nutrition->vitamin_a;
        $this->vitamin_b1 = $nutrition->vitamin_b1;
        $this->vitamin_b2 = $nutrition->vitamin_b2;
        $this->vitamin_c = $nutrition->vitamin_c;
        $this->iron = $nutrition->iron;
        $this->calcium = $nutrition->calcium;
        $this->phosphorus = $nutrition->phosphorus;
        $this->fiber = $nutrition->fiber;
        $this->sodium = $nutrition->sodium;
        $this->sugar = $nutrition->sugar;
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
    public function getCarbohydrate()
    {
        return $this->carbohydrate;
    }
    public function getVitamin_a()
    {
        return $this->vitamin_a;
    }
    public function getVitamin_b2()
    {
        return $this->vitamin_b2;
    }
    public function getVitamin_c()
    {
        return $this->vitamin_c;
    }
    public function getCalcium()
    {
        return $this->calcium;
    }
    public function getPhosphorus()
    {
        return $this->phosphorus;
    }
    public function getFiber()
    {
        return $this->fiber;
    }
    public function getSodium()
    {
        return $this->sodium;
    }
    public function getSugar()
    {
        return $this->sugar;
    }



    public function ingredients(){
      return $this->belongsToMany(Ingredient::class);
    }
}
