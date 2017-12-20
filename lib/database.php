<?php

  class DB{

    public static function connection(){
      // Haetaan tietokantakonfiguraatio

      $connection_config = DatabaseConfig::connection_config();

      try {
        $dbconf = parse_url(getenv('DATABASE_URL'));
        $connection = new PDO('pgsql:host=' . $dbconf['host'] . ';dbname=' . getenv('DATABASE_URL') . ';port=' . $dbconf['port'] . ';user=' $dbconf['user'] . ';password=' . $dbconf['pass']);
        $connection->exec('SET NAMES UTF8');
        // Näytetään virheilmoitukset
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
          
      } catch (PDOException $e) {
          die('Virhe tietokantayhteydessä tai tietokantakyselyssä: ' . $e->getMessage());
      }
      return $connection;
    }
    public static function test_connection(){
      require 'lib/ConnectionTest/connection_test.php';
      exit();
    }

  }
