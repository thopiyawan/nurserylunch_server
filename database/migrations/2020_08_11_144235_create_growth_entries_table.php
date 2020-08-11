<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGrowthEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('growth_entries', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('kid_id')->unsigned()->nullable();
            $table->foreign('kid_id')->references('id')->on('kids');

            $table->date('date');
            $table->decimal('height');
            $table->decimal('weight');
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('growth_entries');
    }
}
