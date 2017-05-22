<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('actions')->default(config('jellies.user.actions_initial'));
            $table->boolean('npc')->default(false);
        });

        Schema::create('user_type', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('type_id')->unsigned();
            $table->integer('quantity')->unsigned()->default(1);
            $table->unique(['user_id', 'type_id']);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('actions');
        });
        Schema::dropIfExists('user_type');
    }
}
