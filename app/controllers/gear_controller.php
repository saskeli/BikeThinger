<?php

class GearController extends BaseController {
  public static function index() {
    self::check_logged_in();
    $gear = Gear::all($_SESSION['user']);
    View::make('gear/index.html', array('gear' => $gear));
  }

  public static function show($id) {
    self::check_logged_in();
    $gear = Gear::find($id, $_SESSION['user']);
    if (is_null($gear)) {
      Redirect::to('gear', array('error' => 'No such gear'));
    } else {
      View::make('gear/details.html', array('gear' => $gear));
    }
  }

  public static function create() {
    self::check_logged_in();
    View::make('gear/new.html');
  }

  public static function store() {
    self::check_logged_in();
    $user_id = $_SESSION['user'];
    $values = $_POST;
    $gear = new Gear(GearController::gearFromPost($user_id, $values));
    $errors = $gear->errors();
    if ($errors) {
      View::make('gear/new.html', array('errors' => $errors));
    } else {
      $gear->save();
      Redirect::to('gear');
    }
  }

  public static function edit($id) {
    self::check_logged_in();
    $gear = Gear::find($id, $_SESSION['user']);
    if (is_null($gear)) {
      Redirect::to('gear', array('error' => 'No such gear'));
    } else {
      View::make('gear/edit.html', array(
        'gear' => $gear));
    }
  }

  public static function update($id) {
    self::check_logged_in();
    $user_id = $_SESSION['user'];
    $values = $_POST;
    $gear = Gear::find($id, $_SESSION['user']);
    if (is_null($gear)) {
      Redirect::to('gear', array('error' => 'No such gear'));
    } else {
      $vgear = new Gear(GearController::gearFromPost($user_id, $values));
      $errors = $vgear->errors();
      if ($errors) {
        View::make('gear/edit.html', array('gear', $gear));
      } else {
        Gear::update($id, $_POST);
        Redirect::to('gear');
      }
    }
  }

  public static function delete($id) {
    self::check_logged_in();
    $gear = Gear::find($id, $_SESSION['user']);
    if (is_null($gear)) {
      Redirect::to('gear', array('error' => 'No such gear'));
    } else {
      if ($gear->name === $_POST['name']) {
        Gear::delete($id);
      }
      Redirect::to('gear');
    }
  }

  private static function gearFromPost($user_id, $values) {
    $distance = 0;
    if (isset($values['distance'])) {
      $distance = $values['distance'];
    }
    return new Gear(array(
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
