<?php

require_once "registry.php";


class Database{
  public $db = "db";
}
class Databasee{
  public $db = "db";
}
// $db = new Database;
// Registry::add($db, 'Database');
//print_r(Registry);
$db = new Database;
Registry::set($db);
$dbase1 = Registry::get("database");
$dbase = Registry::getStore();
print_r($dbase1);
print_r($dbase);
