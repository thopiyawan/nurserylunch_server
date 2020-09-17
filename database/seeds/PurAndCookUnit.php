<?php

use App\CookUnit;
use App\PurUnit;
use Illuminate\Database\Seeder;

class PurAndCookUnit extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cook_unit = new CookUnit();
        $cook_unit->unit_name  = "GR";
        $cook_unit->save();
        $csv = array_map('str_getcsv', file('database/seeds/database/pur_unit.csv'));
        foreach ($csv as $key => $item) {
            $pur_unit = new PurUnit();
            $pur_unit->id = $item[0];
            $pur_unit->unit_name = $item[1];
            $pur_unit->save();
        }
    }
}
