<?php

class TagController extends BaseController {
    public static function index() {
    self::check_logged_in();
    $tags = Tag::all($_SESSION['user']);
    View::make('tag/index.html', array('tags' => $tags));
  }

  public static function show($id) {
    self::check_logged_in();
    $user_id = $_SESSION['user_id'];
    $tag = Tag::find($id, $user_id);
    if (is_null($tag)) {
      Redirect::to('tags', array('error' => 'No such tag'));
    } else {
      $components = $tag->getBikes();
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
        View::make('bike/edit.html', array('bike' => $bike, 'errors' => $errors));
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

  public static function updateUsage($id) {
    self::check_logged_in();
    $bike = Bike::find($id, $_SESSION['user']);
    if (is_null($bike)) {
      Redirect::to('bikes', array('error' => 'No such bike'));
    } else {
      $bike->toggleUsage();
      Redirect::to('bikes');
    }
  }

  public static function addKilometers($id) {
    self::check_logged_in();
    if (!isset($_POST['num'])) {
      Redirect::to('bikes', array('error' => 'invalid post'));
    }
    $num = $_POST['num'];
    $user_id = $_SESSION['user'];
    $bike = Bike::find($id, $user_id);
    if (is_null($bike)) {
      Redirect::to('bikes', array('error' => 'No such bike'));
    } else if ((!is_numeric($num)) or $num < 0 or $num > 3000){
      Redirect::to('bikes', array('error' => 'Needs to be number between 0 and 3000'));
    } else {
      $components = Component::forbike($id, $user_id);
      $gear = Gear::allInUse($user_id);
      $bike->addKilometers($num);
      foreach ($components as $component) {
        $component->addKilometers($num);
      }
      foreach ($gear as $g) {
        $g->addKilometers($num);
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
