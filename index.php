<?php

  error_reporting(E_ALL);
  ini_set('display_errors', '1');

  $script_name = $_SERVER['SCRIPT_NAME'];
  $explode =  explode('/', $script_name);

  if($explode[1] == 'index.php'){
    $base_folder = 'https://bikethinger.herokuapp.com/';
  }else{
    $base_folder = 'https://bikethinger.herokuapp.com/';
  }

  define('BASE_PATH', $base_folder);

  if(session_id() == '') {
    session_start();
  }

  header('Content-Type: text/html; charset=utf-8');

  require 'vendor/autoload.php';

  $routes = new \Slim\Slim();

  $routes->get('/tietokantayhteys', function(){
    DB::test_connection();
  });

  require 'config/routes.php';

  $routes->run();
