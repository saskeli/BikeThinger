<?php

class ComponentController extends BaseController {
	public static function index() {
		$components = Component::all();
		$bikes = Bike::allWithId();
		View::make('component/index.html', array('components' => $components, 
												 'bikes' => $bikes));
	}

	public static function show($id) {
		$component = Component::find($id);
		$bike = null;
		if ($component->in_use) {
			$bike = Bike::find($component->bike_id);
		}
		View::make('component/details.html', array('component' => $component,
												   'bike' => $bike));
	}
}