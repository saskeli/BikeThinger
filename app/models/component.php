<?php

class Component extends BaseModel {
	public $id, $user_id, $bike_id, $distance, $name, $model, $link, $year, $in_use, $retired, $description;
	public function __construct($attributes) {
		parent::__construct($attributes);
	}


	public static function forbike($id) {
		$query = DB::connection()->prepare('SELECT * FROM component WHERE bike_id = :id');
		$query->execute(array('id' => $id));
		$rows = $query->fetchAll();
		$components = array();
		foreach ($rows as $row) {
			$components[] = new Component(Component::rowToArr($row));
		}
		return $components;
	}

	public static function all() {
		$query = DB::connection()->prepare('SELECT * FROM component');
		$query->execute();
		$rows = $query->fetchAll();
    	$component = array();
    	foreach($rows as $row){
      		$component[] = new Component(Component::rowToArr($row));
		}
		return $component;
	}

	public static function find($id) {
		$query = DB::connection()->prepare('SELECT * FROM component WHERE id = :id LIMIT 1');
		$query->execute(array('id' => $id));
		$row = $query->fetch();
		if ($row) {
			$component = new Component(Component::rowToArr($row));
			return $component;
		}
		return null;
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