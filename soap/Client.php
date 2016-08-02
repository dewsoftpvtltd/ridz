<?php

 class Client{

  public $instance;
  public $params = [
    'location'=>'http://ridz.com:8000/soap/Server.php',
    'uri'=>'http://ridz.com:8000/soap/',
    'trace'=>1
  ];
  public function __constructor($params){
  $this->params = $params;
    $this->instance = new SoapClient(null, $this->params);
  }

public function getName($id_array){
  //return $this->instance;
  return $this->instance->__soapCall('getStudentName', $id_array);
}

}

$client = new Client;


?>
