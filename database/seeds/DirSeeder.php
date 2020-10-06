<?php
use App\DietaryReferenceIntake;
use Illuminate\Database\Seeder;

class DirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $csv = array_map('str_getcsv', file('database/seeds/database/food_dir_data.csv'));
        foreach ($csv as $key => $item) {
            $dir = new DietaryReferenceIntake();
            $dir->year_condition =$item[0];
            $dir->energy = $item[1];
            $dir->carb_lower = $item[2];
            $dir->carb_upper = $item[3];
            $dir->fat_lower = $item[4];
            $dir->fat_upper = $item[5];
            $dir->protein_per1_kilo_of_body_weight = $item[6];
            $dir->protein = $item[7];
            $dir->vitamin_a = $item[8];
            $dir->vitamin_d = $item[9];
            $dir->vitamin_e = $item[10];
            $dir->vitamin_k = $item[11];
            $dir->thiamine = $item[12];
            $dir->riboflavin = $item[13];
            $dir->niacin = $item[14];
            $dir->pantothenic_acid = $item[15];
            $dir->vitamin_b6 = $item[16];
            $dir->vitamin_b12 = $item[17];
            $dir->biotin = $item[18];
            $dir->choline = $item[19];
            $dir->vitamin_c = $item[20];
            $dir->calcium = $item[21];
            $dir->phosphorus = $item[22];
            $dir->magnesium = $item[23];
            $dir->iron = $item[24];
            $dir->iodine = $item[25];
            $dir->selenium = $item[26];
            $dir->copper = $item[27];
            $dir->manganese = $item[28];
            $dir->molybdenum = $item[29];
            $dir->chromium = $item[30];
            $dir->save();
        }
    }
}
