<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnemiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enemies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('enemy_material', function (Blueprint $table) {
            $table->integer('enemy_id')->unsigned();
            $table->integer('material_id')->unsigned();
            $table->integer('quantity')->unsigned()->default(1);
            $table->unique(['enemy_id', 'material_id']);
            $table->foreign('enemy_id')->references('id')->on('enemies')->onDelete('cascade');
            $table->foreign('material_id')->references('id')->on('materials')->onDelete('cascade');
        });

        Schema::create('zone_enemy', function (Blueprint $table) {
            $table->integer('zone_id')->unsigned();
            $table->integer('enemy_id')->unsigned();
            $table->foreign('zone_id')->references('id')->on('zones')->onDelete('cascade');
            $table->foreign('enemy_id')->references('id')->on('enemies')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enemy_material');
        Schema::dropIfExists('zone_enemy');
        Schema::dropIfExists('enemies');
    }
}
