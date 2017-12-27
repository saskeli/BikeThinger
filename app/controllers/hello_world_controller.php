<?php

class HelloWorldController extends BaseController{
  public static function index(){
    // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
 	  View::make('plans/login.html');
  }
  public static function sandbox(){
    // Testaa koodiasi täällä
    View::make('helloworld.html');
  }
  public static function Bikes(){
    View::make('plans/bikes.html');
  }
  public static function Gear(){
    View::make('plans/gear.html');
  }
  public static function Components(){
    View::make('plans/components.html');
  }
  public static function Details(){
    View::make('plans/details.html');
  }
  public static function Edit(){
    View::make('plans/edit.html');
  }
  public static function Login(){
    View::make('plans/login.html');
  }
  public static function Spessu(){
    View::make('plans/details.html');
  }
}
