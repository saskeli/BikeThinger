<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      echo "lol";

      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  // View::make('home.html');
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
      echo 'Hello World!';
    }
  }
