<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class banner_principal extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'banner_principal';

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
    protected $fillable = ['id', 'url_imagen', 'ligaHref', 'activo'];

    
}
