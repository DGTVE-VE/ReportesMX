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
            $table->string('course_name');
            $table->date('inicio');
            $table->date('fin');
            $table->date('inicio_inscripcion');
            $table->date('fin_inscripcion');
            $table->text('descripcion');
            $table->string('thumbnail');
            $table->string('institucion');
            $table->integer('activo');
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
