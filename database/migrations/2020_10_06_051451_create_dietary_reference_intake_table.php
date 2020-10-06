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
            $table->float('energy')->default(0);
            $table->float('carb_lower')->default(0);;
            $table->float('carb_upper')->default(0);
            $table->float('fat_lower')->default(0);
            $table->float('fat_upper')->default(0);
            $table->float('protein_per1_kilo_of_body_weight')->default(0);
            $table->float('protein')->default(0);
            $table->float('vitamin_a')->default(0);
            $table->float('vitamin_d')->default(0);
            $table->float('vitamin_e')->default(0);
            $table->float('vitamin_k')->default(0);
            $table->float('thiamine')->default(0);
            $table->float('riboflavin')->default(0);
            $table->float('niacin')->default(0);
            $table->float('pantothenic_acid')->default(0);
            $table->float('vitamin_b6')->default(0);
            $table->float('folate')->default(0);
            $table->float('vitamin_b12')->default(0);
            $table->float('biotin')->default(0);
            $table->float('choline')->default(0);
            $table->float('vitamin_c')->default(0);
            $table->float('calcium')->default(0);
            $table->float('phosphorus')->default(0);
            $table->float('magnesium')->default(0);
            $table->float('iron')->default(0);
            $table->float('iodine')->default(0);
            $table->float('zinc')->default(0);
            $table->float('selenium')->default(0);
            $table->float('copper')->default(0);
            $table->float('manganese')->default(0);
            $table->float('molybdenum')->default(0);
            $table->float('chromium')->default(0);
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
