<?php

class UserController extends BaseController {
  public static function login() {
    View::make('login.html');
  }

  public static function authenticate() {
    $user = User::authenticate($_POST['username'], $_POST['password']);
    if (!$user) {
      View::make('login.html', array('error' => 'Invalid username/password'));
    } else {
      $_SESSION['user'] = $user->id;
      Redirect::to('bikes');
    }
  }

  public static function logout() {
    self::check_logged_in();
    unset($_SESSION['user']);
    Redirect::to('login');
  }
}
