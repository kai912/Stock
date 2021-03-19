<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipeFoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipe_foods', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('recipe_id')->unsigned();
            $table->bigInteger('food_id')->unsigned();
            $table->integer('count');
            $table->timestamps();

            $table->foreign('recipe_id')->references('id')->on('recipes');
            $table->foreign('food_id')->references('id')->on('foods');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipe_foods');
    }
}
