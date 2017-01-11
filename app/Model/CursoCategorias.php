<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CursoCategorias extends Model
{
    protected $table = 'curso_categorias';
	protected $fillable = ['course_id', 'categoria_id'];
}
