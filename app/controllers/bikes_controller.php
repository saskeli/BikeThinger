<?php

class BikeController extends BaseController {
	public static function index() {
		$bikes = Bike::all();
		View::make('bike/index.html', array('bikes' => $bikes));
	}

	public static function show($id) {
		$bike = Bike::find($if);
		View::make('bike/details.html', array('bike' => $bike));
	}
}