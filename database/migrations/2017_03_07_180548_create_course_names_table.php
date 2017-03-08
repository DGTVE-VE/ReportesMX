<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCourseNamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_names', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('id');
            $table->string('course_id');
            $table->string('institucion');
            $table->string('nombre_institucion');
            $table->integer('activo');
            $table->integer('constancias');
            $table->string('reedicion');
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
        Schema::drop('course_names');
    }
}
