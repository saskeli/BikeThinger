<?php

class Component extends BaseModel {
  public $id, $user_id, $bike_id, $distance, $name, $model, $link, $year, $in_use, $retired, $description;
  public function __construct($attributes) {
    parent::__construct($attributes);
  }

  public function save() {
    $query = DB::connection()->prepare(
      'INSERT INTO component (user_id, name, model, link, year, description)' .
      'VALUES (:user_id, :name, :model, :link, :year, :description)');
    $query->execute(array(
      'user_id' => $this->user_id,
      'name' => $this->name,
      'model' => $this->model,
      'link' => $this->link,
      'year' => $this->year,
      'description' => $this->description));
  }

  public static function forbike($id, $user_id) {
    $query = DB::connection()->prepare(
      'SELECT * FROM component WHERE bike_id = :id AND user_id = :user_id');
    $query->execute(array('id' => $id, 'user_id' => $user_id));
    $rows = $query->fetchAll();
    $components = array();
    foreach ($rows as $row) {
      $components[] = new Component(Component::rowToArr($row));
    }
    return $components;
  }

  public static function all($user_id) {
    $query = DB::connection()->prepare(
      'SELECT * FROM component WHERE user_id = :user_id');
    $query->execute(array('user_id' => $user_id));
    $rows = $query->fetchAll();
      $component = array();
      foreach($rows as $row){
          $component[] = new Component(Component::rowToArr($row));
    }
    return $component;
  }

  public static function find($id, $user_id) {
    $query = DB::connection()->prepare(
      'SELECT * FROM component WHERE id = :id AND user_id = :user_id LIMIT 1');
    $query->execute(array('id' => $id, 'user_id' => $user_id));
    $row = $query->fetch();
    if ($row) {
      return new Component(Component::rowToArr($row));
    }
    return null;
  }

  public static function update($id, $fields) {
    $query = DB::connection()->prepare(
      'UPDATE component SET (distance, name, model, link, year, description) = ' .
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
      'DELETE FROM component WHERE id = :id');
    $query->execute(array('id' => $id));
  }

  private static function rowToArr($row) {
    return array(
      'id' => $row['id'],
          'user_id' => $row['user_id'],
          'bike_id' => $row['bike_id'],
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
