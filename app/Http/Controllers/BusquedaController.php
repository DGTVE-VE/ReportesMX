<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use \App\Course_name;
use DB;

class BusquedaController extends Controller {

    public function buscar() {
        
        $termino = filter_input(INPUT_POST, 'termino');
        $cursos = Course_name::whereRaw("match(course_name,descripcion)"
                . "against('$termino') "
                . "and course_id is not null and trim(course_id)!=''" )->get();
        
        $cursosPorCategoria = DB::select("select c.id, c.categoria, count(*)"
                . " as cursos"
                . " from categorias c, curso_categoria r, course_name n"
                . " where c.id = r.id_categoria"
                . " and r.id_curso = n.id and n.course_id is not null and trim(n.course_id)!=''"
                . " group by c.id, c.categoria");
        
        
        
        return view ('busqueda_cursos',['cursos'=>$cursos,'cursosPorCategoria'=>$cursosPorCategoria]);                

    }
    
    public function buscarTodos(){
        
        //$cursosTodos = DB::table("course_name where course_id is not null and trim(course_id)!=''")->get();
        $cursosTodos = DB::select("select *from course_name where course_id is not null and trim(course_id)!=''");
        
        $cursosPorCategoria = DB::select("select c.id, c.categoria, count(*)"
                . " as cursos"
                . " from categorias c, curso_categoria r, course_name n"
                . " where c.id = r.id_categoria"
                . " and r.id_curso = n.id and n.course_id is not null and trim(n.course_id)!=''"
                . " group by c.id, c.categoria");     
        
//var_dump($cursosTodos);
        return view('busqueda_cursos',['cursosTodos'=>$cursosTodos,'cursosPorCategoria'=>$cursosPorCategoria]);

    }
    
    public function muestraCategoria (Request $request, $categoria_id){
        
        $cursosPorCategoria = DB::select("select c.id, c.categoria, count(*)"
                . " as cursos"
                . " from categorias c, curso_categoria r, course_name n"
                . " where c.id = r.id_categoria"
                . " and r.id_curso = n.id and n.course_id is not null and trim(n.course_id)!=''"
                . " group by c.id, c.categoria");       
        
        $cursosCategoria = DB::select("select *from course_name a, curso_categoria b "
                . " where a.id = b.id_curso "
                . " and b.id_categoria ='$categoria_id'"
                . " and course_id is not null and trim(course_id)!=''");
//var_dump($cursosPorCategoria);
        return view('busqueda_cursos',['cursosCategoria'=>$cursosCategoria,
            'cursosPorCategoria'=>$cursosPorCategoria]);
    }

}
