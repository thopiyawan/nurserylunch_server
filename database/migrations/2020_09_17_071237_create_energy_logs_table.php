<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnergyLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('energy_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('meal_code');
            $table->tinyInteger('food_type');
            $table->date('meal_date');
            $table->float('energy');
            $table->float('protein');
            $table->float('carbohydrate');
            $table->float('fat');
            $table->float('vitamin_a');
            $table->float('vitamin_b1');
            $table->float('vitamin_b2');
            $table->float('iron');
            $table->float('zine');
            $table->float('calcium');
            $table->float('phosphorus');
            $table->float('fiber');
            $table->float('sodium');
            $table->float('sugar');
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
        Schema::dropIfExists('energy_logs');
    }
}
