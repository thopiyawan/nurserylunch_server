<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_recipes', function (Blueprint $table) {
            $table->integer('food_id')->unsigned();
            $table->foreign('food_id')->references('id')->on('foods');
            $table->integer('composition_id')->unsigned();
            $table->foreign('composition_id')->references('id')->on('compositions');
            $table->float('cook_quantity');
            $table->integer('cook_unit_id')->unsigned();
            $table->foreign('cook_unit_id')->references('id')->on('cook_units');
            $table->float('pur_quantity');
            $table->integer('pur_unit_id')->unsigned();
            $table->foreign('pur_unit_id')->references('id')->on('pur_units');
            $table->timestamps();
        });
        Schema::dropIfExists('recipes');
        Schema::dropIfExists('food_recipe');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('food_recipes');
    }
}
