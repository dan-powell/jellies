<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncursionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incursions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable()->default(null);

            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('incursion_minion', function (Blueprint $table) {
            $table->integer('incursion_id')->unsigned();
            $table->integer('minion_id')->unsigned();

            $table->foreign('incursion_id')->references('id')->on('incursions')->onDelete('cascade');
            $table->foreign('minion_id')->references('id')->on('minions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('incursion_minion');
        Schema::dropIfExists('incursions');
    }
}
