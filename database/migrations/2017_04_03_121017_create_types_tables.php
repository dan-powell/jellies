<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('type_effective', function (Blueprint $table) {
            $table->integer('type_id')->unsigned();
            $table->integer('against_id')->unsigned();
            $table->foreign('type_id')->references('id')->on('types')->onDelete('cascade');
            $table->foreign('against_id')->references('id')->on('types')->onDelete('cascade');
        });

        Schema::create('type_ineffective', function (Blueprint $table) {
            $table->integer('type_id')->unsigned();
            $table->integer('against_id')->unsigned();
            $table->foreign('type_id')->references('id')->on('types')->onDelete('cascade');
            $table->foreign('against_id')->references('id')->on('types')->onDelete('cascade');
        });

        Schema::create('modifiers', function (Blueprint $table) {
            $table->integer('type_id')->unsigned();

            $table->string('attribute');
            $table->string('adjustment');
            $table->integer('value');

            $table->foreign('type_id')->references('id')->on('types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('type_effective');
        Schema::dropIfExists('type_ineffective');
        Schema::dropIfExists('modifiers');
        Schema::dropIfExists('types');
    }
}
