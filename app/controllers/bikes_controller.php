<?php

class BikeController extends BaseController {
	public static function index() {
		$bikes = Bike::all();
		View::make('bike/index.html', array('bikes' => $bikes));
	}
}