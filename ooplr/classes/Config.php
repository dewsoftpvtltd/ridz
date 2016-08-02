<?php
/**
 *
 */
class Config
{

  function __construct($argument)
  {
    # code...
  }

  public static function get($path = NULL){
    if($path){
      $config = $GLOBALS['Config'];
      $path = explode('/', $path);

      foreach ($path as $bit) {
        if(isset($config[$bit])){
          $config = $config[$bit];
        //  echo "<br>";
        }
      }
      return $config;
    }
    return false;
  }
}
