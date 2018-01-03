<?php

class BikeController extends BaseController {
  public static function index() {
    self::check_logged_in();
    $bikes = Bike::all($_SESSION['user']);
    View::make('bike/index.html', array('bikes' => $bikes));
  }

  public static function show($id) {
    self::check_logged_in();
    $bike = Bike::find($id, $_SESSION['user']);
    if (is_null($bike)) {
      Redirect::to('bikes', 'No such bike');
    } else {
      $components = Component::forbike($id, $_SESSION['user']);
      View::make('bike/details.html', array(
        'bike' => $bike,
        'components' => $components));
    }
  }

  public static function create() {
    self::check_logged_in();
    View::make('bike/new.html');
  }

  public static function store() {
    self::check_logged_in();
    $bike = new Bike(array(
      'user_id' => $_SESSION['user'],
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
    self::check_logged_in();
    $bike = Bike::find($id, $_SESSION['user']);
    if (is_null($bike)) {
      Redirect::to('bikes', 'No such bike');
    } else {
      Bike::update($id);
      Redirect::to('bikes');
    }
  }

  public static function edit($id) {
    self::check_logged_in();
    $bike = Bike::find($id, $_SESSION['user']);
    if (is_null($bike)) {
      Redirect::to('bikes', 'No such bike');
    } else {
      View::make('bike/edit.html', array('bike' => $bike));
    }
  }

  public static function delete($id) {
    self::check_logged_in();
    $bike = Bike::find($id, $_SESSION['user']);
    if (is_null($bike)) {
      Redirect::to('bikes', 'No such bike');
    } else {
      if ($bike->name === $_POST['name']) {
        Bike::delete($id);
      }
      Redirect::to('bikes');
    }
  }
}
