<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GrowthEntry extends Model
{
    //
    protected $fillable = [
        'date', 'height','weight',
    ];
}
