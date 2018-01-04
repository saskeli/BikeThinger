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
      Redirect::to('components', 'No such component');
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
    $component = new Component(array(
      'user_id' => $_SESSION['user'],
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
    self::check_logged_in();
    $component = Component::find($id, $_SESSION['user']);
    if (is_null($component)) {
      Redirect::to('components', 'No such component');
    } else {
      View::make('component/edit.html', array(
        'component' => $component));
    }
  }

  public static function update($id) {
    self::check_logged_in();
    $component = Component::find($id, $_SESSION['user']);
    if (is_null($component)) {
      Redirect::to('components', 'No such component');
    } else {
      Component::update($id, $_POST);
      Redirect::to('components');
    }
  }

  public static function delete($id) {
    self::check_logged_in();
    $component = Component::find($id, $_SESSION['user']);
    if (is_null($component)) {
      Redirect::to('components', 'No such component');
    } else {
      if ($component->name === $_POST['name']) {
        Component::delete($id);
      }
      Redirect::to('components');
    }
  }
}
