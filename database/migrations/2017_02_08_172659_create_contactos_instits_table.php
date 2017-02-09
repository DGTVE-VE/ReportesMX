<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContactosInstitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contactos_instits', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('id');
            $table->integer('institucion_id');
            $table->string('nombre_contacto');
            $table->string('correo_contacto');
            $table->string('telefono');
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
        Schema::drop('contactos_instit');
    }
}
