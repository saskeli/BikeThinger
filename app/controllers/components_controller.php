<?php

class ComponentController extends BaseController {
  public static function index() {
    self::check_logged_in();
    $components = Component::all($_SESSION['user']);
    $bikes = Bike::allWithId($_SESSION['user']);
    View::make('component/index.html', array(
      'components' => $components,
      'bikes' => $bikes));
  }

  public static function show($id) {
    self::check_logged_in();
    $component = Component::find($id, $_SESSION['user']);
    if (is_null($component)) {
      Redirect::to('components', array('error' => 'No such component'));
    } else {
      $bike = null;
      if ($component->in_use) {
        $bike = Bike::find($component->bike_id, $_SESSION['user']);
      }
      View::make('component/details.html', array(
        'component' => $component,
        'bike' => $bike));
    }
  }

  public static function create() {
    self::check_logged_in();
    View::make('component/new.html');
  }

  public static function store() {
    self::check_logged_in();
    $user_id = $_SESSION['user'];
    $values  = $_POST;
    $component = new Component(ComponentController::componentFromPost($user_id, $values));
    $erorrs = $component->erorrs();
    if ($errors) {
      View::make('component/new.html', array('errors' => $errors));
    } else {
      $component->save();
      Redirect::to('components');
    }
  }

  public static function edit($id) {
    self::check_logged_in();
    $component = Component::find($id, $_SESSION['user']);
    if (is_null($component)) {
      Redirect::to('components', array('error' => 'No such component'));
    } else {
      View::make('component/edit.html', array(
        'component' => $component));
    }
  }

  public static function update($id) {
    self::check_logged_in();
    $user_id = $_SESSION['user'];
    $values = $_POST;
    $component = Component::find($id, $_SESSION['user']);
    if (is_null($component)) {
      Redirect::to('components', array('error' => 'No such component'));
    } else {
      $vcomponent = new Component(ComponentController::componentFromPost($user_id, $values));
      $errors = $vcomponent->errors();
      if ($errors) {
        View::make('component/edit.html', array('component' => $component));
      } else {
        Component::update($id, $_POST);
        Redirect::to('components');
      }
    }
  }

  public static function delete($id) {
    self::check_logged_in();
    $component = Component::find($id, $_SESSION['user']);
    if (is_null($component)) {
      Redirect::to('components', array('error' => 'No such component'));
    } else {
      if ($component->name === $_POST['name']) {
        Component::delete($id);
      }
      Redirect::to('components');
    }
  }

  private static function componentFromPost($user_id, $values) {
    $distance = 0;
    if (isset($values['distance'])) {
      $distance = $values['distance'];
    }
    return new Component(array(
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
