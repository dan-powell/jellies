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
        Schema::create('miniontypes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('attack')->unsigned();
            $table->integer('defence')->unsigned();
            $table->integer('initiative')->unsigned();
            $table->integer('health')->unsigned();
            $table->integer('cost')->unsigned();
        });

        Schema::create('minions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable()->default(null);
            $table->integer('miniontype_id')->unsigned()->nullable();

            $table->string('name');

            $table->integer('attack')->unsigned();
            $table->integer('defence')->unsigned();
            $table->integer('initiative')->unsigned();
            $table->integer('health')->unsigned();

            $table->integer('hp')->unsigned();

            $table->softDeletes();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('miniontype_id')->references('id')->on('miniontypes')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('minions');
        Schema::dropIfExists('miniontypes');
    }
}
