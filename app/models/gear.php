<?php

class Gear extends BaseModel {
  public $id, $user_id, $distance, $name, $model, $link, $year, $in_use, $retired, $description;
  public function __construct($attributes) {
    parent::__construct($attributes);
  }

  public function save() {
    $query = DB::connection()->prepare(
      'INSERT INTO gear (user_id, name, model, link, year, description)' .
      'VALUES (:user_id, :name, :model, :link, :year, :description)');
    $query->execute(array(
      'user_id' => $this->user_id,
      'name' => $this->name,
      'model' => $this->model,
      'link' => $this->link,
      'year' => $this->year,
      'description' => $this->description));
  }

  public function disable() {
    $query = DB::connection()->prepare(
      'UPDATE gear SET (in_use, retired) = (FALSE, FALSE) WHERE id = :id');
    $query->execute(array('id' => $this->id));
  }

  public function retire() {
    $query = DB::connection()->prepare(
      'UPDATE gear SET (in_use, retired) = (FALSE, TRUE) WHERE id = :id');
     $query->execute(array('id' => $this->id));
  }

  public function use() {
    $query = DB::connection()->prepare(
      'UPDATE gear SET (in_use, retired) = (TRUE, FALSE) WHERE id = :id');
    $query->execute(array('id' => $this->id));
  }

  public function addKilometers($num) {
    $query = DB::connection()->prepare(
      'UPDATE gear SET distance = distance + :num WHERE id = :id');
    $query->execute(array('num'=> $num, 'id' => $this->id));
  }

  public static function all($user_id) {
    $query = DB::connection()->prepare(
      'SELECT * FROM gear WHERE user_id = :user_id');
    $query->execute(array('user_id' => $user_id));
    $rows = $query->fetchAll();
    $gear = array();
    foreach($rows as $row){
      $gear[] = new Gear(Gear::rowToArr($row));
    }
    return $gear;
  }

  public static function allInUse($user_id) {
    $query = DB::connection()-prepare(
      'SELECT * FROM gear WHERE user_id = :user_id and in_use = TRUE');
    $query->execute(array('user_id' => $user_id));
    $rows = $query->fetchAll();
    $gear = array();
    foreach ($rows as $row) {
      $gear[] = new Gear(Gear::rowToArr($row));
    }
    return $gear;
  }

  public static function find($id, $user_id) {
    $query = DB::connection()->prepare(
      'SELECT * FROM gear WHERE id = :id AND user_id = :user_id LIMIT 1');
    $query->execute(array('id' => $id, 'user_id' => $user_id));
    $row = $query->fetch();
    if ($row) {
      return new Gear(Gear::rowToArr($row));
    } else {
      Redirect::to('gear', 'No such gear');
    }
    return null;
  }

  public static function update($id, $fields) {
    $query = DB::connection()->prepare(
      'UPDATE gear SET (distance, name, model, link, year, description) = ' .
      '(:distance, :name, :model, :link, :year, :description)' .
      'WHERE id = :id');
    $query->execute(array(
      'distance' => $fields['distance'],
      'name' => $fields['name'],
      'model' => $fields['model'],
      'link' => $fields['link'],
      'year' => $fields['year'],
      'description' => $fields['description'],
      'id' => $id
    ));
  }

  public static function delete($id) {
    $query = DB::connection()->prepare(
      'DELETE FROM gear WHERE id = :id');
    $query->execute(array('id' => $id));
  }

  private static function rowToArr($row) {
    return array(
      'id' => $row['id'],
          'user_id' => $row['user_id'],
          'distance' => $row['distance'],
          'name' => $row['name'],
          'model' => $row['model'],
          'link' => $row['link'],
          'year' => $row['year'],
          'in_use' => $row['in_use'],
          'retired' => $row['retired'],
          'description' => $row['description']
    );
  }
}
