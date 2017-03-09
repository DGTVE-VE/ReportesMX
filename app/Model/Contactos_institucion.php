<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Contactos_institucion extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'contactos_institucion';

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
    protected $fillable = ['id', 'institucion_id', 'nombre', 'nivel_academico', 'area_investigacion', 'biografia_breve', 'correo_institucional', 'telefono_institucional', 'cargo_contacto', 'activo'];

     public function institucion (){
        return $this->belongsTo('App\Model\Institucion', 'institucion_id');
    }
}
