<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('material_effective', function (Blueprint $table) {
            $table->integer('material_id')->unsigned();
            $table->integer('against_id')->unsigned();
            $table->foreign('material_id')->references('id')->on('materials')->onDelete('cascade');
            $table->foreign('against_id')->references('id')->on('materials')->onDelete('cascade');
        });

        Schema::create('material_ineffective', function (Blueprint $table) {
            $table->integer('material_id')->unsigned();
            $table->integer('against_id')->unsigned();
            $table->foreign('material_id')->references('id')->on('materials')->onDelete('cascade');
            $table->foreign('against_id')->references('id')->on('materials')->onDelete('cascade');
        });

        Schema::create('modifiers', function (Blueprint $table) {
            $table->integer('material_id')->unsigned();

            $table->string('attribute');
            $table->string('adjustment');
            $table->integer('value');

            $table->foreign('material_id')->references('id')->on('materials')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('material_effective');
        Schema::dropIfExists('material_ineffective');
        Schema::dropIfExists('modifiers');
        Schema::dropIfExists('materials');
    }
}
