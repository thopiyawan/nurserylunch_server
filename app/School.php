<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use LaravelPropertyBag\Settings\HasSettings;
class School extends Model
{
    //
    use HasSettings;


    public function setting(){
        return $this->hasOne(Setting::class);
    }

    public function users(){
        return $this->hasMany(User::class);
    }

    public function classrooms(){
        return $this->hasMany(Classroom::class);
    }

    public function kids(){
        return $this->hasMany(Kid::class);
    }

    public function energyLog(){
        return $this->hasMany(EnergyLogs::class);
    }
}

