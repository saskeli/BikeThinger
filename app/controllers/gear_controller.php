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

	public static function create() {
		View::make('gear/new.html');
	}

	public static function store() {
		$gear = new Gear(array(
			'user_id' => 1,
        	'name' => $_POST['name'],
        	'model' => $_POST['model'],
        	'link' => $_POST['link'],
        	'year' => $_POST['year'],
        	'description' => $_POST['description']
		));
		$gear->save();

		Redirect::to('gear');
	}

	public static function edit($id) {
		$gear = Gear::find($id);
		View::make('gear/edit.html', array(
			'gear' => $gear));
	}

	public static function update($id) {
		Gear::update($id, $_POST);
		Redirect::to('gear');
	}

	public static function delete($id) {
		$gear = Gear::find($id);
		if ($gear->name === $_POST['name']) {
			Gear::delete($id);
		}
		Redirect::to('gear');
	}
}