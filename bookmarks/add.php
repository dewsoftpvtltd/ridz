<?php
header('Content-Type', 'text/Javascript');
//
// $json = ['name'=>'basit'];
$json = [
  'success'=> false,
  'result' => 0
];
$request = $_POST;
if(isset($request['first'],$request['second'])){
  $first = (int)$request['first'];
  $second = (int)$request['second'];

  $result = $first + $second;
  $json['success'] = true;
  $json['result'] = $result;
}

echo json_encode($json);
