<?php

namespace App\Http\Controllers;

use DB;
use File;
use Illuminate\Http\Request;

// use Illuminate\Database\Eloquent\Model;

class MongoController extends Controller {

    public function __construct() {

    }

    public function mongo(){
      print_r('Hola');

    }

}
