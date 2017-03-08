<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContactosInstitucionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contactos_institucions', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('id');
            $table->integer('institucion_id');
            $table->string('nombre');
            $table->string('nivel_academico');
            $table->string('area_investigacion');
            $table->text('biografia_breve');
            $table->string('correo_institucional');
            $table->string('telefono_institucional');
            $table->string('cargo_contacto');
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
        Schema::drop('contactos_institucions');
    }
}
