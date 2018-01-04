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
      Redirect::to('gear', 'No such gear');
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
    $gear = new Gear(array(
      'user_id' => $_SESSION['user'],
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
    self::check_logged_in();
    $gear = Gear::find($id, $_SESSION['user']);
    if (is_null($gear)) {
      Redirect::to('gear', 'No such gear');
    } else {
      View::make('gear/edit.html', array(
        'gear' => $gear));
    }
  }

  public static function update($id) {
    self::check_logged_in();
    $gear = Gear::find($id, $_SESSION['user']);
    if (is_null($gear)) {
      Redirect::to('gear', 'No such gear');
    } else {
      Gear::update($id, $_POST);
      Redirect::to('gear');
    }
  }

  public static function delete($id) {
    self::check_logged_in();
    $gear = Gear::find($id, $_SESSION['user']);
    if (is_null($gear)) {
      Redirect::to('gear', 'No such gear');
    } else {
      if ($gear->name === $_POST['name']) {
        Gear::delete($id);
      }
      Redirect::to('gear');
    }
  }
}
