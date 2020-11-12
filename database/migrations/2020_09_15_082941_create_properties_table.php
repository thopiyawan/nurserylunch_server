<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('food_id')->unsigned();
            $table->foreign('food_id')->references('id')->on('foods');
            $table->boolean('age1_2y')->default(1);
            $table->boolean('age6_8mo')->default(1);
            $table->boolean('age2_3y')->default(1);
            $table->boolean('has_pork')->default(1);
            $table->boolean('has_egg')->default(1);
            $table->boolean('has_seafish')->default(1);
            $table->boolean('has_shirmp')->default(1);
            $table->boolean('has_flour')->default(1);
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
        Schema::dropIfExists('properties');
    }
}
