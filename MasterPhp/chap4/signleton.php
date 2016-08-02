<?php

// The Database class represents our global DB connection
class Database extends PDO {
  // A static variable to hold our single instance
  private static $_instance = null;
  // Make the constructor private to ensure singleton
  private function __construct()
  {
    // Call the PDO constructor
    parent::__construct(APP_DB_DSN, APP_DB_USER, APP_DB_PASSWORD);
  }
  // A method to get our singleton instance
  public static function getInstance()
  {
    if (!(self::$_instance instanceof Database)) {
      self::$_instance = new Database();
}
    return self::$_instance;
  }
}
// There are three crucial points to implementing the singleton:
// 1. A static member to hold our single instance—in this example, we have a private
// DB::$_instance property
// 2. Next, a private __construct() so that the class can only be instantiated by a
// static method contained
