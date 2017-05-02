<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEncountersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('encounters', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('incursion_id')->unsigned();
            $table->integer('zone_id')->unsigned()->nullable();

            $table->json('minions')->nullable();
            $table->json('enemies')->nullable();
            $table->json('log')->nullable();
            $table->boolean('victory');

            $table->integer('minion_damage')->unsigned()->default(0);
            $table->integer('enemy_damage')->unsigned()->default(0);

            $table->integer('rounds')->unsigned()->default(0);
            $table->integer('points')->unsigned()->default(0);

            $table->timestamps();
            $table->foreign('zone_id')->references('id')->on('zones')->onDelete('set null');
            $table->foreign('incursion_id')->references('id')->on('incursions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('encounters');
    }
}
