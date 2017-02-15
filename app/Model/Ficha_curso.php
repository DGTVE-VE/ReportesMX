<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Ficha_curso extends Model
{
    protected $table = 'ficha_curso';
    
    protected $fillable = ['id_institucion','nombre_curso','tipo_curso','num_edicion','codigo_curso','periodo_emision','fecha_inicio','fecha_fin','fecha_inicio_insc','fecha_fin_inscrip','descripcion_corta','descripcion_larga','requisitos','resultados_esp','nivel_curso','tipo_constancia','idioma','esfuerzo_hrs','duracion_sem','calif_minima','redes_soc','url_logo','url_imagen','url_video','temario','area_tem1','area_tem2','area_tem3','linea_estrat1','linea_estrat2','linea_estrat3'];
    
    public function instructores()
    {
        return $this->belongsToMany('App\Model\Instructores','curso_instructor','ficha_curso_id','instructor_id');
    }

}
