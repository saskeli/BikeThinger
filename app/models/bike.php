<?php

class Bike extends BaseMoodel {
	public $id, $user_id, $distance, $name, $model, $link, $year, $in_use, $retired, $description;

	public function __construct($attributes) {
		parent::__construct($attributes)
	}
}