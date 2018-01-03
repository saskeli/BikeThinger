<?php

  class DB{

    public static function connection(){

      $connection_config = DatabaseConfig::connection_config();

      try {
        $dbconf = parse_url(getenv('DATABASE_URL'));
        $connection = new PDO('pgsql:host=' . $dbconf['host'] . ';dbname=' . substr($dbconf['path'], 1) . 
          ';port=' . $dbconf['port'] . ';user=' . $dbconf['user'] . ';password=' . $dbconf['pass']);
        $connection->exec('SET NAMES UTF8');
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
          
      } catch (PDOException $e) {
          die('Error in database connection or query: ' . $e->getMessage());
      }
      return $connection;
    }
    public static function test_connection(){
      require 'lib/ConnectionTest/connection_test.php';
      exit();
    }

  }
