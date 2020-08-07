<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodRestrictionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_restrictions', function (Blueprint $table) {
            $table->id();
            $table->integer('kid_id')->unsigned()->nullable();
            $table->foreign('kid_id')->references('id')->on('kids');
            $table->timestamps();

            $table->string('type');
            $table->string('detail');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('food_restrictions');
    }
}
