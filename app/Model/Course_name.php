<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Course_name extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'course_name';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'course_id', 'institucion', 'nombre_institucion', 'activo', 'constancias', 'reedicion'];

    
}
