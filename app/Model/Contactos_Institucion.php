<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Contactos_Institucion extends Model
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
    protected $fillable = ['id','institucion_id', 'nombre_contacto', 'correo_contacto', 'telefono', 'cargo_contacto', 'activo'];

    public function ficha (){
        return $this->belongsToMany('App\Model\Ficha_curso', 'contactos_ficha', 'id_contacto', 'id_ficha')
            ->withPivot('rol');
    }
}
