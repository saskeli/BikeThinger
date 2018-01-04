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
      Redirect::to('bikes', array('error' => 'No such bike'));
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
    $user_id = $_SESSION['user'];
    $values = $_POST;
    $bike = new Bike(BikeController::bikeFromPost($user_id, $values));
    $errors = $bike->errors();
    if ($errors) {
      View::make('bike/new.html', array('errors' => $errors));
    } else {
      $bike->save();
      Redirect::to('bikes');
    }
  }

  public static function update($id) {
    self::check_logged_in();
    $user_id = $_SESSION['user'];
    $values = $_POST;
    $bike = Bike::find($id, $user_id);
    if (is_null($bike)) {
      Redirect::to('bikes', array('error' => 'No such bike'));
    } else {
      $vbike = new Bike(BikeController::bikeFromPost($user_id, $values));
      $errors = $vbike->errors();
      if ($errors) {
        View::make('bike/edit.html', array('bike' => $bike));
      } else {
        Bike::update($id, $values);
        Redirect::to('bikes');
      }
    }
  }

  public static function edit($id) {
    self::check_logged_in();
    $bike = Bike::find($id, $_SESSION['user']);
    if (is_null($bike)) {
      Redirect::to('bikes', array('error' => 'No such bike'));
    } else {
      View::make('bike/edit.html', array('bike' => $bike));
    }
  }

  public static function delete($id) {
    self::check_logged_in();
    $bike = Bike::find($id, $_SESSION['user']);
    if (is_null($bike)) {
      Redirect::to('bikes', array('error' => 'No such bike'));
    } else {
      if ($bike->name === $_POST['name']) {
        Bike::delete($id);
      }
      Redirect::to('bikes');
    }
  }

  private static function bikeFromPost($user_id, $values) {
    $distance = 0;
    if (isset($values['distance'])) {
      $distance = $values['distance'];
    }
    return new Bike(array(
      'user_id' => $user_id,
      'distance' => $distance,
      'name' => $values['name'],
      'model' => $values['model'],
      'link' => $values['link'],
      'year' => $values['year'],
      'description' => $values['description']
    ));
  }
}
