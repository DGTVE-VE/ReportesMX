<?php namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
// use Illuminate\Database\Eloquent\Model;


class Testmongodb extends Eloquent{

  protected $connection = 'mongodb';
  // protected $collection = 'test';

}
