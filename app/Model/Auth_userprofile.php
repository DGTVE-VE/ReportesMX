<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Auth_userprofile extends Model {

    protected $table = 'auth_userprofile';

       //función que permite la consulta para el servicio web
    public function scopeSearch($query, $searchField) {
        $searchField = array($searchField);
        if (isset($searchField[0]['user_id'])) {
            $query->Where('user_id', '=', $searchField[0]['user_id']);
        }
        if (isset($searchField[0]['gender'])) {
            $query->Where('gender', '=', $searchField[0]['gender']);
        }  
        if (isset($searchField[0]['year_of_birth'])) {
            $query->Where('year_of_birth', '=', $searchField[0]['year_of_birth']);
        }  
        if (isset($searchField[0]['level_of_education'])) {
            $query->Where('level_of_education', '=', $searchField[0]['level_of_education']);
        }  
        if (isset($searchField[0]['country'])) {
            $query->Where('country', '=', $searchField[0]['country']);
        }          
        if (isset($searchField[0]['city'])) {
            $query->Where('city', '=', $searchField[0]['city']);
        }          
        $rows =  $query->select('user_id','gender','year_of_birth','level_of_education','country','city')->get();
    }
}
