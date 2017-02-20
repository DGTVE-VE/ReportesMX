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
        'temario','area_tem1','area_tem2','area_tem3','linea_estrat1','linea_estrat2','linea_estrat3'];
    
    public function instructores()
    {
        return $this->belongsToMany('App\Model\Instructores','curso_instructor','ficha_curso_id','instructor_id');
    }

    public function contactos (){
        return $this->belongsToMany('App\Model\Contactos_Institucion', 'contactos_ficha', 'id_ficha', 'id_contacto')
                ->withPivot('rol')
                ->wherePivot('rol', 'contacto');
    }
}
