<?php

class HelloWorldController extends BaseController{
  public static function sandbox(){
    $bikes = Bike::all();
    $bike = Bike::find(1);
    Kint::dump($bikes);
    Kint::dump($bike);
  }
}
