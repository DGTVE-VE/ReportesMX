<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class institucion extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'institucion';

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
    protected $fillable = ['id', 'nombre_institucion', 'siglas', 'correo_mexicox'];

    
}
