<?php

use Illuminate\Database\Migrations\Migration;

class CreateFilmsTheaters extends Migration
{
    /**
     * Make changes to the database.
     */
    public function up()
    {
        Schema::create('films_theaters', function ($table) {
            $table->increments('id');
            $table->integer('film_id')->unsigned();
            $table->integer('theater_id')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Revert the changes to the database.
     */
    public function down()
    {
        Schema::drop('films_theaters');
    }
}
