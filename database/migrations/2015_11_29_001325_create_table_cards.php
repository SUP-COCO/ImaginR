<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCards extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->increments('id');
            $table->string('num_serie');
            $table->boolean('valid');
            $table->date('date_start');
            $table->date('date_end');
            $table->integer('user_id')->unsigned();
            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->unique('user_id');
        });

        Schema::table('cards', function($table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cards');
    }
}
