<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRealmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('realms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('zones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('realm_id')->unsigned();
            $table->string('name');
            $table->integer('number');
            $table->integer('size');
            $table->integer('level');
            $table->timestamps();
            $table->foreign('realm_id')->references('id')->on('realms')->onDelete('cascade');
        });

        Schema::create('zone_material', function (Blueprint $table) {
            $table->integer('zone_id')->unsigned();
            $table->integer('material_id')->unsigned();
            $table->foreign('zone_id')->references('id')->on('zones')->onDelete('cascade');
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
        Schema::dropIfExists('zone_material');
        Schema::dropIfExists('zones');
        Schema::dropIfExists('realms');
    }
}
