<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Ficha_curso extends Model
{
    protected $table = 'ficha_curso';
    
    public function instructores()
    {
        return $this->belongsToMany('App\Model\Instructores','curso_instructor','ficha_curso_id','instructor_id');
    }

}
