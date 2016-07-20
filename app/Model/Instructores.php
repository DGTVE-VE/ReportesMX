<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Instructores extends Model
{
    protected $table = 'instructores';
    
     public function ficha_curso()
    {
        return $this->belongsToMany('App\Model\Ficha_curso','curso_instructor','instructor_id','ficha_curso_id');
    }
}
