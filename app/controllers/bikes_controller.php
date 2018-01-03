<?php

class BikeController extends BaseController {
  public static function index() {
    $bikes = Bike::all();
    View::make('bike/index.html', array('bikes' => $bikes));
  }

  public static function show($id) {
    $bike = Bike::find($id);
    $components = Component::forbike($id);
    View::make('bike/details.html', array('bike' => $bike, 'components' => $components));
  }

  public static function create() {
    View::make('bike/new.html');
  }

  public static function store() {
    $bike = new Bike(array(
      'user_id' => 1,
      'name' => $_POST['name'],
      'model' => $_POST['model'],
      'link' => $_POST['link'],
      'year' => $_POST['year'],
      'description' => $_POST['description']
    ));
    $bike->save();

    Redirect::to('bikes');
  }

  public static function update($id) {
    Bike::update($id, $_POST);
    Redirect::to('bikes');
  }

  public static function edit($id) {
    $bike = Bike::find($id);
    View::make('bike/edit.html', array('bike' => $bike));
  }

  public static function delete($id) {
    $bike = Bike::find($id);
    if ($bike->name === $_POST['name']) {
      Bike::delete($id);
    }
    Redirect::to('bikes');
  }
}
