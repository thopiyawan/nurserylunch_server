<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurUnit extends Model
{
    //
    public static function getUnitByID($id){
    	$unit = PurUnit::find($id);
        return $unit->unit_name;
    }
}
