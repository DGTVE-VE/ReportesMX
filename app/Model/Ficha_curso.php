<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Ficha_curso extends Model
{
    protected $table = 'ficha_curso';
    
    protected $fillable = ['id_institucion','nombre_curso','tipo_curso','num_edicion',
        'codigo_curso','periodo_emision','fecha_inicio','fecha_fin','fecha_inicio_inscripcion',
        'fecha_fin_inscripcion','descripcion_corta','acerca_del_curso','conocimientos_previos',
        'aprendizaje_esperado','nivel_curso','tipo_constancia','idioma','esfuerzo_horas',
        'calificacion_minima','redes_soc','url_logo','url_imagen','id_video',
        'temario','categoria_1','categoria_2','categoria_3','linea_estrategica_1','linea_estrategica_2','linea_estrategica_3'];
    
    public function instructores()
    {
        return $this->belongsToMany('App\Model\Instructores','curso_instructor','ficha_curso_id','instructor_id');
    }

    public function contactos (){
        return $this->belongsToMany('App\Model\Contactos_Institucion', 'contactos_ficha', 'id_ficha', 'id_contacto')
                ->withPivot('rol')
                ->wherePivot('rol', 'contacto');
    }
    public function staff (){
        return $this->belongsToMany('App\Model\Contactos_Institucion', 'contactos_ficha', 'id_ficha', 'id_contacto')
                ->withPivot('rol')
                ->wherePivot('rol', 'staff');
    }
    public function asesores (){
        return $this->belongsToMany('App\Model\Contactos_Institucion', 'contactos_ficha', 'id_ficha', 'id_contacto')
                ->withPivot('rol')
                ->wherePivot('rol', 'asesor');
    }
    public function institucion (){
        return $this->belongsTo('App\Model\Institucion', 'id_institucion');
    }
    public function edito (){
        return $this->belongsTo('App\User', 'edito_id');
    }
    public function creo (){
        return $this->belongsTo('App\User', 'creo_id', 'id');
    }
    public function aprobo (){
        return $this->belongsTo('App\User', 'aprobo_id');
    }
}
