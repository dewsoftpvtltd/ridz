<?php
class Database{
  //static $instance;

  public function __construct(){
  //  echo "connect to db";
  }



  // public static function getInstance(){
  //   if(!self::$instance){
  //     self::$instance  = new self;
  //   }
  //   return self::$instance;
  // }
  //
  public function query($sql){
    return $sql;
  }
}
