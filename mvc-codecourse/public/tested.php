<?php
echo "test";
echo "<br>";

if(isset($_GET['controller'])){
  echo "controller is : ".$_GET['controller'];
  echo "<br>";

}

if(isset($_GET['action'])){
  echo "action is :" .$_GET['action'];
  echo "<br>";

}
if(isset($_GET['category'])){
  echo "category is :" .$_GET['category'];
  echo "<br>";

}
if(isset($_GET['page'])){
  echo "page is :" .$_GET['page'];
  echo "<br>";

}
if(isset($_GET['name'])){
  echo "name is :" .$_GET['name'];
  echo "<br>";

}
if(isset($_GET['id'])){
  echo "id is :" .$_GET['id'];
  echo "<br>";

}
