<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDietaryReferenceIntakeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dietary_reference_intake', function (Blueprint $table) {
            $table->increments('id');
            $table->float('energy');
            $table->float('carb_lower');
            $table->float('carb_upper');
            $table->float('fat_lower');
            $table->float('fat_upper');
            $table->float('protein_per1_kilo_of_body_weight');
            $table->float('protein');
            $table->float('vitamin_a');
            $table->float('vitamin_d');
            $table->float('vitamin_e');
            $table->float('vitamin_k');
            $table->float('thiamine');
            $table->float('riboflavin');
            $table->float('niacin');
            $table->float('pantothenic acid');
            $table->float('vitamin_b6');
            $table->float('folate');
            $table->float('vitamin_b12');
            $table->float('biotin');
            $table->float('choline');
            $table->float('vitamin_c');
            $table->float('calcium');
            $table->float('phosphorus');
            $table->float('magnesium');
            $table->float('iron');
            $table->float('iodine');
            $table->float('zinc');
            $table->float('selenium');
            $table->float('copper');
            $table->float('manganese');
            $table->float('molybdenum');
            $table->float('chromium');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dietary_reference_intake');
    }
}
