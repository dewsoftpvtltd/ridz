<?php
include 'ServiceFunctions.php';
$options = array('uri' => 'http://ridz.com:8000/masterphp/chap3/');
$server = new SoapServer(NULL, $options);
$server->setClass('ServiceFunctions');
$server->handle();
