<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('school_id')->unsigned()->nullable();
            $table->foreign('school_id')->references('id')->on('schools');
            $table->timestamps();

            $table->boolean('is_weekday')->default(1);
            $table->boolean('is_saturday')->default(0);
            $table->boolean('is_sunday')->default(0);

            $table->boolean('is_breakfast')->default(0);
            $table->boolean('is_morning_snack')->default(1);
            $table->boolean('is_lunch')->default(1);
            $table->boolean('is_afternoon_snack')->default(1);

            $table->boolean('is_for_small')->default(0);
            $table->boolean('is_s_muslim')->default(0);
            $table->boolean('is_s_vege')->default(0);
            $table->boolean('is_s_vegan')->default(0);
            $table->boolean('is_s_milk')->default(0);
            $table->boolean('is_s_breastmilk')->default(0);
            $table->boolean('is_s_egg')->default(0);
            $table->boolean('is_s_wheat')->default(0);
            $table->boolean('is_s_shrimp')->default(0);
            $table->boolean('is_s_shell')->default(0);
            $table->boolean('is_s_crab')->default(0);
            $table->boolean('is_s_fish')->default(0);
            $table->boolean('is_s_peanut')->default(0);
            $table->boolean('is_s_soybean')->default(0);

            $table->boolean('is_for_big')->default(1);
            $table->boolean('is_b_muslim')->default(0);
            $table->boolean('is_b_vege')->default(0);
            $table->boolean('is_b_vegan')->default(0);
            $table->boolean('is_b_milk')->default(0);
            $table->boolean('is_b_breastmilk')->default(0);
            $table->boolean('is_b_egg')->default(0);
            $table->boolean('is_b_wheat')->default(0);
            $table->boolean('is_b_shrimp')->default(0);
            $table->boolean('is_b_shell')->default(0);
            $table->boolean('is_b_crab')->default(0);
            $table->boolean('is_b_fish')->default(0);
            $table->boolean('is_b_peanut')->default(0);
            $table->boolean('is_b_soybean')->default(0);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
