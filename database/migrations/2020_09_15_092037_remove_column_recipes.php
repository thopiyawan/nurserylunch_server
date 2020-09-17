<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveColumnRecipes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recipes', function (Blueprint $table) {
            $table->dropForeign(['composition_id']);
            $table->dropColumn('composition_id');
            $table->dropForeign(['cook_unit_id']);
            $table->dropColumn('cook_unit_id');
            $table->dropForeign(['pur_unit_id']);
            $table->dropColumn('pur_unit_id');
        });
        Schema::dropIfExists('food_recipe');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recipes', function (Blueprint $table) {
            //
        });
    }
}
