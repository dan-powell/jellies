<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMinionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('minions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable()->default(null);

            $table->string('name');

            $table->timestamps();
            $table->softdeletes();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('minion_material', function (Blueprint $table) {
            $table->integer('minion_id')->unsigned();
            $table->integer('material_id')->unsigned();
            $table->integer('quantity')->unsigned()->default(1);
            $table->unique(['minion_id', 'material_id']);
            $table->foreign('minion_id')->references('id')->on('minions')->onDelete('cascade');
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
        Schema::dropIfExists('minion_material');
        Schema::dropIfExists('minions');
    }
}
