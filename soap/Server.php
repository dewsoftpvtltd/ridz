<?php

class Server{

  public function __constructor(){

  }
public function getStudentName($id_array){
  return "basit ";
}

}

$params = [
  'uri'=>'http://ridz.com:8000/soap/Server.php',
];
$server  = new SoapServer(null, $params);
$server->setClass('Server');
$server->handle();


?>
