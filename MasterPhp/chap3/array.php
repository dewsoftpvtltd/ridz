<?php
$concerts = array(
  array("title" => "The Magic Flute",
    "time" => 1329636600),
  array("title" => "Vivaldi Four Seasons",
    "time" => 1329291000),
  array("title" => "Mozart's Requiem",
    "time" =>  1330196400)
  );
$json =   json_encode($concerts);
echo "<pre>", json_encode($concerts);
echo "<br>";
foreach($concerts as $con){
  echo "title: ". $con['title']. " time: ".$con['time']. "<br>";
}

$jsonData = '[{"title":"The Magic Flute","time":1329636600},{"title":"Vivaldi Four Seasons","time":1329291000},{"title": "Mozart\'s Requiem","time":1330196400}]';
$concerts1 = json_decode($jsonData, true);
print_r($concerts1);
$concerts2 = json_decode($json);
print_r($concerts2);


$ch = curl_init('http://api.bitly.com/v3/shorten'
  . '?login=user&apiKey=secret'
  . '&longUrl=http%3A%2F%2Fsitepoint.com');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
print_r($result);

$result = file_get_contents('http://api.bitly.com/v3/shorten'
  . '?login=user&apiKey=secret'
  . '&longUrl=http%3A%2F%2Fsitepoint.com');
print_r(json_decode($result));


// Get the headers from $_SERVER
echo "Accept: " . $_SERVER['HTTP_ACCEPT'] . "\n";
echo "Verb: " . $_SERVER['REQUEST_METHOD'] . "\n";
// send headers to the client:
header('Content-Type: text/html; charset=utf8');
header('HTTP/1.1 404 Not Found');

// header('Location: login.php');
