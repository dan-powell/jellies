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

            $table->integer('attack')->unsigned();
            $table->integer('defence')->unsigned();
            $table->integer('initiative')->unsigned();
            $table->integer('health')->unsigned();

            $table->integer('hp')->unsigned();

            $table->timestamps();
        });

        Schema::create('zone_enemies', function (Blueprint $table) {
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
        Schema::dropIfExists('zone_enemies');
        Schema::dropIfExists('enemies');
    }
}
