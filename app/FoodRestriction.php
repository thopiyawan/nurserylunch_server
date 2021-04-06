<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FoodRestriction extends Model
{
    //
    protected $fillable = [
        'type', 'detail',
    ];
    
}
