<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class vm_inscritos_x_curso extends Model
{
   protected $table = 'vm_inscritos_x_curso';
   
   public function course_name(){
       return $this->hasOne('App\Model\Course_name','id','id');
   }
}