<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableValidations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('validations', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('date');
            $table->integer('user_id')->unsigned();
            $table->integer('station_id')->unsigned();
            $table->timestamps();

            $table->engine = 'InnoDB';
        });

        Schema::table('validations', function($table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('station_id')->references('id')->on('stations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('validations');
    }
}
