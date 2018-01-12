<?php

class Bike extends BaseModel {
  public $id, $user_id, $distance, $name, $model, $link, $year, $in_use, $retired, $description;

  public function __construct($attributes) {
    parent::__construct($attributes);
  }

  public function save() {
    $query = DB::connection()->prepare(
      'INSERT INTO bike (user_id, distance, name, model, link, year, description)' .
      'VALUES (:user_id, :distance, :name, :model, :link, :year, :description)');
    $query->execute(array(
      'user_id' => $this->user_id,
      'distance' => 0,
      'name' => $this->name,
      'model' => $this->model,
      'link' => $this->link,
      'year' => $this->year,
      'description' => $this->description));
  }

  public function toggleUsage() {
    $in_use = 1;
    $retired = 0;
    if ($this->in_use) {
      $in_use = 0;
      $retired = 1;
    }
    $query = DB::connection()->prepare(
      'UPDATE bike SET (in_use, retired) = (:in_use, :retired) WHERE id = :id');
    $query->execute(array('in_use' => $in_use, 'retired' => $retired, 'id' => $this->id));
  }

  public function addKilometers($num) {
    $query = DB::connection()->prepare(
      'UPDATE bike SET distance = distance + :num WHERE id = :id');
    $query->execute(array('num' => $num, 'id' => $this->id));
  }

  public static function all($user_id) {
    $query = DB::connection()->prepare(
      'SELECT * FROM bike WHERE user_id = :user_id');
    $query->execute(array('user_id' => $user_id));
    $rows = $query->fetchAll();
    $bikes = array();
    foreach($rows as $row){
        $bikes[] = new Bike(Bike::rowToArr($row));
    }
    return $bikes;
  }

  public static function find($id, $user_id) {
    $query = DB::connection()->prepare(
      'SELECT * FROM bike WHERE id = :id AND user_id = :user_id LIMIT 1');
    $query->execute(array('id' => $id, 'user_id' => $user_id));
    $row = $query->fetch();
    if ($row) {
      $bike = new Bike(Bike::rowToArr($row));
      return $bike;
    }
    return null;
  }

  public static function update($id, $fields) {
    $query = DB::connection()->prepare(
      'UPDATE bike SET (distance, name, model, link, year, description) = ' .
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
      'DELETE FROM bike WHERE id = :id');
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
