<?php

class ComponentController extends BaseController {
	public static function index() {
		$components = Component::all();
		$bikes = Bike::allWithId();
		View::make('component/index.html', array(
			'components' => $components, 
			'bikes' => $bikes));
	}

	public static function show($id) {
		$component = Component::find($id);
		$bike = null;
		if ($component->in_use) {
			$bike = Bike::find($component->bike_id);
		}
		View::make('component/details.html', array(
			'component' => $component,
			'bike' => $bike));
	}

	public static function create() {
		View::make('component/new.html');
	}

	public static function store() {
		$component = new Component(array(
			'user_id' => 1,
        	'name' => $_POST['name'],
        	'model' => $_POST['model'],
        	'link' => $_POST['link'],
        	'year' => $_POST['year'],
        	'description' => $_POST['description']
		));
		$component->save();

		Redirect::to('components');
	}

	public static function edit($id) {
		$component = Component::find($id);
		View::make('component/edit.html', array(
			'component' => $component));
	}

	public static function update($id) {
		Component::update($id, $_POST);
		Redirect::to('components');
	}

	public static function delete($id) {
		$component = Component::find($id);
		if ($component->name === $_POST['name']) {
			Component::delete($id);
		}
		Redirect::to('components');
	}
}