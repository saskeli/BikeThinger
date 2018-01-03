<?php

class User extends BaseModel {
  public $id, $name, $pwd;

  public function __construct($attributes) {
    parent::__construct($attributes);
  }

  public static function authenticate($username, $password) {
    $query = DB::connection()->prepare(
      'SELECT * FROM ut WHERE username = :username LIMIT 1');
    $query->execute(array('username' => $username));
    $row = $query->fetch();

    if ($row and password_verify($password, $row['password'])) {
      return new User(User::rowToArr($row));
    }
    return null;
  }

  public static function find($id) {
    $query = DB::connection()->prepare(
      'SELECT * FROM ut WHERE id = :id LIMIT 1');
    $query->execute(array('id' => $id));
    $row = $query->fetch();

    if ($row) {
      return new User(User::rowToArr($row));
    }
    return null;
  }

  private static function rowToArr($row) {
    return array(
      'id' => $row['id'],
        'name' => $row['username'],
        'password' => $row['password']
    );
  }
}
