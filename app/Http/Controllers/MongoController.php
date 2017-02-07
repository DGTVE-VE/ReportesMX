<?php

namespace App\Http\Controllers;
use App\Testmongodb;
use DB;
use File;
use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Model;

class MongoController extends Controller {

    public function __construct() {

    }

    public function mongo(){

      $user = DB::connection('mongodb')->collection('modulestore')->limit(2)->get();

      print_r($user);
      print_r("hola");

    }
}
