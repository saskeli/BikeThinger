<?php

class GearController extends BaseController {
	public static function index() {
		$gear = Gear::all();
		View::make('gear/index.html', array('gear' => $gear));
	}

	public static function show($id) {
		$gear = Gear::find($id);
		View::make('gear/details.html', array('gear' => $gear));
	}
}