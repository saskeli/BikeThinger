<?php

class Tag extends BaseModel {
  public $id, $user_id, $name, $required, $exclusive;

  public function __construct($attributes) {
    parent::__construct($attributes);
  }

  public function save() {
    $query = DB::connection()->prepare(
      'INSERT INTO tag (user_id, name, required, exclusive)' .
      'VALUES (:user_id, :name, :required, :exclusive)');
    $query->execute(array(
      'user_id' => $this->user_id,
      'name' => $this->name,
      'required' => $this->required,
      'exclusive' => $this->exclusive));
  }

  public static function all($user_id) {
    $query = DB::connection()->prepare(
      'SELECT * FROM tag WHERE user_id = :user_id');
    $query->execute(array('user_id' => $user_id));
    $rows = $query->fetchAll();
    $tags = array();
    foreach($rows as $row){
        $tags[] = new Tag(Tag::rowToArr($row));
    }
    return $tags;
  }

  public static function find($id, $user_id) {
    $query = DB::connection()->prepare(
      'SELECT * FROM tag WHERE id = :id AND user_id = :user_id LIMIT 1');
    $query->execute(array('id' => $id, 'user_id' => $user_id));
    $row = $query->fetch();
    if ($row) {
      $tag = new Tag(Tag::rowToArr($row));
      return $tag;
    }
    return null;
  }

  public static function update($id, $fields) {
    $query = DB::connection()->prepare(
      'UPDATE tag SET (name, required, exclusive) = ' .
      '(:name, required, exclusive) WHERE id = :id');
    $query->execute(array(
      'name' => $fields['name'],
      'required' => $fields['required'],
      'exclusive' => $fields['exclusive'],
      'id' => $id
    ));
  }

  public static function delete($id) {
    $query = DB::connection()->prepare(
      'DELETE FROM tag WHERE id = :id');
    $query->execute(array('id' => $id));
  }

  private static function rowToArr($row) {
    return array(
      'id' => $row['id'],
      'name' => $row['name'],
      'required' => $row['required'],
      'exclusive' => $row['exclusive']
    );
  }
}
