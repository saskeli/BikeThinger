<?php

class View{

  public static function make($view, $content = array()){
    $twig = self::get_twig();

    self::set_flash_message($content);

    $content['base_path'] = BASE_PATH;

    $content['user_logged_in'] = BaseController::get_user_logged_in();

    echo $twig->render($view, $content);


    exit();
  }

  private static function get_twig(){
    Twig_Autoloader::register();

    $twig_loader = new Twig_Loader_Filesystem('app/views');

    return new Twig_Environment($twig_loader);
  }

  private static function set_flash_message(&$content){
    if(isset($_SESSION['flash_message'])){
      try {
        $flash = json_decode($_SESSION['flash_message']);
        foreach($flash as $key => $value){
          $content[$key] = $value;
        }  
      } catch (Exception $e) {
        $content['error'] = $e->getMessage();
      }
      unset($_SESSION['flash_message']);
    }
  }

}
