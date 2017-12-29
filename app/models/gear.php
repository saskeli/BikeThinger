<?php

class Gear extends BaseModel {
	public $id, $user_id, $distance, $name, $model, $link, $year, $in_use, $retired, $description;
	public function __construct($attributes) {
		parent::__construct($attributes);
	}

	public static function all() {
		$query = DB::connection()->prepare('SELECT * FROM gear');
		$query->execute();
		$rows = $query->fetchAll();
    	$gear = array();
    	foreach($rows as $row){
      		$gear[] = new Gear(array(
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
      		));
		}
		return $gear;
	}

	public static function find($id) {
		$query = DB::connection()->prepare('SELECT * FROM gear WHERE id = :id LIMIT 1');
		$query->execute(array('id' => $id));
		$row = $query->fetch();
		if ($row) {
			$gear = new Gear(array(
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
			));
			return $gear;
		}
		return null;
	}
}