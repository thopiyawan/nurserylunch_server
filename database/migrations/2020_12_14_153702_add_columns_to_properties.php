<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToProperties extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('properties', function (Blueprint $table) {
            //
            $table->boolean('is_safe_muslim')->default(1);
            $table->boolean('is_safe_vege')->default(1);
            $table->boolean('is_safe_vegan')->default(1);
            $table->boolean('is_safe_allegic_milk')->default(1);
            $table->boolean('is_safe_allegic_breastmilk')->default(1);
            $table->boolean('is_safe_allegic_egg')->default(1);
            $table->boolean('is_safe_allegic_wheat')->default(1);
            $table->boolean('is_safe_allegic_shrimp')->default(1);
            $table->boolean('is_safe_allegic_shell')->default(1);
            $table->boolean('is_safe_allegic_crab')->default(1);
            $table->boolean('is_safe_allegic_fish')->default(1);
            $table->boolean('is_safe_allegic_peanut')->default(1);
            $table->boolean('is_safe_allegic_soybean')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('properties', function (Blueprint $table) {
            //
        });
    }
}
