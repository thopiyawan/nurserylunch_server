<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNutritionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nutritions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('food_id')->unsigned();
            $table->foreign('food_id')->references('id')->on('foods');
            $table->float('enerygy');
            $table->float('protien');
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
        Schema::dropIfExists('nutritions');
    }
}
