<?php
 //include "phpass/PasswordHash.php";
include 'database.php';
include 'Article.php';

$db = new Database();
$article = new Article($db);

echo $article->getArticle();
echo "<br>-------------------------<br>";
// THis is to understand singleton Pattern
// $db = Database::getInstance();
// $db = Database::getInstance();
// $db = Database::getInstance();
// $db = Database::getInstance();
// $db = Database::getInstance();

//print_r($db);



echo "<br>-------------------------<br>";
 //$hash = new PasswordHash(8, false);

 $unhashed = "secret";

 //$hashed = $hash->HashPassword($unhashed);

 $hashed = password_hash($unhashed, PASSWORD_DEFAULT);

 if(password_verify($unhashed, $hashed)){
   echo "match";
 }else{
   echo "no match";
 }
// if($hash->CheckPassword($unhashed, $hashed)){
//   echo "match";
// }else{
//   echo "no match";
// }
