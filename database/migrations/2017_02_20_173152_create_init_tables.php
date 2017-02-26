<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInitTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes', function (Blueprint $table){
            $table->increments('id');
            $table->integer('year');
            $table->integer('max_students');
            $table->timestamps();
        });

        Schema::create('students', function (Blueprint $table){
            $table->increments('id');
            $table->integer('class_id')->unsigned();
            $table->string('first_name');
            $table->string('last_name');
            $table->timestamps();

            $table->foreign('class_id')->references('id')->on('classes')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('students');
        Schema::drop('classes');
    }
}
