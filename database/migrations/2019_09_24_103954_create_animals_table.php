<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnimalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->string('name');
            $table->string('color');
            $table->string('breed');
            $table->string('size');
            $table->double('age');
            $table->enum('gender', array('male', 'female'));
            $table->boolean('is_sterilised');
            $table->integer('cage_id')->unsigned();
            $table->foreign('cage_id')
                  ->references('id')
                  ->on('cages');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('animals');
    }
}
