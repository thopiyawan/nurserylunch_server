<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->increments('id');
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

        Schema::create('food_recipe', function (Blueprint $table) {
            $table->integer('food_id')->unsigned()->nullable();
            $table->foreign('food_id')->references('id')->on('foods');
            $table->integer('recipe_id')->unsigned()->nullable();
            $table->foreign('recipe_id')->references('id')->on('recipes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipies');
    }
}
