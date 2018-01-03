<?php

class BaseController{
  public static function get_user_logged_in(){
    if (isset($_SESSION['user'])) {
      $id = $_SESSION['user'];
      User::find($id);
    }
    return null;
  }

  public static function check_logged_in(){
    if (!isset($_SESSION['user'])) {
      Redirect::to('login');
    }
  }
}
